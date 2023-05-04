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
                            <h3 class="panel-title"><i class="lnr lnr-laptop-phone"></i> Gestion des Equipements</h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('d')." ".date('M')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title"> Liste des Equipements </h3>
								</div>
								
									
									<div class="panel-body">
										<div class="row">
										<div class="col-md-12">
											<!-- TABLE STRIPED -->
											<div class="panel">
									
												<div class="panel-body">
												@if( session()->get( 'addmodalite' ) == "deleted" )
												<div class="alert alert-success alert-dismissible" role="alert">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<i class="fa fa-check-circle"></i> Modalité supprimée avec succèss 
												</div>
												@endif
											
															<table class="table table-striped">
															<!-- nav search--> 
															<div>
															<form action="{{ route('detect') }}" method="GET">
																<input type="text" name="query" placeholder="Recherche...">
																<button type="submit">Rechercher</button> 
															</form></div>
																<thead>
																	<tr>
																		<th>#</th>
																		<th>Equipement</th>
																		<th>N° série</th>
																		<th>Modèle</th>
																		<th>Client</th>
																		
																		@if (Auth::user()->role == "Administrateur")
																		<th>Action</th>
																		@endif
																	</tr>
																</thead>
																<tbody>
																<?php $i=0; ?>
																@foreach($equipements as $equipement)
																<?php $i++; ?>
																<tr>
																	<td class="table-info">{{ $i }}</td>
																	<td class="table-info">{{ $equipement->designation }}</td>
																	<td class="table-info">{{ $equipement->numserie }}</td>
																	<td class="table-info">{{ $equipement->modele }}</td>
																	<td class="table-info">@foreach($clients as $client )
																	@if ($equipement->client == $client->id)
																		{{ $client->name}}
																	@endif
																 
																	@endforeach</td>
																   @if (Auth::user()->role == "Administrateur")
																	<td class="table-info"><a  data-toggle="tooltip" data-placement="top" title="Modifier" class='btn btn-primary' href="/equipement/mod/{{ $equipement->id }}"><i class="lnr lnr-pencil"></i></a> 
																		<a  data-toggle="tooltip" data-placement="top" title="supprimer" class='btn btn-danger' href="/equipement/del/{{ $equipement->id  }}"><i class="lnr lnr-trash"></i></a>
																
																	</td>
																		
																	@endif
																</tr>
																@endforeach 
																</tbody>
															</table>
													  
                            </div>                            
                                             
                                </div>
                    	    </div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-6"></div>
										<div class="col-md-6 text-right"><a href="/equipements" class="btn btn-primary">Effacer la recherche</a></div>
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
		
		<div class="clearfix"></div>
	<footer>
		<div class="container-fluid">
			<p class="copyright">&copy; 2023 <a href="/" target="_blank">STIET</a>.</p>
		</div>
	</footer>
</div>
<!-- END WRAPPER -->
	


@endsection
