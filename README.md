# Laravel Initial Bootstrap

Proyecto de inicio de laravel con Bootstrap.

## Requisitos

-   [PHP8^|"Xammp"](https://www.apachefriends.org/es/download.html).
-   [Composer](https://getcomposer.org/).
-   [Node.js](https://nodejs.org/).
-   [Npm](https://docs.npmjs.com/).
-   [Git](https://git-scm.com/).
-   [Laravel](https://laravel.com/docs/10.x).

###### Problemas/Soluciones

> Actualizar Composer que requiere laravel : Utilizar Consola como Admin.

> Typee: en la Consola:

```console
    composer clearcache
```

**`Nota:` Borra la cache de composer .**

> Typee: en la Consola:

```console
    composer selfupdate
```

**`Nota:` Actualiza composer .**

> Al instalar Laravel hay que asegurarse que en el archivo `php.ini` que esta en la carpeta `C:\xampp\php\php.ini` este hay que descomentar la extension `extension=zip`.

<a name="top"></a>

## Indice de Contenidos.

-   [Instalación](#item1)
-   [Inicializar Git](#item2)
-   [Configuración de librerías FrontEnd](#item3)
    -   [Configurar Jquery y Jquery-UI](#item4)
    -   [Configurar Sass](#item5)
    -   [Configurar Bootstrap](#item6)
    -   [Configurar Vite](#item7)
-   [Sistema de vistas FrontEnd](#item8)
    -   [Layout plantilla web](#item9)
    -   [Configuración de las vistas](#item10)
    -   [Estilos css de las vistas](#item11)
    -   [Componente header de navegación](#item12)
        -   [Sistema de links para el navegador](#item13)
            -   [Creación del helper para leer y guardar archivos json](#item14)
            -   [Creación del archivo json link_nav](#item15)
            -   [Creación del trait LinksNav](#item16)
            -   [Configuración de storage config](#item17)
            -   [Creación del componente button](#item18)
            -   [Creación del componente structure recursive](#item19)
            -   [Creación del componente links](#item20)
        -   [Creación del componente header](#item21)
    -   [Componente footer](#item22)
    -   [Componente alert](#item23)
    -   [Componente toasts](#item24)
-   [Authentication](#item25)
    -   [Componentes de autentificación](#item26)
        -   [Crear componente de tarjeta](#item27)
        -   [Crear componente de los inputs](#item28)
        -   [Crear componente form](#item29)
        -   [Crear componente modal](#item30)
        -   [Crear componente de registro](#item31)
        -   [Crear componentes de login](#item32)


<a name="item1"></a>

## Instalación

### Instalación de Laravel

> Typee: en la Consola:

```console
composer create-project laravel/laravel example-app
```

o

```console
laravel new example-app
```

> [!NOTE]
> El nombre `example-app` lo cambiamos por el nombre de nuestra aplicación.

[Subir](#top)

<a name="item2"></a>

## Inicializar Git

> Typee: en la Consola:

```console
git init
```

### Subir Repositorio a GitHub

> [!IMPORTANT]
> Accedemos a [github](https://github.com/) y creamos un nuevo repositorio una vez creado copiamos la url de dicho repositorio.

> Typee: en la Consola:

```console
git remote add origin URL
```

> Typee: en la Consola:

```console
git config --global user.email "email"
```

> Typee: en la Consola:

```console
git config --global user.name "nombre"
```

> [!TIP]
> Este paso es si no tenemos agregado el nombre y el email en la configuración de git.

> Typee: en la Consola:

```console
git add .
```

> [!NOTE]
> Preparamos los archivos que queremos subir.

> Typee: en la Consola:

```console
git commit -m "Instalación del Proyecto"
```

> [!NOTE]
> Creamos el Comentario y guardamos los archivo modificados o nuevos de nuestro repositorio en local.

> Typee: en la Consola:

```console
git push -f origin master
```

> [!NOTE]
> Subimos los archivos o repositorio local al servidor de github.

[Subir](#top)

<a name="item3"></a>

## Configuración de librerías FrontEnd

<a name="item4"></a>

### Configurar Jquery y Jquery-UI

> Typee: en la Consola:

```console

npm install jquery

```

> Typee: en la Consola:

```console

npm i jquery-ui

```

> En el archivo `bootstrap.js` añadimos:

```js
import $ from "jquery";
window.jQuery = window.$ = $;
```

> [!NOTE]
> El archivo `bootstrap.js` esta ubicado en la carpeta `resources/js/`

[Subir](#top)

<a name="item5"></a>

### Configurar Sass

> Typee: en la Consola:

```console

npm install sass --save-dev

```

> [!IMPORTANT]
> Crear el archivo `app.scss` y la carpeta `scss` en `resources/` y añadimos al archivo `app.scss`:

```scss
@import "/resources/css/app.css";
```

[Subir](#top)

<a name="item6"></a>

### Configurar Bootstrap

> Typee: en la Consola:

```console

npm install bootstrap @popperjs/core

```

> [!NOTE]
> En el archivo que hemos creado [En la configuración de sass](#item4) `app.scss` añadimos:

```scss
@import "~bootstrap/scss/bootstrap";

@import "jquery-ui/dist/themes/base/jquery-ui.css";
```

> [!NOTE]
> Añadiremos también el jquery-ui que instalamos al principio.

> En el archivo `app.js` que esta ubicado `resources/js/` añadimos:

```js
import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;

import "jquery-ui/dist/jquery-ui";
```

> [!NOTE]
> Añadiremos también el jquery-ui que instalamos al principio.

> En el archivo `bootstrap.js` añadimos:

```js
import * as Popper from "@popperjs/core";
window.Popper = Popper;
```

> Abrimos el archivo `AppServiceProvider.php` de la carpeta `app\Providers\AppServiceProvider.php` y dentro del `boot` escribimos lo siguiente.

```php

Paginator::useBootstrap();

```

> Y importamos la clase `Paginator`.

```php

use Illuminate\Pagination\Paginator;

```

[Subir](#top)

<a name="item7"></a>

### Configurar Vite

> Abrimos el archivo `vite.config.js` ubicado en la raíz de nuestro proyecto y lo dejamos de esta manera :

```js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/scss/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
        },
    },
});
```

> [!IMPORTANT]
> Para que todas las configuraciones funcionen hay que añadir en el head de nuestros html la siguiente instrucción `@vite(['resources/scss/app.scss', 'resources/js/app.js'])` :

[Subir](#top)

<a name="item8"></a>

## Sistema de vistas FrontEnd

[Subir](#top)

<a name="item9"></a>

### Layout plantilla web

> Creamos la carpeta `layouts` en la ubicación `resources\views\` dentro creamos el archivo `plantilla.blade.php` y escribimos lo siguiente .

```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title')</title>
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body class="body">
        @yield('content')
    </body>
</html>
```

[Subir](#top)

<a name="item10"></a>

### Configuración de las vistas

> Abrimos el archivo `welcome.blade.php` ubicado en `resources/views/` borramos su contenido y escribimos lo siguiente:

```html
@extends('layouts.plantilla') @section('title', 'Welcome') @section('content')
<main class="container-fluid">
    <h1>Welcome</h1>
</main>
@endsection
```

[Subir](#top)

<a name="item11"></a>

### Estilos css de las vistas

> Abrimos el archivo `app.css` ubicado en `resources/css/` y escribimos lo siguiente:

```css
.center_container {
    display: flex;
    align-items: center;
    justify-content: center;
}
.body {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: auto 1fr auto;
    grid-template-areas:
        "header"
        "main"
        "footer";
    min-height: 100vh;
}
```

> [!IMPORTANT]
> Para que funcionen los estilos hay que cambiar en las configuraciones de bootstrap, accedemos al archivo `_variables.scss` ubicado en `node_modules/bootstrap/scss/` y cambiamos el valor a `$enable-grid-classes: false !default;` y el valor a `$enable-cssgrid: true !default`.

[Subir](#top)

<a name="item12"></a>

### Componente header de navegación

> [!NOTE]
> Antes de empezar a crear el componente de navegación, vamos a crear un sistema de links para el navegador, nos servirá para facilitar la creación de nuestra lista de links.

[Subir](#top)

<a name="item13"></a>

#### Sistema de links para el navegador

<a name="item14"></a>

##### Creación de helper para leer y guardar archivos json

> Creamos una carpeta llamada `helpers` dentro de nuestra carpeta `app` y también creamos un archivo llamado `helpers.php`.

```php
<?php

use Illuminate\Support\Facades\Storage;


// Read json
if (!function_exists('read_json')) {
    function read_json(String $dir, String $storage = "public"): Array
    {
        return Storage::disk($storage)->json($dir);
    }
}

// save json
if (!function_exists('save_json')) {
    function save_json(String $dir, array $array, String $storage = "public"): Bool
    {
        return Storage::disk($storage)->put($dir, json_encode($array));
    }
}
```

> [!IMPORTANT]
> Abrimos nuestro archivo `composer.json` ubicado en la raíz de nuestro proyecto y actualizar la clave autoload para que nuestro archivo helper sea cargado correctamente por Composer.

> Añadimos el siguiente código en la clave `autoload` debajo de `psr-4`

```json

"files": [
    "app/helpers/helpers.php"
]

```

> Typee: en la Consola:

```console

composer dump-autoload

```

[Subir](#top)

<a name="item15"></a>

##### Creación del archivo json link_nav

> Creamos la carpeta `config` y el archivo `link_nav.json` en la ubicación `storage/app/config`.

```json
{
    "links": {
        "welcome": {
            "name": "Welcome",
            "slug": "welcome",
            "type": "link",
            "route": "welcome",
            "class": "nav-link"
        }
    }
}
```

[Subir](#top)

<a name="item16"></a>

##### Creación del trait LinksNav

> Creamos la carpeta `Traits` y el archivo `LinksNav.php` en la ubicación `/app/Traits` y escribimos:

```php

<?php

namespace App\Traits;

trait LinksNav
{
    public static function Links()  {
        return read_json("link_nav.json", "config");
    }
}

```

[Subir](#top)

<a name="item17"></a>

##### Configuración de storage config

> Abrimos el archivo `filesystems.php` en la ubicación `/config` en la clave `disks` y escribimos:

```php
'config' => [
    'driver' => 'local',
    'root' => storage_path('app/config'),
    'url' => env('APP_URL') . '/storage',
    'visibility' => 'private',
    'throw' => false,
],
```

> [!IMPORTANT]
> Tendremos que configurar la variable `FILESYSTEM_DISK` en local normalmente ya esta configurada por defecto.

[Subir](#top)

<a name="item18"></a>

##### Creación del componente button

> Typee: en la Consola:

```console

php artisan make:component dom/Button

```

> Abrimos el archivo `Button.php` en la ubicación `app/View/Components/dom/` y escribimos:

```php
   public function __construct(
        public String $type = 'button',
        public String|Null $class = null,
        public String|Null $route = null,
        public String|Null $name = null,
        public array|Null $tooltip = null,
        public String|Null $id = null,
        public String|Null $position = null,
        public String|Null $form = null,

    ) {
        // Code ...
    }
```

> Abrimos el archivo `button.blade.php` en la ubicación `resources/view/components/dom/` y escribimos:

```html
@switch($type) @case('link')
<a href="{{ $route ?? '#' }}" {{ $attributes-
    >merge(['class' => "$class"]) }} id="{{ $id ?? '' }}" @isset($tooltip) @if
    ($tooltip != null && $tooltip != '') data-bs-toggle="tooltip"
    data-bs-placement="{{ $tooltip['position'] }}" @isset($tooltip['class'])
    data-bs-custom-class="{{ $tooltip['class'] }}" @endisset
    data-bs-title="@lang($tooltip['text'])" @endif @endisset > {{ $slot }}
</a>
@break @case('submit')
<button type="submit" {{ $attributes->
    merge(['class' => "btn $class"]) }} id="{{ $id ?? '' }}" @isset($form)
    form="{{ $form }}" @endisset @isset($tooltip) @if ($tooltip != null &&
    $tooltip != '') data-bs-toggle="tooltip" data-bs-placement="{{
    $tooltip['position'] }}" @isset($tooltip['class']) data-bs-custom-class="{{
    $tooltip['class'] }}" @endisset data-bs-title="@lang($tooltip['text'])"
    @endif @endisset> {{ $slot }}
</button>
@break @case('dropdown')
<div class="{{ $position }}">
    <button type="button" {{ $attributes->
        merge(['class' => "dropdown-toggle btn $class"]) }} id="{{ $id ?? '' }}"
        data-bs-toggle="dropdown" aria-expanded="false"
        data-bs-auto-close="outside" @isset($tooltip) @if ($tooltip != null &&
        $tooltip != '') data-bs-toggle="tooltip" data-bs-placement="{{
        $tooltip['position'] }}" @isset($tooltip['class'])
        data-bs-custom-class="{{ $tooltip['class'] }}" @endisset
        data-bs-title="@lang($tooltip['text'])" @endif @endisset> {{--
        <x-slot:title> Esto es el titulo del botón </x-slot:title> --}} {{
        $title }}
    </button>
    {{ $slot }}
</div>
@break @default
<button type="button" {{ $attributes->
    merge(['class' => "btn $class"]) }} id="{{ $id ?? '' }}" @if(isset($route) && $type != 'modal')
            onclick="{{ $route }}"
        @endif
        @if ($type == 'modal')
            data-bs-toggle="modal" data-bs-target="#{{ $route }}"
        @endif
        @isset($tooltip) @if ($tooltip != null &&
    $tooltip != '') data-bs-toggle="tooltip" data-bs-placement="{{
    $tooltip['position'] }}" @isset($tooltip['class']) data-bs-custom-class="{{
    $tooltip['class'] }}" @endisset data-bs-title="@lang($tooltip['text'])"
    @endif @endisset> {{ $slot }}
</button>
@endswitch
```

> [!NOTE]
> El componente `Button` lo dividimos por tipos de botones que podemos tener siéntase libre de investigar modificar o añadir cada tipo para adaptarlo a tus necesidades.

[Subir](#top)

<a name="item19"></a>

##### Creación del componente structure recursive

> [!TIP]
> Este componente lo creamos con la intención de recorrer infinitamente el array multidimensional, que hemos generado en el archivo `link_nav.json`.

```console

php artisan make:component nav.partials.structure --view

```

> Abrimos el archivo `structure.blade.php` ubicado `resources/views/components/nav/partials/` y escribimos:

```html
@props(['items']) @foreach ($items as $item)
<li class="nav-item">
    <x-dom.button
        :type="$item['type']"
        :id="$item['slug']"
        :class="(isset($item['route']) && request()->routeIs($item['route']) ? $item['class']. ' active disabled' : $item['class'])"
        :route="(isset($item['route'])) ? $item['route'] : null"
        :position="(isset($item['position'])) ? $item['position'] : ''"
    >
        @if ($item['type'] == 'dropdown')
        <x-slot:title> {{ $item['name'] }} </x-slot:title>
        @else {{ $item['name'] }} @endif @if (isset($item['items']))
        <ul class="dropdown-menu">
            <x-nav.partials.structure :items="$item['items']" />
        </ul>
        @endif
    </x-dom.button>
</li>
@endforeach
```

[Subir](#top)

<a name="item20"></a>

##### Creación del componente links

> Typee: en la Consola:

```console

php artisan make:component nav/Links

```

> Abrimos el archivo `Links.php` en la ubicación `app/View/Components/nav/` y escribimos:

```php

use LinksNav;

public $links;
/**
 * Create a new component instance.
 */
public function __construct(
    public String|Null $name = null,
    public String|Null $class = null
) {
    $this->links = $this->Links();
}

```

> [!IMPORTANT]
> Importar el namespace `use App\Traits\LinksNav;`

> Abrimos el archivo `links.blade.php` en la ubicación `resources/view/components/nav/` y escribimos:

```html
@foreach ($links as $link => $buttons) @if ($link == $name)
<ol class="navbar-nav">
    @foreach ($buttons as $button)
    <li class="nav-item">
        <x-dom.button
            :type="$button['type']"
            :id="$button['slug']"
            :class="(isset($button['route']) && request()->routeIs($button['route']) ? $button['class']. ' active disabled' : $button['class'])"
            :route="(isset($button['route'])) ? $button['route'] : ''"
            :position="(isset($button['position'])) ? $button['position'] : ''"
        >
            @if ($button['type'] == 'dropdown')
            <x-slot:title> {{ $button['name'] }} </x-slot:title>
            @else {{ $button['name'] }} @endif @if (isset($button['items']))
            <ul class="dropdown-menu">
                <x-nav.partials.structure :items="$button['items']" />
            </ul>
            @endif
        </x-dom.button>
    </li>
    @endforeach
</ol>
@endif @endforeach
```

[Subir](#top)

<a name="item21"></a>

#### Creación del componente header

> Typee: en la Consola:

```console

php artisan make:component layouts.header --view

```

> Abrimos el archivo `header.blade.php` en la ubicación `resources/view/components/layouts/` y escribimos:

```html
<header class="bg-light border-bottom">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">{{ env('APP_NAME') }}</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div
                class="collapse navbar-collapse justify-content-between"
                id="navbarNav"
            >
                <x-nav.links name="links" />
            </div>
        </div>
    </nav>
</header>
```

> [!WARNING]
> He creado una regla css para modificar el posicionamiento del menu desplegable por el botón dropdown de bootstrap ya que este tiene un atributo `data-bs-offset` para poder posicionar el menu, pero por alguna razón la clase `navbar` bloquea. Lo he posicionado a la altura del menu de navegación.

> Creamos el archivo `header.scss` ubicado en `resources/scss/` y escribimos:

```scss
#navbarNav {
    div.dropdown {
        .dropdown-menu[data-bs-popper] {
            margin-top: 8px !important;
        }
    }
}
```

> [!IMPORTANT]
> Tenemos que `@import"header";` en el archivo `app.scss` para que nuestro proyecto lo procese.

> Abrimos el archivo `plantilla.blade.php` ubicado en `resources/views/layouts/` añadimos el componente header

```html
<body class="body">
    <x-layouts.header />
    @yield('content')
</body>
```

[Subir](#top)

<a name="item22"></a>

### Componente footer

> Typee: en la Consola:

```console

php artisan make:component layouts.footer --view

```

> Abrir el archivo `footer.blade.php` en la ubicación `resources/views/components/layouts/`

```html
<footer class="bg-light text-center text-lg-start border-top footer-dashboard">
    <div class="text-center p-3 bg-body-tertiary">
        © {{ date('Y') }}
        <a href="{{config('app.url')}}">{{config('app.name')}}</a>. @lang('All
        rights reserved.')
    </div>
</footer>
```

> Abrimos el archivo `plantilla.blade.php` ubicado en `resources/views/layouts/` añadimos el componente header

```html
<body class="body">
    <x-layouts.header />
    @yield('content')
    <x-layouts.footer />
</body>
```

[Subir](#top)

<a name="item23"></a>

### Componente alert

> Typee: en la Consola:

```console

php artisan make:component messages/Alert

php artisan make:component messages.partials.icons --view

```

> Abrir el archivo `icons.blade.php` en la ubicación `resources/views/components/messages/

```html
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="success-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
        />
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"
        />
    </symbol>
    <symbol id="warning-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
        />
    </symbol>
    <symbol id="danger-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"
        />
    </symbol>
</svg>
```

> Abrimos el archivo `Alert.php` en la ubicación `app/View/Components/messages/` y escribimos:

```php

public function __construct(
    public String $type = 'danger',
    public Bool $close = true,
    public Bool $icon = true,
) {
    //
}

```

> Abrir el archivo `alert.blade.php` en la ubicación `resources/views/components/messages/`

```html
<x-messages.partials.icons />
<div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
    @if ($icon)
    <svg
        class="bi flex-shrink-0 me-2"
        width="24"
        height="24"
        role="img"
        aria-label="{{ $type }}:"
    >
        <use xlink:href="#{{ $type }}-fill" />
    </svg>
    @endif {{ $slot }} @if ($close)
    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"
    ></button>
    @endif
</div>
```

[Subir](#top)

### Componente toasts

```console

php artisan make:component messages/Toasts

```

> Abrimos el archivo `Toasts.php` en la ubicación `app/View/Components/messages/` y escribimos:

```php

public function __construct(
    public String $type = 'success',
        public Bool $close = true,
        public Bool $icon = true,
        public Int $delay = 5000,
        public String $autohide = 'true',
        public String $position = 'top-0 end-0'
) {
    //
}

```

> Abrimos el archivo `toasts.blade.php` en la ubicación `resources/views/components/messages/` y escribimos:

```html

<x-messages.partials.icons />

<div class="toast {{ $type != 'info' ? 'text-white' : '' }} bg-{{ $type }}" role="alert" aria-live="assertive"
    aria-atomic="true" data-bs-delay="{{ $delay }}" data-bs-autohide="{{ $autohide }}">
    <div class="toast-header {{ $type != 'info' ? 'text-white' : '' }} bg-{{ $type }}">
        @if ($icon)
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                aria-label="{{ ucfirst($type) }} :">
                <use xlink:href="#{{ $type }}-fill" />
            </svg>
        @endif
        <strong class="me-auto">@lang(ucfirst($title))</strong>
        <small id="date_toast" class="{{ $type != 'info' ? 'text-white' : '' }}"></small>
        <button id="close_toats" type="button" class="btn-close {{ $type != 'info' ? 'btn-close-white' : '' }}"
            aria-label="Close"></button>
    </div>
    <div class="toast-body">
        {{ $slot }}
    </div>
    @if ($autohide == 'true')
        <div class="progress rounded-bottom justify-content-end bg-gray-400" style="height: 7px;">
            <div class="progress-bar bg-{{ $type }}" role="progressbar"></div>
        </div>
    @endif
</div>


```

> Creamos el archivo `toasts.scss` en la ubicación `resources/scss/` y escribimos:

```scss
.toast {
    animation-name: open_toast;
    animation-duration: 500ms;
    animation-timing-function: ease-out;
}
.toast .progress {
    border-radius: 0;
}

.close-toast {
    animation-name: close_toast;
    animation-duration: 2s;
    animation-timing-function: ease-out;
    animation-fill-mode: forwards;
}

.bg-gray-400 {
    background-color: $gray-400;
}

@keyframes open_toast {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
@keyframes close_toast {
    from {
        transform: translateY(0);
        opacity: 1;
    }
    to {
        transform: translateY(-100%);
        opacity: 0;
    }
}
@keyframes progress_toast {
    from {
        width: 0%;
    }
    to {
        width: 100%;
    }
}
```

> Creamos el archivo `toasts.js` en la ubicación `resources/js/` y escribimos:

```js

$(function () {
    $(".toast").toast("show");
});

$(".toast").on("shown.bs.toast", function () {
    let dt = new Date();
    let time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    $(this).children(".toast-header").children("#date_toasts").html(time);

    let progress_bar = {
        "animation-name": "progress_toast",
        "animation-fill-mode": "forwards",
        "animation-duration": $(this).data("bs-delay") + "ms",
        "animation-timing-function": "ease-out",
        "animation-iteration-count": "1",
    };

    if ($(this).data("bs-autohide")) {
        $(this).children(".progress").children("div").css(progress_bar);
    }
});

$("#close_toats").on("click", function () {
    $(this).closest(".toast").addClass("close-toast");
    setTimeout(() => {
        $(this).closest(".toast").toast("hide");
    }, 2500);
});

$(".toast").on("hidden.bs.toast", function () {
    $(this).addClass("close-toast");
});


```

> [!IMPORTANT]
> Y importamos los archivos creados el css  `@import "./toasts"` en  `app.scss` y el otro `import "toasts.js"` en  `app.js`

> Creamos el archivo `toasts.blade.php` en la ubicación `resources/views/messages/` y escribimos:

```html

@if (session('message'))
    <div class="toast-container position-absolute {{ session('message')['position'] ?? 'top-0 end-0' }} p-3">
        <x-messages.toasts type="{{ session('message')['type'] ?? 'info' }}"
            delay="{{ session('message')['delay'] ?? '5000' }}" :autohide="session('message')['autohide'] ?? 'true'" :icon="session('message')['icon'] ?? true">
            <x-slot:title>
                {{ session('message')['title'] ?? '' }}
            </x-slot:title>
            {{ session('message')['message'] ?? '' }}
        </x-messages.toasts>
    </div>
@endif


```

> Abrimos el archivo `plantilla.blade.php` ubicado en `resources/views/layouts/` añadimos el componente toasts

```html

<body class="body">
    <x-layouts.header />
    @include('messages.toasts')
    @yield('content')
    <x-layouts.footer />
</body>

```

[Subir](#top)

<a name="item25"></a>

## Authentication

<a name="item26"></a>

### Componentes de autentificación

<a name="item27"></a>

#### Crear componente de tarjeta

> Typee: en la Consola:

```console

php artisan make:component dom.card --view

```

> Abrimos el archivo `card.blade.php` en la ubicación `resources/views/components/dom/` y escribimos:

```html

@props(['class' => ''])

<div {{ $attributes->class(['card ' . $class]) }}>
    {{ $header ?? '' }}
    <div class="card-body">
        {{ $slot }}
    </div>
    {{ $footer ?? '' }}
</div>

```

[Subir](#top)

<a name="item28"></a>

#### Crear componente de los inputs

> Typee: en la Consola:

```console

php artisan make:component dom/Input

```

> Abrimos el archivo `Input.php` en la ubicación `app/View/Components/dom/` y escribimos:

```php

public function __construct(
    public String $name,
    public String $type = 'text',
    public String|Null $id = null,
    public String|Bool $label = false,
    public String $class = '',
    public String $placeholder = '',
    public Bool $readonly = false,
    public Bool $disabled = false,
    public String $value = '',
    public String|Null $form = null,
    public Int $col = 10,
    public Int $rows = 5,
) {
    //
}

```

> Abrimos el archivo `input.blade.php` en la ubicación `resources/views/components/dom/` y escribimos:

```html

@if ($label)
    <label for="{{ $id ?? '' }}" class="ms-1">
        @lang($label)
    </label>
@endif

@switch($type)
    @case('textarea')
        <textarea type="textarea" name="{{ $name }}" {{ $attributes->merge(['class' => "form-control $class"]) }} placeholder="{{ $placeholder }}" clo="{{ $col }}" rows="{{ $rows }}"
        @if ($readonly)
            @readonly(true)
        @endif
        @if ($disabled)
            @disabled(true)
        @endif
        @if ($form)
            form="{{ $form }}"
        @endif
        >
            {{ old($name, $slot) }}
        </textarea>
    @break

    @default
        <input type="{{ $type }}" name="{{ $name }}" {{ $attributes->merge(['class' => "form-control $class"]) }} placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}"
        @if ($readonly)
            @readonly(true)
        @endif
        @if ($disabled)
            @disabled(true)
        @endif
        @if ($form)
            form="{{ $form }}"
        @endif
        >
@endswitch

```

[Subir](#top)

<a name="item29"></a>

#### Crear componente form

> Typee: en la Consola:

```console

php artisan make:component dom/Form

```

> Abrimos el archivo `Form.php` en la ubicación `app/View/Components/dom/` y escribimos:

```php

public function __construct(
    public String $action = '#',
    public String $method = 'GET',
    public String $enctype = 'multipart/form-data',
    public Bool $valid = true,
    public String|Null $id = null,
) {
    //
}

```

> Abrimos el archivo `form.blade.php` en la ubicación `resources/views/components/dom/` y escribimos:

```html

<form id="{{$id ?? ''}}" action="{{$action}}"
@if (strtoupper($method) == 'GET')
    method="{{strtoupper($method) }}"
@else
    method="POST"
@endif
 enctype="{{$enctype}}"
@if ($valid)
    onsubmit="return validateForm(event)"
@endif
>
    @if (strtoupper($method) != 'GET')
    @csrf
    @endif
    @if (strtoupper($method) != 'GET' && strtoupper($method) != 'POST')
        @method($method)
    @endif
    {{$slot}}
</form>

```

> Creamos el archivo `functions.js` en la ubicación `resources/js/` lo abrimos y escribimos:

```js

// Función que valida los formularios.
function validateForm(e) {
    let form = $(e.target);
    let valid = false;

    form.find("input, select, textarea").each(function (i, element) {
        if (element.type != "hidden" && $(element).val() != "") {
            valid = true;
        }
    });
    if ($(e.target).attr("id") != "") {
        $(
            "input[form=" +
                $(e.target).attr("id") +
                "], select[form=" +
                $(e.target).attr("id") +
                "], textarea[form=" +
                $(e.target).attr("id") +
                "]"
        ).each(function (i, element) {
            if (element.type != "hidden" && $(element).val() != "") {
                valid = true;
            }
        });
    }

    return valid;
}
window.validateForm = validateForm;

// Función que activa o desactiva el botón del formulario.
$("form, input, select, textarea").on("change", function (e) {

    let btn = null;
    let form = $(e.target).parents("form")[0];


    if (form == undefined) {

        form = $("#" + $(e.target).attr("form"));
    }

    $(form)
        .find('button[type="submit"]')
        .each(function () {
            btn = this;
        });

    if ($(e.target).val() === "") {

        $(btn).addClass("disabled");

    } else {

        $(btn).removeClass("disabled");

    }

    $(form)
        .find("input, select, textarea")
        .each(function () {
            if (this.type != "hidden" && $(this).val() != "") {
                $(btn).removeClass("disabled");
                return false;
            }
        });

});

```

> [!IMPORTANT]
> Y importamos el archivo `import "./functions";"` en  `app.js`

[Subir](#top)

<a name="item30"></a>

#### Crear componente modal

> Typee: en la Consola:

```console

php artisan make:component dom/Modal

```

> Abrimos el archivo `Modal.php` en la ubicación `app/View/Components/dom/` y escribimos:

```php

public function __construct(
    public String $id,
    public String $class = '',
    public Bool $header = true,
    public String|Bool $footer = false,
    public String $title = '',
    public Bool $close = true,
    public Bool $static = true,
    public Bool $scrollable = false,
    public Bool $centered = false
) {
    //
}

```

> Abrimos el archivo `modal.blade.php` en la ubicación `resources/views/components/dom/` y escribimos:

```html

<div id="{{ $id }}" class="modal fade" tabindex="-1" aria-hidden="true"
    @if ($static) data-bs-backdrop="static" data-bs-keyboard="false" @endif>
    <div class="modal-dialog {{ $centered ? 'modal-dialog-centered' : '' }} {{ $scrollable ? 'modal-dialog-scrollable' : '' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                @if ($close)
                    <x-dom.button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></x-dom.button>
                @endif
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            @if ($footer)
                <div class="modal-footer">
                    @if ($close)
                        <x-dom.button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Close</x-dom.button>
                    @endif
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>

```

[Subir](#top)

<a name="item31"></a>

#### Crear componentes de registro

> Typee: en la Consola:

```console

php artisan make:component auth.singup.partials.form --view

php artisan make:component auth.singup.partials.card --view

php artisan make:component auth.singup.partials.modal --view

```

> Abrimos el archivo `form.blade.php` en la ubicación `resources/view/components/auth/singup/partials/` y escribimos:

```html

<div class="grid align-items-center" style="--bs-gap: 1rem;">
    <div class="g-col-12">
        <x-dom.input type="text" label="Name" name="name" placeholder="You Name or Username" form="form_register" />
    </div>
    <div class="g-col-12">
        <x-dom.input type="email" name="email" label="Email address" placeholder="You Email address"
            form="form_register" />
    </div>
    <div class="g-col-12">
        <x-dom.input type="password" name="password" label="Password" placeholder="You Password" form="form_register" />
    </div>
    <div class="g-col-12">
        <x-dom.input type="password" label="Password Confirmation" name="password_confirmation"
            placeholder="You Confirmation Password" form="form_register" />
    </div>
</div>

```

> Abrimos el archivo `card.blade.php` en la ubicación `resources/view/components/auth/singup/partials/` y escribimos:

```html

<x-dom.card>
    <x-slot:header>
        <div class="card-header">
            Sing Up
        </div>
    </x-slot:header>
    <x-auth.singup.partials.form />
    <x-slot:footer>
        <div class="card-footer d-flex justify-content-end">
            <x-dom.form id="form_register">
                <x-dom.button type="submit" class="btn-primary disabled">
                    @lang('Sing Up')
                </x-dom.button>
            </x-dom.form>
        </div>
    </x-slot:footer>
</x-dom.card>

```

> Abrimos el archivo `modal.blade.php` en la ubicación `resources/view/components/auth/singup/partials/` y escribimos:

```html

<x-dom.modal id="singup" :centered="true" class="modal-fullscreen-md-down">
    <x-slot:title>
        @lang('Sing Up')
    </x-slot:title>
    <x-auth.singup.partials.form/>
    <x-slot:footer>
        <x-dom.form id="form_register">
            <x-dom.button type="submit" class="btn-primary disabled">
                @lang('Sing Up')
            </x-dom.button>
        </x-dom.form>
    </x-slot:footer>
</x-dom.modal>

```

> Abrimos el archivo `link_nav.json` en la ubicación `storage/app/config` y creamos una nueva lista.

```json
{
    "links": {
        "welcome": {
            "name": "Welcome",
            "slug": "welcome",
            "type": "link",
            "route": "welcome",
            "class": "nav-link"
        }
    },
    "login": {
        "singup": {
            "name": "Sing Up",
            "slug": "sing-up",
            "type": "modal",
            "route": "singup",
            "class": "nav-link"
        }
    }
}
```


> Abrimos el archivo `header.blade.php` en la ubicación `resources/view/components/layouts/` y escribimos:

```html

    <x-nav.links name="links" />
@guest
    <x-nav.links name="login" />
@endguest

```

> Abrimos el archivo `welcome.blade.php` en la ubicación `resources/view/` y añadimos:

```html

<x-auth.singup.partials.modal/>

```

> Creamos el archivo `register.blade.php` en la ubicación `resources/view/auth/` y añadimos:

```html

@extends('layouts.plantilla')
@section('title', trans('Sign Up'))
@section('content')
    <main class="container-fluid">
        <div class="grid align-items-center" style="--bs-columns: 3; --bs-gap: 1rem;">
            <div class="g-col-3 g-col-lg-1 g-start-lg-2">
                <x-auth.singup.partials.card />
            </div>
        </div>
    </main>
@endsection

```

[Subir](#top)

<a name="item32"></a>

#### Crear componentes de login

> Typee: en la Consola:

```console

php artisan make:component auth.singin.partials.form --view

php artisan make:component auth.singin.partials.card --view

php artisan make:component auth.singin.partials.modal --view

```

> Abrimos el archivo `form.blade.php` en la ubicación `resources/view/components/auth/singin/partials/` y escribimos:

```html

<div class="grid align-items-center" style="--bs-gap: 1rem;">
    <div class="g-col-12">
        <x-dom.input type="email" name="email" label="Email address" placeholder="You Email address"
            form="form_register" />
    </div>
    <div class="g-col-12">
        <div class="d-flex justify-content-between">
            <label class="align-self-center" for="">@lang('Password')</label>
            <x-dom.button type='modal' class="btn-sm me-1 btn-link" name="forgot-password">
                @lang('Forgot Your Password?')
            </x-dom.button>
        </div>
        <x-dom.input type="password" name="password" placeholder="You Password" form="form_register" />
    </div>
    <div class="g-col-12 text-center">
        <div class="form-check form-switch d-flex justify-content-center">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="remember" form="form_register">
            <label class="form-check-label ms-1" for="flexSwitchCheckDefault">
                @lang('Remember Me')
            </label>
        </div>
    </div>
</div>


```

> Abrimos el archivo `card.blade.php` en la ubicación `resources/view/components/auth/singin/partials/` y escribimos:

```html

<x-dom.card>
    <x-slot:header>
        <div class="card-header">
            Sing In
        </div>
    </x-slot:header>
    <x-auth.singin.partials.form />
    <x-slot:footer>
        <div class="card-footer d-flex justify-content-end">
            <x-dom.form id="form_register">
                <x-dom.button type="submit" class="btn-primary disabled">
                    @lang('Sing In')
                </x-dom.button>
            </x-dom.form>
        </div>
    </x-slot:footer>
</x-dom.card>


```

> Abrimos el archivo `modal.blade.php` en la ubicación `resources/view/components/auth/singin/partials/` y escribimos:

```html

<x-dom.modal id="singin" :centered="true" class="modal-fullscreen-md-down">
    <x-slot:title>
        @lang('Sing In')
    </x-slot:title>
    <x-auth.singin.partials.form/>
    <x-slot:footer>
        <x-dom.form id="form_register">
            <x-dom.button type="submit" class="btn-primary disabled">
                @lang('Sing In')
            </x-dom.button>
        </x-dom.form>
    </x-slot:footer>
</x-dom.modal>

```

> Abrimos el archivo `link_nav.json` en la ubicación `storage/app/config` y creamos una nueva lista.

```json
{
    "links": {
        "welcome": {
            "name": "Welcome",
            "slug": "welcome",
            "type": "link",
            "route": "welcome",
            "class": "nav-link"
        }
    },
    "login": {
        "singin": {
            "name": "Sing In",
            "slug": "sing-in",
            "type": "modal",
            "route": "singin",
            "class": "nav-link"
        },
        "singup": {
            "name": "Sing Up",
            "slug": "sing-up",
            "type": "modal",
            "route": "singup",
            "class": "nav-link"
        }
    }
}
```

> Abrimos el archivo `welcome.blade.php` en la ubicación `resources/view/` y añadimos:

```html

<x-auth.singin.partials.modal />

```

> Creamos el archivo `login.blade.php` en la ubicación `resources/view/auth/` y añadimos:

```html

@extends('layouts.plantilla')
@section('title', trans('Sign In'))
@section('content')
    <main class="container-fluid">
        <div class="grid align-items-center" style="--bs-columns: 3; --bs-gap: 1rem;">
            <div class="g-col-3 g-col-lg-1 g-start-lg-2">
                <x-auth.singin.partials.card />
            </div>
        </div>
    </main>
@endsection

```

[Subir](#top)

> Pues eso es todo espero que sirva. 👍

[Subir](#top)
