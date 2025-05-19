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