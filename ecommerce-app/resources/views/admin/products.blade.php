@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>All Products</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{route('admin.index')}}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">All Products</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search here..." class="" name="name"
                                tabindex="2" value="" aria-required="true" required="">
                        </fieldset>
                        <div class="button-submit">
                            <button class="" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <a class="tf-button style-1 w208" href="{{route('admin.product.add')}}"><i
                        class="icon-plus"></i>Add new</a>
            </div>
            <div class="table-responsive">
                @if (Session::has('status'))
                            <p class="alert alert-success">{{ Session::get('status') }};</p>
                        @endif
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            {{-- <th>SalePrice</th> --}}
                            {{-- <th>SKU</th> --}}
                            <th>Category</th>
                            {{-- <th>Brand</th>
                            <th>Featured</th> --}}
                            <th>Stock Quantity</th>
                            {{-- <th>Quantity</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product )
                        <tr>
                            <td>{{$product->id}}</td>
                            <td class="pname">
                                <div class="image">
                                    <img src="{{asset('uploads/products/thumbnails')}}/{{$product->image1_url}}" alt="{{$product->name}}" class="image">
                                </div>
                                <div class="name">
                                    <a href="#" class="body-title-2 align-items-center">{{$product->product_name}}</a>
                                </div>
                            </td>
                            <td>{{$product->price}}</td>
                            {{-- <td>$110.00</td> --}}
                            {{-- <td>SKU7868</td> --}}
                            <td>{{$product->category->category_name}}</td>
                            {{-- <td>Brand2</td>
                            <td>Yes</td> --}}
                            <td>{{$product->stok_quantity}}</td>
                            {{-- <td>11</td> --}}
                            <td>
                                <div class="list-icon-function">
                                    {{-- <a href="#" target="_blank">
                                        <div class="item eye">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </a> --}}
                                    <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}" class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </a>
                                    <form action="{{ route('admin.product.delete', ['id' => $product->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item text-danger delete border-0 bg-transparent">
                                            <i class="icon-trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{ $products->links('pagination::bootstrap-5')}}

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.delete').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                swal({
                    title: 'Are you sure?',
                    text: "You want to delete this record!",
                    type: "warning",
                    confirmButtonColor: '#dc3545'
                }).then(function(result) {
                    if(result){
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush