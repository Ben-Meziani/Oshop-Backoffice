<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Type;
use App\Models\Tag;

class ProductController extends CoreController
{

    /**
     * Méthode s'occupant de la liste des catégories
     *
     * @return void
     */
    public function list()
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);
        
        $products = Product::findAll("product", "Product");

        $this->show('product/list', ["products" => $products]);
    }


    public function add()
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);
     
        if (!empty($_POST)) {
            $name = strip_tags(filter_input(INPUT_POST, 'name'));
            $description = strip_tags(filter_input(INPUT_POST, 'description'));
            $picture = strip_tags(filter_input(INPUT_POST, 'picture'));
            $price = strip_tags(filter_input(INPUT_POST, 'price'));
            $status = strip_tags(filter_input(INPUT_POST, 'status'));
            $brandId = strip_tags(filter_input(INPUT_POST, 'brand_id'));
            $categoryId = strip_tags(filter_input(INPUT_POST, 'category_id'));
            $typeId = strip_tags(filter_input(INPUT_POST, 'type_id'));

            $product = new Product();
            $product->setName("$name");
            $product->setDescription("$description");
            $product->setPicture("$picture");
            $product->setPrice($price);
            $product->setStatus($status);
            $product->setBrandId($brandId);
            $product->setCategoryId($categoryId);
            $product->setTypeId($typeId);

            if ($product->insert()) {
                $_SESSION['alert'] = "Votre produit a bien été ajouté!";
                $this->redirectToRoute("product-list");
                die();
            }
        }
        $brands     = Brand::findAll("brand", "Brand");
        $categories = Category::findAll("category", "Category");
        $types      = Type::findAll("type", "Type");
        $this->show('product/add', [
            "brands"     => $brands,
            "categories" => $categories,
            "types"      => $types
        ]);
    }

    public function edit($productId)
    {

        $product     = Product::find($productId, "product", "Product");
        $productTags = Tag::findProductTags($productId);
        $allTags     = Tag::findAll("tag", "Tag");

        $this->checkAuthorization(["admin", "catalog-manager"]);

        $product = Product::find($productId, "product", "Product");

        // si le formulaire d'ajout d'un tag est rempli
        if (!empty($_POST['tag_id'])) {
            $tag = strip_tags(filter_input(INPUT_POST, 'tag_id'));
            //dump($tag);
            if ($product->insertNewProductTag($tag)) {
                $_SESSION['alert'] = "Le(s) tag(s) est bien ajouté !";
                $this->redirectToRoute('product-edit', ['id' => $product->getId()]);
            } elseif (!empty($_POST)) {
                $name = strip_tags(filter_input(INPUT_POST, 'name'));
                $description = strip_tags(filter_input(INPUT_POST, 'description'));
                $picture = strip_tags(filter_input(INPUT_POST, 'picture'));
                $price = strip_tags(filter_input(INPUT_POST, 'price'));
                $status = strip_tags(filter_input(INPUT_POST, 'status'));
                $brandId = strip_tags(filter_input(INPUT_POST, 'brand_id'));
                $categoryId = strip_tags(filter_input(INPUT_POST, 'category_id'));
                $typeId = strip_tags(filter_input(INPUT_POST, 'type_id'));

                $product->setName("$name");
                $product->setDescription("$description");
                $product->setPicture("$picture");
                $product->setPrice("$price");
                $product->setStatus("$status");
                $product->setBrandId($brandId);
                $product->setCategoryId($categoryId);
                $product->setTypeId($typeId);

                if ($product->update($productId)) {
                    $_SESSION['alert'] = "Le produit a bien été modifié!";

                    $this->redirectToRoute('product-edit', ['id' => $product->getId()]);
                };
            }
        }
        $brands     = Brand::findAll("brand", "Brand");
        $categories = Category::findAll("category", "Category");
        $types      = Type::findAll("type", "Type");

        $this->show('product/edit', compact('product', 'brands', 'categories', 'types', 'productTags', "allTags"));
    }

    public function delete($productId)
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);

        $product = Product::find($productId, "product", "Product");

        if ($product = Product::delete($productId, "product", "Product")) {
            $_SESSION['alert'] = "Le produit a bien été supprimé !";
            $this->redirectToRoute("product-list");
        }
        $this->show('product/delete', ["product" => $product]);
    }
}
