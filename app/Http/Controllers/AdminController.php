<?php

namespace App\Http\Controllers;

use App\Mail\Occurrence as MailOccurrence;
use App\Models\Areas;
use App\Models\Building;
use App\Models\Document;
use App\Models\Occurrence;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\Presets\Vue;
use Illuminate\Support\Facades\Mail;
use App\Mail\Orccurrence;

class AdminController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewTowers() {
        $query = Building::where('id_master', $this->user()['id'])->get();

        foreach($query as $k => $q) {
            $count = Resident::where('id_building', $q->id)->count();

            $query[$k]['count'] = $count;
        } 

        return view('towers', [
            'buildings' => $query
        ]);
    }

    public function towerDb(Request $request) {
        $data = $request->only([
            'name',
            'qtd'
        ]);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:230',
            'qtd' => 'required|numeric'
        ]);

        if($validator->fails()) {
            return redirect('/towers')->withErrors($validator)->withInput();
        }
 
        //Salvando nova torre
        $save= new Building();
        $save->id_master = $this->user()['id'];
        $save->name = $data['name'];
        $save->num_apartament = $data['qtd'];
        $save->save();

        return redirect('/towers')->with('success', 'A torre foi adicionada com sucesso');
    }

    protected function user () {
        $user = Auth::user();

        return $user;
    }

    public function editBuilding(Request $request) {
        $name = $request->input('name');
        $qtd = $request->input('qtd');
        $id = $request->input('id');

        if($name) {
            $u = Building::where('id_master', $this->user()['id'])->where('id', $id)->update([
                'name' => $name
            ]);
        } elseif($qtd) {
            $u = Building::where('id_master', $this->user()['id'])->where('id', $id)->update([
                'num_apartament' => $qtd
            ]);
        }

        return redirect('/towers');
    }

    public function delBuilding($id) {
        $d = Building::where('id_master', $this->user()['id'])->where('id', $id)->delete();

        return redirect('/towers');
    }

    public function viewNewUser() {
        $buildings = Building::where('id_master', $this->user()['id'])->get();

        return view('new_user', [
            'buildings' => $buildings
        ]);
    }

    public function newUser(Request $request) {
        $data = $request->only([
            'name',
            'apartamento',
            'email',
            'password',
            'building',
            'cars',
            'pets',
            'childrens'
        ]);

        $v = Validator::make($data, [
            'name' => 'required|max:290',
            'email' => 'required|max:500|email|unique:residents',
            'password' => 'required|max:100',
            'apartamento' => 'required|numeric',
            'cars' => 'required|numeric',
            'pets' => 'required|numeric',
            'childrens' => 'required|numeric'
        ]);

        $check_building = Building::find($data['building']);

        if(!$check_building) {
            return redirect('/new-user');
        }

        if($v->fails()) {
            return redirect('/new-user')->withErrors($v)->withInput();
        }

        //Salvando
        $save = new Resident();
        $save->id_building = $data['building'];
        $save->id_master = $this->user()['id'];
        $save->num_apt = $data['apartamento'];
        $save->name = $data['name'];
        $save->email = $data['email'];
        $save->password = $data['password'];
        $save->qtd_cars = $data['cars'];
        $save->qtd_pets = $data['pets'];
        $save->qtd_childrens = $data['childrens'];
        $save->save();

        return redirect('/new-user')->with('s', 'Morador cadastrado com sucesso');
    }

    public function allUsers(Request $request) {
        $users = DB::select('SELECT r.*, t.name as tower FROM residents AS r LEFT JOIN buildings as t on(r.id_building = t.id)  WHERE r.id_master = :id', ['id' =>  $this->user()['id']]); 
        $buildings = Building::select('id', 'name')->where('id_master', $this->user()['id'])->get();

        $data = $request->only([
            'building',
            'name'
        ]);

        if($data) {
            if($data['building'] == 'all') {    
                $users = DB::select('SELECT r.*, t.name as tower FROM residents AS r LEFT JOIN buildings as t on(r.id_building = t.id)  WHERE r.id_master = :id AND r.name LIKE :nome', ['id' =>  $this->user()['id'], 'nome' => '%'.$data['name'].'%']); 
            }   else {
                $users = DB::select('SELECT r.*,  t.name as tower  FROM residents AS r LEFT JOIN buildings as t on(r.id_building = t.id)  WHERE r.id_master = :id AND r.name LIKE :nome AND r.id_building = :id_b', ['id' =>  $this->user()['id'], 'nome' => '%'.$data['name'].'%', 'id_b' => $data['building']]); 
            } 
        }
        return view('users', [
            'users' => $users,
            'buildings' => $buildings
        ]);
    }

    public function editUserView($id) {
        $buildings = Building::where('id_master', $this->user()['id'])->get();

        //Pesquisando por morador
        $resident = Resident::where('id', $id)->where('id_master', $this->user()['id'])->first();
        
        if(!$resident) {
            return redirect('/users');
        }

        return view('edit-user', [
            'buildings' => $buildings,
            'info_resident' => $resident
        ]);
    }

    public function editUserDb($id, Request $request) {
        $data = $request->only([
            'name',
            'apartamento',
            'email',
            'password',
            'building',
            'cars',
            'pets',
            'childrens'
        ]);

        $check_resident = Resident::find($id);

        if(!$check_resident) {
            return redirect('/users');
        }

        if($data['email'] != $check_resident->email) {  $alter = '|unique:residents'; } else { $alter = null; }

        $v = Validator::make($data, [
            'name' => 'required|max:290',
            'email' => 'required|max:500|email'.$alter,
            'password' => 'required|max:100',
            'apartamento' => 'required|numeric',
            'cars' => 'required|numeric',
            'pets' => 'required|numeric',
            'childrens' => 'required|numeric'
        ]);

        $check_building = Building::find($data['building']);

        if(!$check_building) {
            return redirect('/users');
        }

        if($v->fails()) {
            return redirect('/edit/user/'.$id)->withErrors($v)->withInput();
        }

        //Salvando
        $up = Resident::where('id_master', $this->user()['id'])->where('id', $id)->update([
            'id_building' => $data['building'],
            'num_apt' => $data['apartamento'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'qtd_cars' => $data['cars'],
            'qtd_pets' => $data['pets'],
            'qtd_childrens' => $data['childrens'],
        ]);
         
        return redirect('/users')->with('success-edit-user', 'O morador: '.$data['name'].' teve suas informações alteradas com sucesso');
    }

    public function delUser($id) {
        $del = Resident::where('id_master', $this->user()['id'])->where('id', $id)->delete();

        return redirect('/users');
    }

    public function viewAreas() {
        $buildings = Building::where('id_master', $this->user()['id'])->get();
        $areas = DB::select("SELECT a.*, b.name as tower FROM areas_publics as a LEFT JOIN buildings as b on(a.id_building = b.id) WHERE a.id_master = :id", ['id' => $this->user()['id']]);

        return view('areas', [
            'buildings' => $buildings,
            'areas' => $areas
        ]);
    }

    public function addArea(Request $request) {
       //Pegando todos os dados que foram enviados
       $building = $request->input('building');
       $time_verify = $request->input('time_disponible');
       $name = $request->input('name');

       //Verificando se o a torre existe
       $verify_id_building = Building::find($building);

       if(!$verify_id_building) {
            return redirect('/areas');
       }

       //Pegando dias selecionados
       $dates = [];

       for ($i=1; $i < 8; $i++) {
           $day =  $request->input($i);

           if($day) {
               array_push($dates, $request->input($i));
           } 
       }

       //Verificando se usuário enviou algum dia
       if(!$dates) {
           return redirect('/areas')->with('e', 'Preencha pelo menos um dia para adicionar está área');
       }

       $dates_filter = implode(',', $dates);
       
       //Verificando se horario foi enviado
       if($time_verify) {
           if($time_verify == 2) {
                $time_24_hours = 0;

                $times = $request->only([
                    'init-h',
                    'end-h'
                ]);

                if($times['init-h'] == '') {  return  redirect('/areas')->with('e', 'Preencha os horários ativos para adicionar está área'); }

           } elseif($time_verify == 1) {
                $time_24_hours = 1;
           }
       }
   
       //Salvando os dados
       $save = new Areas();
       $save->id_master = $this->user()['id'];
       $save->id_building = $building;
       $save->dates_disponibles = $dates_filter;
       $save->name = $name;
       $save->all_time = $time_24_hours;
       if($time_24_hours == 0) {
        $save->init_time = $times['init-h'];
        $save->end_time = $times['end-h'];
       }
   
       $save->save();

       return redirect('/areas')->with('s', 'A área de '.$name.' foi adicionada com sucesso');
    }

    public function editAreaView($id) {
        $verify_id = Areas::where('id', $id)->where('id_master', $this->user()['id'])->first();

        if($verify_id) {
            $buildings = Building::where('id_master', $this->user()['id'])->get();
    
            return view('edit-area', [
                'buildings' => $buildings,
                'info' => $verify_id
            ]);
        } else {
            return redirect('/areas');
        }
    }

    public function editAreaDb($id, Request $request) {
        $verify_id = Areas::where('id', $id)->where('id_master', $this->user()['id'])->first();

        if(!$verify_id) {
            return redirect('/areas');
        }

        //Pegando todos os dados que foram enviados
        $building = $request->input('building');
        $time_verify = $request->input('time_disponible');
        $name = $request->input('name');

        //Verificando se o a torre existe
        $verify_id_building = Building::find($building);

        if(!$verify_id_building) {
                return redirect('/areas');
        }

        //Pegando dias selecionados
        $dates = [];

        for ($i=1; $i < 8; $i++) {
            $day =  $request->input($i);

            if($day) {
                array_push($dates, $request->input($i));
            } 
        }

        //Verificando se usuário enviou algum dia
        if(!$dates) {
            return redirect('/areas')->with('e', 'Preencha pelo menos um dia para adicionar está área');
        }

        $dates_filter = implode(',', $dates);
        
        //Verificando se horario foi enviado
        if($time_verify) {
            if($time_verify == 2) {
                    $time_24_hours = 0;

                    $times = $request->only([
                        'init-h',
                        'end-h'
                    ]);

                    if($times['init-h'] == '') {  return  redirect('/areas')->with('e', 'Preencha os horários ativos para adicionar está área'); }

            } elseif($time_verify == 1) {
                    $time_24_hours = 1;
            }
        }
    
        if($time_24_hours == 0) {
            $init_time = $times['init-h'];
            $end_time = $times['end-h'];
        } else {
            $init_time = NULL;
            $end_time = NULL;
        }

        //Salvando os dados
        $up = Areas::where('id', $id)->update([
            'id_building' =>  $building,
            'dates_disponibles' => $dates_filter,
            'name' => $name,
            'all_time' => $time_24_hours,
            'init_time' => $init_time,
            'end_time' => $end_time
        ]); 

       return redirect('/areas')->with('s', 'A área de '.$name.' foi alterada com sucesso');
    }

    public function delArea($id) {
        $del = Areas::where('id_master', $this->user()['id'])->where('id', $id)->delete();

        return redirect('/areas');
    }

    public function toogleAreaStatus($id) {
        $check = Areas::where('id', $id)->where('id_master', $this->user()['id'])->first();

        if($check) {
            if($check->status == 1) {
                $status =  Areas::where('id', $id)->where('id_master', $this->user()['id'])->update(['status' => 0]);
            } else {
                $status =  Areas::where('id', $id)->where('id_master', $this->user()['id'])->update(['status' => 1]);
            }
          
        } 

        return redirect('/areas');
    }

    public function documents() {
        $buildings = Building::where('id_master', $this->user()['id'])->get();
        $documents = Document::where('id_master', $this->user()['id'])->get();

        return view('documents', [
            'buildings' => $buildings,
            'documents' => $documents
        ]);
    }

    public function addDocument(Request $request) {
        if(isset($_FILES['file'])) {
            $arquivo = $_FILES['file'];
            $extension = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $name = $this->user()['id'].'@'.rand(615, 5173179).rand(1, 5342).rand(19, 173528).rand(182, 525382);
            
            move_uploaded_file($arquivo['tmp_name'], 'files/'.$name.'.'.$extension);
        }

        //Salvando
        $save = new Document();
        if($request->input('building') != 'all') {
            $save->all_buildings = 1;
            $save->id_building = $request->input('building');
        } else {
            $save->all_buildings = 0;
        }
        $save->id_master = $this->user()['id'];
        $save->name = $request->input('name', 'Documento sem nome');
        $save->src = asset('files/'.$name.'.'.$extension);
        
        $save->save();

        return redirect('/documents')->with('s', 'Arquivo adicionado com sucesso');
    }

    public function editDocument(Request $request, $id) {
        $up = Document::where('id', $id)->where('id_master', $this->user()['id'])->update([
            'name' => $request->input('name')
        ]);

        return redirect('/documents');
    }

    public function delDocument($id) {
        $del = Document::where('id', $id)->where('id_master', $this->user()['id'])->delete();

        return redirect('/documents');
    }

    public function occurrencesView() {
        $users = Resident::where('id_master', $this->user()['id'])->get();
        $occurrences = DB::select("SELECT o.*, r.name FROM ocurrences as o LEFT JOIN residents as r on(o.id_user = r.id) WHERE o.id_master = :id", ['id' => $this->user()['id']]);

        return view('occurrences', [
            'users' => $users,
            'occurrences' => $occurrences
        ]);
    }

    public function newOccurrence(Request $request) {
        //Salvar
        $save = new Occurrence();
        $save->id_master = $this->user()['id'];
        if($request->input('user') == 'all') {
            $save->all_residents = 1;
        } else {
            $save->id_user = $request->input('user');
        }
        $save->title = $request->input('title');
        $save->description = $request->input('description');
        $save->save();

        if($request->filled('check')) {
            if($request->input('user') != 'all') {
                $email = Resident::find($request->input('user'));

                Mail::to($email->email)->send(new Orccurrence());
            } 
        }

        return redirect('/occurrences');
    }

    public function delOccurrence($id) {
        $del = Occurrence::where('id', $id)->where('id_master', $this->user()['id'])->delete();

        return redirect('/occurrences');
    }

 



}
