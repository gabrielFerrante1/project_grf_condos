@extends('layouts.nav')
   

        @section('content')
  
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Publicar novo documento do condomínio</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/painel">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Documentos do condomínio 
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
                            <h4 class="card-title">Publicar novo documento do condomínio</h4>
                            <div class="form-group">
                              <label for="fname" class=" text-end control-label col-form-label">Documento diponível para: </label>
                              <div class="">
                                <select name="building"   class="form-control" id="fname" >
                                  <option value="all">Disponíveis para todas as torres</option>
                                    @foreach ($buildings as $item)
                                        <option value="{{$item->id}}">Apenas para: {{$item->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="lname" class=" text-end control-label col-form-label">Titulo do documento:</label>
                                <div class=" ">
                                  <input name="name" min="1" type="text" class="form-control" id="lname">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="lname" class=" text-end control-label col-form-label">Documento:</label>
                                <div class=" ">
                                  <input name="file" type="file" class="form-control" id="lname">
                                </div>
                              </div>
                          </div>
                        
                            <div class="card-body" style="margin-top:-30px">
                              <button type="submit" class="btn btn-primary">
                                Publicar documento
                              </button>
                          
                          </div>
                        </form>
                      </div>
               
              </div>
          </div>

          
        <div class="row">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-0">Documentos do condomínio</h5>
                </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Titulo do arquivo</th>
                      <th scope="col">Url para acesso o documento</th>
                      <th scope="col">Data da publição</th> 
                      <th scope="col">Editar</th>
                      <th scope="col">Deletar</th>

                    </tr>
                  </thead>
                  <tbody> 
                    @foreach ($documents as $a) 
                        <tr> 
                            <td id="s-{{$a->id}}">{{$a->name}}</td>
                            <td><a href="{{$a->src}}">{{$a->src}}</a></td>
                            <td>{{$a->date}}</td>

                            <td><button class="btn btn-sm btn-warning" onclick="edit({{$a->id}}, '{{$a->name}}')">Editar</button></td>

                            <td><button class="btn btn-sm btn-danger" onclick="if(window.confirm('Deseja realmente deletar este arquivo')){window.location.href = '/del/document/{{$a->id}}'}">Excluir</button></td>
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