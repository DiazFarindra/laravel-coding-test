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

    public function createdAt()
    {
        return $this->created_at->format('d F Y H:i');
    }

    public function updatedAt()
    {
        return $this->updated_at->format('d F Y H:i');
    }
}
