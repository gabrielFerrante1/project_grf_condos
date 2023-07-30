<?php

namespace App\Http\Controllers;

use App\Models\Achado;
use App\Models\Areas;
use App\Models\Document;
use App\Models\Occurrence;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DateTime;
use Illuminate\Support\Facades\DB;

class ResidentController extends Controller
{
        public function __construct()
        {
            $this->middleware('auth_r');
        }


        public function allOccurrences() {
            $occurrences = Occurrence::where('all_residents', 1)->where('id_master', $_SESSION['id_master'])->get();
            $my_occurrences =  Occurrence::where('id_user', $_SESSION['id'])->where('id_master', $_SESSION['id_master'])->get();

            return view('users_occurrences', [
                'occurrences' => $occurrences,
                'my_occurrences' => $my_occurrences
            ]);
        }

        public function documentsResdientsAll() {
            $documets = Document::where('id_building', $_SESSION['id_building'])->where('id_master', $_SESSION['id_master'])->get();
            $documets2 = Document::where('all_buildings', 1)->where('id_master', $_SESSION['id_master'])->get();

            return view('users_documents', [
                'documents' => $documets,
                'documents2' => $documets2
            ]);
        }

        public function viewReservation() {
            $areas = Areas::select('id', 'name')->where('id_building', $_SESSION['id_building'])->where('id_master', $_SESSION['id_master'])->where('status', 0)->get();

            return view('users_reservations', [
                'areas' => $areas
            ]);
        }

        public function addReservation(Request $request) {
            $area = Areas::where('id_master', $_SESSION['id_master'])->where('id_building', $_SESSION['id_building'])->where('id', $request->input('area'))->where('status', 0)->first();

            if(!$area) { return redirect('/reservations/residents'); }

            $data = $request->only([
                'day',
                'init-time',
                'end-time'
            ]);

            $validator = Validator::make($data, [
                'day' => 'required|numeric',
                'init-time' => 'required|max:10',
                'end-time' => 'required|max:10'
            ]);

            if($validator->fails()) {
                return redirect('/reservations/residents')->withErrors($validator);
            }

            //Pegando dia enviado pelo usuário
            $day_resident = $request->input('day');

            //Pegando os horários enviado pelo usuário
            $init_time_resident_explode =  explode(':', $data['init-time']);
            $init_time_resident = $init_time_resident_explode[0].$init_time_resident_explode[1];

            $end_time_resident_explode =  explode(':', $data['end-time']);
            $end_time_resident = $end_time_resident_explode[0].$end_time_resident_explode[1]; 

            //Hora inicial e fianl do db
            $init_time_db_explode =  explode(':', $area->init_time);
            $init_time_db = $init_time_db_explode[0].$init_time_db_explode[1];
            
            $end_time_db_explode =  explode(':', $area->end_time);
            $end_time_db = $end_time_db_explode[0].$end_time_db_explode[1];

            //Validando se o dia pode e se o horario também
            $area_days = explode(',', $area->dates_disponibles);
            
            if(in_array($day_resident, $area_days)) {
                 //Verificando se niguem vez alguma reserva no mesmo dia e horario
                 $query_reservation = Reservation::where('id_area', $area->id)->where('day', $day_resident)->orderBy('id', 'desc')->first();

                //Verificando agora se está entre o horário permitido da área 
                    if($area->all_time == 0 && $init_time_resident >=  $init_time_db  && $end_time_resident <= $end_time_db && $end_time_resident > $init_time_resident ) {
                        if($query_reservation && $init_time_resident >= $query_reservation->init_time && $end_time_resident <= $query_reservation->end_time) {
                           return  redirect('/reservations/residents')->with('e', 'Este horário não está disponível está área pois já existe uma reserve neste dia e nesta hora');
                        } else if($query_reservation)  {
                            $save = new Reservation();
                            $save->id_building = $_SESSION['id_building'];
                            $save->id_master = $_SESSION['id_master'];
                            $save->id_resident = $_SESSION['id'];
                            $save->id_area = $area->id;
                            $save->day = $day_resident;
                            $save->init_time = $init_time_resident;
                            $save->end_time = $end_time_resident;
                            $save->save();

                            return  redirect('/reservations/residents')->with('s', 'Seu horário foi marcado com sucesso');
                        } else if(!$query_reservation)  {
                            $save = new Reservation();
                            $save->id_building = $_SESSION['id_building'];
                            $save->id_master = $_SESSION['id_master'];
                            $save->id_resident = $_SESSION['id'];
                            $save->id_area = $area->id;
                            $save->day = $day_resident;
                            $save->init_time = $init_time_resident;
                            $save->end_time = $end_time_resident;
                            $save->save();

                            return  redirect('/reservations/residents')->with('s', 'Seu horário foi marcado com sucesso');
                        } 
                    } elseif($area->all_time == 1) {
                         if($query_reservation && $init_time_resident >= $query_reservation->init_time && $end_time_resident <= $query_reservation->end_time) {
                            echo 'teste2';
                        }
                        
                    } else {
                        return redirect('/reservations/residents')->with('e', 'Este horário não está disponível está área abre as '.$area->init_time.' e fechas as '.$area->end_time);
                    } 
            } else {
                return redirect('/reservations/residents')->with('e', 'Este dia não está disponível');
            }
        }

        public function allReservations() {
            $reservations = DB::select('SELECT r.*, a.name FROM reservations as r LEFT JOIN areas_publics as a on(r.id_area = a.id) WHERE r.id_master = :id', ['id' => $_SESSION['id_master']]);

            return view('reservations', [
                'reservations' => $reservations
            ]);
        }

        public function delReservation($id) {
            $del = Reservation::where('id', $id)->where('id_master', $_SESSION['id_master'])->delete();

            return redirect('/reservations/residents/all');
        }

        public function  achadosView() {
            return view('achados');
        }

        public function addAchadosAndPerdidos(Request $request) {
            $title = $request->input('title');
            $description = $request->input('description');

            if(isset($_FILES['file'])) {
                $arquivo = $_FILES['file'];
                $extension = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
                $name = rand(615, 5173179).rand(1, 5342).rand(19, 173528).rand(182, 525382).md5('xxxxhdtegef');
                
                move_uploaded_file($arquivo['tmp_name'], 'files/'.$name.'.'.$extension);
            }

            //Salvando
            $save = new Achado();
            $save->id_building = $_SESSION['id_building'];
            $save->id_user = $_SESSION['id'];
            $save->title = $title;
            $save->description = $description;
            $save->src = asset('files/'.$name.'.'.$extension);
            $save->save();

            return redirect('/achados/residents')->with('s', 'Sucesso ao adiciona seu objeto perdido ou achado');
        }

        public function allAchados() {
            $a = Achado::where('id_building', $_SESSION['id_building'])->get();

            return view('all', [
                'all' => $a
            ]);
        }
}
