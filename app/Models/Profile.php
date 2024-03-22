<?php

namespace App\Models;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Profile extends Model
{
    use HasFactory, Upload;

    protected $guarded = [];

    /**
     * The image function defines a polymorphic relationship in PHP where an object can have multiple
     * images associated with it.
     *
     * @return a polymorphic one-to-many relationship between the current model and the `Image` model. This
     * means that the current model can have multiple images associated with it.
     */
    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    /**
     * The function `user()` returns a polymorphic relationship with the `User` model through the
     * `profileable` relation.
     *
     * @return method. This allows the current model to be related to multiple User models through a
     * polymorphic relationship with the 'profileable' morphable type.
     */
    public function user()
    {
        return $this->morphByMany(User::class, 'profileable');
    }

    /**
     * Get the name's full.
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: function ($value) {

                $fullName = '';
                if ($this->name != null && $this->name != '') {
                    $fullName = $this->name;
                    if ($this->last_name != null && $this->last_name != '') {
                        $fullName =  $fullName . ' ' . $this->last_name;
                    }
                }
                return $fullName;
            },
        );
    }
}
