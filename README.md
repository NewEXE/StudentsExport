# StudentsExport

ArtJoker test task #1
https://github.com/adminko/testLaravel (another one: https://github.com/NewEXE/UsersTerritories)

# Installation

Tested on Vagrant 2.0.2, Homestead 5.2.0, Linux Mint 18.3.

1. `git clone https://github.com/NewEXE/StudentsExport.git`
2. `composer update --lock`
3. set up .env file; it's important to set APP_DEBUG=false before using export!
4. `php artisan migrate`
5. `php artisan db:seed`
