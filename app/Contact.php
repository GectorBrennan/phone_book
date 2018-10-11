<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Contact extends Model
{
    protected $fillable = [
        'name', 'email', 'phone',
    ];


    public function scopeWhereName(Builder $builder, $name)
    {
        return $builder->where('name', 'like', "%$name%");
    }

    public function scopeWhereEmail(Builder $builder, $name)
    {
        return $builder->where('name', "%$name%");
    }
}
