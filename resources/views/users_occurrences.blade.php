@extends('layouts.nav')
   

        @section('content')
  
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Minhas ocorrências</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/painel">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                     Ocorrências do condomínio 
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
                    
                    <h4 class="mb-2">Minhas ocorrências</h4>
                    @foreach ($my_occurrences as $item)
                    <hr>
                        <h5>{{$item->title}}</h5>
                        <p style="font-size: 13px">{{$item->description}}</p>
                        <div style="background: rgb(248, 218, 118);padding:4px;color:rgb(0, 0, 0)">
                            Data de envio: {{$item->date}}
                        </div>

                    @endforeach
                    
                    <h4 class="mb-2 mt-5">Ocorrências gerais </h4>
                    @foreach ($occurrences as $item)
                    <hr>
                        <h5>{{$item->title}}</h5>
                        <p style="font-size: 13px">{{$item->description}}</p>
                        <div style="background: rgb(224, 224, 224);padding:4px;color:rgb(0, 0, 0)">
                            Data de envio: {{$item->date}}
                        </div>
                    @endforeach

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