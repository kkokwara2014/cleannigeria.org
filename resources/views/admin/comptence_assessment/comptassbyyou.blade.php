@extends('admin.layout.app')

@section('title')
 Your Competence Assessment(s)
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

                <p>
                    <a href="{{ route('publishedcomptass') }}" class="btn btn-primary btn-sm">Published Competence Assessment</a>
                    {{-- <a href="{{ route('submitted.comptass') }}" class="btn btn-success btn-sm">Submitted Competence Assessment</a> --}}
                </p>

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        
                       @if ($mysubmittedcomptassments->count())
                       <table id="example1" class="table table-responsive table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Compt. Assessment</th>
                                <th>Staff Name/Phone</th>
                                <th>Staff Location</th>
                                <th>Submitted on</th>
                                <th>Assessor</th>
                               
                                <th>View Details</th>                                   
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mysubmittedcomptassments as $subcomptass)
                            
                            <tr>
                                <td>{{$subcomptass->competenceassessment->title.' '.$subcomptass->competenceassessment->assessmentyear}}</td>
                                <td>
                                    {{$subcomptass->user->firstname.' '.$subcomptass->user->lastname}}
                                    &nbsp;
                                    <a href="tel:{{$subcomptass->user->phone}}" title="Tap to Call">{{$subcomptass->user->phone}}</a>
                                </td>
             
                                <td>{{$subcomptass->user->location->name}}</td>
                                
                                <td>
                                    {{ $subcomptass->created_at }}
                                </td>
                                <td>
                                    {{ $subcomptass->sentto->firstname.' '.$subcomptass->sentto->lastname }}
                                </td>
                                
                                <td>
                                    <a href="{{ route('comptass.show',[$subcomptass->competenceassessment_id,$subcomptass->user->id]) }}"><span
                                            class="fa fa-eye fa-2x text-primary"></span>
                                    </a>
                                </td>                                   
                                 <td>
                                      <div class="dropdown"> <button type="button"
                                            class="btn btn-primary btn-sm dropdown-toggle" id="dropdownMenu1"
                                            data-toggle="dropdown"> Action &nbsp;&nbsp;<span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                                            @if ($subcomptass->user_id==Auth::user()->id || $subcomptass->sentto_id==Auth::user()->id || Auth::user()->role_id==1 || Auth::user()->role_id==2)
                                            <li role="presentation"> <a role="menuitem" tabindex="-1"
                                                href="{{ route('comptass.show',[$subcomptass->competenceassessment_id,$subcomptass->user_id]) }}"><span
                                                    class="fa fa-eye"></span> View</a> 
                                            </li>
                                            @endif
                                            
                                            @if ($subcomptass->user_id==Auth::user()->id || Auth::user()->role_id==1 || Auth::user()->role_id==2)
                                            <form id="remove-{{$subcomptass->id}}" style="display: none"
                                                action="{{ route('delete.submitted.comptass',[$subcomptass->competenceassessment_id,$subcomptass->user_id]) }}" method="post">
                                                {{ csrf_field() }}
                                                {{method_field('DELETE')}}
                                            </form>

                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1" href="" onclick="
                                                            if (confirm('Delete this?')) {
                                                                event.preventDefault();
                                                            document.getElementById('remove-{{$subcomptass->id}}').submit();
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
                                
                            @endforeach
                        </tbody>
                        
                    </table>
                       @else
                           <h4 style="color: red">You have submitted any Competence Assessment!</h4>
                       @endif
                       
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
