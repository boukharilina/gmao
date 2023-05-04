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
                            <h3 class="panel-title"><i class="lnr lnr-cog"></i> Gestion des Maintenances Préventives</h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('d')." ".date('M')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">  <span class="label label-primary"> {{ $mp->numero }} </span> </h3>
								</div>
								<div class="panel-body">
								<h4> Machine :  
								@foreach ($equipements as $equipement )
									@if ($mp->idmachine == $equipement->id )
									{{ $equipement->designation }}
									@endif
									
								@endforeach </h4>
								<h4> N°Série : 
								@foreach ($equipements as $equipement )
								@if ($mp->idmachine == $equipement->id )   
								{{ $equipement->numserie }}
								@endif
								
							    @endforeach</h4>
								<h4> Client : 
								@foreach ($clients as $client )
									@if ($mp->idclient == $client->id )   
									{{ $client->name }}
									@endif
									
								@endforeach</h4>
								<h4>Intervalle : Chaque  {{ $mp->intervalle }} {{ $mp->umesure }}</h4>
								<h4> Periode : de  " {{ $mp->date_debut }} " jusqu'a " {{ $mp->date_fin }} "  </h4>
								<table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>N° Intervention</th>
                                                        <th>Dates des Maintenances</th>
														<th>Commentaire</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                <?php $i=0; ?>
												@if (count($maintenances) > 0 )
													@foreach($maintenances as $mt)
													<?php $i++; ?>
													<tr>
													<td><a href="/m/{{ $mt->id  }}">{{  $mp->numero }} ( {{ $i  }} ) </a></td> 
												
													<td>{{ $mt->date_maintenance }}</td>

													<td>{{ $mt->observation }}</td>
														
														
													</tr>
													@endforeach 
												@endif
                                                </tbody>
                                            </table>
                                       
                                      
                                   
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
