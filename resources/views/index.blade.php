@extends('layouts.nav')
   


        @section('content')
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Dashboard</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Library
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
          <!-- Sales Cards  -->
          <!-- ============================================================== -->
          <div class="row">
            @auth
            <!-- Column -->
            <div class="col-md-8 col-lg-4 col-xlg-6">
              <div class="card card-hover">
                <div class="box bg-cyan text-center">
                  <h1 class="font-light text-white">
                    {{$d}}
                  </h1>
                  <h6 class="text-white">Total de documentos do condomínio</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-8 col-lg-4 col-xlg-6">
              <div class="card card-hover">
                <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                     {{$o}}
                  </h1>
                  <h6 class="text-white">Total de ocorrencias do condomínio</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-8 col-lg-4 col-xlg-6">
              <div class="card card-hover">
                <div class="box bg-warning text-center">
                  <h1 class="font-light text-white">
                    {{$a}}
                  </h1>
                  <h6 class="text-white">Total de áreas públicas do condomínio</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-10 col-lg-6 col-xlg-8">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    {{$t}}
                  </h1>
                  <h6 class="text-white">Total de torres do condomínio</h6>
                </div>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-10 col-lg-6 col-xlg-8">
              <div class="card card-hover">
                <div class="box bg-info text-center">
                  <h1 class="font-light text-white">
                    {{$r}}
                  </h1>
                  <h6 class="text-white">Total de moradores do condomínio</h6>
                </div>
              </div>
            </div>
            
            </div>
            <!-- Column -->
          </div>
          @else
            <h4 class="text-primary" style="text-align: center">Você não tem permissão para ver os dados do condomínio</h4>
          @endauth
          <!-- ============================================================== -->
          <!-- Sales chart -->
       
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