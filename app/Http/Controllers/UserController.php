<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerProducts;
use App\Models\Lead;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Create a new lead
    public function new_lead(Request $request){
        $newLead = new Lead();
        $newLead->first_name=$request->first_name;
        $newLead->middle_name=$request->middle_name;
        $newLead->last_name=$request->last_name;
        $newLead->location=$request->location;
        $newLead->gender=$request->gender;
        $newLead->phone=$request->phone;
        //We will use the user_id field to create a relationship between the leads and the user who created the lead
        $newLead->user_id=$request->user_id;
        $newLead->save();
    }

    //Convert Lead to Customer
    public function new_customer (Request $request){
        $this->validate($request, [
            'photo'=>'required',
            'annual_earning'=>'required',
        ]);
        $newCustomer = new Customer();
        //The lead_id will create a relationship between the leads and the customers.
        //Instead of reentering the lead information, we will use this id to get the lead details
        $newCustomer->lead_id=$request->lead_id;
        $imageName = "";
        //First check if an image is attached
        if ($request->hasFile('photo')){
            //Get the image name and store the image in a folder
            //We will store the file location as an url in the db
            //This will reduce the space required to store files in the db
            $imageName = $request->image->store('public/images');
        }
        $newCustomer->photo=$imageName;
        $newCustomer->annual_earning=$request->annual_earning;
        $newCustomer->user_id=$request->user_id;
        $newCustomer->save();
    }

    //Add Customer Products
    //I have created a new table that stores the customer_id and the product_id
    //This structure eases the process of updating, deleting or view the products for each customer
    //The product_id means we do not have to save all the information. We can use the id.
    //The same applies to the customer_id
    public function customer_products (Request $request) {
        $newCustomerProduct = new CustomerProducts();
        $newCustomerProduct->lead_id=$request->lead_id;
        $newCustomerProduct->product_id=$request->product_id;
        $newCustomerProduct->save();
    }

    //Get customer products
    public function customer_products_list($id){
        return CustomerProducts::with('products')->where('lead_id', $id)->get();
    }
    //Get Leads for each user
    //A user allowed to submit leads can only view their leads
    //Users allowed to create customers can view all the leads.
    //A user with user type 1 is only allowed to create a lead. Hence, can only view the leads they have created
    public function leads_list($id, $usertype){
        if($usertype===1){
            $leads = Lead::with('user')->where(["converted"=>0, "user_id"=>$id])->get();
        } else {
            $leads = Lead::with('user')->where("converted",0)->get();
        }
        return response()->json($leads);
    }
    //Get Lead details using the id
    public function lead_details($id){
        return Lead::where('id', $id)->first();
    }
}
