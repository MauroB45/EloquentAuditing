## EloquentAuditing Package

php require MauricioBernal\EloquentAuditing

MauricioBernal\EloquentAuditing\EloquentAuditingServiceProvider::class

php artisan vendor:publish --provider="MauricioBernal\EloquentAuditing\EloquentAuditingServiceProvider"

php artisan migrate


USE:

use Auditing;

protected $recordEvents = ['created'];
