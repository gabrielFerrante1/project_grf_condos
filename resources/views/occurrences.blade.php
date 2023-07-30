@extends('layouts.nav')
   

        @section('content')
  
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Nova ocorrência</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/painel">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Nova ocorrência do condomínio 
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
                        <form   class="form-horizontal" method="POST">
                            @csrf
                          <div class="card-body">
                            <h4 class="card-title">Adicionar nova ocorrência</h4>
                            <div class="form-group">
                              <label for="fname" class=" text-end control-label col-form-label">Enviar para: </label>
                              <div class="">
                                <select id="u" name="user"   class="form-control" id="fname" >
                                  <option value="all">Enviar para todos os moradores</option>
                                    @foreach ($users as $item)
                                        <option value="{{$item->id}}">Apenas para o morador: {{$item->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="lname" class=" text-end control-label col-form-label">Titulo da ocorrência:</label>
                                <div  >
                                  <input name="title"  type="text" class="form-control" id="lname">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="3lname" class=" text-end control-label col-form-label">Descrição da ocorrência:</label>
                                <div>
                                  <textarea name="description" class="form-control" id="3lname"></textarea>
                                </div>
                              </div> 

                              <div id="v" class="form-group"> 
                                <div>
                                  <input type="checkbox" name="check"  id="53lname"> 
                                  <label for="53lname" class=" text-end control-label col-form-label">Enviar com cópia para email do morador</label>
                                </div>
                              </div>
                          </div>
                        
                            <div class="card-body" style="margin-top:-30px">
                              <button type="submit" class="btn btn-primary">
                                Publicar ocorrência
                              </button>
                          
                          </div>
                        </form>
                      </div>
               
              </div>
          </div>

          
        <div class="row">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-0">Ocorrências  do condomínio</h5>
                </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Titulo</th>
                      <th scope="col">Para onde foi enviado</th>
                      <th scope="col">Data do envio</th>  
                      <th scope="col">Excluir</th>  
                    </tr>
                  </thead>
                  <tbody> 
                      @foreach ($occurrences as $item)
                        <tr>
                          <td>{{$item->title}}</td>  
                          <td><?php if($item->all_residents == 1){echo 'Enviado para todos os usuários';} else {echo 'Enviado para morador: '.$item->name; } ?></td>  
                          <td>{{$item->date}}</td>  
                          <td><button class="btn btn-sm btn-danger" onclick="if(window.confirm('Deseja deletar está ocorrencia?')){window.location.href = '/del/occurence/{{$item->id}}'}">Excluir</button></td>  
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
              $('#v').hide();

                $('#u').on('change', function(e) { 
                    if(e.target.value != 'all') {
                      $('#v').fadeIn();
                    } else if(e.target.value == 'all') {
                      $('#v').fadeOut();
                    }
                   
                });
            }); 
      </script>


      <script>  
        function edit(id, txt) {
            var form = document.createElement('form');
            form.action = '/edit/document/'+id; 

            var b = document.createElement('button');
            b.className = 'btn btn-sm btn-primary';
            b.innerHTML = 'Atualizar';

            var input = document.createElement('input');
            input.value = txt;
            input.type = 'text';
            input.name = 'name'; 

          form.appendChild(input);

          form.appendChild(b);  

          $('#s-'+id).html(form); 
        }
      </script>

      @endsection