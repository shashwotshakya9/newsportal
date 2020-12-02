@extends('layouts.app')


@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>

    <title></title>
</head>
<body>
    <div class="container">
        <br><br>
            <h1><b>Static Page</b></h1>
            <br><br>
            <a class="btn btn-success" href="javascript:void(0)" data-toggle="modal" data-target="#addPageModal"> Add New</a>
            <br><br>
            <table class="table table-bordered data-table" id="pageTable">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Publish</th>
                        <th width="300px">Action</th>
                    </tr>
                </thead>
                <tbody id="bodyData">
                    {{-- @foreach($pages as $page)
                    <tr>
                    <td>{{$page->id}}</td>
                    <td>{{$page->name}}</td>
                    <td>{{$page->publish}}</td>  
                    <td><a href="javascript:void(0)" data-id="{{ $page->id }}" onclick="editData({{$page->id}})" class="btn btn-info editbtn">Edit</a></td>
                    <td><a href="#" data-id="{{ $page->id }}" class="btn btn-danger deletebtn" onclick="deletePage(event.target)">Delete</a></td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>

        {{-- <div class="row">
          <div class="col-lg-12 margin-tb">
              <div class="pull-left">
                  <h2>Add New User</h2>
              </div>
              <div class="pull-right">
                  <a class="btn btn-primary" href="{{ route('userData.index') }}"> Back</a>
              </div>
          </div>
      </div>
         
      @if ($errors->any())
          <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      
      <div class="form-group">
              <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
          <label for="email">Name:</label>
          <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
        </div>
        <div class="form-group">
          <label for="email">Publish:</label>
          {!! Form::checkbox('publish', '0', array('class' => 'form-control')) !!}
        </div>
        
        <button type="submit" class="btn btn-primary" id="butsave">Submit</button>
      </div> --}}


          <!-- Add Modal -->
          <div class="modal fade" id="addPageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="dataModalLabel">Add New Data</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                 <form id="addForm">
                     @csrf
                     <input type="hidden" class="form-control" name="id" id="id"/>
                     <div class="form-group">
                         <label> Name </label>
                         <input type="text" class="form-control" name="name" id="name"/>
                     </div>
                     <div class="form-group">
                        <label> Publish </label>
                        {!! Form::checkbox('publish', '1', array('class' => 'form-control')) !!}
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                 </form>
                </div>
                
              </div>
            </div>
          </div>


          
          <!-- Edit Modal -->
          <div class="modal" id="editPageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="dataModalLabel">Edit Data</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                 <form id="editForm">
                     {{csrf_field()}}
                     {{method_field('PUT')}}
                     <input type="hidden" class="form-control" name="id2" id="id2"/>
                     <div class="form-group">
                         <label> Name </label>
                         <input type="text" class="form-control" name="name2" id="name2"/>
                     </div>
                     <div class="form-group">
                        <label> Publish </label>
                        {!! Form::checkbox('publish2', '0', array('class' => 'form-control')) !!}
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                 </form>
                </div>
                
              </div>
            </div>
          </div>
          <!-- End of Edit Modal -->
          
          
{{-- 
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  
  <script src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script> --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        $("#addForm").on('submit', function(e){
            e.preventDefault();
                       
            $.ajax({
                url:"{{route('add.page')}}",
                type:"POST",
                data: $('#addForm').serialize(),            
                success:function(response){
                    console.log(response)
                    $('#addPageModal').modal('hide')
                    $("#addForm")[0].reset();
                    // alert("Data Saved");
                    $('.modal-backdrop').remove()
                    // location.reload();
                },
                error: function(error){
                    console.log(error)
                    alert("Data not saved");
                    $('.modal-backdrop').remove()
                    // 
                },     
            });
        });
    });
</script>
<script>
  $(document).ready(function() {
        var url = "{{URL('pages')}}";
        $.ajax({
            url: "/pages/getData",
            type: "POST",
            data:{ 
                _token:'{{ csrf_token() }}'
            },
            cache: false,
            dataType: 'json',
            success: function(dataResult){
                console.log(dataResult);
                var resultData = dataResult.data;
                var bodyData = '';
                var i=1;
                $.each(resultData,function(index,row){
                    var editUrl = url+'/'+row.id+"/edit";
                    bodyData+="<tr>"
                    bodyData+="<td>"+ i++ +"</td><td>"+row.name+"</td><td>"+row.publish+"</td><td><a class='btn btn-primary' href='"+editUrl+"'>Edit</a>" 
                    +"<button class='btn btn-danger delete' value='"+row.id+"' style='margin-left:20px;'>Delete</button></td>";
                    bodyData+="</tr>";
                    
                })
                $("#bodyData").append(bodyData);
            }
        });

        $(document).on("click", ".delete", function() { 
        var $ele = $(this).parent().parent();
        var id= $(this).val();
        var url = "{{URL('pages')}}";
        var dltUrl = url+"/"+id;
        $.ajax({
          url: dltUrl,
          type: "DELETE",
          cache: false,
          data:{
            _token:'{{ csrf_token() }}'
          },
          success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){
              $ele.fadeOut().remove();
            }
          }
        });
      });


  //   $(document).on("click", ".delete", function() { 
  //       var $ele = $(this).parent().parent();
  //       var id= $(this).val();
  //       var url = "{{URL('userData')}}";
  //       var dltUrl = url+"/"+id;
	// 	$.ajax({
	// 		url: dltUrl,
	// 		type: "DELETE",
	// 		cache: false,
	// 		data:{
	// 			_token:'{{ csrf_token() }}'
	// 		},
	// 		success: function(dataResult){
	// 			var dataResult = JSON.parse(dataResult);
	// 			if(dataResult.statusCode==200){
	// 				$ele.fadeOut().remove();
	// 			}
	// 		}
	// 	});
	// });
        
});
// // $(document).ready(function(){

