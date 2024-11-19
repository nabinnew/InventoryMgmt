@extends('master')

@section('title', $title)

@section('content')
 <link rel="stylesheet" href="{{ asset('css/details.css') }}">
    <div class="invoice">
        <div class="header">
            <form action="{{ url('search/' . $data->phone) }}" method="POST">
 
                @csrf
                <select name="date" id="">
                               <input type="date" placeholder="Search" name="date" id="date"> 
                            </select>
                               <button>search</button>
                          </form>
        </div>
        <div class="bill-info">
            <div class="bill-from">
                <h3>Bill From:</h3>
                <p>Name: Grocery Inventory</p>
                <p>Address: Gaindakot</p>
            </div>
            <div class="bill-to">
                <h3>Bill To:</h3>
                <p>Name: {{$data->name}}</p>
                <p id="phone" >Phone:  {{$data->phone}}</p>
            </div>
       
        </div>
        
        <div class="prepared-by">
            <p>This Bill is prepared by:</p>
            <hr>
        </div>

        <table class="bill-table">
            <thead>
                <tr>
                    <th>SN No.</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price/Unit</th>
                    <th>Total</th>
                 </tr>
            </thead>
            <tbody>
                @php
                    $a=1;
                @endphp
                @foreach ($detail as $item)
                         <tr>
                    <td>{{$a}}</td>
                    <td>{{$item->date}}</td>
                    <td>{{$item->cat}}</td>
                    <td>{{$item->pname}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->total}}</td>
                 </tr>
                 @php
                     $a+=1;
                 @endphp
                @endforeach
            
            </tbody>
        </table>
        
        <div class="total">
            <p>Sub Total <span>₹ {{$total}}</span></p>
        </div>

        <div class="signatures">
            <p>Client's Signature</p>
            <p>Business Signature</p>
        </div>

        <footer>
            <p>Thanks for business with us!!! Please visit us again !!!</p>
        </footer>
    </div>

</body>
</html>
{{-- <script>
    
    
// Get the current date
const currentDate = new Date();

// Format the date to YYYY-MM-DD
const formattedDate = currentDate.toISOString().split('T')[0];

// Set the value of the date input field
document.getElementById('date').value = formattedDate;

    const phoneText = document.getElementById('phone').innerText;
const phone = phoneText.replace('Phone: ', '').trim();
console.log(phone); // Output: The phone number
const date = document.getElementById('date').value;
console.log(date);
</script> --}}


@endsection