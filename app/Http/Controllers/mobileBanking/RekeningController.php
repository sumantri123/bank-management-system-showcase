<?php

namespace App\Http\Controllers\mobileBanking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class RekeningController extends Controller
{

    // use AuthenticatesUsers;
    protected $redirectTo = '/';

	public function __construct()
    {		
        //$this->middleware('guest', ['except' => ['logout', 'login_as']]);		
		$this->view = 'mobile/rekening/';
		
    }
	
	public function index()
    {				

        $data = array(            
			'header_title' => 'Buka Rekening',						
        );       
		
		return view($this->view.'index', compact('data'));
    }
		
}
