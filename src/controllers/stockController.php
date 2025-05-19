<?php

class stockController extends Controller{
    public function index() {
        $data = $this->stock->findAll();
        $this->set(compact("data"));
        $this->render();
    }

    public function view($id) {
        $this->set(["data" => $this->stock
            ->find([
                "id" => $id
            ])
        ]);
        $this->render();
    }

    public function add() {
        $zones = $this->zone->findAll();

        $zonesOccupation = [];
        foreach ($zones as $zone) {
            $count = $this->stock->countByZone($zone['id']);
            $zonesOccupation[$zone['id']] = [
                'libelle' => $zone['libelle'],
                'occupation' => $count,
                'disponible' => true
            ];
        }

        $this->set(compact("zones", "zonesOccupation"));

        if(!empty($_POST)) {
            $zone_id = $_POST['zone_id'];

            if (!isset($zonesOccupation[$zone_id]) || !$zonesOccupation[$zone_id]['disponible']) {
                $this->set(["error" => "La zone sélectionnée est pleine. Veuillez choisir une autre zone."]);
            } else {
                $productData = $_POST;

                if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $uploadDir = ROOT . DS . 'public' . DS . 'uploads' . DS;

                    if(!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $filename = time() . '_' . basename($_FILES['image']['name']);
                    $targetFile = $uploadDir . $filename;

                    if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                        $productData['image'] = $filename;
                    }
                }

                // Toujours calculer le prix TTC à partir du prix HT et du taux de TVA
                if(!empty($productData['prix_ht']) && !empty($productData['taux_tva'])) {
                    // Conversion explicite en nombres flottants
                    $prixHT = floatval($productData['prix_ht']);
                    $tauxTVA = floatval($productData['taux_tva']);

                    // Calcul du prix TTC
                    $productData['prix_ttc'] = $prixHT * (1 + ($tauxTVA / 100));

                    // Arrondir à 2 décimales pour éviter les problèmes de précision
                    $productData['prix_ttc'] = round($productData['prix_ttc'], 2);
                }

                if($this->stock->save($productData)) {
                    $this->set(["success" => "Votre produit a bien été enregistré"]);
                } else {
                    $this->set(["error" => "Une erreur est survenue !"]);
                }
            }
        }
        $this->render();
    }

    public function edit($id) {
        $zones = $this->zone->findAll();
        $stock = $this->stock->find($id);

        $zonesOccupation = [];
        foreach ($zones as $zone) {
            $count = $this->stock->countByZone($zone['id'], $id);
            $zonesOccupation[$zone['id']] = [
                'libelle' => $zone['libelle'],
                'occupation' => $count,
                'disponible' => true
            ];
        }

        $this->set(compact("zones", "zonesOccupation", "stock"));

        if(!empty($_POST)) {
            $new_zone_id = $_POST['zone_id'];
            $current_zone_id = $stock['zone_id'];

            if ($new_zone_id != $current_zone_id &&
                (!isset($zonesOccupation[$new_zone_id]) || !$zonesOccupation[$new_zone_id]['disponible'])) {
                $this->set(["error" => "La zone sélectionnée est pleine. Veuillez choisir une autre zone."]);
            } else {
                $productData = $_POST;

                if (!isset($productData['id']) || empty($productData['id'])) {
                    $productData['id'] = $id;
                }


                if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $uploadDir = ROOT . DS . 'public' . DS . 'uploads' . DS;

                    if(!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $filename = time() . '_' . basename($_FILES['image']['name']);
                    $targetFile = $uploadDir . $filename;

                    if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                        if(!empty($stock['image']) && file_exists($uploadDir . $stock['image'])) {
                            unlink($uploadDir . $stock['image']);
                        }
                        $productData['image'] = $filename;
                    }
                } else {
                    if (!empty($stock['image'])) {
                        $productData['image'] = $stock['image'];
                    }
                }


                // Toujours calculer le prix TTC à partir du prix HT et du taux de TVA
                if(!empty($productData['prix_ht']) && !empty($productData['taux_tva'])) {
                    // Conversion explicite en nombres flottants
                    $prixHT = floatval($productData['prix_ht']);
                    $tauxTVA = floatval($productData['taux_tva']);

                    // Calcul du prix TTC
                    $productData['prix_ttc'] = $prixHT * (1 + ($tauxTVA / 100));

                    // Arrondir à 2 décimales pour éviter les problèmes de précision
                    $productData['prix_ttc'] = round($productData['prix_ttc'], 2);
                }

                if($this->stock->save($productData) > 0) {
                    $this->set(["success" => "Votre produit a bien été modifié"]);
                    $stock = $this->stock->find($id);
                } else {
                    $this->set(["error" => "Une erreur est survenue !"]);
                }
            }
        }

        $this->render();
    }

    public function delete($id) {
        $product = $this->stock->find($id);

        if($this->stock->delete(["id" => $id]) > 0) {
            if(!empty($product['image'])) {
                $imagePath = ROOT . DS . 'public' . DS . 'uploads' . DS . $product['image'];
                if(file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $this->set(["success" => "Votre produit a bien été supprimé"]);
        } else {
            $this->set(["error" => "Une erreur est survenue !"]);
        }
        $this->render();
    }

    public function __init() {
        $this->loadModel("zone");
    }
}
