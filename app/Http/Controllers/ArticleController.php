<?php

namespace App\Http\Controllers;

/* A compléter */
use App\modeles\Domaine;
use App\modeles\Article;
use Session;
use Request;

class ArticleController extends Controller {

    /**
     * Initialise le formulaire de Recherche
     * @return Vue formRecherche
     */
    public function getRecherche($erreur = '') {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        $domaine = new Domaine();
        $domaines = $domaine->getDomaines();
        return view('formRecherche', compact('domaines', 'erreur'));
    }

    /**
     * Récupère la liste des articles du domaine
     * sélectionné dans formRecherche
     * @param int $id : id du domaine ou rien
     * @return vue /listeArticles 
     */
    public function getArticles($id_domaine = 0) {
        $erreur = "";
        if($id_domaine == 0) {
            // On récupère l'ID du domaine sélectionné
            $id_domaine = Request::input('cbDomaine');
        }
        
        // Si on a un ID de domaine
        if($id_domaine) {
            $article = new Article();
            // On récupère la liste de tous les articles du domaine choisi
            $articles = $article->getArticles($id_domaine);
            // On récupère le domaine choisi
            $domaine = (new Domaine())->getDomaine($id_domaine);
            // On affiche la liste de ces mangas
            return view('listeArticles', compact('articles', 'domaine', 'erreur'));
        } else {
            $erreur = "Il faut sélectionner un domaine !";
            Session::put('erreur', $erreur);
            return redirect('/getRecherche');
        }
    }

    /**
     * Lecture d'un Article sur son id
     * @param int $id : id de l'article
     * @return vue /detailArticle 
     */
    public function getArticle($id) {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        
        $article = (new Article())->getArticle($id);
        $domaine = (new Domaine())->getDomaine($article->id_domaine);
        return view('detailArticle', compact('article', 'domaine', 'erreur'));
    }

}
