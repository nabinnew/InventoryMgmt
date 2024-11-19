<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function add_category(Request $request){
        $request->validate(
            [
                'name'=>'required'
            ]
            );
            $cat = New CategoryModel;
            $cat->name=$request['name'];
            $cat->save();
            return redirect('category');
    }
    function delete($id){
        $cat = CategoryModel::find($id);
        if(! is_null($cat)){
            $cat->delete();
            return redirect('category');
        }
    }
}
