<?php

namespace App\Http\Controllers;
use App\User;
use App\Message;
use Carbon\Carbon;
use App\Equipement;
use App\Maintenance;
use App\clients;
use App\Mpreventive;
use App\Notification;  
use Illuminate\Http\Request;
use Auth;

class MpreventivesController extends Controller
{
    //
    public function index(){
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $users = User::all();
        $equipements = Equipement::all();
        $dateprochaine = date("Y-m-d");
        $today = date("Y-m-d");
        $techniciens = User::where('role',"Technicien")->get();
        $clients = clients::all();
        $mpreventives = Mpreventive::all();
        return view('mpreventives.index')->with('messages',$messages)->with('notifications',$notifications)->with('mpreventives',$mpreventives)->with('equipements',$equipements)->with('clients',$clients)->with('techniciens',$techniciens)->with('users',$users)->with('dateprochaine',$dateprochaine)->with('today',$today);
    }
    public function filter(Request $request){
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $users = User::all();
        $equipements = Equipement::all();
        $techniciens = User::where('role',"Technicien")->get();
        $clients = clients::all();
        $mpreventives = Mpreventive::where("numero",'like','%'.$request->input("searchmp").'%')->get();
        return view('mpreventives.index')->with('messages',$messages)->with('notifications',$notifications)->with('mpreventives',$mpreventives)->with('equipements',$equipements)->with('clients',$clients)->with('techniciens',$techniciens)->with('users',$users);
    }
    public function store(Request $request){
        $intervalle = $request->input("intervalle");
        $datedebut = $request->input("date_debut");
        $datefin = $request->input("date_fin");

        if ( $request->input("unite_mesure") == "Jours"){
            $dateprochaine = Carbon::parse($datedebut)->addDays($intervalle);
        
        }else if ($request->input("unite_mesure") == "Mois"){
            $dateprochaine = Carbon::parse($datedebut)->addMonths($intervalle);
        }
        $mp = new Mpreventive();
        $mp->numero = $request->input("numero");
        $mp->status = $request->input("status");
        $mp->idmachine = $request->input("machine");
        $mp->idclient = $request->input("client");
        $mp->umesure = $request->input("unite_mesure");
        $mp->executeur = $request->input("executeur");
        $mp->intervalle = $request->input("intervalle");
        $mp->date_debut = $request->input("date_debut");
        $mp->date_fin = $request->input("date_fin");
        $mp->date_execution = $request->input("date_execution");
        $mp->observation = $request->input("observation");
        $mp->date_prochaine = $dateprochaine ;
        $mp->etat = $request->input("etat");
        
        $mp->save();

        while( $dateprochaine <= $datefin ){
            $maintenance = new Maintenance();
            $maintenance->idmp = $mp->id ;
            $maintenance->date_maintenance = $dateprochaine;
      
            $maintenance->save();
            
            if ( $request->input("unite_mesure") == "Jours"){
                $dateprochaine =Carbon::parse($dateprochaine)->addDays($intervalle);
            
            }else if ($request->input("unite_mesure") == "Mois"){
                $dateprochaine = Carbon::parse($dateprochaine)->addMonths($intervalle);
            }
            

        }
        $notification = new Notification();
        $notification->stat = "unseen";  
        $notification->touser = "Technicien";
        $notification->iduser = $request->input("executeur");
        $notification->content = "l'administrateur a ajouté une maintenance préventive pour vous";
        $notification->save();
        return redirect('/mp/add')->with("addmp","success");
 
     }
     public function create(){
        $users = User::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
         $equipements = Equipement::all();
         $clients = clients::all();
         $techniciens = User::where('role',"Technicien")->get();
         return view('mpreventives.ajout')->with('messages',$messages)->with('notifications',$notifications)->with('equipements',$equipements)->with('clients',$clients)->with('techniciens',$techniciens)->with('users',$users);
     }
 public function show($id){
        $users = User::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $equipements = Equipement::all();
        $clients = clients::all();
        $mp = Mpreventive::find($id); 
        $maintenances = Maintenance::where('idmp',$id)->get(); 
        return view('mpreventives.affiche')->with('users',$users)->with('mp',$mp)->with('messages',$messages)->with('notifications',$notifications)->with('maintenances',$maintenances)->with('equipements',$equipements)->with('clients',$clients);
    }

