

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
                <a href="/dashboard" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="/user/profile" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Profile</a>
                <a href="/RegisterPoultry" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Chickens</a>
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


        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Poultry Record</h6>
                    <a href="/RegisterPoultry">VISIT</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                        <tr class="text-white">
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Number of chickens</th>
                            <th scope="col">Farmer</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($chicken as $chickens)
                        <tr>
                            <td>{{$chickens->id}}</td>
                            <td>{{$chickens->date}}</td>
                            <td>{{$chickens->number}}</td>
                            <td>{{ $chickens->farmerName }}</td>
                            <td>{{$chickens->farmerPhone}}</td>
                            <td><span class="badge bg-success">{{$chickens->status}}</span></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->

        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Eggs Record</h6>
                    <a href="/eggs">VISIT</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                        <tr class="text-white">
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Number of chickens</th>
                            <th scope="col">Farmer</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($eggsRecord as $chickens)
                            <tr>
                                <td>{{$chickens->id}}</td>
                                <td>{{$chickens->date}}</td>
                                <td>{{$chickens->eggs_number}}</td>
                                <td>{{ $chickens->farmerName }}</td>
                                <td>{{$chickens->farmerPhone}}</td>
                                <td><span class="badge bg-success">{{$chickens->status}}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Include Chart.js library -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Chart Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Daily Eggs entry</h6>
                        <canvas id="eggData"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Chicken Data entry</h6>
                        <canvas id="chickenData"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Comparison</h6>
                        <div style="height: 300px; width: 100%;">
                            <canvas id="pieChartComparison"></canvas>
                        </div>

                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">Sales</h6>
                        <div style="height: 300px; width: 100%;">
                            <canvas id="pieChartSales"></canvas>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- Chart End -->

        <script>


            // Fetch chicken data from your backend (replace with your actual data)
            var chickenData = <?php echo json_encode($chicken); ?>;

            // Extract IDs and Numbers from the chickenData
            var chickenIDs = chickenData.map(chicken => chicken.id);
            var chickenNumbers = chickenData.map(chicken => chicken.number);

            // Create a bar chart for Chicken Data
            var ctxChicken = document.getElementById('chickenData').getContext('2d');
            new Chart(ctxChicken, {
                type: 'bar',
                data: {
                    labels: chickenIDs,
                    datasets: [{
                        label: 'Number of Chickens',
                        data: chickenNumbers,
                        backgroundColor: [
                            'rgb(79,122,6)',
                            'rgb(152,78,78)',
                            'rgb(147,135,135)',
                            'rgb(40,113,185)',
                            'rgb(178,19,19)',
                            'rgb(190,129,127)',
                            'rgb(105,97,97)',
                            'rgb(222,215,219)',
                            'rgb(238,42,42)',
                            'rgb(77,6,6)',
                            // Add more colors if needed
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            // Add more colors if needed
                        ],
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'category', // Change the x-axis scale type to category
                            position: 'bottom',
                            title: {
                                display: true,
                                text: 'Chicken ID'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Number of Chickens'
                            }
                        }
                    }
                }
            });


        </script>

    <!-- eggs -->
        <script>
            // Fetch egg data from your backend (replace with your actual data)
            var eggData = <?php echo json_encode($eggsRecord); ?>;

            // Extract IDs and Numbers from the eggData
            var eggIDs = eggData.map(egg => egg.id);
            var eggNumbers = eggData.map(egg => egg.eggs_number);

            // Create a line chart for Egg Data
            var ctxEgg = document.getElementById('eggData').getContext('2d');
            new Chart(ctxEgg, {
                type: 'bar',
                data: {
                    labels: eggIDs,
                    datasets: [{
                        label: 'Number of Eggs',
                        data: eggNumbers,
                        backgroundColor: [
                            'rgb(232,18,12)',
                            'rgb(67,150,234)',
                            'rgb(79,122,6)',
                            'rgb(152,78,78)',
                            'rgb(147,135,135)',
                            'rgb(40,113,185)',
                            'rgb(178,19,19)',
                            'rgb(190,129,127)',
                            'rgb(105,97,97)',
                            'rgb(222,215,219)',
                            // Add more colors if needed
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            // Add more colors if needed
                        ],
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'category',
                            position: 'bottom',
                            title: {
                                display: true,
                                text: 'Egg ID'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Number of Eggs'
                            }
                        }
                    }
                }
            });
        </script>




{{--        <script>--}}
{{--            var distinctSalesTypes = <?php echo json_encode($distinctSalesTypes); ?>;--}}

{{--            // Log the distinct sales types to the console--}}
{{--            console.log(distinctSalesTypes);--}}
{{--        </script>--}}


        <script>
            var salesData = @json($distinctSalesTypes);

            // Extract sales types and quantities from the data
            var salesTypes = salesData.map(sale => sale.salesType);
            var quantities = salesData.map(sale => sale.totalQuantity);

            var ctx = document.getElementById('pieChartSales').getContext('2d');
            var pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: salesTypes,
                    datasets: [{
                        label: 'Sales',
                        data: quantities,
                        backgroundColor: [
                            'rgba(56,204,14,0.2)',
                            'rgba(245,243,243,0.2)',
                            // Add more colors if needed
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            // Add more colors if needed
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>


        <script>
            // Assuming you have already fetched the count of chickens and eggs
            var chickenCount = <?php echo $Count; ?>;
            var eggsCount = <?php echo $eggs; ?>;

            var ctx = document.getElementById('pieChartComparison').getContext('2d');
            var pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Chickens', 'Eggs'],
                    datasets: [{
                        data: [chickenCount, eggsCount],
                        backgroundColor: [
                            'rgb(206,65,58)',
                            'rgba(207,223,232,0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>










@endsection
