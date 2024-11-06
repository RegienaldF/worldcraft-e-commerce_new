<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class WorldcraftPagesController extends Controller
{
    public function index(){
        $category = Category::get();
        $countdownDate = Carbon::createFromFormat('Y-m-d h:i:s', '2024-11-19 11:59:00');
        return view('pages.index', compact('countdownDate', 'category'));

    }
}
