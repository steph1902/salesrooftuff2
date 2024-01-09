<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;





class SalesController extends Controller
{

    public function dashboard()
    {
        // dd('a');
        $sales = Auth::user()->sales;
        $assignedShops = Auth::user()->shops;

        // dd($sales);

        return view('home', compact('sales', 'assignedShops'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sales = User::all();
        // dd($)
        // dd($sales);
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('sales.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            // 'nik' => 'required',
            'nama' => 'required',
            // 'tempat_lahir' => 'required',
            // 'tanggal_lahir' => 'required',
            // 'alamat_ktp' => 'required',
            // 'alamat_domisili' => 'required',
            'nomor_handphone' => 'required',
            'email' => 'required',
            // 'username' => 'required',
            'password' => 'required',
        ]);

        // Encrypt password sebelum menyimpan
    $validatedData['password'] = Crypt::encrypt($request->password);

    // Simpan data
    User::create($validatedData);



        // User::create($validatedData);
        // dd($validatedData);

        return redirect()->route('sales.index')->with('success', 'Berhasil mendaftarkan sales baru.');
    }

//     public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'nama' => 'required',
//         'nomor_handphone' => 'required',
//         'email' => 'required',
//         'password' => 'required',
//     ]);

//     // Encrypt password sebelum menyimpan
//     $validatedData['password'] = Crypt::encrypt($request->password);

//     // Simpan data
//     User::create($validatedData);

//     return redirect()->route('sales.index')->with('success', 'Berhasil mendaftarkan sales baru.');
// }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $sales = User::findOrFail($id);

        return view('sales.show', compact('sales'));

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
        $sales = User::findOrFail($id);
        return view('sales.edit', compact('sales'));

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
        $sales = Sales::findOrFail($id);
        
        $validatedData = $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat_ktp' => 'required',
            'alamat_domisili' => 'required',
            'nomor_handphone' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $sales->update($validatedData);

        return redirect()->route('sales.index')->with('success', 'Sales updated successfully.');
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
        $sales = Sales::findOrFail($id);

        $sales->delete();

        return redirect()->route('sales.index')->with('success', 'Sales deleted successfully.');
        
    }


    // 

    public function showAssignSalesToShopForm()
    {
        $salespeople = User::where('role', User::ROLE_SALES)->get();
        $shopRegions = Shop::pluck('shop_region')->unique()->toArray();

        return view('sales.assign-sales-to-shop', [
            'salespeople' => $salespeople,
            'shopRegions' => $shopRegions,
        ]);
    }

    public function assignSalesToShop(Request $request)
    {
        
        $salespersonId = $request->input('salesperson_id');
        $shopId = $request->input('shop_id');

        DB::table('sales_shop')->insert([
            'salesperson_id' => $salespersonId,
            'shop_id' => $shopId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('assign.sales.to.shop')->with('success', 'Sales assigned successfully.');



    }

    public function searchShops(Request $request)
    {
        $searchTerm = $request->input('term');
        $shopRegion = $request->input('shopRegion');

        $shops = Shop::where('shop_region', $shopRegion)->where('shop_name', 'like', '%' . $searchTerm . '%')->get();

        $results = [];
        foreach ($shops as $shop) {
            $results[] = [
                'id' => $shop->id,
                'name' => $shop->shop_name,
            ];
        }

        return response()->json($results);
       
    }

    



}
