@extends('admincp.spamanasys.master')

{{-- MENU BAR --}}

@section('MenuBar_DashBoard','m-menu__item')
@section('MenuBar_TitleBookingForCustomer','m-menu__item m-menu__item--submenu')
@section('MenuBar_BookingForCustomer','m-menu__item')
@section('MenuBar_ListCustomerBooking','m-menu__item')
@section('MenuBar_Search','m-menu__item')
@section('MenuBar_TitleCustomerMember','m-menu__item m-menu__item--submenu')
@section('MenuBar_AddCustomerMember','m-menu__item')
@section('MenuBar_ListCustomerMember','m-menu__item')
@section('MenuBar_TitleStaffManagement','m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--expanded')
@section('MenuBar_AddStaff','m-menu__item m-menu__item--active')
@section('MenuBar_ListStaff','m-menu__item')


{{-- END MENU BAR --}}

@section('titlePage','Đăng ký nhân viên')
@section('headTitle','Đăng ký nhân viên')

@section('content')
<!--begin::Portlet-->
<div class="m-content">
	<div class="row">
		<div class="col-xl-12">
			@include('admincp.spamanasys.notifications.notificationsAjax')
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<span class="m-portlet__head-icon m--hide">
								<i class="la la-gear"></i>
							</span>
							<h3 class="m-portlet__head-text">
								Thông tin nhân viên
							</h3>
						</div>
					</div>
				</div>
				<!--begin::Form-->
				<form id="regCustomerFrm" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Họ và Tên:
							</label>
							<div class="col-lg-3">
								<input type="text" name="fullname" class="form-control m-input">
								<span class="m-form__help fullname-error" style="color: red;font-weight: bold">
									
								</span>
							</div>
							<label class="col-lg-2 col-form-label">
								Số điện thoại:
							</label>
							<div class="col-lg-3">
								<input type="number" name="phonenumber" class="form-control m-input">
								<span class="m-form__help phonenumber-error" style="color: red;font-weight: bold">
									
								</span>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Địa chỉ:
							</label>
							<div class="col-lg-3">
								<div class="m-input-icon m-input-icon--right">
									<input type="text" name="address" class="form-control m-input">
									<span class="m-input-icon__icon m-input-icon__icon--right">
										<span>
											<i class="la la-map-marker"></i>
										</span>
									</span>
								</div>
								<span class="m-form__help">
									
								</span>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label">
								Giới tính:
							</label>
							<div class="col-lg-3">
								<div class="m-radio-inline">
									<label class="m-radio m-radio--solid">
										<input type="radio" name="gender" checked value="Nam">
										Nam
										<span></span>
									</label>
									<label class="m-radio m-radio--solid">
										<input type="radio" name="gender" value="Nữ">
										Nữ
										<span></span>
									</label>
								</div>
								<span class="m-form__help gender-error" style="color: red;font-weight: bold">
									
								</span>
							</div>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions--solid">
							<div class="row">
								<div class="col-lg-2"></div>
								<div class="col-lg-10">
									<button type="button" id="submit" class="btn btn-success">
										Đăng ký
									</button>
									<button type="reset" class="btn btn-secondary">
										Làm lại
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!--end::Form-->
			</div>

		</div>
	</div>
</div>
<!--end::Portlet-->

@endsection

@push('scripts')
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$("#submit").click(function(){
		$.ajax({
			url: '{{ route('spa_addStaff') }}',
			type: 'POST',
			dataType: 'JSON',
			data:{
				fullname:  $('input[name="fullname"]').val(),
				phonenumber: $('input[name="phonenumber"]').val(),
				address: $('input[name="address"]').val(),
				gender: $('input[name="gender"]:checked').val(),
			},
			success: function(data){
				if(data.status == true){
					$('.alert-danger').hide();
					$('.alert-success').show();
					$('.m-alert-success__text').text("Đăng ký nhân viên thành công");
					$("#regCustomerFrm")[0].reset();	
				}
			},
			error : function(data){
				$('.alert-success').hide();
				$('.alert-danger').show();
				$('.phonenumber-error').text("");
				$('.fullname-error').text("");
				$('.gender-error').text("");
				$('.phonenumber-error').text(data.responseJSON.phonenumber);
				$('.fullname-error').text(data.responseJSON.fullname);
				$('.gender-error').text(data.responseJSON.gender);
			}
		});
	});
</script>
@endpush

@push('script_header')
<script src="js/jquery-3.3.1.min.js"></script>
@endpush