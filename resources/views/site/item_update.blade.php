<!--  


if(isset($_POST['product_update'])){
    $itemid=  $_GET['itemid'];
  
    $pname=$_POST['name'];
    $pprice=$_POST['price'];
     $pqty=$_POST['qty'];
    $pcatagory=$_POST['catagory'];
     $descr =htmlspecialchars($descr);
   $fname = $_FILES['photo']['name'];
  if($fname=="" or $fname==null){
    $fname=$row['pphoto'];
  }
  if($sellprice=="---- Select ----"){
    $sellprice=$row['sellprice'];
  }
  $sellprice=$_POST['sellprice'];

   $qr = "UPDATE product 
   SET pname = '$pname', pprice = '$pprice',sellprice = '$sellprice', pqty = '$pqty', ccatagory = '$pcatagory',pphoto='$fname', pdesc = '$descr' 
   WHERE id = $itemid";      
             
         $res = $con->query($qr);
         if($res){
            header("Location: items.php");
  
         }}
  -->


  <link rel="stylesheet" href="{{asset('css/item.css')}}">

 <form action="/item/update/{{$item->id}}" method="post" id="items-forms" enctype="multipart/form-data"  >
    @csrf
    <h5>Product Details:-</h5>
    <div class="container">
        <div class="left item-box">
            <div>
             <label for="name">Product Name:-</label>
                <input type="text" name="name" id="name" value="{{$item->pname}}">
                <p style="color: red">
                    @error('name')
                        {{$message}}
                    @enderror
                   </p>
            </div>
            <div>
                <label for="price">Product Price:-</label>
                <input type="text" name="price" id="price" value="{{$item->pprice}}">
           <p style="color: red">
            @error('price')
                {{$message}}
            @enderror
           </p>
            </div>
            <div>
                <label for="sprice">selling Price:-</label>
                <input type="text" name="sellprice" id="sprice" value="{{$item->sellprice}}">
                  <p style="color: red">
            @error('sellprice')
                {{$message}}
            @enderror
           </p>
            </div>
        </div>
        <div class="middle item-box">

            <h3>select photo from here..</h3>
            <input type="file" class="button" name="photo" onchange=""  value=" 
            <h1><label for="desc">Description</label></h1>

            <textarea name="descr" id="desc" cols="30" rows="9" value=" ">{{$item->pdesc}} </textarea>
              <p style="color: red">
            @error('descr')
                {{$message}}
            @enderror
           </p>
        </div>
        <div class="right item-box">
            <div>
                <label for="Quantity">Quantity:-</label>
                <input type="text" name="qty" id="Quantity" value="{{$item->pqty}}">
                  <p style="color: red">
            @error('qty')
                {{$message}}
            @enderror
           </p>
            </div>
            <div>
                <label for="select">category:-</label>
                <select id="select" name="catagory">
                <option > {{$item->category}} </option>
                  @foreach ($categorydata as $cat)
                      <option value="{{$cat->name}}"> {{$cat->name}}</option>
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

 