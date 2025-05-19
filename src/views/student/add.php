<h1>Add Student</h1>

<?php 
    if(isset($success)) {
        echo "<div class=\"form-group\">";
        echo "<p class=\"success\">".$success."</p>";    
        echo "</div>";
        echo "<a class=\"btn btn-primary\" href=\"/student/index\">Retourner à l'accueil</a>";
    }
    if(isset($error)) {
        echo "<div class=\"form-group\">";
        echo "<p class=\"error\">".$error."</p>";
        echo "</div>";
        echo "<a class=\"btn btn-primary\" href=\"/student/index\">Retourner à l'accueil</a>";
    }
?>


</div>
<form action="/student/add" method="POST">
    <div class="form-group">
        <label for="nom">Nom : </label>
        <input type="text" name="nom">
    </div>
    <div class="form-group">
        <label for="prenom">Prénom : </label>
        <input type="text" name="prenom">
    </div>
    <div class="form-group">
        <label for="email">Email : </label>
        <input type="email" name="email">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Valider">
    </div>
</form>


