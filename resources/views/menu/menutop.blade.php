 @extends('layouts.app')
 
 <!-- NAVBAR -->
 <nav class="navbar navbar-default navbar-fixed-top">
    <div class="brand">
        <a href="/">GMAO STIET</a> 
    </div>
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
        </div>
    
        
        <div id="navbar-menu">
            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                    <i class="lnr lnr-envelope"></i>
                    
                
                    <span class="badge bg-danger"> {{ count($messages) }} </span>
                     
                </a>
                
                
                <ul class="dropdown-menu notifications">
                    @foreach($messages as $message)
                    <li><a href="/conversation/{{ $message->idsender }}" class="notification-item"><span class="dot bg-warning"></span> 
                    @foreach($users as $user)
                        @if ( $user->id == $message->idsender)
                            {{ $user->name }}	: 
                        @endif
                    @endforeach
                    
                    
                    <span class="text-danger">" {{ $message->content}} "</span> </a></li>
                    @endforeach
                    <li><a href="/messages" class="more">Ouvrir la boite de messagerie</a></li>
                </ul>
        
                
            </li>
    
            <li class="dropdown">
                <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                    <i class="lnr lnr-alarm"></i>
                    
                @if( count($notifications) > 0 ) 
                    <span class="badge bg-danger">{{ count($notifications) }} </span>
                    @endif 
                </a>
                
                @if( count($notifications) > 0 ) 
                <ul class="dropdown-menu notifications">
                    @foreach ($notifications as $not )
                    <li style="display:flex;"><a  class="notification-item"><span class="dot bg-warning"></span>{{ $not->content }}</a><a style="position:relative;float:right;" href="/notification/seen/{{ $not->id }}">Lue</a></li>
                    @endforeach
                    
                </ul>
        
                @endif 		
            </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    @if (Auth::user()->avatar == NULL )
                        <img src=" {{ asset('img/user.png') }}" class="img-circle" alt="Avatar">
                        @else 
                        <img src=" {{ asset('uploads/profile/'.Auth::user()->avatar) }}" class="img-circle" alt="Avatar">	
                        @endif <span>{{ Auth::user()->name }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        
                        <li><a href="/profile"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                                {{ csrf_field() }}
                                                                        </form>
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
</nav>
<!-- END NAVBAR -->

  
	<!-- Javascript -->
	<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
	<script src="{{ asset('vendor/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
	<script src="{{ asset('scripts/klorofil-common.js') }}"></script>