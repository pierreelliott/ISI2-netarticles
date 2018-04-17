<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use DB;

class Panier extends Model {

    private $basket;
    private $totalPanier;

    public function __construct() {
        $this->basket = Session::get('basket');
    }

    public function getTotalPanier() {
        return $this->totalPanier;
    }

    /**
     * Ajoute l'article au Panier s'il
     * n'y est pas déjà
     * @param int $id_article
     * @return boolean : vrai si l'ajout s'est fait, faux sinon
     */
    public function ajoutPanier($id_article) {
        $existe = $this->dansPanier($id_article);
        if (!$existe) {
            $this->basket[] = $id_article;
            Session::put('basket', $this->basket);
        }
        return $existe;
    }

    /**
     * Retourn vrai si un article est déjà présent
     * dans le panier sinon retourne faux
     * @param int $id_article : id de l'article à rechercher
     * @return boolean
     */
    private function dansPanier($id_article) {
        $existe = false;
        if ($this->basket != null) {
            foreach ($this->basket as $article_id) {
                if ($id_article == $article_id) {
                    $existe = true;
                }
            }
        }
        return $existe;
    }

    /**
     * Supprime un Article du Panier
     * @param int $id_article
     */
    public function supprimePanier($id_article) {
        unset($this->basket[array_search($id_article, $this->basket)]);
        Session::put('basket', $this->basket);
    }

    /**
     * Récupère les articles du panier
     * @return Collection d'Articles
     */
    public function getPanier() {
        $articles = array();
        $article = new Article();
        $this->totalPanier = 0;
        foreach ($this->basket as $id_article) {
            $art = $article->getArticle($id_article);
            $articles[] = $art;
            $this->totalPanier += $art->prix;
        }
        return $articles;
    }

    /**
     * Vide totalement le panier
     */
    public function videPanier() {
        Session::forget('basket');
    }

}
