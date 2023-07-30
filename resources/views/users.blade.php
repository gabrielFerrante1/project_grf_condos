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

          <div id="mod"></div>
        
            <div class="row">
                <form class="row">
                    <div class="col-md-7">
                        <label>Pesquisar por nome:</label>
                        <input value="<?php if(isset($_GET['name'])) echo $_GET['name']; ?>" name="name" onchange="this.form.submit()" style="background:none;border:1px solid gray" class="form-control" />
                
                    </div>

                    <div class="col-md-5">
                        <label>Torre</label>
                        <select name="building" onchange="this.form.submit()" style="background:none;border:1px solid gray" class="form-control">
                            <option value="all">Todas as torres</option>
                            @foreach ($buildings as $item)
                              <option <?php if(isset($_GET['building']) && $_GET['building'] == $item->id) echo 'selected'; ?> value="{{$item->id}}">{{$item->name}}</option>  
                            @endforeach
                        </select>
 
                    </div>
                </form>
            </div>
         
        <div class="row s" style="margin-top: 20px;background:white;border-radius:10px;margin:20px 22px 0px 2px">
        
                <table class="table">
                  <thead>
                    <tr> 
                      <th scope="col">Nome</th>
                      <th scope="col">Email</th>
                      <th scope="col">Senha</th>
                      <th scope="col">Torre</th>
                      <th >Número do apartamento</th>
                      <th scope="col">Quantidade de carros</th>
                      <th  style="width: 250px">Quantidade de animais de estimação</th>
                      <th scope="col">Quantidade de filhos</th>
                      <th scope="col">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($users as $u)
                        <tr> 
                               
                                <td>{{$u->name}}</td>
                                <td>{{$u->email}}</td>
                                <td>{{ $u->password }}</td>
                                <td>{{$u->tower}}</td>
                                <td><span style="margin-right: 140px">{{$u->num_apt}}</span>ﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠ</td>
                                <td><span style="margin-right: 130px">{{$u->qtd_cars}}</span>ﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠ</td>
                                <td><span style="margin-right: 230px">{{$u->qtd_pets}}</span>ﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠ</td>
                                <td><span style="margin-right: 125px">{{$u->qtd_childrens}}</span>ﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠﾠ</td>
                                 

                                <td>
                                  <div style="display:flex">
                                    <button   onclick="window.location.href = '/edit/user/{{$u->id}}'" class="ed btn btn-sm btn-warning" style="margin-right: 15px">Editar</button>

                                    <button   onclick="excluir({{$u->id}})" class="ed btn btn-sm btn-danger" style="margin-right: 15px">Excluir</button>
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


      <script>
        function excluir(id) {
          if(window.confirm('Você deseja realmente excluir este usuário? Ele perderá acesso ao sistema do condomínio.')) {
            let v1 = Math.floor(Math.random() * 10);
            let v2 = Math.floor(Math.random() * 7);
            let r = v1 + v2;
            let p =  window.prompt('A soma de '+v1+' + '+v2+' é: ');

            if(p == r) {
              window.location.href = '/delet/user/'+id;
            } else {
              alert('Você errou a soma preste mais atenção na próxima');
            }
            
          }
        }
      </script>
   
     @endsection