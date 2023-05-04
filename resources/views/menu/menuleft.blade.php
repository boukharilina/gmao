@extends('layouts.app')

<!-- LEFT SIDEBAR -->

		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
                        <li><a href="/home" ><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>

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
							<a href="#submodalites" data-toggle="collapse" class="collapsed"><i class="lnr lnr-store"></i> <span>Modalités</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
		
								<div id="submodalites" class="collapse ">
								<ul class="nav">
									@if (Auth::user()->role == "Administrateur")
									<li> <a href="/modalite/create" class=""><i class="lnr lnr-file-add"></i> Ajouter</a></li>
									@endif
									<li> <a href="/modalites" class=""><i class="lnr lnr-list"></i> Liste</a></li>
		
								</ul>
								</div>
						</li>

						<li>
                        <a href="#subeqpmt"  data-toggle="collapse" class="collapsed"><i class="lnr lnr-laptop-phone"></i> <span>Equipements</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							
                            <div id="subeqpmt" class="collapse ">
								<ul class="nav">
							
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
									<li> <a href="/di/historique" class=""><i class="lnr lnr-list"></i> Historique</a></li>
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

					

					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->

  
	<!-- Javascript -->
	<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
	<script src="{{ asset('vendor/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
	<script src="{{ asset('scripts/klorofil-common.js') }}"></script>