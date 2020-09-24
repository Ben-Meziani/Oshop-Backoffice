<a href="<?= $router->generate('brand-add') ?>" class="btn btn-success float-right">Ajouter</a>
<h2>Liste des marques</h2>
<table class="table table-hover mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($brands as $brand) : ?>
            <tr>
                <th scope="row"><?= $brand->getId() ?></th>
                <td><?= $brand->getName() ?></td>
                <td class="text-right">
                    <a href="<?= $router->generate('brand-edit', ['id' => $brand->getId()]) ?>" class="btn btn-sm btn-warning">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <!-- Example single danger button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= $router->generate('brand-delete', ['id' => $brand->getId()]) ?>">Oui, je veux supprimer</a>
                            <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                        </div>
                    </div>
                </td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>
<a href="<?= $router->generate('brand-footer-edit') ?>" class="btn btn-primary float-right">Modifier les marques dans le footer</a>