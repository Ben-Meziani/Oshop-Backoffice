<?php //dump($users) ?>
<?php //dump($_SESSION['userObject']->getRole()) ?>
<a href="<?=$router->generate('user-add')?>" class="btn btn-success float-right">Ajouter</a>
<h2>Liste des utilisateurs</h2>
<table class="table table-hover mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Rôle</th>
            <th scope="col">Statut</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($users as $user): ?>
            <tr>
                <th scope="row"><?=$user->getFirstname()?></th>
                <td><?=$user->getFirstName()?></td>
                <td><?=$user->getLastName()?></td>
                <td><?=$user->getRole()?></td>
                <td><?=$user->getStatus()?></td>
                <td class="text-right">
                    <a href="" class="btn btn-sm btn-warning">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <!-- Example single danger button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Oui, je veux supprimer</a>
                            <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                        </div>
                    </div>
                </td>
            </tr>

        <?php endforeach;?>

    </tbody>
</table>
