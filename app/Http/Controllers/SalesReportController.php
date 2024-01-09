<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;
use Carbon\Carbon;
use App\Models\SalesVisit;




class SalesReportController extends Controller
{
    
    public function showSalesReport(Request $request)
    {
        // Step 1: Mengambil bulan dan tahun dari permintaan
        $bulan = $request->input('bulan', date('m')); // Default ke bulan saat ini jika tidak ada input
        $tahun = $request->input('tahun', date('Y')); // Default ke tahun saat ini jika tidak ada input
        

        // Perbarui jumlah hari berdasarkan bulan dan tahun
        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $dates = range(1, $jumlah_hari);

        // Mengambil data toko dari database berdasarkan nama sales yang sedang login
        $user = Auth::user();
        $userName = $user->name;
        $userId = $user->id;
        $shops = DB::table('shop')->where('nama_sales', $userName)->get();

        // Ambil bulan dan tahun yang dipilih oleh pengguna dari permintaan
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Dapatkan tanggal awal dan akhir dari bulan yang dipilih
        $tanggal_awal = "$tahun-$bulan-01";
        $tanggal_akhir = "$tahun-$bulan-" . date('t', strtotime($tanggal_awal));

        // Mengambil data kunjungan penjualan untuk bulan dan tahun yang dipilih
        $kunjungan = DB::table('sales_visit')
            ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')            
            ->where('sales_visit.sales_id', $userId)
            ->whereBetween('sales_visit.created_at', [$tanggal_awal, $tanggal_akhir])
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

        // Membuat matriks laporan dengan tanggal dan toko
        $report = [];
        foreach ($dates as $date) {
            $report[$date] = [];
            foreach ($shops as $shop) {
                $report[$date][$shop->shop_name] = false; // Awalnya tidak ada kunjungan
                foreach ($kunjungan as $visit) {
                    $visit_date = date('j', strtotime($visit->created_at)); // Mengambil tanggal kunjungan
                    if ($visit_date == $date && $visit->shop_id == $shop->id) {
                        $report[$date][$shop->shop_name] = true; // Ada kunjungan pada tanggal dan toko tersebut
                        break; // Kita sudah menemukan kunjungan, lanjutkan ke tanggal berikutnya
                    }
                }
            }
        }

        return view('report.sales-report', compact('dates', 'shops', 'report', 'bulan', 'tahun'));
    }


    // public function showSalesReportBySuperadmin(Request $request)
    // {
    //     // ...

    //     // Ambil data semua sales jika user adalah superadmin
    //     $allSales = [];
    //     $selectedSales = $request->input('sales');

    //     // if (Auth::user()->isSuperAdmin()) {
    //         $allSales = User::where('role', 'sales')->get();
    //     // }

    //     // dd($allSales);

    //     // ...

    //     // Ambil data kunjungan penjualan untuk bulan, tahun, dan sales yang dipilih
    //     $kunjungan = DB::table('sales_visit')
    //         ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
    //         ->when($selectedSales, function ($query) use ($selectedSales) {
    //             return $query->where('sales_visit.sales_id', $selectedSales);
    //         })
    //         // ->whereBetween('sales_visit.created_at', [$tanggal_awal, $tanggal_akhir])
    //         ->whereBetween('sales_visit.created_at', [$tanggal_awal ?? now()->startOfMonth(), $tanggal_akhir ?? now()->endOfMonth()])
    //         ->select('sales_visit.*', 'shop.*')
    //         ->get();

        

    //     // ...

    //     // Membuat matriks laporan dengan tanggal dan toko
    //     $report = [];
    //     foreach ($dates as $date) {
    //         $report[$date] = [];
    //         foreach ($shops as $shop) {
    //             $report[$date][$shop->shop_name] = false; // Awalnya tidak ada kunjungan
    //             foreach ($kunjungan as $visit) {
    //                 $visit_date = date('j', strtotime($visit->created_at)); // Mengambil tanggal kunjungan
    //                 if (
    //                     $visit_date == $date
    //                     && ($selectedSales ? $visit->sales_id == $selectedSales : true) // Perbarui kondisi untuk memeriksa sales yang dipilih
    //                     && $visit->shop_id == $shop->id
    //                 ) {
    //                     $report[$date][$shop->shop_name] = true; // Ada kunjungan pada tanggal dan toko tersebut
    //                     break; // Kita sudah menemukan kunjungan, lanjutkan ke tanggal berikutnya
    //                 }
    //             }
    //         }
    //     }

    //     // sales-report-for-superadmin.blade
    //     return view('report.sales-report-for-superadmin', compact('dates', 'shops', 'report', 'bulan', 'tahun', 'allSales', 'selectedSales'));
    // }



