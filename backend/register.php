<?php
//La connexion a la database
include 'connexion.php';
// la recuperation de la methode de reception
$method = $_SERVER['REQUEST_METHOD'];
$date = date('Y-m-d H:i:s'); // initialisation de la date actuel

if ($method == 'POST') {
    $data = file_get_contents('php://input');
    $parsedData = json_decode($data, true);
    $nom = $parsedData['nom'];
    $prenom = $parsedData['prenom'];
    $username = $parsedData['username'];
    $email = $parsedData['email'];
    $password = $parsedData['password'];
    $repassword = $parsedData['repassword'];
    $bio = $parsedData['bio'];
    $genre = 'Masculin';

    // checking if a user already exists with the given user
    $sql = 'select * from users where uidUsers=?;';
    $stmt = mysqli_stmt_init($connexion);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        http_response_code(500);
        echo 'Erreur de la database';
        exit();
    }
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $resultCheck = mysqli_stmt_num_rows($stmt);

    $FileNameNew = 'default.png';

    $sql =
        'insert into users(f_name, l_name, uidUsers, emailUsers, pwdUsers, gender, ' .
        'bio, userImg) ' .
        'values (?,?,?,?,?,?,?,?)';
    $stmt = mysqli_stmt_init($connexion);
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        http_response_code(500);
        echo 'Erreur de la database';
        exit();
    } else {
        mysqli_stmt_bind_param(
            $stmt,
            'ssssssss',
            $nom,
            $prenom,
            $username,
            $email,
            $hashedPwd,
            $genre,
            $bio,
            $FileNameNew
        );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        http_response_code(200);
        echo 'Enregistrement reussi avec success';
        mysqli_stmt_close($stmt);
        mysqli_close($connexion);
    }
} else {
    http_response_code(405);
    echo 'Erreur sur la methode';
}

?>
