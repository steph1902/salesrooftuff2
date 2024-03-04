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
use Kreait\Laravel\Firebase\Facades\Firebase;

use Yish\Imgur\Facades\Upload;
// use Yish\Imgur\Facades\Upload;





// use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Auth\SignInResult\SignInResult;
use Kreait\Firebase\Exception\FirebaseException;
use Google\Cloud\Firestore\FirestoreClient;
use Session;

// use Illuminate\Support\Facades\Log;





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

        // dd($request);

        try {
            //code...
            // Upload and stamp the main photo
            if ($request->hasFile('photo')) {
                // dd('masuk');
                $photo = $request->file('photo');
                $photoPath = $this->uploadAndStampPhoto($photo, 'photos');
                // dd($photoPath);
                $visit->photo = $photoPath;
            }
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th);

        }

        

        $visit->save();

        return redirect()->route('visits.show', $visit->id);
    }

    private function uploadAndStampPhoto($photo, $folder)
    {
        $photoPath = $photo->store($folder, 'public');        
        $image = Image::make(storage_path('app/public/' . $photoPath));
        $timestamp = Carbon::now()->format('Y-m-d H:i:s');
        $location = $this->request->input('address');

        $imageWidth = $image->width();

        // Menghitung ukuran font sesuai dengan lebar gambar
        $fontSize = $imageWidth / 70;

        $image->text($location . ' - ' . $timestamp, $image->width() - 10, $image->height() - 10, function ($font) use ($fontSize) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size($fontSize);
            $font->color('#ffffff');
            $font->align('right');
            $font->valign('bottom');
        });

        $image->save();


        // imgur
        
        try {
            //code...
            $image = Imgur::upload($file);
            // Get imgur image link.
            $link = $image->link(); //"https://i.imgur.com/XN9m1nW.jpg"
            Log::info($link);
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());
        }
        
        // $image = Imgur::upload($file);
        // Get imgur image link.
        // $image->link(); //"https://i.imgur.com/XN9m1nW.jpg"

        // // Mengunggah gambar ke Firebase Storage
        // $firebase = (new Firebase\Factory())->create();
        // $storage = $firebase->getStorage();
        // $bucket = $storage->getBucket();

        // try {
        //     $file = fopen(storage_path('app/public/' . $photoPath), 'r');
        //     $bucket->upload($file, ['name' => 'photos/' . $photo->hashName(), // Ubah 'photos/' sesuai dengan direktori yang Anda inginkan di Firebase Storage
        // ]);
        // } catch (UploadFailed $e) {
        //     // Tangani jika gagal mengunggah
        //     Log::error('Error uploading file to Firebase Storage: ' . $e->getMessage());
        // }





        return $photoPath;
    }


    

    






}



