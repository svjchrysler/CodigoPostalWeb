<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Employee;

class EmployeeController extends Controller
{
	public function valid(Request $request) {
	  	$email = $request->input('email');
	  	$password = $request->input('password');
	    $data_employee = Employee::where('email', $email)
                          ->where('password', $password)
                          ->first();

	  	if (!empty($data_employee))
	     	return ['id'=>$data_employee->id, 'name'=>$data_employee->name, 'paternalLastName'=>$data_employee->paternalLastName, 'maternalLastName'=>$data_employee->maternalLastName];
	  	else
	     	return '0';
 	}
}
