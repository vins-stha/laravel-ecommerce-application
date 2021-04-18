@extends('.layout/layout-main')
@section('page_title', 'Edit Product')

@section('container')
    <h1>Product Management</h1>
    <div class="row">
        <div class="col-lg-12 card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Update Product</h3>
            </div>
            <hr>
            {{session('message')}}
            <form action="{{route('product.editProduct')}}" method="post" enctype='multipart/form-data'>
                <div class="form-group">
                    @csrf
                    <input name="id" type="hidden" class="form-control" aria-required="true" value="{{$product->id}}">

                    <label for="cc-Product" class="control-label mb-1">Product name</label>
                    <input name="product_name" type="text" class="form-control" aria-required="true"  value="{{$product->name}}">
                    @error('product_name')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cc-Product" class="control-label mb-1"> Category</label>
                    <select name="product_category" class="from-control" id="">
                        <option value="Select category" name="blank" class="form-control"></option>

                        @foreach($categories as $category)
                            @if($product_category == $category['category_name'])
                                <option selected value="{{$category['category_name']}}">
                            @else
                                <option value="{{$category['category_name']}}" class="form-control">
                                    @endif
                                    {{$category['category_name']}}</option>
                                @endforeach
                    </select>
                    @error('product_category')
                    <b>{{$message}}</b>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cc-Product" class="control-label mb-1"> Brand</label>
                    <select name="product_brand" id="">
                        <option value="Select Brand" name="blank"></option>
                        @foreach($brands as $brand)
                            @if($product_brand == $brand['name'])
                                <option selected value="{{$brand['name']}}">
                            @else
                                <option value="{{$brand['name']}}" class="form-control">
                            @endif
                                {{$brand['name']}}</option>
                        @endforeach
                    </select>
                    @error('product_brand')
                    <b>{{$message}}</b>
                    @enderror
                </div>

{{--                <div class="form-group">--}}
{{--                    <label for="cc-Product" class="control-label mb-1"> Sub-category</label>--}}
{{--                    <input name="product_sub_category" type="number" class="form-control" aria-required="false"  value="{{$product->sub_category_id}}">--}}
{{--                    @error('product_sub_category')--}}
{{--                    <b>{{$message}}</b>--}}
{{--                    @enderror--}}
{{--                </div>--}}
                <div class="form-group">
                    <label for="cc-Product" class="control-label mb-1"> Price</label>
                    <input name="product_price" type="text" class="form-control" aria-required="true"  value="{{$product->price}}">
                    @error('product_price')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cc-Product" class="control-label mb-1"> Color</label>
                    <input name="product_color" type="text" class="form-control" aria-required="false"  value="{{$product->color}}">
                    @error('product_color')
                    <b>{{$message}}</b>
                    @enderror
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="cc-Product" class="control-label mb-1"> Brand</label>--}}
{{--                    <input name="product_brand" type="text" class="form-control" aria-required="false"  value="{{$product->brand_id}}">--}}
{{--                    @error('product_brand')--}}
{{--                    <b>{{$message}}</b>--}}
{{--                    @enderror--}}
{{--                </div>--}}
                <div class="form-group">
                    <label for="cc-Product" class="control-label mb-1"> Description</label>
                    <textarea name="product_description" type="text" class="form-control" aria-required="false"  value="{{$product->description}}"></textarea>
                    @error('product_description')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cc-Product" class="control-label mb-1"> Other information</label>
                    <textarea name="product_extra" type="text" class="form-control" aria-required="false"  value="{{$product->extra}}"></textarea>
                    @error('product_extra')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <div class="form-group">
                    <img src="{{asset('storage/images/product/'.$product->image)}}" alt="">
                    <label for="cc-Product" class="control-label mb-1">Image</label>
                    <input name="product_image" type="file" class="form-control" aria-required="false" value="{{$product->name}}">
                    @error('product_image')
                    <b>{{$message}}</b>
                    @enderror
                </div>

                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Update Product</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
