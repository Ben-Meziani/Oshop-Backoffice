<?php

namespace App\Controllers;

use App\Models\Type;

class TypeController extends CoreController
{

    /**
     * Méthode s'occupant de la liste des types
     *
     * @return void
     */
    function list()
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

        $types = Type::findAll("type", "Type");

        $this->show('type/list', ["types" => $types]);
    }

    public function add()
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

      
        if (!empty($_POST)) {
            $name = filter_input(INPUT_POST, 'name');

            $type = new Type();
            $type->setName("$name");

            if ($type->insert()) {
                $_SESSION['alert'] = "Le type a bien été ajouté !";
                $this->redirectToRoute("type-list");
            }
        }
        $this->show('type/add');
    }

    public function edit($typeId)
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

        $type = Type::find($typeId, "type", "Type");
        if (!empty($_POST)) {
            $name = strip_tags(filter_input(INPUT_POST, 'name'));

            $type->setName("$name");

            if ($type->update($typeId)) {
                $_SESSION['alert'] = "Le type a bien été modifié !";
                global $router;
                header("Location: " . $router->generate('type-edit', ['typeid' => $type->getId()]));
                die();
            };
        }

        $this->show('type/edit', ["type" => $type]);
    }

    public function footerEdit()
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

        $footerTypes = Type::findAll("type", "Type");

        if (!empty($_POST)) {
            $order = filter_input(INPUT_POST, 'order', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

            foreach ($footerTypes as $type) {
                if (!in_array($type->getId(), $order)) {
                    $footerOrder = 0;
                } else {
                    $footerOrder = array_search($type->getId(), $order) + 1;
                    $type->setFooterOrder($footerOrder);
                }
                $type->setFooterOrder($footerOrder);
                $type->update();
            }
            $_SESSION['alert'] = "La modification a bien été prise en compte !";
            return $this->redirectToRoute("type-list");
        }

        $this->show('type/footer/edit', ["footerTypes" => $footerTypes]);
    }

    public function delete($typeId)
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

        $type = Type::find($typeId, "type", "Type");

        if ($type = Type::delete($typeId, "type")) {
            $_SESSION['alert'] = "Le type a bien été supprimé !";
            $this->redirectToRoute("type-list");
        }
        $this->show('type/delete', ["type" => $type]);
    }
}
