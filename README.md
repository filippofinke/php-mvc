# php-mvc
Simple MVC base for php

## Windows
> Just edit base folder in .htaccess

### How to 

If your project is in a subfolder edit line 17 of the .htaccess file to
```
RewriteBase /folder/
```

Change your application url in the config.php, edit the line 9 to:
```
define('URL', 'http://YOUR_URL/PATH/');
! IT MUST HAVE THE / AT THE END
```
If you have to use the database class change also the database parameters in the config.php

### Documentation

Render a view:
```php
use Libs\ViewLoader as ViewLoader;

// Render the view at views/home/index.php
ViewLoader::load('home/index');

// Render the view at views/home/index.php 
// with a variable, you can access $variable 
// on the view to get 'Hello World!'
ViewLoader::load('home/index', array(
    'variable' => 'Hello World!'
));
```

Do a redirect:
```php
use Libs\Application as Application;

// Redirect to controller 'controller' and call method 'action'
Application::redirect("controller/action");

! IT MUST BE AT THE END OF YOUR METHOD BECAUSE IT KILLS YOUR SCRIPT
```

Get database connection:
```php
use Libs\Database as Database;

// Get pdo connection
$connection = Database::get();
```

Create a controller:
```php
<?php
namespace Controllers;

// To use Application::redirect(...)
use Libs\Application as Application;
// To use ViewLoader::load(...)
use Libs\ViewLoader as ViewLoader;

class EmptyController
{
    // Route at /EmptyController/index
    public function index()
    {
        //Logic here
    }
}
```