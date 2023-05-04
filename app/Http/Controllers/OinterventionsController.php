<?php
use Illuminate\Support\Facades\Input;
namespace App\Http\Controllers;
use Auth;
use File;

use App\User;
use App\Message;
use App\Activite;
use Carbon\Carbon;
use App\Equipement;
use App\clients;
use App\Maintenance;
use App\Mpreventive;
use App\Notification;
use App\Ointervention;
use Illuminate\Http\Request;

class OinterventionsController extends Controller
{
    //
    public function index(Request $request){
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $users = User::all();
        $equipements = Equipement::all();
        $clients = clients::all();
        $ointerventions = Ointervention::where('etat',"!=","Terminé")
                                        ->get();

        return view('dmdinterventions.index')->with('messages',$messages)->with('notifications',$notifications)->with('ointerventions',$ointerventions)->with('equipements',$equipements)->with('clients',$clients)->with('users',$users);
    }
    public function store(Request $request){
       $oi = new Ointervention();
       $oi->numero = $request->input("numero");
       $oi->emetteur = $request->input("emetteur");
       $oi->idmachine = $request->input("machine");
       $oi->idclient = $request->input("idclient");
       $oi->type_panne = $request->input("type_panne");
       $oi->destinateur = $request->input("iduser");
       $oi->priorite = $request->input("priorite"); 
       $oi->commentaire = $request->input("commentaire");
       $oi->etat = $request->input("etat");
       $oi->save();
       return redirect('/di/add')->with("addoi","success"); 

    }
    public function create(){
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $equipements = Equipement::all();
        $clients = clients::all();
        $techniciens = User::where('role',"Technicien")->get();
        $users = User::all();
        return view('dmdinterventions.ajout')->with('users',$users)->with('equipements',$equipements)->with('techniciens',$techniciens)->with('clients',$clients)->with('messages',$messages)->with('notifications',$notifications);
    }
    public function show($id){
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $oi = Ointervention::find($id);
        return view('dmdinterventions.affiche')->with('oi',$oi)->with('messages',$messages)->with('notifications',$notifications);
    }
    
    public function change($id){
        $users = User::all();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $techniciens = User::where('role',"Technicien")->get();
        $clients = clients::all();
        $equipements = Equipement::all();
        $oi = Ointervention::find($id);
        return view('dmdinterventions.modifier')->with('oi',$oi)->with('users',$users)->with('messages',$messages)->with('notifications',$notifications)->with('equipements',$equipements)->with('clients',$clients)->with('techniciens',$techniciens);
    }
    public function update(Request $request,$id){
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();

         $document = $request->file('document');
        if ($request->hasFile('document'))
        {
        //
        $documentname = $document->getClientOriginalName();
        //uniqid() is php function to generate uniqid but you can use time() etc.
        $destinationPath = storage_path('app/public');
        $document->move($destinationPath,$documentname);
        $oi = Ointervention::find($id);
        $oi->numero = $request->input("numero");
        $oi->emetteur = $request->input("emetteur");
        $oi->idmachine = $request->input("machine");
        $oi->idclient = $request->input("idclient");
        $oi->type_panne = $request->input("type_panne");
        $oi->destinateur = $request->input("iduser");
        $oi->priorite = $request->input("priorite");
        $oi->commentaire = $request->input("commentaire");  
        $oi->etat = $request->input("etat");
        $oi->document = $document -> getClientOriginalName();
        }
        else 
        {
            $destinationPath['document'] = null;
            $oi = Ointervention::find($id);
            $oi->numero = $request->input("numero");
            $oi->emetteur = $request->input("emetteur");
            $oi->idmachine = $request->input("machine");
            $oi->idclient = $request->input("idclient");
            $oi->type_panne = $request->input("type_panne");
            $oi->destinateur = $request->input("iduser");
            $oi->priorite = $request->input("priorite");
            $oi->commentaire = $request->input("commentaire");  
            $oi->etat = $request->input("etat");
        }

      
        //

        $oi->save();

        return redirect('/di'); 

    }
    public function destroy($id)
    {
         //
         $oi = Ointervention::find($id);
         $oi->delete();
         return redirect('/di')->with("addoi","deleted");
         
    }

