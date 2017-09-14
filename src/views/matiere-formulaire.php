<form method="post" class="form-line">
	<div class="form-group">
	<input type="text" name="matiere" placeholder="votre matiere" class="form-control" value="<?=$matiere?>">
	</div>
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="token" value="<?=$token?>">

	<div class="form-group">
<button class="btn btn-primary" type="submit"
name="submit">ok</button>
</div>
</form>