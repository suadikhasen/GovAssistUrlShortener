
## Requirements
Make sure you have :
- php 8.1 or more
- composer
- latest node
- npm
- database(mysql,sqlite..) as you want that are supported by laravel

## Installation


1 . Clone the project form GitHub

```sh
git clone https://github.com/suadikhasen/GovAssistUrlShortener
```
2 . Navigate  to your directory use below command for ubuntu or macos  
replace ``` your_directory ``` by your directory name
```sh
cd your_directory 
```

3 Install php third party packages run the command below
```sh
composer install
```

4 install node packages
```sh
npm install
```
5 copy .env.example to .env file for ubuntu or macos use below command
```sh
cp .env.exampe .env
```

6 Generate application key
```sh
php artisan key:generate
```

7 don't forget to change the APP_URL value in your environment file to your application url in my case
```sh
APP_URL=http://urlshortener.test
```

## how to use (Web)
once you serve the project navigate to the application url ,you will get the option to register or login

once you logged in to the application you will be redirected to the:

```sh
/url_shortener_dashboard
```

After you land to the page you can submit the url and generate the shortened url.
the table at this page will show you the latest 10 generated url.

## how to use (API)
In order to use the API use below POST endpoing
```sh
api/shorten_url
```
the endpoint require a ``` destination ``` payload the destination needs to be the valid url.

when there is a validation error you will get the error like this and http code will be 422
```
{
    "destination": [
        "The destination field must be a valid URL."
    ]
}
```
## Unofficial third party packages
In this project i have used two dev libraries  
- Laravel ide helper - used for auto completion <a href="https://github.com/barryvdh/laravel-ide-helper">Laravel ide helper</a>  
- Laravel debug bar  - used for debugging <a href="https://github.com/barryvdh/laravel-debugbar">Laravel debug bar</a>
## Code structure
There are additional directories in the app folder  
- ``` Actions ``` used to organize actions , specially used  to minimize code  inside the controller.  
- ``` Services ``` used to handle additional business logics.

There is a controller ``` UrlShortenerController ``` inside the controller directory this controller is used for handling non authentication web tasks.
The authentication feature is handled by laravel breeze which is located inside Auth folder 

Inside the controller `` Api `` folder there is a controller `` UrlShortenerController `` used for handling the API.
## Testing
There are two types of tests, feature test and unit test:
- In feature test the test are located  inside Web and Api folder.
- In unit  test the test are located  inside Jobs folder.
- The Auth folder inside feature test is the default laravel breeze test.
