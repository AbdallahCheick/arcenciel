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
    $contenus = $parsedData['contenus'];

    $sql =
        'insert into categories(cat_name, cat_description) ' . 'values (?,?)';
    $stmt = mysqli_stmt_init($connexion);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        http_response_code(500);
        echo 'Erreur de la database';
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, 'ss', $nom, $contenus);
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
