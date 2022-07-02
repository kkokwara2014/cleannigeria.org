@extends('admin.layout.app')

@section('title')
CNA Partners
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
                    @if (auth()->user()->hasAnyRole(['Admin']))
                    <a href="{{ route('cnapartners.create') }}" class="btn btn-primary btn-sm"><span
                            class="fa fa-plus"></span> Add New Partner</a>
                    @endif
                    @if ($user->staffcategory_id==3)
                    <a href="{{ route('maintenancerequest.create') }}" class="btn btn-primary btn-sm"><span
                            class="fa fa-plus"></span> Make Maintenance Request</a>
                    @endif
                </p>

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Name/Phone</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>View Details</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partners as $partner)
                                    @if ($partner->id==auth()->user()->id || auth()->user()->id==$partner->user_id || auth()->user()->hasAnyRole(['Admin']) || auth()->user()->hasAnyRole(['General Manager']))
                                    <tr>
                                        <td>
                                            {{$partner->firstname.' '.$partner->lastname}}
                                            &nbsp;
                                            <a href="tel:{{ $partner->phone }}">{{ $partner->phone }}</a>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $partner->email }}">{{ $partner->email }}</a>
                                        </td>
                                        <td>
                                            {{ $partner->company->name }}
                                        </td>
                                        <td>
                                            <a href="{{ route('cnapartners.show',$partner) }}"><span class="fa fa-eye fa-2x"></span></a>
                                        </td>

                                        <td>
                                            <div class="dropdown"> <button type="button"
                                                    class="btn btn-primary btn-sm btn-block dropdown-toggle" id="dropdownMenu1"
                                                    data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                                    @if (auth()->user()->hasAnyRole(['Admin']) || ($partner->user_id==auth()->user()->id))
                                                    <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                            href="{{ route('cnapartners.edit',$partner) }}"><span
                                                                class="fa fa-pencil-square"></span> Edit</a>
                                                    </li>

                                                    <form id="remove-{{$partner->id}}" style="display: none"
                                                        action="{{ route('cnapartners.destroy',$partner->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>

                                                    <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="" onclick="
                                                                            if (confirm('Delete this?')) {
                                                                                event.preventDefault();
                                                                            document.getElementById('remove-{{$partner->id}}').submit();
                                                                            } else {
                                                                                event.preventDefault();
                                                                            }
                                                                        "><span class="fa fa-trash-o"></span>
                                                            Delete
                                                        </a>
                                                    </li>
                                                    @endif

                                                </ul>
                                            </div>
                                        </td>

                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>

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