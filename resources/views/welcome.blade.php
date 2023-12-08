@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3" style="text-align: center;">Laravel Filter Query Pegawai</h4>
                    <form action="/" method="get">
                        
                        @csrf

                            <div class="form-group mb-3">
                                <label for="" class="form-label">Name</label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="Name" value="{{isset($_GET['name']) ? $_GET['name'] : ''}}">  
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="" class="form-label">Min Age</label>
                                    <input id="min_age" name="min_age" type="number" class="form-control" placeholder="Min Age" value="{{isset($_GET['min_age']) ? $_GET['min_age'] : ''}}">  
                                </div>

                                <div class="col">
                                    <label for="" class="form-label">Max Age</label>
                                    <input id="max_age" name="max_age" type="number" class="form-control" placeholder="Max Age" value="{{isset($_GET['max_age']) ? $_GET['max_age'] : ''}}">  
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label for="" class="form-label">Min Salary</label>
                                    <input id="min_salary" name="min_salary" type="number" class="form-control" placeholder="Min Salary" value="{{isset($_GET['min_salary']) ? $_GET['min_salary'] : ''}}">  
                                </div>

                                <div class="col">
                                    <label for="" class="form-label">Max Salary</label>
                                    <input id="max_salary" name="max_salary" type="number" class="form-control" placeholder="Max Salary" value="{{isset($_GET['max_salary']) ? $_GET['max_salary'] : ''}}">  
                                </div>
                            </div>

                            <div class="form-group mt-3 mb-3">
                                <label for="" class="form-label">Average Salary by Position</label>
                                <select id="avg_salary" name="avg_salary" class="form-select">
                                    <option value="" {{ !isset($_GET['avg_salary']) ? 'selected' : '' }}>-</option>
                                    <option value="Average Junior Web" {{ isset($_GET['avg_salary']) && $_GET['avg_salary'] == 'Average Junior Web' ? 'selected' : '' }}>Diatas Average Gaji Junior Web = {{ $averageSalaryJuniorWeb }}</option>
                                    <option value="Average Senior Web" {{ isset($_GET['avg_salary']) && $_GET['avg_salary'] == 'Average Senior Web' ? 'selected' : '' }}>Diatas Average Gaji Senior Web = {{ $averageSalarySeniorWeb }}</option>
                                    <option value="Average Designer" {{ isset($_GET['avg_salary']) && $_GET['avg_salary'] == 'Average Designer' ? 'selected' : '' }}>Diatas Average Gaji Designer = {{ $averageSalaryDesigner }}</option>
                                </select>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label for="" class="form-label">Join Date From</label>
                                    <input id="date_from" name="date_from" type="date" class="form-control" placeholder="Min Age" value="{{isset($_GET['date_from']) ? $_GET['date_from'] : ''}}">  
                                </div>

                                <div class="col">
                                    <label for="" class="form-label">Join Date To</label>
                                    <input id="date_to" name="date_to" type="date" class="form-control" placeholder="Max Age" value="{{isset($_GET['date_to']) ? $_GET['date_to'] : ''}}">  
                                </div>
                            </div>

                            <div class="form-group mt-3 mb-3">
                                <label for="" class="form-label">Position</label>
                                <select id="position" name="position" class="form-select">
                                    <option value="" {{ !isset($_GET['position']) ? 'selected' : '' }}>-</option>
                                    <option value="Junior Web" {{ isset($_GET['position']) && $_GET['position'] == 'Junior Web' ? 'selected' : '' }}>Junior Web</option>
                                    <option value="Senior Web" {{ isset($_GET['position']) && $_GET['position'] == 'Senior Web' ? 'selected' : '' }}>Senior Web</option>
                                    <option value="Designer" {{ isset($_GET['position']) && $_GET['position'] == 'Designer' ? 'selected' : '' }}>Designer</option>
                                </select>
                            </div>

                            <div class="form-group mt-3 mb-3">
                                <label for="" class="form-label">Gender</label>
                                <select id="gender" name="gender" class="form-select">
                                    <option value="" {{ !isset($_GET['gender']) ? 'selected' : '' }}>-</option>
                                    <option value="male" {{ isset($_GET['gender']) && $_GET['gender'] == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ isset($_GET['gender']) && $_GET['gender'] == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                            <div class="col-sm-3 mb-3">
                                <button type="submit" class="btn btn-primary mt-4">Search</button>
                                <button type="submit" class="btn btn-warning mt-4" onclick="resetForm()">Reset</button>
                            </div>

                            <script>
                                function resetForm() {
                                    document.getElementById("name").value = '';
                                    document.getElementById("min_age").value = '';
                                    document.getElementById("max_age").value = '';
                                    document.getElementById("gender").value = '';
                                    document.getElementById("min_salary").value = '';
                                    document.getElementById("max_salary").value = '';
                                    document.getElementById("date_to").value = '';
                                    document.getElementById("date_from").value = '';
                                    document.getElementById("position").value = '';
                                    document.getElementById("avg_salary").value = '';
                                }
                            </script>
                        
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Age</th>
                                <th scope="col">Salary</th>
                                <th scope="col">Join Date</th>
                                <th scope="col">Position</th>
                                <th scope="col">Gender</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                                <tr>
                                    <td>{{$employee->id}}</td>
                                    <td>{{$employee->name}}</td>
                                    <td>{{$employee->email}}</td>
                                    <td>{{$employee->age}}</td>
                                    <td>{{$employee->salary}}</td>
                                    <td>{{ \Carbon\Carbon::parse($employee->join_date)->format('Y-m-d') }}</td>
                                    <td>
                                        @if ($employee->position == 'Junior Web')
                                            <span class="badge bg-success w-100">Junior Web</span>
                                        @elseif ($employee->position == 'Senior Web')
                                            <span class="badge bg-danger w-100">Senior Web</span>
                                        @else
                                            <span class="badge bg-dark w-100">Designer</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($employee->gender == 'male')
                                            <span class="badge bg-primary w-100">Male</span>
                                        @else
                                            <span class="badge bg-warning w-100">Female</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No employee found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection