<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pond extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function logs()
    {
        return $this->hasManyThrough(Log::class, Package::class);
    }
}
