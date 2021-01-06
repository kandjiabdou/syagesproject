<?php
require "../general/debut.html";
require "../general/menu.html";

$bd = new PDO('mysql:host=localhost;dbname=syages', 'root', '');
$bd->query("SET NAMES 'utf8'");
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requete = $bd->prepare("SELECT * FROM eval ORDER BY Date LIMIT 10");
$requete->execute();
$requete = $requete->fetchAll(PDO::FETCH_ASSOC);

?>
<h2><br/>ÉVALUATION </h2><br/>  
<div class="tabeval">
    <div class="tab">
        <table>
        <tr><th>Matières</th><th>Promo concernée</th><th>Date</th><th>Coefficient</th><th>Type d'évaluation</th></tr>
            <?php
                foreach ($requete as $ligne){                           
                $requeteMatiere = $bd->prepare("SELECT `Nom` FROM matiere where idMatiere=:idm");
                $requeteMatiere->bindValue(":idm",$ligne['idMatiere']);
                $requeteMatiere->execute();
                $requetePromo = $bd->prepare("SELECT `Option` FROM promotion where idPromotion=:idp");
                $requetePromo->bindValue(":idp",$ligne['idPromotion']);
                $requetePromo->execute();
                        
                $nomMatiere=$requeteMatiere->fetchAll(PDO::FETCH_ASSOC);
                $nomPromo=$requetePromo->fetchAll(PDO::FETCH_ASSOC);
                echo '<tr><td>'. $nomMatiere[0]['Nom']. '</td><td>' . $nomPromo[0]['Option'].'</td><td>'.$ligne['Date'].'</td><td>'.$ligne['Coef'].'</td><td> '.$ligne['Mode'] .'</td></tr>';
                }
                /**foreach ($liste_eval as $ev){
                    echo '<tr><td>' . $ev['idMatiere'] . '</td><td>' . $ev['idPromotion'] . '</td><td>' .  $ev['Coef'] . '</td><td>' .  $ev['Date'] . '</td><td>' .  $ev['Mode'] . '</td></tr>';
                }**/
            ?>
        </table>
    </div>
            
    <div class="eval">
        <h4>Ajouter une évaluation</h4>
        <form action="ajout.php" method="post">
            <p>Date : <input type="date" value="" name="date"/></p>
            <p><label>Promo concernée:<input type="text" name="classe"/></label></p>
            <p><label>Matières:<input type="text" name="matiere"/></label></p> 
            <p><label>Type d'évaluation:<input text="text" name="eval"/></label></p> 
            <p><label>Coefficient:<input type="text" value="" name="coeff"/></label></p>
            <p><input type="submit" value="Créer une évaluation" id="submit"/></p>
            <p><input type="button" value="Gérer une promo" id="button"/></p>
        </form> 
    </div>
</div>
        
<?php
require "../general/fin.html";
?>

