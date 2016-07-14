<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Ubication;
use App\AppleTree;

use DB;

class UbicationController extends Controller
{
	public function list($id) {
    	$ubications = DB::table('ubications')
                    ->join('apple_trees', 'ubications.apple_tree_id', '=', 'apple_trees.id')
                    ->where('ubications.person_id', '=', $id)
                    ->select('ubications.*', 'apple_trees.codePostal')
                    ->get();
    	return $ubications;
  	}

  	public function getUbications() {
    	$ubications = DB::table('people')
                  ->join('naturals', 'people.id', '=', 'naturals.id')
                  ->join('ubications', 'people.id', '=', 'ubications.person_id')
                  ->join('apple_trees', 'ubications.apple_tree_id', '=', 'apple_trees.id')
                  ->select('people.id', 'people.name', 'naturals.profession', 'ubications.latitude', 'ubications.length', 'apple_trees.codePostal', 'ubications.streetName', 'ubications.nameImage')
                  ->get();
    	return $ubications;
  	}


	public function store(Request $request) {
		
		$resultingApple = $this->calculateDistance($request);

    	$ubication = new Ubication();
    	$ubication->person_id = $request->input('person_id');
    	$ubication->municipality_id = $request->input('municipality_id');
    	$ubication->apple_tree_id = $resultingApple->id;
    	$ubication->streetName = $request->input('streetName');
    	$ubication->length = $request->input('length');
    	$ubication->latitude = $request->input('latitude');
    	$ubication->nameImage = $request->input('nameImage');
    	$ubication->state = $request->input('state');
    	$ubication->save();

      	return $resultingApple;
   	}

   	public function calculateDistance($request) {

       	$differencePoint = 0;
       	$count = 0;
       	$appleTrees = AppleTree::All();

       	foreach ($appleTrees as $appleTree) {
       		$distance = $this->distanceBetweenTwoPoints($request, $appleTree);
           	if($count == 0){
               	$differencePoint = $distance;
               	$resultingApple = $appleTree;
               	$count++;
           	} else {
               	if((double)$differencePoint < (double)$distance) {
                   	$differencePoint = $distance;
                   	$resultingApple = $appleTree;
               	}
           	}
       	}

       	return $resultingApple;	
   	}

   	public function distanceBetweenTwoPoints($request, $appleTree) {

   		$latitude = $request->input('latitude');
   		$length = $request->input('length');
     	$resultLatitude = (double)$latitude - (double)$appleTree->latitude; 
     	$resultLength = (double)$length - (double)$appleTree->length;
     	$resultLatitude = pow((double)$resultLatitude, 2);
     	$resultLength = pow((double)$resultLength, 2);
     	$result = (double)$resultLatitude + (double)$resultLength;
     	$result = sqrt((double)$result);
   		return $result;
   	}
}
