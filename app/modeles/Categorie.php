<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
use DB;

class Categorie extends Model
{
    /**
     * Lecture de toutes les catégories 
     * @return Collection de Categorie
     */
    public function getCategories() {
        $categories = DB::table('categorie')
                ->Select()
                ->get();
        return $categories;
    }
    
}
