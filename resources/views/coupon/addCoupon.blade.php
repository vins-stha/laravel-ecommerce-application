@extends('.layout/layout-main')
@section('page_title', 'Add Coupon')

@section('container')
    <h1>Product Coupon Management</h1>
    <div class="row">
        <div class="col-lg-12 card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Add coupon</h3>
            </div>
            <hr>
            {{session('message')}}
            <form action="{{route('coupon.addCoupon')}}" method="post">
                <div class="form-group">
                   @csrf
                    <label for="cc-coupon" class="control-label mb-1">Product coupon name</label>
                    <input name="coupon_name" type="text" class="form-control" aria-required="true" aria-invalid="false">
                    @error('coupon_name')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cc-coupon" class="control-label mb-1"> Code</label>
                    <input name="coupon_code" type="text" class="form-control" aria-required="true" aria-invalid="false">
                    @error('coupon_code')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cc-coupon" class="control-label mb-1"> Value</label>
                    <input name="coupon_value" type="text" class="form-control" aria-required="false" aria-invalid="false">
                    @error('coupon_value')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cc-coupon" class="control-label mb-1"> Valid from</label>
                    <input name="valid_from" type="date" class="form-control" aria-required="false" aria-invalid="false">
                    @error('valid_from')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cc-coupon" class="control-label mb-1"> Valid till</label>
                    <input name="valid_till" type="date" class="form-control" aria-required="false" aria-invalid="false">
                    @error('valid_till')
                    <b>{{$message}}</b>
                    @enderror
                </div>

                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Add coupon</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
