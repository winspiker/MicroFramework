<p align="center">
    <a href="https://medoo.in" target="_blank"><img width="350" src="https://repository-images.githubusercontent.com/48094950/a69b6180-a1a8-11ea-860f-32cc0caa3d5f"></a>
</p>


> The lightweight PHP database framework to accelerate development

## Features

* **Easy** - Easy to learn and use, friendly construction.

* **Composer** - Installation via composer.

* **Free** - You can use it anywhere, whatever you want.

## Requirement

PHP 7.3+

## Get Started

### Install via composer

Run composer install
```
$ composer install
```
### <span style="color: rgba(255,1,1,0.6)"> Create rewrite rules for the URL rewrite module
### Add new routes
Path ~/resources/routes.php
```php
$this->router->add('routeName', '/some/route', [SomeController::class, "someMethod"]);
```

### Add new controller
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
Path ~/templates/templateName.blade.php
```php

// Name of extends file.
@extends('SomeExtends')


@section('content')
        <h1 class="display-4 fw-normal">Some Page <?= $name ?></h1>
        <p class="fs-5 text-muted">This is $variableName</p>
@endsection
```


### Create new parent template
Path ~/templates/SomeExtends.blade.php
```html
<!--some html code-->

<div>
<!--The place where your template content will be inserted-->
    @yield('content')
</div>

<!--some html code-->
```

### Go to - www.some.url/some/route
