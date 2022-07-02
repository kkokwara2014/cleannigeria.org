@extends('admin.layout.app')

@section('title')
Edit Document
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a href="{{ route('documentregisters.index') }}" class="btn btn-success btn-sm">
                <span class="fa fa-eye"></span> All Documents
            </a>
        </p>

        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('documentregisters.update',$docum->slug) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Document Title <span style="color: red">*</span></label>
                                        <input type="text" class="form-control{{ $errors->has('doctitle') ? ' is-invalid' : '' }}"
                                            name="doctitle" value="{{ $docum->doctitle }}" placeholder="Document Title" required>
        
                                        @if ($errors->has('doctitle'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('doctitle') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Document Number <span style="color: red">*</span></label>
                                        <input type="text" class="form-control{{ $errors->has('docnumber') ? ' is-invalid' : '' }}"
                                            name="docnumber" value="{{ $docum->docnumber }}" placeholder="Document Number" required maxlength="21">
        
                                        @if ($errors->has('docnumber'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('docnumber') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Revision Status <span style="color: red">*</span></label>
                                        <input type="text" class="form-control{{ $errors->has('revisionstatus') ? ' is-invalid' : '' }}"
                                            name="revisionstatus" value="{{ $docum->revisionstatus }}" placeholder="Revision Status" required>
        
                                        @if ($errors->has('revisionstatus'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('revisionstatus') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label>Date Prepared <span style="color: red">*</span></label>
                                        <input type="date" class="form-control{{ $errors->has('dateprepared') ? ' is-invalid' : '' }}"
                                            name="dateprepared" value="{{ $docum->dateprepared }}" placeholder="Date Prepared" required>
        
                                        @if ($errors->has('dateprepared'))
                                        <span class="invalid-feedback" role="alert">
                                            <span
                                                style="color: red">{{ $errors->first('dateprepared') }}</span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" cols="30" rows="1" placeholder="Document description">{{ $docum->description }}</textarea>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Upload File <span style="color: red">* (PDF only)</span></label>
                                        <input type="file" name="docfilename">

                                        <div style="margin-top: 5px">
                                            Existing file : <span class="fa fa-file-pdf-o" style="color: red"></span> {{ $docum->filename }}
                                        </div>
                                    </div>
                                    <input type="hidden" name="existingdocfilename" value="{{ $docum->filename }}">
                                </div>

                            </div>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                            <a href="{{ route('documentregisters.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>

                        </form>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </div>


    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    {{-- <section class="col-lg-5 connectedSortable"> --}}


    {{-- </section> --}}
    <!-- right col -->
</div>
<!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
