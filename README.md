## Real Time Notification for Post Creation Using Laravel Reverb for WebSocket push notifications and Redis

This is a real-time Post Creation web application built with Laravel, using Laravel Reverb for WebSocket push notifications and Redis for queue management. The game allows two players to join a game, make moves, and receive real-time updates on the game state.
Features

- Real-time new post notification system.
- WebSocket-based updates using Laravel Reverb.
- Redis for queue processing and session storage.
- MySQL database for storing game states.
- Authentication system to manage access.

## Prerequisites

- PHP >= 8.1
- Composer
- Node.js and NPM
- MySQL
- Redis server

## Installation
<br>
Follow these steps to set up and run the project locally.

1. Clone the Repository

2. Install composer dependencies 
> composer install

3. Install Node Dependencies
> npm install

4. Configure Environment
   Copy the example environment file and update it with your settings:
   cp .env.example .env

5. Set Up the Database and make sure Mysql is running

6. Install Reverb:
> php artisan reverb:install

6. Run migration and seed 
> php artisan migrate --seed

7. Start Redis Server

Install Redis (if not already installed):

Ubuntu/Debian:
>sudo apt update

>sudo apt install redis-server

macOS (with Homebrew):
>brew install redis

Start Redis:

Ubuntu/Debian:
>sudo systemctl start redis

>sudo systemctl enable redis


macOS:
>brew services start redis

Verify Redis:
>redis-cli ping

Expected output: PONG.


8. Compile Assets
   Compile the front-end assets:
   npm run dev

9. Start the Servers

Laravel Development Server:
>php artisan serve

The application will be available at http://localhost:8000.

Laravel Reverb WebSocket Server:
php artisan reverb:start

Reverb will run on localhost:8080 as configured in .env.

Queue Worker (for broadcasting events):
>php artisan queue:work



9. Test the Application

Open http://localhost:8000 in two different browsers or incognito windows.
Register or log in as a user, and for admin use these credentials:
> email: admin@gmail.com
> 
> password: 123456


Now as a user create a post, and you will see the notifications appears on the admin panel.
