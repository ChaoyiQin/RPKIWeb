@extends('bgp')

@section('title', 'home')

@section('links')
class = "active"
@endsection

@section('content')
  <h1>BGP Links Data</h1>
  <table id="table"
         data-toggle="table" 
         data-method="post"
         data-side-pagination="server"
         data-pagination="true"
         data-page-list="[5, 10, 20, 50, 100, 200]"
         data-content-type="application/x-www-form-urlencoded"
         data-url="/links">
    <thead>
      <th data-field="as1">AS1</th>
      <th data-field="as2">AS2</th>
      <th data-field="type">Type</th>
      <th data-field="monitors">Monitors</th>
      <th data-field="message">Message</th>
      <th data-field="first">First</th>
      <th data-field="last">Last</th>
      <th data-field="frequency">Frequency</th>
    </thead>
  </table>
  <script>
    var $table = $('#table');
  </script>
@endsection

