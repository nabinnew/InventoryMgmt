 @extends('master')
  
 @section('title'){{$title}} @stop
    
 @section('content')
     
 
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
     <link rel="stylesheet" href="{{asset('css/item.css')}}" />
 </head>
 
 


<body>
 
    <form action="{{url('/')}}/insert_product" method="post" id="items-forms" enctype="multipart/form-data"  >
        @csrf
        <h5>Product Details:-</h5>
        <div class="container">
            <div class="left item-box">
                <div>
                 <label for="name">Product Name:-</label>
                    <input type="text" name="name" id="name" value="{{old('name')}}">
                    <p style="color: red">
                        @error('name')
                            {{$message}}
                        @enderror
                       </p>
                </div>
                <div>
                    <label for="price">Product Price:-</label>
                    <input type="text" name="price" id="price"value="{{old('price')}}">
               <p style="color: red">
                @error('price')
                    {{$message}}
                @enderror
               </p>
                </div>
                <div>
                    <label for="sprice">selling Price:-</label>
                    <input type="text" name="sellprice" id="sprice"value="{{old('sellprice')}}">
                      <p style="color: red">
                @error('sellprice')
                    {{$message}}
                @enderror
               </p>
                </div>
            </div>
            <div class="middle item-box">
 
                <h3>select photo from here..</h3>
                <input type="file" class="button" name="photo" onchange="" value="{{old('photo')}}">
                  <p style="color: red">
                @error('photo')
                    {{$message}}
                @enderror
               </p>
                <h1><label for="desc">Description</label></h1>

                <textarea name="descr" id="desc" cols="30" rows="9" value="{{old('descr')}}"></textarea>
                  <p style="color: red">
                @error('descr')
                    {{$message}}
                @enderror
               </p>
            </div>
            <div class="right item-box">
                <div>
                    <label for="Quantity">Quantity:-</label>
                    <input type="text" name="qty" id="Quantity" value="{{old('qty')}}">
                      <p style="color: red">
                @error('qty')
                    {{$message}}
                @enderror
               </p>
                </div>
                <div>
                    <label for="select">category:-</label>
                    <select id="select" name="catagory">
                    <option >---- Select ----</option>
                      @foreach ($categorydata as $cat)
                          <option value="{{$cat->name}}">{{$cat->name}}</option>
                      @endforeach
                    </select>
                      <p style="color: red">
                @error('catagory')
                    {{$message}}
                @enderror
               </p>
                 </div>
            </div>
        </div>
        <hr>
        <div class="item-add-buttons">
            <button id="btn" name="product_add">Insert</button>

            <button onclick="clearitems()">Clear</button>
        </div>
    </form>



    <div class="container">
        <table border="1">
            <thead>
                <tr>
                    <th>Sn</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Selling price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php                
                $sn = 0;
                                ?>
                                @foreach ($itemdata as $item)
                                    
                             
                        <tr>
                            <td>{{ $sn += 1 }}</td>
                            <td>{{$item->pname}}</td>
                            <td> {{$item->pprice}}</td>
                            <td> {{$item->sellprice}}</td>
                            <td> {{$item->pqty}}</td>
                            <td> {{$item->category}}</td>
                             <td>

                                <a class="update" href="{{url('item/update')}}/{{$item->id}}">Update</a><br><br>
                                <a class="delete" href="{{url('item/delete')}}/{{$item->id}}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
            
            </tbody>
        </table>
    </div>
</body>
{{-- <script src="./js file/cus_clear.js"></script>
<script src="js file/jquery-3.7.1.min.js"></script> --}}
<script>
  
</script>
 
@endsection