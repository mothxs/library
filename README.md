# Library project

Small project developed in [Laravel](https://laravel.com/) + [Vue](https://vuejs.org/) with some [Bulma](https://bulma.io/) and [Buefy](https://buefy.org/) for components. Most of the application code is inside <code>/src</code> folder.

## **Installation**

#### IMPORTANT

To make this work, if you have any docker instance running already, stop it.<br>
From laravel docs: <br>

<code>Before starting Sail, you should ensure that no other web servers or databases are running on your local computer.</code>

<br>

First of all we need to install vendor dependencies with:
    
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        -w /var/www/html \
        laravelsail/php80-composer:latest \
        composer install --ignore-platform-reqs

Configure environment copying the example one:

    cp .env.example .env

Start docker containers and wait until everything is up(~2-3 min first time):

    vendor/bin/sail up

Or start it as a daemon:

    vendor/bin/sail up -d

## **After docker is configured, open a new terminal if it is not started as daemon and execute the following:**

### *Automatic configuration with:*

    sh configure.sh

If you have done automatic configuration go to [Login in](#login-in) section to check the user created so you can test the app.

### *For manual configuration do the following:*

Generate an encryption key for the app:

    vendor/bin/sail artisan key:generate

Publish assets to public directory:

    vendor/bin/sail artisan vendor:publish --tag=public

Publish assets to resource directory:

    vendor/bin/sail artisan vendor:publish --tag=resource

Install npm dependencies:

    vendor/bin/sail npm install

Compile assets:

    vendor/bin/sail npm run dev

Execute migrations:

    vendor/bin/sail artisan migrate

Add link to storage folder:

    vendor/bin/sail artisan storage:link

Create a new user:

    vendor/bin/sail artisan library:createuser joe joe@doe.com secret

Now, you should be able to go to <code>http://localhost/</code> and see the app.

## Login in

For the login, use the user configured above. The default email is **joe@doe.com** and the password is **secret**.

## Stoping sail

To stop sail daemon:

    vendor/bin/sail stop

## Tests

There are some basic HTTP tests for API endpoints. If you want to run them:

    vendor/bin/sail artisan test