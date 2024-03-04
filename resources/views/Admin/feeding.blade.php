

@extends('Admin.app')

@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


    <style>
        #myInput {
            background-image: url('https://cdn.dribbble.com/users/891352/screenshots/2651893/media/5ee1d7a165e16c19170de70532424186.gif');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 5%;
        }
        select.select2 {
            width: 300px;
        }
    </style>


    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-secondary navbar-dark">
            <a href="/dashboard" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Poultry System</h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="{{asset('Admin/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0">{{auth()->user()->name}}</h6>
                    <span>Farmer</span>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <a href="/dashboard" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="/user/profile" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Profile</a>
                <a href="/RegisterPoultry" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Chickens</a>
                <a href="/eggs" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Eggs</a>
                <a href="/sales" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Sales</a>
                <a href="/news" class="nav-item nav-link active"><i class="fa fa-list-alt"></i>Others</a>

            </div>
        </nav>
    </div>
    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
            <a href="/dashboard" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <form class="d-none d-md-flex ms-4">
                <input class="form-control bg-dark border-0" type="search" placeholder="Search">
            </form>
            <div class="navbar-nav align-items-center ms-auto">

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-lg-2" src="{{asset('Admin/img/user.jpg')}}" alt="{{auth()->user()->name}}" style="width: 40px; height: 40px;">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                        <a href="/user/profile" class="dropdown-item">My Profile</a>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

                </div>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Poultry Farming Information Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fas fa-egg fa-3x text-warning"></i>
                        <div class="ms-3">
                            <p class="mb-2">Eggs Laid Today</p>
                            <h6 class="mb-0">{{$todaysEggs}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fas fa-layer-group fa-3x text-warning"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total Chickens Registered</p>
                            <h6 class="mb-0">{{$Count}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fas fa-dollar-sign fa-3x text-success"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total Eggs</p>
                            <h6 class="mb-0">{{$eggs}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fas fa-dollar-sign fa-3x text-success"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total Revenue</p>
                            <h6 class="mb-0">Ksh. {{$totalSales}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Poultry Farming Information End -->

        <!-- Poultry Products Sales -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Poultry Feeds</h6>
                </div>

                <!-- Feeds Entry Form -->
                <form action="{{ route('Feeding') }}" method="post" id="salesForm">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="feedName" class="form-label">Feed Name</label>
                            <input type="text" class="form-control" id="feedName" name="feedName" >
                            @error('feedName')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" >
                            @error('quantity')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="supplier" class="form-label">Supplier</label>
                            <select class="select2 form-control" id="supplier" name="supplier" >
                                <option selected disabled>----</option>
                                <option value="JUBILEE FEEDS INDUSTRIES LTD">JUBILEE FEEDS INDUSTRIES LTD</option>
                                <option value="WONDER FEEDS LIMITED">WONDER FEEDS LIMITED</option>
                                <option value="PIONEER FEED">PIONEER FEEDS</option>
                                <option value="HAPPY FEEDS">HAPPY FEEDS</option>
                                <option value="SIGMA FEEDS">SIGMA FEEDS</option>
                                <option value="TARIME SUPPLIERS LTD">TARIME SUPPLIERS LTD</option>
                                <option value="TAMFEEDS LTD">TAMFEEDS LTD</option>
                                <option value="CHANIA FOODS">CHANIA FOODS</option>
                                <option value="CHICKEN BASKET">CHICKEN BASKET</option>
                                <option value="SIGNATURE FEEDS LIMITED">SIGNATURE FEEDS LIMITED</option>
                            </select>
                            @error('supplier')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="purchaseDate" class="form-label">Purchase Date</label>
                            <input type="date" class="form-control" id="purchaseDate" name="purchaseDate" >
                            @error('purchaseDate')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <script>
                                // Get today's date and format it as "YYYY-MM-DD" (compatible with the input type="date")
                                var today = new Date();
                                var formattedDate = today.toISOString().split('T')[0];

                                // Set the formatted date as the value of the "Purchase Date" input
                                document.getElementById('purchaseDate').value = formattedDate;
                            </script>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="comments" class="form-label">Comments</label>
                            <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                            @error('comments')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>



            </div>
        </div>



        <!-- Poultry Products Sales -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Poultry Feeds</h6>
                </div>



                <div class="mb-3">
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search anything.." title="Type in a name">
                </div>

                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0" id="myTable">
                        <thead class="text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Feeds Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Date</th>
                            <th scope="col">Comments</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{-- Add your sales data dynamically --}}
                        @foreach($feed as $sale)
                            <tr>
                                <td>{{$sale->id}}</td>
                                <td>{{$sale->feedName}}</td>
                                <td>{{$sale->quantity}}</td>
                                <td>{{$sale->supplier}}</td>
                                <td>{{$sale->purchaseDate}}</td>
                                <td>{{$sale->comments}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>






                <!-- jQuery script to update price field -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#productType').change(function() {
                            // Fetch the corresponding price for the selected sales type
                            let selectedOption = $(this).find(':selected');
                            let selectedPrice = selectedOption.data('price');
                            $('#price').val(selectedPrice ? selectedPrice : '');
                        });
                    });
                </script>


                <script>
                    function calculateTotal() {
                        let price = parseFloat(document.getElementById('price').value);
                        let quantity = parseFloat(document.getElementById('quantity').value);
                        let total = price * quantity;
                        document.getElementById('total').value = isNaN(total) ? '' : total.toFixed(2);
                    }
                </script>

                <!-- Add this script after your previous JavaScript code -->
                <script>
                    function validateQuantity() {
                        let selectedType = document.getElementById('productType');
                        let selectedQuantity = parseFloat(document.getElementById('quantity').value);

                        if (!selectedType || isNaN(selectedQuantity)) {
                            return true; // Validation will be handled by HTML5 'required' attribute
                        }

                        let availableCount = parseFloat(selectedType.options[selectedType.selectedIndex].dataset.count);

                        if (selectedQuantity > availableCount) {
                            alert('Error: Quantity exceeds available count.');
                            return false;
                        }

                        return true;
                    }

                    // Add the onsubmit attribute to your form
                    document.getElementById('salesForm').onsubmit = validateQuantity;
                </script>

                <script>
                    function myFunction() {
                        var input, filter, table, tr, td, i, txtValue;
                        input = document.getElementById("myInput");
                        filter = input.value.toUpperCase();
                        table = document.getElementById("myTable");
                        tr = table.getElementsByTagName("tr");

                        for (i = 0; i < tr.length; i++) {
                            var display = "none";  // Set the default display to "none"

                            // Exclude the table head from search
                            if (tr[i].getElementsByTagName("th").length > 0) {
                                tr[i].style.display = "";
                                continue;  // Skip to the next iteration if it's the table head
                            }

                            // Loop through the columns (0 to 5)
                            for (var j = 0; j < 6; j++) {
                                td = tr[i].getElementsByTagName("td")[j];

                                if (td) {
                                    txtValue = td.textContent || td.innerText;

                                    // If any of the columns match the search criteria, set display to "table-row"
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                        display = "table-row";
                                        break;  // Break the inner loop if a match is found in any column
                                    }
                                }
                            }

                            tr[i].style.display = display;
                        }
                    }
                </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <script>
        $(document).ready(function () {
            $(".select2").select2();
        });

    </script>













@endsection
