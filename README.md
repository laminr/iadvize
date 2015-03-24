
#Test - Développeur PHP iAdvize
##Description du test

Ce test a pour but de mettre en oeuvre une application permettant 2 choses :

1. Permettre à l’aide d’une ligne de commande, d’aller chercher les 200 derniers enregistrements du site “Vie de merde” et de les stocker. (Champs à récupérer : Contenu, Date et heure, et auteur)

2. Permettre la lecture des enregistrements précedemment récupérés à l’aide d’une API REST au format JSON

(voir la description de l’API attendue ci-dessous)

* Vous devez utiliser un framework PHP de votre choix
* Vous avez le choix dans la méthode ou le procédé de stockage
* Vous devez utiliser GIT pour versionner vos fichiers
* Vous devez utiliser Composer pour gérer vos dépendances
* Vous devez tester unitairement votre code
* Vous devez mettre à disposition votre code via Github
* Vous ne devez pas utiliser l’API du site “Vie de Merde” pour récuperer les informations

###Note: 

* La description fonctionnelle via BeHat serait un plus
* Si vous ne parvenez pas à utiliser l’ensemble des eléments requis, n’hésitez pas à présenter tout de même votre test dans sa version la plus aboutie.
* Vous disposez du temps dont vous avez besoin à la bonne réalisation du test

##Description de l’API
#### /api/posts

##### Sortie souhaitée :

```javascript
{
    "posts":[
        {
            "id":1,
            "content":"Aujourd'hui,iAdvizem'ademandéderéaliseruntestdedéveloppeurPHP.",
            "date":"2014-01-0100:00:00",
            "author":"Genius"
        }
    ],
    "count":1
}
```

##### Paramètres :

* from (optionnel) ­ Date de début
* to (optionnel) ­ Date de fin
* author (optionnel) ­ Auteur

##### Utilisation :

* /api/posts
* /api/posts?from=2014­01­01&to=2014­12­31
* /api/posts?author=Genius

####/api/posts/&lt;id/&gt;

##### Sortie souhaitée :
```javascript
{
    "post":{
        "id":1,
        "content":"Aujourd'hui,iAdvizem'ademandéderéaliseruntestdedéveloppeurPHP.",
        "date":"2014-01-0100:00:00",
        "author":"Genius"
    }
}
```