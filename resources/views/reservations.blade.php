@extends('layouts.nav')
   


        @section('content')

        <style>
          .s {
            overflow-x:auto;
             
          }
          .s div {
 
          }
        </style>

        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Todos os moradores</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/painel">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                     Todos os moradores
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
          
          @if(session('success-edit-user'))
          <div class="row ">
              <div class="p-3 mb-2 col-md-12 alert-success"> 
                      <h5>{{session('success-edit-user')}}</h5> 
              </div>
          </div>
      @endif
 
         
        <div class="row s" style="margin-top: 20px;background:white;border-radius:10px;margin:20px 22px 0px 2px">
        
                <table class="table">
                  <thead>
                    <tr> 
                      <th scope="col">Nome da área</th>
                      <th scope="col">Dia da semana</th> 
                      <th scope="col">Cancelar</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($reservations as $u)
                        <tr> 
                               
                                <td>{{$u->name}}</td>
                                <td>{{$u->day}}</td> 
                                
                                 

                                <td>
                                  <div style="display:flex">
                                   
                                    <button   onclick="window.location.href = '/del/dl/{{$u->id}}'" class="ed btn btn-sm btn-danger" style="margin-right: 15px">Excluir</button>
                                  </div>
                                </td>
                       
                        </tr>
                      @endforeach
                  </tbody>
                </table>
             
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