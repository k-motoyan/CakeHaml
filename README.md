# CakeHaml

CakeHaml is haml template engine of cakephp3.  
Using parser of [MtHaml](https://github.com/arnaud-lb/MtHaml).

## Setup

Change AppController.

```diff
  class AppController extends Controller {

+     public $viewClass = 'CakeHaml\\View\\CakeHamlView';

```

Add plugin load to `config/bootstrap.php`.

```diff
  Plugin::load('DebugKit', ['bootstrap' => true]);
+ Plugin::load('CakeHaml', ['bootstrap' => true]);
```