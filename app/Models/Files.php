<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Files extends Model
{
    use HasFactory;
    protected $table = 'files';
    
    protected $fillable = [
        'name',
        'size',
        'type',
        'url'
    ];
    // public function setNameAttribute($value)
    // {
    //     $this->attributes('name') = $value;
    //     $this->attributes('slug') = Str::slug($value);
    // }

}
