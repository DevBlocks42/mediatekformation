# Mediatekformation

Application web permettant la consultation et la mise en ligne de vidéos d'auto-formation.

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
