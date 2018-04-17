<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use DB;

class Article extends Model
{  
   /**
    * Récupère l'Article sur son id
    * @param int $id : id de l'article
    * @return object Article
    */
    public function getArticle($id) {
        $connected = false;
        $article = DB::table('article')
                ->select()
                ->where('id_article', '=', $id)
                ->first();
        return $article;
    }   
    
   /**
    * Récupère la liste des Articles appartenant à un domaine
    * @param int $id_domaine : id du domaine dont on veut les articles
    * @return Collection d'Article
    */
    public function getArticles($id_domaine) {
        $articles = DB::table('article')
                ->select()
                ->where('id_domaine', '=', $id_domaine)
                ->get();
        return $articles;
    }
       
}
