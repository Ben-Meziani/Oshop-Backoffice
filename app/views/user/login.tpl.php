 <div class="container my-4">
    <a href="<?=$router->generate('main-home')?>" class="btn btn-success float-right">Retour</a>
    <h2>Se connecter</h2>

    <form action="" method="POST" class="mt-5">
        <?php foreach ($errorList as $error): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
        <?php endforeach?>
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Votre email" value="">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input name="password" type="password" class="form-control" id="password" placeholder="Votre mot de passe"
                value="">
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

</div>
