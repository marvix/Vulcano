<p align="center"><img src="https://github.com/fsclaro/Vulcano/blob/master/public/img/logos/project_logo.png" width="400px"></p>

<p align="center">
<a href="https://travis-ci.org/fsclaro/Vulcan.svg?branch=master"><img src="https://travis-ci.org/fsclaro/Vulcan.svg?branch=master" alt="Build Status"></a>
</p>

## About this project

The **Vulcano Project** is intended to be a starting point for other projects based on the Laravel framework. Containing in this boilerplate several packages that can aid and accelerate the construction of your web projects.

### Laravel Environment

- PHP Version: 7.1
- Laravel Version: 5.8.*
- Timezone: America/Sao_Paulo
- Locale: pt-br
- Database: MySQL

## Packages included

Coming soon!

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
php artisan migrate
php artisan db:seed
```

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
