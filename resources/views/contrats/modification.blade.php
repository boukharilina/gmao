@extends('layouts.app')
@section('content')

<!-- WRAPPER -->
<div id="wrapper">
	
	<!--MENU-->
    @include('menu.menutop')
	@include('menu.menuleft')
	

		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="lnr lnr-users"></i> Gestion des Contrats du Maintenances </h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('d')." ".date('M')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
                                
								<div class="panel-heading">
									<h3 class="panel-title"> Modification du Contrat de Maintenance   </h3>
								</div>
                                
								<div class="panel-body">
                                @if( session()->get( 'cm/mod/{id}' ) == "success" )
                                <div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> Contrat Modifié avec Succès <a href="/cm" class="btn btn-sm btn-default"> Consulter Liste des Contrats </a>
								</div>
                                @endif
                                <form action='/cm/mod/{{ $contrat->id }}/valide' method="POST" >
										{{ csrf_field() }} 
							
											<div class="row">
											
												<div class="col-md-3">
												<label > Type du Contrat </label>
												
												</div>
												<div class="col-md-9">
												<input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $contrat->name }}" type="text" name="contratname">
												
												</div>
												<div class="col-md-3">
												<label > Nom du Client</label></div>
												<div class="col-md-9">
													<select name="idclient" class="form-control">
														<option>-- Selectionner un Client --</option>
														@foreach( $clients as $client )
															@if ($client->id == $contrat->idclient )
														<option selected value='{{ $client->id }}'>{{ $client->name }}</option>
															@else
														<option value='{{ $client->id }}'>{{ $client->name }}</option>
															@endif
														
														@endforeach
													</select> 
												
												</div>
												
												<div class="col-md-3">
													<label > Equipement</label>
												</div>
												<div class="col-md-9">
														<select name="idequipement" class="form-control">
															<option>-- Selectionner un Equipement --</option>
															@foreach( $equipements as $equipement )
																@if ($equipement->id == $contrat->idequipement )
															<option selected value='{{ $equipement->id }}'>{{ $equipement->designation }}</option>
																@else
															<option value='{{ $equipement->id }}'>{{ $equipement->designation }}</option>
																@endif
															
															@endforeach
														</select> 
													
												</div>

												
												<div class="col-md-3">
													<label > Date de Début </label>
													
													</div>
													<div class="col-md-9">
													<input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $contrat->date_debut }}" type="date" name="date_debut">
												</div>

												<div class="col-md-3">
													<label > Date de Fin </label>
													
													</div>
													<div class="col-md-9">
													<input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $contrat->date_fin }}" type="date" name="date_fin">
												</div>
												
												
												<div class="col-md-3">
												<label> Note </label>
												
												</div>
												<div class="col-md-9">
												<textarea class="form-control" name="note" >{{ $contrat->note }}</textarea>
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
			<p class="copyright">&copy; 2017 <a href="/" target="_blank">TAVGMAO</a>.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<div class="clearfix"></div>
	<footer>
		<div class="container-fluid">
			<p class="copyright">&copy; 2023 <a href="/" target="_blank">STIET</a>.</p>
		</div>
	</footer>
</div>
<!-- END WRAPPER -->
@endsection
