# Women and Science in Brazil

Parsing and storing from [dataset in xml](http://api.pgi.gov.br/api/1/serie/1670.xml).

[See demo](https://laravel-angular-practical-test.herokuapp.com)

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Its highly recommend setup [Vagrant](https://www.vagrantup.com/) and [Laravel Homestead](https://laravel.com/docs/homestead).

Also have [Composer](https://getcomposer.org/) on your path.

### Installing

Clone into your computer:

```
git clone https://github.com/felipemfp/laravel-angular-practical-test.git
cd laravel-angular-practical-test
```

Install packages:

```
composer install
composer update
```

Setup environment with a new key:

```
cp .env.example .env
php artisan key:generate
php vendor/bin/homestead make
```

Get inside your _homestead_:

```
vagrant up
vagrant ssh
cd path/to/laravel-practical-test
```

Migrate the database:

```
php artisan migrate --seed
```

And compile frontend stuff:

```
npm install
npm run dev
```

Go to [homestead.app](http://homestead.app) or whatever you put in your `hosts` file.


## Built With

* [Laravel](https://laravel.com/) - The backend framework
* [AngularJS](https://angularjs.org/) - The frontend framework
* [Bootstrap](http://getbootstrap.com/) - The CSS framework

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
