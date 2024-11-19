<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\ItemModel;
use App\Models\CategoryModel;
class InventoryController extends Controller
{
public function customer(){
    
 
    $cusdata = CustomerModel:: orderByDesc('id')->get();
    $title="customer-page";
    return view('site.customer', compact('cusdata','title'));


}
public function items(){
    $categorydata = CategoryModel::orderByDesc('id')->get();
    $itemdata=ItemModel::orderByDesc('id')->get();
    $title="Product-page";
    return view('site.items',compact('itemdata','categorydata','title'));


}
public function category(){
    $categorydata = CategoryModel::orderByDesc('id')->get();
     $title="category-page";
    return view('site.category',compact( 'categorydata','title'));


}
public function selling(){
    $cat = CategoryModel::get();
     
         $title="selling-page";
        return view('site.selling', compact('title','cat'));
    
    
    }

    public function test(){
        $cat = CategoryModel::get();
     
        $title="selling-page";
       return view('site.test', compact('title','cat'));
    
    }

}
