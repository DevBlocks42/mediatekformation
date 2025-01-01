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

### Backoffice - playlists : ajout/modification/suppression

![playlists](https://github.com/user-attachments/assets/72c027fe-219f-4ca7-813f-bb13f77c77d0)

L'index des playlists permet de réaliser 3 actions : Ajouter, modifier ou supprimer une playlist.

![ajoutmodif_playlist](https://github.com/user-attachments/assets/3bf61ca5-e4e6-4340-8b43-3622db120e51)

L'ajout et la modification se font par l'intermédiaire d'un formulaire, pré-rempli dans le cas d'une modification. Une fois soumis, les changements sont appliqués à la base de données.

![modif_pl_success](https://github.com/user-attachments/assets/4b27e3a6-3907-4aad-98b0-ad82f010dfde)

Message de succès après modification d'une playlist.


