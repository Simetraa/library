# ATLAS Books

## Installation

1. Download project from GitHub
    ```console
    git clone https://github.com/Simetraa/library.git
    ```
2. Install dependencies
    ```console
    npm install
    ```
   ```console
   composer install
   ```
3. Seed test data
    ```console
    php artisan migrate:fresh --seed
    ```
4. Run the server
    ```console
    php artisan serve
    ```

## Update

1. Update the project
    ```console
    git pull
    ```
2. Install dependencies
    ```console
    npm install
    ```
    ```console
    composer install
    ```
3. Update the database
    ```console
    php artisan migrate:fresh --seed
    ```

## Usage

By default, there are three test users

1. Admin  
    Email: ```admin@example.com```  
    Password: ```password```
2. User  
    Email: ```test@example.com```  
    Password: ```password```  
3. Staff  
    Email: ```staff@example.com```  
    Password: ```password```

## Development

### Useful commands

* Seed database with test data
    ```console
    php artisan migrate:fresh --seed
    ```
* Create a new controller
    ```console
    php artisan make:controller ControllerName
    ```
* Create a new model
    ```console
    php artisan make:model ModelName
    ```
* Create a new migration
    ```
    php artisan make:migration migration_name
    ```
* Create a new factory
    ```
    php artisan make:factory FactoryName
    ```
* Create a new view
    ```
    php artisan make:view view_name
    ```
* View database outline
    ```console
    php artisan db:show
    ```
* View routes
    ```console
    php artisan route:list
    ```

## Testing

1. Install latest ChromeDriver for your browser version
    ```console
    php artisan dusk:chrome-driver --detect
    ```
2. Fix permissions 
    ```
    chmod -R 0755 vendor/laravel/dusk/bin/
    ```
2. Run tests  
    ```console
    php artisan dusk
    ```
### Create new tests

* Create a new test
    ```console
    php artisan dusk:make TestName
    ```

* [Login as a user during a test  ](https://laravel.com/docs/11.x/dusk#authentication)
    ```php
    use App\Models\User;
    use Laravel\Dusk\Browser;
     
    $this->browse(function (Browser $browser) {
        $browser->loginAs(User::find(1))
              ->visit('/home');
    });
    ```

