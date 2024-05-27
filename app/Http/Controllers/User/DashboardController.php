<?php

namespace App\Http\Controllers\User;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $userTransaction = Transaction::where('user_id', auth()->user()->id)->get();
        $expired = $userTransaction->where('status', 'EXPIRED')->count();
        $pending = $userTransaction->where('status', 'PENDING')->count();
        $settlement = $userTransaction->where('status', 'SETTLEMENT')->count();
        $success = $userTransaction->where('status', 'SUCCESS')->count();
        return view('pages.user.index', compact(
            'expired',
            'pending',
            'settlement',
            'success'
        ));
    }

    public function changePassword()
    {
        return view('pages.user.change-password');
    }

    public function updatePassword(Request $request)
    {
        // validate
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:6',
            'confirmation_password' => 'required|min:6'
        ]);

        // check current password status
        $currentPasswordStatus = Hash::check(
            $request->current_password,
            auth()->user()->password
        );

        if ($currentPasswordStatus) {
            if ($request->password == $request->confirmation_password) {
                // get user login by auth
                $user = auth()->user();

                // update password
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->back()->with(
                    'success',
                    'password has been updated'
                );
            } else {
                return redirect()->back()->with(
                    'error',
                    'password does not match'
                );
            }
        } else {
            return redirect()->back()->with('error', 'Current password is wrong');
        }
    }
}
