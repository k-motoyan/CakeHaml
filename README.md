# CakeHaml

CakeHaml is haml template engine for cakephp3.  
Using parser of [MtHaml](https://github.com/arnaud-lb/MtHaml).

## Installation

You can install this plugin into your CakePHP application using
[composer](http://getcomposer.org). For existing applications you can add the
following to your `composer.json` file:

```javascript
"require": {
    "k-motoyan/cake-haml": "dev-master"
}
```

And run `php composer.phar update`

## Setup

Add plugin load line to `config/bootstrap.php` file:

```diff
+ Plugin::load('CakeHaml', ['bootstrap' => true]);
```

Set the default ViewClass on the `src/Controller/AppController.php` file:

```diff
  class AppController extends Controller {

+     public $viewClass = 'CakeHaml\\View\\CakeHamlView';
```

You can use haml on all your view files with `.haml` extension.
