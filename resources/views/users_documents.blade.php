@extends('layouts.nav')
   

        @section('content')
  
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Documentos</h4>
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
     
          
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Titulo do arquivo</th>
                            <th scope="col">Url para acesso o documento</th>
                            <th scope="col">Data da publição</th>  
      
                          </tr>
                        </thead>
                        <tbody> 
                          @foreach ($documents as $a) 
                              <tr> 
                                  <td>{{$a->name}}</td>
                                  <td><a download href="{{$a->src}}">{{$a->src}}</a></td>
                                  <td>{{$a->date}}</td>
      
                                  <td><button class="btn btn-sm btn-warning" onclick="edit({{$a->id}}, '{{$a->name}}')">Editar</button></td>
      
                                  <td><button class="btn btn-sm btn-danger" onclick="if(window.confirm('Deseja realmente deletar este arquivo')){window.location.href = '/del/document/{{$a->id}}'}">Excluir</button></td>
                              </tr>
                              @endforeach

                              @foreach ($documents2 as $a) 
                              <tr> 
                                  <td>{{$a->name}}</td>
                                  <td><a download href="{{$a->src}}">{{$a->src}}</a></td>
                                  <td>{{$a->date}}</td>
       
                              </tr>
                              @endforeach

                              
                        </tbody>
                      </table>
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