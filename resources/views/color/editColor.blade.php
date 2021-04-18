@extends('.layout/layout-main')
@section('page_title', 'Edit color')

@section('container')
    <h1>Product Color Management</h1>
    <div class="row">
        <div class="col-lg-12 card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Update Color</h3>
            </div>
            <hr>
            {{session('message')}}
            <form action="{{route('color.editColor')}}" method="post">
                @csrf
                <div class="form-group">
                    <input name="color_id" type="hidden" class="form-control" aria-required="true" value="{{$color->id}}">
                    <label for="cc-color" class="control-label mb-1">Product color name</label>
                    <input name="color_name" type="text" class="form-control" aria-required="true" value="{{$color->name}}">
                    @error('color_name')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cc-color" class="control-label mb-1"> Color Code</label>
                    <input name="color_code" type="text" class="form-control" aria-required="true"  value="{{$color->code}}">
                    @error('code')
                    <b>{{$message}}</b>
                    @enderror
                </div>

                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Update color</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
