Laravel 4 MaxMind DB Reader
===========================

This Laravel 4 package provides a simple interface for [MaxMind DB Reader](https://github.com/maxmind/MaxMind-DB-Reader-php).

Installation
------------

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `davispeixoto/maxmind-db-reader`.

	"require": {
		"laravel/framework": "4.1.*",
		"davispeixoto/maxmind-db-reader": "dev-master"
	},
	"minimum-stability" : "dev"

Next, update Composer from the Terminal:

    composer update

Once this operation completes, still in Terminal run:

	php artisan config:publish davispeixoto/maxmind-db-reader
	
Update the settings in the generated `app/config/packages/davispeixoto/maxmind-db-reader` configuration file with the location of your maxmind db file.

Finally add the service provider. Open `app/config/app.php`, and add a new item to the providers array.

    'Davispeixoto\MaxmindDbReader\MaxmindDbReaderServiceProvider'

That's it! You're all set to go. Just use:

    Route::get('/test', function() {
    	echo print_r(MaxmindDbReader::get($_SERVER['REMOTE_ADDR']) , true);
    });

### License

This MaxMind DB Reader port is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

### Versioning

This projetct follows the [Semantic Versioning](http://semver.org/)