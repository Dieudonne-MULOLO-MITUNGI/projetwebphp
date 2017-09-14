<h2>liste des matieres</h2>

<div>
<a href="index.php? controller=matiere-formulaire"
class="btn btn-primary">Nouvelle matiere</a>
</div>
<table class="table table-bordered table striped">
<tr>
   <th>Matiere</th>
   <th>Action</th>
  
</tr>

		<?php foreach ($listeMatieres as $ligne): ?> 
<tr>
		    <td><?=$ligne["matiere"]?></td> 
<td>

		<a href="index.php?controller=matiere-delete&id=<?=$ligne["matiere_id"]?>"
		    class= "btn btn-danger">
		    supprimer
		    </a>

			<a href="index.php?controller=matiere-formulaire&id=<?=$ligne["matiere_id"]?>" 
			class="btn btn-primary">modification
			</a>

</td>

</tr>
<?php endforeach;?>

</table>	
