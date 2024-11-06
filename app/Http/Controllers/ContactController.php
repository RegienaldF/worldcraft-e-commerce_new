<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(){
        $category = Category::get();
        return view('pages.contact', compact('category'));
    }
}
