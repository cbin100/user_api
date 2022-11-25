# user_api
Package for consuming User API from https://reqres.in

Hi,
My name is Watchiba.

Please find here a Composer package that provides a service for retrieving users via a remote API (integrate with the
https://reqres.in/.

## Background

● This is a very simple packacge that can be added to your Laravel project and will consume the API from https://reqres.in/.

● I have expanded the response in return by adding 3 attributes: response, status and code

● This package can also be used in auther projects such as CodeIgniter, Drupal, Symfony, CakePHP, etc... For that, simple use the 2 classes User.php and BaseController.php and expand them.

● Due to the instabilities of the APIs, I've used caching systems with Redis. This is someting the requested server might be unavaible the URLs have changed. So with this package, no need to request the API, we just need to get data from local cache. With caches, the speed is improved.


## Prerequisite

### Composer
### PHP => 7.4
### Guzzle Http
### Redis (predis)
### Postman (postman.com) for test implement

N.B: This package was tested on Laravel 9 but can also work from Laravel 5 or above or any other PHP MVC. Just copy and paste into your Laravel Project

You can use your own Laravel version (7, 8, etc..). If so, just copy and paste the project libraries and files except vendor, node_modules, and files related to composer. But I recommend to use the current Laravel version. 

## Configuration

1. If laravel is not installed, install any Laravel 5 or 7, 8, 9 
Also if GuzzleHttp Client is not included into your Laravel Project, please intall it with this command composer require guzzlehttp/guzzle
Last installation is Redis. Install Redis. See how to install and configure ==> https://laravel.com/docs/9.x/redis

2. Clone this free repository. Or from your project directory just tape composer require cbin100/user_api

3. unzip the folder then copy/paste into your project folder

4. From your Laravel Project, open the config/app.php file and scroll down to the providers array. Add this line **Cbin100\User\Providers\UserProvider::class,**
This will register the UserProvider class as one of the service providers for this project. Start the application using php artisan serve.


## How it works

### 1. packages/cbin100/user/src/BaseController.php
This class helps to send response to user. When the response successful, sendApiResponse will be used, otherwise sendApiError will be used.

### 2. packages/cbin100/user/src/User.php
This is the Model that really consume the API. It makes the Get request, convert response to JSON format, save into redis cache, etc... and call the appropriate method to deliver the response to the user.

## Results

### 1.Retrieve a single user by ID [Screenshot here](https://github.com/cbin100/user_api/blob/main/packages/cbin100/user/Screenshot%202022-11-25%20021400.png)

Route::GET('/cbin/users/{user_id}', [\Cbin100\User\User::class, 'get_single_user'])->name('get_single_user');

### 2. Retrieve a paginated list of users: [Screenshot here](https://github.com/cbin100/user_api/blob/main/packages/cbin100/user/Screenshot%202022-11-25%20021129.png)

Route::GET('/cbin/users/page/{page}', [\Cbin100\User\User::class, 'get_paginated_list_of_user'])->name('get_paginated_list_of_user');

## Bonus: Redis Caches
### 3. Retrieve a single user by ID from cache: [Screenshot here](https://github.com/cbin100/user_api/blob/main/packages/cbin100/user/Screenshot%202022-11-25%20021438.png)

Route::GET('/cbin/redis/users/{user_id}', [\Cbin100\User\User::class, 'get_single_from_redis_cache'])->name('get_single_user');

### 4. Retrieve a paginated list of users from cache: [Screenshot here](https://github.com/cbin100/user_api/blob/main/packages/cbin100/user/Screenshot%202022-11-25%20021649.png)

Route::GET('/cbin/redis/users/page/{page}', [\Cbin100\User\User::class, 'get_paginated_list_of_user_into_redis_cache'])->name('get_paginated_list_of_user_into_redis_cache');

## Further development

The goal was develop the composer package that can consume User API, and test the it, and unsure the app always returns data even if the external API's urls are not working. At this point, the essential was done.
However, as the package will return cache data, there could be some change from the external API. for that it vital to create a cron table that will check if there are change from the API, then update the cache data accordingly.

## Conclusion
I hope you learned a thing or two about creating a composer Package that can consume User API or at least understand how I developed my APP. Please let me know your thoughts on how I did or what I can do to improve. I am open to feedback especially on everything described above.

Let's connect on Linkedin https://www.linkedin.com/in/watchiba-j-541965195/

If you're generous, please buy me a coffee on
https://paypal.me/pelogroup?country.x=GB&locale.x=en_GB

## Thank you!

