<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\CustomerModel;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class crud extends Controller
{
    function add_customer(Request $request){
        $request->validate(
            [
                'cus-name'=>'required',
                'cus-add'=>'required',
                'cus-gender'=>'required',
                'cus-email'=>'required|email',
                'cus-phone'=>'required|digits:10|numeric',

            ]
            );
            
            $cust =   CustomerModel::where('cphone',$request['cus-phone'])->first();
             if(! $cust == null) {
              return redirect('customer')->with('alert', 'Number already exists');
            }
            
            $cus = new CustomerModel();

$cus->cname=$request['cus-name'];
$cus->cadd=$request['cus-add'];
$cus->cgender=$request['cus-gender'];
$cus->cemail=$request['cus-email'];
$cus->cphone=$request['cus-phone'];
$cus->save();
return redirect('customer') ;
}
  function delete($id){
 $cus = CustomerModel :: find($id);
 if(! is_null($cus)){
    $cus->delete();
 }
 return redirect('customer') ;
     }

     function update_dtls($id){
        $cus = CustomerModel:: find($id);
        if(! is_null($cus)){
        $data =compact('cus','id');
        return view('site.customer_update')->with($data);

        }else{
          return  redirect('customer');
        }
     }
     function update($id ,Request $request){
        $cus = CustomerModel::find($id);
        $cus->cname=$request['cus-name'];
$cus->cadd=$request['cus-add'];
$cus->cgender=$request['cus-gender'];
$cus->cemail=$request['cus-email'];
$cus->cphone=$request['cus-phone'];
$cus->save();
return redirect('customer') ;

     }


 

     public function getname(Request $request)
     {
        //   $phone = $request->query('phone');
     
        //   $cus = CustomerModel::where('cphone', $phone)->first();
         
        //  // Check if the customer exists and return the name
        //   return response()->json([
        //      'name' => $cus ? $cus->cname : null,
        //  ]);


        $phone = $request->query('phone');
     
        $cus = CustomerModel::where('cphone', $phone)->first();
       
       // Check if the customer exists and return the name
        return response()->json([
           'name' => $cus ? $cus : null,
       ]);
     }

}
