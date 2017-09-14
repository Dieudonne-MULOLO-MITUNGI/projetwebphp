
<?php if(count($errors)>0):?>
		<div class="alert-danger">
			<ul>
				<?php foreach($errors as $item) : ?>
					<li> <?=$item?> </li>
				<?php endforeach; ?>
				</ul>	
					</div>
		<?php endif; ?>


<div class="row">
<div class="col-md-6 col-md-offset-3">

<form method="post">
	<div class="form-group">
	<label> votre identifiant</label>
		<input type="text" name="login" class="form-control" value="<?=$login?>">
	</div>

	<div class="form-group">
		<label>votre mot de passe</label>
		<input type="password" name="password" class="form-control">
	</div>

	<div class="form-group">
	<button type="submit" name="submit" class="btn btn-primary">valider</button>
	</div>
	</form>
	</div>

	</div>