<h1>Ajouter une Zone de Stockage</h1>

<?php
    if(isset($success)) {
        echo "<div class=\"form-group\">";
        echo "<p class=\"success\">".$success."</p>";
        echo "</div>";
        echo "<a class=\"btn btn-primary\" href=\"/zone/index\">Retourner à l'accueil</a>";
    }
    if(isset($error)) {
        echo "<div class=\"form-group\">";
        echo "<p class=\"error\">".$error."</p>";
        echo "</div>";
        echo "<a class=\"btn btn-primary\" href=\"/zone/index\">Retourner à l'accueil</a>";
    }
?>

<form action="/zone/add" method="POST">
    <div class="form-group">
        <label for="libelle">Libellé : </label>
        <input type="text" name="libelle" maxlength="100" required>
    </div>
    <h3>Adresse</h3>
    <div class="form-group">
        <label for="rue">Rue : </label>
        <input type="text" name="rue" maxlength="255" required>
    </div>
    <div class="form-group">
        <label for="code_postal">Code Postal : </label>
        <input type="text" name="code_postal" maxlength="10" required>
    </div>
    <div class="form-group">
        <label for="ville">Ville : </label>
        <input type="text" name="ville" maxlength="100" required>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Valider">
    </div>
</form>
