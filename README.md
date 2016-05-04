# giphy
Giphy SDK PHP

[![Build Status](https://secure.travis-ci.org/SnipesCode/giphy.png?branch=master)](http://travis-ci.org/SnipesCode/giphy)

## Requeriments
* PHP 5.5

## Composer
```
php composer.phar require "snipescode/giphy"
```
## Gettting Started
### Required:
* Giphy Beta API Key: dc6zaTOxFJmzC
* Username: Your Giphy Username

### Upload an animated GIF
``` php
<?php
$giphy = new Giphy('api_key', 'username'));
$giphy->upload('http://media2.giphy.com/media/YvJr0wQP8yR8I/giphy.gif', array('Kirk (Alternate)', 'Star Trek (2009)', 'Kobayashi Maru'));

```
#### Contributions

At SnipesCode we are glad to receive contributions from the community.