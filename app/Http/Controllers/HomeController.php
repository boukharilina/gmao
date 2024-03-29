<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Activite;
use App\Ointervention;
use App\Mpreventive;
use App\Equipement;
use App\clients;
use App\Message;
use App\Notification;

use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $nbrtechniciens = User::where('role',"Technicien")->count();
        $nbrchefsec = User::where('role',"Chef secteur")->count();
        $users = User::all();
        $activities = Activite::orderBy('created_at', 'desc')->get();;
        $diall = Ointervention::all()->count();
        $dinc = Ointervention::where('etat',"Demandé")->count();
        $dir = Ointervention::where('etat',"Suspendu")->count(); 
        $diec = Ointervention::where('etat',"En Cours")->count();
        $dieav = Ointervention::where('etat',"En attente de validation")->count();
        $dit = Ointervention::where('etat',"Terminé")->count();
        if ($diall > 0 ){
            $diperc = round( ( $dinc / $diall ) * 100 , 2) ;
            $dirperc = round( ( $dir / $diall ) * 100 , 2);
            $diecperc = round( ( $diec / $diall ) * 100 + ( $dieav / $diall ) * 100, 2);
            $ditperc = round( ( $dit / $diall ) * 100, 2);
        }else{
            $diperc = 0 ;
            $dirperc = 0 ;
            $diecperc = 0;
            $ditperc = 0 ;

        }
        
        
        //echo $diperc ;

        return view('home')->with('notifications',$notifications)->with('messages',$messages)->with('ditperc',$ditperc)->with('diecperc',$diecperc)->with('dirperc',$dirperc)->with('diperc',$diperc)->with('users',$users)->with('activities',$activities)->with('nbrtechniciens',$nbrtechniciens)->with('nbrchefsec',$nbrchefsec);
    }
    public function indextechnicien()
    {
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
       
        $equipements = Equipement::all();
        $clients = clients::all();
        $today = date('Y-m-d');
        $ointerventions = Ointervention::where('destinateur',Auth::user()->id)
                                        ->where('etat',"=","Demandé")
                                        ->orwhere('etat',"=","Suspendu")
                                        ->orwhere('etat',"=","En Cours")
                                        ->get();
        $mpreventives = Mpreventive::where('executeur',Auth::user()->id)
                            ->where('date_prochaine',$today)
                            ->orwhere('etat',"=","Programé") 
                            ->get();
        $allmpreventives = Mpreventive::where('executeur',Auth::user()->id)
                    ->where('date_prochaine','!=',$today)
                    ->orwhere('etat',"=","Programé")
                    ->orwhere('etat',"=","Suspendu")
                    ->orwhere('etat',"=","En Cours")
                    ->get();
        $users = User::all();
        $techniciens = User::where('role',"Technicien")->get();
        return view('homet')->with('allmpreventives',$allmpreventives)->with('users',$users)->with('messages',$messages)->with('notifications',$notifications)->with('equipements',$equipements)->with('ointerventions',$ointerventions)->with('mpreventives',$mpreventives)->with('clients',$clients)->with('techniciens',$techniciens);
    }
    
}
