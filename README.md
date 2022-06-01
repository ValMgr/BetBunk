# BetBunk

## Description

BetBunk est une application de quiz en ligne. Elle permet aux utilisateurs de choisir des quiz et d'y jouer. Les utilisateurs peuvent également crée un compte leur permettant de crée eux même des quiz sur la plateforme. Il existe pour le moment deux type de quiz : réponse simple et réponse en catégorie.


## Installation

Base de donnée :
`docker-compose up -d`

Symfony:
`symfony serve`

Appliquer migrations à la bdd:
`php bin/console doctrine:migrations:migrate`

Charger les fixtures dans la bdd:
`php bin/console doctrine:fixtures:load`


## Crédits

- Valentin Magry
- Thomas Afonso
