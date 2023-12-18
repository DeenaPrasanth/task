<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Employee;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
class EmployeeController extends BaseController
{


    public function index(){
        // $emp = Employee::get();

        // return response();

        return view('list');
    }

    public function list(){
        $emp = Employee::get();

        return response()->json(['projects' => $emp]);
    }

    public function save(Request $request) {
       
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'department' => 'required',
            // 'profile' => 'required',

        ]);
        
        $filename = '';
        if($request->hasfile('profile')){

                $file = $request->file('profile');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $file->move('uploads/employee/'. $filename);
         }
        $emp =Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'dob' => $request->dob,
            'department' => $request->department,
            'profile' => $filename
        ]);
    }

    public function update() {
        
    }
}
