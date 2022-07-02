@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

        <div class="row">
            <div class="col-md-12">

                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-responsive table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Ref. #</th>
                                    <th>Member Comp.</th>
                                    <th>Notifier</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Activation Date</th>
                                    <th>View Message</th>
                                    <th>Delete</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mobilizationrequests as $mobilizationrequest)
                                <tr>

                                    <td>{{$mobilizationrequest->refnumb}}</td>
                                    <td>{{$mobilizationrequest->membcomp}}</td>
                                    <td>{{$mobilizationrequest->notifier}}</td>
                                    <td>{{$mobilizationrequest->mobilephone}}</td>
                                    <td>{{$mobilizationrequest->email}}</td>
                                    <td>{{$mobilizationrequest->dateofact}}</td>
                                    <td>
                                        <a href="{{ route('mobilizationrequest.show',$mobilizationrequest->id) }}"><span
                                            class="fa fa-eye fa-2x text-primary"></span></a>
                                    </td>

                                    <td>

                                        <form id="delete-form-{{$mobilizationrequest->id}}" style="display: none"
                                            action="{{ route('mobilizationrequest.destroy',$mobilizationrequest->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                        </form>
                                        <a href="" onclick="
                                                            if (confirm('Are you sure you want to delete this?')) {
                                                                event.preventDefault();
                                                            document.getElementById('delete-form-{{$mobilizationrequest->id}}').submit();
                                                            } else {
                                                                event.preventDefault();
                                                            }
                                                        "><span class="fa fa-trash fa-2x text-danger"></span>
                                        </a>

                                    </td>

                                </tr>


                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Ref. #</th>
                                    <th>Member Comp.</th>
                                    <th>Notifier</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Activation Date</th>
                                    <th>View Message</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                        </table>

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
