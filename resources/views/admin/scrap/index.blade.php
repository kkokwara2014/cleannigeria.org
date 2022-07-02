@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <a href="{{ route('scrap.create') }}" class="btn btn-success btn-sm"> <span class="fa fa-archive"></span> Scrap SR Equipment</a>

        <br>
        <br>
        <div class="row">
            <div class="col-md-12">

                @include('admin.messages.deleted')
                @include('admin.messages.success')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>SRE</th>

                                    <th>Scrapped By</th>
                                    <th>Qty</th>
                                    <th>Reason</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($scraps as $scrap)
                                <tr>
                                    <td>{{ $scrap->srequipment->name .' with ref #'.$scrap->srequipment->refnumb}}</td>

                                    <td>{{$scrap->user->firstname.' '.$scrap->user->lastname}}</td>
                                    <td>{{$scrap->qty}}</td>
                                    <td>{{$scrap->reason}}</td>
                                    <td>
                                        <div class="dropdown"> <button type="button"
                                                class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                                data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                
                                               
                                                <form id="unscrap-{{$scrap->id}}" style="display: none"
                                                    action="{{ route('srequipment.unscrap',$scrap->id) }}"
                                                    method="post">
                                                   @csrf
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Unscrap this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('unscrap-{{$scrap->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-reply"></span>
                                                        Unscrap
                                                    </a>
                                                </li>
                                               
                                                


                                                <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                        href="{{ route('scrap.edit',$scrap->id) }}"><span
                                                            class="fa fa-pencil-square"></span> Edit</a> 
                                                </li>

                                                <form id="remove-{{$scrap->id}}" style="display: none"
                                                    action="{{ route('scrap.destroy',$scrap->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="" onclick="
                                                                    if (confirm('Delete this?')) {
                                                                        event.preventDefault();
                                                                    document.getElementById('remove-{{$scrap->id}}').submit();
                                                                    } else {
                                                                        event.preventDefault();
                                                                    }
                                                                "><span class="fa fa-trash-o"></span>
                                                        Delete
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SRE</th>

                                    <th>scrapped By</th>
                                    <th>Qty</th>
                                    <th>Reason</th>
                                    <th>Action</th>

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
