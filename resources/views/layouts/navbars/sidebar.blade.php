<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <div class="logo">
      <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{url('home')}}">
                    <img  src="{{ asset('material') }}/img/logo-footer.jpg"
                          height="60"/>
                </a>
            </div>
      </div>
    <a href="#" class="simple-text logo-normal">

        {{ __('Mailer Paco Javier') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons text-dark">dashboard</i>
            <p>{{ __('Inicio') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i class="material-icons text-dark">people_alt</i>
          <p>{{ __('Usuarios') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'profile' || $activePage == 'users') ? 'show' : '' }}" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('Perfil del usuario') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'users' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('users.index')}}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>


        <li class="nav-item {{ $activePage == 'zonas-management' ? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#laravelExample2" aria-expanded="true">
                <i class="material-icons text-dark">location_on</i>
                <p>{{ __('Zonas') }}
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse {{ $activePage == 'zonas' ? 'show' : '' }}" id="laravelExample2">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'zonas' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('zonas.index')}}">
                            <span class="sidebar-mini"> ZM </span>
                            <span class="sidebar-normal"> {{ __('Zonas') }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="nav-item {{ $activePage == 'clientes-management' ? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#laravelExample3" aria-expanded="true">
                <i class="material-icons text-dark">store</i>
                <p>{{ __('Clientes') }}
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse {{ $activePage == 'clientes' ? 'show' : '' }}" id="laravelExample3">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'clientes' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('clientes.index')}}">
                            <span class="sidebar-mini"> CM </span>
                            <span class="sidebar-normal"> {{ __('Clientes') }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

    </ul>
  </div>
</div>
