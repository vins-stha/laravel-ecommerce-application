@extends('.layout/layout-main')
@section('page_title', 'Category')
@section('product-category_select', 'active')

@section('container')
    <h1>Category</h1>

    <a href="{{url('admin/product-category/add')}}">
        <button type="button" class="btn btn-success">
            Add Category
        </button>
    </a>

    @if(session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible ">
            <span class=""> {{session('message')}}</span>
        </div>
    @endif

    {{session('error')}}
    <div class="main-content section__content section__content--p10 container-fluid col-lg-12 row">
         <table class="table table-hover col-lg-12">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Category-image</th>
                                <th>Sub-category</th>
                                <th>Total items</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->category_slug}}</td>
                                    <td>
                                        <img src="{{asset('storage/images/product_category/'.$category->category_name)}}" alt="">
                                    </td>

                                    <td>Sub category</td>
                                    <td>Total items</td>
                                    <td> <ul>
                                            <li class="actions"><a href="{{url('admin/product-category/edit')}}/{{$category->id}}"> <butotn class="btn btn-default">Edit</butotn></a></li>

                                            <li class="actions"><a href="{{url('admin/product-category/delete')}}/{{$category->id}}"><button class="btn btn-danger">Delete</button></a></li>
                                            <li class="actions"><a href="{{url('admin/product-category/view')}}/{{$category->id}}"><button class="btn btn-default">View</button></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

    </div>
@endsection
