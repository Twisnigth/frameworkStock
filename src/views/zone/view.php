<h1>Détails de la Zone de Stockage</h1>

<div class="zone-details">
    <p><strong>ID :</strong> <?= $data['id'] ?></p>
    <p><strong>Libellé :</strong> <?= $data['libelle'] ?></p>
    <h3>Adresse</h3>
    <p><strong>Rue :</strong> <?= $data['rue'] ?></p>
    <p><strong>Code Postal :</strong> <?= $data['code_postal'] ?></p>
    <p><strong>Ville :</strong> <?= $data['ville'] ?></p>
</div>

<div class="produits-section">
    <h3>Nombre de produits dans cette zone: <?= $nombreProduits ?></h3>

    <?php if ($nombreProduits > 0): ?>
        <h4>Liste des produits:</h4>
        <ul class="produits-list">
            <?php foreach ($produits as $produit): ?>
                <li>
                    <a href="/stock/view/<?= $produit['id'] ?>"><?= $produit['nom'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun produit n'est stocké dans cette zone.</p>
    <?php endif; ?>
</div>

<div class="actions">
    <a class="btn btn-primary" href="/zone/index">Retour à la liste</a>
    <a class="btn btn-secondary" href="/zone/edit/<?= $data['id'] ?>">Modifier</a>
</div>

<style>
    .produits-section {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .produits-list {
        list-style-type: disc;
        margin-left: 20px;
        padding-left: 20px;
    }

    .produits-list li {
        margin-bottom: 8px;
    }

    .produits-list a {
        text-decoration: none;
        color: #0066cc;
    }

    .produits-list a:hover {
        text-decoration: underline;
    }
</style>
