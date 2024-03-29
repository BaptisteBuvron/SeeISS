# SeeISS
[![Build result](https://github.com/BaptisteBuvron/SeeISS/actions/workflows/build.yml/badge.svg)](https://github.com/BaptisteBuvron/SeeISS/actions/workflows/build.yml)
![Symfony](https://img.shields.io/badge/symfony-%23000000.svg?style=for-the-badge&logo=symfony&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![PHPStorm](http://img.shields.io/badge/-PHPStorm-181717?style=for-the-badge&logo=phpstorm&logoColor=white)


Site internet qui affiche les passages visibles de la Station Spatiale Internationale.

## Etudiant

* [Baptiste Buvron](https://github.com/BaptisteBuvron)

## Getting Started

## Lancer le projet

Installer les dépendances :

```bash
composer install
npm install
```

Créer la base de données si elle n'existe pas :

```bash
php bin/console doctrine:database:create
```

Mettre à jour la base de données :

```bash
php bin/console doctrine:migrations:migrate
```

Lancer le serveur webpack :

```bash
npm run dev-server
```

```bash
php -S localhost:8000 -t public/
```

## Site internet

Voici les différentes fonctionnalités du site internet :

- Affichage des passages visibles de la Station Spatiale Internationale [seeiss.com/](https://seeiss.com/)
- Affichage de la position de la Station Spatiale Internationale en temps réel [seeiss.com/live](https://seeiss.com/live)
- Affichage des informations de la Station Spatiale Internationale [seeiss.com/spacestation/4](https://seeiss.com/spacestation/4)
