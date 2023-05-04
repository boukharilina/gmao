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
									<h3 class="panel-title">@isset($searchuser) Resultat de recherche pour : <span class="text-primary"> " {{ $searchuser }} "</span> @else Liste des utilisateurs @endisset </h3>
								</div>
								<!-- nav search--> 
								<form action="{{ route('loop') }}" method="GET">
								
									<input type="text" name="query" placeholder="Recherche...">
									<button type="submit">Rechercher<i  aria-hidden="True"></i></button> 
									
								</form>

								<div class="panel-body">
								@if( session()->get( 'adduser' ) == "deleted" )
                                <div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-check-circle"></i> Utilisateur supprimé avec success 
								</div>
                                @endif
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Nom</th>
														<th>Matricule</th>
                                                        <th>Email</th>
														<th>Phone</th>
														<th>Role </th>
														<th>Modalité </th>
														<th> Département </th>
														
														
														@if (Auth::user()->role == "Administrateur")
														<th>Action</th>
														@endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=0; ?>
                                                @foreach($users as $user)
                                                <?php $i++; ?>
                                                <tr>
                                                 
                                                    <td>{{ $user->name}}</td>
                                                    <td>{{ $user->matricule }}</td>
													<td>{{ $user->email }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ $user->role }}</td>
													<td>{{ $user->modalité }}</td>
													
													<td>
														@foreach($departments as $dep )
															@if ($user->iddep == $dep->id )
																{{ $dep->name }}
															@endif
														
														@endforeach

													</td>
													<td>{{ $user->created_at }}</td>
													
													@if (Auth::user()->role == "Administrateur")
                                                    <td><a data-toggle="tooltip" data-placement="top" title="Modifier" class='btn btn-primary' href="/user/{{$user->id}}"><i class="lnr lnr-pencil"></i>  </a> 
														<a data-toggle="tooltip" data-placement="top" title="supprimer" class='btn btn-danger' href="/user/delete/{{ $user->id }}"><i class="lnr lnr-trash"></i></a></td>
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
										<div class="col-md-6 text-right"><a href="/users" class="btn btn-primary">Effacer la recherche</a></div>
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
