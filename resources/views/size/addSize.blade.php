@extends('.layout/layout-main')
@section('page_title', 'Add Size')

@section('container')
    <h1>Product Size Management</h1>
    <div class="row">
        <div class="col-lg-12 card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Add Sizes</h3>
            </div>
            <hr>
            {{session('message')}}
            <form action="{{route('size.addSize')}}" method="post">
                <div class="form-group">
                    @csrf
                    <label for="cc-Size" class="control-label mb-1">Product Size name</label>
                    <input name="size_name" type="text" class="form-control" aria-required="true" aria-invalid="false">
                    @error('size_name')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cc-Size" class="control-label mb-1"> Size Code</label>
                    <input name="size_code" type="text" class="form-control" aria-required="true" aria-invalid="false">
                    @error('code')
                    <b>{{$message}}</b>
                    @enderror
                </div>

                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Add Size</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
