<?php

namespace App\Controllers;

use App\Models\Category;

class CategoryController extends CoreController
{

    /**
     * Méthode s'occupant de la liste des catégories
     *
     * @return void
     */
    function list()
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

        $categories = Category::findAll("category", "Category");

        $this->show('category/list', ["categories" => $categories]);
    }

    public function add()
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

        if (!empty($_POST)) {
            $name = filter_input(INPUT_POST, 'name');
            $subtitle = filter_input(INPUT_POST, 'subtitle');
            $picture = filter_input(INPUT_POST, 'picture');

            $category = new Category();
            $category->setName("$name");
            $category->setSubtitle("$subtitle");
            $category->setPicture("$picture");

            if ($category->insert()) {
                $_SESSION['alert'] = "La catégorie a bien été ajoutée!";
                $this->redirectToRoute("category-list");
            }
        }
        $this->show('category/add');
    }

    public function edit($categoryId)
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

        $category = Category::find($categoryId, "category", "Category");

        if (!empty($_POST)) {
            $name = strip_tags(filter_input(INPUT_POST, 'name'));
            $subtitle = strip_tags(filter_input(INPUT_POST, 'subtitle'));
            $picture = strip_tags(filter_input(INPUT_POST, 'picture'));

            $category->setName("$name");
            $category->setSubtitle("$subtitle");
            $category->setPicture("$picture");

            if ($category->update($categoryId)) {
                $_SESSION['alert'] = "La catégorie a bien été modifiée!";
                $this->redirectToRoute("category-list");
            };
        }

        $this->show('category/edit', ["category" => $category]);
    }

    public function homeEdit()
    {
        $categories = Category::findAll("category", "Category");
        $this->checkAuthorization(["admin", "catalog-manager"]);

        if (!empty($_POST)) {
           
            $emplacement = filter_input(INPUT_POST, 'emplacement', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);


            foreach ($categories as $category) {
                if (!in_array($category->getId(), $emplacement)) {
                    $homeOrder = 0;
                } else {
                    $home_order = array_search($category->getId(), $emplacement) + 1;
                    $category->setHomeOrder($home_order);
                }
                $category->setHomeOrder($home_order);
                $category->update();
            }
            return $this->redirectToRoute('home-edit');
        }
        $this->show('category/home/edit', [
            "categories" => $categories,
        ]);
    }



    public function delete($categoryId)
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

        $category = Category::find($categoryId, "category", "Category");

        if ($category = Category::delete($categoryId, "category")) {
            $_SESSION['alert'] = "La catégorie a bien été supprimée!";
            $this->redirectToRoute("category-list");
        }

        $this->show('category/delete', ["category" => $category]);
    }
}
