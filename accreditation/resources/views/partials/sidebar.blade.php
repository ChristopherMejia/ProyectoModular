
	<nav class="side-navbar">
		<div class="sidebar-header d-flex align-items-center justify-content-center p-3 mb-3">
			<!-- User Info-->
			<div class="sidenav-header-inner text-center"><img class="img-fluid rounded-circle avatar mb-3" src="img/avatar-7.jpg" alt="person">
			<h2 class="h5 text-white text-uppercase mb-0">{{ Auth::user()->first_name}} {{Auth::user()->last_name}}</h2>
			<p class="text-sm mb-0 text-muted">Web Developer</p>
			</div>
			<!-- Small Brand information, appears on minimized sidebar--><a class="brand-small text-center" href="index.html">
			<p class="h1 m-0">EC</p></a>
		</div>
      	<!-- Sidebar Navigation Menus--><span class="text-uppercase text-gray-500 text-sm fw-bold letter-spacing-0 mx-lg-2 heading">Menu</span>
		<ul class="list-unstyled">
			<li class="sidebar-item"><a class="sidebar-link" href="index.html"> 
				<svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
				<use xlink:href="#real-estate-1"> </use>
				</svg>Home </a>
			</li>
			@if (Auth::user()->role_id == 1)
			<li class="sidebar-item"><a class="sidebar-link dropdown-toggle" href="#usuarios" data-toggle="collapse"> 
				<svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
				<use xlink:href="#browser-window-1"> </use>
				</svg>Usuarios </a>
				<ul class="collapse list-unstyled " id="usuarios">
					<li><a class="sidebar-link" href="#">Desplegar Usuarios</a></li>
					<li><a class="sidebar-link" href="/users">Crear Usuario</a></li>
				</ul>
        	</li>
			@endif
			<li class="sidebar-item"><a class="sidebar-link dropdown-toggle" href="#plantillas" data-toggle="collapse"> 
				<svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
				<use xlink:href="#portfolio-grid-1"> </use>
				</svg>Plantillas </a>
				<ul class="collapse list-unstyled " id="plantillas">
					<li><a class="sidebar-link" href="#">Desplegar Plantillas</a></li>
					<li><a class="sidebar-link" href="#">Crear Plantilla</a></li>
				</ul>
        	</li>
			@if (Auth::user()->role_id == 1)
			

			<li class="sidebar-item"><a class="sidebar-link dropdown-toggle" href="#nivelEducativo" data-toggle="collapse"> 
			<svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
              <use xlink:href="#sales-up-1"> </use>
            </svg>Educación </a>
				<ul class="collapse list-unstyled " id="nivelEducativo">
					<li><a class="sidebar-link" href="#">Nivel Educativo</a></li>
					<li><a class="sidebar-link" href="#">Desplegar Niveles</a></li>
				</ul>
        	</li>
			
			<li class="sidebar-item"><a class="sidebar-link dropdown-toggle" href="#organismo" data-toggle="collapse"> 
			<svg class="svg-icon svg-icon-xs svg-icon-heavy me-xl-2">
              <use xlink:href="#imac-screen-1"> </use>
            </svg>Organismo</a>
				<ul class="collapse list-unstyled " id="organismo">
					<li><a class="sidebar-link" href="#">Crear Organismo</a></li>
					<li><a class="sidebar-link" href="#">Desplegar Organismo</a></li>
				</ul>
        	</li>

			@endif
		</ul>
	</nav>
    <div class="page">
	<!-- navbar -->
		<header class="header">
			<nav class="navbar">
			<div class="container-fluid">
				<div class="d-flex align-items-center justify-content-between w-100">
					<div class="d-flex align-items-center">
						<a class="menu-btn d-flex align-items-center justify-content-center p-2 bg-gray-900" id="toggle-btn" href="#">
							<svg class="svg-icon svg-icon-sm svg-icon-heavy text-white">
							<use xlink:href="#menu-1"> </use></svg>
						</a>
						<a class="navbar-brand ms-2" href="index.html">
						<div class="brand-text d-none d-md-inline-block text-uppercase letter-spacing-0">
							<span class="text-white fw-normal text-xs">Evaluación de </span><strong class="text-primary text-sm"> Carreras</strong>
						</div>
						</a>
					</div>
					<ul class="nav-menu mb-0 list-unstyled d-flex flex-md-row align-items-md-center">
						<!-- Notifications dropdown-->

						<!-- Messages dropdown-->
						
						<!-- Languages dropdown    -->
						
						<!-- Log out-->
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							<svg class="svg-icon svg-icon-xs svg-icon-heavy">
									<use xlink:href="#security-1"> </use>
								</svg>  <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('logout') }}"
									onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
									{{ __('Salir') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
									@csrf
								</form>
							</div>
						</li>
					</ul>
				</div>
			</div>
			</nav>
		</header>
	</div>




