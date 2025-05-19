<h1>Détails du Produit</h1>

<div class="stock-details">
    <p><strong>ID :</strong> <?= $data['id'] ?></p>
    <p><strong>Nom :</strong> <?= $data['nom'] ?></p>
    <p><strong>Quantité :</strong> <?= $data['quantite'] ?></p>
    <p><strong>Prix HT :</strong> <?= $data['prix_ht'] ?> €</p>
    <p><strong>Prix TTC :</strong> <?= $data['prix_ttc'] ?> €</p>
    <p><strong>Taux TVA :</strong> <?= $data['taux_tva'] ?> %</p>
    <p><strong>Zone de stockage :</strong> <?= $data['zone_id'] ?></p>

    <?php if(!empty($data['image'])): ?>
    <div class="product-image">
        <img src="/uploads/<?= $data['image'] ?>" alt="<?= $data['nom'] ?>" class="medium-image">
    </div>
    <?php endif; ?>
</div>

<style>
    .product-image {
        margin-top: 20px;
        text-align: center;
    }

    .medium-image {
        max-width: 300px;
        max-height: 300px;
        object-fit: contain;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
    }
</style>

<div class="actions">
    <a class="btn btn-primary" href="/stock/index">Retour à la liste</a>
    <a class="btn btn-secondary" href="/stock/edit/<?= $data['id'] ?>">Modifier</a>
</div>
