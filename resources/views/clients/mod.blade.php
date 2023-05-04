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
							<h3 class="panel-title"><i class="lnr lnr-store"></i> Gestion des Clients</h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('d')." ".date('M')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
                                
								<div class="panel-heading">
									<h3 class="panel-title"> Modifier un Client   </h3>
								</div>
                                
								<div class="panel-body">
                                @if( session()->get( 'addclient' ) == "success" )
                                <div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> client ajouté avec succèss <a href="/clients" class="btn btn-sm btn-default"> Consulter liste des clients </a>
								</div>
                                @endif
                                <form action='/client/mod/{{$client->id}}' method="POST" >
                                                        {{ csrf_field() }} 
                                         
                                                            <div class="row">
                                                            
                                                                <div class="col-md-3">
                                                                <label > Nom client/Raison sociale </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $client->name }}" type="text" name="clientname">
                                                                
                                                                </div>
															
															    <div class="col-md-3">
																	<label > Adresse </label>
																	
																	</div>
																	<div class="col-md-9">
																	<input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $client->adresse }}" type="text" name="adresse">
																	
																</div>
															

															    <div class="col-md-3">
																	<label >Distance(KM) </label>
																	
																	</div>
																	<div class="col-md-9">
																	<input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $client->distance }}" type="text" name="distance">
																	
																</div>
																<div class="col-md-3">
																	<label > Email </label>
																	
																	</div>
																	<div class="col-md-9">
																	<input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $client->email }}" type="text" name="email">
																	
																</div>
																<div class="col-md-3">
																	<label > Mobile </label>
																	
																	</div>
																	<div class="col-md-9">
																	<input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $client->mobile}}" type="text" name="mobile">
																	
																    </div>

															        <div class="col-md-3">
																		<label> Equipements </label>
																	</div>
																	<div class="col-md-9">
																	<select name="idmachine" class="form-control">
																			@foreach( $equipements as $equipement )
																				@if ($equipement->id == $client->idmachine )
																			<option selected value='{{ $equipement->id }}'>{{ $equipement->designation }}</option>
																				@else
																			<option value='{{ $equipement->id }}'>{{ $equipement->designation }}</option>
																			   @endif
																			
																			@endforeach
																		</select> 
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