    public function destroyHistorique($id)
    {
         //
         $oi = Ointervention::find($id);
         $oi->delete();
         return redirect('/di/historique')->with("addoi","deleted");
         
    }
    public function ordretravaille($id){
        $oi = Ointervention::find($id);
        return view('ointerventions.ordret')->with('oi',$oi); 
    }
  
 
    public function ordretravailleshow($id){
        
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $oi = Ointervention::find($id);
        return view('dmdinterventions.observation')->with('oi',$oi)->with('messages',$messages)->with('notifications',$notifications);

    }
    public function valider($id,Request $request){
        
        $oi = Ointervention::find($id);
        $oi->etat = "Terminé";
        $oi->update();
        

           // Lister les administrateurs
           $admins = User::where('role','=','Administrateur')->get();
           
           foreach($admins as $admin ){
               $notification = new Notification();
               $notification->stat = "unseen";
               $notification->touser = "Administrateur";
               $notification->iduser =$admin->id;
               $notification->content = "Ordre de travail ".$oi->numero." validé par ".Auth::user()->name; 
               $notification->save();
           }
           
            $notification = new Notification();
            $notification->stat = "unseen";
            $notification->touser = "Technicien";
            $notification->iduser = $oi->destinateur;
            $notification->content = "Ordre de travail ".$oi->numero." validé par ".Auth::user()->name; 
            $notification->save();

        return redirect('/di');

    }

    public function addobservationoi(Request $request , $id){
        $oi = Ointervention::find($id);
        $numero = $oi->numero;
        $oi->date_intervention = $request->input("date_debut");
        $oi->commentaire = $request->input("commentaire");
        $oi->etat = $request->input("etat");      
        $oi->update();
        $ac = new Activite();
        $ac->iduser = Auth::user()->id;
        $ac->description = "Commencer la demande d'Intervention ".$numero;
        $ac->save();
        // Lister les administrateurs
        $admins = User::where('role','=','Administrateur')->get();
        $chefs = User::where('role','=','Chef Secteur')->get();
        foreach($admins as $admin ){
            $notification = new Notification();
            $notification->stat = "unseen";
            $notification->touser = "Administrateur";
            $notification->iduser =$admin->id;
            $notification->content = "le technicien a démaré l'ordre du travail ".$numero; 
            $notification->save();
        }
        foreach($chefs as $chef ){
            $notification = new Notification(); 
            $notification->stat = "unseen";
            $notification->touser = "Chef Secteur";
            $notification->iduser =$chef->id;
            $notification->content = "le technicien a validé l'ordre du travail ".$numero; 
            $notification->save();
        }


        return redirect('/homet');
        //return view('dmdinterventions.observation');

    }
    //Modifier l'ordre d'intervention 
    public function modordretravail($id){
        
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $oi = Ointervention::find($id);
        return view('dmdinterventions.modobservation')->with('oi',$oi)->with('messages',$messages)->with('notifications',$notifications);

    }
    public function modobservationoi(Request $request , $id){
        $oi = Ointervention::find($id);
        $numero = $oi->numero;
        $oi->date_intervention = $request->input("date_debut");
        $oi->commentaire = $request->input("commentaire");
        $oi->etat = $request->input("etat");      
        $oi->update();
        $ac = new Activite();
        $ac->iduser = Auth::user()->id;
        $ac->description = "Modifier l'Ordre d'Intervention ".$numero;
        $ac->save();
        // Lister les administrateurs
        $admins = User::where('role','=','Administrateur')->get();
        $chefs = User::where('role','=','Chef Secteur')->get();
        foreach($admins as $admin ){
            $notification = new Notification();
            $notification->stat = "unseen";
            $notification->touser = "Administrateur";
            $notification->iduser =$admin->id;
            $notification->content = "Le Technicien a Modifié l'Ordre d'Intervention ".$numero; 
            $notification->save();
        }
        foreach($chefs as $chef ){
            $notification = new Notification(); 
            $notification->stat = "unseen";
            $notification->touser = "Chef Secteur";
            $notification->iduser =$chef->id;
            $notification->content = "le technicien a validé l'ordre du travail ".$numero; 
            $notification->save();
        }


        return redirect('/homet');
        //return view('dmdinterventions.observation');

    }
    public function ordretravaillempshow($id){
        $equipements = Equipement::all();
        //$mp = Mpreventive::find($id);
        $maintenances = Maintenance::where('idmp',$id)->get(); 
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $mp = Mpreventive::find($id);
        $today = date("Y-m-d");
        $maintenance = Maintenance::where('idmp',$mp->id)->where('date_maintenance',$today)->get();
        return view('mpreventives.observation')->with('equipements',$equipements)->with('maintenances',$maintenances)->with('mp',$mp)->with('maintenance',$maintenance)->with('messages',$messages)->with('notifications',$notifications);

    }
    public function historiquempshow($id){
        $equipements = Equipement::all();
        //$mp = Mpreventive::find($id);
        $maintenances = Maintenance::where('idmp',$id)->get(); 
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $clients = clients::all();
        $mp = Mpreventive::find($id);
        $today = date("Y-m-d");
        $maintenance = Maintenance::where('idmp',$mp->id)->where('date_maintenance',$today)->get();
        return view('mpreventives.historique')->with('equipements',$equipements)->with('maintenances',$maintenances)->with('mp',$mp)->with('maintenance',$maintenance)->with('messages',$messages)->with('notifications',$notifications)->with('clients',$clients);

    }
    public function addobservationmp(Request $request , $id){
        $m = Maintenance::find($id);
        $m->observation = $request->input('observation');
        $m->etat = "En attente de validation";
        $m->update();
        $mp = Mpreventive::find($m->idmp);
        $mp->date_prochaine = Carbon::parse($mp->date_prochaine)->addDays($mp->intervalle);
        $mp->save();
        $numero = $mp->numero;
        
        $ac = new Activite();
        $ac->iduser = Auth::user()->id;
        $ac->description = "valider la maintenance preventive ".$numero;
        $ac->save();
        $admins = User::where('role','=','Administrateur')->get();
        $chefs = User::where('role','=','Chef Secteur')->get();
        foreach($admins as $admin ){
            $notification = new Notification();
            $notification->stat = "unseen";
            $notification->touser = "Administrateur";
            $notification->iduser =$admin->id;
            $notification->content = "le technicien a démaré la maintenance preventive".$numero; 
            $notification->save();
        }
        foreach($chefs as $chef ){
            $notification = new Notification();
            $notification->stat = "unseen";
            $notification->touser = "Chef Secteur";
            $notification->iduser =$chef->id;
            $notification->content = "le technicien a validé la maintenance preventive".$numero; 
            $notification->save();
        }
        return redirect('/homet');
     
    }

