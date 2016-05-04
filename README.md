# Giphy SDK PHP [![Build Status](https://secure.travis-ci.org/SnipesCode/giphy.png?branch=master)](http://travis-ci.org/SnipesCode/giphy)

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

### Usage
#### Upload an animated GIF
``` php
<?php
$giphy = new Giphy('api_key', 'username'));
$giphy->upload('http://media2.giphy.com/media/YvJr0wQP8yR8I/giphy.gif', array('Kirk (Alternate)', 'Star Trek (2009)', 'Kobayashi Maru'));

```

# Documentation

#### __construct($apiKey,

#### upload

@param $apiKey
@param $username
@param array $config
     
####  __construct($apiKey, $username, $config = array())

@param string $file Could be a file or URL
@tags array

#### upload($file, $tags)

#### Contributions

At SnipesCode we are glad to receive contributions from the community.
