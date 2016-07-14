<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ubication;
use App\Order;
use App\Client;
use App\Distribution;
use App\Employee;

use DB;

class OrderController extends Controller
{

	public function listOrders() {
		$orders = DB::table('ubications')
					->join('orders', 'ubications.id', '=', 'orders.ubication_id')
					->join('clients', 'orders.client_id', '=', 'clients.id')
					->join('distribution_order', 'orders.id', '=', 'distribution_order.order_id')
					->join('distributions', 'distribution_order.distribution_id', '=', 'distributions.id')
					->join('businesses', 'orders.business_id', '=', 'businesses.id')
					->join('employees', 'distribution_order.employee_id', '=', 'employees.id')
					->get();
		return $orders;
	}

	/*public function list($id) {
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
  	}*/
}
