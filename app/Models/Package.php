<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pond()
    {
        return $this->belongsTo(Pond::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
