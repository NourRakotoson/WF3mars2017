<?php
require_once("inc/init.inc.php");





//Affichage
require_once("inc/header.inc.php");
//require_once("inc/nav.inc.php");  si l'on veut ajouter un menu plus tard
?>

    <div class="container">
        <div class="col-sm-6 col-sm-offset-3" id="enregistrer" ></div>

        <div class="col-sm-6 col-sm-offset-3" >
            <h1>
                <span class="glyphicon glyphicon-user" ></span>
                &nbsp;Enregistrer un article
            </h1>
            <form action="ajax.php" id="form">
                <div class="form-group" >
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" name="titre" id="titre" >
                </div>

                <div class="form-group" >
                    <label for="auteur">Auteur</label>
                    <input type="text" class="form-control" name="auteur" id="auteur" >
                </div>

                <div class="form-group" >
                    <label for="contenu">Contenu</label>
                    <textarea name="contenu" id="contenu" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-success"> Enregistrer</button>
            </form>
        </div>

    </div>

    <div class="col-sm-6 col-sm-offset-3" >
            <h1>
                <span class="glyphicon glyphicon-list" style="color: fuchsia" ></span>
                &nbsp;Liste des articles
            </h1>
            <hr>
            <div class="col-sm-12" id="liste" ></div>
    </div>

    


 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
    $(document).ready(function(){

        $("#form").on("submit", function(event){
            event.preventDefault();
            var url = $(this). attr('action');
            var parametres = $(this).serialize() + '&mode=enregistrer';
            console.log(url);
            console.log(parametres);

            $.post(url, parametres, function(reponse){
                $("#enregistrer").html(reponse.resultat);
            }, "json");

        });

        setInterval(liste, 3000);
        function liste(){
            $.post("ajax.php", "mode=liste", function(reponse){
                console.log(reponse);
                $("#liste").html(reponse.resultat);
            }, 'json');
        }
    });
</script>


<?php
require_once("inc/footer.inc.php");
?>