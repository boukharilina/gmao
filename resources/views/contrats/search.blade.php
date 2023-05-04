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
                            <h3 class="panel-title"><i class="lnr lnr-license"></i> Contrats du Maintenance </h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('d')." ".date('M')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">@isset($searchuser) Resultat de recherche pour : <span class="text-primary"> " {{ $searchuser }} "</span> @else Liste des contrats du maintenance @endisset </h3>
								</div>
							
								<div class="panel-body">
								@if( session()->get( 'addcontrat' ) == "deleted" )
                                <div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> Contrat supprimé avec succès
								</div>
                                @endif
                                            <table class="table table-striped">
												<!-- nav search--> 
										    <div>
											<form action="{{ route('recherche') }}" method="GET">
												<input type="text" name="query" placeholder="Recherche...">
												<button type="submit">Rechercher</button> 
											</form>
										    </div>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nom du Contrat</th>
                                                        <th>Nom du Client</th>
														<th>Equipement</th>
														<th>Date de début</th>
														<th>Date de fin</th>
													
														
														@if (Auth::user()->role == "Administrateur")
														<th> Actions </th>
														@endif
														
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=0; ?>
                                                @foreach($contrats as $contrat)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $contrat->name }}</td>
													<td>
														@foreach($clients as $client )
															@if ( $client->id == $contrat->idclient)
																{{ $client->name }} 
															@endif
														@endforeach
														</td>
                                                    <td>
															@foreach($equipements as $equipement )
																@if ( $equipement->id == $contrat->idequipement)
																	{{ $equipement->designation }} 
																@endif
															@endforeach
													</td>
													<td>{{ $contrat->date_debut }}</td>
													<td>{{ $contrat->date_fin }}</td>
													</td>
												
												
													@if (Auth::user()->role == "Administrateur")
														<td><a href="/cm/mod/{{ $contrat->id }}" data-toggle="tooltip" data-placement="top" title="Modifier" class='btn btn-primary' class="btn btn-primary"><i class="lnr lnr-pencil"></i>  </a> 
															<a  data-toggle="tooltip" data-placement="top" title="supprimer" class='btn btn-danger' href="/cm/del/{{ $contrat->id }}"><i class="lnr lnr-trash"></i></a> </td>
														@endif
                                                </tr>
                                                @endforeach 
                                                </tbody>
                                            </table>
                                      
                                    <!-- END TABLE STRIPED -->
                                </div>
                    	</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-6"></div>
										<div class="col-md-6 text-right"><a href="/cm" class="btn btn-primary">Effacer la recherche</a></div>
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
