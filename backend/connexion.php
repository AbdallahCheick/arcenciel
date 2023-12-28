<?php 
    $connexion = mysqli_connect("localhost", "root", "", "arcenciel_database") ; 
    if(!$connexion){
        die("impossible de faire la connexion". mysqli_connect_error()) ; 
    }
?>