@extends('layouts.nav')
   

        @section('content')
  
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Editar Áreas públicas do condomínio</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/areas">Áreas publicas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Editar áreas 
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
                            <h4 class="card-title">Editar área do condomínio</h4>
                            <div class="form-group">
                              <label for="fname" class=" text-end control-label col-form-label">Torre: </label>
                              <div class="">
                                <select name="building"   class="form-control" id="fname" >
                                    @foreach ($buildings as $item)
                                        <option <?php if($info->id_building == $item->id) { echo 'selected'; } ?> value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="lname" class=" text-end control-label col-form-label">Nome da área:</label>
                                <div class=" ">
                                  <input value="{{$info->name}}" name="name" min="1" type="text" class="form-control" id="lname">
                                </div>
                              </div>
                            <div class="form-group">
                              <label for="lname" class=" text-end control-label col-form-label">Dias disponíveis:</label>

                                <?php 
                                    $array = explode(',', $info->dates_disponibles);  
                                ?>
                            <div class="form-check">
                                <input <?php if(in_array(1, $array)) { echo 'checked'; }?>  value="1" type="checkbox" class="form-check-input" id="customControlValidation1" name="1">
                                <label  class="form-check-label mb-0" for="customControlValidation1">Segunda</label>
                            </div>
                            <div class="form-check">
                                <input <?php if(in_array(2, $array)) { echo 'checked'; }?> value="2" type="checkbox" class="form-check-input" id="customControlValidation41" name="2">
                                <label class="form-check-label mb-0" for="customControlValidation41">Terça</label>
                            </div>
                            <div class="form-check">
                                <input <?php if(in_array(3, $array)) { echo 'checked'; }?> value="3" type="checkbox" class="form-check-input" id="customControlValidation21" name="3">
                                <label class="form-check-label mb-0" for="customControlValidation21">Quarta</label>
                            </div> 
                            <div class="form-check">
                                <input <?php if(in_array(4, $array)) { echo 'checked'; }?> value="4" type="checkbox" class="form-check-input" id="customControlValidation51" name="4">
                                <label class="form-check-label mb-0" for="customControlValidation51">Quinta</label>
                            </div> 
                            <div class="form-check">
                                <input <?php if(in_array(5, $array)) { echo 'checked'; }?> value="5" type="checkbox" class="form-check-input" id="customControlValidation71" name="5">
                                <label class="form-check-label mb-0" for="customControlValidation71">Sexta</label>
                            </div> 
                            <div class="form-check">
                                <input <?php if(in_array(6, $array)) { echo 'checked'; }?> value="6" type="checkbox" class="form-check-input" id="customControlValidation721" name="6">
                                <label class="form-check-label mb-0" for="customControlValidation721">Sábado</label>
                            </div> 
                            <div class="form-check">
                                <input <?php if(in_array(7, $array)) { echo 'checked'; }?> value="7" type="checkbox" class="form-check-input" id="customControlValidation7321" name="7">
                                <label class="form-check-label mb-0" for="customControlValidation7321">Domingo</label>
                            </div> 
                            </div>


                            <div class="form-group">
                                <label for="f2name" class=" text-end control-label col-form-label">Horários disponíveis: </label>
                                <div class="">
                                  <select id="x" name="time_disponible" class="form-control" id="f2name" > 
                                          <option <?php if($info->all_time == 1) { echo 'selected'; }?> value="1">24 horas</option> 
                                          <option <?php if($info->all_time == 0) { echo 'selected'; }?>  value="2">Personalizar</option> 
                                  </select>
                                </div>
                              </div>

                              <div id="f" class="form-group">
                                <label for="f5name" class=" text-end control-label col-form-label">Horário inicial: </label>
                                <input value="<?php if($info->all_time == 0) { echo $info->init_time; }?>" name="init-h" type="time" class="form-control" />

                                <label for="f5name" class=" text-end control-label col-form-label">Horário final: </label>
                                <input value="<?php if($info->all_time == 0) { echo $info->end_time; }?>" name="end-h" type="time" class="form-control" />
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

            @if(session('success'))
                <div class="row ">
                    <div class="p-3 mb-2 col-md-12 alert-success"> 
                            <h5>{{session('success')}}</h5> 
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
            

            <script>
                $('#f').hide();
            </script>
          
            <?php if($info->all_time == 0)  { ?> 
                
                <script>
                    $('#f').show();
                </script>
                
            <?php } ?>

            <script>
                $('#x').on('change', function() {
                    $("#f").fadeToggle();
                });
            </script>
      
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