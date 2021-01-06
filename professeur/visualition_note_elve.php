<?php
$title='Controles';
require "../general/debut.php";
echo '<link rel="stylesheet" type="text/css" href="../css/professeur/style_gestion_prof.css">';
echo '<link rel="stylesheet" type="text/css" href="../css/eleve/infoetudiant.css">';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
echo "<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>";
require '../general/debut-2.php';
$h3='Menu-Professeur';
require "../general/navbanner-professeur.php";

?>
        <div class="body" id="body">
            <div class="melbanner">
				<button id="btn-menu1" onclick="show_hide()"><img src="../img/menu.png" id="menu"></button>
                <img src="../img/logo.png" id="logo"/>
                <input type="text" placeholder="Entrez des mots-clés" id="searchbar"><input type="submit" value="Rechercher" id="submitbutton">
                <img src="../img/david.jpg" id="user"/>
            </div>
            <?php require "../eleve/contenu_note.php"; ?>

<?php require "../general/fin.php"; ?>