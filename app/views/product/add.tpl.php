
<a href="<?= $router->generate('product-list') ?>" class="btn btn-success float-right">Retour</a>
<h2>Ajouter un produit</h2>

<form action="" method="POST" class="mt-5">
    <div class="form-group">
        <label for="name">Nom</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="Nom du produit">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input name="description" type="text" class="form-control" id="description" placeholder="Description du produit">
    </div>
    <div class="form-group">
        <label for="picture">Image</label>
        <input name="picture" type="text" class="form-control" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock">
        <small id="pictureHelpBlock" class="form-text text-muted">
            URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
        </small>
    </div>
    <div class="form-group">
        <label for="price">Prix</label>
        <input name="price" type="number" class="form-control" id="price" placeholder="34.99">
    </div>
    <div class="form-group">
        <label for="status">Statut</label>
        <input name="status" type="number" class="form-control" id="status" placeholder="Status" min="0" max="1">
        <small id="statusHelpBlock" class="form-text text-muted">
            Le status est de 0 si le produit n'est pas disponible, 1 s'il est disponible
        </small>
    </div>
    <div class="form-group">
        <label for="brand">Marque</label>
            <SELECT name="brand_id" id="brand_id" size="1" class="form-control">
            <?php foreach ($brands as $brand) : ?>
            <OPTION value="<?=$brand->getId() ?>"><?=$brand->getName() ?></option>
            <?php endforeach ?>
            </SELECT>
    </div>
    <div class="form-group">
    <label for="category">Catégorie</label>
        <SELECT name="category_id" id="category_id" size="1" class="form-control">
        <?php foreach ($categories as $category) : ?>
        <OPTION value="<?=$category->getId() ?>"><?=$category->getName() ?></option>
        <?php endforeach ?>
        </SELECT>
    </div>
    <div class="form-group">
    <label for="type">Type</label>
        <SELECT name="type_id" id="type_id" size="1" class="form-control">
        <?php foreach ($types as $type) : ?>
        <OPTION value="<?=$type->getId() ?>"><?=$type->getName() ?></option>
        <?php endforeach ?>
        </SELECT>
    </div>
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>
