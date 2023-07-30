@extends('layouts.nav')
   

        @section('content')
  
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Achados e perdidos do condomínio</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/painel">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Achados e perdidos
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <!-- ============================================================== -->
          @if(session('e'))
            <div class="row">
              <div class="alert-danger p-2">
                <h4>{{session('e')}}</h4>
              </div>
            </div>
          @endif
          @if(session('s'))
          <div class="row">
            <div class="alert-success p-2">
              <h4>{{session('s')}}</h4>
            </div>
          </div>
        @endif

          <div class="row">
            <div class="col-md-12">
               <div class="card">
           
                      </div>
                      <div class="card ">
                        <form enctype="multipart/form-data" class="form-horizontal" method="POST">
                            @csrf
                          <div class="card-body">
                            <h4 class="card-title">Adicionar algo achado ou perdido</h4>
                            <div class="form-group">
                              <label for="fname" class=" text-end control-label col-form-label">Área em que achou / ou perdeu: </label>
                              <div class="">
                                <input name="title" type="text" class="form-control" id="lname">
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="lname" class=" text-end control-label col-form-label">Foto do que achou:</label>
                                <div class=" ">
                                  <input name="file"   type="file" class="form-control" id="lname">
                                </div>
                              </div> 
                              <div class="form-group">
                                <label for="lname" class=" text-end control-label col-form-label">Descrição *opcional:</label>
                                <div class=" ">
                                  <textarea class="form-control" name="description"></textarea>
                                </div>
                              </div> 
                            </div>
 
                          </div> 
                            <div class="card-body" style="margin-top:-40px">
                              <button type="submit" class="btn btn-primary">
                                Adicionar
                              </button>
                          
                          </div>
                        </form>
                      </div>
               
              </div>
          </div>

     
          </div>
          <!-- ============================================================== -->
          <!-- Sales chart -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Recent comment and chats -->
   
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
   

      @endsection