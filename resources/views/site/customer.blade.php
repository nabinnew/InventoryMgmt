  


@extends('master')

 @section('title') {{{ $title }}} @stop
     
  @section('content')

 
    
    <script>
        if (window.location.search) {
            window.history.replaceState(null, null, window.location.pathname);
            location.reload();
        }
    </script>
 

 <link rel="stylesheet" href="{{asset('css/customer.css')}}" />

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

@if(session('alert'))
    <script>
        swal({
            title: "Error!",
            text: "{{ session('alert') }}",
            type: "error",
            confirmButtonText: "OK"
        });
    </script>
@endif

    <form action="{{url('/')}}/add_cus" method="post" id="customerforms" onsubmit=" ">
        @csrf
        <h5> Fill up Customer Details:- </h5>
 
 
        <div class="customer-dtls">
            <div class="card">
                <div class="form-group">
                    <label for="name">Enter Name:</label>
                    <input type="text" id="name" name="cus-name" value="{{ old('cus-name') }}"> 
                    <p>
                        @error('cus-name')
                            {{ $message }}
                        @enderror 
                    </p>
                </div>
    
                <div class="form-group">
                    <label for="add">Enter Address:</label>
                    <input type="text" id="add" name="cus-add" value="{{ old('cus-add') }}">
                    <p>
                        @error('cus-add')
                            {{ $message }}
                        @enderror 
                    </p>
                </div>
    
                <div class="form-group">
                    <label for="gender">Enter Gender:</label>
                    <select name="cus-gender" id="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    <p>
                        @error('cus-gender')
                            {{ $message }}
                        @enderror 
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="form-group">
                    <label for="email">Enter Email:</label>
                    <input type="email" id="email" name="cus-email" value="{{ old('cus-email') }}">
                    <p>
                        @error('cus-email')
                            {{ $message }}
                        @enderror 
                    </p>
                </div>
    
                <div class="form-group">
                    <label for="phone">Enter Phone:</label>
                    <input type="text" id="phone" name="cus-phone" value="{{ old('cus-phone') }}">
                    <p>
                        @error('cus-phone')
                            {{ $message }}
                        @enderror 
                    </p>
                </div>
            </div>
        </div>

        {{-- ............................................................  --}}
        </div>
        <hr>
        <div class="cus-add-buttons ">
            <button onclick=" ">Insert</button>
            <div class="btn" onclick="document.getElementById('customerforms').reset();
">Clear</div>
        </div>
    </form>


    <br>

    

    <div class="container">
        <table border="1">
            <thead>
                <tr>
                    <th>Sn</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>gender</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php $a=0; ?>
@foreach ($cusdata as $item)

   <tr>
    <td>{{$a+=1}}</td>
<td>{{$item->cname}}</td>    
<td>{{$item->cadd}}</td>    
<td>{{$item->cgender}}</td>    
<td>{{$item->cemail}}</td>    
<td>{{$item->cphone}}</td>    
<td>
    <a class="update" href=" {{url('customer/update')}}/{{$item->id}}">Update</a>
    <br><br>

   <a class="delete" href=" {{url('customer/delete')}}/{{$item->id}}">Delete</a>
</td>
</tr>  
@endforeach

               
            </tbody>
        </table>

    </div>
 <script>
    document.getElementById('customer-form').reset();
    if (window.location.search) {
        window.history.replaceState(null, null, window.location.pathname);
    }


    
</script>
@endsection
