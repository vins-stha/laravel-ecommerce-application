@extends('.layout/layout-main')
@section('page_title', 'Edit Category')

@section('container')
    <h1>Product Category Management</h1>
    <div class="row">
        <div class="col-lg-12 card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Update Category</h3>
            </div>
            <hr>
            {{session('message')}}
            <form action="{{route('productcategory.editCategory')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                    <input type="hidden" value="{{$category->id}}" name="category_id">
                    <label for="cc-category" class="control-label mb-1">Product Category</label>
                    <input name="category_name" type="text" class="form-control" aria-required="true"  value="{{$category->category_name}}">
                    @error('category_name')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cc-category" class="control-label mb-1"> Category Slug</label>
                    <input name="category_slug" type="text" class="form-control" aria-required="true" value="{{$category->category_slug}}">
                    @error('category_slug')
                    <b>{{$message}}</b>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cc-Product" class="control-label mb-1">Category specific Image</label>
                    <input name="category_image" type="file" class="form-control" aria-required="false"
                           aria-invalid="false">
                    @error('category_image')
                    <b>{{$message}}</b>
                    @enderror
                </div>

                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        <i class="fa fa-lock fa-lg"></i>&nbsp;
                        <span id="payment-button-amount">Update Category</span>

                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
