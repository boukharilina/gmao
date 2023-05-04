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
							<h3 class="panel-title"><i class="lnr lnr-cog"></i> Gestion des Maintenance Préventives</h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('d')." ".date('M')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
                                
								<div class="panel-heading">
									<h3 class="panel-title"> Modifier la  Maintenance Préventive   </h3>
								</div>
                                
								<div class="panel-body">
                                @if( session()->get( 'adduser' ) == "success" )
                                <div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> Maintenance  ajouteé avec succèss <a href="/mp" class="btn btn-sm btn-default"> Consulter la liste des Maintenances Préventives </a>
								</div>
                                @endif
                                <form action='/mpreventive/mod/{{ $mp->id }}' method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }} 
                            
                                            <div class="row">
                                            
                                                <div class="col-md-3">
                                                <label > Identifiant </label>
                                                
                                                </div>
                                                <div class="col-md-9">
                                                <input style="width:100%;margin-bottom:10px;" disabled class="form-control"  value="{{ $mp->numero}}"  type="text" >
                                                <input style="width:100%;margin-bottom:10px;"  class="form-control" value="{{ $mp->numero}}" type="hidden" name="numero">
                                                
                                                </div>

                                                <div class="col-md-3">
                                                    <label > <label>  Client </label> </label>
                                                        
                                                </div>
                                                <div class="col-md-9">
                                                    <select style="width:100%;margin-bottom:10px;" class="form-control" name="client">
                                                    @foreach($clients as $client )
                                                                
                                                        @if ($client->id == $mp->idclient )
                                                            <option selected value='{{ $client->id }}'>{{ $client->name }}</option>
                                                        @else
                                                            <option value='{{ $client->id }}'>{{ $client->name }}</option>
                                                        @endif
                                                    @endforeach
                                                        </select>
                                                </div>

                                                
                                                <div class="col-md-3">
                                                <label > <label>  Equipement </label> </label>
                                                
                                                </div>
                                                <div class="col-md-9">
                                                <select style="width:100%;margin-bottom:10px;" class="form-control" name="machine">
                                                @foreach($equipements as $equipement )
                                        
                                                    @if ($equipement->id == $mp->idmachine )
                                                        <option selected value='{{ $equipement->id }}'>{{ $equipement->designation }}</option>
                                                    @else
                                                        <option value='{{ $equipement->id }}'>{{ $equipement->designation }}</option>
                                                    @endif
                                                @endforeach
                                                </select>

                                                </div>

                                                <div class="col-md-3">
                                                <label > <label>  Numéro de série </label> </label>
                                                        
                                                </div>
                                                <div class="col-md-9">
                                                    <input style="width:100%;margin-bottom:10px;"  value="{{ $mp->name}}" class="form-control" type='text' name="name">
                                                </div>
                    

                                                <div class="col-md-3">
                                                <label> Unité de mesure </label>   
                                                
                                                </div>
                                                <div class="col-md-9">
                                                <select style="width:100%;margin-bottom:10px;" class="form-control" name="unite_mesure">
                                            
                                                   
                                                        <option>-- selectionner l'unité de mesure --</option>
                                                        <option selected value='Mois'>Mois</option>
                                                        <option value='Mois'>Mois</option>
                                                
                                                </select>
                                                </div>

                                                <div class="col-md-3">
                                                <label> Intervalle </label>
                                                
                                                </div>
                                                <div class="col-md-9">
                                                <input style="width:100%;margin-bottom:10px;" value="{{ $mp->intervalle}}" type="number" name="intervalle" class="form-control" >
                                                
                                                </div>
                                                <div class="col-md-3">
                                                <label> Commencé le </label>
                                                
                                                </div>
                                                <div class="col-md-9">
                                                <input min="{{ Carbon\Carbon::now() }}" style="width:100%;margin-bottom:10px;"  value="{{ $mp->date_debut}}" type="date" name="date_debut" class="form-control" >
                                                
                                                </div>
                                                <div class="col-md-3">
                                                <label> Terminé le </label>
                                                
                                                </div>
                                                <div class="col-md-9">
                                                        <input min="{{ Carbon\Carbon::now() }}" style="width:100%;margin-bottom:10px;"  value="{{ $mp->date_fin}}" type="date" name="date_fin" class="form-control" >
                                                </div>

                                                <div class="col-md-3">
                                                    <label> Prochaine Date d'Execution </label>
                                                    
                                                    </div>
                                                <div class="col-md-9">
                                                    <input min="{{ Carbon\Carbon::now() }}" style="width:100%;margin-bottom:10px;"  value="{{ $mp->date_execution}}" type="date" name="date_execution" class="form-control" >
                                                </div>
                
                                        
                                                
                                                <div class="col-md-3">
                                                <label> Intervenant </label>
                                                
                                                </div>
                                                <div class="col-md-9">
                                                <select style="width:100%;margin-bottom:10px;" class="form-control" name="executeur">
                                                @foreach($techniciens as $technicien )
        
                                                    @if ($technicien->id == $mp->executeur )
                                                        <option selected value='{{ $technicien->id }}'>{{ $technicien->name }}</option>
                                                    @else
                                                        <option value='{{ $technicien->id }}'>{{ $technicien->name }}</option>
                                                    @endif
                                                @endforeach
                                                </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <label> Etat </label>
                                                    
                                                </div>
                                                <div class="col-md-9">
                                                    <select style="width:100%;margin-bottom:10px;" class="form-control" name="etat">
                                        
                                                    @if ( $mp->etat == "Programé")
                                                        <option>-- Sélectionner un Etat --</option>
                                                        <option selected value='Programé'>Programé</option>
                                                        <option value='En Cours'>En Cours</option>
                                                        <option value='Suspendu'>Suspendu</option>
                                                        <option value='Terminé'>Terminé</option>
                                                    @elseif ($mp->etat == "En Cours")
                                                        <option>-- Sélectionner un Etat --</option>
                                                        <option selected value='En Cours'>En Cours</option>
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
                                                    <label > <label>  Commentaires </label> </label>   
                                                        </div>

                                                <div class="col-md-9">
                                                    <input style="width:100%;margin-bottom:10px;"  value="{{ $mp->observation}}" class="form-control" type='text' name="observation">
                                                </div>

                                            </div>
                                </div>   
                                    <!-- END TABLE STRIPED -->
                                </div>
                    	</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-6"></div>
										<div class="col-md-6 text-right"><input type="submit" value="Modifier" class="btn btn-primary"></div></form>
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