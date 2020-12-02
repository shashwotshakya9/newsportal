@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News Website</title>
</head>
<body>
    
    <div class="container">       
        <h2><b>In Today's News</b></h2>
    </div>
    <div class="container">       
        <h2><b>Categories:</b></h2>
        <table class="table table-borderless">
            <tr>
        @foreach ($categories as $category)
        
          @if ($category->publish==1)
           
               <td style="width: 16.66%">               
                <div class="justify-content-center" >
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner text-center">                    
                    <h3>{{ $category->name }}</h3>                    
                    </div>                
                    <a href="#" class="small-box-footer">View Category <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </div>
                </td>
            
            
                <!-- ./col -->            
            @else
            @endif
        
            @endforeach
        </tr>
        </table>
    </div>
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          @foreach ($posts as $post)
          @if ($post->publish==1)
            <div class="row">
                <div class="container">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">                    
                    <h3>{{ $post->name }}</h3>  
                    <div class="small-box ">
                    <h5>Categories:</h5>  
                    @foreach($post->categories as $category)
                    {{ $category->name }}
                    @endforeach    
                    </div>                          
                    <div class="container"><img src="{{ url('uploads/'.$post->image) }}" alt="image" width="500px;" height="400px;" alt="image" /> </div>
                    <div id="data-container">{!! $post->detail !!}</p></div>
                    </div>     
                    @if($post->author->publish==1)           
                    <a href="#" class="small-box-footer">Author:  {{$post->author->name}}</a>
                    @endif
                </div>
                </div>
                <!-- ./col -->            
            @else
            @endif
        </div>
            @endforeach
            
        </div>
    </section>
    {{-- {!! $posts->links() !!}
    {!! $categories->links() !!} --}}
    <!-- javascript -->
    <div id="data-container" class="data-container"></div>
    
    <script type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('plugin/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript" src="{{url('plugin/tinymce/init-tinymce.js')}}"></script>
    <script type="text/javascript" src="{{url('js/getdata.js')}}"></script>
    <script>
    $(document).ready(function(){

        $("#create_post").submit(function(e){
    
            var content = tinymce.get("detail").getContent();
    
            $("#data-container").html(content);
    
            return false;
    
        });
    
    });
</script>
    
</body>
</html>
@endsection