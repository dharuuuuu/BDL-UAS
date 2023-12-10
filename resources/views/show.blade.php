@extends('layouts.app')
@section('content')

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>Employee Details</b></div>
			<div class="col col-md-6">
				<a href="{{ route('employees.index') }}" class="btn btn-primary btn-sm float-end">View All</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Name</b></label>
			<div class="col-sm-10">
				{{ $employees->name }}
			</div>
		</div>
        <div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Email</b></label>
			<div class="col-sm-10">
				{{ $employees->email }}
			</div>
		</div>
		<div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Age</b></label>
			<div class="col-sm-10">
				{{ $employees->age }}
			</div>
		</div>
        <div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Salary</b></label>
			<div class="col-sm-10">
				{{ $employees->salary }}
			</div>
		</div>
        <div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Position</b></label>
			@if ($employees->position == 'Junior Web')
                <div class="badge bg-success col-sm-1">Junior Web</div>
            @elseif ($employees->position == 'Senior Web')
                <div class="badge bg-warning text-dark col-sm-1">Senior Web</div>
            @else
                <div class="badge bg-dark col-sm-1">Designer</div>
            @endif
		</div>
		<div class="row mb-4">
			<label class="col-sm-2 col-label-form"><b>Gender</b></label>
			@if ($employees->gender == 'Male')
                <div class="badge bg-primary col-sm-1">Male</div>
            @else
                <div class="badge bg-danger col-sm-1">Female</div>
            @endif
		</div>
        <div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Join Date</b></label>
			<div class="col-sm-10">
				{{ \Carbon\Carbon::parse($employees->join_date)->format('Y-m-d') }}
			</div>
		</div>
	</div>
</div>

@endsection('content')
