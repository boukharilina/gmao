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
							<h3 class="panel-title"><i class="lnr lnr-users"></i> Gestion des utilisateurs</h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('M')." ".date('d')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
                                
								<div class="panel-heading">
									<h3 class="panel-title"> Modification : <span class="text-primary">{{ $user->name }}</span>   </h3>
								</div>
                                
								<div class="panel-body">
                                @if( session()->get( 'adduser' ) == "success" )
                                <div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> Utilisateur modifié avec success <a href="/users" class="btn btn-sm btn-default"> Consulter liste des utilisateurs </a>
								</div>
                                @endif
                                <form action='/moduser/{{ $user->id }}' method="POST" >
                                                        {{ csrf_field() }} 
                                         
                                                            <div class="row">
                                                            
                                                                <div class="col-md-3">
                                                                <label > Nom utilisateur </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" value="{{ $user->name }}" class="form-control"  type="text" name="username">
                                                                
                                                                </div>
                                                                <div class="col-md-3">
                                                                <label > Matricule </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $user->matricule }}" type="text" name="usermat">
                                                                
                                                                </div>
                                                                <div class="col-md-3">
                                                                <label > <label> Email utilisateur </label> </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $user->email }}" type="email" name="usermail">
                                                                
                                                                </div>
                                                                <div class="col-md-3">
                                                                <label> Mot de passe </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $user->password }}" type="password" name="userpw">
                                                                
                                                                </div>
                                                                <div class="col-md-3">
                                                                <label> Repeter mot de passe </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $user->password }}" type="password" name="userrpw">
                                                                
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label > Mobile </label>
                                                                    
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                    <input style="width:100%;margin-bottom:10px;" class="form-control" placeholder="Tapper le numéro ici" type="text" name="phone">
                                                                    
                                                                    </div>

                                                                <div class="col-md-3">
                                                                <label> Role utilisateur </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <select name="role" style="width:100%;margin-bottom:10px;" class="form-control">
                                                                @if ( $user->role == "Administrateur")
                                                                    <option>-- selectionner un role --</option>
                                                                    <option selected value='Administrateur'>Administrateur</option>
                                                                    <option value='Superviseur'>Superviseur</option>
                                                                    <option value='Technicien'>Technicien</option>
                                                                    <option value='Ingénieur'>Ingénieur</option>
                                                                @elseif ($user->role == "Superviseur")
                                                                    <option>-- selectionner un role --</option>
                                                                    <option value='Superviseur'>Superviseur</option>
                                                                    <option selected value='Chef Inénieur'>Ingénieur</option>
                                                                    <option selected value='Technicien'>Technicien</option>
                                                                @else
                                                                    <option>-- selectionner un role --</option>
                                                                    <option value='Administrateur'>Administrateur</option>
                                                                    <option selected value='Superviseur'>Superviseur</option>
                                                                    <option selected value='Technicien'>Technicien</option>
                                                                    <option selected value='Ingénieur'>Ingénieur</option>
                                                                
                                                                @endif
                                                                </select> 
																</div>
                                                                <div class="col-md-3">
                                                                    <label> modalité </label>
                                                                    
                                                                </div>

                                                                <div class="col-md-9">
                                                                    <select name="modalité" style="width:100%;margin-bottom:10px;" class="form-control">
                                                                            <option>-- selectionner une modalité --</option>
                                                                            <option selected value='IRM'>IRM</option>
                                                                            <option selected value='Scanner'>Scanner</option>
                                                                            <option selected value='Echographie'>Echographie</option>
                                                                            <option selected value='Salle de cathétérisme'>Salle de cathétérisme</option>
                                                                            <option selected value='Monitoring'>Monitoring</option>
                                                                           
                                                                    </select> 
                                                                </div>
                                                                
                                                                
                                                                <div class="col-md-3">
                                                                        <label > outils </label>
                                                                        
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <input style="width:100%;margin-bottom:10px;" class="form-control" placeholder="Indiquer les outils ici" type="text" name="outils">
                                                                        
                                                                </div>

																<div class="col-md-3">
                                                                <label> Departement </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <select name="iddep" class="form-control">
																	<option>-- selectionner un departement --</option>
																	@foreach( $departments as $dep )
																	@if ($dep->id == $user->iddep )
																	<option selected value='{{ $dep->id }}'>{{ $dep->name }}</option>
																	@else
																	<option value='{{ $dep->id }}'>{{ $dep->name }}</option>
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
