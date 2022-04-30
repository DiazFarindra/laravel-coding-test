<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function updatedAt()
    {
        return $this->updated_at->format('d F Y');
    }

    public function fromPond()
    {
        $package = Package::find($this->package_id);
        return $package->pond->pond_code;
    }

    public function toPond()
    {
        $package = Package::find($this->to_package_id);
        return $package->pond->pond_code;
    }

    public function fromPackage()
    {
        $package = Package::find($this->package_id);
        return $package->package_code;
    }

    public function toPackage()
    {
        $package = Package::find($this->to_package_id);
        return $package->package_code;
    }
}
