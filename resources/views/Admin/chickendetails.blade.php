

@extends('Admin.app')

@section('content')

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
                <a href="/RegisterPoultry" class="nav-item nav-link active"><i class="fa fa-keyboard me-2"></i>Chickens</a>
                <a href="/eggs" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Eggs</a>
                <a href="/sales" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Sales</a>
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
                            <p class="mb-2">Total eggs</p>
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


        <!-- Eggs details -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0 text-light">Eggs Record</h6>

                </div>

                <!-- Individual Egg Entry Start -->
                <div class="row g-4">
                    <!-- Left side for the image -->
                    <div class="col-md-6">
                        <img src="https://www.familiesmagazine.com.au/wp-content/uploads/2016/09/Depositphotos_13219486_original-1.jpg" class="img-fluid rounded-start" alt="Egg Image">
                    </div>
                    <!-- Right side for the information -->
                    <div class="col-md-6">
                        <div class="card bg-gray-100 border-light rounded p-4">
                            <div class="card-header bg-primary text-light">
                                <h5 class="mb-0">Chicken Details</h5>
                            </div>
                            <div class="card-body">
                                <!-- Date -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <i class="far fa-calendar-alt fa-lg me-2 text-primary"></i>
                                            <span class="text-secondary">Date:</span>
                                        </div>
                                        <div class="flex-grow-1 text-end">
                                            <strong class="text-dark">{{$eggsCount->date}}</strong>
                                        </div>
                                    </div>
                                </div>
                                <!-- Number of Eggs -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-egg fa-lg me-2 text-warning"></i>
                                            <span class="text-secondary">Number of Eggs:</span>
                                        </div>
                                        <div class="flex-grow-1 text-end">
                                            <strong class="text-dark">{{$eggsCount->number}}</strong>
                                        </div>
                                    </div>
                                </div>
                                <!-- Status -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle fa-lg me-2 text-success"></i>
                                            <span class="text-secondary">Status:</span>
                                        </div>
                                        <div class="flex-grow-1 text-end">
                                            <strong class="badge bg-success">{{$eggsCount->status}}</strong>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <!-- Comments -->
                                <div class="mb-0">
                                    <div class="d-flex align-items-center">
                                        <i class="far fa-comment-alt fa-lg me-2 text-secondary"></i>
                                        <span class="text-secondary">Comments:</span>
                                    </div>
                                    <div class="mt-2">
                                        <strong class="text-dark">{{$eggsCount->comments}}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-gray-100 border-light">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <i class="far fa-user fa-lg me-2 text-info"></i>
                                        <span class="text-secondary">farmerName:</span> <strong class="text-dark">{{$eggsCount->farmerPhone}}</strong>
                                    </div>
                                    <div>
                                        <i class="fas fa-phone fa-lg me-2 text-success"></i>
                                        <span class="text-secondary">farmerPhone:</span> <strong class="text-dark">{{$eggsCount->farmerPhone}}</strong>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Individual Egg Entry End -->

        </div>
    </div>
    <!-- Eggs details End -->











@endsection
