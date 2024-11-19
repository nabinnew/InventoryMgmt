 
   <!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- <link rel="stylesheet" href="responsivenav1.css"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
     <link rel="stylesheet" href="{{asset('css/nav.css')}}">
  

</head>
<body>
	
	<nav>
		<input type="checkbox" id="check" name="" value="">
        <div class="logo">
            <img src="imgs/admin.png" alt="Logo">
        </div>	
        		<label for="check" id="checkbtn"><i class="fa fa-bars"></i></label>

        	<ul>
			<li>
                <a class=" " href="{{url('dashbord')}}">Home</a>
            </li>
            <li>
                <a href="{{url('customer')}}">Add Customer</a>
            </li>
            <li>
                <a href="{{url('category')}}">Category</a>
            </li>
            <li>
                <a href="{{url('items')}}">Add Product</a>
            </li>
            <li>
                <a href="{{url('selling')}}">Sell</a>
            </li>
            <li>
              <form action="/logout" method="post"> @csrf <input type="submit" value="Logout"> </form>
            </li>
		</ul>
		
	</nav>
</body>
</html>