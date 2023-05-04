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
                                                            
															<a style="width:100%"  class="btn btn-primary" href="/conversation/{{ $user->id }}">{{ $user->name }} </a>
														@endforeach
											</div>
											<div class="col-md-9">
														<h3 class="panel-title">   Conversation avec 
                                                        @foreach( $users as $user )
                                                            @if ( $user->id == $iddestination )
                                                            <span style="color:orange;" > " {{ $user->name }} " </span> 
                                                            @endif
														@endforeach </h3>
														<hr>
                                                        <br>
                                                        @foreach($messagesConv as $message)
                                                            @if ( $message->iddestination == Auth::user()->id )
                                                            @foreach( $users as $user )
                                                                @if ( $user->id == $iddestination )
                                                                  {{ $user->name }}  
                                                                @endif
                                                            @endforeach 
                                                            <div class="alert alert-success" >
                                                            
                                                         {{ $message->content }}
                                                        <span style="font-size:10px;margin-top:12px;position:relative;float:right;">{{ $message->created_at }}</span>
                                                            </div>
                                                            
                                                            
                                                            @else
                                                            <span style="position:relative;float:right;margin-right:10px;"> vous </span>
                                                            <br> 
                                                            <div class="alert alert-info">
                                                                {{ $message->content }}  <span style="font-size:10px;margin-top:12px;position:relative;float:right;">{{ $message->created_at }}</span>  
                                                            </div>	
                                                            @endif
                                                                
                                                        @endforeach
                                                        
														

														<div class="row" style="padding:15px;">
                                                            <form action="/addmessage" method="POST">
                                                                {{ csrf_field() }}
																<textarea class="form-control" name="content"></textarea>
																<input type="hidden" name="iddestination" value="{{ $iddestination }}">
																<br>
																<input type="submit" class="btn btn-primary" value="envoyer">
															</form> 
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
