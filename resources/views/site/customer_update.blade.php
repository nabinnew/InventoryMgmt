 
 @extends('master')

 @section('title') customer_update
     
 @endsection  
 @section('content')

 <link rel="stylesheet" href="{{asset('css/customer.css')}}">

   <form action="/customers/update/{{$cus->id}}" method="post">
    @csrf
        <div class="customer-dtls">
            <div>
                <label for="name">Enter Name:- </label>
                <input type="text" id="name" name="cus-name" value="{{$cus->cname}}" >
            </div>

            <div>
                <label for="add">Enter Address:- </label>
                <input type="text" id="add" name="cus-add" value="{{$cus->cadd}}">
            </div>

            <div>
                <label for="gender">Enter gender:- </label>
                <select name="cus-gender" id="gender">                    <option  value="{{$cus->cgender}} "> {{$cus->cgender}}</option>

                    <option value="male">male</option>
                    <option value="female">female</option>
                    <option value="other">other</option>
                </select>
            </div>

            <div>
                <label for="email">Enter Email:- </label>
                <input type="email" id="email" name="cus-email"value="{{$cus->cemail}} ">
            </div>

            <div>
                <label for="phone">Enter phone:- </label>
                <input type="text" id="phone" name="cus-phone" value="{{$cus->cphone}}">
            </div>
        </div>
        <div class="cus-add-buttons">
            <button name="cus_update">update</button>
            <div class="btn" onclick="document.getElementById('customerforms').reset();
            ">Clear</div>
        </div>
    </form>

    @endsection 