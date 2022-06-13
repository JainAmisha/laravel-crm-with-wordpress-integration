
# Laravel CRM with Wordpress Integration

This is a simple CRM system made with Laravel. The system will collect
customer data and build customer profiles that the client can browse and
manage. Customer profiles will exist inside of the Laravel dashboard
adjoined by matching customer profiles on a WordPress website.


# Installation Steps

## Authors

- [@JainAmisha](https://github.com/JainAmisha)


## Installation Steps

#### STEP 1 
Clone Repository from Github.
#### STEP 2 
Create a new database for the Laravel/CRM project  in your system
#### STEP 3 
Copy .env.example into .env file and setup the .env file
#### STEP 4 
Modify the following lines in the .env file for integrating with WordPress.

- Modify Basic Authentication Details ->

```bash
WP_HOME_URL (add your WordPress site home URL without the trailing slash)
WP_USERNAME (add your WordPress site admin username)
WP_PASSWORD (add password of the above user)
```

- Modify Encryption Details / Keep the same values in WordPress plugin (plugin link) settings ->

```bash
WP_ENCRYPTION_CIPHER = AES-128-CTR
WP_ENCRYPTION_IV = 1234567891011121
WP_ENCRYPTION_KEY = LaravelWPConnect
```

#### STEP 5
Modify the following lines in the .env file to run the test cases on a testing database.
```bash
TESTING_DATABASE = testing_db_name
TESTING_USERNAME = testing_db_username
TESTING_PASSWORD = testing_db_password
```

#### STEP 6
Run the following commands in the Laravel project folder
- composer install
- php artisan migrate

#### Screenshots

![1](https://user-images.githubusercontent.com/36112929/173430688-ad64b429-d0c8-4fb3-a1d8-2ffc3d171cc6.png)

![2](https://user-images.githubusercontent.com/36112929/173430704-d0db9755-f304-45d8-b008-3d689bd6c733.png)

![3](https://user-images.githubusercontent.com/36112929/173430713-f3feb253-238f-4112-aaa8-9e6b8a7c7edc.png)

