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
                            <h3 class="panel-title"><i class="lnr lnr-store"></i> Gestion Des Départements</h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('d')." ".date('M')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">@isset($searchuser) Resultat de recherche pour : <span class="text-primary"> " {{ $searchuser }} "</span> @else Liste Des Départements @endisset </h3>
								</div>
				
								<div class="panel-body">
								@if( session()->get( 'adddepartment' ) == "deleted" )
                                <div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> Départemnt supprimé avec succès
								</div>
                                @endif
                                            <table class="table table-striped">
											<!-- nav search--> 
											<form action="{{ route('search') }}" method="GET">
											
												<input type="text" name="query" placeholder="Recherche...">
												<button type="submit">Rechercher</button> 
												
											</form>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nom Du Département</th>
                                                        <th>Description</th>
                                                        
														@if (Auth::user()->role == "Administrateur")
														<th>Action</th>
														@endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=0; ?>
                                                @foreach($departments as $dep)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $dep->name }}</td>
                                                    <td>{{ $dep->description }}</td>
                                                   @if (Auth::user()->role == "Administrateur")
                                                    <td><a class='btn btn-primary' href="/department/change/{{ $dep->id }}"><i class="lnr lnr-pencil"></i> Modifier </a> <a class='btn btn-danger' href="/department/delete/{{ $dep->id  }}"><i class="lnr lnr-trash"></i>Supprimer</a></td>
                                                    @endif
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
										<div class="col-md-6 text-right"><a href="/departments" class="btn btn-primary">Effacer la recherche</a></div>
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
