
@extends('layouts.app')

@section('content')
<!-- WRAPPER -->
<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="/">GMAO STIET</a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				
				
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
							<i class="lnr lnr-envelope"></i>
							
						
							<span class="badge bg-danger"> {{ count($messages) }} </span>
							 
						</a>
						
						
						<ul class="dropdown-menu notifications">
							@foreach($messages as $message)
							<li><a href="/conversation/{{ $message->idsender }}" class="notification-item"><span class="dot bg-warning"></span> 
							@foreach($users as $user)
								@if ( $user->id == $message->idsender)
									{{ $user->name }}	: 
								@endif
							@endforeach
							
							
							<span class="text-danger">" {{ $message->content}} "</span> </a></li>
							@endforeach
							<li><a href="/messages" class="more">Ouvrir la boite de messagerie</a></li>
						</ul>
				
						
					</li>
			
					<li class="dropdown">
						<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
							<i class="lnr lnr-alarm"></i>
							
						@if( count($notifications) > 0 ) 
							<span class="badge bg-danger">{{ count($notifications) }} </span>
							@endif 
						</a>
						
						@if( count($notifications) > 0 ) 
						<ul class="dropdown-menu notifications">
							@foreach ($notifications as $not )
							<li style="display:flex;"><a  class="notification-item"><span class="dot bg-warning"></span>{{ $not->content }}</a><a style="position:relative;float:right;" href="/notification/seen/{{ $not->id }}">Lue</a></li>
							@endforeach
							
						</ul>
				
						@endif 		
					</li>
			
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							@if (Auth::user()->avatar == NULL )
								<img src=" {{ asset('img/user.png') }}" class="img-circle" alt="Avatar">
								@else 
								<img src=" {{ asset('uploads/profile/'.Auth::user()->avatar) }}" class="img-circle" alt="Avatar">	
								@endif <span>{{ Auth::user()->name }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								
								<li><a href="/profile"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
								<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                </form>
							</ul>
						</li>
						
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
			<nav>
					<ul class="nav">
                        <li><a href="/homet" class="active"><i class="lnr lnr-home"></i> <span>Ordre d'Intervention</span></a></li>
						<li><a href="/profile" ><i class="lnr lnr-user"></i> <span>Compte</span></a></li>
						<li>
							<a  href="#subusers" data-toggle="collapse" class="collapsed"><i class="lnr lnr-users"></i> <span>Utilisateurs</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								
								<div id="subusers" class="collapse ">
									<ul class="nav">
									@if (Auth::user()->role == "Administrateur")
										<li> <a href="/user/add" class=""><i class="lnr lnr-file-add"></i> Ajouter</a></li>
									@endif
										<li> <a href="/users" class=""><i class="lnr lnr-list"></i> Liste</a></li>
										
									</ul>
								</div>
							 </li>
	
							<li>
							<a href="#subeqpmt"  data-toggle="collapse" class="collapsed"><i class="lnr lnr-laptop-phone"></i> <span>Equipements</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								
								<div id="subeqpmt" class="collapse ">
									<ul class="nav">
									@if (Auth::user()->role == "Administrateur")
										<li> <a href="/equipement/add" class=""><i class="lnr lnr-file-add"></i> Ajouter</a></li>
									@endif
										<li> <a href="/equipements" class=""><i class="lnr lnr-list"></i> Liste</a></li>
										
									</ul>
								</div>
							</li>
							<li>
							<a href="#subdepartments" data-toggle="collapse" class="collapsed"><i class="lnr lnr-store"></i> <span>Départements</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
	
								<div id="subdepartments" class="collapse ">
								<ul class="nav">
									@if (Auth::user()->role == "Administrateur")
									<li> <a href="/department/create" class=""><i class="lnr lnr-file-add"></i> Ajouter</a></li>
									@endif
									<li> <a href="/departments" class=""><i class="lnr lnr-list"></i> Liste</a></li>
	
								</ul>
								</div>
							</li>
	
							<li>
							<a href="#subdi"  data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Demande Intervention</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								
								<div id="subdi" class="collapse ">
									<ul class="nav">
									@if (Auth::user()->role == "Administrateur")
										<li> <a href="/di/add" class=""><i class="lnr lnr-file-add"></i> Ajouter</a></li>
										<li> <a href="/di/add" class=""><i class="lnr lnr-file-add"></i> Historique</a></li>
									@endif
										<li> <a href="/di" class=""><i class="lnr lnr-list"></i> Liste</a></li>
										
									</ul>
								</div>
							</li>
	
							<li>
							<a href="#submp" class="active" data-toggle="collapse" class="collapsed"><i class="lnr lnr lnr-cog"></i> <span>Maintenance Préventive</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								
								 <div id="submp" class="collapse ">
									<ul class="nav">
									@if (Auth::user()->role == "Administrateur")
										<li> <a href="/mp/add" class=""><i class="lnr lnr-file-add"></i> Ajouter</a></li>
									@endif
										<li> <a href="/mp" class=""><i class="lnr lnr-list"></i> Liste</a></li>
										
									</ul>
								</div>
							</li>
	
							<li>
							<a href="/pm" class=""><i class="lnr lnr-calendar-full"></i> <span>Plan De Maintenance</span></a>
							</li>
	
							<li>
							<a href="#subcm"  data-toggle="collapse" class="collapsed"><i class="lnr lnr lnr-license"></i> <span>Contrats Maintenance</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								
								<div id="subcm" class="collapse ">
								   <ul class="nav">
								   @if (Auth::user()->role == "Administrateur")
									   <li> <a href="/cm/create" class=""><i class="lnr lnr-file-add"></i> Ajouter</a></li>
								   @endif
									   <li> <a href="/cm" class=""><i class="lnr lnr-list"></i> Liste</a></li>
									   
								   </ul>
							   </div>
							</li>
	
							<li>
							<a href="#subclients" data-toggle="collapse" class="collapsed"><i class="lnr lnr-store"></i> <span>Gestion Clients</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
		
								<div id="subclients" class="collapse ">
									<ul class="nav">
										@if (Auth::user()->role == "Administrateur")
										<li> <a href="/client/create" class=""><i class="lnr lnr-file-add"></i> Ajouter</a></li>
										@endif
										<li> <a href="/clients" class=""><i class="lnr lnr-list"></i> Liste</a></li>
		
									</ul>
								</div>
							</li>
	
							<li>
							<a href="#submodalites" data-toggle="collapse" class="collapsed"><i class="lnr lnr-store"></i> <span>Modalités</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
		
								<div id="submodalites" class="collapse ">
								<ul class="nav">
									@if (Auth::user()->role == "Administrateur")
									<li> <a href="/modalite/create" class=""><i class="lnr lnr-file-add"></i> Ajouter</a></li>
									@endif
									<li> <a href="/modalites" class=""><i class="lnr lnr-list"></i> Liste</a></li>
		
								</ul>
							</li>
						
						
               
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
						<!-- OVERVIEW -->
                        <div class="panel panel-headline">
						<div class="panel-heading">
                            <h3 class="panel-title"><i class="lnr lnr-users"></i> Gérer la Liste des Maintenances </h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('M')." ".date('d')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									
								</div>
								<div class="panel-body">
                                     <br>
                                     <hr>
                                     <h4 class="text-light bg-dark" class="panel-title"> Liste des Ordres d'Interventions </h4>
								     <hr>
                                     <br>
                                     <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        
														<th>#</th>
                                                        <th>N° Intervention</th>
                                                        <th>Equipement</th>
														<th>Client</th>
														<th>Panne/Mission</th>
														<th> Priorité </th>
														<th>Etat</th>
                                                        <th> Commentaire </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=0; ?>
                                                @foreach( $ointerventions as $oi )
                                                <?php $i++; ?>
                                                <tr>                                                                                                                                           <tr>
													<td>{{ $i }}</td>
                                                    <td> {{ $oi->numero }} </td>
                                                    <td>
                                                    @foreach( $equipements as $eq )
                                                         @if ($eq->id == $oi->idmachine)
                                                            {{ $eq->designation }} 
                                                         @endif
                                                    @endforeach </td>
													<td>
														@foreach( $clients as $client )
															 @if ($client->id == $oi->idclient)
																{{ $client->name }} 
															 @endif
														@endforeach </td>
                                                    <td> {{ $oi->type_panne }} </td>
													<td>
														@if ( $oi->priorite == "Normale")
															<span class="label label-success">{{ $oi->priorite }}</span>
														@elseif ( $oi->priorite == "Urgent" )
														<span class="label label-warning">{{ $oi->priorite }}</span>
														@else
														<span class="label label-danger">{{ $oi->priorite }}</span>
	
														@endif
													</td>

													<td>
														@if ( $oi->etat == "Demandé")
															<span class="label label-info">{{ $oi->etat }}</span>
														@elseif ( $oi->etat == "En Cours" )
														<span class="label label-warning">{{ $oi->etat }}</span>
														@else
														<span class="label label-danger">{{ $oi->etat }}</span>
	
														@endif 
													</td>
													
                                                    <td> {{ $oi->commentaire }} </td>
                                            
                                                
                                                    <td><a class='btn btn-primary btn-sm' href="/otoi/show/{{ $oi->id }}"> <i class="lnr lnr-highlight"></i> Démarrer </a>
														<a class='btn btn-secondary btn-sm' href="/otoi/mod/{{ $oi->id }}"> <i class="lnr lnr-pencil"></i> Modifier </a></td>
                                                    
                                                </tr>
                                                 @endforeach
                                                </tbody>
                                            </table>
                                      
									<!-- END TABLE STRIPED -->
									<hr>
                                     <h4 class="text-light bg-dark" class="panel-title"> Liste des Maintenances Préventives   </h4>
								     <hr>
                                     <br>
                                     <table class="table table-striped">
                                                <thead>
                                                    <tr>
														<th>#</th>
                                                        <th>N° Intervention</th>
                                                        <th>Equipement</th>
														<th>Client</th>
														<th>Intervenant</th>
														<th>Prochaine Execution</th>
														<th>Etat</th>
														<th>Commentaire </th>
														<th>Action </th>
													
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=0; ?>
                                                @foreach( $allmpreventives as $amp )
                                                <?php $i++; ?>
                                                <tr>                                                                                  
                                                    <td>{{ $i }}</td>
                                                    <td> {{ $amp->numero }} </td>
													<td>
													@foreach( $equipements as $eq )
														@if ($eq->id == $amp->idmachine)
															{{ $eq->designation }} 
														@endif
													@endforeach </td>

													<td>
													@foreach( $clients as $client )
													    @if ($client->id == $amp->idclient)
															{{ $client->name }} 
														@endif
													@endforeach </td>

													<td> 
													@foreach($techniciens as $technicien )
														@if ( $technicien->id == $amp->executeur )
																{{ $technicien->name }} 
														@endif
													@endforeach
													</td>

													<td>{{ $amp->date_execution }}</td>

													<td>
														@if ( $amp->etat == "Programé")
															<span class="label label-info">{{ $amp->etat }}</span>
														@elseif ( $amp->etat == "En Cours" )
														<span class="label label-warning">{{ $amp->etat }}</span>
														@else
														<span class="label label-danger">{{ $amp->etat }}</span>
	
														@endif 
													</td>

													<td> {{ $amp->commentaire }} </td>
												
													<td><a class='btn btn-primary' href="/otmp/historique/{{ $amp->id }}">Consulter</a></td>
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




