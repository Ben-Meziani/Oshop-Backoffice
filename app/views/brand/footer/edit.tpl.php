<div class="container my-4">
    <a href="<?= $router->generate('brand-list') ?>" class="btn btn-success float-right">Retour</a>
    <h2>Gestion des marques dans le footer</h2>

    <form action="" method="POST" id="footer-edit-form" class="mt-5">
        <div class="row">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                <div class="col">
                    <div class="form-group">
                        <label for="order<?= $i ?>">N°<?= $i ?></label>
                        <select class="form-control" id="order<?= $i ?>" name="order[]">
                            <option value="">choisissez :</option>
                            <?php foreach ($footerBrands as $footerBrand) : ?>
                                <option <?= ($footerBrand->getFooterOrder() == $i) ? "selected" : ""; ?> value="<?= $footerBrand->getId() ?>"><?= $footerBrand->getName() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            <?php endfor ?>
        </div>
        <div id="errors">

        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>

    <script>
        var allFooterSelect = document.querySelectorAll("#footer-edit-form select");

        function handleChange(event) {
            for (var i = 0; i < allFooterSelect.length; i++) {
                allFooterSelect[i].style.borderColor = "#ced4da";
            }

            for (var i = 0; i < allFooterSelect.length; i++) {
                allFooterSelect[i].style.borderColor = "#ced4da";
            }

            for (var i = 0; i < allFooterSelect.length; i++) {
                for (var j = 0; j < allFooterSelect.length; j++) {
                    if (allFooterSelect[i].value === allFooterSelect[j].value && i !== j) {
                        allFooterSelect[i].style.borderColor = "red";
                        allFooterSelect[j].style.borderColor = "red";
                    }
                }
            }
        }
        for (var i = 0; i < allFooterSelect.length; i++) {
            allFooterSelect[i].addEventListener("change", handleChange);
        }
    </script>