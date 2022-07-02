@extends('admin.layout.app')

@section('title')
Select Competence Assessment Year
@endsection

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <div class="row">
            <div class="col-md-12">

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="row">
                    <div class="col-md-10">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">

                                <h3>Select Competence Assessment Year for Submitted Assessments</h3>

                                <div class="row">
                                    <div class="col-md-8">
                                        <form action="{{ route('yearlysubmitted.comptass') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label>Competence Assessment Year <strong
                                                        style="color:red;">*</strong></label>
                                                <select name="comptassyear" class="form-control" required>
                                                    <option selected="disabled" value="">Select Year</option>
                                                    @foreach ($comptassyears as $comptassyear)
                                                    <option value="{{$comptassyear}}" {{
                                                        old('comptassyear')==$comptassyear ? 'selected' : '' }}>
                                                        {{$comptassyear}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <a href="{{ route('dashboard.index') }}"
                                                class="btn btn-danger btn-sm">Cancel</a>
                                            <button class="btn btn-primary btn-sm" type="submit">Fetch Submitted
                                                Competence Assessments</button>

                                        </form>
                                    </div>
                                </div>


                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
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