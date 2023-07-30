@extends('layouts.nav')
   


        @section('content')
 

        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Reservar área</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/painel">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Reservar área do condomínio
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
          <div class="row">

            @if(session('s'))
                <div class="row ">
                    <div class="p-3 mb-2 col-md-12 alert-success"> 
                            <h5>{{session('s')}}</h5> 
                    </div>
                </div>
            @endif

            @if(session('e'))
                <div class="row ">
                    <div class="p-4 mb-2 col-md-12 alert-danger"> 
                            <h5>{{session('e')}}</h5> 
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="row ">
                    <div class="p-3 mb-2 col-md-12 alert-danger">
                        @foreach ($errors->all() as $e)
                            <h5>{{$e}}</h5>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <div class="card ">
                <form class="form-horizontal" method="POST">
                    @csrf
                  <div class="card-body">
                    <h4 class="card-title">Reservar uma área do condomínio</h4>
                  

                    @if(count($areas) > 0)
                    <div class="form-group">
                        <label for="2" class=" text-end control-label col-form-label">Área: </label>
                        <div class="">
                          <select name="area" type="number" class="form-control" id="2" > 
                                @foreach($areas as $b)
                                   <option value="{{$b->id}}">{{$b->name}}</option>
                                @endforeach
                          </select>
                        </div>
                      </div>
                    <div class="form-group">
                      <label for="2" class=" text-end control-label col-form-label">Dia da semana:</label>
                      <div class=" ">
                        <select name="day" class="form-control" id="2" > 
                            <option value="1">Segunda</option>
                            <option value="2">Terça</option>
                            <option value="3">Quarta</option>
                            <option value="4">Quinta</option>
                            <option value="5">Sexta</option>
                            <option value="6">Sábado</option>
                            <option value="7">Domingo</option>
                      </select>
                      </div>
                    </div>
                  
                    <div class="form-group">
                        <label for="24" class=" text-end control-label col-form-label">Hora inicial:</label>
                        <div class=" ">
                           <input type="time" class="form-control" name="init-time"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="24" class=" text-end control-label col-form-label">Hora final:</label>
                        <div class=" ">
                           <input type="time" class="form-control" name="end-time"/>
                        </div>
                    </div>
              </div>
                  </div>
                
                    <div class="card-body" style="margin-top:-30px">
                      <button type="submit" class="btn btn-primary">
                        Efetuar reserva
                      </button>
                  
                    </div>

                    @else
                    <hr> 
                    <h4 class="text-center text-primary">O síndico ainda não adicionou nehuma área pública nesta torre</h4>
                    <hr>
                  @endif
                </form>
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