@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Hospital Dashboard')

@section('content')
<x-form-alerts></x-form-alerts>

<div class="row pb-10">
 @if(auth()->user()->type == 'SuperAdmin')
    <!-- Total Users Widget -->
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{$totalUsers}}</div>
                    <div class="font-14 text-secondary weight-500">
                        Total Users
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon">
                        <i class="icon-copy fa fa-users" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
   @endif
   @if(Auth::user()->type == 'doctor')
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">
                            {{ $pendingAppointmentsCount }} <!-- Dynamic Count -->
                        </div>
                        <div class="font-14 text-secondary weight-500">
                            Pending Appointments
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);">
                            <i class="icon-copy dw dw-calendar1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">
                            {{ $totalTpatient }} <!-- Dynamic Count -->
                        </div>
                        <div class="font-14 text-secondary weight-500">
                            Total Treatments
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);">
                            <i class="icon-copy dw dw-stethoscope"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">
                            {{ $totalMalepatient }} <!-- Dynamic Count -->
                        </div>
                        <div class="font-14 text-secondary weight-500">
                            Total Male Patients
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);">
                            <i class="icon-copy dw dw-group"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">
                            {{  $totalFemalePatients }} <!-- Dynamic Count -->
                        </div>
                        <div class="font-14 text-secondary weight-500">
                            Total Female Patients
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);">
                            <i class="icon-copy dw dw-group"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        @endif
        
    @if(auth()->user()->type == 'superAdmin')
    <!-- Total Patients Widget -->
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{$totalPatient}}</div>
                    <div class="font-14 text-secondary weight-500">
                        Total Patients
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#ff5b5b" style="color: rgb(255, 91, 91);">
                        <span class="icon-copy ti-heart"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
   @endif
    <!-- SuperAdmin Specific Widgets -->
    @if(auth()->user()->type == 'superAdmin')

    <!-- Total Receptionists Widget -->
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ $totalReceptionist }}</div>
                    <div class="font-14 text-secondary weight-500">
                        Total Receptionists
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon">
                        <i class="icon-copy fas fa-user-tie" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Doctors Widget -->
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ $totalDoctors }}</div>
                    <div class="font-14 text-secondary weight-500">
                        Total Doctors
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon">
                        <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total SuperAdmins Widget -->
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ $totalSuperAdmin }}</div>
                    <div class="font-14 text-secondary weight-500">
                        Total SuperAdmins
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon">
                        <i class="icon-copy fas fa-crown" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Sales Widget -->
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ number_format($totalSales) }} Tshs</div>
                    <div class="font-14 text-secondary weight-500">
                        Total Sales
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#09cc06" style="color: rgb(9, 204, 6);">
                        <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales This Month Widget -->
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ number_format($totalSalesMonthly) }} Tshs</div>
                    <div class="font-14 text-secondary weight-500">
                        Sales This Month
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#09cc06" style="color: rgb(9, 204, 6);">
                        <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales This Week Widget -->
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ number_format($totalSalesWeekly) }} Tshs</div>
                    <div class="font-14 text-secondary weight-500">
                        Sales This Week
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#09cc06" style="color: rgb(9, 204, 6);">
                        <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @endif
    @if(auth()->user()->type == 'receptionist')
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">
                        {{ $totalPatients }} <!-- Dynamic Count -->
                    </div>
                    <div class="font-14 text-secondary weight-500">
                        Total Patients
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);">
                        <i class="icon-copy dw dw-group"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">
                        {{ $totalRFemalepatient}} <!-- Dynamic Count -->
                    </div>
                    <div class="font-14 text-secondary weight-500">
                        Total Female Patients
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);">
                        <i class="icon-copy dw dw-group"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">
                        {{ $totalRMalepatient }} <!-- Dynamic Count -->
                    </div>
                    <div class="font-14 text-secondary weight-500">
                        Total Male Patients
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);">
                        <i class="icon-copy dw dw-group"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif



<!-- Overview Chart Section -->
@if(auth()->user()->type == 'superAdmin')
<div class="row">
    <!-- Overview Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Overview</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart" width="593" height="320" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Chart Section -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Details</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <!-- Pie Chart Canvas -->
                    <canvas id="myPieChart" width="593" height="245" class="chartjs-render-monitor"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <!-- Legend with icons -->
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Total Users
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-warning"></i> Total Patients
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Total Receptionists
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-danger"></i> Total Doctors
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Sales This Week
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection


@push('scripts')
<script>
// Pie Chart with dynamic data
var ctxPie = document.getElementById("myPieChart").getContext("2d");
var myPieChart = new Chart(ctxPie, {
    type: 'pie',
    data: {
        labels: [
            "Total Users", 
            "Total Patients", 
            "Total Doctors", 
            "Total Sales", 
            "Sales This Month", 
            "Sales This Week"
        ],
        datasets: [{
            data: [
                {{ $totalUsers }},
                {{ $totalPatient }},
                {{ $totalDoctors }},
                {{ number_format($totalSales) }},
                {{ number_format($totalSalesMonthly) }},
                {{ number_format($totalSalesWeekly) }}
            ],
            backgroundColor: [
                "#4e73df", // Total Users
                "#f6c23e", // Total Patients
                "#36b9cc", // Total Doctors
                "#8e44ad", // Total Sales
                "#00cc99", // Sales This Month
                "#f39c12"  // Sales This Week
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});
  // Get the dynamic data from Laravel
  var weeks = @json($weeks);  // The labels (week dates)
    var salesData = @json($salesData);  // The sales data

    // Area Chart
    var ctxArea = document.getElementById("myAreaChart").getContext("2d");
    var myAreaChart = new Chart(ctxArea, {
        type: 'line',
        data: {
            labels: weeks,  // Weeks labels (x-axis)
            datasets: [{
                label: 'Total Sales',
                data: salesData,  // Sales data (y-axis)
                backgroundColor: 'rgba(78, 115, 223, 0.2)',
                borderColor: '#4e73df',
                borderWidth: 1,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
</script>
@endpush
