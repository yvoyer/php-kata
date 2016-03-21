php-kata
========

[![Build Status](https://travis-ci.org/yvoyer/php-kata.svg?branch=master)](https://travis-ci.org/yvoyer/php-kata)

# Installation

To install the application:

* clone the project `git clone https://github.com/yvoyer/php-kata.git`
* Go at the root of the install folder
* Run `php composer.phar install`

Running unit tests: `bin/phpunit`
Running integration tests: `bin/behat`

## Availables commands

* Starting a kata: `php phpkata.php start {kata-name}`
* Evaluate the kata: `php phpkata.php continue`
* Listing katas: `php phpkata.php list` (Not available yet)
* Reset environment: `php phpkata.php reset` (Not available yet)

[See expected features](https://github.com/yvoyer/php-kata/wiki/Features)

## Contribute

All help is welcome, see [rules](https://github.com/yvoyer/php-kata/CONTRIBUTING.md)


### New Feature

* Fork the project
* Create a branch from the master branch named `feature/{task-number}` (ie. `feature/123`)
* Develop the feature
* Commit and push with a commit message following the standard
* Create a pull request with `master` as the destination.

### New Kata

In order for this project to grow, we need to have more kata implementations. You can follow the same
workflow as the addition of new features, while naming the branch `kata/{kata-name}` (ie. `kata/do-stuff`).

## Commit format

Commit messages should follow this format

    Fix #{task-number} - Short description about feature

    * Add more information about feature
    * Add some more information about feature

Example

    Fix #123 - Add registration of user

    * Add more information about feature
    * Add some more information about feature
