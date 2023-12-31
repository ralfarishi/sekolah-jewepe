### Installation

1. Clone this repo & update dependencies using composer.

```sh
$ cd sekolah-jewepe
$ composer update
```

2. Copy the .env.example file.

```sh
$ cp .env.example .env
```

3. Create a new MySQL database dan set up the new database in .env file.

```sh
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=
```

4. Open the seeder file located in `database/seeders/DatabaseSeeder.php` for login credential.

```php
DB::table('users')->insert([
	'name' => 'admin', // user name
	'email' => 'admin@google.com', // user email
	'role' => 'admin', // role
	'password' => Hash::make("12345") // password
]);
```

5. Create the application key:

```sh
$ php artisan key:generate
```

6. Run migration & seed:

```sh
$ php artisan migrate --seed
```

7. Run the project:

```sh
$ php artisan serve
```
