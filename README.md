# REIMSpiration

![Logo REIMSpiration](/assets/images/logo-test-v2.svg)

## Partnership

This repository is a School Project in partnership with

### La Pellicule Ensorcelée

![Logo La Pellicule Ensorcelée](http://www.lapelliculeensorcelee.org/theme/pellicule/images/logo.png)

La Pellicule Ensorcelée is an association aims to produce and distribute all types of short films (fiction, documentary, animation), in all media (8mm, 16mm, 35mm, video, digital medium in particular). It will organize one-off events devoted to the promotion and distribution of films and audiovisual works of short, medium or feature films.

Finally, it also aims to publish and distribute all types of media (books, photos, exhibitions, new technologies, etc.) related to cinematographic writing.

The association offers movie nights made up of short or feature films. We present all genres of cinema (fiction, animation, documentary and experimentation) made in France, in Europe or around the world.

The favorite areas of the association are Art & Essay films, heritage films, children's films and documentaries.

As often as possible, the association try to follow the paths of directors who go from short to feature films.

More informations on : [http://www.lapelliculeensorcelee.org/](http://www.lapelliculeensorcelee.org/)

## Project details

### Period

From 2020/10/19 to 2020/11/27

### Description

Creation of a wall presenting cultural activities in the geographical area of the city of Reims, France and its surroundings.

#### Features

* List local activities
* Add activities
* Build a news wall

#### Issues

* Appropriate the codes of social networks
* A collaborative site

## Authors

`Massinta Ait Braham`
 * [LinkdedIn](https://www.linkedin.com/in/massinta-aitbraham/)
 * [GitHub](https://www.github.com/MassintaAitBraham)
 * [massinta19@gmail.com](mailto:massinta19@gmail.com)

`Alexandre Corrette`
 * [LinkdedIn](https://www.linkedin.com/in/alexandre-corrette/)
 * [GitHub](https://github.com/Alexandre-Corrette)
 * [alexandrecorrette@gmail.com](mailto:alexandrecorrette@gmail.com)

`Denis Cîrlan`
 * [LinkdedIn](https://www.linkedin.com/in/denis-c%C3%AErlan/)
 * [GitHub](https://github.com/dcirlan)
 * [dkirlan02@gmail.com](mailto:dkirlan02@gmail.com)

`Christophe Chapleau`
 * [LinkdedIn](https://www.linkedin.com/in/cchapleau/)
 * [GitHub](https://github.com/cchapleau)
 * [ch.chapleau@gmail.com](mailto:ch.chapleau@gmail.com)

## Technical specificities

 1. PHP, JS, HTML, CSS, MySQL
 2. Git/GitHub
 3. MVC structure from scratch
 4. Vendors/libraries such as `Twig` `Grumphp` `Markdown`
 5. Utilisation of [Travis](https://travis-ci.com)
 6. xx
 7. xx
 8. xx
 9. xx
10. xx

## URLs availables

* Homepage at [localhost:8000/](localhost:8000/)
* Activity edit [localhost:8000/items/edit?id=:id](localhost:8000/items/edit?id=2)
* Activity add [localhost:8000/items/add](localhost:8000/items/add)
* Activity deletion [localhost:8000/items/delete?id=:id](localhost:8000/items/delete?id=2)
* A propos
* Précautions COVID

* Activities list at [localhost:8000/items](localhost:8000/items)
* Activitiy modification [localhost:8000/items/show?id=:id](localhost:8000/items/show?id=2)

## Project steps

### WEEK 1
* Details ...
* Details ...
* Details ...

### WEEK 2
* Details ...
* Details ...
* Details ...

### WEEK 3
* Details ...
* Details ...
* Details ...

### WEEK 4
* Details ...
* Details ...
* Details ...

### WEEK 5
* Details ...
* Details ...
* Details ...

### WEEK 6
* Details ...
* Details ...
* Details ...

`______________________`

## Simple MVC

### Description

This repository is a simple PHP MVC structure from scratch.

It uses some cool vendors/libraries such as Twig and Grumphp.
For this one, just a simple example where users can choose one of their databases and see tables in it.

#### Check on Travis

1. Go on [https://travis-ci.com](https://travis-ci.com).
2. Sign up if you don't have account,
3. Look for your project in search bar on the left,
4. As soon as your repository have a `.travis.yml` in root folder, Travis should detect it and run test.
5. Configure Travis as described in the screenshot below, this is needed to avoid performance issues.

> You can watch this screenshot to see minimum mandatory configuration : ![basic config](http://images.innoveduc.fr/symfony4/travis-config.png)

### Steps

1. Clone the repo from Github.
2. Run `composer install`.
3. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file, it must be kept.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');
```
4. Import `simple-mvc.sql` in your SQL server,
5. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
6. Go to `localhost:8000` with your favorite browser.
7. From this starter kit, create your own web application.

#### Windows Users

If you develop on Windows, you should edit you git configuration to change your end of line rules with this command :

`git config --global core.autocrlf true`

### URLs availables

* Home page at [localhost:8000/](localhost:8000/)
* Items list at [localhost:8000/items](localhost:8000/items)
* Item details [localhost:8000/items/show?id=:id](localhost:8000/items/show?id=2)
* Item edit [localhost:8000/items/edit?id=:id](localhost:8000/items/edit?id=2)
* Item add [localhost:8000/items/add](localhost:8000/items/add)
* Item deletion [localhost:8000/items/delete?id=:id](localhost:8000/items/delete?id=2)
