@extends('layouts.app')
@section('content')



		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="lnr lnr-user"></i> Gestion du compte</h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('M')." ".date('d')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
                                
								<div class="panel-heading">
									<h3 class="panel-title"> Modifier : <span class="text-primary">{{ Auth::user()->name }}</span>   </h3>
								</div>
                                
								<div class="panel-body">
                                @if( session()->get( 'adduser' ) == "success" )
                                <div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> Utilisateur modifié avec success <a href="/users" class="btn btn-sm btn-default"> Consulter liste des utilisateurs </a>
								</div>
                                @endif
                                <form action='/modprofile' method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }} 
                                         
                                                            <div class="row">
                                                            
                                                                <div class="col-md-3">
                                                                <label > Nom utilisateur </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" value="{{ Auth::user()->name }}" class="form-control"  type="text" name="username">
                                                                
                                                                </div>
                                                                <div class="col-md-3">
                                                                <label > Matricule </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ Auth::user()->matricule }}" type="text" name="usermat">
                                                                
                                                                </div>
                                                                <div class="col-md-3">
                                                                <label > <label> Email utilisateur </label> </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ Auth::user()->email }}" type="email" name="usermail">
                                                                
                                                                </div>
                                                                <div class="col-md-3">
                                                                <label> Mot de passe </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ Auth::user()->password }}" type="password" name="userpw">
                                                                
                                                                </div>
                                                                <div class="col-md-3">
                                                                <label> Repeter mot de passe </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ Auth::user()->password }}" type="password" name="userrpw">
                                                                
                                                                </div>
                                                               
                                                                <div class="col-md-3">
                                                                <label> Avatar utilisateur </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <input style="width:100%;margin-bottom:10px;" name="avatar" class="form-control" type="file" >
                                                                </div>
                                                                <div class="col-md-3">
                                                                <label> Date de naissance  </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <input style="width:100%;margin-bottom:10px;" value="{{ Auth::user()->birthdate }}" name="birthdate" class="form-control" type="date" >
                                                                </div>
                                                                <div class="col-md-3">
                                                                <label> Telephone utilisateur </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <input style="width:100%;margin-bottom:10px;" value="{{ Auth::user()->phone }}" name="phone" class="form-control" type="text" >
                                                                </div>
                                                                <div class="col-md-3">
                                                                <label> Description utilisateur </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <textarea style="width:100%;margin-bottom:10px;height:100px" class="form-control" name="description">{{Auth::user()->description}}</textarea>
																</div>
																
																<div class="col-md-3">
                                                                <label> Departement </label>
                                                                
																</div>
																
                                                                <div class="col-md-9">
                                                                	<select name="iddep" class="form-control">
																		<option>-- selectionner un departement --</option>
																			@foreach( $departments as $dep )
																			@if ( $dep->id == Auth::user()->iddep )
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
	


@endsection