    public function historiqueoi(){
        $alloi = Ointervention::where('etat',"Terminé")->get();
        $equipements = Equipement::all();
        $users = User::all();
        $clients = clients::all();
        $techniciens = User::where('role',"Technicien")->get();
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        return view('dmdinterventions.historique')->with('alloi',$alloi)->with('equipements',$equipements)->with('messages',$messages)->with('notifications',$notifications)->with('clients',$clients)->with('users',$users)->with('techniciens',$techniciens);
    
    }
    public function find(Request $request){
        $messages = Message::where('iddestination',Auth::user()->id)->where('stat',"unread")->get();
        $notifications = Notification::where('iduser',Auth::user()->id)->where('stat',"unseen")->get();
        $users = User::all();
        $clients = clients::all();
        $equipements = Equipement::all();
        $query = $request->input('query');
        $ointerventions = Ointervention::where("numero",'like','%'.$query.'%')
                                        ->orwhere('type_panne', 'like', '%'.$query.'%')
                                        ->orwhere('destinateur', 'like', '%'.$query.'%')
                                        ->orwhere('idclient', 'like', '%'.$query.'%')
                                        ->orwhere('priorite', 'like', '%'.$query.'%')
                                        ->orwhere('etat', 'like', '%'.$query.'%')
                                        ->orwhere('commentaire', 'like', '%'.$query.'%')
                                        ->orwhere('idmachine', 'like', '%'.$query.'%')->get();
        return view('dmdinterventions.search')->with('messages',$messages)->with('notifications',$notifications)->with('ointerventions',$ointerventions)->with('equipements',$equipements)->with('clients',$clients)->with('users',$users);

    }


}