    public function change($id){
        $users = User::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $techniciens = User::where('role',"Technicien")->get();
        $clients = clients::all();
        $equipements = Equipement::all();
        $mp = Mpreventive::find($id);
        return view('mpreventives.modifier')->with('mp',$mp)->with('users',$users)->with('messages',$messages)->with('notifications',$notifications)->with('equipements',$equipements)->with('clients',$clients)->with('techniciens',$techniciens);
    }
    public function update(Request $request,$id){
        $intervalle = $request->input("intervalle");
        $datedebut = $request->input("date_debut");
        $datefin = $request->input("date_fin");
        if ( $request->input("unite_mesure") == "Jours"){
            $dateprochaine = Carbon::parse($datedebut)->addDays($intervalle);
        
        }else if ($request->input("unite_mesure") == "Mois"){
            $dateprochaine = Carbon::parse($datedebut)->addMonths($intervalle);
        }
        
        $mp = Mpreventive::find($id);
        $mp->numero = $request->input("numero");
        $mp->status = $request->input("status");
        $mp->idmachine = $request->input("machine");
        $mp->idclient = $request->input("client");
        $mp->umesure = $request->input("unite_mesure");   
        $mp->executeur = $request->input("executeur");
        $mp->intervalle = $request->input("intervalle");
        $mp->date_debut = $request->input("date_debut");
        $mp->date_fin = $request->input("date_fin");
        $mp->date_execution = $request->input("date_execution");
        $mp->observation = $request->input("observation");
        $mp->date_prochaine = $dateprochaine ;
        $mp->etat = $request->input("etat");
        
        $mp->save();

        while( $dateprochaine <= $datefin ){
            $maintenance = new Maintenance();
            $maintenance->idmp = $mp->id ;
            $maintenance->date_maintenance = $dateprochaine;
         
            $maintenance->save();
            $request->input("unite_mesure") == "Mois";
                $dateprochaine = Carbon::parse($dateprochaine)->addMonths($intervalle);
            

        }
        $notification = new Notification();
        $notification->stat = "unseen";
        $notification->touser = "Technicien";
        $notification->iduser = $request->input("executeur");
        $notification->content = "l'administrateur a modifié une maintenance préventive pour vous";
        $notification->save();
        return redirect('/mp');
 
     }
    public function destroy($id)
    {
         //
         $mp = Mpreventive::find($id);
         $mp->delete();
         return redirect('/mp');
         
    }
      
    public function search_mp(Request $request)
    {   $users = User::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $techniciens = User::where('role',"Technicien")->get();
        $clients = clients::all();
        $equipements = Equipement::all();
        $query = $request->input('query');
        $mpreventives = Mpreventive::where('numero', 'like', '%'.$query.'%')
                          ->orwhere('status', 'like', '%'.$query.'%')
                          ->orwhere('umesure', 'like', '%'.$query.'%')
                          ->orwhere('idmachine', 'like', '%'.$query.'%')
                          ->orwhere('idclient', 'like', '%'.$query.'%')
                          ->orwhere('executeur', 'like', '%'.$query.'%')
                          ->orwhere('intervalle', 'like', '%'.$query.'%')
                          ->orwhere('date_debut', 'like', '%'.$query.'%')
                          ->orwhere('date_fin', 'like', '%'.$query.'%')
                          ->orwhere('etat', 'like', '%'.$query.'%')
                          ->orwhere('observation', 'like', '%'.$query.'%')->get();

        return view('mpreventives.search')->with('users',$users)->with('messages',$messages)->with('notifications',$notifications)->with('mpreventives',$mpreventives)->with('equipements',$equipements)->with('clients',$clients)->with('techniciens',$techniciens);
    }
   

}
