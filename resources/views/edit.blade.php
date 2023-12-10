@extends('layouts.app')

@section('content')

<div class="card">
	<div class="card-header">Edit Employee</div>
	<div class="card-body">
		<form method="post" action="{{ route('employees.update', $employees->id) }}" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Name</label>
				<div class="col-sm-10">
					<input type="text" name="name" class="form-control" value="{{ $employees->name }}" />
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Email</label>
				<div class="col-sm-10">
					<input type="text" name="email" class="form-control" value="{{ $employees->email }}" />
				</div>
			</div>
            <div class="row mb-3">
				<label class="col-sm-2 col-label-form">Age</label>
				<div class="col-sm-10">
					<input type="number" name="age" class="form-control" value="{{ $employees->age }}" />
				</div>
			</div>
            <div class="row mb-3">
				<label class="col-sm-2 col-label-form">Salary</label>
				<div class="col-sm-10">
					<input type="number" name="salary" class="form-control" value="{{ $employees->salary }}" />
				</div>
			</div>
            <div class="row mb-4">
				<label class="col-sm-2 col-label-form">Position</label>
				<div class="col-sm-10">
					<select name="position" class="form-control">
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
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
			</div>
            <div class="row mb-3">
				<label class="col-sm-2 col-label-form">Join Date</label>
				<div class="col-sm-10">
					<input type="date" name="join_date" class="form-control" value="{{ $employees->join_date ? \Carbon\Carbon::parse($employees->join_date)->format('Y-m-d') : '' }}" />
				</div>
			</div>
			<div class="text-center">
				<input type="hidden" name="hidden_id" value="{{ $employees->id }}" />
				<input type="submit" class="btn btn-primary" value="Edit" />
			</div>	
		</form>
	</div>
</div>
<script>
document.getElementsByName('gender')[0].value = "{{ $employees->gender }}";
document.getElementsByName('position')[0].value = "{{ $employees->position }}";
</script>

@endsection('content')