// //         $('.editbtn').on('click', function(){
// //           $('#editPageModal').modal('show');

// //           $tr=$(this).closest('tr');

// //           var data=$tr.children("td").map(function(){
// //             return $(this).text();
// //           }).get();

// //           console.log(data);

// //           $('#id2').val(data[0]);
// //           $('#name2').val(data[1]);
// //           $('#publish2').val(data[2]);
                        

// //         });
// // });

// function editData(id)
// {
//   $.get('editpage/'+id,function(page){
//     $("#id2").val(page.id);
//     $("#name2").val(page.name);
//     $("#publish2").val(page.publish);
//     $("#editPageModal").modal('toggle');
//   })
// }

// $("#editPageModal").submit(function(e){
//       e.preventDefault();
//       $.ajax({
//                 url:"{{route('update.page')}}",
//                 type:"PUT",
//                 data: $('#editForm').serialize(),            
//                 success:function(response){
//                     console.log(response)
//                     $('#editPageModal').modal('hide')
//                     $("#editForm")[0].reset();
//                     alert("Data Saved");
//                     // location.reload();
//                 },
//                 error: function(error){
//                     console.log(error)
//                     alert("Data not saved");
//                     // $('.modal-backdrop').remove()
//                 },     
//             });
// })
// </script>

{{-- <script>
  $(document).ready(function() {
     
      $('#submit').on('click', function() {
        var name = $('#name').val();
        var publish = $('#publish').val();        
        
            $.ajax({
                url: "/pages",
                type: "POST",
                data: {
                    _token: $("#csrf").val(),
                    type: 1,
                    name: name,
                    publish: publish,                    
                },
                cache: false,
                success: function(dataResult){
                    console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                      window.location = "/pages";				
                    }
                    else if(dataResult.statusCode==201){
                       alert("Error occured !");
                    }
                    
                }
            });
        }
        else{
            alert('Please fill all the field !');
        }
    });
  });
  </script> --}}


</body>
</html>
@endsection

