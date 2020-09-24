<a href="<?=$router->generate('category-list')?>" class="btn btn-success float-right">Retour</a>
<h2>Ajouter une catégorie</h2>

<form action="" method="POST" id="category-add-form" class="mt-5">
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Nom de la catégorie">
        <div id="errorname" class="errors alert-danger">
        </div>
    </div>
    <div class="form-group">
        <label for="subtitle">Sous-titre</label>
        <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Sous-titre" aria-describedby="subtitleHelpBlock">
        <div id="errorsubtitle" class="errors alert-danger">
        </div>
        <small id="subtitleHelpBlock" class="form-text text-muted">
            Sera affiché sur la page d'accueil comme bouton devant l'image
        </small>
    </div>
    <div class="form-group">
        <label for="picture">Image</label>
        <input type="text" class="form-control" name="picture" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock">
        <div id="errorpicture" class="errors alert-danger">
        </div>
        <small id="pictureHelpBlock" class="form-text text-muted">
            URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
        </small>
    </div>
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>
