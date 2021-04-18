@extends('.layout/layout-main')
@section('page_title', 'Edit Brand')

@section('container')
    <h1>Brand Management</h1>
    <div class="row">
        <div class="col-lg-12 card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Update Brand</h3>
            </div>
            <hr>
            {{session('message')}}
            <form action="{{route('brands.editBrand')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                    <input name="id" type="hidden" class="form-control" aria-required="true" value="{{$brand->id}}">

                    <label for="cc-brand" class="control-label mb-1">Brand name</label>
                    <input name="brand_name" type="text" class="form-control" aria-required="true"  value="{{$brand->name}}">
                    @error('brand_name')
                    <b>{{$message}}</b>
                    @enderror
                </div>


                <div class="form-group">
                    <img src="{{asset('storage/images/brands/'.$brand->name)}}" alt="">
                    <label for="cc-Product" class="control-label mb-1">Brand Logo</label>
                    <input name="brand_logo" type="file" class="form-control" aria-required="false" value="{{$brand->name}}">
                    @error('brand_logo')
                    <b>{{$message}}</b>
                    @enderror
                </div>

                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Update brand</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
