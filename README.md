<div align="center">

# MicroFramework

**MicroFramework** is a simple MVC engine for PHP.

[Features](#features) •
[Requirement](#requirement) •
[Installation](#installation) •
[Configuration](#configuration)

</div>




## Features

* **Easy** - Easy to learn and use, friendly construction.

* **Composer** - Installation via composer.

* **Free** - You can use it anywhere, whatever you want.

## Requirement

PHP 7.3+

## Installation

### Install via composer

Run [composer](https://getcomposer.org/) install
```
$ composer install
```

## Configuration
#
### *Create rewrite rules for the URL rewrite module

### Add new routes
Path /resources/routes.php
```php
$this->router->add('routeName', '/some/route', [SomeController::class, "someMethod"]);
```

### Add new controller
Path /src/Main/Controller/SomeController.php
```php
class SomeController extends Controller
{

    /**
     * Some page
     */
    public function index(): Response
    {
        $content = $this->view->render('templateName', ['variableName' => 'value']);
        return new Response($content);
    }
```

### Create new template page
Path /templates/templateName.blade.php
```php

// Name of extends file.
@extends('SomeExtends')


@section('content')
        <h1">Some Page</h1>
        <p class="fs-5 text-muted"> This is <?= $variableName ?> </p>
@endsection
```


### Create new parent template
Path /templates/SomeExtends.blade.php
```html
<!--some html code-->

<div>
    <!--The place where your template content will be inserted-->
    @yield('content')
</div>

<!--some html code-->
```

### Go to - www.some.url/some/route
