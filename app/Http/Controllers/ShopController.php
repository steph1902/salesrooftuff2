<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Http;
// use App\Models\Province;
// use App\Models\City;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Support\Facades\Auth; // Add this line
use Intervention\Image\Facades\Image;
use Carbon\Carbon;


class ShopController extends Controller
{


    // {{-- ketika data toko di klik, tampilkan data visit sales --}}
    public function showDetails($id)
    {
        $visits = DB::table('sales_visit')->where('shop_id', $id)->get();
        $visitsFirst = DB::table('sales_visit')->where('shop_id', $id)->first();
        $salesId = $visitsFirst->sales_id;

        $salesName = DB::table('sales_visit')
        ->select('sales_visit.*', 'users.name as sales_name') 
        ->leftJoin('users', 'sales_visit.sales_id', '=', 'users.id') 
        ->where('sales_visit.sales_id', '=', $salesId) 
        ->first();
        
        return view('shops.detail',compact('visits','salesName'));
    }

    public function showDetailsShopData($namasales)
    {
        // data toko per sales
        $shops = DB::table('shop')->where('nama_sales',$namasales)->get();
        // dd($shopData);
        return view('sales.salesshopdatapersales',compact('shops'));
    }







    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
      
        // dd('a');
        $query = Shop::query();

        // Apply filters if provided
        if ($request->filled('filter_name')) {
            $query->where('shop_name', 'like', '%' . $request->input('filter_name') . '%');
        }
        if ($request->filled('filter_region')) {
            $query->where('shop_region', 'like', '%' . $request->input('filter_region') . '%');
        }
        if ($request->filled('filter_city')) {
            $query->where('shop_city', 'like', '%' . $request->input('filter_city') . '%');
        }

        // Add ordering by created_at descending
        // $query->where('nama_sales','supermochi')->orderBy('created_at', 'desc');
        $query->orderBy('created_at', 'desc');
        
        $shops = $query->get();

        // dd($shops);

        return view('shops.index', compact('shops'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $provinces = Province::all();
        return view('shops.create', compact('provinces'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $shop = new Shop;

        $shop->nama_sales = $request->user_name;
        $shop->nama_pic = $request->user_name;
        $shop->nomor_hp_pic = $request->user_name;

        $shop->shop_name = $request->shop_name;
        $shop->shop_address = $request->shop_address;

        $shop->provinsi = Province::find($request->provinsi)->name;
        $shop->kota = City::find($request->kota)->name;
        $shop->kecamatan = District::find($request->kecamatan)->name;
        $shop->kelurahan = Village::find($request->desa)->name;


        $shop->shop_uuid = Uuid::uuid4();

        // $this->validate($request, [
            // 'photo'     => 'required|image|mimes:png,jpg,jpeg',
            // 'title'     => 'required',
            // 'content'   => 'required'
        // ]);

        //upload image
        // $image = $request->file('photo');
        // $image->storeAs('public/blogs', $image->hashName());
        // $shop->photo = 


        // Upload and stamp the main photo
        // if ($request->hasFile('photo')) {
        //     $photo = $request->file('photo');
        //     $photoPath = $this->uploadAndStampPhoto($photo, 'photos');
        //     $shop->photo = $photoPath;
        //     // dd($photoPath);
        // }

        $path = $request->file('photo')->store('public/photos');
        $shop->photo = $path;
        // dd($path);

        $shop->save();

        //
        $user = Auth::user();
        if ($user->role === 'sales') 
        {
            $userName = $user->name;
            $userId = $user->id;
            $shops = DB::table('shop')->where('nama_sales', $userName)->get();

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
            return view('sales.dashboard', compact('user', 'shops', 'visitedShops'));
        }
        else
        {
            return redirect()->route('shops.index')->with('success', 'Shop created successfully.');
        }

        
    }


    private function uploadAndStampPhoto($photo, $folder)
    {        
        // working old code

        // dd('uploadAndStampPhoto');
        // /
        $photoPath = $photo->store($folder, 'public');        
        $image = Image::make(storage_path('app/public/' . $photoPath));
        $timestamp = Carbon::now()->format('Y-m-d H:i:s');
        // $location = $this->request->input('address'); // Menggunakan $this->request

        $image->text(' - ' . $timestamp, $image->width() - 10, $image->height() - 10, function ($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(14);
            $font->color('#ffffff');
            $font->align('right');
            $font->valign('bottom');
        });
        $image->save();

        return $photoPath;


    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $shop = Shop::findOrFail($id);
        return view('shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

       
        $shop = Shop::findOrFail($id);

        $shop->shop_name = $request->shop_name;
        $shop->shop_address = $request->shop_address;


        $shop->shop_region = Province::find($request->provinsi)->name;
        $shop->shop_city = City::find($request->kota)->name;
        $shop->shop_district = District::find($request->kecamatan)->name;
        $shop->shop_subdistrict = Village::find($request->desa)->name;


        
        $shop->save();

        return redirect()->route('shops.index')->with('success', 'Shop updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // dd('a');
        $shop = Shop::findOrFail($id);
        $shop->delete();
        return redirect()->route('shops.index')->with('success', 'Data toko berhasil dihapus');
    }





}