    public function showSalesReportBySuperadmin2(Request $request)
    {

         // Mengambil bulan dan tahun dari permintaan
        // $bulan = $request->input('bulan', now()->month);
        // $tahun = $request->input('tahun', now()->year);

        // $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);
        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $dates = range(1, $jumlah_hari);


        // Mendapatkan bulan dan tahun dari permintaan
        

        // Mendapatkan jumlah hari dalam bulan yang dipilih
        

        // Mengambil semua sales jika user adalah superadmin
        $allSales = User::where('role', 'sales')->get();
        $selectedSales = $request->input('sales');

        // Mendapatkan tanggal awal dan akhir dari bulan yang dipilih
        $tanggal_awal = "$tahun-$bulan-01";
        $tanggal_akhir = "$tahun-$bulan-" . date('t', strtotime($tanggal_awal));

        // Mendapatkan data toko dari database berdasarkan sales yang sedang login
        $user = Auth::user();
        $userName = $user->name;
        $userId = $user->id;
        $shops = DB::table('shop')->where('nama_sales', $userName)->get();

        // Mendapatkan data kunjungan penjualan untuk bulan, tahun, dan sales yang dipilih

        // ini working
        $kunjungan = DB::table('sales_visit')
            ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
            ->when($selectedSales, function ($query) use ($selectedSales) {
                return $query->where('sales_visit.sales_id', $selectedSales);
            })
            ->whereBetween('sales_visit.created_at', [$tanggal_awal, $tanggal_akhir])
            ->select(
                'sales_visit.id',
                'sales_visit.shop_id',
                'sales_visit.visit_date',
                'sales_visit.location',
                'sales_visit.created_at',
                'sales_visit.updated_at',
                'sales_visit.materials', 
                'shop.*'
            )
            ->get();
        // ini working




            // -- Table: public.sales_visit

            // -- DROP TABLE IF EXISTS public.sales_visit;

            // CREATE TABLE IF NOT EXISTS public.sales_visit
            // (
            // id bigint NOT NULL DEFAULT nextval('sales_visit_id_seq'::regclass),
            // shop_id bigint NOT NULL,
            // visit_date timestamp(0) without time zone,
            // location text COLLATE pg_catalog."default",
            // created_at timestamp(0) without time zone,
            // updated_at timestamp(0) without time zone,
            // materials text COLLATE pg_catalog."default",
            // photo text COLLATE pg_catalog."default",
            // photos text COLLATE pg_catalog."default",
            // notes text COLLATE pg_catalog."default",
            // sales_id bigint,
            // CONSTRAINT sales_visit_pkey PRIMARY KEY (id)
            // )

            // TABLESPACE pg_default;

            // ALTER TABLE IF EXISTS public.sales_visit
            // OWNER to stephs;

            // $kunjungan = DB::table('sales_visit')
            // ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
            // ->when($selectedSales, function ($query) use ($selectedSales) {
            //     return $query->where('sales_visit.sales_id', $selectedSales);
            // })
            // ->whereBetween('sales_visit.created_at', [
            //     Carbon::createFromFormat('Y-m-d', $tanggal_awal)->startOfDay(),
            //     Carbon::createFromFormat('Y-m-d', $tanggal_akhir)->endOfDay(),
            // ])
            // ->select('sales_visit.*', 'shop.*')
            // ->get();
        
            // $kunjungan = DB::table('sales_visit')
            // ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
            // ->when($selectedSales, function ($query) use ($selectedSales) {
            //     return $query->where('sales_visit.sales_id', $selectedSales);
            // })
            // // ->whereBetween('sales_visit.created_at', [
            // //     Carbon::createFromFormat('Y-m-d', $tanggal_awal)->startOfDay(),
            // //     Carbon::createFromFormat('Y-m-d', $tanggal_akhir)->endOfDay(),
            // // ])
            // ->select('sales_visit.*', 'shop.*')
            // ->get();

            $kunjungan = DB::table('sales_visit')
            ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
            ->when($selectedSales, function ($query) use ($selectedSales) {
                return $query->where('sales_visit.sales_id', $selectedSales);
            })
            ->where('sales_visit.created_at', '>=', $tanggal_awal)
            ->where('sales_visit.created_at', '<=', $tanggal_akhir)
            ->select('sales_visit.*', 'shop.*')
            ->get();
        
        
        dd($kunjungan);

        


    

        
        return view('report.sales-report-for-superadmin', compact('dates', 'shops', 'report', 'bulan', 'tahun', 'allSales', 'selectedSales'));
    }


    // public function testAccess()
    // {
    //     return view('report.sales-report-for-superadmin');
    // }



}
