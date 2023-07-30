<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Building;
use App\Models\Document;
use App\Models\Occurrence;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('/painel');
    }

    public function loginResident()
    {
        return view("login");
    }

    public function loginResidentDB(Request $request)
    {
        session_start();

        $email = $request->input('email');
        $password = $request->input('password');

        $log = Resident::where('email', $email)->where('password', $password)->first();

        if ($log) {
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $log->id;
            $_SESSION['id_building'] = $log->id_building;
            $_SESSION['id_master'] = $log->id_master;


            return redirect('/painel');
        } else {
            return redirect('/login-resident')->with('e', 'Erro ao tentar fazer login');
        }
    }


    public function indexView()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $d = Document::where('id_master', $user->id)->count();
            $o = Occurrence::where('id_master', $user->id)->count();
            $a = Areas::where('id_master', $user->id)->count();
            $t = Building::where('id_master', $user->id)->count();
            $r = Resident::where('id_master', $user->id)->count();

            return view('index', [
                'd' => $d,
                'o' => $o,
                'a' => $a,
                't' => $t,
                'r' => $r
            ]);
        } else {
            return view('index');
        }
    }

    public function logOut()
    {
        Auth::logout();

        session_start();

        session_destroy();

        return redirect('/login');
    }

    public function loginOwner(Request $request)
    {
        $credentials = $request->only([
            'email',
            'password'
        ]);

        if (!$credentials['email'] || !$credentials['password']) {
            return redirect()->route('login');
        }


        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('/painel');
        } else {
            return redirect()->route('login')->with('password', 'Senha inválida')->withInput();
        }
    }
}
