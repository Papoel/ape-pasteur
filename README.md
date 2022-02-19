
# APERP - Le blog

Cette application est à la fois un blog et un gestionnaire d'évenements.
Il est destiné à l'école primaire Pasteur de Rousies, et il sera
géré par la preésidente de l'association des parents d'élèves.

Cette application aura une artie blog classique avec toutes les actions CRUD
classique et aura également une partie **Evenements** qui permettra
de creer des évenemt aux quels il sera possible de s'inscrire directement depuis le site.

Début du projet : Janvier 2022.
## Badges

Add badges from somewhere like: [shields.io](https://shields.io/)

[![MIT License](https://img.shields.io/apm/l/atomic-design-ui.svg?)](https://github.com/tterb/atomic-design-ui/blob/master/LICENSEs)


## Technologies

**Client:** Twig, TailwindCSS

**Server:** Symfony 6, PostgresSql

## Pré-Requis => **A COMPLETER**

- **PHP >= 8.0**
- **Node >= 14**## Color Reference

### Charte Graphique

**TODO : A COMPLETER PAR LES COULEURS DE LA CHARTE**

| Color           | Hex                                                                  |
|-----------------|----------------------------------------------------------------------|
| Example Color   | ![#0a192f](https://via.placeholder.com/10/0a192f?text=+) #0a192f     |
| Example Color   | ![#f8f8f8](https://via.placeholder.com/10/f8f8f8?text=+) #f8f8f8     |
| Example Color   | ![#00b48a](https://via.placeholder.com/10/00b48a?text=+) #00b48a     |
| Example Color   | ![#00d1a0](https://via.placeholder.com/10/00b48a?text=+) #00d1a0     |


## Installation

Installer ape-pasteur avec composer

```bash
  git clone ....
  # ou télécharger le zip depuis 
  # https://github.com/Papoel/ape-pasteur
```

Une fois le projet cloné ou téléchargé

```bash
  npm install ape-pasteur
  cd ape-pasteur
  
  # Télécharger les dépéndences de Symfony
    composer install
  
  # Télécharger les dépendences de Webpack
    yarn install
```

Exécuter maintenant Docker et lancer le serveur de Symfony

```bash
docker-compose up -d
symfony serve -d
```

Ouvrez votre navigateur à la page `https://127.0.0.1:8000`

Identifiants de connexion :

| Email          | Mot de passe  |
|----------------|---------------|
| admin@email.fr | password      |
| user1@email.fr | password      |

Lancer le Mailer :

Lancer PgAdmin4 avec les informations ci-dessous :

`http://127.0.0.1:5050`

| Champs                       | Informations                 |
|------------------------------|------------------------------|
| ----- HomePage PgAdmin ----- | ----- HomePage PgAdmin ----- |
| Email Address / Username     | admin@admin.com              |
| password                     | root                         |
| ----- SERVER -----           | ----- CONNECTION -----       |
| Host                         | database                     |
| Port                         | 5432                         |
| Maintenance database         | app                          |
| Username                     | symfony                      |
| Password                     | ChangeMe                     |

Dans la partie Générale vous êtes libre de mettre le nom de votre choix.



## Fonctionnalités à déveloper

1. Light / Dark mode 
2. Panel administration 
3. Dashboard User Profile 
4. Création et gestion des Événements 
5. Autoriser l'accès au site si User est autorisé

## Fonctionnalité en Développement

- 1 - 19/02

## Auteur

- [@Papoel](https://www.github.com/Papoel)

