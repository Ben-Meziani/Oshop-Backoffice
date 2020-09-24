<a href="<?=$router->generate('brand-list')?>" class="btn btn-success float-right">Retour</a>
<h2>Ajouter une marque</h2>

<form action="" method="POST" class="mt-5">
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Nom de la marque">
    </div>
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>
