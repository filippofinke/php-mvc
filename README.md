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
