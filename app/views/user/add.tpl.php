<?php dump($viewVars) ?>
<?php dump($_POST) ?>
<a href="<?=$router->generate('user-list')?>" class="btn btn-success float-right">Retour</a>
<h2>Ajouter un utilisateur</h2>

<form action="" method="POST" id="add-form" class="mt-5">
     <?php foreach ($errorList as $error): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
        <?php endforeach?>
    <div class="form-group">
        <label for="firstname">Prénom</label>
        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Prénom"
            aria-describedby="firstnameHelpBlock">
        <div id="errorname" class="errors alert-danger">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname">Nom</label>
        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Nom"
            aria-describedby="lastnameHelpBlock">
        <div id="errorlastname" class="errors alert-danger">
        </div>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email"
            aria-describedby="emailHelpBlock">
        <div id="erroremail" class="errors alert-danger">
        </div>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="paswword" placeholder="Mot de passe"
            aria-describedby="passwordHelpBlock">
        <div id="errorpassword" class="errors alert-danger">
        </div>
    </div>
    <div class="form-group">
        <label for="role">Rôle</label>
            <SELECT name="role" id="role" size="1" class="form-control">
            <OPTION value="admin">Admin</option>
            <OPTION value="catalog-manager">Catalog manager</option>
            </SELECT>
    </div>
    <div class="form-group">
        <label for="status">Statut</label>
            <SELECT name="status" id="status" size="1" class="form-control">
            <OPTION selected value="1">Actif</option>
            <OPTION value="2">Désactivé</option>
            </SELECT>
    </div>
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>
