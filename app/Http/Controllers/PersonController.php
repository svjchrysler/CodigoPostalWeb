<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Person;
use App\Natural;
use App\Legal;

use DB;

class PersonController extends Controller
{
	public function valid(Request $request) {
	  	$email = $request->input('email');
	  	$password = $request->input('password');
	    $data_person = Person::where('email', $email)
                          ->where('password', sha1($password))
                          ->first();

	  	if (!empty($data_person))
	     	return ['id'=>$data_person->id, 'name'=>$data_person->name];
	  	else
	     	return '0';
 	}

  	public function searchContact($nombre, $id) {
    	$people = DB::table('people')
                  ->join('naturals', 'people.id', '=', 'naturals.id')
                  ->join('ubications', 'people.id', '=', 'ubications.person_id')
                  ->join('apple_trees', 'ubications.apple_tree_id', '=', 'apple_trees.id')
                  ->where('people.name', 'like', '%'.$nombre.'%')
                  ->where('people.id', '<>', $id)
                  ->select('people.id', 'people.name', 'naturals.profession', 'apple_trees.codePostal', 'ubications.streetName', 'ubications.nameImage')
                  ->get();
    	return $people;
  	}

 	public function store(Request $request){

 		$person = $this->registerPerson($request);
	    if ($request->input('tipo') == "1") {
	   	  $this->registerNatural($person, $request);   
	    } else {
	      $this->registerLegal($person, $request);
	  	}
	    return $person->id;
 	}

 	public function registerPerson($request) {
 		$person = new Person();
	  	$person->social_id = $request->input('social_id');
	  	$person->name = $request->input('name');
	  	$person->email = $request->input('email');
	  	$person->password = sha1($request->input('password'));
	  	$person->provider = $request->input('provider');
	  	$person->save();
	  	return $person;
 	}

 	public function registerNatural($person, $request) {
	    $natural = new Natural();
	    $natural->id = $person->id;
	    $natural->profession = $request->input('profession');
	    $natural->save();
 	}

 	protected function registerLegal($person, $request) {
	    $legal = new Legal();
	    $legal->id = $person->id;
	    $legal->representative = $request->input('representative');
	    $legal->category = $request->input('category');
	    $legal->description = $request->input('description');
	    $legal->save();
 	}
}
