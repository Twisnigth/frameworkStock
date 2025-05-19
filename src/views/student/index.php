<h1>INDEX</h1>

<div>
    <a class="btn btn-primary" href="/student/add">Ajouter</a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($data as $value) {
                echo "<tr>";
                    echo "<td>".$value["id"]."</td>";
                    echo "<td>".$value["nom"]."</td>";
                    echo "<td>".$value["prenom"]."</td>";
                    echo "<td>".$value["email"]."</td>";
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
