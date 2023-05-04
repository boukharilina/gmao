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
                            <h3 class="panel-title"><i class="lnr lnr-laptop-phone"></i> Gestion des Modalités </h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('d')." ".date('M')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title"> Modalité : {{ $modalite->name }} </h3>
                                    @if (Auth::user()->role == "Administrateur")
                                    <td class="table-info"><a  data-toggle="tooltip" data-placement="top" title="Modifier" class='btn btn-primary'  href="/modalite/change/{{ $modalite->id }}"><i class="lnr lnr-pencil"></i></a> 
                                        <a  data-toggle="tooltip" data-placement="top" title="supprimer" class='btn btn-danger' href="/modalite/delete/{{ $modalite->id  }}"><i class="lnr lnr-trash"></i></a>
                                        <a href="/modalites/{{ $modalite->id }}/equipements/create" class="btn btn-info">Ajouter Equipement</a>   
                                    </td>
                                    
                                        
                                    @endif
								</div>

                                <div class="row">
                            </div>                            
                            </div>  
                        </div>
                        <!--LISTE DES EQUIPEMENTS-->
                           
                            <h3  class="text-info"> Liste des Equipements</h3>
                            <div>
                                <form action="{{ route('detect') }}" method="GET">
                                    <input type="text" name="query" placeholder="Recherche...">
                                    <button type="submit">Rechercher</button> 
                                </form>
                                </div>
                                <div  class="panel-body">
                                      <!-- nav search--> 
                                  
                                <table class="table table-striped">
                                  
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Désignation</th> 
                                          <th>Numéro De Série</th>
                                          <th>Modèle</th>
                                          <th>Client</th>
                                          
                                          @if (Auth::user()->role == "Administrateur")
                                          <th>Action</th>
                                          @endif
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php $i=0; ?>
                                  @foreach($equipements as $equipement)
                                  <?php $i++; ?>
                                  <tr>
                                      <td>{{ $i }}</td>
                                      <td><a href="/equipement/{{ $equipement->id }}">{{ $equipement->designation }}</a></td>
                                      <td>{{ $equipement->numserie}}</td>
                                      <td>{{ $equipement->modele }}</td>
                                      <td>@foreach($clients as $client )
                                        @if ($equipement->client == $client->id )
                                            {{ $client->name }}
                                        @endif   
                                        @endforeach </td>
                                      <td>    
                                        @if (Auth::user()->role == "Administrateur") 
                                        <a data-toggle="tooltip" data-placement="top" title="Modifier" class='btn btn-primary'><i class="lnr lnr-pencil"href="/equipement/mod/{{ $equipement->id }}" ></i></a>
                                        <a data-toggle="tooltip" data-placement="top" title="supprimer" class='btn btn-danger'><i class="lnr lnr-trash" href="/equipement/del/{{ $equipement->id }}"></i></a></td>
                                        @endif 
                                
                                  </tr>
                                  @endforeach 
                                  </tbody>
                                </table>
                                </div>
                              <!--FIN LISTE DES EQUIPEMENTS-->
  
    
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
  