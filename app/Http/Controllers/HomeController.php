<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employees::query();

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
}
