<?php

namespace App\Http\Controllers;
use Auth;
use File;
use App\User;
use App\Message;
use App\Activite;
use App\Equipement;
use App\Department; 
use App\SousEquipements; 
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class SousequipementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //
         $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
         $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
         $sousequipements = SousEquipements::all();
         $users = User::all();
         return view('sousequipements.index')->with('users',$users)->with('sousequipements',$sousequipements)->with('messages',$messages)->with('notifications',$notifications);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
         //
         $users = User::all();
         $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
         $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
         $sousequipements = SousEquipements::where("name",'like','%'.$request->input("searchequipement").'%')->get();
         return view('sousequipements.index')->with('users',$users)->with('sousequipements',$sousequipements)->with('messages',$messages)->with('notifications',$notifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $equipement_id) 
    {
        //
        $equipement= Equipement::find($equipement_id);
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $users = User::all();
        return view('sousequipements.ajout')->with('equipement',$equipement)->with('users',$users)->with('messages',$messages)->with('notifications',$notifications);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */ 
    /*modification*/
    public function store(Request $request, $equipement)
{     
   // dd($equipement); 
    $sousequipement = new SousEquipements();
    $sousequipement->identifiant=$request->input("identifiant");
    $sousequipement->designation=$request->input("designation");
    $sousequipement->date_achat=$request->input("date_achat");
    $sousequipement->date_arrive=$request->input("date_arrive");

    $sousequipement->equipement_id=$equipement;
    $sousequipement->save();


    return redirect()->back()->with("addsousequipement","success");
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
        $departments = Department::all();
        $equipement = Equipement::find($id);
        $users = User::all();
        return view('equipements.equipement')->with('users',$users)->with('sousequipement',$sousequipement)->with('equipements',$equipements)->with('messages',$messages)->with('notifications',$notifications); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $equipement_id)
    {
        //
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $sousequipement = SousEquipements::find($id); 
        $equipement= Equipement::find($equipement_id);
        return view('sousequipements.modifier')->with('sousequipement',$sousequipement)->with('messages',$messages)->with('notifications',$notifications); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$equipement)
    {
        //
      
      
        $sousequipement = SousEquipements::find($id);
        $sousequipement->identifiant=$request->input("identifiant");
        $sousequipement->designation=$request->input("designation");
        $sousequipement->date_achat=$request->input("date_achat");
        $sousequipement->date_arrive=$request->input("date_arrive");

        $sousequipement->equipement_id=$equipement;
        
        $sousequipement->update();

        $activite = new Activite();
        $activite->iduser = Auth::user()->id;
        $activite->description = "modifier le sousequipement ".$request->input("designation");
        $activite->save();
        return redirect("/equipement/".$equipement->id);
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id,$equipement)
    {
        //
        $sousequipement = SousEquipements::find($id);
        $sousequipement->delete();
        return redirect("/equipement/".$equipement->id);
    }  

} 
