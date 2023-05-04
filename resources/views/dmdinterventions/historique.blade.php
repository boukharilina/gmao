@extends('layouts.app')
@section('content')

<!-- WRAPPER -->
<div id="wrapper">

	<!--MENU-->
    
	@include('menu.menuleft')
	@include('menu.menutop')

		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content"> 
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
                            <h3 class="panel-title"><i class="lnr lnr-file-empty"></i> Historiques des Interventions</h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('d')." ".date('M')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">@isset($searchuser) Resultat de recherche pour : <span class="text-primary"> " {{ $searchuser }} "</span> @else Liste des Demandes d'Interventions @endisset </h3>
								</div>
						
								<div class="panel-body">
								@if( session()->get( 'addoi' ) == "deleted" )
                                <div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> Intervention Supprimée avec Succès
								</div>
                                @endif
                                            <table class="table table-striped">
											<!-- nav search--> 
											<form action="{{ route('find') }}" method="GET">
												<input type="text" name="query" placeholder="Recherche...">
												<button type="submit">Rechercher</button> 
											</form>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>N° Intervention</th>
                                                        <th>Equipement</th>
														<th>Client</th>
														<th>Panne/Mission</th>
														<th>Intervenant</th>
														<th>Etat</th>
                                                        <th>Commmentaires</th>
														@if (Auth::user()->role == "Administrateur")
							
                                                        <th>Rapport</th>
														<th> Action </th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=0; ?>
                                                @foreach($alloi as $oi)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $oi->numero }}</td>
                                            
                                                    <td>    
                                                    @foreach($equipements as $equipement )
                                                        @if ( $equipement->id == $oi->idmachine )
                                                            {{ $equipement->designation }} 
                                                        @endif
                                                        @endforeach
                                                    </td>

													<td>
														@foreach($clients as $client )
															@if ( $client->id == $oi->idclient )
																{{ $client->name }}  
															@endif
															@endforeach
													</td>

													<td>{{ $oi->type_panne }}</td>

													<td>@foreach($users as $user )
                                                        @if ( $user->id == $oi->destinateur )
                                                            {{ $user->name }} 
                                                        @endif
                                                        @endforeach 
                                                    </td>

													<td><span  class="label label-success">{{ $oi->etat }}</span></td>
									
                                                    <td>{{ $oi->commentaire }}</td>

													@if (Auth::user()->role == "Administrateur")
                                                    <td>
			 
													<p> <a href="{{ route('download.document', ['document' => $oi->document]) }}">voir le rapport </a></p>
													@endif
													</td>
                                                    
													@if (Auth::user()->role == "Administrateur")
													<td><a  data-toggle="tooltip" data-placement="top" title="Modifier" class='btn btn-primary'  href="/ointervention/change/{{ $oi->id }}"><i class="lnr lnr-pencil"></i> </a> 
														<a  data-toggle="tooltip" data-placement="top" title="supprimer" class='btn btn-danger' href="/ointervention/supprimer/{{ $oi->id  }}"><i class="lnr lnr-trash"></i></a></td>
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
										<div class="col-md-6 text-right"><a href="/di" class="btn btn-primary">Effacer la recherche</a></div>
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
