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
                            <h3 class="panel-title"><i class="lnr lnr-store"></i> Gestion Des Modalités</h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('d')." ".date('M')." , ".date('Y'); ?> </p>
						</div>
                        <!-- ADD--> 
						<div class="panel-body">
							<div class="row">
							<div class="col-md-12">
								<!-- TABLE STRIPED -->
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title"> Liste Des Modalités </h3>
							
									</div>
										
									<div class="panel-body">
								
								<div class="row">
								@foreach($modalites as $modalite)
									  <div class="col-md-4">
										<!-- PANEL NO PADDING -->
										<div class="panel">
											  <div  class="panel-heading">
												<h3 class="table-info"  class="panel-title"><a href="/modalite/{{ $modalite->id }}">{{ $modalite->name }}</a></h3>
											  
											  </div>
											
										</div>
										<!-- END PANEL NO PADDING -->
									  </div>
									  @endforeach
								</div>                            
												 
									</div>
								</div>

						<!-- comment table --> 
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">@isset($searchuser) Resultat de recherche pour : <span class="text-primary"> " {{ $searchuser }} "</span> @else Liste Des Modalités @endisset </h3>
								</div>
							
								
								<div class="panel-body">
								@if( session()->get( 'addmodalite' ) == "deleted" )
                                <div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> Modalité supprimée avec succèss 
								</div>
                                @endif
							
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="p-3 mb-2 bg-info text-white">#</th>
                                                        <th class="p-3 mb-2 bg-info text-white">Nom</th>
                                                        <th class="p-3 mb-2 bg-info text-white">Description</th>
                                                        
														@if (Auth::user()->role == "Administrateur")
														<th class="p-3 mb-2 bg-info text-white">Action</th>
														@endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=0; ?>
                                                @foreach($modalites as $modalite)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td class="table-info">{{ $i }}</td>
                                                    <td class="table-info"> <a href="/modalite/{{ $modalite->id }}">{{ $modalite->name }}</a></td>
                                                    <td class="table-info">{{ $modalite->description }}</td>
                                                   @if (Auth::user()->role == "Administrateur")
                                                    <td class="table-info"><a  data-toggle="tooltip" data-placement="top" title="Modifier" class='btn btn-primary' href="/modalite/change/{{ $modalite->id }}"><i class="lnr lnr-pencil"></i></a> 
                                                        <a  data-toggle="tooltip" data-placement="top" title="supprimer" class='btn btn-danger' href="/modalite/delete/{{ $modalite->id  }}"><i class="lnr lnr-trash"></i></a>
														<a href="/modalites/{{ $modalite->id }}/equipements/create" class="btn btn-info">Ajouter Equipement</a>   
													</td>
														
                                                    @endif
                                                </tr>
                                                @endforeach 
                                                </tbody>
                                            </table>
                                      
                                    <!-- END TABLE STRIPED -->
                                </div>
                    	    </div>
							 <!-- end comment--> 
								
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
