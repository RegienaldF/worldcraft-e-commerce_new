<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function sellerpolicy()
    {
        return view("frontend.policies.sellerpolicy");
    }

    public function returnpolicy()
    {
        return view("frontend.policies.returnpolicy");
    }

    public function supportpolicy()
    {
        return view("frontend.policies.supportpolicy");
    }

    public function terms()
    {
        return view("frontend.policies.terms");
    }

    public function privacypolicy()
    {
        return view("frontend.policies.privacypolicy");
    }
    public function check_auth()
    {
        if (Auth::check()) {
            return 1;
        } else {
            return 2;
        }
    }
}
