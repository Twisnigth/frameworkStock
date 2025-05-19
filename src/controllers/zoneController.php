<?php

class zoneController extends Controller{
    public function __init() {
        $this->loadModel("stock");
    }
    public function index() {
        $data = $this->zone->findAll();
        $this->set(compact("data"));
        $this->render();
    }

    public function view($id) {
        // Récupérer les informations de la zone
        $zone = $this->zone->find([
            "id" => $id
        ]);

        // Récupérer tous les produits associés à cette zone
        $produits = $this->stock->findAll([
            "zone_id" => $id
        ]);

        // Compter le nombre de produits
        $nombreProduits = count($produits);

        // Passer les données à la vue
        $this->set([
            "data" => $zone,
            "produits" => $produits,
            "nombreProduits" => $nombreProduits
        ]);

        $this->render();
    }

    public function add() {
        if(!empty($_POST)) {
            if($this->zone->save($_POST)) {
                $this->set(["success" => "Votre zone a bien été enregistrée"]);
            } else {
                $this->set(["error" => "Une erreur est survenue !"]);
            }

        }
        $this->render();
    }

    public function edit($id) {
        $zone = $this->zone->find($id);
        if(!empty($_POST)) {
            if($this->zone->save($_POST) > 0) {
                $this->set(["success" => "Votre zone a bien été modifiée"]);
                $zone = $this->zone->find($id);
            } else {
                $this->set(["error" => "Une erreur est survenue !"]);
            }

        }
        $this->set(compact("zone"));
        $this->render();
    }

    public function delete($id) {
        // Vérifier si la zone contient des produits
        $count = $this->stock->countByZone($id);

        if ($count > 0) {
            // La zone contient des produits, impossible de la supprimer
            $this->set([
                "error" => "Impossible de supprimer cette zone car elle contient encore {$count} produit(s). Veuillez d'abord supprimer ou déplacer ces produits."
            ]);
        } else {
            // La zone est vide, on peut la supprimer
            if($this->zone->delete(["id" => $id]) > 0) {
                $this->set(["success" => "Votre zone a bien été supprimée"]);
            } else {
                $this->set(["error" => "Une erreur est survenue lors de la suppression !"]);
            }
        }
        $this->render();
    }
}