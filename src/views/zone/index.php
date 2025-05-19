<h1>Gestion des Zones de Stockage</h1>

<div>
    <a class="btn btn-primary" href="/zone/add">Ajouter une zone</a>
    <a class="btn btn-secondary" href="/stock/index">Produits</a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Libellé</th>
            <th>Adresse</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($data as $value) {
                echo "<tr>";
                    echo "<td>".$value["id"]."</td>";
                    echo "<td>".$value["libelle"]."</td>";
                    echo "<td>".$value["rue"].", ".$value["code_postal"]." ".$value["ville"]."</td>";
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
