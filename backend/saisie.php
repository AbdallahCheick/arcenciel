<?php
// Demande à l'utilisateur de saisir quelque chose
echo 'Veuillez saisir quelque chose : ';

// Lit la saisie au clavier
$saisie = fgets(STDIN);

// Affiche la saisie
echo 'Vous avez saisi : ' . $saisie;
?>
