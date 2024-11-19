<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ItemModel;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class ProductController extends Controller
{
     

  public function add_product(Request $request)
{
    // Validate the request
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric|min:0',  
        'sellprice' => 'required|numeric|min:0',  
        'photo' => 'required|image',
        'descr' => 'required',
        'qty' => 'required|numeric|min:1', 
        'catagory' => 'required'
    ]);

    // Handle the photo upload
    $image = $request->file('photo');
    $destinationPath = 'images';
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path($destinationPath), $imageName);

    // Calculate profit
    $profit = $request->sellprice - $request->price;

    // Define search attributes for existing product
    $searchAttributes = ['pname' => $request->name];

    // Define attributes to update or create
    $updateAttributes = [
        'pprice' => $request->price,
        'sellprice' => $request->sellprice,
        'pqty' => $request->qty,
        'category' => $request->catagory,
        'pphoto' => $imageName,
        'pdesc' => $request->descr,
        'profit' => $profit,
    ];

    // Use updateOrCreate method to either update or create
    try{
      ItemModel::updateOrCreate($searchAttributes, $updateAttributes);
    }
    catch (\Exception $e) {
           $item = New ItemModel();
           $item->pname=$request['name']; 
           $item->pprice=$request['price'];
           $item->sellprice=$request['sellprice'];
           $item->pqty=$request['qty'];
           $item->category=$request['catagory'];
           $item->pphoto=$imageName;
           $item->pdesc=$request['descr'];
           $item->profit=$profit;
           
           $item->save();
           return redirect(to: 'items');
         }

    
    

    // Redirect to the items page with a success message
    return redirect('items')->with('success', 'Product added/updated successfully');
}

  //  public function add_product(Request $request)
  //  {
  //      // Validate the request
  //      $request->validate([
  //       'name' => 'required',
  //       'price' => 'required|numeric|min:0',  
  //       'sellprice' => 'required|numeric|min:0',  
  //       'photo' => 'required|image',
  //       'descr' => 'required',
  //       'qty' => 'required|numeric|min:1', 
  //       'catagory' => 'required'
  //   ]);
    
   
  //      // Handle the photo upload
  //      $image = $request->file('photo');
  //      $destinationPath = 'images';
  //      $imageName = time() . '.' . $image->getClientOriginalExtension();
  //      $image->move(public_path($destinationPath), $imageName);
  //  $profit = $request['sellprice'] - $request['price'];
  //       // Define the attributes to search for an existing product
  //      $searchAttributes = ['pname' => $request['name']];
   
  //      // Define the attributes to update or create
  //      $updateAttributes = [
  //          'pprice' => $request['price|numeric'],
  //          'sellprice' => $request['sellprice|numeric'],
  //          'pqty' => $request['qty|numeric'],
  //          'category' => $request['catagory'],
  //          'pphoto' => $imageName,
  //          'pdesc' => $request['descr'],
  //      ];
   
  //       // Use updateOrCreate method
  //       try {
  //        $item = ItemModel::updateOrCreate($searchAttributes, $updateAttributes);
  //    } catch (\Exception $e) {
  //      $item = New ItemModel();
  //      $item->pname=$request['name']; 
  //      $item->pprice=$request['price'];
  //      $item->sellprice=$request['sellprice'];
  //      $item->pqty=$request['qty'];
  //      $item->category=$request['catagory'];
  //      $item->pphoto=$imageName;
  //      $item->pdesc=$request['descr'];
  //      $item->profit=$profit;
       
  //      $item->save();
  //      return redirect(to: 'items');
  //    }
   
  //    // Redirect to the items page with a success message
  //    return redirect('items');
  //  }

     function delete($id){
        $item = ItemModel::find(id: $id);
        if(! is_null($item)){
            $item->delete();
        }       
             return redirect('items');

     }


     function update_dtls($id){
        $item = ItemModel:: find($id);
        $categorydata = CategoryModel::orderByDesc('id')->get();

        if(! is_null($item)){
        $data =compact('item','id','categorydata');
        return view('site.item_update')->with($data);

        }else{
          return  redirect('customer');
        }
}

function update($id ,Request $request){
    $item = ItemModel::find($id);


$fname = $request['photo'];
if($fname=="" or $fname==null){
  $fname=$item->pphoto ;
}
  $item->pname=$request['name']; 
     $item->pprice=$request['price'];
     $item->sellprice=$request['sellprice'];
     $item->pqty=$request['qty'];
     $item->category=$request['catagory'];
     $item->pphoto=$fname;
     $item->pdesc=$request['descr'];
     $item->save();
     return redirect('items');
     
 

}

 
}

 