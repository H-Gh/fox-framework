
# Fox  
![Fox](images/fox-128.png)  
  
This is a mini framework to run some basic web apps.  
  
# Table of contents  
 - [Folder structure of the framework](#folder-structure-of-the-framework)  
 - [Controllers](#controllers)  
 - [Models](#models)  
 - [Console](#console)  
 - [Environment variables](#environment-variables)  
  
# Folder structure of the framework  
The folder structure of the app is:  
```  
 - app
 ----- Console
 ---------- Commands
 ----- Http
 ---------- Controllers
 ----- Models
 - public
 ----- index.php
 - resources
 ----- views
 - storage
 ----- logs
 ```  
# Controllers  
The controllers to render the web pages. All the controllers must be extended from `Fox/Controller/Controller`.  The parent class will provide some common methods. The list of methods:

- render
- json
  
# Models  
The models to interact with the database. All the models must be extended from `Fox/Database/Model`.  The parent method will provide some methods to interact with database.
The list of all methods:
- find(static)
- insert(static)
- findOne(static)
  
# Console  
The commands to run some actions in the CLI. All the consoles must be extended from `Fox/Console/Console`.  Sone notes that must considered:
- All the commands must have the `SIGNATURE` const to use in the console. like `sample:action`  
- `SINGATURE` may have the arguments. Arguments must be surrounded by the `{}`. `sample:action {sampleArgument}`  
- Optional arguments must have `?` before the argument name. like `sample:action {?sampleArgument}`   

# Environment variables 

|Variable|Description|Available values|
|---|---|---|---|
|DATABASE|The engine of database|`mysql`|
|MYSQL_HOST|The host of MySQL|anything|
|MYSQL_USERNAME|The username of MySQL|anything|
|MYSQL_PASSWORD|The password of MySQL|anything|
|MYSQL_PORT|The port of MySQL|anything|
|MYSQL_DATABASE|The database name|anything|
|APP_DEBUG|The debug mode of application. When it is on you can see the errors and their trace|`true` or `false`
