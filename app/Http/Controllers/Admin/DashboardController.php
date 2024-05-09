<?php

namespace App\Http\Controllers\Admin;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;


class DashboardController extends Controller
{
    public function index()
    {
        $category = Category::count();
        $product = Product::count();
        $user = User::where('role', 'user')->count();
        return view('pages.admin.index', compact(
            'category',
            'product',
            'user'
        ));
    }

    public function listUser()
    {
        $user = User::where('role', 'user')->get();

        return view('pages.admin.list-user', compact(
            'user'
        ));
    }

    public function changePassword()
    {
        return view('pages.user.index');
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

    public function resetPassword($id)
    {
        // get user by id
        $user = User::find($id);
        $user->password = Hash::make('password');
        $user->save();

        return redirect()->back()->with(
            'success',
            'Password has been reset'
        );
    }
}
