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
            if (!str_contains($searchable, ':') && !str_contains($searchable, '.')) {

                $builder->where($searchable, "LIKE", "%$search%");
                continue;
            }
        }
        return $builder;
    }
}
