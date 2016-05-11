## String Blade Compiler

Originally forked from [Flynsarmy/laravel-db-blade-compiler](https://github.com/Flynsarmy/laravel-db-blade-compiler)

### Render Blade templates from a string

This package generates and returns a compiled view from a provided string

### Installation (Laravel 5.x)

Require this package in your composer.json and run composer update (or run `composer require digivo/laravel-string-blade-compiler:1.*` directly):

    "digivo/laravel-string-blade-compiler": "1.*"

After updating composer, add the ServiceProvider to the providers array in app/config/app.php

    'Digivo\StringBladeCompiler\StringBladeCompilerServiceProvider',

and the Facade to the aliases array in the same file

    'StringView'          => 'Digivo\StringBladeCompiler\Facades\DigivoView',

You have to also publish the config-file

    php artisan vendor:publish


### Usage

This package offers a `StringView` facade with the same syntax as `View` but accepts a string instead of path to view.

    return StringView::make('@if ($foo == "Bar") foo is Bar @else foo is not Bar @endif')->with(['foo' => 'Bar'])->render();


### License

string-blade-compiler is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
