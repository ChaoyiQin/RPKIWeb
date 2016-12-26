<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MonitorsController extends Controller
{
    //
    public function index(){
        return view('monitors');
    }

    public function store()
    {
        if(isset($_POST['data'])){
          $params = json_decode($_POST['data']);
          if(isset($params->sort)){
            $rows = DB::table('monitors')->skip($params->offset)->take($params->limit)->orderBy($params->sort, $params->order)->get();
          }
          else{
            $rows = DB::table('monitors')->skip($params->offset)->take($params->limit)->get();
          }
          $total = DB::table('monitors')->count(); 
          foreach($rows as $row){
            $row->first = date('Y/m/d H:i:s', $row->first);
            $row->last = date('Y/m/d H:i:s', $row->last);
          }
          $data = array("rows" => $rows, "total" => $total);
        }
        else{
          $field = $_POST['field'];
          $value = $_POST['value'];
          if ($field == 'message'){
            $row = DB::table('messages')->where('id', $value)->first();
            $row->first = date('Y/m/d H:i:s', $row->first);
            $row->last = date('Y/m/d H:i:s', $row->last);
            $data = array("result" => $row);
          }
          else{
            $row = DB::table('asset')->where('id', substr($value, 1))->first();
            $data = array("result" => $row);
          }
        }
        return $data;
    }

}
