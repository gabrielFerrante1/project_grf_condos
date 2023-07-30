@extends('layouts.nav')
   

        @section('content')
  
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Áreas públicas do condomínio</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/painel">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Áreas publicas
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
                        <form class="form-horizontal" method="POST">
                            @csrf
                          <div class="card-body">
                            <h4 class="card-title">Cadastrar nova área do condomínio</h4>
                            <div class="form-group">
                              <label for="fname" class=" text-end control-label col-form-label">Torre: </label>
                              <div class="">
                                <select name="building"   class="form-control" id="fname" >
                                    @foreach ($buildings as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="lname" class=" text-end control-label col-form-label">Nome da área:</label>
                                <div class=" ">
                                  <input name="name" min="1" type="text" class="form-control" id="lname">
                                </div>
                              </div>
                            <div class="form-group">
                              <label for="lname" class=" text-end control-label col-form-label">Dias disponíveis:</label>
                                  
                            <div class="form-check">
                                <input value="1" type="checkbox" class="form-check-input" id="customControlValidation1" name="1">
                                <label  class="form-check-label mb-0" for="customControlValidation1">Segunda</label>
                            </div>
                            <div class="form-check">
                                <input value="2" type="checkbox" class="form-check-input" id="customControlValidation41" name="2">
                                <label class="form-check-label mb-0" for="customControlValidation41">Terça</label>
                            </div>
                            <div class="form-check">
                                <input value="3" type="checkbox" class="form-check-input" id="customControlValidation21" name="3">
                                <label class="form-check-label mb-0" for="customControlValidation21">Quarta</label>
                            </div> 
                            <div class="form-check">
                                <input value="4" type="checkbox" class="form-check-input" id="customControlValidation51" name="4">
                                <label class="form-check-label mb-0" for="customControlValidation51">Quinta</label>
                            </div> 
                            <div class="form-check">
                                <input value="5" type="checkbox" class="form-check-input" id="customControlValidation71" name="5">
                                <label class="form-check-label mb-0" for="customControlValidation71">Sexta</label>
                            </div> 
                            <div class="form-check">
                                <input value="6" type="checkbox" class="form-check-input" id="customControlValidation721" name="6">
                                <label class="form-check-label mb-0" for="customControlValidation721">Sábado</label>
                            </div> 
                            <div class="form-check">
                                <input value="7" type="checkbox" class="form-check-input" id="customControlValidation7321" name="7">
                                <label class="form-check-label mb-0" for="customControlValidation7321">Domingo</label>
                            </div> 
                            </div>


                            <div class="form-group">
                                <label for="f2name" class=" text-end control-label col-form-label">Horários disponíveis: </label>
                                <div class="">
                                  <select id="x" name="time_disponible" class="form-control" id="f2name" > 
                                          <option value="1">24 horas</option> 
                                          <option value="2">Personalizar</option> 
                                  </select>
                                </div>
                              </div>

                              <div id="f" class="form-group">
                                <label for="f5name" class=" text-end control-label col-form-label">Horário inicial: </label>
                                <input name="init-h" type="time" class="form-control" />

                                <label for="f5name" class=" text-end control-label col-form-label">Horário final: </label>
                                <input  name="end-h" type="time" class="form-control" />
                              </div>
                          </div>
                        
                            <div class="card-body" style="margin-top:-40px">
                              <button type="submit" class="btn btn-primary">
                                Cadastrar
                              </button>
                          
                          </div>
                        </form>
                      </div>
               
              </div>
          </div>

          
        <div class="row">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-0">Áreas do condomínio</h5>
                </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Torre</th>
                      <th scope="col">Dias disponíveis</th>
                      <th scope="col">Horário de abertura</th>
                      <th scope="col">Horário de fechamento</th>
                      <th scope="col">Ações</th>

                    </tr>
                  </thead>
                  <tbody>
                      @foreach($areas as $a)
                        <tr>  
                                <td  >{{$a->name}}</td>
                                <td  >{{$a->tower}}</td>
                   
                                <td>{{$a->dates_disponibles}}</td>

                                <td><?php if($a->all_time == 0){echo $a->init_time;} else { echo '<span style="color:green">24 horas</span>';}?></td>
                                <td><?php if($a->all_time == 0){echo $a->end_time;} else { echo '<span style="color:green">24 horas</span>';}?></td>


                                <td>

                                  <?php $a->status == 1 ? $text = 'Reativar área' : $text = 'Inativar área' ?>

                                   <button type="button" onclick="window.location.href = '/done/area/{{$a->id}}'" class="ed btn btn-sm btn-primary" style="margin-right: 15px">{{$text}}</button>
                                     
                                    <button type="button" onclick="window.location.href = '/edit/area/{{$a->id}}'" class="ed btn btn-sm btn-warning" style="margin-right: 15px">Editar</button>

                                    <button onclick="if(window.confirm('Deseja excluir está área pública')){window.location.href = '/del/area/{{$a->id}}'}" type="button" class="btn btn-sm btn-danger">Remover</button>
                                </td>
                       
                        </tr>
                      @endforeach
                  </tbody>
                </table>
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
  
      <script> 
            
            $(function() {
                $('#f').hide();

                $('#x').on('change', function() {
                    $('#f').slideToggle();
                });
            }); 
      </script>

      @endsection