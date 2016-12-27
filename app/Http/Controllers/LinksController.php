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
        if($_POST['type'] == 'data'){
          $params = json_decode($_POST['data']);
          if(strlen($_POST['content']) > 0){
            if(isset($params->sort)){
              $rows = DB::table('links')->where($_POST['search'], 'like', $_POST['content'].'%')->skip($params->offset)->take($params->limit)->orderBy($params->sort, $params->order)->get();
            }
            else{
              $rows = DB::table('links')->where($_POST['search'], 'like', $_POST['content'].'%')->skip($params->offset)->take($params->limit)->get();
            }
            $total = DB::table('links')->where($_POST['search'], 'like', $_POST['content'].'%')->count();
          }
          else{
            if(isset($params->sort)){
              $rows = DB::table('links')->skip($params->offset)->take($params->limit)->orderBy($params->sort, $params->order)->get();
            }
            else{
              $rows = DB::table('links')->skip($params->offset)->take($params->limit)->get();
            }
            $total = DB::table('links')->count(); 
          }
          foreach($rows as $row){
            $row->first = date('Y/m/d H:i:s', $row->first);
            $row->last = date('Y/m/d H:i:s', $row->last);
          }
          $data = array("rows" => $rows, "total" => $total);
        }
        elseif($_POST['type'] == 'detail'){
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
