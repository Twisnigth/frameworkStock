<h1>Ajouter un Produit</h1>

<?php
    if(isset($success)) {
        echo "<div class=\"form-group\">";
        echo "<p class=\"success\">".$success."</p>";
        echo "</div>";
        echo "<a class=\"btn btn-primary\" href=\"/stock/index\">Retourner à l'accueil</a>";
    }
    if(isset($error)) {
        echo "<div class=\"form-group\">";
        echo "<p class=\"error\">".$error."</p>";
        echo "</div>";
        echo "<a class=\"btn btn-primary\" href=\"/stock/index\">Retourner à l'accueil</a>";
    }
?>

<form action="/stock/add" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nom">Nom : </label>
        <input type="text" name="nom" maxlength="100" required>
    </div>
    <div class="form-group">
        <label for="quantite">Quantité : </label>
        <input type="number" name="quantite" min="0" required>
    </div>
    <div class="form-group">
        <label for="prix_ht">Prix HT : </label>
        <input type="number" id="prix_ht" name="prix_ht" step="0.01" min="0" required onchange="calculateTTC()">
    </div>
    <div class="form-group">
        <label for="taux_tva">Taux TVA (%) : </label>
        <input type="number" id="taux_tva" name="taux_tva" step="0.1" min="0" value="20" required onchange="calculateTTC()">
    </div>
    <div class="form-group">
        <label for="prix_ttc">Prix TTC (calculé automatiquement) : </label>
        <input type="number" id="prix_ttc" name="prix_ttc" step="0.01" min="0" readonly>
    </div>

    <script>
    function calculateTTC() {
        // Récupérer les valeurs et les convertir en nombres
        const prixHT = parseFloat(document.getElementById('prix_ht').value) || 0;
        const tauxTVA = parseFloat(document.getElementById('taux_tva').value) || 0;

        if (prixHT > 0) {
            // Calcul du prix TTC : Prix HT × (1 + Taux TVA / 100)
            const prixTTC = prixHT * (1 + (tauxTVA / 100));

            // Afficher le résultat avec 2 décimales
            document.getElementById('prix_ttc').value = prixTTC.toFixed(2);

            // Afficher le calcul pour vérification (à des fins de débogage)
            console.log(`Calcul TTC: ${prixHT} × (1 + ${tauxTVA}/100) = ${prixTTC.toFixed(2)}`);
        }
    }

    // Calculer le prix TTC au chargement de la page
    document.addEventListener('DOMContentLoaded', calculateTTC);
    </script>
    <div class="form-group">
        <label for="image">Image : </label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="zone_id">Zone de stockage : </label>
        <select name="zone_id" required>
            <option value="">Sélectionnez une zone</option>
            <?php foreach($zones as $zone):
                $occupation = $zonesOccupation[$zone['id']];
                $disabled = !$occupation['disponible'] ? 'disabled' : '';
                $status = "Produits dans cette zone: {$occupation['occupation']}";
            ?>
                <option value="<?= $zone['id'] ?>" <?= $disabled ?>>
                    <?= $zone['libelle'] ?> - <?= $status ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Valider">
    </div>
</form>
