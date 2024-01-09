<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'sales_visit';

    // Define the fillable fields of the model
    protected $fillable = [
        'shop_id',
        'visit_date',
        'location',
        'materials',
        'photo',
        'photos',
    ];

    // Define the relationships of the model (if any)
    // public function shop()
    // {
    //     return $this->belongsTo(Shop::class);
    // }
}
