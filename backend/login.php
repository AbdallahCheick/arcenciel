<?php
include 'connexion.php';
$method = $_SERVER['REQUEST_METHOD'];
$date = date('Y-m-d H:i:s');

if ($method == 'POST') {
    $data = file_get_contents('php://input');
    $parsedData = json_decode($data, true);
    $user = $parsedData['user'];
    $password = $parsedData['password'];

    if (!empty($user) && !empty($password)) {
        try {
            // Utilisation de requêtes préparées
            $requete = $connexion->prepare(
                'SELECT * FROM users WHERE uidUsers = ?'
            );
            $requete->bind_param('s', $user);
            $requete->execute();
            $resultat = $requete->get_result();

            if ($resultat->num_rows > 0) {
                $utilisateur = $resultat->fetch_assoc();
                $hashMotDePasse = $utilisateur['pwdUsers'];

                // Utilisation de password_verify pour vérifier le mot de passe
                if (password_verify($password, $hashMotDePasse)) {
                    $data = [
                        'uidUsers' => $utilisateur['uidUsers'],
                        'f_name' => $utilisateur['f_name'],
                        'l_name' => $utilisateur['l_name'],
                        'idUsers' => $utilisateur['idUsers'],
                        'gender' => $utilisateur['gender'],
                        'bio' => $utilisateur['bio'],
                        'emailUsers' => $utilisateur['emailUsers'],
                        'userImg' => $utilisateur['userImg'],
                    ];
                    http_response_code(200);
                    echo json_encode($data);
                } else {
                    http_response_code(403);
                    echo '403 : nom d\'utilisateur ou mot de passe incorrect';
                }
            } else {
                http_response_code(403);
                echo '403 : nom d\'utilisateur ou mot de passe incorrect';
            }

            $requete->close();
            $connexion->close();
        } catch (Exception $e) {
            http_response_code(500);
            echo '500 : Erreur lors de la connexion' . $e;
        }
    } else {
        http_response_code(400);
        echo '400 : Veuillez remplir les champs user et password';
    }
} else {
    http_response_code(405);
    echo '405 : Méthode non autorisée';
}
?>
