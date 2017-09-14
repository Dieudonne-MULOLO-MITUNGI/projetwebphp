<h1>Espace d'administration</h1>


<h3>Nouvelle compétence</h3>
<form method="post" class="form-inline">
    <div class="form-group">
        <input type="text" name="newSkill" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-primary">OK</button>
    </div>
</form>

<h2>Liste des compétences</h2>
<table class="table table-bordered table-striped">
    <tr>
        <th>Compétences</th>
        <th>Action</th>
    </tr>
    <?php $index=0 ?>
    <?php foreach($skills as $item): ?>
        <tr>
            <td><?=$item?></td>
            <td>
                <a href="index.php?controller=acceuil-admin&itemIndex=<?=++$index?>" class="btn btn-default">
                    <i class="glyphicon glyphicon-trash"></i>
                    Supprimer
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>