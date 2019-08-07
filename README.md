# Isntall Project

## Step 1:
- Clone project 
- run command : composer install

## Step 2:
- Create database 
- import file db.sql to database

## Step 3:
- rename file env.env to .env and edit connect database

## Step 4:
- run command : php artisan key:generate 
- run command: php artisan jwt:secret
- run command: php artisan config:cache, php artisan view:clear