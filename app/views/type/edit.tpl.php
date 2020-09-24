<div class="container my-4">
        <a href="<?= $router->generate('type-list') ?>" class="btn btn-success float-right">Retour</a>
        <h2>Modifier un type</h2>

        <form action="" method="POST" class="mt-5">
            <div class="form-group">
                <label for="name">Nom</label>
                <?= $type->getName() ?>
                <input name="name" type="text" class="form-control" id="name" placeholder="Nom du type" value="<?= $type->getName() ?>">
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    </div>
