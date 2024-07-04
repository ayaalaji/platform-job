@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
<link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">

				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Advanced ui</h4><span class="text-muted mt-1 tx-18 mr-2 mb-0">/ Counters</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
					
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary" id="dateButton"></button>
								<script>
                                     function setDate() {
                                         const dateButton = document.getElementById('dateButton');
                                         const today = new Date();
                                         const options = { year: 'numeric', month: 'short', day: 'numeric' };
                                         const formattedDate = today.toLocaleDateString('en-US', options);
                                         dateButton.textContent = formattedDate;
                                     }
        
                                     document.addEventListener('DOMContentLoaded', setDate);
                                </script>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								
							</div>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

	<!-- row -->
      <style>
        .bg-primary-gradient {
            background: linear-gradient(135deg, #007bff 0%, #00c6ff 100%);
        }
        .bg-secondary-gradient {
            background: linear-gradient(135deg, #6c757d 0%, #a9a9a9 100%);
        }
        .bg-success-gradient {
            background: linear-gradient(135deg, #28a745 0%, #5adb76 100%);
        }
        .bg-info-gradient {
            background: linear-gradient(135deg, #17a2b8 0%, #3fd1d7 100%);
        }
        .bg-warning-gradient {
            background: linear-gradient(135deg, #ffc107 0%, #ffecb3 100%);
        }
        .card {
            width: 100%;
            margin-top: 20px;
            color: white;
        }
        .card-body {
            padding: 20px;
        }
        .counter-icon {
            font-size: 36px;
            margin-right: 10px;
        }
        .company-box {
            margin-top: 20px;
        }
		.user-comments {
            margin-top: 20px;
        }
        .user-comments .comment-box {
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
    <div class="container stair-container">
        <div class="col-lg-3 col-md-6">
            <div class="card bg-primary-gradient">
                <div class="card-body">
                    <div class="counter-status d-flex md-mb-0">
                        <div class="counter-icon">
                            <i class="icon icon-people"></i>
                        </div>
                        <div class="mr-auto">
                            <h5 class="tx-18 tx-white-8 mb-3">الزبائن</h5>
                            <h2 class="counter mb-0 text-white">
                                @php
                                    $userCount = \App\Models\User::count();
                                    echo $userCount;
                                @endphp
                            </h2>
                            
                        </div>
                    </div>
                    <br>
                    <hr>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card bg-secondary-gradient">
                <div class="card-body">
                    <div class="counter-status d-flex md-mb-0">
                        <div class="counter-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="mr-auto">
                            <h5 class="tx-18 tx-white-8 mb-3">الشركات</h5>
                            <h2 class="counter mb-0 text-white">
                                @php
                                    $companyCount = \App\Models\Company::count();
                                    echo $companyCount;
                                @endphp
                            </h2>
                            
                        </div>
                    </div>
                    <br>
                    <hr>
                </div>
            </div>
        </div>

               <div class="row">
            @php
                $companies = \App\Models\Company::withCount('posts', 'articles')->get();
                $colors = ['bg-success-gradient', 'bg-info-gradient', 'bg-warning-gradient'];
                $color_index = 0;
            @endphp
            @foreach ($companies as $company)
                <div class="col-lg-3 col-md-6">
                    <div class="card {{ $colors[$color_index % count($colors)] }}">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="mr-auto">
                                    <h5 class="tx-18 mb-3">المنشورات</h5>
                                    <h5 class="tx-18 mb-3">{{ $company->name }}</h5>
                                    <p class="mb-0">{{ $company->posts_count }} منشورات</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php $color_index++; @endphp
            @endforeach
        </div>

        <!-- السطر الرابع: عدد المقالات لكل شركة -->
        <div class="row">
            @php
                $color_index = 0;
            @endphp
            @foreach ($companies as $company)
                <div class="col-lg-3 col-md-6">
                    <div class="card {{ $colors[$color_index % count($colors)] }}">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                                <div class="mr-auto">
                                    <h5 class="tx-18 mb-3">المقالات</h5>
                                    <h5 class="tx-18 mb-3">{{ $company->name }}</h5>
                                    <p class="mb-0">{{ $company->articles_count }} مقالات</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php $color_index++; @endphp
            @endforeach
        </div>
    </div>

        <div class="row user-comments">
            @php
                $users = \App\Models\User::where('role', 'user')->withCount('comments')->get();
            @endphp
            @foreach ($users as $user)
                <div class="col-lg-3 col-md-6">
                    <div class="card {{ $colors[$color_index % count($colors)] }}">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <div class="mr-auto">
                                    <h5 class="tx-18 mb-3">{{ $user->name }}</h5>
                                    <p class="mb-0">{{ $user->comments_count }} تعليقات</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php $color_index++; @endphp
            @endforeach
        </div>
    </div>			
				<!-- row closed -->

			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Counters -->
<script src="{{URL::asset('assets/plugins/counters/waypoints.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/counters/counterup.min.js')}}"></script>
<!--Internal Time Counter -->
<script src="{{URL::asset('assets/plugins/counters/jquery.missofis-countdown.js')}}"></script>
<script src="{{URL::asset('assets/plugins/counters/counter.js')}}"></script>
@endsection
