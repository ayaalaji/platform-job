@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الشركات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إدارة الشركات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')


<!-- validation  strat -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

 <!-- Display session errors -->
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

  <!-- Display Restore,ForceDelet  -->
  @if (session('success'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
	  <strong>{{ session('success') }}</strong>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
	  </button>
  </div>
 @endif   


@if (session()->has('Add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('Add') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('edit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('edit') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<!-- validation  end -->


<!-- row -->
<div class="row">
		<!--div-->
		<div class="col-xl-12">
		<div class="card mg-b-20">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<h4 class="card-title mg-b-0">جدول الشركات</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
			</div>
			<div class="col-sm-4 col-md-4">
		
			<div class="card-body">
				@can('اضافة شركة')
				<a class="btn ripple btn-warning" data-target="#modaldemo6" data-toggle="modal" href="">إضافة شركة جديد</a>
				@endcan
				</div>
			</div>
		
			<div class="card-body">
				<div class="table-responsive">
					<table id="example1" class="table key-buttons text-md-nowrap">
						<thead>
							<tr>
								<th class="border-bottom-0">#N</th>
								<th class="border-bottom-0">اسم الشركة</th>
								<th class="border-bottom-0">ايميل الشركة</th>
								<th class="border-bottom-0">الموقع</th>
								<th class="border-bottom-0">الوصف</th>
								<th class="border-bottom-0">اسم المدير</th>
								
								<th class="border-bottom-0">رقم هاتف المدير</th>
								<th class="border-bottom-0"> شعار الشركة</th>
								<th class="border-bottom-0"> لون الشركة</th>
								<th class="border-bottom-0">الأدوات</th>								
							</tr>
						</thead>
						<tbody>
							@foreach($companies as $company)
							  <tr>
								    <td>{{$loop->iteration}}</td>
								    <td>{{$company->name}}</td>
								    <td>{{$company->email}}</td>
								    <td>{{$company->address}}</td>
								    <td>{{$company->descraption}}</td>
								    <td>{{$company->manager}}</td>
								 
								    <td>{{$company->manager_phone}}</td>
								    <td>
                                        <a href="{{ asset($company->logo) }}" target="_blank">
                                            <img src="{{ asset($company->logo) }}" alt="Company Logo" style="width: 100px; height: auto;">
                                        </a>
                                    </td>
								    <td>{{$company->color}}</td>
								    <td>
                                       @can('تعديل شركة')
									   <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
										   data-id="{{ $company->id }}"
										   data-name="{{ $company->name }}"
										   data-email="{{ $company->email }}"
										   data-password="{{ $company->password }}"
										   data-address="{{ $company->address }}"
										   data-descraption="{{ $company->descraption }}"
										   data-manager="{{ $company->manager }}"
										   
										   data-manager_phone="{{ $company->manager_phone }}"
										   data-logo="{{ $company->logo }}"
                                           data-color="{{ $company->color }}"
										   data-toggle="modal"
										   href="#exampleModal2" title="edit"><i class="las la-pen"></i></a>
										@endcan
										@can('حذف شركة')
									    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
										   data-id="{{ $company->id }}" 
										   data-name="{{ $company->name }}"
										   data-toggle="modal" href="#modaldemo9" title="delete"><i
											  class="las la-trash"></i></a>
										@endcan
								    </td>									
									@endforeach
							  </tr>
							</tbody>
						</table>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
                    <h3>الشركات المحذوفة مؤقتا</h3>
                    <table id="example2" class="table key-buttons text-md-nowrap">
						<thead>
							<tr>
								<th class="border-bottom-0">#N</th>
								<th class="border-bottom-0">اسم الشركة</th>
								<th class="border-bottom-0">ايميل الشركة</th>
								<th class="border-bottom-0">الموقع</th>
								<th class="border-bottom-0">الوصف</th>
								<th class="border-bottom-0">اسم المدير</th>
								
								<th class="border-bottom-0">رقم هاتف المدير</th>
								<th class="border-bottom-0"> شعار الشركة</th>
								<th class="border-bottom-0"> لون الشركة</th>
								<th class="border-bottom-0">الأدوات</th>
							</tr>
						</thead>
                        <tbody>
                        @foreach($trachedCompanies as $company)
                        <tr>
                            <td>{{$loop->iteration}}</td>
							<td>{{$company->name}}</td>
							<td>{{$company->email}}</td>
							<td>{{$company->address}}</td>
							<td>{{$company->descraption}}</td>
							<td>{{$company->manager}}</td>
							
							<td>{{$company->manager_phone}}</td>
							<td>
                                <a href="{{ asset($company->logo) }}" target="_blank">
                                    <img src="{{ asset($company->logo) }}" alt="Company Logo" style="width: 100px; height: auto;">
                                </a>
                            </td>
							<td>{{$company->color}}</td>
                            <td>
                                    <form action="{{ route('companies.restore', $company->id) }}" method="POST" style="display:inline-block;">
									    @method('POST')
                                        @csrf
										@can('استعادة شركة')
                                        <button type="submit" class="btn btn-warning">استعادة</button>
										@endcan
                                    </form>
                                    <form action="{{ route('companies.forceDelete', $company->id) }}" method="POST" style="display:inline-block;">
                                        @method('DELETE')
                                        @csrf
										@can('حذف شركة')
                                        <button type="submit" class="btn btn-danger">حذف نهائي </button>
										@endcan
									</form>
                            </td>
                        </tr>
                    @endforeach
                	</tbody>
					</table>
				</div>
			</div>		
		</div>

		</div>
		<!--/div-->
</div>
<!-- /row -->


<!-- Add modal -->
		<div class="modal" id="modaldemo6">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">إضافة شركة جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form action="{{route('companies.store')}}" method="post">
							@method('POST')
							@csrf 
							<div class="form-group">
								<label for="exampleInputEmail1">اسم شركة</label>
								<input type="text" class="form-control" id="name" name="name">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">ايميل شركة</label>
								<input type="email" class="form-control" id="email" name="email">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">كلمة السر</label>
								<input type="password" class="form-control" id="password" name="password">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">تاكيد كلمة السر</label>
								<input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">الموقع</label>
								<input type="text" class="form-control" id="address" name="address">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">الوصف</label>
								<input type="text" class="form-control" id="descraption" name="descraption">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">اسم المدير</label>
								<input type="text" class="form-control" id="manager" name="manager">
							</div>
							
							<div class="form-group">
								<label for="exampleInputEmail1">رقم هاتف المدير</label>
								<input type="text" class="form-control" id="manager_phone" name="manager_phone">
							</div>

							<div class="form-group">
                               <label for="logo">شعار الشركة</label>
                               <input type="file" class="form-control" id="logo" name="logo" required>
                            </div>

                            <div class="form-group">
                                <label for="color">لون الشركة</label>
                                <input type="color" class="form-control" id="color" name="color" required>
                            </div>

							<div class="modal-footer">
								<button type="submit" class="btn btn-success" >إضافة</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
							</div>
						</form>						
					</div>
				</div>
			</div>
		</div>
<!--End Add modal -->



   <!-- edit modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل الشركة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($companies->isEmpty())
					    <P> No Company Found!</P>
					@else	
                    <form id="updateCompanyForm" method="post" autocomplete="off" enctype="multipart/form-data">
					@method('PUT')
					@csrf
					<div class="form-group">
						<input type="hidden" id="updateCompanyId" name="Company_id" value="">

						<label for="exampleInputEmail1">اسم الشركة</label>
						<input type="text" class="form-control" id="name" name="name">

						<label for="exampleInputEmail1"> الايميل :</label>
						<input type="email" class="form-control" id="email" name="email">

						<label for="exampleInputEmail1"> كلمة السر :</label>
					    <input type="password" class="form-control" id="password" name="password">

						<label for="exampleInputEmail1"> الموقع :</label>
					    <input type="text" class="form-control" id="address" name="address">

						<label for="exampleInputEmail1"> الوصف :</label>
					    <input type="text" class="form-control" id="descraption" name="descraption">

						<label for="exampleInputEmail1"> اسم المدير :</label>
					    <input type="text" class="form-control" id="manager" name="manager">

						<label for="exampleInputEmail1"> رقم هاتف المدير :</label>
					    <input type="text" class="form-control" id="manager_phone" name="manager_phone">

						<label for="logo">شعار الشركة</label>
                        <input type="file" class="form-control" id="logo" name="logo">

						<label for="color">لون الشركة</label>
                        <input type="color" class="form-control" id="color" name="color">
					</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">تعديل</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<!-- end edit model -->


<!-- delete model -->
<div class="modal" id="modaldemo9">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content modal-content-demo">
			<div class="modal-header">
				<h6 class="modal-title">حذف شركة</h6><button aria-label="Close" class="close" data-dismiss="modal"
					type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<form id="deleteCompanyForm" method="post" autocomplete="off">
				@method('DELETE')
				@csrf
				<div class="modal-body">
					<p>هل أنت متأكد أنك تريد الحذف؟</p><br>
					<input type="hidden" id="deleteCompanyId" name="Company_id" value="">
					<input class="form-control" name="name" id="name" type="text" readonly>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
					<button type="submit" class="btn btn-danger">حذف</button>
				</div>
		</div>
		</form>
		@endif
	</div>
</div>
<!-- end delete model -->

				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection



@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var email = button.data('email')
        var password = button.data('password')
        var address = button.data('address')
        var descraption = button.data('descraption')
        var manager = button.data('manager')
        var manager_phone = button.data('manager_phone')
		var Company_id = button.data('Company_id')
		

        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body #password').val(password);
        modal.find('.modal-body #address').val(address);
        modal.find('.modal-body #descraption').val(descraption);
        modal.find('.modal-body #manager').val(manager);
        modal.find('.modal-body #manager_phone').val(manager_phone);
        modal.find('.modal-body #Company_id').val(Company_id);
       

    })

</script>

<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')

        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
    })

</script>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		const modalLinks = document.querySelectorAll('.modal-effect');
	
		modalLinks.forEach(link => {
			link.addEventListener('click', function (event) {
				// Get the data-id value
				const dataId = event.currentTarget.dataset.id;
	
				// Update Form
				const updateForm = document.getElementById('updateCompanyForm');
				const updateHiddenInput = document.getElementById('updateCompanyId');
				updateHiddenInput.value = dataId;
				updateForm.action = `{{ route('companies.update', '') }}/${dataId}`;
	
				// Delete Form
				const deleteForm = document.getElementById('deleteCompanyForm');
				const deleteHiddenInput = document.getElementById('deleteCompanyId');
				deleteHiddenInput.value = dataId;
				deleteForm.action = `{{ route('companies.destroy', '') }}/${dataId}`;
			});
		});
	});
	</script>

@endsection