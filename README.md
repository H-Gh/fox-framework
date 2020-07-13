# Fox
![Fox](images/fox-128.png)

This is a mini framework to run some basic web apps.

# Table of contents
 - [Installation](#installation)
    - [Step 1: Add index.php](#step-1-add-indexphp)
    - [Step 2: Forward requests to index.php](#step-2-forward-requests-to-indexphp)
    - [Step 3: composer.json](#step3-composerjson)
 - [Folder structure of the App](#folder-structure-of-the-app)
 - [Controllers](#controllers)
 - [Models](#models)
 - [Environment variables](#environment-variables)

# Installation
To install the framework, follow these steps:
## Step 1: Add index.php
The first step is to adding the entrance point of the application. Create a `public` directory and inside it create an `index.php` file. Then put these line in the `index.php`.
```php
<?php
/**
 * The entrance file of app
 *
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     null
 */

use App\Core\App\Application;

require "../vendor/autoload.php";

Application::get()->run();
``` 

## Step 2: Forward requests to index.php
Create an `.htaccess` file in the root of the project and put these line inside it. It will cause to redirect all the requests to index.php.
```
<IfModule mod_rewrite.c>
    Options -MultiViews
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ public/index.php [QSA,L]
</IfModule>

<IfModule !mod_rewrite.c>
    <IfModule mod_alias.c>
        RedirectMatch 302 ^/$ /public/index.php/
    </IfModule>
</IfModule>
```

## Step3 :composer.json
put this composer inside your app root.
```
{
    "name": "hgh/test",
    "description": "The test project",
    "type": "project",
    "license": "MIT",
    "authors": [
        {
            "name": "Hamed Ghasempour",
            "email": "hamedghasempour@gmail.com"
        }
    ],
    "minimum-stability": "dev",
    "require": {
        "hgh/fox": "dev-master",
        "hgh/helpers": "dev-master",
        "hgh/exception-handler": "dev-master",
        "vlucas/phpdotenv": "^4.1",
        "ext-pdo": "*",
        "ext-openssl": "*",
        "ext-mcrypt": "*"
    },
    "autoload":{
        "psr-4": {
            "App\\": "app/"
        }
    }
}
```

# Folder structure of the App
The folder structure of the app is:
```
    - app
    ----- Controllers
    ----- Models
    - public
    ----- index.php
    - resources
    ----- views
    - storage
    ----- logs
```
# Controllers
All the controllers must be extended from `Fox/Controller/Controller`.

# Models
All the models must be extended from `Fox/Database/Model`.

# Environment variables  
|Variable|Description|Default value|
|---|---|---|
|MYSQL_HOST|The host of MySql|localhost|
|MYSQL_USERNAME|The username of MySql|-|
|MYSQL_PASSWORD|The password of MySql|-|
|MYSQL_PORT|The port of MySql|3306|
|MYSQL_DATABASE|The database name|-|
|BLOG_NAME|The blog name|-|
|APP_DEBUG|The debug mode of application. When it is on you can see the errors and their trace|false|