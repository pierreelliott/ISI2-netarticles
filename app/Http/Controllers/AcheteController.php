<?php

namespace App\Http\Controllers;

/* A compléter */
use App\modeles\Achete;
use Session;

class AcheteController extends Controller {

    /**
     * Valide le Panier
     * Lecture de tous les articles figurant dans le panier
     * @return vue /listeAcquisitions 
     */
    public function getAchats() {
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        $id_client = Session::get('id');
        $achat = new Achete();
        $achats = $achat->getAchats($id_client);
        return view('listeAchats', compact('achats', 'erreur'));
    }

}
