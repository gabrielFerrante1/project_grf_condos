@extends('layouts.nav')
   


        @section('content')
 

        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Novo morador</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/painel">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Novo morador
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

            @if($errors->any())
                <div class="row ">
                    <div class="p-2 mb-2 col-md-12 alert-danger">
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
                    <h4 class="card-title">Cadastrar novo morador</h4>
                    <div class="form-group">
                      <label for="fname" class=" text-end control-label col-form-label">Número Do Apartamento: </label>
                      <div class="">
                        <input value="{{old('apartamento')}}" name="apartamento" type="number" class="form-control" id="fname" placeholder="">
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="2" class=" text-end control-label col-form-label">Torre: </label>
                        <div class="">
                          <select name="building" type="number" class="form-control" id="2" >
                                @foreach($buildings as $b)
                                   <option value="{{$b->id}}">{{$b->name}}</option>
                                @endforeach
                          </select>
                        </div>
                      </div>
                    <div class="form-group">
                      <label for="lname" class=" text-end control-label col-form-label">Nome:</label>
                      <div class=" ">
                        <input value="{{old('name')}}" name="name" min="1" type="text" class="form-control" id="lname">
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="l1name" class=" text-end control-label col-form-label">Email para acesso:</label>
                        <div class=" ">
                          <input  value="{{old('email')}}" name="email" min="1" type="email" class="form-control" id="l1name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="l2name" class=" text-end control-label col-form-label">Senha para acesso:</label>
                        <div class=" ">
                          <input  name="password" min="1" type="text" class="form-control" id="l2name">
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="ljname" class=" text-end control-label col-form-label">Quantidade de carros:</label>
                      <div class=" ">
                        <input value="{{old('cars')}}"  name="cars" min="0" type="number" class="form-control" id="ljname">
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="lkname" class=" text-end control-label col-form-label">Quantidade de animais de estimação:</label>
                    <div class=" ">
                      <input value="{{old('pets')}}"  name="pets" min="0" type="number" class="form-control" id="lkname">
                    </div>
                </div>
                <div class="form-group">
                  <label for="l7name" class=" text-end control-label col-form-label">Quantidade de filhos:</label>
                  <div class=" ">
                    <input value="{{old('childrens')}}"  name="childrens" min="0" type="number" class="form-control" id="l7name">
                  </div>
              </div>
                  </div>
                
                    <div class="card-body" style="margin-top:-40px">
                      <button type="submit" class="btn btn-primary">
                        Cadastrar morador
                      </button>
                  
                  </div>
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