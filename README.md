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
-   [Filters Search](#item7)
    -   [Creamos el request filter](#item8)
    -   [Creamos el controlador filter](#item9)
    -   [Creamos la ruta filter](#item10)
    -   [Creamos el componente de películas](#item12)
    -   [Creamos el archivo filter.js](#item13)


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
   $movies = isset($request->search) && $request->search != "all" ? Movie::search($request->search)->paginate(6)->withQueryString() : Movie::paginate(6);
}
```
[Subir](#top)


<a name="item7"></a>

## Filters Search

[Subir](#top)


<a name="item8"></a>

### Creamos el Request Filter

> Typee en consola:

```console
php artisan make:request Filter\AjaxFiltertRequest
```

> Abrimos el archivo `AjaxFilterRequest.php` ubicado en `app/Http/Requests/Filter/` y escribimos:

```php

<?php

namespace App\Http\Requests\Filter;

use Illuminate\Foundation\Http\FormRequest;

class AjaxFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "search" => "string|nullable",
            "gender" => "string|nullable",
            "tags" => "array|nullable",
            "stars" => "numeric|nullable"
        ];
    }
}

```
[Subir](#top)


<a name="item9"></a>

### Creamos el Controlador Filter

> Typee en consola:

```console
php artisan make:controller FilterController
```

> Abrimos el archivo `FilterController.php` ubicado en `app/Http/Controllers/` y escribimos:

```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\Filter\AjaxFilterRequest;
use App\Models\Gender;
use App\Models\Movie;
use App\Models\Tag;

class FilterController extends Controller
{
    public function filter(AjaxFilterRequest $request)
    {
        if ($request->ajax()) {

            $movies = Movie::query();

            if ($request->validated('search')) {

                $search = $request->validated('search');
                $movies = $movies->search($search);
            }

            if ($request->validated('gender') && $request->validated('gender') != 'all') {

                $gender = $request->validated('gender');
                $movies = $movies->whereRelation('gender', 'name', 'LIKE', "%$gender%");
            }
            if ($request->validated('tags')) {

                $tags = $request->validated('tags');
                $movies = $movies->whereHas('tags', fn ($q) => $q->whereIn('name', $tags));
            }

            if ($request->validated('stars') != null) {

                $rating = floatval($request->validated('stars'));
                $movies = $movies->whereRelation('ratings', 'rating', '=', $rating);
            }

            $movies = $movies->paginate(3);

            $genders = Gender::all();
            $tags = Tag::all();

            $profile = auth()->user() && auth()->user()->profile->first() ? auth()->user()->profile->first() : null;

            $view = view('components.app.movies.movies', compact('movies'))->render();

            return response()->json($view);
        }
    }
}

```

[Subir](#top)

<a name="item9"></a>

### Creamos la Ruta Filter

> Abrimos el archivo `web.php` ubicado en `routes` y escribimos fuera grupo del los middleware:

```php
Route::get('filters/ajax', [FilterController::class, 'filter']);
```

[Subir](#top)

<a name="item12"></a>

### Creamos el componente de películas

> Typee en consola:

```console
php artisan make:component app.movies.movies --view
```

> Abrimos el archivo `movies.blade.php` ubicado en `resources/views/components/app/movies/` y escribimos:

```html
<div class="d-flex flex-column flex-lg-row justify-content-center align-items-center flex-wrap mt-3">
    @forelse ($movies as $movie)
        <x-app.movies.card :movie="$movie" />
    @empty
        <div>
            <h4>@lang('There are no movies')</h4>
        </div>
    @endforelse

</div>
<div class="d-flex justify-content-center mt-2">
    {{ $movies->links() }}
    <x-dom.input type="hidden" id="count_links" name="count_links" value="{{ $movies->count() }}" />
    <x-dom.input type="hidden" id="total_links" name="total_links" value="{{ $movies->total() }}" />
    <x-dom.input type="hidden" id="hasMorePages_links" name="hasMorePages_links" value="{{ $movies->hasMorePages() }}" />
    <x-dom.input type="hidden" id="previousPageUrl_links" name="previousPageUrl_links" value="{{ $movies->previousPageUrl() }}" />
</div>

```

> Abrimos el archivo `welcome.blade.php` ubicado en `resources/views/` y escribimos lo siguiente:

```html
@extends('layouts.plantilla')

@section('title', 'Welcome')

@section('content')
    <main class="container-fluid">
        <div class="d-flex align-content-center justify-content-end mt-2">
            <x-dom.search />
        </div>
        <div class="content-movies">
            <x-app.movies.movies :movies="$movies" />
        </div>
        <x-auth.singup.modal />
        <x-auth.singin.modal />
    </main>
@endsection
```

[Subir](#top)

<a name="item13"></a>

### Creamos el archivo filter.js

> [!NOTE]
> En este proyecto, se ha creado un componente aside lateral para mostrar todos los filtros, nos ha llevado a cambiar varias cosas, como el css de la plantilla y su plantilla con el nuevo componente, también se ha añadido un botón en el componente de búsqueda para mostrar el aside, no va estar reflejado en esta guía, porque creo que son opciones personalizadas que cambiaran en cada proyecto, igualmente los archivos están subidos y les podréis dar un vistazo cuando lo necesitéis.

> Creamos el archivo `filer.js` y lo ubicamos en `resources/js/` lo tenemos que importar en el archivo `app.js` lo abrimos y escribimos:

#### Función establecer filtro

```js
$(".filter").on("change", function () {
    let data = {};
    let search = $("#search_filters").val();
    data["search"] = search != "" ? search : null;
    data["tags"] = [];

    if (this.name === "gender") {
        data[this.name] = this.value;

        $("input[name=tag]").each(function () {
            if ($(this).is(":checked")) {
                data["tags"].push(this.value);
            }
        });

        if ($("#checkstar").is(":checked")) {
            data["stars"] = $("input[name=filter_star]").val();
        }
    }
    if (this.name === "filter_star") {
        $("input[name=gender]").each(function () {
            if ($(this).is(":checked")) {
                data[this.name] = this.value;
            }
        });

        $("input[name=tag]").each(function () {
            if ($(this).is(":checked")) {
                data["tags"].push(this.value);
            }
        });
        data["stars"] = this.value;
    }
    if (this.name === "tag") {
        $("input[name=gender]").each(function () {
            if ($(this).is(":checked")) {
                data[this.name] = this.value;
            }
        });

        $("input[name=tag]").each(function () {
            if ($(this).is(":checked")) {
                data["tags"].push(this.value);
            }
        });

        if ($("#checkstar").is(":checked")) {
            data["stars"] = $("input[name=filter_star]").val();
        }
    }

    if (data["tags"].length == 0) {
        data["tags"] = null;
    }

    $.ajax({
        url: "/filters/ajax",
        method: "get",
        dataType: "json",
        data: {
            search: data["search"],
            gender: data["gender"],
            tags: data["tags"],
            stars: data["stars"],
        },
    }).done(function (data) {
        $(".content-movies").empty();
        $(".content-movies").append(data);
        let count_links = $("#count_links").val();
        let total_links = $("#total_links").val();
        $("#info_links").empty();
        $("#info_links").append(
            "Movies " + count_links + " of " + total_links
        );
    });
});
```

#### Función paginate

```js
function getData(page) {
    let data = {};
    let search = $("#search_filters").val();
    data["search"] = search != "" ? search : null;
    data["tags"] = [];

    $("input[name=gender]").each(function () {
        if ($(this).is(":checked")) {
            data[this.name] = this.value;
        }
    });

    $("input[name=tag]").each(function () {
        if ($(this).is(":checked")) {
            data["tags"].push(this.value);
        }
    });

    if ($("#checkstar").is(":checked")) {
        data["stars"] = $("input[name=filter_star]").val();
    }

    $.ajax({
        url: page,
        method: "get",
        dataType: "json",
        data: {
            search: data["search"],
            gender: data["gender"],
            tags: data["tags"],
            stars: data["stars"],
        },
   }).done(function (data) {
        $(".content-movies").empty();
        $(".content-movies").append(data);

        let count_links =
            $("#hasMorePages_links").val() == ""
                ? $("#total_links").val()
                : $("#count_links").val();
        let total_links = $("#total_links").val();
        let previousPageUrl_links = $("#previousPageUrl_links")
            .val()
            .split("=");

        let m_links = $("#hasMorePages_links").val() == "" ? 0 : 3;

        previousPageUrl_links =
            previousPageUrl_links.length <= 1
                ? previousPageUrl_links
                : previousPageUrl_links[1];

        previousPageUrl_links =
            parseInt(previousPageUrl_links * m_links) +
            parseInt(count_links);
        $("#info_links").empty();
        $("#info_links").append(
            "Movies " + previousPageUrl_links + " of " + total_links
        );
    });
}
```

#### Función click paginate

```js
$(document).on("click", ".pagination a", function (e) {

    if (/filters/.test($(this).attr("href"))) {
        $("li").removeClass("active");
        $(this).parent("li").addClass("active");
        e.preventDefault();

        var page = $(this).attr("href");

        getData(page);
    }
});
```

> [!TIP]
> Para controlar la url del paginate hay que especificarla en el archivo `MovieController.php` ubicado en `app/Http/Controllers/` y añadir después de la consulta en la función `index`.

```php
$movies->withPath('/filters/ajax');
```

> [!TIP]
> En el componente de búsqueda el input que utilizamos al principio esta comentado. Podemos Habilitar la búsqueda simple si añadimos una función que nos dirija a los filtros desde una petición ajax.

> Pues eso es todo espero que sirva. 👍

[Subir](#top)
