<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LinksController extends Controller
{
    //
    public function index()
    {
        return view('links');
    }

    public function store()
    {
        $test = DB::table('links')->count(); 
        $params = $_POST['limit'];
        return $params;
    }
}
