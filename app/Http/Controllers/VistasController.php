<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class VistasController extends Controller {

	public function index(){
		
		return view('index');
	}

	public function gestion(){
		
		return view('gestion');
	}

}
