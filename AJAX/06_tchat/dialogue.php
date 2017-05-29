<?php
require_once('inc/init.inc.php');

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Dialogue</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div id="conteneur">
            <h2 id="moi">Bonjour <?php echo $_SESSION['pseudo']; ?></h2>
            <div id="message_tchat" ></div>
            <div id="liste_membre_connecte" ></div>
            <div class="clear" ></div>
            <div id="smiley" > 
                <img src="smil/smiley1.gif" alt=":)">
                <img src="smil/smiley2.gif" alt=":)">
                <img src="smil/smiley3.gif" alt=":)">
                <img src="smil/smiley4.gif" alt=":)">
                <img src="smil/smiley5.gif" alt=":)">
                <img src="smil/smiley6.gif" alt=":)">
                <img src="smil/smiley7.gif" alt=":)">
                <img src="smil/smiley8.gif" alt=":)">
                <img src="smil/smiley9.gif" alt=":)">
                <img src="smil/smiley10.gif" alt=":)">
                <img src="smil/smiley11.gif" alt=":)">
                <img src="smil/smiley12.gif" alt=":)">
                <img src="smil/smiley13.gif" alt=":)">
                <img src="smil/smiley14.gif" alt=":)">
                <img src="smil/smiley15.gif" alt=":)">
                <img src="smil/smiley16.gif" alt=":)">
                <img src="smil/smiley17.gif" alt=":)">
                <img src="smil/smiley18.gif" alt=":)">
                <img src="smil/smiley19.gif" alt=":)">
                <img src="smil/smiley20.gif" alt=":)">
                <img src="smil/smiley21.gif" alt=":)">
                <img src="smil/smiley22.gif" alt=":)">
                <img src="smil/smiley23.gif" alt=":)">
                <img src="smil/smiley24.gif" alt=":)">
                <img src="smil/smiley25.gif" alt=":)">
                <img src="smil/smiley26.gif" alt=":)">
                <img src="smil/smiley27.gif" alt=":)">
                <img src="smil/smiley28.gif" alt=":)">
            </div>

            <!--Formulaire-->
            <div id="formulaire_tchat">
                <form id="form">
                    <textarea name="message" id="message" maxlength="300" rows="5"></textarea> <br>
                    <input type="submit" name="envoi" value="envoi" class="submit">
                </form>
            </div>
            <div id="postMessage"></div>
        </div>

        <script>
            // Faire en sorte que si l'utilisateur apuie sur la touche "entrée" cela envoie le message. (code de la touche entrée : 13) 
            // Site qui permet de donner les codes de chaque touche du clavier : http://keycode.info
            document.addEventListener("keypress", function(event){
                if(event.keyCode == 13){ 
                    event.preventDefault(); 
                    var messageValeur = document.getElementById("message").value;
                    ajax("postMessage",messageValeur);
                    ajax("message_tchat");
                    document.getElementById("message").value="";
                }
            });


            // Ajout de :) dans le message lors du clic sur le smiley :
            document.getElementById("smiley").addEventListener("click", function(event){
                //document.getElementById("message").value = document.getElementById("message").value + event.target.alt;
                //document.getElementById("message"). focus();

                document.getElementById("message").value = document.getElementById("message").value + '<img src="'+event.target.src+'"/>';
                document.getElementById("message"). focus();
            });


            //Pour récupérer la liste des messages connectés:
            setInterval("ajax(liste_membre_connecte)", 3333);

            //ajax('message_tchat');
            setInterval("ajax(liste_membre_connecte)", 2000);


            // Enregistrement du message via le bouton submit :
            document.getElementById("form").addEventListener("submit", function(e){
                e.preventDefault(); // on bloque le rechargement de page lors de la soumission du formulaire. 

                //ajax("postMessage", message.value); fonctionne mal, il vaut mieux passer par une var comme suit :
                //On récupère la value:
                var messageValeur = document.getElementById("message").value;
                // On envoie notre ajax:
                ajax("postMessage",messageValeur);

                // On envoie une autre requete ajax pour récuperer les massages et les afficher
                ajax("message_tchat");

                //On vide le champ message:
                document.getElementById("message").value="";
            });

            //Fermeture de la page utilisateur :
            // On le retire du fichier prenom.txt
            window.onbeforeunload = function(){
                ajax('liste_membre_connecte', '<?php echo $_SESSION['pseudo']; ?>');
            }


            // Déclaration de la fonction ajax :
            function ajax(mode, arg =''){
                if(typeof(mode) == 'object'){
                    mode = mode.id; // l'argument mode recevra les id des différents élémnts de notre page sachant que l'on peut sélectionner des elements html directement par leur id(ss getElementById...) il y a un irque de récupérer un objet représentant l'élément html. 
                }

                console.log("mode actuel: "+mode);
                var file="ajax_dialogue.php";
                var parametres = "mode="+mode+"&arg="+arg;

                if(window.XMLHttpRequest){
                    var xhttp = new XMLHttpRequest();
                }else{
                    var xhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xhttp.open("POST", file, true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhttp.onreadystatechange = function(){
                    if(xhttp.readyState == 4 && xhttp.status == 200){
                        console.log(xhttp.responseText);
                        var obj = JSON.parse(xhttp.responseText);

                        document.getElementById(mode).innerHTML = obj.resultat;
                        var boiteMessage = document.getElementById("message_tchat");
                        document.getElementById(mode).scrollTop = boiteMessage.scrollHeight;

                    }
                }
                xhttp.send(parametres);
            }


        </script>
    </body>
</html>