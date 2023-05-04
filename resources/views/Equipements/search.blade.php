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
									<h3 class="panel-title"> Liste des équipements </h3>
								</div>
									<!-- nav search--> 
									<form action="{{ route('detect') }}" method="GET">
										<input type="text" name="query" placeholder="Recherche...">
										<button type="submit">Rechercher</button> 
									</form>
									
								<div class="panel-body">
							
                            <div class="row">
                            @foreach($equipements as $equipement)
                                  <div class="col-md-4">
                                    <!-- PANEL NO PADDING -->
                                    <div class="panel">
                                          <div  class="panel-heading">
                                            <h3 class="table-info"  class="panel-title"><a href="/equipement/{{ $equipement->id }}">{{ $equipement->designation }}</a></h3>
                                          
                                          </div>
                                        
                                    </div>
                                    <!-- END PANEL NO PADDING -->
                                  </div>
                                  @endforeach
                            </div>                            
                                             
                                </div>
                    	</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-6"></div>
										<div class="col-md-6 text-right"><a href="/equipements" class="btn btn-primary">Effacer la recherche</a></div>
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
		
		<div class="clearfix"></div>
	<footer>
		<div class="container-fluid">
			<p class="copyright">&copy; 2023 <a href="/" target="_blank">STIET</a>.</p>
		</div>
	</footer>
</div>
<!-- END WRAPPER -->
	


@endsection
