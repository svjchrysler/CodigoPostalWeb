<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Municipality;

class MunicipalityController extends Controller
{
	public function index() {
		$municipalities = Municipality::All();
		return $municipalities;	
	}
}
