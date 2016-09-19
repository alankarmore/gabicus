
### Project Setup Guidelines

 - To clone repository use **git clone git@github.com:alankarmore/gabicus.git**
 - There are two main branches
 ```
    1. master

    2. develop
 ```
 - always pull code from develop for local development.
 - create .env file in root directory and copy all content from .env.example to .env file and
   make changes according to requirement like database and other required passwords according
   to your local environment.
 - Install composer [It's dependency manager for php]

```{r, engine='sh', count_lines}
    $ curl -sS https://getcomposer.org/installer | php

    $ sudo mv composer.phar /usr/local/bin/composer
```
 - Then goto root path of project directory and run following command
 - Create .env file in root directory and copy the contents from .env.example to .env

```{r, engine='sh', count_lines}
    $ composer install
```

 - Run following command to generate DB

```{r, engine='sh', count_lines}
    $ php artisan key:generate
    $ php artisan migrate 
    $ php artisan db:seed 
```

  - Create a virtual host and point it to public directory of Project
  - Always create pull request on develop branch, don't do anything on master branch directly
