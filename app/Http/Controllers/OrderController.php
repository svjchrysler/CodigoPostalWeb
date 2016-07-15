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

	public function listOrders($id) {
		$orders = DB::table('ubications')
					->join('orders', 'ubications.id', '=', 'orders.ubication_id')
					->join('clients', 'orders.client_id', '=', 'clients.id')
					->join('distribution_order', 'orders.id', '=', 'distribution_order.order_id')
					->join('distributions', 'distribution_order.distribution_id', '=', 'distributions.id')
					->join('businesses', 'orders.business_id', '=', 'businesses.id')
					->join('employees', 'distribution_order.employee_id', '=', 'employees.id')
					->join('people', 'ubications.person_id', '=', 'people.id')
					->where('employees.id', '=', $id)
					->where('orders.state', '=', '0')
					->select('orders.id', 'clients.name as client', 'people.name as nameEntrega', 'ubications.streetName', 'ubications.latitude', 'ubications.length', 'ubications.nameImage',
							'distributions.shippingDate', 'businesses.name')
					->get();
		return $orders;
	}

	public function updateOrder($id) {
		$order = Order::Find($id);
		return $order;
	}
}
