@extends('admin.layout.app')

@section('title')
Scheduled Equipment Details
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
                <p>
                    <a href="{{ route('maintenanceschedule.index') }}" class="btn btn-success btn-sm"><span
                            class="fa fa-eye"></span> Scheduled Equipment</a>
                </p>
                @include('admin.messages.success')
                @include('admin.messages.deleted')
                <div class="row">
                    <div class="col-md-9">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div>
                                    <strong>
                                        #{{ $maintschedule->schedulecode }}
                                    </strong>
                                </div>
                                <div>
                                    Name: <strong>{{ $maintschedule->srequipment->name  }}</strong>
                                </div>
                                <div>
                                    Maint. Cycle:
                                    @if ($maintschedule->maintcycle==1)
                                    {{ $maintschedule->maintcycle.' month'  }}
                                    @else
                                    {{ $maintschedule->maintcycle.' months'  }}
                                    @endif
                                </div>
                                <div>
                                    Due Date: {{ $maintschedule->duedateformaint  }}
                                </div>
                                <div>
                                    Created: {{ $maintschedule->created_at  }}
                                </div>
                                @if ($maintschedule->ismaintained==1)
                                <div>
                                    Record Updated : {{ $maintschedule->updated_at  }}
                                </div>
                                @endif
                                <div>
                                    Current Status :
                                    @if ($maintschedule->ismaintained==1)
                                    <span class="badge badge-success badge-pill"
                                        style="background-color: green; color:seashell"> Maintained</span>
                                    @else
                                    <span class="badge badge-danger badge-pill"
                                        style="background-color: crimson; color:seashell"> Not Maintained</span>
                                    @endif
                                </div>
                                <hr>
                                <div>
                                    Scheduler:
                                    <strong>{{ $maintschedule->user->firstname.' '.$maintschedule->user->lastname  }}</strong>
                                </div>
                                <div>
                                    Phone: {{ $maintschedule->user->phone  }}
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