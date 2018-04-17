<?php

namespace App\Http\Controllers;

use Request;
use Session;
use App\modeles\Client;
use App\modeles\Categorie;

class ClientController extends Controller {

    /**
     * Authentifie le client
     * @return Vue formLogin ou home
     */
    public function signIn() {
        $login = Request::input('login');
        $pwd = Request::input('pwd');
        $client = new Client();
        $connected = $client->login($login, $pwd);
        if($connected) {
            return redirect("/");
        } else {
            $erreur = "Login ou mot de passe erroné !";
            return view('formLogin', compact('erreur'));
        }
    }

    /**
     * Déconnecte le visiteur authentifié
     * @return Vue home
     */
    public function signOut() {
        $client = new Client();
        $client->logout();
        return redirect('/');
    }

    /**
     * Initialise le formulaire d'authentification
     * @return type Vue formLogin
     */
    public function getLogin() {
        $erreur = "";
        return view('formLogin', compact('erreur'));
    }

    /**
     * Initialise le formulaire de Compte
     * @return Vue formCompte
     */
    public function getCompte($erreur = '') {
        $id = Session::get('id');
        if($id) {
            $client = (new Client())->getClient($id);
            $categories = (new Categorie())->getCategories();
            // Affiche le formulaire en lui fournissant les données à afficher
            return view('formClient', compact('client', 'categories', 'erreur'));
        } else {
            // Si l'utilisateur n'est pas connecté
            return redirect("/getLogin");
        }
    }

    /**
     * Enregistre la modification du compte
     * @return route /home 
     */
    public function setCompte() {
        $id_client = Session::get('id');
        $identite = Request::input('identite');
        $adresse = Request::input('adresse');
        $id_categorie = Request::input('cbCategorie');
        $login = Request::input('login');
        $pwd = Request::input('pwd');
        
        $client = new Client();
        
        try {
            $client->updateClient($id_client, $identite, $adresse,
                    $login, $pwd, $id_categorie);
        } catch (Exception $ex) {
            $erreur = $ex->getMessage();
            return $this->getCompte($erreur);
        }
        
        return redirect('/');
    }

}
