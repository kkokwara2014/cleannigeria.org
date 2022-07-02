@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <div class="row">
            <div class="col-md-8">
                <p>
                    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm"><span
                            class="fa fa-chevron-circle-left"></span> Competence Assessment Form</a>
                </p>

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <form action="{{ route('survmodviz.update',[$survmod->id,$ctass->slug]) }}" method="post"
                            onsubmit="return confirm ('Do you want to submit the edited entries you made in this section?')">
                            @csrf


                            <input type="hidden" name="competenceassessment_id" value="{{ $survmod->competenceassessment_id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="caption"
                                value="Survellance Modeling and Visaulization">

                            <div class="form-group">
                                <label for="">Level *</label>
                                <select name="legend_id" class="form-control" required>
                                    <option selected="disabled" value="">Select Level</option>
                                    @foreach ($levels as $level)
                                    <option value="{{ $level->id }}"
                                        {{ $level->id==$survmod->legend_id?'selected':'' }}>{{ $level->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Evidence <strong style="color:red">*</strong></label>
                                <textarea name="evidence" class="form-control" cols="30" rows="3" required
                                    placeholder="Enter evidence">{{ $survmod->evidence }}</textarea>
                            </div>

                            <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Update & Continue</button>

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