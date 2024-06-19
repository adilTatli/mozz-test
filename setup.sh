#!/bin/bash

if [ ! -f ".env" ]; then
    cp .env.example .env
    echo ".env file created successfully."
else
    echo ".env file already exists. Skipping creation."
fi

./vendor/bin/sail up -d

until ./vendor/bin/sail ps | grep -q "Up"; do
    sleep 1
done

./vendor/bin/sail composer update

./vendor/bin/sail php artisan migrate

./vendor/bin/sail php artisan db:seed

./vendor/bin/sail npm install

./vendor/bin/sail npm run dev

./vendor/bin/sail php artisan key:generate

echo "Setup completed successfully!"
