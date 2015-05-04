# Laravel 4 Salesforce

This Laravel 4 package provides an interface for using [Salesforce CRM](http://www.salesforce.com/) through its SOAP API.

[![Latest Stable Version](https://img.shields.io/packagist/v/davispeixoto/laravel-salesforce.svg)](https://packagist.org/packages/davispeixoto/laravel-salesforce)
[![Total Downloads](https://img.shields.io/packagist/dt/davispeixoto/laravel-salesforce.svg)](https://packagist.org/packages/davispeixoto/laravel-salesforce)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/3b9313d5-1340-4459-9973-070e19c289bc/small.png)](https://insight.sensiolabs.com/projects/3b9313d5-1340-4459-9973-070e19c289bc)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/davispeixoto/Laravel-4-Salesforce/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/davispeixoto/Laravel-4-Salesforce/?branch=master)
[![Codacy Badge](https://www.codacy.com/project/badge/a0e8c76d048d441194d4cfb03642bd0c)](https://www.codacy.com/app/davis-peixoto/Laravel-4-Salesforce)
[![Build Status](https://travis-ci.org/davispeixoto/Laravel-4-Salesforce.svg?branch=2.0.5)](https://travis-ci.org/davispeixoto/Laravel-4-Salesforce)

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `davispeixoto/laravel-salesforce`.

```json
    "require": {
        "laravel/framework": "4.*",
        "davispeixoto/laravel-salesforce": "2.0.*"
    }
```

Next, update Composer from the Terminal:

```sh
    composer update
```

Once this operation completes, still in Terminal run:

```sh
	php artisan config:publish davispeixoto/laravel-salesforce
```

### Configuration

Update the settings in the generated `app/config/packages/davispeixoto/laravel-salesforce` configuration file with your salesforce credentials.

Ensure you put [your WSDL file](https://www.salesforce.com/us/developer/docs/api/Content/sforce_api_quickstart_steps_generate_wsdl.htm) into a proper place and make it readable by your Laravel Application. 

**IMPORTANT:** the PHP Force.com Toolkit for PHP only works with Enterprise WSDL

Finally add the service provider. Open `app/config/app.php`, and add a new item to the providers array.

```php
    'Davispeixoto\LaravelSalesforce\LaravelSalesforceServiceProvider'
```

That's it! You're all set to go. Just use:

```php
    Route::get('/test', function() {
        try {
            echo print_r(Salesforce::describeLayout('Account'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            die($e->getMessage() . $e->getTraceAsString());
        }
    });
```

### More Information

Check out the [SOAP API Salesforce Documentation](http://www.salesforce.com/us/developer/docs/api/index_Left.htm)

### License

This Salesforce Force.com Toolkit for PHP port is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

### Versioning

This project follows the [Semantic Versioning](http://semver.org/)

## Thanks

An amazing "Thank you, guys!" for [Jetbrains](https://www.jetbrains.com/) folks, 
who kindly empower this project with a free open-source license for [PhpStorm](https://www.jetbrains.com/phpstorm/) which can bring a whole new level of joy for coding.

[![Jetbrains][2]][1]

[![PhpStorm][4]][3]

  [1]: https://www.jetbrains.com/
  [2]: https://www.jetbrains.com/company/docs/logo_jetbrains.png
  [3]: https://www.jetbrains.com/phpstorm/
  [4]: https://www.jetbrains.com/phpstorm/documentation/docs/logo_phpstorm.png
