@extends('frontoffice.layout.index')

@section('content')
    <section class="headline-sec">
        <div class="overlay ">
            <h3>SUBIDA FTP <i class="fa fa-angle-double-right "></i></h3>

        </div>
    </section>
    <!--HOME SECTION END-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="min-height:800px;">
                    <div class="panel panel-default ftp-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Subida FTP</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="alert alert-info lead">
                                        <i class="fa fa-info-circle"></i> Use los siguientes datos de conexión para la
                                        subida de su sitio mediante FTP.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="domain">Dominio</label>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="domain" class="form-control" type="text" value="" readonly></input>

                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default copy"
                                                title="Copiar al portapapeles">
                                                <i class="fa fa-clipboard"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="port">Puerto</label>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="port" class="form-control" type="text" value="21" readonly />

                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default copy"
                                                title="Copiar al portapapeles">
                                                <i class="fa fa-clipboard"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="user">Usuario</label>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="user" class="form-control" type="text" value="JohnDoe" readonly />

                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default copy"
                                                title="Copiar al portapapeles">
                                                <i class="fa fa-clipboard"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="password">Contraseña</label>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="password" class="form-control" type="password" value="johndoe123"
                                            readonly />

                                        <span class="input-group-btn">
                                            <button id="togglePassword" type="button" class="btn btn-default"
                                                title="Mostrar/ocultar contraseña">
                                                <i class="fa fa-eye-slash"></i>
                                            </button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default copy"
                                                title="Copiar al portapapeles">
                                                <i class="fa fa-clipboard"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
    </section>
    <section id="footer-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>ABOUT COMPANY</h4>
                    <p style="padding-right:50px;">
                        Nunc at viverra risus.
                        In euismod quam ac dictum varius.
                        Nunc at viverra risus.
                        In euismod quam ac dictum varius.
                        Nunc at viverra risus.
                        In euismod quam ac dictum varius.
                        Nunc at viverra risus.
                        Nunc at viverra risus. <a href="about.html">more..</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h4>PHYSICAL LOCATION </h4>
                    <h5>345/DC, New York State,</h5>
                    <h5>The Lane Tower Road,</h5>
                    <h5>United States-201-900-590.</h5>
                    <br />
                    <h5><strong>Email:</strong> info@domain.com</h5>
                    <h5><strong>Call:</strong> +1-908-78-55-5555</h5>

                </div>
                <div class="col-md-4">
                    <h4>SOCIAL LINKS</h4>
                    <div class="social-links">


                        <a href="#"> <i class="fa fa-facebook fa-2x"></i></a>
                        <a href="#"> <i class="fa fa-twitter fa-2x"></i></a>
                        <a href="#"> <i class="fa fa-linkedin fa-2x"></i></a>
                        <a href="#"> <i class="fa fa-google-plus fa-2x"></i></a>
                        <a href="#"> <i class="fa fa-github fa-2x"></i></a>
                        <a href="#"> <i class="fa fa-digg fa-2x"></i></a>
                        <a href="#"> <i class="fa fa-dropbox fa-2x"></i></a>
                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection
