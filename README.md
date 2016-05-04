# giphy
Giphy SDK PHP

[![Build Status](https://secure.travis-ci.org/SnipesCode/giphy.png?branch=master)](http://travis-ci.org/SnipesCode/giphy) | [![Build status]

## Requeriments
* PHP 5.4

## Composer
php composer.phar require "snipescode/giphy"

## Gettting Started
# Required:
* Giphy Beta API Key: dc6zaTOxFJmzC
* Username: Your Giphy Username

``` php
<?php
$giphy = new Giphy('api_key', 'username'));
$giphy->upload('http://media2.giphy.com/media/YvJr0wQP8yR8I/giphy.gif', array('Kirk (Alternate)', 'Star Trek (2009)', 'Kobayashi Maru'));

```