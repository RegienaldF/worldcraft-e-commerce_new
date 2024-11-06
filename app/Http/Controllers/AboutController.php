<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about(){
        $category = Category::get();
        return view('pages.about', compact('category'));
    }
}
