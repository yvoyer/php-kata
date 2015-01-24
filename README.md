php-kata
========

[![Build Status](https://travis-ci.org/yvoyer/php-kata.svg?branch=master)](https://travis-ci.org/yvoyer/php-kata)

# Installation

To install the application:

* clone the project `git clone https://github.com/yvoyer/php-kata.git`
* Go at the root of the install folder
* Run `php composer.phar install`

Running unit tests: `phpunit`
Running integration tests: `bin/phpspec run`

## Commands

Starting a kata: `php phpkata.php start {kata-name}` (Not functional yet)
Finish kata: `php phpkata.php finish` (Not available yet)
Listing katas: `php phpkata.php list` (Not available yet)

[See expected features](https://github.com/yvoyer/php-kata/wiki/Features)

## How to collaborate

* Assign yourself a task
* Create a branch from the master branch named `feature/{task-number}` ie. `feature/123`
* Develop the feature
* Commit and push with a commit message following the standard
* Create a pull request for with `master` as destination.

## Commit format

Commit messages should follow this format

    Fix #{task-number} - Short description about feature

    * Add more information about feature
    * Add some more information about feature

Example

    Fix #123 - Add registration of user

    * Add more information about feature
    * Add some more information about feature

