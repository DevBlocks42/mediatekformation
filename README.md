# Mediatekformation

Application web permettant la consultation et la mise en ligne de vidéos d'auto-formation.

Lien de l'application d'origine : https://github.com/CNED-SLAM/mediatekformation

# Présentation des fonctionalités ajoutées
## Backoffice

La partie appellée "backoffice" est la zone du site permettant à l'administrateur de gérer les formations, les playlists et les catégories.

Voici un diagramme des cas résumant les actions possibles via cette espace : 

![diagramme_cas](https://github.com/user-attachments/assets/1877dcb7-7716-4e53-b1f2-64472007a47e)

### Backoffice - ajout et modification de formations 

![Capture d’écran_2025-01-01_14-30-18](https://github.com/user-attachments/assets/a55d1cf5-8b9f-4051-9ccd-351bddeb5231)

L'ajout et la modidification d'une formation se fait depuis un même formulaire, la seule différence est que celui-ci est pré-rempli lorsqu'on ajoute une formation.
Il suffit de modifier ou de remplir le formulaire pour que les informations concernant la formation soient mises à jours après validation du formulaire.

### Backoffice - suppression de formation

![suppr_form](https://github.com/user-attachments/assets/69ff4f76-316f-4a70-bc55-75bf4ac072f1)

Pour supprimer une formation, il faut cliquer sur le bouton rouge avec une icône de corbeille. Un popup de confirmation apparaît, après confirmation, la formation est retirée de la base de données.

### Backoffice - playlists : ajout/modification/suppression

![playlists](https://github.com/user-attachments/assets/72c027fe-219f-4ca7-813f-bb13f77c77d0)

L'index des playlists permet de réaliser 3 actions : Ajouter, modifier ou supprimer une playlist.

![ajoutmodif_playlist](https://github.com/user-attachments/assets/3bf61ca5-e4e6-4340-8b43-3622db120e51)

L'ajout et la modification se font par l'intermédiaire d'un formulaire, pré-rempli dans le cas d'une modification. Une fois soumis, les changements sont appliqués à la base de données.

![modif_pl_success](https://github.com/user-attachments/assets/4b27e3a6-3907-4aad-98b0-ad82f010dfde)

Message de succès après modification d'une playlist.

### Backoffice - catégories

![categories](https://github.com/user-attachments/assets/cf9dcae2-0e02-4a31-9239-45fc5318245c)

La page de gestion des catégories permet de réaliser 2 actions : ajouter et supprimer une catégorie

D'abord, le formulaire a un seul champ en haut de page sert à ajouter une catégorie, le nom de celle-ci doit être unique.

Le bouton rouge avec l'icône de corbeille permet de supprimer une catégorie, mais uniquement si celle-ci n'est référencée par aucune formation.

# Installation

## Installation locale

Pour installer cette application web, il est nécéssaire d'avoir un serveur web d'installé sur sa machine, exemple : LAMP ou WAMP serveur.

Une fois installé, il faut importer la base de données au niveau du SGBD, on peut utiliser phpmyadmin ou l'interface de commande MySQL/Mariadb pour cela.

Ensuite, on peut copier/coller les fichiers du projet dans le répertoire de notre serveur web.

À ce stade, l'application est preque prête, il faut cependant installer tous les bundles et extensions de Symfony et PHP, pour cela on utilise composer : 

  composer install

Le dossier vendor devrait être construit.

Dernière étape : modifier la chaîne de connexion contenue dans le fichier .env en racine du projet avec les bonnes informations de connexion à la base de données.

Le site devrait normalement être opérationnel.

## Installation distante

Les étapes d'installation sur un site distant sont les mêmes. Cependant, il est nécéssaire de prendre en compte certains points techniques et de sécurité :

- Si la connexion au site n'est pas chiffrée (plain HTTP), il ne faudra pas se connecter à la partie backend avant d'avoir mis en place un certificat SSL, au risque de se faire dérober le mot de passe du backoffice.

- Si l'hébergeur ne donne pas d'accès SSH au serveur, il faudra produire le dossier vendor localement (avec composer), puis le téléverser vers le serveur via FTP.

- Dans le cas d'un déploiement continu avec Github, il ne faut pas inclure le fichier .env final qui contient des identifiants pour la base de données, il faudra le téléverser manuellement via FTP (ou autre).

