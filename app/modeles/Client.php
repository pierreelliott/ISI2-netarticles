<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use DB;

class Client extends Model {

    /**
     * Authentifie le client sur son login et Mdp
     * Si c'est OK, son id est enregistré dans la session
     * Cela lui donne accès au menu général (voir page master)
     * @param string $login : Login du client
     * @param string $pwd : MdP du client
     * @return boolean : True or false
     */
    public function login($login, $pwd) {
        $connected = false;
        $client = DB::table('client')
                ->select()
                ->where('login_client', '=', $login)
                ->first();
        if ($client) {
            // Si le mdp saisi est identique au mdp enregistré
            if ($client->pwd_client == $pwd) {
                Session::put('id', $client->id_client);
                $connected = true;
            }
        }
        return $connected;
    }

    /**
     * Délogue le visiteur en supprimant son Id 
     * de la session => le menu n'est plus accessible
     * et vide le panier
     */
    public function logout() {
        Session::forget('id');
        $panier = new Panier();
        $panier->videPanier();
    }

    /**
     * Récupère le client sur son id
     * @param int $id : id du client
     * @return object Client
     */
    public function getClient($id) {
        $client = DB::table('client')
                ->select()
                ->where('id_client', '=', $id)
                ->first();
        return $client;
    }

    /**
     * Mise à jour d'un Client
     * @param int $id : id du client à modifier
     * @param string $identite : identité du client à modifier
     * @param string $adresse :  adresse du client à modifier
     * @param string $login :  login du client à modifier
     * @param string $pwd :  mot de passe du client à modifier
     * @param int $id_categorie :  id catégorie du client à modifier
     */
    public function updateClient($id, $identite, $adresse, $login, $pwd, $id_categorie) {
        DB::table('client')->where('id_client', '=', $id)
                ->update(['identite_client' => $identite, 'adresse_client' => $adresse,
                    'login_client' => $login, 'pwd_client' => $pwd, 'id_categorie' => $id_categorie]);
    }

    /**
     * Vérifie que le crédit du client est suffisant
     * @param int $id_client Id du client
     * @param int $totalPanier montant total à payer
     * @return boolean
     */
    public function verifieSolvabilite($id_client, $totalPanier) {
        $ok = true;
        $client = $this->getClient($id_client);
        if ($client->credits < $totalPanier)
            $ok = false;
        return $ok;
    }

    /**
     * Défalque le montant des achats du crédit
     * du client. On prend la précaution du try
     * car il y a une contrainte de colonne (credits >=0)
     * @param int $id_client
     * @param decimal $totalPanier
     */
    public function defalqueMontant($id_client, $totalPanier) {
        try {
            $client = $this->getClient($id_client);
            $credits = $client->credits - $totalPanier;
            DB::table('client')->where('id_client', '=', $id_client)
                    ->update(['credits' => $credits]);
        } catch (Exception $ex) {
            throw($ex);
        }
    }

}
