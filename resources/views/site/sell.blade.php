 
    @extends('master')
  
    @section('title'){{$title}} @stop
       
    @section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Table Styling</title>
        <style>
            /* Container styling */
            .container {
                margin-top: 20px;
                max-width: 800px;
                margin: auto;
            }
    
            /* Table styling */
            .table {
                width: 100%;
                border-collapse: collapse;
                font-family: Arial, sans-serif;
                font-size: 16px;
            }
    
            .table thead {
                background-color: #343a40;
                color: #fff;
            }
    
            .table th, .table td {
                padding: 10px;
                border: 1px solid #ddd;
                text-align: left;
            }
    
            .table tbody tr:hover {
                background-color: #f5f5f5;
            }
    
            .table tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }
    
            /* Responsive design */
            @media (max-width: 600px) {
                .table, .table thead, .table tbody, .table th, .table td, .table tr {
                    display: block;
                }
                .table thead tr {
                    display: none;
                }
                .table tbody tr {
                    margin-bottom: 10px;
                    border: 1px solid #ddd;
                    padding: 10px;
                }
                .table tbody td {
                    text-align: right;
                    padding-left: 50%;
                    position: relative;
                }
                .table tbody td:before {
                    content: attr(data-label);
                    position: absolute;
                    left: 0;
                    width: 45%;
                    padding-left: 15px;
                    font-weight: bold;
                    text-align: left;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Number</th>
                             <th>view  </th>

                         </tr>
                    </thead>
                    <tbody>
                        @php
                            $a=1;
                        @endphp
                        @foreach ($data as $item)
                             <tr>
                            <td data-label="SN">{{$a}}</td>
                            <td data-label="Name">{{$item->name}}</td>
                            <td data-label="Number">{{$item->phone}}</td>
                          <td> <a href="/details/{{$item->phone}}">View</a></td> 
                         </tr>
                         @php
                             $a+=1;
                         @endphp
                        @endforeach
                       
                    </tbody>
                </table>
            </div>
        </div>
        <script>
              
              const fileInputs = document.querySelectorAll('.fileInput');
              console.log(fileInputs);
              

// Add event listeners to each file input
fileInputs.forEach(input => {
    input.addEventListener('click', function(event) {
        const file = event.target.files[0]; // Get the selected file
        if (file) {
            const url = URL.createObjectURL(file); // Create a URL for the file
            window.open(url); // Open the URL in a new tab
        }
    });
});
    
        </script>
    </body>
    </html>
    

@endsection