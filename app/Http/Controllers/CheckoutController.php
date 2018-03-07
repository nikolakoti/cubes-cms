<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Webshop\Checkout;

use App\Webshop\ShoppingCart;

class CheckoutController extends Controller
{
    public function index() {
        //session()->forget('checkout'); dd();
       $checkout = Checkout::getCheckoutFromSession();        
        
        return view ('front.checkout.index', [
            
            'checkout' => $checkout
        ]);
    }
    
    public function process() {
        
        $request = request();
        
        $formData =  $request->validate([
            'customerName' => 'required|string|min:3|max:10',
            'customerEmail' => 'required|email',
            'customerPhone' => 'required',
                
           'customerCountry' => 'required', 
            'customerCity' => 'required',
            'customerZip' => 'required',
            'customerAddress' => 'required',
            
            'deliveryCountry' => 'required', 
            'deliveryCity' => 'required',
            'deliveryZip' => 'required',
            'deliveryAddress' => 'required',
            
            
        ]);
        
        $checkout = Checkout::getCheckoutFromSession();
        
        $checkout->setCustomerName($formData['customerName']);
        $checkout->setCustomerEmail($formData['customerEmail']);
        $checkout->setCustomerPhone($formData['customerPhone']);
        $checkout->setCustomerCountry($formData['customerCountry']);
        $checkout->setCustomerCity($formData['customerCity']);
        $checkout->setCustomerZip($formData['customerZip']);
        $checkout->setCustomerAddress($formData['customerAddress']);
        
        $checkout->setdeliveryCountry($formData['deliveryCountry']);
        $checkout->setdeliveryCity($formData['deliveryCity']);
        $checkout->setdeliveryZip($formData['deliveryZip']);
        $checkout->setdeliveryAddress($formData['deliveryAddress']);
        
        return redirect()->route('checkout.confirmation')
                ->with('systemMessage', 'Ok! Please confirm your purchase!');
    }
    
    public function confirmation() {
        
        $checkout = Checkout::getCheckoutFromSession();
        $shoppingCart = ShoppingCart::getCartFromSession();
        return view('front.checkout.confirmation', [
            'checkout' => $checkout,
            'shoppingCart' => $shoppingCart
        ]);
    }
    
    public function confirm() {
        
        //create order
        
        
        //clear shopping cart items
        
        
        
        
        return redirect()->route('front.checkout.finish')
                ->with('systemMessage', 'Congrats! Your order has been registered, we will contact you soon.');
    }
    
    public function finish() {
        
        //read order from database
        
        
        return ('front.checkout.finish');
    }
    
    
    
}
