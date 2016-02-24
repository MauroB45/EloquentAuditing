## EloquentAuditing Package

Eloquent helper to audit database transactions by simply adding its trait to your Eloquent model. 

# Install

This package can be installed with Composer running the following command:

```php
  php require MauricioBernal\EloquentAuditing
```
After installing the EloquentAuditing, register the MauricioBernal\ElquentAuditing\EloquentAuditingServiceProvider in your config/app.php configuration file like:

```php
  'providers' => [
    // ...
    MauricioBernal\EloquentAuditing\EloquentAuditingServiceProvider::class
  ],
```

Publish the attached migration to generate the audit table in which all transaction will be recorded.

```php
  php artisan vendor:publish --provider="MauricioBernal\EloquentAuditing\EloquentAuditingServiceProvider"
```

Run composer dump-autoload and run the migrations.

```php
  php artisan migrate
```

# Use:

To start registering all transactions you need to add the trait MauricioBernal/EloquentAuditing/Auditing in your eloquent model.

```php
namespace App;
  
use Illuminate\Foundation\Auth\User as Authenticatable;
use MauricioBernal\EloquentAuditing\Auditing;

class User extends Authenticatable
{
    use Auditing;
    // ...
```

* Configuration
 
```php
protected $recordEvents = ['created', 'updated', 'deleted'];
```



## Contributing

Contributions are welcomed; to keep things organized, all bugs and requests should be opened on github issues tab for the main project in [Issues](https://github.com/MauroB45/EloquentAuditing/issues).

All pull requests should be made to the 'dev' branch, so they can be tested before being merged into master.


## License

The laravel-audit package is open source software licensed under the license MIT
