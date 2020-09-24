<a href="<?= $router->generate('main-home') ?>" class="btn btn-success float-right">Retour</a>
<h2>Gestion de la page d'accueil</h2>
<form action="" method="POST" id="home-edit-form" class="mt-5">
    <div class="row">
        <?php for ($i = 1; $i <= 2; $i++) : ?>
            <div class="col">
                <div class="form-group">
                    <label for="emplacement<?= $i ?>">Emplacement #<?= $i ?></label>
                    <select class="form-control" id="emplacement<?= $i ?>" name="emplacement[]">
                        <option value="">choisissez :</option>
                        <?php foreach ($categories as $category) : ?>
                            <option <?= ($category->getHomeOrder() == $i) ? "selected" : ""; ?> value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <div class="row">
        <?php for ($i = 3; $i <= 5; $i++) : ?>
            <div class="col">
                <div class="form-group">
                    <label for="emplacement<?= $i ?>">Emplacement #<?= $i ?></label>
                    <select class="form-control" id="emplacement<?= $i ?>" name="emplacement[]">
                        <option value="">choisissez :</option>
                        <?php foreach ($categories as $category) : ?>
                            <option <?= ($category->getHomeOrder() == $i) ? "selected" : ""; ?> value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>

<script>
    //cible tous les <select> du form
    var allSelect = document.querySelectorAll("#home-edit-form select");

    //fonction qui est appelée quand on change la valeur d'un select
    function handleChange(event) {
        for (var i = 0; i < allSelect.length; i++) {
            allSelect[i].style.borderColor = "#ced4da";
        }

        for (var i = 0; i < allSelect.length; i++) {

            for (var k = 0; k < allSelect.length; k++) {
                if (allSelect[i].value === allSelect[k].value && i !== k) {
                    allSelect[i].style.borderColor = "#F0F";
                    allSelect[k].style.borderColor = "#F0F";

                }
            }
        }
    }

    //met tous les select sous écoute de l'événement "change"
    for (var i = 0; i < allSelect.length; i++) {
        allSelect[i].addEventListener("change", handleChange);
    }
</script>