<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SalesVisit;


class Shop extends Model
{
    use HasFactory;
    protected $table = 'shop';

    protected $casts = [
        'kecamatan' => 'string',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function salesVisits()
    {
        return $this->hasMany(SalesVisit::class);
    }

}
