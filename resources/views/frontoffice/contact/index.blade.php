@extends('frontoffice.layout.index')

@section('title', 'CONTACT')

@section('content')
    <!--HOME SECTION END-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2><strong> LOCATION </strong></h2>
                    <br />
                    <h4>345/DC, New York State,</h4>
                    <h4>The Lane Tower Road,</h4>
                    <h4>United States-201-900-590.</h4>
                    <br />
                    <h4><i>Email: </i>info@domain.com</h4>
                    <h4><i>Call:</i> +1-908-78-55-5555</h4>
                </div>
                <div class="col-md-6">

                    <div class="alert alert-info">
                        <div class="form-group">
                            <strong>QUICK QUERY FORM</strong>
                            <br />
                            <label></label>
                            <input type="text" class="form-control" placeholder="Enter Your Name" />
                            <label></label>
                            <input type="text" class="form-control" placeholder="Enter Your Email" />
                            <label></label>
                            <textarea class="form-control" placeholder="Enter Your Project Details and Budget in USD"
                                rows="5"></textarea>
                            <br />
                            <a href="#" class="btn btn-primary">SEND QUERY</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
