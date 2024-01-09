<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;


class PasswordGenerationController extends Controller
{
    //
    // ini fungsi untuk memberikan password default kepada user
    // data password bisa di akses di : /sales-passwords


    public function generatePasswords()
    {        
        

        $sales = User::all(); // Ambil semua data sales dari database

        foreach ($sales as $salesUser) {
            $password = $salesUser->name . Str::random(10); // Membuat kombinasi nama dengan 10 karakter acak
            $encryptedPassword = Crypt::encrypt($password); // Mengenkripsi password

            // Memperbarui password di dalam database
            $salesUser->update(['password' => $encryptedPassword]);
        }

        return "Password untuk sales berhasil di-generate dan diperbarui.";


        

    }

    public function showSalesPasswords()
    {
        // $sales = User::all(); // Ambil semua data sales dari database
        $sales = User::orderBy('created_at', 'asc')->get(); // Mengambil data sales dan mengurutkannya berdasarkan 'created_at' dari yang terlama ke yang terbaru
        return view('sales.view-sales-password', compact('sales'));
    }


}
