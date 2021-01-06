<?php
$title='Mes informations - etudiant';
require '../general/debut.php';
echo '<link rel="stylesheet" type="text/css" href="../css/eleve/infoetudiant.css">';
require '../general/debut-2.php';
$h3='Menu élève';
require '../general/navbanner-eleve.php';
?>

<div class="body" id="body">
            <div class="melbanner">
                <button id="btn-menu1" onclick="show_hide()"><img src="/img/menu.png" id="menu"></button>
                <img src="/img/logo.png" id="logo"/>
                <input type="text" placeholder="Entrez des mots-clés" id="searchbar"><input type="submit" value="Rechercher" id="submitbutton">
                <img src="/img/david.jpg" id="user"/>
            </div>
            <br/><br/><br/>
            <br/><br/><br/>

            <?php  require 'contenu_note.php' ; ?>

<?php  require '../general/fin.php' ; ?>
