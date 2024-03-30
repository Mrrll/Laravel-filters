# Laravel Filters

Proyecto de filtrado de búsquedas

> [!TIP]
> Estamos usando el repositorio [Laravel Initial Bootstrap](https://github.com/Mrrll/Laravel-Initial-Bootstrap) que puedes utilizar, tiene una explicación detallada para el uso del repositorio y todo lo que lleva implementado, para que puedas por ti mismo aplicarlo paso a paso o usarlo directamente. Este repositorio es una ayuda rápida para tener un entorno agradable y funcional de un proyecto de laravel con bootstrap.

<a name="top"></a>

## Indice de Contenidos.

-   [Configuración](#item1)
-   [Trait Search](#item2)
    -   [Archivo de configuración Json](#item3)
    -   [Creamos el componente de búsqueda](#item4)
    -   [Creamos el trait](#item5)
-   [Uso del Trait Search](#item6)


<a name="item1"></a>

## Configuración

> [!TIP]
> Estamos usando el repositorio [Laravel 10](https://github.com/Mrrll/Laravel10) para que puedas tener una guía, tiene explicaciones detalladas.

> [!NOTE]
> He creado para este ejercicio `Roles de usuario` El primer usuario registrado sera el admin y los siguientes clientes, utilizo las `puertas(Gates)` y políticas(Polices) para administrar permisos y middleware para el acceso del admin. También he creado perfiles de usuario.

> [!NOTE]
> En este ejercicio usare un sistema de películas con sus géneros, etiquetas, valoraciones y comentarios por parte de los usuarios registrados.

<a name="item2"></a>

## Trait Search

<a name="item3"></a>

### Archivo de configuración Json

> Creamos el archivo `movie.json` en la ubicación `storage/app/config/` y escribimos :

```json

{
    "title": "title",
    "description": "description",
    "year": "year",
    "updated_at": "updated_at",
    "gender.name": "gender.name",
    "user.name": "user.name",
    "user.profile.name": "user.profile.name",
    "user.profile.last_name": "user.profile.last_name",
    "user.profile.address": "user.profile.address",
    "user.profile.name:last_name": "user.profile.name:last_name",
    "tags.name": "tags.name",
    "ratings.rating": "ratings.rating"
}

```

> [!TIP]
> Este archivo es, el que definimos donde va a buscar nuestro trait el `.` separa las relaciones de los campos y  `:` los campos a concatenar.

[Subir](#top)

<a name="item4"></a>

### Creamos el componente de búsqueda

> Typee en consola:

```console
php artisan make:component dom.search --view
```

> Abrimos el archivo `search.blade.php` en la ubicación `resources/views/components/dom/` y escribimos:

```html

<x-dom.form id="form_search" action="#" method="GET" :valid="false">
    <div class="input-group">
        <x-dom.input name="search" type="text" placeholder="Searcher" form="form_search" />
        <x-dom.button type="submit" class="btn btn-outline-primary" form="form_search">
            <i class="fa-solid fa-magnifying-glass fa-xl"></i>
        </x-dom.button>
    </div>
</x-dom.form>

```

[Subir](#top)

<a name="item5"></a>

### Creamos el trait

> Creamos el archivo `Searchable.php` en la ubicación `app/Traits/` y escribimos;

```php

<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

trait Searchable
{

    public function scopeSearch(Builder $builder, string $search): Builder
    {

        if (!$this->searchable) {

            throw new \Exception("Please define the searchable property");
        }

        foreach ($this->searchable as $searchable) {

            if (str_contains($searchable, ':')) {

                $relation = Str::beforeLast($searchable, '.');
                $column = Str::afterLast($searchable, '.');
                $columns = Str::of($column)->explode(':');


                $raw = "concat(";
                foreach ($columns as $column) {
                    $raw = $raw . $column . ', " ", ';
                }
                $raw = Str::of($raw)->rtrim(', " ", ')->value;
                $raw = $raw . ')';

                $builder->orWhereRelation($relation, DB::raw($raw), "LIKE", "%$search%");

                continue;
            }
            if (str_contains($searchable, '.')) {

                $relation = Str::beforeLast($searchable, '.');
                $column = Str::afterLast($searchable, '.');

                $builder->orWhereRelation($relation, $column, "LIKE", "%$search%");

                continue;
            }
        }
        return $builder;
    }
}


```

[Subir](#top)

<a name="item6"></a>

### Uso del Trait Search

> Situamos el componente de búsqueda donde queramos, en este proyecto esta en la vista welcome.

```html
<div class="d-flex align-content-center justify-content-end mt-2">
   <x-dom.search />
</div>
```

> Abrimos el modelo al que queramos que se pueda hacer la búsqueda, en este proyecto es el modelo `movie.php` ubicado en `app/Models/` y le añadimos:

```php

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Movie extends Model
{
    use HasFactory, Searchable;

    protected function searchable(): Attribute
    {
        return Attribute::make(
            get: function ($value) {

                return read_json("movie.json", "config");
            },
        );
    }
}

```
> Abrimos el controlador `MovieController.php` ubicado en `app/Http/Controllers/` y modificamos el método `index`.

```php
use Illuminate\Http\Request;

public function index(Request $request)
{
   $movies = isset($request->search) && $request->search != "all" ? Movie::search($request->search)->paginate(6)->withQueryString() : Movie::orderBy('id', 'desc')->paginate(6);
}
```
[Subir](#top)

> Pues eso es todo espero que sirva. 👍

[Subir](#top)
