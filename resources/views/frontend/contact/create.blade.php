@extends('frontend.layout.main')

@section('title','Contact Us')

@section('content')

<div class="container" style="background-color: #fff;">

    <div class="container head-padding">
        <section>
            <div class="row">
                <div class="col-md-9">
                    <h2 class="page-title-color">@yield('title')</h2>

                    <div class="row">
                        <div class="col-sm-4">

                            <p class="text-justify">
                                <span class="fa fa-map-marker fa-2x text-danger"></span>
                                <strong>CNA Head Office Port Harcourt:</strong>
                            </p>
                                Clean Nigeria Associates Ltd/Gte
                                Nigeria Ports Authority (NPA)
                                Port Harcourt, Rivers State, Nigeria.
                            </p>
                            <p class="text-justify">
                                <span class="fa fa-envelope-o fa-2x"></span>
                                enquiry@cleannigeria.org
                            </p>


                            {{-- <p class="text-justify">
                                <span class="fa fa-phone fa-2x"></span>
                                +234 814 302 8445
                            </p> --}}


                        </div>
                        <div class="col-sm-8">
                            <p class="text-justify">
                                Please, fill the form below to reach us.
                            </p>
                            <p>
                                @include('frontend.messages.success')
                            </p>
                            <div class="panel panel-success">
                                <div class="panel-body">

                                    <form action="{{ route('contactus.save') }}" method="post">
                                        @csrf
                                        @honeypot
                                        <div class="form-group">
                                            <label for="sender">Full Name <i style="color: #ff0000;">*</i></label>
                                            <input type="text" class="form-control{{ $errors->has('sender') ? ' is-invalid' : '' }}" id="sender" name="sender"
                                                placeholder="Your Full Name" autofocus>
                                            @if ($errors->has('sender'))
                                            <span class="invalid-feedback" role="alert">
                                                <span
                                                    style="color: red">{{ $errors->first('sender','Enter Sender\'s name') }}</span
                                                    style="color: red">
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email <i style="color: #ff0000;">*</i></label>
                                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email"
                                                placeholder="Your Email Address" autofocus>
                                                @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <span
                                                        style="color: red">{{ $errors->first('email','Enter Email Address') }}</span
                                                        style="color: red">
                                                </span>
                                                @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Category <i style="color: #ff0000;">*</i></label>
                                            <select name="category" class="form-control" required>
                                                <option selected="disabled">Select Category</option>
                                                <option value="Individual">Individual</option>
                                                <option value="Organization">Organization</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="subject">Subject <i style="color: #ff0000;">*</i></label>
                                            <input type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" id="subject" name="subject"
                                                placeholder="Your Message Subject" autofocus>
                                            @if ($errors->has('subject'))
                                            <span class="invalid-feedback" role="alert">
                                                <span
                                                    style="color: red">{{ $errors->first('subject','Enter Subject or Title') }}</span
                                                    style="color: red">
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="msgbody">Body <i style="color: #ff0000;">*</i> </label>
                                            <textarea type="text" class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" id="body" name="body" rows="7"
                                                placeholder="Your Message Body"></textarea>
                                            @if ($errors->has('body'))
                                            <span class="invalid-feedback" role="alert">
                                                <span
                                                    style="color: red">{{ $errors->first('body','Enter messasge body') }}</span
                                                    style="color: red">
                                            </span>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-success">Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>


                    <br /><br />
                </div>

                <div class="col-md-3 text-justify">
                    <div class="col-sm-12">
                        @include('frontend.layout.sidebar')
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>


@endsection
