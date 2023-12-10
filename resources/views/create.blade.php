@extends('layouts.app')
@section('content')

@if($errors->any())

<div class="alert alert-danger">
	<ul>
	@foreach($errors->all() as $error)

		<li>{{ $error }}</li>

	@endforeach
	</ul>
</div>

@endif

<div class="card">
	<div class="card-header">Add Employees</div>
	<div class="card-body">
		<form method="post" action="{{ route('employees.store') }}" enctype="multipart/form-data">
			@csrf
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Name</label>
				<div class="col-sm-10">
					<input type="text" name="name" class="form-control" />
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Email</label>
				<div class="col-sm-10">
					<input type="text" name="email" class="form-control" />
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Age</label>
				<div class="col-sm-10">
					<input type="number" name="age" class="form-control" />
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Salary</label>
				<div class="col-sm-10">
					<input type="number" name="salary" class="form-control" />
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Position</label>
				<div class="col-sm-10">
					<select name="position" class="form-control">
						<option value="">-</option>
						<option value="Junior Web">Junior Web</option>
						<option value="Senior Web">Senior Web</option>
						<option value="Designer">Designer</option>
					</select>
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Gender</label>
				<div class="col-sm-10">
					<select name="gender" class="form-control">
						<option value="">-</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Join Date</label>
				<div class="col-sm-10">
					<input type="date" name="join_date" class="form-control" />
				</div>
			</div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Add" />
			</div>	
		</form>
	</div>
</div>

@endsection('content')
