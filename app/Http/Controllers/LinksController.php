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
        $params = $_POST;
        $total = DB::table('links')->count(); 
        $rows = DB::table('links')->skip($params['offset'])->take($params['limit'])->get();
        $data = array("rows" => $rows, "total" => $total);
        return json_encode($data);
    }
}
