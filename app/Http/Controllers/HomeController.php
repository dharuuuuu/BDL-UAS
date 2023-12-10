<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // $employees = Employees::query();
        $employees = Employees::orderBy('id', 'desc');

        // filter by name
        $employees->when($request->name, function ($query) use ($request) {
            return $query->where('name', 'like', '%'.$request->name.'%');
        });

        // filter by age
        $employees->when($request->min_age, function ($query) use ($request) {
            return $query->where('age', '>=', $request->min_age);
        });
        $employees->when($request->max_age, function ($query) use ($request) {
            return $query->where('age', '<=', $request->max_age);
        });

        // filter by salary
        $employees->when($request->min_salary, function ($query) use ($request) {
            return $query->where('salary', '>=', $request->min_salary);
        });
        $employees->when($request->max_salary, function ($query) use ($request) {
            return $query->where('salary', '<=', $request->max_salary);
        }); 

        // filter by date
        $employees->when($request->date_from, function ($query) use ($request) {
            return $query->where('join_date', '>=', $request->date_from);
        });
        $employees->when($request->date_to, function ($query) use ($request) {
            return $query->where('join_date', '<=', $request->date_to);
        });        

        // filter by gender
        $employees->when($request->gender, function ($query) use ($request) {
            return $query->whereGender($request->gender);
        });

        // filter by position
        $employees->when($request->position, function ($query) use ($request) {
            return $query->where('position', 'like', '%'.$request->position.'%');
        });

        // filter by average salary position
        $position = $request->input('avg_salary');
        if($position == "Average Junior Web"){
            $employees->when($request->avg_salary, function ($query) use ($request) {
                $averageSalaryJuniorWeb = Employees::where('position', 'Junior Web')->avg('salary');
                return $query->where('salary', '>=', $averageSalaryJuniorWeb);
            });
        }

        else if ($position == "Average Senior Web") {
            $employees->when($request->avg_salary, function ($query) use ($request) {
                $averageSalarySeniorWeb = Employees::where('position', 'Senior Web')->avg('salary');
                return $query->where('salary', '>=', $averageSalarySeniorWeb);
            });
        }

        else if ($position == "Average Designer") {
            $employees->when($request->avg_salary, function ($query) use ($request) {
                $averageSalaryDesigner = Employees::where('position', 'Designer')->avg('salary');
                return $query->where('salary', '>=', $averageSalaryDesigner);
            });
        }

        $averageSalaryJuniorWeb = number_format(Employees::where('position', 'Junior Web')->avg('salary'), 0);
        $averageSalarySeniorWeb = number_format(Employees::where('position', 'Senior Web')->avg('salary'), 0);
        $averageSalaryDesigner = number_format(Employees::where('position', 'Designer')->avg('salary'), 0);
           
        return view('welcome', ['employees' => $employees->paginate(1000), 'averageSalaryJuniorWeb' => $averageSalaryJuniorWeb, 'averageSalarySeniorWeb' => $averageSalarySeniorWeb, 'averageSalaryDesigner' => $averageSalaryDesigner]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employees = new Employees;

        $employees->name = $request->name;
        $employees->email = $request->email;
        $employees->age = $request->age;
        $employees->salary = $request->salary;
        $employees->position = $request->position;
        $employees->gender = $request->gender;
        $employees->join_date = $request->join_date;

        $employees->save();

        return redirect()->route('employees.index')->with('success', 'Employees Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employees = Employees::findOrFail($id);
        return view('show', compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employees::findOrFail($id);
        return view('edit', compact('employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employees $employees, $id)
    {
        $employees = Employees::findOrFail($id);
        $employees->name = $request->name;
        $employees->email = $request->email;
        $employees->age = $request->age;
        $employees->salary = $request->salary;
        $employees->position = $request->position;
        $employees->gender = $request->gender;
        $employees->join_date = $request->join_date;
        $employees->save();

        return redirect()->route('employees.index')->with('success', 'Employees Data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employees $employees, $id)
    {
        $employees = Employees::findOrFail($id);
        $employees->delete();

        return redirect()->route('employees.index')->with('success', 'Employees Data deleted successfully');
    }
}
