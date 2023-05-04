<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Message;
use App\Activite;
use App\clients;
use App\Equipement;
use App\Notification;
use Illuminate\Http\Request;


class clientsController extends Controller
{
    //
    public function index(){
        $users = User::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $clients = clients::all();
        $equipements = Equipement::all();
        return view('clients.index')->with('users',$users)->with('messages',$messages)->with('notifications',$notifications)->with('clients',$clients)->with('equipements',$equipements);
    }
    public function create(){
        $users = User::all();
        $equipements = Equipement::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        return view('clients.ajout')->with('users',$users)->with('messages',$messages)->with('notifications',$notifications)->with('equipements',$equipements);
    }
    public function add(request $request){
        
        $client = new clients();
        $client->name=$request->input('clientname');
        $client->adresse=$request->input('adresse');
        $client->email=$request->input('email');
        $client->mobile=$request->input('mobile');
        $client->idmachine=$request->input('idmachine'); 
        $client->save();
    
        return redirect('/clients')->with("client/add","success");
        
    }
    public function change($id){
        $users = User::all();
        $equipements = Equipement::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $client = clients::find($id);
        return view('clients.mod')->with('client',$client)->with('users',$users)->with('messages',$messages)->with('notifications',$notifications)->with('equipements',$equipements);
    }
    public function update(Request $request,$id){
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $client = clients::find($id);
        $client->name =$request->input('clientname') ;
        $client->adresse=$request->input('adresse');
        $client->email=$request->input('email');
        $client->mobile=$request->input('mobile');
        $client->idmachine=$request->input('idmachine'); 
        
        $client->save();
        return redirect('/clients');

    }
    public function filter(Request $request)
    {
         //
         $users = User::all();
         $equipements = Equipement::all(); 
         $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
         $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
         $query = $request->input('query');
         $clients = clients::where('name', 'like', '%'.$query.'%')
                            ->orwhere('adresse', 'like', '%'.$query.'%')
                            ->orwhere('email', 'like', '%'.$query.'%')
                            ->orwhere('mobile', 'like', '%'.$query.'%')->get();
       
  
         return view('clients.search', compact('clients'))->with('messages',$messages)->with('users',$users)->with('clients',$clients)->with('messages',$messages)->with('notifications',$notifications)->with('equipements',$equipements);
    }
    public function destroy($id)
    {
         //
         $client = clients::find($id);
         $client->delete();
         return redirect('/clients');
         
    }
    /*public function search(Request $request)
    {   $users = User::all();
        $equipements = Equipement::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $query = $request->input('query');
        $clients = clients::where('name', 'like', '%'.$query.'%')->get();
        $clients = clients::where('adresse', 'like', '%'.$query.'%')->get();
        $clients = clients::where('distance', 'like', '%'.$query.'%')->get();
        $clients = clients::where('email', 'like', '%'.$query.'%')->get();
        $clients = clients::where('mobile', 'like', '%'.$query.'%')->get();
        $clients = clients::where('idmachine', 'like', '%'.$query.'%')->get();
        return view('clients.search', compact('clients'))->with('users',$users)->with('messages',$messages)->with('notifications',$notifications)->with('clients',$clients)->with('equipements',$equipements);
    }*/


}