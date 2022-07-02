@extends('admin.layout.app')


@section('content')
{{-- @include('admin.layout.statboard') --}}
@include('admin.layout.statboardcontainer')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
            <span class="fa fa-plus"></span> Add Product
        </button>
        <br><br>

        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>View Details</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                @if (Auth::user()->id==$product->shop->user_id||Auth::user()->role->id==1)

                                <tr>

                                    <td>{{$product->name}}</td>
                                    <td>&#8358; {{ number_format(($product->price),2) }}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td><a href="{{ route('product.show',$product->id) }}"><span
                                                class="fa fa-eye fa-2x text-primary"></span></a></td>

                                    <td><a href="{{ route('product.edit',$product->id) }}"><span
                                                class="fa fa-edit fa-2x text-primary"></span></a></td>
                                    <td>
                                        <form id="delete-form-{{$product->id}}" style="display: none"
                                            action="{{ route('product.destroy',$product->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                        </form>
                                        <a href="" onclick="
                                                            if (confirm('Are you sure you want to delete this?')) {
                                                                event.preventDefault();
                                                            document.getElementById('delete-form-{{$product->id}}').submit();
                                                            } else {
                                                                event.preventDefault();
                                                            }
                                                        "><span class="fa fa-trash fa-2x text-danger"></span>
                                        </a>

                                    </td>

                                </tr>

                                @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>View Details</th>
                                    <th>Edit</th>
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


        {{-- Data input modal area --}}
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">

                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><span class="fa fa-lemon-o"></span> Add Product</h4>
                        </div>
                        <div class="modal-body">
                            <div>
                                <label for="">Product Name <strong style="color:red;">*</strong> </label>
                                <input type="text" class="form-control" name="name" placeholder="Product Name">
                            </div>
                            <div>
                                <label for="">Product Price <strong style="color:red;">*</strong> (=N=) <i style="color: red">[Put only amount in figures. E.g. 1700]</i></label>
                                <input type="text" class="form-control" name="price" placeholder="Product Price eg. 2500"
                                    maxlength="7" pattern="[0-9]+">
                            </div>
                            <div>
                                <label for="">Category <strong style="color:red;">*</strong></label>
                                <select name="category_id" class="form-control">
                                    <option selected="disabled">Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="">Shop <strong style="color:red;">*</strong></label>
                                <select name="shop_id" class="form-control">
                                    <option selected="disabled">Select Shop</option>
                                    @foreach ($shops as $shop)
                                    @if (Auth::user()->id==$shop->user->id)
                                    <option value="{{$shop->id}}">{{$shop->businessname.' - '.$shop->shopnumber}}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="">Description <strong style="color:red;">*</strong></label>
                                <textarea name="description" class="form-control" cols="10" rows="2" placeholder="Description"></textarea>
                            </div>
                            <div>
                                <label for="">Details</label>
                                <textarea name="details" class="form-control" cols="10" rows="1" placeholder="Details"></textarea>
                            </div>
                            <div>
                                <label for="">Upload Product Image <strong style="color:red;">*</strong></label>
                                <input type="file" name="image">
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
