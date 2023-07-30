@extends('layouts.nav')
   


        @section('content')
 

        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Torres</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/painel">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Torres do condomínio
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
            
            <div class="card ">
                <form class="form-horizontal" method="POST">
                    @csrf
                  <div class="card-body">
                    <h4 class="card-title">Cadastrar nova torre</h4>
                    <div class="form-group">
                      <label for="fname" class=" text-end control-label col-form-label">Nome: </label>
                      <div class="">
                        <input name="name" type="text" class="form-control" id="fname" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="lname" class=" text-end control-label col-form-label">Número de apartamentos:</label>
                      <div class=" ">
                        <input name="qtd" min="1" type="number" class="form-control" id="lname">
                      </div>
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

          
        <div class="row">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-0">Torres do condomínio</h5>
                </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Torre</th>
                      <th scope="col">Número de apartamentos</th>
                      <th scope="col">Número de apartamentos ocupados</th>
                      <th scope="col">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($buildings as $k => $b)
                        <tr> 
                                <th scope="row">{{$k+1}}</th>
                                <td id="s-{{$b->id}}">{{$b->name}}</td>
                                <td id="s2-{{$b->id}}">{{$b->num_apartament}}</td>
                   
                                <td>{{$b->count}} / {{$b->num_apartament}}</td>

                                <td> 
                                    <button onclick="if(window.confirm('Deseja excluir esta torre')){window.location.href = '/del/building/{{$b->id}}'}" type="button" class="btn btn-sm btn-danger">Remover</button>
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
        function edit(id, txt) {
            var form = document.createElement('form');
            form.action = '/edit/cond'; 

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