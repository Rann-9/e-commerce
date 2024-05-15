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
