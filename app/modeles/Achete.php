<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\MonException;
use DB;
use Exception;

class Achete extends Model {

    /**
     * Insère les articles acquis dans la table achete
     * @param int $id_client : id du client qui a acquis les articles
     * @param Collection $articles : les articles acquis
     */
    public function ajoutArticles($id_client, $articles) {
        $date_achat = date("Y-m-d");
        $num = 0;
        DB::beginTransaction();
        try {
            foreach ($articles as $article) {
                // ======================
                // Ajout gestion de l'article fautif
                $num = $article->id_article;
                // ======================
                
                DB::table('achete')->insert(
                        ['id_client' => $id_client, 'id_article' => $article->id_article,
                            'date_achat' => $date_achat]
                );
            }
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            if($ex->getCode() == 23000) {
                $ex = new MonException($num, "Cet article a déjà été commandé", 23000);
            }
            throw($ex);
        }
    }

    /**
     * Récupère la liste des achats du client
     * @param int $id_client dont on veut les achats
     * @return collection d'achats
     */
    public function getAchats($id_client) {
        $achats = DB::table('article')
                ->join('domaine', 'article.id_domaine', '=', 'domaine.id_domaine')
                ->join('achete', 'article.id_article', '=', 'achete.id_article')
                ->select('article.id_article', 'article.titre', 'domaine.libdomaine', 'achete.date_achat')
                ->where('achete.id_client', '=', $id_client)
                ->get();
        return $achats;
    }

}
