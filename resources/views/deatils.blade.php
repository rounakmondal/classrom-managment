<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<link rel="stylesheet" href="dashboard.css" type="text/css">
    <title>Hello, world!</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @php
            $sir=DB::table('registers')->where('email',session('email'))->first();
            @endphp
         <h1 class="text-center"> looged in :</h1>
        
        </div>
      </nav>
 

    <div class="container">
       

<div class="container d-flex justify-content-center">
    

    <div class="card">
        <div class="card-body">
        <h1 class="text-center text-success">added student</h1>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>

<div class="container-fluid">

        <table class="table">
            @php
        $data=DB::table('studentclasses')->get();
        $count=1;
@endphp
            <thead>
              <tr>
               
                <th scope="col">class</th>
                <th scope="col">topic</th>
                <th scope="col">date</th>
                <th scope="col" collapse='2'>action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($data as $key )
              <tr>
          
                <td>{{$key->name}}</td>
          
                <td>{{$key->class}}</td>
                <td>{{$key->email}}</td>
                <td><a href="deatils/{{$key->id}}"> <button type="button"  class="btn btn-success">deatils</button></a></td>
                <td><button type="button" class="btn btn-danger">delete</button></td>
              
              </tr>


           


       @endforeach
            </tbody>
          </table>
   
</div>

        </div>


      </div>
    <div class="card">
        <div class="card-body">
        <h1 class="text-center text-success">all student list</h1>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>

<div class="container-fluid">

        <table class="table">
            @php
        $dat=DB::table('registers')->where('role','student')->get();
       
@endphp
            <thead>
              <tr>
               
                <th scope="col">class</th>
                <th scope="col">topic</th>
                <th scope="col">date</th>
                <th scope="col" collapse='2'>action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($dat as $key )
              <tr>
          
                <td>{{$key->name}}</td>
          
                <td>{{$key->email}}</td>
                <td>{{$key->ph_number}}</td>
                <form method="post" action="/adclass" enctype="multipart/form-data">

                  @csrf
                  
                  <input type="hidden" name="id" value="{{$key->id}}">
                  <input type="hidden" name="class" value="{{$class['class_name']}}">

                  
               
                <td> <button type="submit"  class="btn btn-success">Add</button></td>
              </form>

                <td><button type="button" class="btn btn-danger">Delete</button></td>
                
              </tr>


           


       @endforeach
            </tbody>
          </table>
   
</div>

        </div>


      </div>
</div>



    </div>

    <div class="container d-flex justify-content-center">

      <div class="card">
        <div class="card-body">

          <form action ='/addfile' method='post' enctype="multipart/form-data">
          @csrf
          <input type="file" name="file" id="file"/>
          <input type="hidden" name="class" value="{{$class['class_name']}}">
          <button type="submit" name="submit">submit </button>
          </form> 
   
</div>

@php
$class_data=DB::table('education')->where('class',$class['class_name'])->get();
$class_exist=DB::table('education')->where('class',$class['class_name'])->exists();
if($class_exist){
 
}


@endphp
@if($class_exist)
@foreach($class_data as $pdf)
<div class="card">
  <div class="card-body">
  <h1 class="text-center text-success">{{$pdf->class}}</h1>
  <h1 class="text-center text-success">{{$pdf->education_data}}</h1>
 <form action="{{route('download')}}" enctype="multipart/form-data" method="post">
  @csrf
  <input type="hidden" name="edudata" value="{{$pdf->education_data}}">
<button type="submit" class="btn bnt-sucess">Download</button>
 </form>
</div>

  </div>



@endforeach

@else
<div class="card">
  <div class="card-body">
  <h1 class="text-center text-success">no pdf avaliable yet</h1>

</div>

  </div>

@endif
@if($class_exist)
      <div class="card">
     

        </div>
        @else

 <div class="card">
        <div class="card-body">
    
      <button type="submit" class="btn bnt-sucess" disabled>Download</button>
      </form>
      </div>

        
        
        
        @endif


        </div>


      </div>
    <div class="card">
        <div class="card-body">
          <form action ='/vupload' method='post' enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" id="file"/>
            <input type="hidden" name="class" value="{{$class['class_name']}}">
            <button type="submit" name="submit">submit </button>
            </form> 
     
   
  </div>

        </div>
        @php
        $video_data_file=DB::table('videodatas')->where('class',$class['class_name'])->get();
        $class_video_exist=DB::table('videodatas')->where('class',$class['class_name'])->exists();
        if($class_exist){
       
        } 
        @endphp
        @if($class_video_exist)
        
        
 @foreach($video_data_file as $video)
 <div class="card">
   <div class="card-body">
    <video width="400" controls>
      <source src="{{asset('education_video/'.$video->video_data)}}" type="video/mp4">

    
    </video>
   <h1 class="text-center text-success">{{$video->class}}</h1>
   <h1 class="text-center text-success">{{$video->video_data}}</h1>
  <form action="{{route('downloadv')}}" enctype="multipart/form-data" method="post">
   @csrf
   <input type="hidden" name="edudata" value="{{$video->video_data}}">
 <button type="submit" class="btn bnt-sucess">Download</button>
  </form>
 </div>
 
   </div> 
 @endforeach
@else
<div class="card">
  <div class="card-body">
    <h1>no data avaliable baby.....</h1>
  </div>
</div>

@endif
{{-- <div class="card">
  <div class="card-body">

    <video width="400" controls>
      <source src="{{asset('mov_bbb.mp4')}}" type="video/mp4">

      Your browser does not support HTML video.
    </video>
  </div>
</div> --}}


      </div>
</div>



    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2"
        crossorigin="anonymous"></script>

        <script src="dashboard.js"></script>

</body>

</html>