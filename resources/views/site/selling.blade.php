@extends('master')

@section('title', $title)

@section('content')

<link rel="stylesheet" href="{{ asset('/css/selling.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<div>
    <form class="invoice-form" action="/addrecord" method="POST" id="invoiceForm">
        @csrf
        <!-- Customer Information -->
        <div class="customer-info">
            <div class="input-group">
                <label for="contact-number">Contact Number</label>
                <input type="text" id="phone" placeholder="984*******" name="phone">
                <p style="color: red ">
                    @error('phone')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="input-group">
                <label for="customer-name">Customer Name</label>
                <input type="text" id="name" placeholder=" " name="name" readonly>
            </div>
            <div class="input-group">
                <label for="address">Address</label>
                <input type="text" id="add" placeholder="  " name="add" readonly>
            </div>
            <div class="input-group">
                <label for="invoice-number">Email</label>
                <input type="email" id="email" placeholder="" name="email" readonly>
            </div>
            <div class="input-group">
                <label for="payment-type">Payment Type</label>
                <select id="payment-type" name="payment">
                    <option value="cash">Cash Payment</option>
                    <option value="card">Card Payment</option>
                </select>
            </div>
            <div class="input-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" value="{{ date('Y-m-d') }}">
            </div>
        </div>
        <div class="view"> <a href="sell">View Selling Report</a> </div>

        <!-- Inventory Information -->
        <div class="container">
            <div class="invoice-header">
                <h2>New Customer Purchase</h2>
            </div>

            <div class="inventory-info">
                <table id="inventoryTable">
                    <thead>
                        <tr>
                            <th>Select Category</th>
                            <th>Select Name</th>
                            <th>Photo</th>
                            <th>Total Stock</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="inventory">
                        <tr>
                            <td>
                                <select class="cat-select" name="category[]">
                                    <option>Select category</option>
                                    @foreach ($cat as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="pname-select" name="product_name[]">
                                    <option value="">Select name</option>
                                </select>
                            </td>
                            <td><img src="{{asset('imgs/plus.png')}}" class="imgs" alt="product photo"></td>
                            <td><input type="text" placeholder="Available Quantity" class="available" name="available[]"
                                    readonly></td>
                            <td><input type="text" placeholder="0" class="qty" name="quantity[]"
                                    oninput="calculateRowTotal(this)"></td>
                            <td><input type="text" placeholder="Price" class="price" name="price[]" readonly>
                                {{-- .......................................... --}}
                                <input type="hidden" class="p">
                                <input type="hidden" name="profit[]" class="profit">
                            </td>
                            <td><input type="text" placeholder="Total" class="total" name="total[]" readonly></td>
                            <td>
                                <button type="button" class="add-btn" onclick="addRow(this)"> +
                                </button>
                                <button type="button" class="delete-btn" onclick="deleteRow(this)">-</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Total Price Display -->
            <div id="totalBox">
                Total Price: <span id="totalPrice">0</span>
                <input type="hidden" name="totalamt" id="totalamt" value="0">
                <input type="hidden" name="totalprofit" id="profit" value="0">
            </div>

            <!-- Submit Button -->
            <div class="save-btn">
                <button type="submit" onclick="handleFormSubmission(event)">Submit</button>
            </div>
        </div>
    </form>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<script>
    $(document).ready(function () {
        // Update product names when category changes
        $(document).on('change', '.cat-select', function () {
            var $row = $(this).closest('tr');
            var catId = $(this).val();
            var $pnameSelect = $row.find('.pname-select');

            if (catId) {
                $pnameSelect.empty().append('<option value="">Loading...</option>');

                $.ajax({
                    url: 'getcat',
                    type: 'GET',
                    data: { cat: catId },
                    success: function (response) {
                        $pnameSelect.empty();
                        if (!response.name || response.name.length === 0) {
                            $pnameSelect.append('<option value="">No names found</option>');
                        } else {
                            $pnameSelect.append('<option value="">Select name</option>');
                            response.name.forEach(function (element) {
                                $pnameSelect.append(`<option value="${element.pname}">${element.pname}</option>`);
                            });
                        }
                    },
                    error: function () {
                        $pnameSelect.empty().append('<option value="">Error loading names</option>');
                    }
                });
            } else {
                $pnameSelect.empty().append('<option value="">Select name</option>');
            }
        });

        // Retrieve product details
        $(document).on('change', '.pname-select', function () {
            var $row = $(this).closest('tr');
            var productName = $(this).val();

            if (productName) {
                $.ajax({
                    url: '/getproductdetails',
                    type: 'GET',
                    data: { productName: productName },
                    success: function (data) {
                        if (data.image) {
                            $row.find('.imgs').attr('src', data.image);
                        }
                        if (data.price) {
                            $row.find('.price').val(data.price);
                            $row.find('.available').val(data.qty);
                            $row.find('.p').val(data.profit);


                        }
                    },
                    error: function () {
                        alert('Product details not found.');
                    }
                });
            }
        });

        // Fetch customer info by phone
        $('#phone').on('input', function () {
            var phone = $(this).val();

            $.ajax({
                url: 'getname',
                type: 'GET',
                data: { phone: phone },
                success: function (response) {
                    $('#name').val(response.name ? response.name.cname : 'User not found');
                    $('#add').val(response.name ? response.name.cadd : '');
                    $('#email').val(response.name ? response.name.cemail : '');
                },
                error: function () {
                    $('#name, #add, #email').val('');
                }
            });
        });

        // Prevent form submission if any quantity is out of stock
        $('.invoice-form').on('submit', function (e) {
            var outOfStock = false;
            $('#inventory .qty').each(function () {
                if ($(this).val() === 'Out of Stock') {
                    outOfStock = true;
                }
            });
            if (outOfStock) {
                e.preventDefault(); // Prevent submission
                alert('Please adjust the quantities. Some items are out of stock.');
            }
        });
    });



    function addRow(button) {
        // Get the closest row to the button that was clicked
        var $row = $(button).closest('tr');

        // Log the entire row for debugging
 

        // Get values from the selected row
        let name = $row.find('.pname-select').val();
        let qty = $row.find('.qty').val();
        let phone =document.querySelector("#phone").value;
        let cname =  document.querySelector("#name").value;

        let catname = $row.find('.cat-select').val();
        let price = $row.find('.price').val();
        let total = $row.find('.total').val();


        // Check if both name and quantity are defined
        if (name && qty) {
            invupdate(name, qty,price, cname, phone, catname, total); // Call invupdate with name and qty
        } else {
            console.error("Name or quantity is not defined.");
        }

        // Logic to add a new row to the table can be added here
        let newRow = `<tr>
                    <td>
                        <select class="cat-select" name="category[]">
                            <option>Select category</option>
                            @foreach ($cat as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="pname-select" name="product_name[]">
                            <option value="">Select name</option>
                        </select>
                    </td>
                    <td><img src="{{asset('imgs/plus.png')}}" class="imgs" alt="product photo"></td>
                    <td><input type="text" placeholder="Available Quantity" class="available" name="available[]" readonly></td>
                    <td><input type="text" placeholder="0" class="qty" name="quantity[]" oninput="calculateRowTotal(this)"></td>
                    <td><input type="text" placeholder="Price" class="price" name="price[]" readonly>
                        <input type="hidden" class="p">
                        <input type="hidden" name="profit[]" class="profit">
                    </td>
                    <td><input type="text" placeholder="Total" class="total" name="total[]" readonly></td>
                    <td>
                        <button type="button" class="add-btn" onclick="addRow(this)">+</button>
                        <button type="button" class="delete-btn" onclick="deleteRow(this)">-</button>
                    </td>
                  </tr>`;


        $('#inventory').append(newRow);
    }


    // Define the invupdate function to send AJAX GET request with data in the URL
    function invupdate(name, qty,price, cname, phone, catname, total) {
        console.log("Name:", name);
        console.log("Quantity:", qty);
        console.log("Category Name:", catname);
        console.log("cus Name:", cname);
        console.log("phone:", phone);
        console.log("priceprice:", price);
        console.log("Total:", total);
        // $.ajax({
        //     // url: `/updateinventory`,
        //     url: '/updateinventory/'+encodeURIComponent(name)+'/'+encodeURIComponent(qty),
        //     type: 'GET',

        //     success: function(response) {
        //         console.log("Update successful:", response);
        //      },
        //     error: function() {
        //         console.error("Update failed:");
        //     }
        // });
        $.ajax({
            url: '/updateinventory', // Cleaner URL without parameters in the URL itself
            type: 'GET',
            // data: {
            //     name: name,
            //     qty: qty,
            //     cname: cname, phone: phone, cat: catname, tot: total,
            // },
            data: { 
    qty: qty,
    name: name,
    phone: phone,
    cname: cname,
    catname: catname, 
    price: price,
    total: total
},
            success: function (response) {
               // console.log("Update successful:", response);
            },
            error: function () {
                console.error("Update failed:");
            }
        });


    }








    function deleteRow(button) {
        if ($('#inventory tr').length > 1) {
            $(button).closest('tr').remove();
            calculateTotal();
        }
    }

    function calculateRowTotal(qtyInput) {
        var $row = $(qtyInput).closest('tr');
        var quantity = parseFloat($(qtyInput).val()) || 0;
        var availableStock = parseFloat($row.find('.available').val()) || 0;
        var price = parseFloat($row.find('.price').val()) || 0;

        if (quantity > availableStock) {
            // Set quantity and total inputs to "Out of Stock"
            $row.find('.qty').val('Out of Stock');
            $row.find('.total').val('Out of Stock');
        } else {
            var total = quantity * price;
            $row.find('.total').val(total.toFixed(2));
            var p = parseFloat($row.find('.p').val()) || 0;
            var profit = quantity * p;
            $row.find('.profit').val(profit.toFixed(2));


        }

        calculateTotal();
    }

    function calculateTotal() {
        var grandTotal = 0;


        $('.total').each(function () {
            var total = $(this).val();
            if (total !== 'Out of Stock') {
                grandTotal += parseFloat(total) || 0;
            }
        });
        $('#totalPrice').text(grandTotal.toFixed(2));
        $('#totalamt').val(grandTotal.toFixed(2));



        let totalProfit = 0;

        $('.profit').each(function () {
            const value = $(this).val().trim();
            if (value && value !== 'Out of Stock') {
                totalProfit += parseFloat(value) || 0;
            }
        });

        // Update the displayed total profit
        $('#profit').val(totalProfit.toFixed(2));
    }


</script>
<script>
    function downloadBill() {
        // Collect form data
        const formData = new FormData(document.querySelector('.invoice-form'));
        var name = document.getElementById('name').value;

        // Generate bill content
        let billContent = `
------------------------------------------------------
                         INVOICE                     
------------------------------------------------------

Date: ${new Date().toLocaleDateString()}
Time: ${new Date().toLocaleTimeString()}

------------------------------------------------------
                    CUSTOMER INFORMATION             
------------------------------------------------------
Contact Number:       ${formData.get('phone')}
Customer Name:        ${formData.get('name')}
Address:              ${formData.get('add')}
Email:                ${formData.get('email')}
Payment Type:         ${formData.get('payment')}

------------------------------------------------------
                     PURCHASE DETAILS                
------------------------------------------------------
Items:
`;

        // Collect and format inventory items
        const categories = formData.getAll('category[]');
        const productNames = formData.getAll('product_name[]');
        const quantities = formData.getAll('quantity[]');
        const prices = formData.getAll('price[]');
        const totals = formData.getAll('total[]');

        for (let i = 0; i < categories.length; i++) {
            billContent += `
Category:        ${categories[i]}
Product Name:    ${productNames[i]}
Quantity:        ${quantities[i]}
Price:           ${prices[i]}
Total:           ${totals[i]}

------------------------------------------------------
`;
        }

        billContent += `
Total Amount:           ${document.getElementById('totalPrice').textContent}

------------------------------------------------------
           Thank you for shopping with us!
------------------------------------------------------
`;

        // Trigger download of the bill
        const blob = new Blob([billContent], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        let img = name + '.png';


        a.download = name + '.txt'; // Name of the file to download
        document.body.appendChild(a);
        a.click(); // Initiates download
        document.body.removeChild(a);
        URL.revokeObjectURL(url); // Free up memory
    }

    function downloadImage() {
        // Take a screenshot of the body content
        html2canvas(document.body, {
            onrendered: function (canvas) {
                var link = document.createElement('a');
                var name = document.getElementById('name').value;
                console.log(name);

                link.href = canvas.toDataURL();
                let img = name + '.png';
                link.download = img;

                // Trigger the download
                link.click();
            }
        });
    }
//     function handleFormSubmission() {
//         let p = document.querySelector("#phone").value;
//         if(p=="" && p==null){
// alert("enter phone");
//         }else{
//         downloadBill();
//         //   downloadImage();
//         // Submit the form after printing
//         document.getElementById('invoiceForm').submit();
//    } }
function handleFormSubmission(event) {
        event.preventDefault(); // Prevent the form from submitting by default
        let phoneInput = document.getElementById("phone").value;
 
        if (phoneInput === ""  ) {
            alert("Please enter a phone number");
            return; // Stop further execution if the phone number is empty
        }else{

        downloadBill();
      document.getElementById('invoiceForm').submit();
}}
</script>

@endsection