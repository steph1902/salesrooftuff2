<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;

class UserController extends Controller
{


    public function showUpdatePasswordForm()
    {
        return view('sales.update_password_form');
    }

    //
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = auth()->user();

        if ($this->checkPassword($request->current_password, $user->password)) {

            // Update password
            $user->update([
                'password' => Crypt::encrypt($request->new_password),
            ]);

            return redirect()->back()->with('success', 'Password berhasil diperbarui.');
        } else {
            return redirect()->back()->withErrors(['current_password' => 'Current password salah.']);
        }
    }

    private function checkPassword($password, $hashedPassword)
    {
        $decryptedPassword = Crypt::decrypt($hashedPassword);
        return $password === $decryptedPassword;
    }



}
