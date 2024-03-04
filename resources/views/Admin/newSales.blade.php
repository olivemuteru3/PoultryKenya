

@extends('Admin.app')

@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
                <a href="/sales" class="nav-item nav-link active"><i class="fa fa-keyboard me-2"></i>Sales</a>
                <a href="/news" class="nav-item nav-link"><i class="fa fa-list-alt"></i>Others</a>

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
                    <h6 class="mb-0">Poultry Products Sales</h6>
                </div>

                <!-- Sales Entry Form -->
                <!-- Sales Entry Form -->
                <form action="{{ route('sales') }}" method="post" id="salesForm">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <!-- Sales Type -->
                            <div class="mb-3">
                                <label for="productType" class="form-label">Sales Type</label>
                                <select class="form-select" id="productType" name="salesType" required>
                                    <option selected disabled>--select--</option>
                                    @foreach($price as $price)
                                        <option value="{{ $price->salesType }}" data-price="{{ $price->price }}">{{ $price->salesType }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Price -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" class="form-control" id="price" name="price" readonly required>
                            </div>

                            <!-- Quantity -->
                            <!-- Quantity -->
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" oninput="calculateTotal()" required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <!-- Total -->
                            <div class="mb-3">
                                <label for="total" class="form-label">Total</label>
                                <input type="text" class="form-control" id="total" name="total" readonly required>
                            </div>
                            <!-- Buyer Name -->
                            <div class="mb-3">
                                <label for="buyerName" class="form-label">Buyer Name</label>
                                <input type="text" class="form-control" id="buyerName" name="buyerName" required>
                            </div>
                            <!-- Buyer Phone -->
                            <div class="mb-3">
                                <label for="buyerPhone" class="form-label">Buyer Phone</label>
                                <input type="tel" class="form-control" id="buyerPhone" name="buyerPhone" required>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

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








                <!-- Sales Entry Form End -->

            </div>
        </div>
        <!-- Poultry Products Sales End -->

        <!-- jQuery script to update price field -->














@endsection
