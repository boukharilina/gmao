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
									<h3 class="panel-title"> Ajouter une Maintenance Préventive   </h3>
								</div>
                                
								<div class="panel-body">
                                @if( session()->get( 'addmp' ) == "success" )
                                <div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> Demande  ajouteé avec succèss <a href="/mp" class="btn btn-sm btn-default"> Consulter la liste des Maintenances Préventives </a>
								</div>
                                @endif
                                <form action='/addmp' method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }} 
                            
                                            <div class="row">
                                            
                                                <div class="col-md-3">
                                                <label > Identifiant </label>
                                                
                                                </div>
                                                <div class="col-md-9">
                                                <input style="width:100%;margin-bottom:10px;" disabled class="form-control" value="{{ 'MP'.uniqid() }}" type="text" >
                                                <input style="width:100%;margin-bottom:10px;"  class="form-control" value="{{ 'MP'.uniqid() }}" type="hidden" name="numero">
                                                
                                                </div>

                                                <div class="col-md-3">
                                                    <label > <label>  Client </label> </label>
                                                        
                                                </div>
                                                <div class="col-md-9">
                                                    <select style="width:100%;margin-bottom:10px;" class="form-control" name="client">
                                                        <option >Selectionner le client </option>  
                                                        @foreach($clients as $client )

                                                        <option value="{{ $client->id }}">{{ $client->name }}</option> 
                                                        @endforeach
                                                        </select>
                                                </div>

                                                
                                                <div class="col-md-3">
                                                <label > <label>  Equipement </label> </label>
                                                
                                                </div>
                                                <div class="col-md-9">
                                                <select style="width:100%;margin-bottom:10px;" class="form-control" name="machine">
                                                    <option >Selectionner l'équipement </option>
                                                @foreach($equipements as $equipement )

                                                    <option value="{{ $equipement->id }}">{{ $equipement->designation }}</option>
                                                @endforeach
                                                </select>

                                                </div>

                                                <div class="col-md-3">
                                                <label > <label>N°Série</label> </label>
                                                        
                                                </div>
                                                <div class="col-md-9">
                                                    <input style="width:100%;margin-bottom:10px;" class="form-control" type='text' name="name">
                                                </div>
                    

                                                <div class="col-md-3">
                                                <label> Unité de mesure </label> 
                                                
                                                </div>
                                                <div class="col-md-9">
                                                <select style="width:100%;margin-bottom:10px;" class="form-control" name="unite_mesure">
                                                
                                                        <option >Selectionner l'unite de mesure</option>
                    
                                                        <option value="Jours">Jours</option>
                                                        <option value="Mois">Mois</option>
                                                </select>
                                                </div>

                                                <div class="col-md-3">
                                                <label> Intervalle </label>
                                                
                                                </div>
                                                <div class="col-md-9">
                                                <input style="width:100%;margin-bottom:10px;" type="number" name="intervalle" class="form-control" >
                                                
                                                </div>
                                                <div class="col-md-3">
                                                <label> Commencé le </label>
                                                
                                                </div>
                                                <div class="col-md-9">
                                                <input min="{{ Carbon\Carbon::now() }}" style="width:100%;margin-bottom:10px;" type="date" name="date_debut" class="form-control" >
                                                
                                                </div>
                                                <div class="col-md-3">
                                                <label> Terminé le </label>
                                                
                                                </div>
                                                <div class="col-md-9">
                                                        <input min="{{ Carbon\Carbon::now() }}" style="width:100%;margin-bottom:10px;" type="date" name="date_fin" class="form-control" >
                                                </div>

                                                <div class="col-md-3">
                                                    <label> Prochaine Date d'Execution </label>
                                                    
                                                    </div>
                                                <div class="col-md-9">
                                                    <input min="{{ Carbon\Carbon::now() }}" style="width:100%;margin-bottom:10px;"   type="date" name="date_execution" class="form-control" >
                                                </div>
                
                                        
                                                
                                                <div class="col-md-3">
                                                <label> Intervenant </label>
                                                
                                                </div>
                                                <div class="col-md-9">
                                                <select style="width:100%;margin-bottom:10px;" class="form-control" name="executeur">
                                                    <option >Selectionner l'intervenant</option>
                                                @foreach($techniciens as $technicien )

                                                    <option value="{{ $technicien->id }}">{{ $technicien->name }}</option>
                                                @endforeach
                                                </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <label> Etat </label>
                                                    
                                                </div>
                                                <div class="col-md-9">
                                                    <select style="width:100%;margin-bottom:10px;" class="form-control" name="etat">
                                                        
                                                        <option >Selectionner un Etat</option>
                                                        <option value="Programé">Programé</option>
                                                        <option value="En Cours">En Cours</option>
                                                        <option value="Suspendu">Suspendu</option>
                                                        <option value="Terminé">Terminé</option>
                                                        
                                                    </select>
                                                </div>

            
                                                <div class="col-md-3">
                                                    <label > <label> Commmentaires </label> </label>
                                                                
                                                </div>
                                                
                                                <div class="col-md-9">
                                                    <input style="width:100%;margin-bottom:10px;" class="form-control" type='text' name="observation">
                                                
                                                </div>

                                            </div>   
                                                           
                                                            
                                      
                                    <!-- END TABLE STRIPED -->
                                </div>
                    	</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-6"></div>
										<div class="col-md-6 text-right"><input type="submit" value="Ajouter" class="btn btn-primary"></div></form>
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
