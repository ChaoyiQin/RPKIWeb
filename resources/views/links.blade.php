@extends('bgp')

@section('title', 'links')

@section('links')
class = "active"
@endsection

@section('content')
  <center><h1>BGP Links Data</h1></center>
  <table id="table"
         class="table table-bordered"
         data-toggle="table" 
         data-method="post"
         data-side-pagination="server"
         data-pagination="true"
         data-page-list="[5, 10, 20, 50, 100, 200]"
         data-query-params="queryParams"
         data-content-type="application/x-www-form-urlencoded"
         data-url="/links">
    <thead>
      <tr>
        <th data-field="as1">AS1</th>
        <th data-field="as2">AS2</th>
        <th data-field="type">Type</th>
        <th data-field="monitors">Monitors</th>
        <th data-field="message">Message</th>
        <th data-field="first">First</th>
        <th data-field="last">Last</th>
        <th data-field="frequency">Frequency</th>
      </tr>
    </thead>
  </table>
  <script>
    var $table = $('#table');
    function queryParams(params){
      var temp = {
        limit: params.limit,
        offset: params.offset,
        sort: params.sort,
        order: params.order
      };
      return temp;
    }
  </script>
@endsection

