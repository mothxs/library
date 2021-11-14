#Generate an encryption key for the app
echo "Generating encription key"
vendor/bin/sail artisan key:generate
echo "Encription key generated!"

#Publish assets
echo "Publishing assets..."
vendor/bin/sail artisan vendor:publish --tag=public
vendor/bin/sail artisan vendor:publish --tag=resource
echo "Published!"

#Install npm dependencies
echo "Installing npm dependencies..."
vendor/bin/sail npm isntall
echo "npm dependencies installed!"

#Compile assets
echo "Compiling assets..."
vendor/bin/sail npm run dev
echo "Assets compiled!"

#Execute migrations
echo "Executing migrations..."
vendor/bin/sail artisan migrate
echo "Migrations executed!"

#Link storage
echo "Linking storage..."
vendor/bin/sail artisan storage:link
echo "Storage linked!"

#Creates a new user
echo "Creating user..."
vendor/bin/sail artisan library:createuser joe joe@doe.com secret
echo "User created! email=joe@doe.com password=secret"
