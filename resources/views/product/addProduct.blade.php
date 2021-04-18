@extends('.layout/layout-main')
@section('page_title', 'Add Product')

@section('container')
    <h1>Product Management</h1>
    <div class="row">
        <div class="col-lg-12 col-md-8 col-sm-4 card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Add Product</h3>
            </div>
            <hr>
            {{session('message')}}

            <form action="{{route('product.addProduct')}}" method="post" enctype='multipart/form-data'>
                <div class="form" style="background: #FFF; padding: 10px">
                    <div class="form-group">
                        @csrf
                        <label for="cc-Product" class="control-label mb-1">Product name</label>
                        <input name="product_name" type="text" class="form-control" aria-required="true"
                               aria-invalid="false">
                        @error('product_name')
                        <b>{{$message}}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cc-Product" class="control-label mb-1"> Category</label>
                        <select name="product_category" id="">
                            <option value="Select category" name="blank"></option>
                            @foreach($categories as $category)
                                <option id=""
                                        value="{{$category['category_name']}}">{{$category['category_name']}}</option>
                            @endforeach
                        </select>
                        @error('product_sub_category')
                        <b>{{$message}}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cc-Product" class="control-label mb-1"> Brand</label>
                        <select name="product_brand" id="">
                            <option value="Select Brand" name="blank"></option>
                            @foreach($brands as $brand)
                                <option id=""
                                        value="{{$brand['name']}}">{{$brand['name']}}</option>
                            @endforeach
                        </select>
                        @error('product_brand')
                        <b>{{$message}}</b>
                        @enderror
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="cc-Product" class="control-label mb-1"> Sub-category</label>--}}
{{--                        <input name="product_sub_category" type="number" class="form-control" aria-required="false"--}}
{{--                               aria-invalid="false">--}}
{{--                        @error('product_sub_category')--}}
{{--                        <b>{{$message}}</b>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <label for="cc-Product" class="control-label mb-1"> Price</label>
                        <input name="product_price" type="text" class="form-control" aria-required="true"
                               aria-invalid="false">
                        @error('product_price')
                        <b>{{$message}}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cc-Product" class="control-label mb-1"> Color</label>
                        <input name="product_color" type="text" class="form-control" aria-required="false"
                               aria-invalid="false">
                        @error('product_color')
                        <b>{{$message}}</b>
                        @enderror
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="cc-Product" class="control-label mb-1"> Brand</label>--}}
{{--                        <input name="product_brand" type="text" class="form-control" aria-required="false"--}}
{{--                               aria-invalid="false">--}}
{{--                        @error('product_brand')--}}
{{--                        <b>{{$message}}</b>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <label for="cc-Product" class="control-label mb-1"> Description</label>
                        <textarea name="product_description" type="text" class="form-control" aria-required="false"
                               aria-invalid="false"></textarea>
                        @error('product_description')
                            <b>{{$message}}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cc-Product" class="control-label mb-1"> Other information</label>
                        <textarea name="product_extra" type="text" class="form-control" aria-required="false"
                               aria-invalid="false"></textarea>
                        @error('product_extra')
                        <b>{{$message}}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cc-Product" class="control-label mb-1">Image</label>
                        <input name="product_image" type="file" class="form-control" aria-required="false"
                               aria-invalid="false">
                        @error('product_image')
                        <b>{{$message}}</b>
                        @enderror
                    </div>
                </div>

                <div class="product_attributes">
                    <h2>test</h2>
                    <div class="form" style="background: #FFF; padding: 10px">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="sku" class="control-label mb-1"> SKU</label>
                                    <input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="mrp" class="control-label mb-1"> Retail Price (MRP)</label>
                                    <input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="price" class="control-label mb-1"> Price</label>
                                    <input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="size" class="control-label mb-1"> Size</label>
                                    <input id="size" name="size[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="color" class="control-label mb-1"> Color</label>
                                    <input id="color" name="color[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="quantity" class="control-label mb-1"> Quantity</label>
                                    <input id="quantity" name="quantity[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Add Product</span>
                    </button>
                </div>

            </form>


        </div>
    </div>

@endsection
