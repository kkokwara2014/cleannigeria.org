@extends('frontend.layout.main')

@section('title','Verify Certificate')

@section('content')

<div class="container" style="background-color: #fff;">
    <div class="container head-padding">

        <section>
            <div class="row">
                <div class="col-md-9">
                    <h2 class="page-title-color">@yield('title')</h2>

                    <p class="text-justify">
                        <div class="row">
                            <div class="col-md-8">
                                {{-- @include('frontend.messages.success') --}}
                         
                                <p>Please, enter the Certificate number you want to verify.
                                </p>
                                <form action="{{ route('verify.certificate') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Certificate Number <span style="color: red;">*</span></label>
                                        
                                        <input class="form-control{{ $errors->has('certnumber') ? ' is-invalid' : '' }}" type="text" name="certnumber"
                                            placeholder="Certificate Number e.g. CCA/129/21/01" value="{{ request()->input('certnumber') }}" maxlength="14" required>
                                        @error('certnumber')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $errors->first('certnumber') }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm" type="submit">Verify</button>
                                    </div>
                                </form>
                                
                                @if(isset($details))
                                
                                @foreach ($approvedcertificates as $approvedcert)
                                    @if ($approvedcert->isapproved==1)
                                    The Certificate with number <strong>{{ $query }}</strong> is <strong style="color: green">VALID! 😊</strong>
                                    <br>
                                    <p>
                                        It was issued to:
                                        <div>
                                            <strong style="font-size: 22px">{{ $approvedcert->trainee->firstname.' '.strtoupper($approvedcert->trainee->lastname) }}</strong>
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            <a href="{{ route('download.trainee.certificate',$approvedcert->filename) }}" download="{{ $approvedcert->filename }}"><span style="color: red; font-size: 20px;" class="fa fa-file-pdf-o"></span> <span class="fa fa-download" style="color: green"></span></a>
                                        </div>
                                    </p>
                                    
                                    <p>
                                        <a href="{{ route('certificateverifyform') }}">Try another number</a>
                                    </p>
                                    @else
                                    The Certificate with number <strong>{{ $query }}</strong> is <strong style="color: red;">INVALID OR NOT APPROVED YET! 😦.</strong> Please check later.
                                    <br>
                                    <p>
                                        <a href="{{ route('certificateverifyform') }}">Try another number</a>
                                    </p>
                                    
                                    @endif
                                
                                @endforeach


                                @elseif(isset($message))

                                <p style="background-color: red; color: floralwhite;">
                                    &nbsp;&nbsp;{{ $message }}
                                </p>
                                
                                <a href="{{ route('certificateverifyform') }}">Try another number</a>
                                
                                @endif

                                    
                            </div>
                        </div>
                    </p>


                </p></p>

                    <br><br>
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


