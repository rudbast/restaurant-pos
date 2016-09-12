# Restaurant POS

## Description

Work in progress..

## Setup

### Main Requirements

- PHP >= v5.6.4
- Composer (php package manager)
- NPM (node package manager)
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension

### Additional Packages

Install composer and node package manager (npm).

```bash
$ composer install
$ npm install
```

### Directory permission

On UNIX based system, change directory permission for `bootstrap/cache` and `storage` to 775, and group ownership to server's.

```bash
# Change directory permission.
$ chmod 775 boostrap/cache -R
$ chmod 775 storage -R

# Change directory group ownership.
# For example: If 'www-data' is the user group for the http server
$ chgrp www-data boostrap/cache -R
$ chgrp www-data storage -R
```

### Main Application

Copy `.env.example` file as `.env` and edit as necessary (cache, session, database, mail, etc).

Run `$ php artisan key:generate` to generate application's unique key.

#### Local Development

You'll need to migrate and seed the database.

```bash
$ php artisan migrate
$ php artisan db:seed
```

### Hosting

#### Apache

Required extensions:

- urlrewrite.

##### Virtual Host Configuration

```
<VirtualHost *:80>
    ServerAdmin webmaster@domain.com

    ServerName domain.com
    ServerAlias www.domain.com

    DocumentRoot {full project path}/public
    <Directory "{full project path}/public">
        AllowOverride all
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

## License

Work in progress..
