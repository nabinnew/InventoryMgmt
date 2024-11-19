<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\ItemModel;
use App\Models\SellingModel;
use Illuminate\Http\Request;

class DashbordController extends Controller
{
   

    function dashbord(){
        $title ="dashbord-form";
        $cus = CustomerModel::count();
        $item = ItemModel::count();
        $profit= SellingModel::sum('profit');
        $amt= SellingModel::sum('amount');

         return view('site.dashbord',compact('title','cus','item','profit','amt'));
    }

}
