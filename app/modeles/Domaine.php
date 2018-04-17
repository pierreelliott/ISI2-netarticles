<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
use DB;

class Domaine extends Model
{
    /**
     * Lecture de toutes les domaines
     * @return Collection de Domaine
     */
    public function getDomaines() {
        $domaines = DB::table('domaine')
                ->Select()
                ->get();
        return $domaines;
    }
    
    /**
     * Lecture d'un domaine sur son id
     * @param int $id : id du domaine
     * @return objet Domaine
     */
    public function getDomaine($id) {
        $domaine = DB::table('domaine')
                ->Select()
                ->where('id_domaine', '=', $id)
                ->first();
        return $domaine;
    }    
}
