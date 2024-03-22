<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /* `protected  = [];` is a property in the `Image` model class that specifies which
    attributes are not mass assignable. */
    protected $guarded = [];

    /**
     * This function returns a polymorphic relationship for an imageable model.
     *
     * @return model and other models that can have images associated with them. The `morphTo()` method is used
     * to define this relationship.
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * Get the supplier's full name.
     */
    protected function fileName(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $name = explode('/', $this->url);
                return end($name);
            },
        );
    }
}
