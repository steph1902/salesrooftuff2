<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // province_id
    // protected $name = ['indonesia_cities'];
    protected $guarded = ['province_id']; // remove id from the guarded properties
}
