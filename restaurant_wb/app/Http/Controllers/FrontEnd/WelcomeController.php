<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $specials = Category::all()->first();
        $menus = Menu::all();
        // dd($menus);
        return view('welcome', compact('menus'));
    }
    public function thankyou()
    {
        return view('thankyou');
    }
}
