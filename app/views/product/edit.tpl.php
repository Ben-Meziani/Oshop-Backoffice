<div class="container my-4">
    <a href="<?= $router->generate('product-list') ?>" class="btn btn-success float-right">Retour</a>
    <h2>Modifier un produit</h2>

    <form action="" method="POST" class="mt-5">
        <div class="form-group">
            <label for="name">Nom</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Nom du produit" value="<?= $product->getName() ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input name="description" type="text" class="form-control" id="description" placeholder="Description du produit" value="<?= $product->getShortDescription() ?>">
        </div>
        <div class="form-group">
            <label for="picture">Image</label>
            <input name="picture" type="text" class="form-control" id="picture" placeholder="image jpg png" value="<?= $product->getPicture() ?>" aria-describedby="pictureHelpBlock">
            <small id="pictureHelpBlock" class="form-text text-muted">
                URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
            </small>
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input name="price" type="number" class="form-control" id="price" placeholder="34.99" value="<?= $product->getPrice() ?>">
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <input name="status" type="number" class="form-control" id="status" placeholder="Status" value="<?= $product->getStatus() ?>" min="1" max="2">
            <small id="statusHelpBlock" class="form-text text-muted">
                Le status est de 1 si le produit n'est pas disponible, 2 s'il est disponible
            </small>
        </div>

        <div class="form-group">
            <label for="brand">Marque</label>
            <SELECT name="brand_id" id="brand_id" size="1" class="form-control">
                <?php foreach ($brands as $brand) : ?>
                    <OPTION <?= ($product->getBrandId() == $brand->getId()) ? 'selected="selected"' : '' ?> value="<?= $brand->getId() ?>"><?= $brand->getName() ?></OPTION>
                <?php endforeach ?>
            </SELECT>

        </div>
        <div class="form-group">
            <label for="category">Catégorie</label>
            <SELECT name="category_id" id="category_id" size="1" class="form-control">
                <?php foreach ($categories as $category) : ?>
                    <OPTION <?= ($product->getCategoryId() == $category->getId()) ? 'selected' : '' ?> value="<?= $category->getId() ?>"><?= $category->getName() ?> </OPTION>
                <?php endforeach ?>
            </SELECT>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <SELECT name="type_id" id="type_id" size="1" class="form-control">
                <?php foreach ($types as $type) : ?>
                    <OPTION <?= ($product->getTypeId() == $type->getId()) ? 'selected' : '' ?> value="<?= $type->getId() ?>"><?= $type->getName() ?> </OPTION>
                <?php endforeach ?>
            </SELECT>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>

        <!-- FORMULAIRE DE SELECTION DE TAGS -->
        <div class="form-group mt-5">
            <h5>Les tags</h5>
            <?php foreach ($productTags as $tag) : ?>
                <div class="badge badge-secondary"><?= $tag->getName() ?></div>
            <?php endforeach; ?>
        </div>

        <div class="form-group mt-5">
            <label for="tag_id">tag</label>
            <select name="tag_id" id="tag_id" class="form-control">
                <?php //affichage dynamique de notre liste déroulante ! 
                ?>
                <?php foreach ($allTags as $tag) : ?>
                    <option value="<?= $tag->getId() ?>"><?= $tag->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>