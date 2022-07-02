@extends('admin.layout.app')

@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <p>
            <a href="{{ route('leave.index') }}" class="btn btn-success btn-sm">
                <span class="fa fa-eye"></span> All Leaves
             </a>

             <span style="float: right; font-weight: bolder; font-size: 25px;">Total : {{ $totalleavesapproved }}</span>
        </p>
        

        <div class="row">
            <div class="col-md-12">
                

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                {{ $approvedleaves->links() }}

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        @foreach ($approvedleaves as $lappbyyou)
                          
                           <ul class="list-group">

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <a href="#">
                                                    <img src="{{url('user_images',$lappbyyou->user->userimage)}}" alt=""
                                                        class="img-responsive img-circle" style="border-radius: 50%"
                                                        width="60" height="60">
                                                </a>
                                            </div>
                                            <div class="col-md-10">
                                                <div>
                                                    Approved? :
                                                    @if ($lappbyyou->isapproved==1)
                                                    <span class="badge badge-success badge-pill"
                                                        style="background-color: green; color:seashell"> Yes</span>
                                                    @else
                                                    <span class="badge badge-danger badge-pill"
                                                        style="background-color: red; color:seashell"> No</span>
                                                    @endif
                                                </div>
                                                
                                                <div>
                                                    Approved On : {{date('d M, Y',strtotime($lappbyyou->updated_at))}}
                                                </div>
                                                <div>
                                                    Starting : {{date('d M, Y',strtotime($lappbyyou->starting))}}
                                                    &nbsp;
                                                    & 
                                                    &nbsp;
                                                    Ending : {{date('d M, Y',strtotime($lappbyyou->ending))}}
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                            </li>
                        </ul>

                       @endforeach
                        
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