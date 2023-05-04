@extends('layouts.app')
@section('content')

<!-- WRAPPER -->
<div id="wrapper">

	<!--MENU-->
    @include('menu.menutop')
	@include('menu.menuleft')

		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">  
						<div class="panel-heading">
							<h3 class="panel-title"><i class="lnr lnr-file-empty"></i> Gestion Des Interventions</h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('d')." ".date('M')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
                                
								<div class="panel-heading">
									<h3 class="panel-title"> Modifier Une Demande d'Intervention   </h3>
								</div>
                                
								<div class="panel-body">
                                @if( session()->get( 'addoi' ) == "success" )
                                <div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> Demande  Modifiée Avec Succès <a href="/di" class="btn btn-sm btn-default"> Consulter Liste Des Demandes d'Interventions </a>
								</div>
                                @endif
                                <form action='/ointervention/mod/{{ $oi->id }}'method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }} 
                        
                                        <div class="row">
                                        
                                            <div class="col-md-3">
                                            <label > N° Intervention </label>
                                            
                                            </div>
                                            <div class="col-md-9">
                                            <input style="width:100%;margin-bottom:10px;" disabled class="form-control" value="{{ $oi->numero}}" type="text" >
                                            <input style="width:100%;margin-bottom:10px;"  class="form-control" value="{{ $oi->numero}}" type="hidden" name="numero">
                                            
                                            </div>
                                            <div class="col-md-3">
                                            <label > Emetteur </label>
                                            
                                            </div>
                                            <div class="col-md-9">
                                            <input style="width:100%;margin-bottom:10px;" disabled class="form-control" value="{{ Auth::user()->name }}" type="text" >
                                            <input  value="{{ Auth::user()->id }}" type="hidden" name="emetteur">
                                            
                                            </div>
                        
                                            <div class="col-md-3">
                                            <label > <label>  Equipement </label> </label>
                                            
                                            </div>
                                            <div class="col-md-9">
                                            <select style="width:100%;margin-bottom:10px;" class="form-control" name="machine">
                                            @foreach($equipements as $equipement )
                    
                                                @if ($equipement->id == $oi->idmachine )
                                                    <option selected value='{{ $equipement->id }}'>{{ $equipement->designation }}</option>
                                                @else
                                                    <option value='{{ $equipement->id }}'>{{ $equipement->designation }}</option>
                                                @endif
                                                @endforeach
                                                
                                            </select>
                                            </div>
                                            

                                            <div class="col-md-3">
                                                <label > <label>  Client </label> </label>
                                                
                                            </div>
                                            <div class="col-md-9">
                                            <select style="width:100%;margin-bottom:10px;" class="form-control" name="idclient">
                                            @foreach($clients as $client )

                                                @if ($client->id == $oi->idclient )
                                                    <option selected value='{{ $client->id }}'>{{ $client->name }}</option>
                                                @else
                                                    <option value='{{ $client->id }}'>{{ $client->name }}</option>
                                                @endif
                                                        
                                                        
                                            @endforeach
                                            </select>
                                            </div>

                                            <div class="col-md-3">
                                            <label> Type de panne/Mission </label>
                                            
                                            </div>
                                            <div class="col-md-9">
                                            <select style="width:100%;margin-bottom:10px;" class="form-control" name="type_panne">
                                            
                                                    <option >Selectionner une panne/mission</option>
                                                    <option value="Panne totale">Panne totale</option>
                                                    <option value="Problème d'alimentation ou batterie">Problème d'alimentation ou batterie</option>
                                                    <option value="Faux contacts">Faux contacts</option>
                                                    <option value="Défaut accessoire">Défaut accessoire</option>
                                                    <option value="Panne Intermittente">Panne intermittente</option>
                                                    <option value="Casse,Chute">Casse,chute</option>
                                                    <option value="Installation">Installation</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Diagnostic/réparation">Diagnostic/réparation</option>
                                                    
                        
                                            </select>
                                            </div>
                                        
                                            <div class="col-md-3">
                                            <label> Intervenant </label>
                                            
                                            </div>
                                            <div class="col-md-9">
                                            <select style="width:100%;margin-bottom:10px;" class="form-control" name="iduser">
                                            @foreach($users as $user)
                                                    
                                                @if ($user->id == $oi->destinateur)
                                                    <option selected value='{{ $user->id }}'>{{ $user->name }}</option>
                                                @else
                                                    <option value='{{ $user->id }}'>{{ $user->name }}</option>
                                                @endif
                                                    
                                            @endforeach
                                            </select>
                                            </div>


                                            <div class="col-md-3">
                                            <label> Priorité </label>
                                            
                                            </div>
                                            <div class="col-md-9">
                                                <select style="width:100%;margin-bottom:10px;" class="form-control" name="priorite">
                                                
                                                    <option >Selectionner une Priorité</option>
                                                    <option value="Tres urgent">Tres urgent</option>
                                                    <option value="Urgent">Urgent</option>
                                                    <option value="Normale">Normale</option>
                                                
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label> Etat </label>
                                                
                                            </div>
                                            <div class="col-md-9">
                                                <select style="width:100%;margin-bottom:10px;" class="form-control" name="etat">
                                    
                                                @if ( $oi->etat == "Demandé")
                                                    <option>-- Sélectionner un Etat --</option>
                                                    <option selected value='Demandé'>Demandé</option>
                                                    <option value='En Cours'>En Cours</option>
                                                    <option value='Suspendu'>Suspendu</option>
                                                    <option value='Terminé'>Terminé</option>
                                                @elseif ($oi->etat == "En Cours")
                                                    <option>-- Sélectionner un Etat --</option>
                                                    <option selected value='En Cours'>En cours</option>
                                                    <option value='Suspendu'>Suspendu</option>
                                                    <option value='Terminé'>Terminé</option>
                                                @else
                                                    <option>-- Sélectionner un Etat --</option>
                                                    <option selected value='Suspendu'>Suspendu</option>
                                                    <option value='En Cours'>En Cours</option>
                                                    <option value='Terminé'>Terminé</option>
                                                    
                                                
                                                @endif
                                                </select> 
                                            </div> 

                                            <div class="col-md-3">
                                            <label> Description complémentaire </label>
                                            
                                            </div>
                                            <div class="col-md-9">
                                            <textarea style="width:100%;margin-bottom:10px;"  value="{{ $oi->name}}"class="form-control"  name="commentaire"></textarea>
                                            
                                            </div>

                                            <div class="col-md-3">
                                                <label> Rapport d'Intervention </label>
                                                
                                            </div>
                                            <div class="col-md-9">
                                                <input style="width:100%;margin-bottom:10px;"  class="form-control"  type="file" name="document">
                                            
                                            </div> 
                                            
                                        </div>
                                            
                                        
                                                            
                                      
                                    <!-- END TABLE STRIPED -->
                                </div>
                    	</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-6"></div>
										<div class="col-md-6 text-right"><input type="submit" value="Ajouter" class="btn btn-primary"></div>
                                </form>
									</div>
								</div>
							</div>
							<!-- END RECENT PURCHASES -->
                            </div>
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <p class="copyright">&copy; 2023 <a href="/" target="_blank">STIET</a>.</p>
            </div>
        </footer>
    </div>
    <!-- END WRAPPER -->
	


@endsection

                                                   
												
                                                

												

													