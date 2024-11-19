
@extends('master')

 @section('title') {{{ $title }}} @stop
     
  @section('content')



 
<link rel="stylesheet" href="{{asset('css/dashboard.css')}}" />

 <div class="container">
    <div class="card customer">
        <div class="  clogo">
            <img src="/imgs/customers.png" alt="">
        </div>
        <span class="total">Total Customer</span>
        <span class="number" >{{$cus}}</span>
    </div>
    <div class="card product">
        <div class="  clogo">
            <img src="/imgs/products.png" alt="">
        </div>
        <span class="total">Total Product</span>
        <span class="number" style="color: #4874a7;">{{$item}}</span>
    </div>
    <div class="card money">
        <div class="  clogo">
            <img src="/imgs/money.png" alt="">
        </div>
        <span class="total">Total Economy</span>
        <span class="number" style="color: #08662f;">{{$amt}}</span>
    </div>
  </div>
 
  <div class="details">
    <div class=" dtl sales-dtl">
    <h2>Total Sales = </h2> <span>{{$amt}}</span>
</div>
    <div class="  dtl profit-dtl">
    <h2>Total profit = </h2> <span> {{$profit}}</span>
</div>
  </div>
    
 @endsection