<!-- <p align="center"><img src="https://github.com/fsclaro/Vulcano/blob/master/public/img/logos/project_logo.png" width="400px"></p> -->


## About this project

The **Vulcano Project** is intended to be a starting point for other projects based on the Laravel framework. Containing in this boilerplate several packages that can aid and accelerate the construction of your web projects.

## Laravel Environment

- PHP Version: ^7.1
- Laravel Version: 5.8.*
- Timezone: America/Sao_Paulo
- Locale: pt_BR
- Database: MySQL

## Third-party Packages included

- arcanedev/log-viewer: ^4.7
- arcanedev/no-captcha: ^9.0
- creativeorange/gravatar: ^1.0
- davejamesmiller/laravel-breadcrumbs: ^5.2
- doctrine/dbal: ^2.9
- igorescobar/jquery-mask-plugin: ^1.14
- jenssegers/date: ^3.5
- jeroennoten/laravel-adminlte: ^1.25
- laravel/socialite: ^4.1
- renatomarinho/laravel-page-speed: ^1.8
- spatie/laravel-medialibrary: ^7.0.0
- spatie/laravel-permission: ^2.37
- uxweb/sweet-alert: ^2.0

## Third-party Packages for Development Mode included

- barryvdh/laravel-debugbar:^3.2,
- barryvdh/laravel-ide-helper: ^2.6,
- beyondcode/laravel-dump-server: ^1.0,
- deployer/deployer: ^6.4,
- matt-allan/laravel-code-style: ^0.3.0

## Cloning this project

To use this project, you must type the following line in your command terminal
```bash
git clone https://github.com/fsclaro/vulvano.git
```

You will need a mysql server installed e configured, then execute the command below to create a database for the your project.
```bash
mysql -e 'create database <YOUR_DATABASE_NAME>;' -u <YOUR_MYSQL_USERNAME> -p
```

Edit the *.env* file to modify the parameters below, according your database environment
```bash
DB_DATABASE=<YOUR_DATABASE_NAME>
DB_USERNAME=<YOUR_MYSQL_USERNAME>
DB_PASSWORD=<PASSWORD_OF_YOUR_MYSQL_USERNAME>
```

The default values are
```bash
DB_DATABASE=vulcano
DB_USERNAME=homestead
DB_PASSWORD=secret
```

After, run commands bellow in terminal:
```bash
composer install
php artisan key:generate
php artisan migrate --seed
```

## Default Login User
This boilerplate have 3 defaults users

+----+---+---+
| User | Login | Password |
+----+---+---+
| Super Admin | superman@vulcano.com | superman |
| Admin | admin@vulcano.com | admin1234 |
| User | user@vulcano.com | user1234 |
+----+---+---+


## New composer commands
### 1) *composer clear-all*, execute:
* artisan clear-compiled
* artisan cache:clear
* artisan route:clear
* artisan view:clear
* artisan config:clear
* composer dumpautoload -o

### 2) *composer cache-all*, execute:
* artisan config:cache
* artisan route:cache

### 3) *composer ide-helper*, execute:
* artisan ide-helper:generate
* artisan ide-helpder:meta

### 4) *composer format*, execute:
* php-cs-fixer fix app/ --show-progress=estimating
* php-cs-fixer fix config/ --show-progress=estimating
* php-cs-fixer fix database/ --show-progress=estimating
* php-cs-fixer fix resources/ --show-progress=estimating
* php-cs-fixer fix routes/ --show-progress=estimating
* php-cs-fixer fix tests/ --show-progress=estimating

## Internalization

This project is configured for the Brazilian Portuguese Language with the *timezone* configured for **America/Sao_Paulo** and *locale* for **pt-br**. If you are of another nationality, simply edit the *config/app.php* file and customize the *timezone* and *locale* parameters according to your need.


## Contributing

Thank you for considering contributing to the *Vulcano Project*! If you have good ideas to make this project better, read the [contribution guidelines](https://github.com/fsclaro/vulcano/blob/master/_docs/CONTRIBUTING.md) on contributions and send me an email to [fsclaro@gmail.com](mailto:fsclaro@gmail.com)

## Code of Conduct

It is very important that you read our [code of conduct](https://github.com/fsclaro/vulcano/blob/master/_docs/CODE_OF_CONDUCT.md) so that there is a healthy coexistence among all members participating in this project.

## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to _*Fernando Salles Claro*_ at [fsclaro@gmail.com](mailto:fsclaro@gmail.com). All security vulnerabilities will be promptly addressed.

## License

This project is open-sourced software licensed under the [MIT license](https://github.com/fsclaro/vulcano/blob/master/_docs/LICENSE.md).

## Credits

The background images at [Unplash](https://unsplash.com) by authors/photographers:
- [Adam Kedem](https://unsplash.com/@adamk)
- [Alessandro Valenzano](https://unsplash.com/@alessvalenzano)
- [Alexandre Chambon](https://unsplash.com/@goodspleen)
- [Boris Baldinger](https://unsplash.com/@borisbaldinger)
- [David Emrich](https://unsplash.com/@otoriii)
- [Francesco Ungaro](https://unsplash.com/@francesco_ungaro)
- [Iswanto Arif](https://unsplash.com/@iswanto)
- [Janita Top](https://unsplash.com/@janitatop)
- [Philipp Wüthrich](https://unsplash.com/@phiwut)
- [Piermanuele Sberni](https://unsplash.com/@piermanuele_sberni)
