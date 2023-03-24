<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Create a new user
    public function new_user(Request $request){
        $newuser = new User();
        $newuser->name=$request->name;
        $newuser->email=$request->email;
        $newuser->user_type=$request->user_type;
        //Setting a default password for all users. Ideally, it should generate a random string and send it to the user's email address.
        //That would mean creating a mail service for this section
        $newuser->password=bcrypt("Passw0rd!");
        $newuser->save();
    }
    //Get a list of users
    public function get_users_list(){
        return User::all();
    }
    //Get statistics
    //The number of items for each table
    public function stats(){
        $leads = Lead::where('converted', 0)->count();
        $customers = Customer::all()->count();
        $products = Product::where('status', 0)->count();
        return response()->json([
            "leads"=>$leads,
            "customers"=>$customers,
            "products"=>$products
        ]);
    }

    //Get Leads
    public function admin_leads_list(){
        $leads = Lead::where('converted', 0)->get();
        return response()->json($leads);
    }
    //Add Products
    public function add_products(Request $request){
        $newProduct = new Product();
        $newProduct->product_name=$request->product_name;
        $newProduct->minimum_income=$request->minimum_income;
        $newProduct->save();
    }
    //Get Products
    public function products_list(){
        $products = Product::all();
        return response()->json($products);
    }

    //Get Customers
    public function customers_list(){
        return  Customer::all();

    }
    public function product_details($id){
        return Product::where('id', $id)->first();
    }
}
