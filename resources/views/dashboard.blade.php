<x-header/>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

          
            <div class="line">

<div class="container d-flex justify-content-center">
<button class="btn btn-primary"data-toggle="modal" data-target="#exampleModal">create a new class</button>
</div>
            </div>

          
            <div class="line">

                <div class="container">
                    <table class="table">
                        @php
                    $data=DB::table('create_classes')->where('email',session('email'))->get();
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
                      
                            <td>{{$key->class_name}}</td>
                      
                            <td>{{$key->created_at}}</td>
                            <td><a href="deatils/{{$key->id}}"> <button type="button"  class="btn btn-success">deatils</button></a></td>
                            <td><button type="button" class="btn btn-danger">delete</button></td>
                            
                          </tr>


                       


                   @endforeach
                        </tbody>
                      </table>
                    </div>


            </div>

        
            <div class="line"></div>

           
        </div>
    </div>


{{-- to hide the modal --}}



....
 
  



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">class title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="createclass" method="post">
                    @csrf
                    <div class="form-group">
         
                      <input type="text" class="form-control" id="exampleInputEmail1" name="class">
                    
                    </div>
                    <div class="form-group">
                 
                      <input type="text" class="form-control" id="exampleInputPassword1" name="topic" placeholder="give  your topic">
                    </div>
                   
                    <button type="submit" class="btn btn-primary">create</button>
                  </form>
    
    
    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             
            </div>
          </div>
        </div>
      </div>
       

     

 


 <x-footer/>