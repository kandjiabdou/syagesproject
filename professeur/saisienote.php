<?php
$title='Saisie des notes';
require "../general/debut.php";
echo '<link rel="stylesheet" type="text/css" href="../css/professeur/style_gestion_prof.css">'; /*la c'est le css que vous devez en gros mettre le css qui vous est particulier pas le css general qui est deja défini dans le début.php*/
require '../general/debut-2.php';
$h3='Menu-Professeur';
require "../general/navbanner-professeur.php";
require_once "../general/Bddsyages.php";

$m = Bddsyages::getBddsyages(2);
$message="";
if(isset($_POST['numEval']) and isset($_POST['idPromo']) and isset($_POST['idMatiere'])){
	$numEval =$_POST['numEval'];
	$idMatiere = $_POST['idMatiere'];
	$idPromo = $_POST['idPromo'];
	$lesusersCtrl = $m->controle_promo_matiere_num($idPromo,$idMatiere,$numEval);
	$nomMatire=$m->nom_matiere($idMatiere);
	$nomPromo =$m->nom_promo($idPromo);
	$inf=$m->info_controle($idPromo,$idMatiere,$numEval);
	$nbNoteModif=0;
	if(isset($_POST['liste_note'])){
		$i=0;
		foreach($lesusersCtrl as $cle => $lingneUser){
			if(!($lingneUser['Note']==$_POST['liste_note'][$i])){
				$h= $lingneUser['Note']==-1? "" : $lingneUser['historique']." le ".date('Y-m-d')." : ".$lingneUser['Note']." => ".$_POST['liste_note'][$i]."; ";
				$data=[
					":idEtu"=>$lingneUser['idUser'],
					":idpromo"=>$idPromo,
					":idmatiere"=>$idMatiere,
					":numEval"=>$numEval,
					":note"=>$_POST['liste_note'][$i],
					":historique"=> $h
				];
				$m->majNote2($data);
				$nbNoteModif++;
			}
			$i++;
		}
		$message=$nbNoteModif==0? "" : "<p>Il y a ".$nbNoteModif." note(s) modifé (s)</p>";
		$lesusersCtrl = $m->controle_promo_matiere_num($idPromo,$idMatiere,$numEval);
	}
	//else{var_dump("Pas de note modifié ");}
}else {
    $numEval =1;
	$idMatiere = 1;
	$idPromo = 120211;
	$lesusersCtrl = $m->controle_promo_matiere_num(120211,1,1);
	$nomMatire='Maths';
	$nomPromo ='A';
	$inf=$m->info_controle(120211,1,1);
}
?>
<div class="body" id="body">
    <div class="melbanner">
		<button id="btn-menu1" onclick="show_hide()"><img src="../img/menu.png" id="menu"></button>
        <img src="../img/logo.png" id="logo"/>
        <input type="text" placeholder="Entrez des mots-clés" id="searchbar"><input type="submit" value="Rechercher" id="submitbutton">
        <img src="../img/david.jpg" id="user"/>
    </div>

    <h2>PROMOTION : DEAU <?= $nomPromo?></h2><br/>
	<h3>Matière : <?= $nomMatire?></h3><br/>
	<?php
	echo '<h2>Evaluation : <input type="text" name="mode" value="'.$inf['Mode'].'"></h2><br/>
	<h3>Coefficient: <input type="number" name="coef" value="'.$inf['Coef'].'" required min="1" max="20" step="any">
	<br/> Date: <input type="date" name="date" value="'.$inf['Date'].'" > </h3><br/>';
	?>
	<br/>
	<?=$message?>
	<br/>

	<div class="tababs">
		<div class="tab">
		<form action="saisienote.php" method='post'>
			<input name="idMatiere" type="hidden" value="<?=$idMatiere?>">
			<input name="idPromo" type="hidden" value="<?=$idPromo?>">
			<input name="numEval" type="hidden" value="<?= $numEval ?>">
			<table id="tab_note">
				<thead>
				<tr><th class="btn_titre_col">Numéro </th><th class="btn_titre_col">Prénom </th><th class="btn_titre_col">Nom</th><th class="btn_titre_col">Note</th></tr>
				</thead>
				<tbody>
				<?php
				//var_dump(bcdiv(rand(0,100),5,2));
					foreach($lesusersCtrl as $cle => $lingneUser){
						//var_dump($lingneUser);
						$n=$lingneUser["Note"]; $infnote="";
						if($n==-1){ $infnote="NP";
						}elseif($n==-2){$infnote="abs";}
						$modif= ($lingneUser["modifie"]==1 and $lingneUser["historique"]!="" )? '<span id="info_modif" title="'.$lingneUser["historique"].'"> -?- </span>' : '';
						echo '<tr><td>'.($cle+1).'</td><td>'.$lingneUser["Nom"].'</td><td>'.$lingneUser["Prénom"].'</td>
						<td>'.$infnote.' <input type="number" name="liste_note[]" value="'.$lingneUser["Note"].'" required min="-2" max="20" step="any"> '.$modif.'</td></tr>';
					}
				?>
				</tbody>
			</table>
		<button class="btn_submit" type="submit">Enregistrer</button>
		</form>

	<script>
	const compare = (ids, asc) => (row1, row2) => {
		const tdValue = (row, ids) => row.children[ids].textContent;
		const tri = (v1, v2) => v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2);
		return tri(tdValue(asc ? row1 : row2, ids), tdValue(asc ? row2 : row1, ids));
	};

	const tbody = document.querySelector('tbody');
	const thx = document.querySelectorAll('th');
	const trxb = tbody.querySelectorAll('tr');
	thx.forEach(th => th.addEventListener('click', () => {
		let classe = Array.from(trxb).sort(compare(Array.from(thx).indexOf(th), this.asc = !this.asc));
		classe.forEach(tr => tbody.appendChild(tr));
	}));
	</script>
	<br/><br/><br/>
	<div id="btn_eval_abs">
				
					
		<form action="saisienote.php">
			<button class="btn_submit" type="submit">Supprimer</button>
		</form>
	</div>
	<br/><br/><br/>
	<br/><br/><br/>
	<br/><br/><br/>
	</div>
	</div>
<?php require "../general/fin.php"; ?>