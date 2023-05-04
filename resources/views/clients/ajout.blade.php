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
									<h3 class="panel-title"> Ajouter un Client  </h3>
								</div>
                                
								<div class="panel-body">
                                @if( session()->get( '/client/add' ) == "success" )
                                <div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> Client ajouté avec success <a href="/clients" class="btn btn-sm btn-default"> Consulter la Liste des Clients </a>
								</div>
                                @endif
                                <form action='/client/add' method="POST" >
                                    {{ csrf_field() }} 
                                         
										<div class="row">
										
											<div class="col-md-3">
											<label for="validationDefault01"> Nom client/Raison sociale</label>
											
											</div>
											<div class="col-md-9">
											<input style="width:100%;margin-bottom:10px;" class="form-control" placeholder="Tapper le nom du client içi" type="text" name="clientname"  id="validationDefault01"required>
											
											</div>
											
											<div class="col-md-3">
											<label > Adresse</label>
													
											</div>
											<div class="col-md-9">
											<input style="width:100%;margin-bottom:10px;" class="form-control" placeholder="Tapper l'adresse du clientt içi" type="text" name="adresse">
													
											</div>

											<div class="col-md-3">
											<label > Email </label>
																											
											</div>
											<div class="col-md-9">
											<input style="width:100%;margin-bottom:10px;" class="form-control" placeholder="Tapper l'émail içi" type="text" name="email">
											
											</div>
											<div class="col-md-3">
												<label > Mobile</label>
												
											</div>
											<div class="col-md-9">
												<input style="width:100%;margin-bottom:10px;" class="form-control" placeholder="Tapper le numéro du client içi" type="num" name="mobile">
												
											</div>

											<div class="col-md-3">
												<label > <label  for="validationDefault02">  Equipements </label> </label>
												
											</div>
											<div class="col-md-9">
											<select style="width:100%;margin-bottom:10px;" class="form-control" class="custom-select" name="idmachine" multiple="multiple"  id="validationDefault02" required>   
											<option value="Sélectionner les équipements">Sélectionner les équipements</option>
												@foreach($equipements as $equipement )
													<option value="{{ $equipement->id }}">{{ $equipement->designation }}</option>
									
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