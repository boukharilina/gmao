<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Contrat;
use App\Message;
use App\Equipement;
use App\clients;
use App\Notification;
use Illuminate\Http\Request;

class ContratsController extends Controller
{
    //
    public function index(){
        $users = User::all();
        $clients = clients::all();
        $equipements = Equipement::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $contrats =  Contrat::all();
        return view('contrats.index')->with('users',$users)->with('messages',$messages)->with('notifications',$notifications)->with('contrats',$contrats)->with('equipements',$equipements)->with('clients',$clients);
    }
    public function filter(Request $request)
    {
         //
       
         $clients = clients::all();
         $equipements = Equipement::all();
         $users = User::all();
         $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
         $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
         $contrats =  Contrat::where("name",'like','%'.$request->input("searchcontrat").'%')->get();
         return view('contrats.index')->with('users',$users)->with('contrats',$contrats)->with('messages',$messages)->with('equipements',$equipements)->with('clients',$clients)->with('notifications',$notifications);
    }
    public function create(){
        $users = User::all();
        $clients = clients::all();
        $equipements = Equipement::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $ordres = array();
     
       
        return view('contrats.ajout')->with('messages',$messages)->with('users',$users)->with('equipements',$equipements)->with('clients',$clients)->with('notifications',$notifications);
    }
    public function modification($id)
    {
         //
         $ordres = array();
     
         $users = User::all();
         $clients = clients::all();
         $equipements = Equipement::all();
         $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
         $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
         $contrat=  Contrat::find($id);
         return view('contrats.modification')->with('users',$users)->with('contrat',$contrat)->with('messages',$messages)->with('equipements',$equipements)->with('clients',$clients)->with('notifications',$notifications);
    }
    public function add(Request $request){
        $contrat = new Contrat();
        $contrat->contratname = $request->input('contratname');
        $contrat->idclient = $request->input('idclient');
        $contrat->idequipement = $request->input('idequipement');
        $contrat->date_debut= $request->input('date_debut');
        $contrat->date_fin = $request->input('date_fin');
        $contrat->note = $request->input('note');
        $contrat->save();
        return redirect('/cm/create')->with("addcontrat","success");
    }
    
    public function edit(Request $request,$id){
        $contrat = Contrat::find($id);
        $contrat->contratname = $request->input('contratname');
        $contrat->idclient = $request->input('idclient');
        $contrat->idequipement = $request->input('idequipement');
        $contrat->date_debut= $request->input('date_debut');
        $contrat->date_fin = $request->input('date_fin');
        $contrat->note = $request->input('note');
        $contrat->update();
        return redirect('/cm')->with("cm/mod/{id}","success");
    }
    public function destroy($id){
        $contrat = Contrat::find($id);
        $contrat->delete();
        return redirect('/cm')->with("addcontrat","deleted");
    }
    public function recherche(Request $request)
    {
         //
       
         $clients = clients::all();
         $equipements = Equipement::all();
         $users = User::all();
         $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
         $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
         $query = $request->input('query');
         $contrats = Contrat::where('name', 'like', '%'.$query.'%')
                            ->orwhere('date_debut', 'like', '%'.$query.'%')
                            ->orwhere('date_fin', 'like', '%'.$query.'%')
                            ->orwhere('idclient', 'like', '%'.$query.'%')
                            ->orwhere('note', 'like', '%'.$query.'%')
                            ->orwhere('idequipement', 'like', '%'.$query.'%')->get();
         return view('contrats.search')->with('users',$users)->with('contrats',$contrats)->with('messages',$messages)->with('equipements',$equipements)->with('clients',$clients)->with('notifications',$notifications);
    }

}
