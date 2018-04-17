<?php

namespace App\Http\Controllers;

/* A compléter */
use App\Exceptions\MonException;
use App\modeles\Panier;
use App\modeles\Achete;
use App\modeles\Client;
use App\modeles\Article;
use Session;
use Exception;

class PanierController extends Controller {

    /**
     * Ajoute un article au panier
     * @param int $id : id de l'article à ajouter au panier
     * @return Redirection sur getBasket
     */
    public function addBasket($id_article) {
        $panier = new Panier();
        if($panier->ajoutPanier($id_article)) {
            Session::put('erreur', 'Article déjà présent dans le panier');
        }
        
        return redirect("/getBasket");
    }

    /**
     * Supprime un article du panier
     * @param int $id : id de l'article à supprimer du panier
     * @return Redirection sur getBasket
     */
    public function deleteBasket($id_article) {
        $panier = new Panier();
        $panier->supprimePanier($id_article);
        
        return redirect("/getBasket");
    }

    /**
     * Affiche le Panier
     * Lecture de tous les articles figurant dans le panier
     * @return vue /listePanier 
     */
    public function getBasket() {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        
        $panier = new Panier();
        $articles = $panier->getPanier();
        $total = $panier->getTotalPanier();
        
        return view('listePanier', compact('articles', 'total', 'erreur'));
    }

    /**
     * Valide le Panier
     * Lecture de tous les articles figurant dans le panier
     * @return vue /listPanier ou redurection vers /getAchats
     */
    public function validBasket() {
        $client = new Client();
        $panier = new Panier();
        $articles = $panier->getPanier();
        $id_client = Session::get('id');
        $total = $panier->getTotalPanier();
        
        if($client->verifieSolvabilite($id_client, $total)) {
            try {
                (new Achete())->ajoutArticles($id_client, $articles);
                $client->defalqueMontant($id_client, $total);
                $panier->videPanier();
            } catch (Exception $ex) {
                $erreur = $this->gestionErreurAjout($ex);
                Session::put('erreur', $erreur);
                return redirect("/getBasket");
            }
        } else {
            $erreur = "Crédits insuffisants ! Il vous manque ". ($total - $client->getClient($id_client)->credits) ." crédits.";
            Session::put('erreur', $erreur);
            return redirect("/getBasket");
        }
        return redirect("/getAchats");
    }
    
    /**
     * Traite les erreurs lancées pendant l'achat d'articles
     * Renvoie un String plus agréable à lire par l'utilisateur
     * @param Exception $ex Exception à traiter
     * @return String Message d'erreur à afficher à l'utilisateur
     * @see MonException
     */
    private function gestionErreurAjout(Exception $ex) {
        $erreur = "";
        if($ex instanceof MonException) {
            $numArticle = $ex->getNumArticle();
            $article = (new Article)->getArticle($numArticle);
            $erreur = "L'article numéro ".$numArticle." (''".$article->titre."'') a déjà été commandé.";
        } else {
            $erreur = $ex->getMessage();
        }
        return $erreur;
    }

}
