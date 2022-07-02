@extends('admin.layout.app')

@section('title')
Fill Competence Assessment Form
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
                    <a href="{{ route('publishedcomptass') }}" class="btn btn-primary btn-sm">Published
                        Competence Assessment</a>
                        {{-- <a href="" class="btn btn-success btn-sm">Submitted Competence Assessment</a> --}}
                </p>

                @include('admin.messages.success')
                @include('admin.messages.deleted')

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">

                        @if (date('m/d/Y')>$ctass->starting || date('m/d/Y')<$ctass->ending)
                            <p style="color: red; text-align: justify; font-size: 15px; font-weight: bold">
                                Kindly click on the plus (+) blue button to add details in each of the headings below.
                                Ensure
                                that your entries are cross-checked before submitting. Thank you.
                            </p>
                            <hr>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-group">
                                        {{-- hsworkenviron --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Health & Safety - Creating a Safeworking Environment <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$hsworkenviron>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-hscreate-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else
                                                
                                                @if ($hsworkenv->isassessed==0)
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('hsworkenv.edit',[$hsworkenv->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$hsworkenv->id}}" style="display: none"
                                                    action="{{ route('hsworkenv.delete',$hsworkenv->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$hsworkenv->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $hsworkenv->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif                                                
                                                @endif
                                            </span>
                                        </li>
                                        
                                        {{-- hsrisk form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Health & Safety - Identify Risk <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$hsriskidentify>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-hsrisk-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else
                                                
                                                @if ($hsrisk->isassessed==0)
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('hsrisk.edit',[$hsrisk->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$hsrisk->id}}" style="display: none"
                                                    action="{{ route('hsrisk.delete',$hsrisk->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$hsrisk->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $hsrisk->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- hsriskmanagement form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Health & Safety - Risk Management/PTW <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$hsriskmanage>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-hsriskmgt-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else
                                                
                                                @if ($hsriskmgt->isassessed==0)
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('hsriskmgt.edit',[$hsriskmgt->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$hsriskmgt->id}}" style="display: none"
                                                    action="{{ route('hsriskmgt.delete',$hsriskmgt->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$hsriskmgt->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $hsriskmgt->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- fatraining form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">First Aid Training <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$fatraining>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-fatraining-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else
                                                
                                                @if($ftrain->isassessed==0)
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('fatraining.edit',[$ftrain->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$ftrain->id}}" style="display: none"
                                                    action="{{ route('fatraining.delete',$ftrain->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$ftrain->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $ftrain->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- gastesting form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Gas Testing <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$gastesting>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-gastesting-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($gtesting->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('gastesting.edit',[$gtesting->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$gtesting->id}}" style="display: none"
                                                    action="{{ route('gastesting.delete',$gtesting->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$gtesting->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $gtesting->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- Operations Handover form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Operations Handover <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$ophandover>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-ophandover-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($ophand->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('ophandover.edit',[$ophand->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$ophand->id}}" style="display: none"
                                                    action="{{ route('ophandover.delete',$ophand->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$ophand->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $ophand->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- Forklift Operations form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Forklift Operations <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$forkliftop>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-forkliftop-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($fliftop->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('forkliftop.edit',[$fliftop->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$fliftop->id}}" style="display: none"
                                                    action="{{ route('forkliftop.delete',$fliftop->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$fliftop->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $fliftop->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- Selfloader Operations form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Self-loader Operations <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$selfloader>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-selfloader-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($sloader->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('selfloader.edit',[$sloader->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$sloader->id}}" style="display: none"
                                                    action="{{ route('selfloader.delete',$sloader->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$sloader->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $sloader->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- Power driven form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Power Driven Small Craft Operations <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$powerdriven>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-powerdriven-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($pdriven->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('powerdriven.edit',[$pdriven->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$pdriven->id}}" style="display: none"
                                                    action="{{ route('powerdriven.delete',$pdriven->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$pdriven->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $pdriven->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- Response Equipment form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Response Equipment <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$respequip>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-respequip-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($requip->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('respequip.edit',[$requip->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$requip->id}}" style="display: none"
                                                    action="{{ route('respequip.delete',$requip->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$requip->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $requip->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- Miscinnoresp form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Miscellaneous/Innovative Response Skills <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$miscinskill>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-miscskill-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($miscskill->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('miscinnoresp.edit',[$miscskill->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$miscskill->id}}" style="display: none"
                                                    action="{{ route('miscinnoresp.delete',$miscskill->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$miscskill->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $miscskill->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- Fate of Oil Spill form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Fate of Oil Spill <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$fateoilskill>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-fateoilresp-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($foilskill->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('fateoilresp.edit',[$foilskill->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$foilskill->id}}" style="display: none"
                                                    action="{{ route('fateoilresp.delete',$foilskill->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$foilskill->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $foilskill->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- Impact of Oil Pollution form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Impact of Oil Pollution <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$impactoilpollu>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-impoilpollu-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($impactoil->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('impoilpollu.edit',[$impactoil->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$impactoil->id}}" style="display: none"
                                                    action="{{ route('impoilpollu.delete',$impactoil->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$impactoil->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $impactoil->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- Surveillance Modeling form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Surveillance Modeling and Visualization <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$survmodviz>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-survmodviz-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($survmod->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('survmodviz.edit',[$survmod->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$survmod->id}}" style="display: none"
                                                    action="{{ route('survmodviz.delete',$survmod->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$survmod->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $survmod->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- Offshore Response form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Offshore Response <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$offshoreresp>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-offshoreresp-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($offshresp->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('offshoreresp.edit',[$offshresp->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$offshresp->id}}" style="display: none"
                                                    action="{{ route('offshoreresp.delete',$offshresp->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$offshresp->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $offshresp->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- Dispersant form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Dispersant <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$dispersant>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-dispersant-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($dispant->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('dispers.edit',[$dispant->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$dispant->id}}" style="display: none"
                                                    action="{{ route('dispers.delete',$dispant->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$dispant->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $dispant->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- Shoreline Response form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Shoreline Response <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$shorelineresp>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-shorelineresp-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($shoreresp->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('shorelineresp.edit',[$shoreresp->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$shoreresp->id}}" style="display: none"
                                                    action="{{ route('shorelineresp.delete',$shoreresp->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$shoreresp->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $shoreresp->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        {{-- Inland Response form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Inland Response <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$inlandresp>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-inlandresp-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($inlresp->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('inlandresp.edit',[$inlresp->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$inlresp->id}}" style="display: none"
                                                    action="{{ route('inlandresp.delete',$inlresp->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$inlresp->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $inlresp->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>

                                        @if ($hsworkenviron>0 && 
                                        $hsriskidentify>0 && 
                                        $hsriskmanage>0 && 
                                        $fatraining>0 &&
                                        $gastesting>0 &&
                                        $ophandover>0 &&
                                        $forkliftop>0 &&
                                        $selfloader>0 &&
                                        $powerdriven>0 &&
                                        $respequip>0 &&
                                        $miscinskill>0 &&
                                        $fateoilskill>0 &&
                                        $impactoilpollu>0 &&
                                        $survmodviz>0 &&
                                        $offshoreresp>0 &&
                                        $dispersant>0 &&
                                        $shorelineresp>0 &&
                                        $inlandresp>0)
                                        {{-- Incident Management form --}}
                                        <li class="list-group-item" style="margin-bottom: 4px">
                                            <span style="font-size: 17px; font-weigth:bold">Incident Management <i
                                                    style="color: red">*</i></span>
                                            <span style="float: right;">
                                                
                                                @if (!$incidentmgt>0)
                                                <a style="color: green" href="#" data-toggle="modal"
                                                    data-target="#modal-incidentmgt-{{ $ctass->id }}">
                                                    <span class="fa fa-plus-circle fa-2x"></span>
                                                </a>
                                                
                                                @else

                                                @if($incidmgt->isassessed==0)
                                                
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ route('incidentmgt.edit',[$incidmgt->id,$ctass->slug]) }}">
                                                    <span class="fa fa-pencil fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <form id="remove-{{$incidmgt->id}}" style="display: none"
                                                    action="{{ route('incidentmgt.delete',$incidmgt->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a href="" style="color: red" onclick="
                                                    if (confirm('Are you sure you want to delete this?')) {
                                                        event.preventDefault();
                                                    document.getElementById('remove-{{$incidmgt->id}}').submit();
                                                    } else {
                                                        event.preventDefault();
                                                    }
                                                ">
                                                    <span class="fa fa-trash-o fa-2x"></span>
                                                </a>
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>

                                                @else
                                                &nbsp;
                                                &nbsp;
                                                <small>
                                                    <span class="badge badge-success" style="background-color: green; color: honeydew">
                                                        Submitted & Assessed by {{ $incidmgt->assessedby }} <span class="fa fa-check-circle-o"></span>
                                                    </span>
                                                </small>
                                                    
                                                @endif
                                                
                                                @endif
                                            </span>
                                        </li>
                                        @endif                                        
                                    </ul>

                                   @if ($incidentmgt>0)
                                       <a data-toggle="modal"
                                       data-target="#modal-change-assessor" href="#" class="btn btn-success btn-sm"><span class="fa fa-exchange">&nbsp;</span><span class="fa fa-user"></span> Change Assessor</a>
                                   @endif

                                </div>
                            </div>
                            @else
                            <p style="text-align: justify; font-size: 20px; color: red">

                                Dear {{ $user->firstname.' '.$user->lastname }}, no form to be
                                filled at the moment! <br>
                                {{ $ctass->title }} will start on
                                {{ date('d M, Y',strtotime($ctass->starting)) }} and
                                end on {{ date('d M, Y',strtotime($ctass->ending)) }}.
                            </p>
                            

                            @endif
                       
                        
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

<!--Modals for HSWorking Environment-->
<div class="modal fade" id="modal-hscreate-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('hsworkenv.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Health & Saftefy - Creating a Safeworking Environment for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Health & Safety - Creating a Safeworking Environment">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
    

<!--Modals for HSRisk-->
<div class="modal fade" id="modal-hsrisk-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('hsrisk.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Health & Saftefy - Identify Risk for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Health & Safety - Identify Risk">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<!--Modals for HSRisk Management-->
<div class="modal fade" id="modal-hsriskmgt-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('hsriskmgt.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Health & Saftefy - Risk Management/PTW for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Health & Safety - Risk Management/PTW">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /.modal -->
<!--Modals for First Aid Training-->
<div class="modal fade" id="modal-fatraining-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('fatraining.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add First Aid Training for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="First Aid Training">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Gas Testing-->
<div class="modal fade" id="modal-gastesting-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('gastesting.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Gas Testing for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Gas Testing">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Operations Handover-->
<div class="modal fade" id="modal-ophandover-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('ophandover.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Operations Handover for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Operations Handover">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Forklift Operations-->
<div class="modal fade" id="modal-forkliftop-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('forkliftop.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Forklift Operations for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Forklift Operations">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Selfloader Operations-->
<div class="modal fade" id="modal-selfloader-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('selfloader.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Self-loader Operations for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Self-loader Operations">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Power Driven Small Craft Operations-->
<div class="modal fade" id="modal-powerdriven-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('powerdriven.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Power Driven Small Craft Operations for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Power Driven Small Craft Operations">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Response Equipment-->
<div class="modal fade" id="modal-respequip-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('respequip.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Response Equipment for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Response Equipment">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Miscellaneous/Innovative Response Skills-->
<div class="modal fade" id="modal-miscskill-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('miscinnoresp.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Miscellaneous/Innovative Response Skills for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Miscellaneous/Innovative Response Skills">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Fate of Oil Spills-->
<div class="modal fade" id="modal-fateoilresp-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('fateoilresp.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Fate of Oil Spills for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Fate of Oil Spills">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Impact of Oil Pollution-->
<div class="modal fade" id="modal-impoilpollu-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('impoilpollu.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Impact of Oil Pollution for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Impact of Oil Pollution">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Survellance Modeling and Visualization-->
<div class="modal fade" id="modal-survmodviz-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('survmodviz.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Survellance Modeling and Visualization for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Survellance Modeling and Visualization">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Offshore Response-->
<div class="modal fade" id="modal-offshoreresp-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('offshoreresp.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Offshore Response for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Offshore Response">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Dispersant-->
<div class="modal fade" id="modal-dispersant-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('dispers.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Dispersant for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Dispersant">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Shoreline Response-->
<div class="modal fade" id="modal-shorelineresp-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('shorelineresp.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Shoreline Response for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Shoreline Response">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Inland Response-->
<div class="modal fade" id="modal-inlandresp-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('inlandresp.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Inland Response for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Inland Response">

                    <div class="form-group">
                        <label for="">Level *</label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modals for Incident Management-->
<div class="modal fade" id="modal-incidentmgt-{{ $ctass->id }}">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('incidentmgt.store') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Add Incident Management for {{ $ctass->title }}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="caption" value="Incident Management">

                    <div class="form-group">
                        <label for="">Level <strong style="color:red">*</strong></label>
                        <select name="legend_id" class="form-control" required>
                            <option selected="disabled" value="">Select Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        <div class="form-group">
                            <label for="">Evidence <strong style="color:red">*</strong></label>
                            <textarea name="evidence" class="form-control" cols="30" rows="3" required placeholder="Enter evidence"></textarea>
                        </div>
                    
                        <div class="form-group">
                            <label for="">Assessor <strong style="color:red">*</strong></label>
                            <select name="sentto_id" class="form-control" required>
                                <option selected="disabled" value="">Select Assessor</option>
                                @foreach ($senttos as $sentto)
                                <option value="{{ $sentto->id }}">{{ $sentto->firstname.' '.$sentto->lastname.' - '.$sentto->email .' [ in '.$sentto->location->name.' base]' }}</option>
                                @endforeach
                            </select>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--Modals for Changing Assessor-->
<div class="modal fade" id="modal-change-assessor">
    <div class="modal-dialog">

        <form action="{{ route('assessor.change') }}" method="post" onsubmit="return confirm ('Do you want to submit the entries you made in this section?')">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><span class="fa fa-exchange"></span>&nbsp;<span class="fa fa-user"></span> Change Assessor</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="competenceassessment_id" value="{{ $ctass->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        
                        <div class="form-group">
                            <label for="">Select Assessor <strong style="color:red">*</strong></label>
                            <select name="sentto_id" class="form-control" required>
                                <option selected="disabled" value="">Select Assessor</option>
                                @foreach ($senttos as $sentto)
                                <option value="{{ $sentto->id }}">{{ $sentto->firstname.' '.$sentto->lastname.' - '.$sentto->email .' [ in '.$sentto->location->name.' base]' }}</option>
                                @endforeach
                            </select>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->

        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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