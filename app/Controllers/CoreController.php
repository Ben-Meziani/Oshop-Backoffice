<?php

namespace App\Controllers;

class CoreController
{
    public function __construct()
    {
        global $match;
      
        $currentRouteName = $match['name'];

        $acl = [
           
            'user-login'    => 'anonymous',
            'main-home'     => ['admin', 'catalog-manager'],
            'user-logout'   => ['admin', 'catalog-manager'],
            'user-list'     => ['admin', 'sous-admin'],
            'user-add'      => ['admin', 'sous-admin'],
            'product-add'   => ['admin'],
            'product-edit'  => ['admin', 'catalog-manager'],
            'product-list'  => ['admin', 'catalog-manager'],
            'category-add'  => ['admin', 'catalog-manager'],
            'category-edit' => ['admin', 'catalog-manager'],
            'category-list' => ['admin', 'catalog-manager'],
            'category-delete' => ['admin', 'catalog-manager'],
            'type-add'  => ['admin', 'catalog-manager'],
            'type-edit' => ['admin', 'catalog-manager'],
            'type-list' => ['admin', 'catalog-manager'],
            'type-delete' => ['admin', 'catalog-manager'],
            'type-footer-edit' => ['admin', 'catalog-manager'],
            'brand-add'  => ['admin', 'catalog-manager'],
            'brand-edit' => ['admin', 'catalog-manager'],
            'brand-list' => ['admin', 'catalog-manager'],
            'brand-delete' => ['admin', 'catalog-manager'],
            'brand-footer-edit' => ['admin', 'catalog-manager'],
            'home-edit'     => ['admin', 'catalog-manager'],
        ];

     
        if (!array_key_exists($currentRouteName, $acl)) {
            die('yoooo ! ajoute ta route dans les acls !');
        }

        $allowedRoles = $acl[$currentRouteName];
 
        if ($allowedRoles !== 'anonymous') {
          
            $this->checkAuthorization($allowedRoles);
        }
    }

    protected function checkAuthorization($allowedRoles = [])
    {

        if (empty($_SESSION['userObject'])) {
           
            $_SESSION['alert'] = "Veuillez vous connecter d'abord !";

            $this->redirectToRoute("user-login");
        }
      
        else {
           
            $user = $_SESSION['userObject'];

            $role = $user->getRole();

            if (!in_array($role, $allowedRoles)) {
            
                $errorController = new ErrorController();
                $errorController->err403();

                die();
            }
        }
    }



    protected function validateCsrfToken()
    {
    
        $csrfTokenFromForm = filter_input(INPUT_POST, 'csrf_token');
      
        if ($csrfTokenFromForm !== $_SESSION['csrfToken']) {
         
            $errorController = new ErrorController();
            $errorController->err403();
            die();
        }
    }

    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewVars Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewVars = [])
    {
    
        global $router;

        $viewVars['currentPage'] = $viewName;

        $viewVars['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
       
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];

        extract($viewVars);

        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }

    protected function redirectToRoute($route, $params = [])
    {
        global $router;
        header("Location: " . $router->generate($route, $params));
        die;
    }
}
