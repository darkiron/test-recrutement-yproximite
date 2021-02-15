# Test recrutement Y-proximité

![CI](https://github.com/Yproximite/test-recrutement/workflows/CI/badge.svg)
![CI (develop)](https://github.com/Yproximite/test-recrutement/workflows/CI/badge.svg?branch=develop)

**Accès :**

- Local : http://test-recrutement.vm
- Local (dev) : http://test-recrutement.vm:8000
- Local (prod) : http://test-recrutement.vm:8001

## Présentation

Ce projet "test de recrutement" est un blog simpliste avec quelques fonctionnalités :

- partie front :
    - listing des articles
    - voir un article
    - afficher les commentaires d'un article
    - écrire un commentaire sous un article
    - listing des catégories
    - listing des articles dans une catégorie
- partie admin :
    - listing des articles
    - édition d'un article
    - suppression d'un article

### But du test

- Trouver et patcher les bugs
- Refactoriser / optimiser au besoin

### Linting

PHPStan, PHPUnit et PHP-CS-Fixer sont installés et configurés.

## Requirements

### Dev

- make
- [VirtualBox 5.2.4+](https://www.virtualbox.org/wiki/Downloads)
- [Vagrant 2.2.1+](https://www.vagrantup.com/downloads.html)
- [Vagrant Landrush 1.2.0+](https://github.com/vagrant-landrush/landrush)

## Lancer pour la première fois la VM

Depuis le dossier racine du projet, faire:

    $ make setup
    $ vagrant ssh
    $ make install-app

## Opérations de maintenance

### Démarrer la VM

    # à executer en dehors de la VM
    $ vagrant up

### Se connecter à la VM

    # à executer en dehors de la VM
    $ vagrant ssh
