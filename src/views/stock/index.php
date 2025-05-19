<h1>Gestion des Produits</h1>

<div>
    <a class="btn btn-primary" href="/stock/add">Ajouter un produit</a>
    <a class="btn btn-secondary" href="/zone/index">Zones de stockage</a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Quantité</th>
            <th>Prix HT</th>
            <th>Prix TTC</th>
            <th>Zone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($data as $value) {
                echo "<tr>";
                    echo "<td>".$value["id"]."</td>";
                    echo "<td>".$value["nom"]."</td>";
                    echo "<td>".$value["quantite"]."</td>";
                    echo "<td>".$value["prix_ht"]." €</td>";
                    echo "<td>".$value["prix_ttc"]." €</td>";
                    echo "<td>".$value["zone_id"]."</td>";
                    echo "<td>";
                        echo "<div><a href=\"view/".$value["id"]."\" >Détails</a></div>";
                        echo "<div><a href=\"edit/".$value["id"]."\" >Modifier</a></div>";
                        echo "<div><a href=\"delete/".$value["id"]."\" >Supprimer</a></div>";
                    echo "</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
