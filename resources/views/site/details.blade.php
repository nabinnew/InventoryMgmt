@extends('master')

@section('title', $title)

@section('content')
 <link rel="stylesheet" href="{{ asset('css/details.css') }}">
    <div class="invoice">
        <div class="header">
            <form action="{{ url('search/' . $data->phone) }}" method="POST">
                @csrf
                <select name="date" id="date">
                    <option value="today">Today</option>
                    <option value="all_time">All Time</option>
                    <option value="calendar">Calendar</option>
                </select>
                
                <div id="calendar-input" style="display: none;">
                    <input type="date" placeholder="Select Date" name="calendar_date" id="calendar_date">
                </div>
            
                <button>Search</button>
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
<script>
    // Show/Hide calendar input based on selected option
    document.getElementById('date').addEventListener('change', function() {
        var calendarInput = document.getElementById('calendar-input');
        if (this.value === 'calendar') {
            calendarInput.style.display = 'block';
        } else {
            calendarInput.style.display = 'none';
        }
    });
</script>


@endsection