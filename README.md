# Library project

## Installation
<br>

#### IMPORTANT

To make this work, if you have any docker instance running already, stop it.<br>
From laravel docs: <br>

<code>Before starting Sail, you should ensure that no other web servers or databases are running on your local computer.</code>

<br>

First of all we need to install vendor dependencies with:
    
    composer install

Configure environment copying the example one:

    cp .env.example .env

Start docker containers:

    vendor/bin/sail up

Or start it as a daemon:

    vendor/bin/sail up -d

Generate an encryption key for the app:

    vendor/bin/sail artisan key:generate

Execute migrations:

    vendor/bin/sail artisan migrate

Create a new user:

    vendor/bin/sail artisan library:createuser joe joe@doe.com secret

Now, you should be able to go to <code>http://localhost/</code> and see the app.

For the login use the user configured above. The email is **joe@doe.com** and the password is **secret**.

<hr>

To stop sail daemon:

    vendor/bin/sail stop