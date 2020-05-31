<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public function allowTo(Ability $ability)
    {
        $this->abilities()->save($ability);
    }

    public function abilities()
    {
        return $this->belongsToMany(Ability::class);
    }
}
