<div class="container">
    <h1>Mes notes</h1>
        <div class="contgen">
        <div class="choixtrim">
            <select name="pets" id="pet-select">
            <option value="">-- Choisir un trimestre --</option>
            <option value="dog">Trimestre 1</option>
            <option value="cat">Trimestre 2</option>
            <option value="hamster">Trimestre 3</option>
            </select>
        </div>
    </div>

		<br/>

	<div class="tabnote">
	<div class="tab">
		<table id="tab_note">
			<tr><th>Matière </th><th>Type </th><th>Coef eval </th><th>Date</th><th >Note</th><th>Moyenne matière </th></tr>
			<?php
				require '../general/BDDSyages-etud.php';
				$ide= isset($_POST['id']) ? $_POST['id'] :  11111206;
				$m= Bddsyages::getBddsyages(2);
				$mt=$m->recuperer_matieres_etud($ide);
				$moyG=0;
				$nbM=0;
				$tab= ["Mode", 'Coef',"Date","Note"];		
				foreach($mt as $matiere){
					$controle = $m->recup_controle_matiere($ide, $matiere);
					//var_dump($controle);
					if(!count($controle)==0){
						$moy=0;$nbCoef=0;
						echo '<tr><td>'.$controle[0]["Nom"].'</td>';
						foreach($tab as $nomCol){
							echo "</td> <td>";
							foreach ($controle as $c){
								$aff=$c[$nomCol];
								if($nomCol == "Note"){
									if($aff==-2){
										$aff="abs"; $nbCoef+=$c['Coef']; $moy+=0;
									}elseif($aff==-1){
										$aff="NP";
									}else{
										$nbCoef+=$c['Coef']; $moy+=$aff*$c['Coef'];
									}
								}
								echo ''.$aff."</br>";
							}
						}
						$moyG+=bcdiv($moy,$nbCoef==0 ? 1 : $nbCoef,2);
						echo '</td><td>'.(bcdiv($moy,$nbCoef==0 ? 1 : $nbCoef,2)).'/20</td>';
						//bcdiv($a, $b, 3)
						echo '</tr>';
						$nbM++;
					}else{
						$n=$m->matiere_de(intval($matiere));
						echo '<tr><td>'.$n.'</td><td></td><td></td><td></td><td></td><td>Pas de note</td>';
					}
				}
			?>
		</table>
		<br/><br/><br/>
		<div class="titre">
			<h2>Moyenne générale : <?= $nbM!=0 ? bcdiv($moyG,$nbM,2): 'Pas de note' ?></h2>
		</div>
		<br/><br/><br/>
	</div>
</div>