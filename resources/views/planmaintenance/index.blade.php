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
                            <h3 class="panel-title"><i class="lnr lnr-calendar-full"></i> Plan de Maintenance </h3>
							<p class="panel-subtitle">Aujourd'hui : <?php echo date('M')." ".date('d')." , ".date('Y'); ?> </p>
						</div>
						<div class="panel-body">
                        <div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">@isset($searchuser) Resultat de recherche pour : <span class="text-primary"> " {{ $searchuser }} "</span> @else Plan de Maintenance @endisset </h3>
								</div>
								<div class="panel-body">
								
                                   
                                <div id='calendar'></div> 
                                    
                                </div>
                    	</div>
								<div class="panel-footer">
									
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

<script src="{{ asset('packages/core/main.js') }}"></script>
<script src="{{ asset('packages/core/locales-all.js') }}"></script>
<script src="{{ asset('packages/interaction/main.js') }}"></script>
<script src="{{ asset('packages/daygrid/main.js') }}"></script>
<script src="{{ asset('packages/timegrid/main.js') }}"></script>
<script src="{{ asset('packages/list/main.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
		
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
     
      locale:"fr",
      buttonIcons: false, // show the prev/next text
      weekNumbers: true,
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
		@foreach($ointerventions as $oi)
        {
          title: '{{ $oi->numero }}',
          start: '{{ $oi->created_at }}'
		
        },
		@endforeach
		
		

	
       
		  @foreach($maintenances as $maintenance)
		{
			@foreach($mpreventives as $mp)
			@foreach($clients as $client) 
			@foreach($equipements as $equipement)
			@if (( $maintenance->idmp == $mp->id) &&($mp->idclient == $client->id) &&($mp->idmachine == $equipement->id))
	            
		
					title: '{{$client->name.'---'.$equipement->designation  }}',
				
			@endif
			@endforeach
			@endforeach
			@endforeach
			
			
		
          start: '{{ $maintenance->date_maintenance }}'
		  
        },
		@endforeach
	
      ]
    });

    calendar.render();

    

  });

</script>
