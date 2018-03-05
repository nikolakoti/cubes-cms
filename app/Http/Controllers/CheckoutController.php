<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index() {
        
        return view ('front.checkout.index');
    }
    
    public function confirmation() {
        return ('front.checkout.confirmation');
    }
    
    public function finish() {
        
        return ('front.checkout.finish');
    }
}
