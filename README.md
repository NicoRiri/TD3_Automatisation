# TP Automatisation du developpement - Test - Rendu 3

Mini projet pour le rendu numéro 3 du cours d'automatisation du développement sur les tests.

Ce projet contient seulement 3 classes qui intéragissent entre elle :

- `Person` : Classe qui permet de créer une personne
- `Wallet` : Classe qui permet de créer un portefeuille avec une devise spécifique
- `Product` : Classe qui permet de créer un produit avec une catégorie et une liste de prix par devise.

## 👨‍🎓 Etudiants
- Bernardet Nicolas
- Oudin Clément

## 💻 Technologie utilisées

- PHP 8.2
- PHPUnit 10.5

## 🪛 Installation

````shell
docker compose run --rm php composer install
````

## ✅ Lancement des tests

```sh
docker compose run --rm php composer test:coverage
```

## 🌆 Linter

```sh
docker compose run --rm php composer phpcs
```

```sh
docker compose run --rm php composer phpcs:fix
```

## 🪲 PHPStan

```sh
docker compose run --rm php composer phpstan
```