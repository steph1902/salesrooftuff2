<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\Shop;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ShopExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $shops;

    public function __construct($shops)
    {
        $this->shops = $shops;
    }

    public function collection()
    {
        return $this->shops;
    }

    public function headings(): array
    {
        return [
            'Shop Name',
            'Shop Address',
            'Sales Name',
            'Sales Phone Number',
            'Shop Provinces',
            'Photo Toko Depan',
            'Shop Location (Coordinate)',
            'Shop Last Visit',
            'Shop Materials',
        ];
    }


}




