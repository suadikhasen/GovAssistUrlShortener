
## Requirements
Make sure you have :
- PHP 8.1 or more
- composer
- latest node
- npm
- database(MySQL, SQLite..) as you want that is supported by Laravel

## Installation


1 . Clone the project from GitHub

```sh
git clone https://github.com/suadikhasen/GovAssistUrlShortener
```
2 . Navigate  to your directory and use the below command for Ubuntu or macOS  
replace ``` your_directory ``` by your directory name
```sh
cd your_directory 
```

3 Install php third-party packages and run the command below
```sh
composer install
```

4 install node packages
```sh
npm install
```
5 copy .env.example to .env file for Ubuntu or macOS use the below command
```sh
cp .env.example .env
```

6 Generate application key
```sh
php artisan key:generate
```

7 don't forget to change the APP_URL value in your environment file to your application URL in my case
```sh
APP_URL=http://urlshortener.test
```

8 Serve your project, if you are using Valet just link the project folder if not use the below command for Ubuntu and macOS  
you can use also the recent release development tool Laravel Herd see the documentation here 
<a href="https://herd.laravel.com"> Laravel Herd </a>
```sh
php artisan serve
```

9 build node
```sh
npm run watch
```

## How to use (Web)
once you serve the project and navigate to the application URL, you will get the option to register or login

once you logged in to the application you will be redirected to the:

```sh
/url_shortener_dashboard
```

After you land on the page you can submit the URL and generate the shortened URL.
the table on this page will show you the latest 10 generated URLs.

## How to use (API)
In order to use the API use the below POST endpoint
```sh
api/shorten_url
```
the endpoint requires a ``` destination ``` payload the destination needs to be the valid url.

when there is a validation error you will get the error like this and the HTTP code will be 422
```
{
    "destination": [
        "The destination field must be a valid URL."
    ]
}
```
## Unofficial third-party packages
In this project, I have used two dev libraries  
- Laravel ide helper - used for auto completion <a href="https://github.com/barryvdh/laravel-ide-helper">Laravel ide helper</a>  
- Laravel debug bar  - used for debugging <a href="https://github.com/barryvdh/laravel-debugbar">Laravel debug bar</a>
## Code structure
There are additional directories in the app folder  
- ``` Actions ``` used to organize actions, especially used  to minimize code  inside the controller.  
- ``` Services ``` used to handle additional business logic.

There is a controller ``` UrlShortenerController ``` inside the controller directory this controller is used for handling non-authentication web tasks.
The authentication feature is handled by Laravel Breeze which is located inside Auth folder 

Inside the controller `` Api `` folder there is a controller `` UrlShortenerController `` used for handling the API.
## Testing
There are two types of tests, feature test, and unit test:
- In the feature test the test is located  inside Web and API folder.
- In the unit  test the test is located  inside the Jobs folder.
- The Auth folder inside the feature test is the default Laravel breeze test.
