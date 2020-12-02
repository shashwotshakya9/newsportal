<!DOCTYPE html>
<html>
<head>
    <title>AJAX</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>

<div class="container">
<br><br>
    <h1><b>AJAX</b></h1>
    <br><br>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewData"> Add New Data</a>
    <br><br>
    <table class="table table-bordered data-table">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th width="300px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="dataForm" name="dataForm" class="form-horizontal">
                   <input type="hidden" name="data_id" id="data_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Publish</label>
                        <div class="col-sm-12">
                            <textarea id="publish" name="publish" required="" placeholder="Enter publish data" class="form-control"></textarea>
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  
<script type="text/javascript">
  $(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ajaxpages.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'publish', name: 'publish'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewData').click(function () {
        $('#saveBtn').val("create-data");
        $('#data_id').val('');
        $('#dataForm').trigger("reset");
        $('#modelHeading').html("Create New Data");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editData', function () {
      var data_id = $(this).data('id');
      $.get("{{ route('ajaxpages.index') }}" +'/' + data_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Data");
          $('#saveBtn').val("edit-data");
          $('#ajaxModel').modal('show');
          $('#data_id').val(data.id);
          $('#name').val(data.name);
          $('#publish').val(data.publish);
      })
   });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save');
    
        $.ajax({
          data: $('#dataForm').serialize(),
          url: "{{ route('ajaxpages.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#dataForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    
    $('body').on('click', '.deleteData', function () {
     
        var data_id = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "{{ route('ajaxpages.store') }}"+'/'+data_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
     
  });
</script>
</body>
</html>