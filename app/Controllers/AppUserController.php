<?php

namespace App\Controllers;

use App\Models\AppUser;

class AppUserController extends CoreController
{

    function list()
    {
        $this->checkAuthorization(["admin"]);
    
        $users = AppUser::findAll("app_user", "AppUser");

        if (!empty($_SESSION['userObject'])) {
            if (($_SESSION['userObject']->getRole()) === "admin") {
                $homeUsers = AppUser::findAllBackOfficeHomePage();
            }
        }

        $this->show('user/list', [
            "users"     => $users,
            "homeUsers" => $homeUsers
        ]);
    }

    public function add()
    {
        $this->checkAuthorization(["admin"]);

        $user = new AppUser();
        $errorList = [];

        if (isset($_POST) && !empty($_POST)) {

            $firstname = strip_tags(filter_input(INPUT_POST, 'firstname'));
            $lastname = strip_tags(filter_input(INPUT_POST, 'lastname'));
            $email = strip_tags(filter_input(INPUT_POST, 'email'));
            $password = strip_tags(filter_input(INPUT_POST, 'password'));
            $role = strip_tags(filter_input(INPUT_POST, 'role'));
            $status = filter_input(INPUT_POST, 'status');

            if ((!empty($firstname)) && (!empty($lastname)) && (!empty($email)) && (!empty($password)) && (!empty($role)) && (!empty($status))) {
               
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $password)) { #^(?=.*[0-9]).{4,}$#
                        
                        $user->setFirstname($firstname);
                        $user->setLastname($lastname);
                        $user->setEmail($email);
                        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                        $user->setRole($role);
                        $user->setStatus($status);

                        if ($user->insert()) {
                            $_SESSION['alert'] = "L'utilisateur a bien été ajouté";
                            $this->redirectToRoute("user-list");
                        }
                    } else {
                        $errorList[] = "Votre mot de passe doit comprendre au moins 8 caractères, une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial !";
                    }
                } else {
                    $errorList[] = "Votre email n'est pas correct !";
                }
                // s'il manque une donnée on affiche un message d'erreur
            } else {
                $errorList[] = "Vous avez oublié de renseigner un champ ou plusieurs !";
            }
        }
        $this->show('user/add', ["errorList" => $errorList]);
    }

    public function logout()
    {
        unset($_SESSION['userId']);
        unset($_SESSION['userObject']);
        $_SESSION['alert'] = "Vous êtes bien déconnecté(e) !";

        $this->redirectToRoute('user-login');
    }

    public function login()
    {
        $appUser = AppUser::findAll("app_user", "AppUser");
        $errorList = [];

        if (!empty($_POST)) {
            $email = strip_tags(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
            $password = strip_tags(filter_input(INPUT_POST, 'password'));

            $appUser = AppUser::findByEmail($email);

            if ($appUser) {
               
                if (password_verify($password, $appUser->getPassword())) {
                    $_SESSION['userId'] = $appUser->getId();
                    $_SESSION['userObject'] = $appUser;
                    $_SESSION['alert'] = "Vous êtes bien connecté(e) !";
                    $this->redirectToRoute('main-home');
                } else {
                    $errorList['password'] = 'Votre mot de passe est incorrect !';
                }
            } else {
                $errorList['email'] = 'Votre adresse email est incorrecte !';
            }
        }
        $this->show('user/login', [
            "appUser"   => $appUser,
            "errorList" => $errorList
        ]);
    }
}
