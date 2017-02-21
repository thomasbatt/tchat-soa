
// http://putaindecode.io/fr/articles/js/de-jquery-a-vanillajs/
// Version ultra-uber-complète-de-la-mort : https://api.jquery.com/jQuery.ajax/
// Pour faire des get : https://api.jquery.com/jQuery.get/
// Pour faire des post : https://api.jquery.com/jQuery.post/

// On va donc utiliser plus souvent :
// $.get pour les GET
// $.post pour les POST

// Le code suivant va récupérer le contenu de l'url indiquée et afficher son contenu dans une alert :
$.get('http://192.168.1.95/dev/ajax/testajax.php', function(resultat)
{
	alert(resultat);
});
// Quand vous lisez ce qu'il y a dans la popup d'alerte, vous voyez la meme chose que si vous emmenez votre navigateur a l'url en question
// On n'oublie pas que nous sommes en MVC et qu'il faut donc respecter quelques règles :
$.get('http://192.168.1.95/dev/ajax/index.php?page=phrase', function(resultat)
{
	alert(resultat);
});
// Ou mieux encore :
$.get('http://192.168.1.95/dev/ajax/phrase', function(resultat)
{
	alert(resultat);
});
// Si vous allez sur ces 3 urls, vous verrez que vous avez la meme chose dans l'alert que ce qu'il s'affiche dans la page

// Du coup vous avez accès a vos contenus php directement via le JS

// En utilisant des requêtes POST vous pouvez même valider un formulaire :
$.post('http://192.168.1.95/dev/ajax/login', {login:"toto",password:"azerty"}, function(resultat)
{
	alert(resultat);
});
// Ici on va tomber sur le fichier de traitement traitement_register.php, en cas d'erreur, resultat contiendra la page de register,
// en cas de succès le contenu de la page vers laquelle on a redirigé l'utilisateur
// Si ca marche pour le register... On va pouvoir le faire pour tout et n'importe quoi !
// Genre... deplacer un ticket ?
$.post('http://192.168.1.95/dev/ajax/ticket', {action:"deplacer",id_ticket:"42"}, function(resultat)
{
	alert(resultat);
});
// Tadaaaa !