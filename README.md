# ZendSkeletonApplication

## Introduction

This is a skeleton application using the Zend Framework MVC layer and module
systems. This application is meant to be used as a starting place with a fully login module with roles and permissions. 

## Installation using Git

Just use git clone in your working folder on the command line:

<pre>
your/working/folder git clone https://github.com/verzeilberg/Default-ZF3-frame.git . 
</pre>

or download the zip file and unzip the files in your working folder.

## Composer install/update

After you have cloned/unzipped the project run composer install and then composer update (just to be sure)


### Apache setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

```apache
<VirtualHost *:80>
    ServerName zfapp.localhost
    DocumentRoot /path/to/zfapp/public
    <Directory /path/to/zfapp/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
        <IfModule mod_authz_core.c>
        Require all granted
        </IfModule>
    </Directory>
</VirtualHost>
```

### Nginx setup

To setup nginx, open your `/path/to/nginx/nginx.conf` and add an
[include directive](http://nginx.org/en/docs/ngx_core_module.html#include) below
into `http` block if it does not already exist:

```nginx
http {
    # ...
    include sites-enabled/*.conf;
}
```


Create a virtual host configuration file for your project under `/path/to/nginx/sites-enabled/zfapp.localhost.conf`
it should look something like below:

```nginx
server {
    listen       80;
    server_name  zfapp.localhost;
    root         /path/to/zfapp/public;

    location / {
        index index.php;
        try_files $uri $uri/ @php;
    }

    location @php {
        # Pass the PHP requests to FastCGI server (php-fpm) on 127.0.0.1:9000
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_param  SCRIPT_FILENAME /path/to/zfapp/public/index.php;
        include fastcgi_params;
    }
}
```

Restart the nginx, now you should be ready to go!

### Setup database connection

### Doctrine schema tool

Run the doctrine schema tool update in your command line:

<pre>
your/working/folder php vendor/doctrine/doctrine-module/bin/doctrine-module orm:schema-tool:update --dump-sql
</pre>

### Good to go

Ju
