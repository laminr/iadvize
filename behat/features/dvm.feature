# features/ls.feature
Feature: ls
  Dans le but de récuperer des vie de merde (vdm) et les rendre disponiblent
  Je suis une page internet
  j'ai besoin de recupérer les donnés puis de les stocker

Scenario: récupération de VDM
  Given J'appele l'adresse de recupération des VDM
  When 	je récupère un contenu en retour de l'appel du site vdm
  Then 	je filtre sur le champ qui comporte les vdm
  And 	je boucle sur le tous les résultat
  And 	pour chaque élement je recupére le contenu, la date et l'auteur
  When	le contenu n'est pas vide
  Then	j'enregistre les données en base de donnée
  Then	je redirige vers la page qui affiche tous les enregistrement

Scenario: appel de l'API
  Given	 un appel est fait sur l'url de l'api sans paramètre spécifique
  When	 je recois l'appel de l'api
  Then	 je récupère tous les données de la base de donnée
  And	 je les transforme sous forme de tableau corespondant au nom de retour souhaité
  And	 je transforme ma réponse en format json
