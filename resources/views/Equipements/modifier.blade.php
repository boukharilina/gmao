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
							<h3 class="panel-title"><i class="lnr lnr-laptop-phone"></i> Gestion des equipements</h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('d')." ".date('M')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
                                
								<div class="panel-heading">
									<h3 class="panel-title"> Modifier un equipement   </h3>
								</div>
                                
								<div class="panel-body">
                                @if( session()->get( 'adduser' ) == "success" )
                                <div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> Utilisateur ajouter avec success <a href="/users" class="btn btn-sm btn-default"> Consulter liste des utilisateurs </a>
								</div>
                                @endif
                                <form action='/modequipement/{{ $equipement->id }}' method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }} 
                                         
                                                            <div class="row">
                                                            
                                                                <div class="col-md-3">
                                                                    <label > Code </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $equipement->name }}"  type="text" name="code">
                                                                    
                                                                </div>
                                                                <div class="col-md-3">
                                                                <label > Modele du machine</label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $equipement->modele }}" type="text" name="modele">
                                                                
                                                                </div>

                                                                <div class="col-md-3">
                                                                <label > <label> Marque du machine </label> </label>
                                                                   
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $equipement->marque }}" type="text" name="marque">
                                                                
                                                                </div>
                                                                
                                                                <div class="col-md-3">
                                                                    <label > <label> Désignation </label> </label>  
                                                                 </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $equipement->designation }}" type="text" name="designation">
                                                                    
                                                                </div>

                                                                <div class="col-md-3">
                                                                <label> Numéro Série </label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $equipement->numserie}}" type="text" name="numserie">
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label> Date Mise en Service </label>       
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input min="{{ Carbon\Carbon::now() }}" style="width:100%;margin-bottom:10px;" value="{{ $equipement->date_service}}" type="date" name="date_service" class="form-control" >
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label> Durée Planing Préventif/an  </label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control" value="{{ $equipement->plan_prev}}" type="number" name="plan_prev">
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label> Client </label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                <select name="eq_client" class="form-control">
                                                                     <option>-- selectionner un client --</option>
                                                                        @foreach( $clients as $client )
                                                                            @if ($client->id == $equipement->client )
                                                                        <option selected value='{{ $client->id }}'>{{ $client->name }}</option>
                                                                            @else
                                                                        <option value='{{ $client->id }}'>{{ $client->name }}</option>
                                                                           @endif
                                                                        
                                                                        @endforeach
                                                                    </select> 
                                                                </div>

                                                                <div class="col-md-3">
                                                                <label> Documentation du machine </label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <input style="width:100%;margin-bottom:10px;" class="form-control"  type="file" name="document">
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
