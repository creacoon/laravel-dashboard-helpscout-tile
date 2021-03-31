# A short description of the tile

[![Latest Version on Packagist](https://img.shields.io/packagist/v/creacoon/laravel-dashboard-helpscout-tile.svg?style=flat-square)](https://packagist.org/packages/creacoon/laravel-dashboard-helpscout-tile)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/creacoon/laravel-dashboard-helpscout-tile/run-tests?label=tests)](https://github.com/creacoon/laravel-dashboard-helpscout-tile/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/creacoon/laravel-dashboard-helpscout-tile.svg?style=flat-square)](https://packagist.org/packages/creacoon/laravel-dashboard-helpscout-tile)

This tile displays the amount of active tickets, pending tickets and the amount of tickets that have been solved today. 

This tile can be used on [the Laravel Dashboard](https://docs.spatie.be/laravel-dashboard).

## Installation

1. Require the package via composer
1. Place all the necessary information in the config file, use the template below. ('app_id', 'app_secret' and 'mailboxes' are necessary. The others are optional.) (read https://developer.helpscout.com/docs-api/ for information about generating api keys)
1. Place the tile component in your dashboard. Fill in the `mailboxId` in the tag.
1. Schedule the command in the kernel.php.

### Composer
You can install the package via composer:
```bash
composer require creacoon/laravel-dashboard-helpscout-tile 
```

### Config file
In the `dashboard` config file, you must add this configuration in the `tiles` key. The `mailboxes` should contain an array of mailbox id's that you want to use on the dashboard.

```php
// in config/dashboard.php

return [
    // ...
    'tiles' => [
         'helpscout' => [
            'app_id' => env('HELPSCOUT_APP_ID'),
            'app_secret' => env('HELPSCOUT_APP_SECRET'),
            'mailboxes' => explode(',', env('HELPSCOUT_MAILBOXES')),
            'active_tickets_full_alert' => 10,
            'refresh_interval_in_seconds' => 60,
            'no_active_tickets_text' => 'There are no tickets!',
        ]
    ],
];
```
### Tile component
In your dashboard view you use the `livewire:helpscout-tile` component.
```html
<x-dashboard>
    <livewire:helpscout-tile position="e7:e16" mailboxId="123456"/> 
</x-dashboard>
```

### Schedule command
In `app\Console\Kernel.php` you should schedule the following commands.

```php
protected function schedule(Schedule $schedule)
{
    // ...
           $schedule->command(FetchDataFromHelpscoutCommand::class)->everyFiveMinutes();
}
```

### Customizing the view
If you want to customize the view used to render this tile, run this command:

```php
php artisan vendor:publish --tag="dashboard-helpscout-tile-views"
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email support@creacoon.nl instead of using the issue tracker.

## Credits

- [Dion Nijssen](https://github.com/dion213)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
