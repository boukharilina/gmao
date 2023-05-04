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
                            <h3 class="panel-title"><i class="lnr lnr-file-empty"></i> Gestion des Demandes d'Interventions</h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('d')." ".date('M')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title"> Ordre d'Intervention</h3>
								</div>
								<div class="panel-body">
								<form action='/ot/modobservation/{{ $oi->id }}' method="POST" >
                                                        {{ csrf_field() }} 
                                         
                                                            <div class="row">
                                                            
                                                                <div class="col-md-3">
                                                                <label > Date de Début </label>
                                                                
                                                                </div>
                                                                <div class="col-md-9">
                                                                <input style="width:100%;margin-bottom:10px;" class="form-control"  value="{{ $oi->date_debut}}"  type="datetime-local" name="date_debut">
                                                                
                                                                </div>
																<div class="col-md-3">
																	<label > Commentaire </label>
																			
																	</div>
																	<div class="col-md-9">
																		<input style="width:100%;margin-bottom:10px;" class="form-control"  value="{{ $oi->commentaire}}" placeholder="Ecrire une Description içi"  type="text" name="commentaire">
																			
																	</div>

																<div class="col-md-3">
                                                                    <label> Etat </label>
                                                                    
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <select style="width:100%;margin-bottom:10px;" class="form-control" name="etat">
                                                                        
                                                                        @if ( $oi->etat == "Demandée")
                                                                        <option>-- Sélectionner un Etat --</option>
                                                                        <option selected value='Demandée'>Demandée</option>
                                                                        <option value='En Cours'>En Cours</option>
                                                                        @elseif ($oi->etat == "En Cours")
                                                                        <option>-- Sélectionner un Etat --</option>
                                                                        <option selected value='En Cours'>En Cours</option>
                                                                        <option value='Suspendu'>Suspendu</option>
                                                                        @else <option>-- Sélectionner un Etat --</option>
                                                                        <option selected value='Suspendu'>Suspendu</option>
                                                                        <option value='En Cours'>En Cours</option>
                                                                        @endif

                                                                    </select>
															
                                                                </div>
                                                             
                                                               
                                                                
                                                            </div>
                                                               
                                                           
                                                            
                                      
                                    <!-- END TABLE STRIPED -->
                                </div>
                    	</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-6"></div>
										<div class="col-md-6 text-right"><input type="submit" value="valider" class="btn btn-primary"></div></form>
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