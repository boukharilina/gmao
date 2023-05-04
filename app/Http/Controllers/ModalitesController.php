<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Message;
use App\Activite;
use App\Modalite;
use App\clients;
use App\Equipement;
use App\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ModalitesController extends Controller
{
    //
    public function index(){
        $users = User::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $modalites = Modalite::all();
        return view('modalites.index')->with('users',$users)->with('messages',$messages)->with('notifications',$notifications)->with('modalites',$modalites);
    }
    public function create(){
        $users = User::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        return view('modalites.ajout')->with('users',$users)->with('messages',$messages)->with('notifications',$notifications);
    }
    public function add(request $request){
        
        $modalite = new Modalite();
        $modalite->name=$request->input('name'); 
        $modalite->description=$request->input('description');
        $modalite->save();
        $activite = new Activite();
        $activite->iduser = Auth::user()->id;
        $activite->description = "Ajouter la modalité ".$modalite->name;
        $activite->save();
        return redirect('/modalites')->with("addmodalite","success");
        
    }
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     */
    public function show($id)
    {
        //
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $modalite = Modalite::find($id);
        $equipement = Equipement::find($id);
        $clients = clients::all();
        $users = User::all();
        $equipements = $modalite->equipements; // Filtrer les sous-équipements par id de l'équipement
        return view('Modalites.modalite')->with('users',$users)->with('modalite',$modalite)->with('equipements',$equipements)->with('clients',$clients)->with('equipement',$equipement)->with('messages',$messages)->with('notifications',$notifications); 
    }
    public function change($id){
        $users = User::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $modalite = Modalite::find($id);
        return view('modalites.mod')->with('modalite',$modalite)->with('users',$users)->with('messages',$messages)->with('notifications',$notifications);
    }
    public function update(Request $request,$id){
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $modalite = Modalite::find($id);
        $modalite->name = $request->input('name') ;
        $modalite->description = $request->input('description') ;
        $modalite->save();
        return redirect('/modalites');

    }
    public function filter(Request $request)
    {
         //
         $users = User::all();
         $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
         $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
         $modalites = Modalite::where("name",'like','%'.$request->input("searchdepartment").'%')->get();
         return view('modalites.index')->with('messages',$messages)->with('users',$users)->with('modalites',$modalites)->with('messages',$messages)->with('notifications',$notifications);
    }
    public function destroy($id)
    {
         //
         $modalite = Modalite::find($id);
         $modalite->delete();
         return redirect('/modalites');
         
    }
   
    public function search(Request $request)
    {   $users = User::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $query = $request->input('query');
        $modalites = Modalite::where('designation', 'like', '%'.$query.'%')
                                ->orwhere('type_panne', 'like', '%'.$query.'%')
                                ->orwhere('type_panne', 'like', '%'.$query.'%')
                                ->orwhere('type_panne', 'like', '%'.$query.'%')
                                ->orwhere('type_panne', 'like', '%'.$query.'%')
                                ->get();
   
        
        return view('modalites.search', compact('modalites'))->with('users',$users)->with('messages',$messages)->with('notifications',$notifications)->with('departments',$departments);
    }
}


