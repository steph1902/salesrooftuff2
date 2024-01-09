<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Visit;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class VisitController extends Controller
{
    //
    public function show($id)
    {
        $visit = Visit::findOrFail($id);      

        $visit = DB::table('sales_visit')
        ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')            
        ->where('sales_visit.id', $id)
        ->select('sales_visit.*', 
        'shop.shop_name', 
        'shop.shop_address', 
        'shop.provinsi', 
        'shop.kota', 
        'shop.kecamatan', 
        'shop.kelurahan', 
        'shop.shop_googlemaps_coord', 
        'shop.shop_uuid')
        ->first();

        return view('visits.show', compact('visit'));

    }

    public function showVisitSuperadmin($id)
    {
        $visit = Visit::findOrFail($id);      

        $visit = DB::table('sales_visit')
        ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')            
        ->where('sales_visit.id', $id)
        ->select('sales_visit.*', 
        'shop.shop_name', 
        'shop.shop_address', 
        'shop.provinsi', 
        'shop.kota', 
        'shop.kecamatan', 
        'shop.kelurahan', 
        'shop.shop_googlemaps_coord', 
        'shop.shop_uuid')
        ->first();

        return view('owner.visitshow', compact('visit'));

    }



    public function edit($id)
    {
        $visit = Visit::findOrFail($id);
        return view('visits.edit', compact('visit'));      
    }

    public function update(Request $request, $id)
    {
        $visit = Visit::findOrFail($id);

        // Validasi data yang diterima dari formulir
        $request->validate([
            'notes' => 'required|string',
            'materials' => 'required|array',
            'materials.*' => 'in:brochure,standing_banner,billboard,hanging_banner,sticker_mobil,sample_renceng',
        ]);

        // Lakukan proses pembaruan data
        $visit->notes = $request->notes;
        $visit->materials = $request->has('materials') ? implode(',', $request->materials) : null;
        $visit->save();

        return redirect()->route('visits.edit', $visit->id)->with('success', 'Data kunjungan berhasil diperbarui!');
    
    }

    public function showVisitedStoreData()
    {
        $userId = Auth::user()->id;
        $visitedShops = DB::table('sales_visit')
        ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')            
        ->where('sales_visit.sales_id', $userId)
        ->select('sales_visit.*', 
        'shop.shop_name', 
        'shop.shop_address', 
        'shop.provinsi', 
        'shop.kota', 
        'shop.kecamatan', 
        'shop.kelurahan', 
        'shop.shop_googlemaps_coord', 
        'shop.shop_uuid')
        ->get();

       return view('visits.data', compact('visitedShops'));
    }


    public function create($id)
    {
        $shop = Shop::findOrFail($id);
        return view('visits.create', compact('shop'));
    }

    public function store(Request $request)
    {

        $this->request = $request; // Tambahkan baris ini di awal metode store

        $stringSales = 'di isikan menyusul';


        $visit = new Visit();
        $visit->shop_id = $request->input('shop_id');
        // $visit->location = $request->input('location');
        $visit->location = $request->input('address'); // Menggunakan alamat dari form

        $visit->notes = $stringSales;

        $materials = $request->input('materials');
        // $materialsString = implode(',', $materials);
        $visit->materials = $stringSales;

        $visit->sales_id = Auth::id();

        // Upload and stamp the main photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $this->uploadAndStampPhoto($photo, 'photos');
            $visit->photo = $photoPath;
        }

        $visit->save();

        return redirect()->route('visits.show', $visit->id);
    }

    private function uploadAndStampPhoto($photo, $folder)
    {        
        // working old code

        // /
        $photoPath = $photo->store($folder, 'public');        
        $image = Image::make(storage_path('app/public/' . $photoPath));
        $timestamp = Carbon::now()->format('Y-m-d H:i:s');
        $location = $this->request->input('address'); // Menggunakan $this->request

        $image->text($location . ' - ' . $timestamp, $image->width() - 10, $image->height() - 10, function ($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(14);
            $font->color('#ffffff');
            $font->align('right');
            $font->valign('bottom');
        });
        $image->save();

        return $photoPath;


    }






}



