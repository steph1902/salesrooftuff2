<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ShopExport;
use App\Exports\ReportExport;
// use App\Model\Shop;
use App\Models\Sales;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Add this line
use App\Models\Visit;
// use Maatwebsite\Excel\Facades\Excel;




class ReportController extends Controller
{


    public function export()
    {        
        $reportData = DB::table('sales_visit')
        ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
        ->join('users', 'users.id', '=', 'sales_visit.sales_id')        
        ->select(
            'sales_visit.id as No.',
            'users.name as Nama Sales', 
            'shop.shop_name as Nama Toko',
            'shop.shop_address as Alamat Toko',
            'shop.kota as Kota',            
            'sales_visit.created_at as Kunjungan Terakhir',
            'sales_visit.photo as Foto Toko Depan',
            'sales_visit.notes as Catatan',
            'sales_visit.materials as Materials'

        )
        ->groupBy(
            'sales_visit.id', 
            'shop.shop_name', 
            'shop.shop_address', 
            'shop.kota', 
            'shop.photo', 
            'users.name') 
        ->get();

        // dd($reportData);

        
        return Excel::download(new ReportExport($reportData), 'report.xlsx');
    }



    public function index2(Request $request)
    {
        // dd('a');
        $query = Shop::query();

        // Apply filters
        if ($request->filled('shop_name')) {
            $query->where('shop_name', 'like', '%' . $request->input('shop_name') . '%');
        }
        if ($request->filled('sales_name')) {
            $query->whereHas('users', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('sales_name') . '%');
            });
        }
        if ($request->filled('province')) {
            $query->where('shop_city', 'like', '%' . $request->input('province') . '%');
        }

        $shops = $query->get();



        // Fetch the filtered data
        $reportData = DB::table('sales_visit')
            ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
            ->join('users', 'users.id', '=', 'sales_visit.sales_id')
            ->select('sales_visit.*', 'shop.*','users.*','sales_visit.id')
            ->when($request->filled('shop_name'), function ($query) use ($request) {
                $query->where('shop.shop_name', 'like', '%' . $request->input('shop_name') . '%');
            })
            ->when($request->filled('sales_name'), function ($query) use ($request) {
                $query->where('users.name', 'like', '%' . $request->input('sales_name') . '%');
            })
            ->when($request->filled('province'), function ($query) use ($request) {
                $query->where('shop.shop_city', 'like', '%' . $request->input('province') . '%');
            })
            ->get();


        return view('report.index', compact('reportData', 'shops'));
    }


    // 
    public function index(Request $request)
    {
        // dd('a');
        // Query untuk filter data berdasarkan input pengguna
        $query = Shop::query();

        if ($request->filled('shop_name')) {
            $query->where('shop_name', 'like', '%' . $request->input('shop_name') . '%');
        }

        if ($request->filled('sales_name')) {
            $query->whereHas('users', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('sales_name') . '%');
            });
        }

        if ($request->filled('province')) {
            $query->where('shop_city', 'like', '%' . $request->input('province') . '%');
        }

        $shops = $query->get();

        // attempt-1

        // // Filter data berdasarkan tanggal
        // $startDate = $request->input('start_date');
        // $endDate = $request->input('end_date');

        // // dd($startDate);

        // $reportData = DB::table('sales_visit')
        //     ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
        //     ->join('users', 'users.id', '=', 'sales_visit.sales_id')
        //     ->select('sales_visit.*', 'shop.*', 'users.*', 'sales_visit.id')
        //     ->when($startDate, function ($query) use ($startDate) {
        //         $query->whereDate('sales_visit.visit_date', '>=', $startDate);
        //     })
        //     ->when($endDate, function ($query) use ($endDate) {
        //         $query->whereDate('sales_visit.visit_date', '<=', $endDate);
        //     })
        //     ->get();

        // dd($reportData);


        // 

        // attempt-2

        // $startDate = $request->input('start_date');
        // $endDate = $request->input('end_date');

        // // Format nilai input ke format datetime
        // $startDateTime = $startDate ? $startDate . ' 00:00:00' : null;
        // $endDateTime = $endDate ? $endDate . ' 23:59:59' : null;

        // $reportData = DB::table('sales_visit')
        //     ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
        //     ->join('users', 'users.id', '=', 'sales_visit.sales_id')
        //     ->select('sales_visit.*', 'shop.*', 'users.*', 'sales_visit.id')
        //     ->when($startDate && $endDate, function ($query) use ($startDateTime, $endDateTime) {
        //         $query->whereBetween('sales_visit.visit_date', [$startDateTime, $endDateTime]);
        //     })
        //     ->get();

        

        // attempt-3

        $startDate = $request->input('start_date');
        // dd($startDate);
        $endDate = $request->input('end_date');

        // Format nilai input ke format datetime yang sesuai dengan format database
        $startDateTime = $startDate ? date('Y-m-d 00:00:00', strtotime($startDate)) : null;
        $endDateTime = $endDate ? date('Y-m-d 23:59:59', strtotime($endDate)) : null;

        $reportData = DB::table('sales_visit')
            ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
            ->join('users', 'users.id', '=', 'sales_visit.sales_id')
            ->select('sales_visit.*', 'shop.*', 'users.*', 'sales_visit.id')
            ->when($startDate && $endDate, function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween('sales_visit.visit_date', [$startDateTime, $endDateTime]);
            })
            ->get();

        // dd($startDateTime);

        // $reportData = $query->toSql();
        // dd($reportData);
        // $reportData = $query->get();




        

        return view('report.index', compact('reportData', 'shops'));
    }



    // 


}
