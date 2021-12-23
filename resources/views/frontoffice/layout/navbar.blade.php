<!--MENU SECTION START-->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('frontoffice.home') }}"><strong>CRISM</strong> <br /> <small>services</small></a>
        </div>
        <div class="navbar-collapse collapse move-me">
            <ul class="nav navbar-nav navbar-right set-links">
                <li><a href="{{ route('frontoffice.home') }}">Inicio</a></li>
                <li><a href="{{ route('frontoffice.about') }}">Nosotros</a></li>
                <li><a href="{{ route('frontoffice.pricing') }}">Planes</a></li>
                {{-- <li><a href="{{ route('frontoffice.ftp') }}">Subida FTP</a></li> --}}
                @auth
                    <li><a href="{{ route('frontoffice.blank') }}">Mi Cuenta</a></li>
                @else
                    <li><a href="{{ route('frontoffice.blank') }}">Iniciar Sesión</a></li>
                @endauth
            </ul>
        </div>

    </div>
</div>
<!--MENU SECTION END-->
