@extends('.layout/layout-main')
@section('page_title', 'Edit size')

@section('container')
    <h1>Product size Management</h1>
    <div class="row">
        <div class="col-lg-12 card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Update size</h3>
            </div>
            <hr>
            {{session('message')}}
            <form action="{{route('size.editSize')}}" method="post">
                @csrf
                <div class="form-group">
                    <input name="size_id" type="hidden" class="form-control" aria-required="true" value="{{$size->id}}">
                    <label for="cc-size" class="control-label mb-1">Product size name</label>
                    <input name="size_name" type="text" class="form-control" aria-required="true" value="{{$size->name}}">
                    @error('size_name')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cc-size" class="control-label mb-1"> size Code</label>
                    <input name="size_code" type="text" class="form-control" aria-required="true"  value="{{$size->code}}">
                    @error('code')
                    <b>{{$message}}</b>
                    @enderror
                </div>

                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Update size</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
