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
                            <h3 class="panel-title"><i class="lnr lnr-file-empty"></i> Liste des Conversations </h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('M')." ".date('d')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">   Conversations  </h3>
									<hr>
								</div>
								<div class="panel-body">
										<div class="row">
											<div class="col-md-3" style="display:block;">
											<h3 class="panel-title">   Utilisateurs  </h3>
														<hr>
														@foreach( $users as $user )
															<a style="width:100%"  class="btn btn-primary" href="/conversation/{{ $user->id }}">{{ $user->name }}  </a>
														@endforeach
											</div>
											<div class="col-md-9">
														<h3 class="panel-title">   Messages  </h3>
														<hr>
														<br>
														<div class="alert alert-success">
															Selectionner un utilisateur pour commencer une conversation ...
														</div>
														
					
											</div>
										</div>
														
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
