<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
	{
		$products = DB::table('product')->where('active', true)->orderBy('name')->get();
		$message = null;
		
		if (request()->input('success'))
		{
			$message = ['text' => request()->input('success'), 'type' => 'success'];
		}
		
		return view('index', ['products' => $this->getProducts(), 'message' => $message]);
	}
	
	public function user()
	{
		return view('user');
	}
	
	public function userSave()
	{
		$name = request()->input('name');
		
		DB::statement("INSERT INTO member(id, name) VALUES(nextval('seq_member'), '$name')");
		
		$userId = DB::select('SELECT last_value FROM seq_member');
		
		return view('index', ['products' => $this->getProducts(), 'userId' => $userId[0]->last_value]);
	}
	
	public function save()
	{
		$productId = request()->input('product_id');
		$memberId = request()->input('product_id');
		$qty = request()->input('qty');
		$valueUnit = DB::table('product')->where('id', $productId)->first()->value;
		
		DB::statement("INSERT INTO product_sales(id, product_id, member_id, datetime, quantity, value_unit, paid) VALUES(nextval('seq_product_sales'), $productId, $memberId, now(), $qty, $valueUnit, false)");
		
		return redirect('/?success=Registro feito com sucesso');
	}
	
	public function mine()
	{
		$memberId = request()->input('id');
		$message = null;
		
		$data = DB::select("SELECT ps.*, p.name FROM product_sales ps INNER JOIN product p ON p.id = ps.product_id WHERE ps.member_id = $memberId ORDER BY ps.datetime DESC");
		
		if (request()->input('success'))
		{
			$message = ['text' => request()->input('success'), 'type' => 'success'];
		}
		
		return view('mine', ['data' => $data, 'userId' => $memberId, 'message' => $message]);
	}
	
	public function pay()
	{
		$sales = request()->input('sales');
		$userId = request()->input('userId');
		
		if (isset($sales) && count($sales) > 0)
		{
			$in = implode(', ', $sales);
			
			DB::statement("UPDATE product_sales SET paid = true, pay_date = now() WHERE id IN($in)");
		}
		
		return redirect("/mine?id=$userId&success=Pinduretas pagas com sucesso");
	}
	
	private function getProducts()
	{
		return DB::table('product')->where('active', true)->orderBy('name')->get();
	}
}
