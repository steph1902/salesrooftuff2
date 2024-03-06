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
use Log;
// use Maatwebsite\Excel\Facades\Excel;




class ReportController extends Controller
{


    public function export(Request $request)
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
            'shop.id',
            'sales_visit.id', 
            'shop.shop_name', 
            'shop.shop_address', 
            'shop.kota', 
            'shop.photo', 
            'users.name') 
        ->get();



        // 

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

        

        // $startDate = $request->input('start_date');
        // Log::info('startDate: '.$startDate);
        // $endDate = $request->input('end_date');
        // Log::info('endDate: '.$endDate);

        // $startDateTime = $startDate ? date('Y-m-d 00:00:00', strtotime($startDate)) : null;
        // Log::info('startDateTime: '.$startDateTime);
        // $endDateTime = $endDate ? date('Y-m-d 23:59:59', strtotime($endDate)) : null;
        // Log::info('endDateTime: '.$endDateTime);

        // $reportData = DB::table('sales_visit')
        //     ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
        //     ->join('users', 'users.id', '=', 'sales_visit.sales_id')
        //     ->select('sales_visit.*', 'shop.*', 'users.*', 'sales_visit.id')
        //     ->when($startDate && $endDate, function ($query) use ($startDateTime, $endDateTime) {
        //         $query->whereBetween('sales_visit.created_at', [$startDateTime, $endDateTime]);
        //     })
        //     ->groupBy(
        //         'shop.id',
        //         'users.id',
        //         'sales_visit.id', 
        //         'shop.shop_name', 
        //         'shop.shop_address', 
        //         'shop.kota', 
        //         'shop.photo', 
        //         'users.name') 
        //     ->get();

        

        
        
        Log::info($reportData);    

        // 

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

        

        $startDate = $request->input('start_date');
        Log::info('startDate: '.$startDate);
        $endDate = $request->input('end_date');
        Log::info('endDate: '.$endDate);

        $startDateTime = $startDate ? date('Y-m-d 00:00:00', strtotime($startDate)) : null;
        Log::info('startDateTime: '.$startDateTime);
        $endDateTime = $endDate ? date('Y-m-d 23:59:59', strtotime($endDate)) : null;
        Log::info('endDateTime: '.$endDateTime);

        $reportData = DB::table('sales_visit')
            ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
            ->join('users', 'users.id', '=', 'sales_visit.sales_id')
            ->select('sales_visit.*', 'shop.*', 'users.*', 'sales_visit.id')
            ->when($startDate && $endDate, function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween('sales_visit.created_at', [$startDateTime, $endDateTime]);
            })
            ->get();

        

        
        
        Log::info($reportData);    

        

        

        return view('report.index', compact('reportData', 'shops'));
    }



    // 


}
