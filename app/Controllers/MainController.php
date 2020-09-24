<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\AppUser;



class MainController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
 
        $homeCategories = Category::findAllBackOfficeHomepage();

        $homeProducts = Product::findAllBackOfficeHomepage();

        $this->show('main/home', ["categories" => $homeCategories,
                                  "products"   => $homeProducts]);
    }
}
