# Laravel Initial Bootstrap

Proyecto de inicio de laravel con Bootstrap.

## Requisitos

- [PHP8^|"Xammp"](https://www.apachefriends.org/es/download.html).
- [Composer](https://getcomposer.org/).
- [Node.js](https://nodejs.org/).
- [Npm](https://docs.npmjs.com/).
- [Git](https://git-scm.com/).
- [Laravel](https://laravel.com/docs/10.x).

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

- [Instalación](#item1)
- [Inicializar Git](#item2)
- [Configuración de librerías FrontEnd](#item3)
    - [Configurar Jquery](#item4)
    - [Configurar Sass](#item5)
    - [Configurar Bootstrap](#item6)
    - [Configurar Vite](#item7)
- [Sistema de vistas FrontEnd](#item8)
    - [Layout plantilla web](#item9)
    - [Configuración de las vistas](#item10)
    - [Estilos css de las vistas](#item11)
    - [Componente header de navegación](#item12)
        - [Sistema de links para el navegador](#item13)
            - [Creación del helper para leer y guardar archivos json](#item14)
            - [Creación del archivo json link_nav](#item15)

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
>  Este paso es si no tenemos agregado el nombre y el email en la configuración de git.

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

### Configurar Jquery

> Typee: en la Consola:

```console

npm install jquery

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

@import '~bootstrap/scss/bootstrap';

```

> En el archivo `app.js` que esta ubicado `resources/js/` añadimos:

```js

import * as bootstrap from 'bootstrap'

```

[Subir](#top)

<a name="item7"></a>

### Configurar Vite

> Abrimos el archivo `vite.config.js` ubicado en la raíz de nuestro proyecto y lo dejamos de esta manera :

```js

import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import path from 'path'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/scss/app.scss', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
    },
  },
})
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
@extends('layouts.plantilla')

@section('title', 'Welcome')

@section('content')
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
    'header'
    'main'
    'footer';
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
    function read_json(String $dir, String $storage = "public"): Json
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
    "guest" : {
        "name" : "Welcome",
        "slug" : "welcome",
        "type" : "link",
        "route" : "welcome",
        "active" : "active disabled",
        "icono" : "",
        "icono_color" : "",
        "class" : "link-menu",
        "tooltip" : {
            "position" : "down",
            "class" : "custom-tooltip",
            "text" : "Page Welcome"
        },
        "items" : {
            "name" : "Welcome",
            "slug" : "welcome",
            "type" : "link",
            "route" : "welcome",
            "active" : "active disabled",
            "icono" : "",
            "icono_color" : "",
            "class" : "link-menu",
            "tooltip" : {
                "position" : "down",
                "class" : "custom-tooltip",
                "text" : "Page Welcome"
            }
        }
    }
}
```

[Subir](#top)

>Pues eso es todo espero que sirva. 👍

[Subir](#top)
