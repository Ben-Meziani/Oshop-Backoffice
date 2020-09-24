<?php

namespace App\Controllers;

use App\Models\Brand;

class BrandController extends CoreController
{

    /**
     * Méthode s'occupant de la liste des marques
     *
     * @return void
     */
    public function list()
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

        $brands = Brand::findAll("brand", "Brand");

        $this->show('brand/list', ["brands" => $brands]);
    }

    public function add()
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

        if (!empty($_POST)) {
            $name = filter_input(INPUT_POST, 'name');

            $brand = new Brand();
            $brand->setName("$name");

            if ($brand->insert()) {
                $_SESSION['alert'] = "La marque a bien été ajoutée!";
                $this->redirectToRoute("brand-list");
            }
        }
        $this->show('brand/add');
    }

    public function edit($brandId)
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

        $brand = Brand::find($brandId, "brand", "Brand");

        if (!empty($_POST)) {
            $name = strip_tags(filter_input(INPUT_POST, 'name'));
            $subtitle = strip_tags(filter_input(INPUT_POST, 'subtitle'));
            $picture = strip_tags(filter_input(INPUT_POST, 'picture'));

            $brand->setName("$name");

            if ($brand->update($brandId)) {
                $_SESSION['alert'] = "La marque a bien été modifiée!";
                global $router;
                header("Location: " . $router->generate('brand-edit', ['brandid' => $brand->getId()]));
                die();
            };
        }

        $this->show('brand/edit', ["brand" => $brand]);
    }

    public function footerEdit()
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

        $footerBrands = Brand::findAll("brand", "Brand");

        if (!empty($_POST)) {
            $order = filter_input(INPUT_POST, 'order', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

            foreach ($footerBrands as $brand) {
                if (!in_array($brand->getId(), $order)) {
                    $footerOrder = 0;
                } else {
                    $footerOrder = array_search($brand->getId(), $order) + 1;
                    $brand->setFooterOrder($footerOrder);
                }
                $brand->setFooterOrder($footerOrder);
                $brand->update();
            }
            $_SESSION['alert'] = "La modification a bien été prise en compte !";
            return $this->redirectToRoute("brand-list");
        }

        $this->show('brand/footer/edit', ["footerBrands" => $footerBrands]);
    }

    public function delete($brandId)
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

        $brand = Brand::find($brandId, "brand", "Brand");

        if ($brand = Brand::delete($brandId, "brand")) {
            $_SESSION['alert'] = "La marque a bien été supprimée!";
            $this->redirectToRoute("brand-list");
        }
        $this->show('category/delete', ["brand" => $brand]);
    }
}
