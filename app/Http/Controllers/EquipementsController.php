<?php

namespace App\Http\Controllers;
use Auth;
use File;
use App\User;
use App\Message;
use App\Activite;
use App\Department;
use App\Modalite;
use App\clients;
use App\Equipement; 
use App\Accessoire; 
use App\SousEquipements; 
use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class EquipementsController extends Controller
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
         $equipements = Equipement::all();
         $users = User::all();
         $clients = clients::all();
         return view('Equipements.index')->with('users',$users)->with('equipements',$equipements)->with('messages',$messages)->with('notifications',$notifications)->with('clients',$clients);
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
         $equipements = Equipement::where("name",'like','%'.$request->input("searchequipement").'%')->get();
         return view('Equipements.index')->with('users',$users)->with('equipements',$equipements)->with('messages',$messages)->with('notifications',$notifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($modalite_id)
    {
        //
      
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $users = User::all();
        $modalite= Modalite::find($modalite_id);
        $clients = clients::all();
        $sousequipements = SousEquipements::all();
        return view('equipements.ajout')->with('users',$users)->with('clients',$clients)->with('sousequipements',$sousequipements)->with('modalite',$modalite)->with('messages',$messages)->with('notifications',$notifications);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$modalite) 
    {
       
       $document = $request->file('document');
   
        //Display File Name
        //echo 'File Name: '.$file->getClientOriginalName();
        //Display File Extension
        //echo 'File Extension: '.$file->getClientOriginalExtension();
        //Display File Real Path
        //echo 'File Real Path: '.$file->getRealPath();
        //Display File Size
        //echo 'File Size: '.$file->getSize();
        //Display File Mime Type
        //echo 'File Mime Type: '.$file->getMimeType();
        //Move Uploaded File 
    

        $documentname = $document->getClientOriginalName();
        //uniqid() is php function to generate uniqid but you can use time() etc.
        $destinationPath = storage_path('app/public');
        $document->move($destinationPath,$documentname);
        
        //
        $equipement = new Equipement();
        $equipement->name=$request->input("code");
        $equipement->marque=$request->input("marque");
        $equipement->modele=$request->input("modele");  
        $equipement->designation=$request->input("designation");
        $equipement->numserie=$request->input("numserie");
        $equipement->date_service=$request->input("date_service");
        $equipement->plan_prev=$request->input("plan_prev"); 
        $equipement->client=$request->input("eq_client");
        $equipement->document = $document -> getClientOriginalName();

        $equipement->modalite_id=$modalite;
        
        $equipement->save();

        return redirect("/equipement/".$equipement->id);
        
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
        $modalites = Modalite::find($id);
        $clients = clients::all();
        $equipement = Equipement::find($id);
        $users = User::all();
        $sousequipements = $equipement->sousequipements ?? null ; // Filtrer les sous-équipements par id de l'équipement
        $accessoires = $equipement->accessoires ?? null ;  // Filtrer les accessoires par id de l'équipement
        return view('Equipements.equipement')->with('users',$users)->with('equipement',$equipement)->with('modalites',$modalites)->with('sousequipements',$sousequipements)->with('accessoires',$accessoires)->with('clients',$clients)->with('messages',$messages)->with('notifications',$notifications); 
    
    }


    /** 
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$modalite_id)
    {
        //
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $clients = clients::all();
        $equipement = Equipement::find($id);
        $modalite= Modalite::find($modalite_id);
        return view('Equipements.modifier')->with('equipement',$equipement)->with('modalite',$modalite)->with('clients',$clients)->with('messages',$messages)->with('notifications',$notifications); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
      
        $document = $request->file('document');
        $equipement = Equipement::find($id);
        $equipement->name=$request->input("code");
        $equipement->marque=$request->input("marque");
        $equipement->modele=$request->input("modele"); 
        $equipement->designation=$request->input("designation");
        $equipement->numserie=$request->input("numserie");
        $equipement->date_service=$request->input("date_service");
        $equipement->plan_prev=$request->input("plan_prev"); 
        $equipement->client=$request->input("eq_client");
  
        $equipement->modalite_id=$modalite;
    
        if ($document != NULL){  
               
                $documentname = uniqid().".".File::extension($document->getClientOriginalName());
                //uniqid() is php function to generate uniqid but you can use time() etc.
                $destinationPath = 'uploads/documents';
                $document->move($destinationPath,$documentname);
                $equipement->document = $documentname;
        
        }
         $equipement->update();
         
        $activite = new Activite();
        $activite->iduser = Auth::user()->id;
        $activite->description = "modifier l'equipement ".$request->input("name");
        $activite->save();
        return redirect("/equipement/".$equipement->id);
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $equipement = Equipement::find($id);
        $equipement->delete(); 
        return redirect('/equipements');
    }
    
    public function detect(Request $request)
    {
         //
         $users = User::all();
         $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
         $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
      
         $query = $request->input('query');
         $equipements = Equipement::where('name', 'like', '%'.$query.'%')
                            ->orwhere('marque', 'like', '%'.$query.'%')
                            ->orwhere('modele', 'like', '%'.$query.'%')
                            ->orwhere('designation', 'like', '%'.$query.'%')
                            ->orwhere('numserie', 'like', '%'.$query.'%')
                            ->orwhere('emplacement', 'like', '%'.$query.'%')
                            ->orwhere('date_service', 'like', '%'.$query.'%')
                            ->orwhere('plan_prev', 'like', '%'.$query.'%')
                            ->orwhere('document', 'like', '%'.$query.'%')->get();
         return view('Equipements.search')->with('users',$users)->with('equipements',$equipements)->with('messages',$messages)->with('notifications',$notifications);
    }
 


}

