<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use App\Models\SelldtlModel;
use App\Models\SellingModel;
use Illuminate\Http\Request;
use Carbon\Carbon; // Import Carbon for date handling (optional)

class SellingController extends Controller
{
    public function getcat(Request $request)
    {
         $cat = $request->input('cat');
        
         $data = ItemModel::where('category', $cat)->get();  
         return response()->json([
            'name' => $data->isNotEmpty() ? $data : null,  
        ]);
    }
 


    public function getProductDetails(Request $request){
    $productName = $request->input('productName');
    $product = ItemModel::where('pname', $productName)->first();

    if ($product) {
        return response()->json([
            'image' => asset('images/' . $product->pphoto), // Assuming you store image filenames in your database
            'price' => $product->sellprice,
            'qty' => $product->pqty,
            'profit' => $product->profit,
             
        ]);
    }

    return response()->json(['error' => 'Product not found'], 404);
}
 

function addrecord(Request $request){
//  name contact email   date totalamt 
$request->validate([
    'name' => 'required',
    'phone' => 'required|digits:10|numeric',
    'email' => 'required|email',
]);

 $sell = New SellingModel();
$sell->name = $request['name'];
$sell->phone = $request['phone'];
$sell->email = $request['email'];
$sell->amount = $request['totalamt'];
$sell->profit = $request['totalprofit'];

$sell->save();
 
 
return redirect(to: 'selling');



}
function sell(){
    // $data =SelldtlModel::get();
    // $data = SelldtlModel::where('phone', operator: $id)->first();
    $data = SelldtlModel::select('phone','name')->distinct()->get();

    $title="selling-details";
    return view('site.sell', compact('title','data'));
}
 
public function updateInventory(Request $request)
{
    echo "<script> console.log($request) </script>";
    // Retrieve parameters from the request
    $name = $request->input('name');
    $qty = $request->input('qty');
     $int1 = intval($qty);  

    $item = ItemModel::where('pname', $name)->first();

    $available = $item->pqty;
     $int2 = (int) $available;    

    $rem = $int2 - $int1;
 
    $item->pqty = $rem;
// ............................................ 
     $dtl = new SelldtlModel();
     $dtl->phone = $request->input('phone');     // Phone
    $dtl->name = $request->input('cname');     // Client Name
    $dtl->pname = $request->input('name');

    $dtl->cat = $request->input('catname'); // Category Name
    $dtl->qty = $request->input('qty'); // Category Name
    $q = (int) $request->input('qty');;    

    $dtl->price = $request->input('price'); // Category Name
    $p = (int) $request->input('price');;   
    $total= $p * $q; 

    $dtl->total = $total;     // Total Amount
 $dtl->save();
    $item->save();

         return redirect('selling');


 }

 function details($id){
    $data = SelldtlModel::where('phone', $id)->first();
    $detail = SelldtlModel::where('phone', $id)->get();

    $total = SelldtlModel::where('phone', $id)->sum('total');
    $title="deteils-page";
    return view('site.details',compact('detail','title','data','total'));
    
 }
//  public function search(Request $request,$phone)
// {
//      $date = Carbon::parse($request->date)->format('Y-m-d');

//      $data = SelldtlModel::whereDate('phone', $phone)->firstOrCreate();
//      $detail = SelldtlModel::where('phone', $phone)
//      ->where('date', $date)
//      ->get();

//     $total = SelldtlModel::where('phone', $phone)->sum('total');
//     $title="deteils-page";
//     return view('site.details',compact('detail','title','data','total'));
//   }

 
public function search(Request $request, $phone)
{
     $dateOption = $request->input('date');
    
     $query = SelldtlModel::where('phone', $phone);
    
     if ($dateOption == 'today') {
         $date = Carbon::today()->format('Y-m-d');
         $query->whereDate('date', $date);
         $total = SelldtlModel::where('phone', $phone)->where('date',$date)->sum('total');

    } elseif ($dateOption == 'all_time') {
     $detail = SelldtlModel::where('phone', $phone)->get();
     $total = SelldtlModel::where('phone', $phone)->sum('total');

    } elseif ($dateOption == 'calendar') {
         $date = Carbon::parse($request->input('calendar_date'))->format('Y-m-d');
         $query->whereDate('date', $date);
         $total = SelldtlModel::where('phone', $phone)->where('date',$date)->sum('total');
    } else {
        
        return redirect()->back()->withErrors('Invalid date option.');
    }

     $detail = $query->get();

    
    $data = SelldtlModel::where('phone', $phone)->firstOrCreate();

    //  $total = SelldtlModel::where('phone', $phone)->sum('total');

     $title = "Details Page";

     return view('site.details', compact('detail', 'title', 'data', 'total', 'dateOption'));
}

}
