@extends('bgp')

@section('title', 'links')

@section('links')
class = "active"
@endsection

@section('content')
  <div class="col-md-12">
  <center><h1>BGP Links Data</h1></center>
  <table id="myTable"
         data-toggle="table" 
         data-method="post"
         data-side-pagination="server"
         data-pagination="true"
         data-page-list="[5, 10, 20, 50, 100, 200]"
         data-ajax="ajaxRequest"
         data-detail-view="true"
         data-detail-formatter="detailFormatter"
         data-url="/links">
    <thead>
      <tr>
        <th data-field="as1" data-formatter="identifierFormatter">AS1</th>
        <th data-field="as2" data-formatter="identifierFormatter">AS2</th>
        <th data-field="type" data-sortable="ture">Type</th>
        <th data-field="monitors" data-sortable="ture">Monitors</th>
        <th data-field="message" data-sortable="ture" data-formatter="identifierFormatter">Message</th>
        <th data-field="first" data-sortable="ture">First</th>
        <th data-field="last" data-sortable="ture">Last</th>
        <th data-field="frequency" data-sortable="ture">Frequency</th>
      </tr>
    </thead>
  </table>
  <script>
    var $table = $('#myTable');
    $table.on('click-cell.bs.table', clickCell);
    var column = '';
    $.ajaxSetup({
      url: "/links",
      type: "POST",
      headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    });
    /*
    function queryParams(params){
      var temp = {
        limit: params.limit,
        offset: params.offset,
        sort: params.sort,
        order: params.order
      };
      return temp;
    }*/
    function ajaxRequest(params){
      $.ajax({
        data: {data:params.data},
        success: function(data, status){
          params.success(data);
        }
      })
    }
    function identifierFormatter(value, row, index) {
      return [
        '<a class="like" href="javascript:void(0)" title="Like">',
        value,
        '</a>'].join('');
    }
    function clickCell(e, field, value, row, $element){
      $table.bootstrapTable('collapseAllRows');
      if(field == 'as1'){
        var index = $element.parent().data('index');
        column = field; 
        $table.bootstrapTable('expandRow', index );
      }
      if(field == 'as2'){
        var index = $element.parent().data('index');
        column = field; 
        $table.bootstrapTable('expandRow', index );
      }
      if(field == 'message'){
        var index = $element.parent().data('index');
        column = field; 
        $table.bootstrapTable('expandRow', index );
      }
    }
    function detailFormatter(index, row) {
      var html = [];
      $.ajax({
        async: false,
        data:{field:column, value:row[column]},
        success:function(data){
          $.each(data.result, function(key, value){
            html.push('<p style="word-wrap:break-word; word-break:break-all; width:auto;"><b>' + key + ':</b> ' + value + '</p>');
          });
        }
      });
      return html.join('');
    }
  </script>
  </div>
@endsection

