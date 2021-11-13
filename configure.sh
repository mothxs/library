#Install dependencies
echo "Installing dependencies..."
composer install
echo "Dependencies installed!"

#Configure environment
echo "Configuring environment..."
cp .env.example .env
echo "Environment configured!"

#Start docker containers as daemon
echo "Starting docker containers..."
vendor/bin/sail up -d
echo "Docker containers started!"

#Generate an encryption key for the app
echo "Generating encription key"
vendor/bin/sail artisan key:generate
echo "Encription key generated!"

#Execute migrations
echo "Executing migrations..."
vendor/bin/sail artisan migrate
echo "Migrations executed!"

#Creates a new user
echo "Creating user..."
vendor/bin/sail artisan library:createuser joe joe@doe.com secret
echo "User created! email=joe@doe.com password=secret"
