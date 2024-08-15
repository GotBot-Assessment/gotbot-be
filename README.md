<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Commands to run after container run
You will need to run just these 2 commands when the backend container is up and running.

### Setting up db
You will need to create the tables in the database and seed some test data for the demo.
```shell
docker exec -it gotbot-be php artisan migrate:fresh --seed
```
This will set up the tables and give you a test user with the following credentials.
```shell
email: gotbot@chef.com
password: P@55word!@#
```
Of course you are welcome to create a new user :)


### Setting up authentication
You will need to run one more command to generate auth client for the authentication system.
```shell
docker exec -it gotbot-be php artisan passport:client --personal --no-interaction
```

That`s all of it. Enjoy :)"
