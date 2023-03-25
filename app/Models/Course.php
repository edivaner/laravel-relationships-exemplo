<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Module;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'available'];


    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
