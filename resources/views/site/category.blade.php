 
 @extends('master')
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="{{asset('css/category.css')}}">

      
      {{-- if name set in route then css apply from it 
      <link rel="stylesheet" href="{{route('catagory'))}}"> --}}

      @section('title'){{$title}} @stop

 
  @section('content')
      
  

    <div class="main">
        <form action="{{url('/')}}/add_category" method="post">
            @csrf
            <div class="cat">
                <label for="name">Add New category:- </label>
                <input type="text" name="name" id="name">
            </div>
            <input type="submit" name="addcategory" id="butn" value="Add Category">
        </form>
        <div class="container">
            <table border="1px">
                <tr>
                    <td>S/N</td>
                    <td>Name</td>
                    <td>edit</td>
                </tr>
                <?php
                $a=0;
                ?>
                @foreach ($categorydata as $cat)            
                        <tr>
                            <td>{{$a+=1 }}</td>
                            <td>{{$cat->name}}</td>
                            <td>
                            <a class="delete" href="{{'/category/delete'}}/{{$cat->id}}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
            
            </table>


        </div>
    </div>
    @endsection