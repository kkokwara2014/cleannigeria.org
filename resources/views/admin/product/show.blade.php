@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div>
            <a href="{{ route('product.index') }}" class="btn btn-success btn-sm">
                Back</a>
        </div>
        <br>
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{url('product_images',$product->image)}}" alt=""
                                    class="img-responsive img-rounded" width="250" height="250">

                            </div>
                            <div class="col-md-7">
                                <p>
                                    <h2>{{$product->name}}</h2>
                                </p>
                                <hr>
                                <div>Unit Price : &#8358;{{$product->price}} </div>
                                <div>Category : {{$product->category->name}} </div>
                                <div>Description : {{$product->description}} </div>
                                <div>Found In : {{$product->shop->businessname.' - '.$product->shop->shopnumber}} </div>

                                <br>
                                <div>
                                    Shop Owner :
                                    <strong>{{strtoupper($product->shop->user->lastname).', '.$product->shop->user->firstname}}</strong>
                                </div>
                                <div>Phone : {{$product->shop->user->phone}}</div>
                            </div>

                        </div>

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