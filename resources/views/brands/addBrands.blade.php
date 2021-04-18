@extends('.layout/layout-main')
@section('page_title', 'Add brand')

@section('container')
    <h1>Brand  Management</h1>
    <div class="row">
        <div class="col-lg-12 card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Add brand</h3>
            </div>
            <hr>
            {{session('message')}}
            <form action="{{route('brands.addBrands')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                    <label for="cc-brand" class="control-label mb-1">Brand name</label>
                    <input name="brand_name" type="text" class="form-control" aria-required="true" aria-invalid="false">
                    @error('brand_name')
                    <b>{{$message}}</b>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="cc-Product" class="control-label mb-1">Brand Logo</label>
                    <input name="brand_logo" type="file" class="form-control" aria-required="false"
                           aria-invalid="false">
                    @error('brand_logo')
                    <b>{{$message}}</b>
                    @enderror
                </div>

                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Add brand</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
