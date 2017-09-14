<form method="post" class="form-line">
    <div class="form-group">
    <input type="text" name="email" placeholder="entrer votre mail" class="form-control" value="<?=$email?>">
    </div>
    <input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="token" value="<?=$token?>">


    <div class="form-group">
    <input type="text" name="mot de passe" placeholder="entrer mot de passe" class="form-control" value="<?=$motdepasse?>">
    </div>
    <input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="token" value="<?=$token?>">



    <div class="form-group">
    <input type="text" name="confirmation du mot de passe" placeholder="entrer mot de passe" class="form-control" value="<?=$confirmermotdepasse?>">
    </div>
     <input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="token" value="<?=$token?>">


    <div class="form-group">
    <input type="text" name="nom" placeholder="entrer votre nom" class="form-control" value="<?=$nom?>">
    </div>
     <input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="token" value="<?=$token?>">

    <div class="form-group">
    <input type="text" name="Prenom" placeholder="entrer votre prenom" class="form-control" value="<?=$prenom?>">
    </div>

    <input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="token" value="<?=$token?>">
     <input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="token" value="<?=$token?>">

    <div class="form-group">
<button class="btn btn-primary" type="submit"
name="submit">valider</button>
</div>
</form>