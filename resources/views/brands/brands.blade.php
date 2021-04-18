@extends('.layout/layout-main')
@section('page_title', 'product Home')
@section('product_select', 'active')

@section('container')
    <h1>Brands Dashboard</h1>

    @if(session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible ">
            <span class=""> {{session('message')}}</span>
        </div>
    @endif

    <a href="{{url('admin/brands/add')}}">
        <button type="button" class="btn btn-success">
            Add Brands
        </button>
    </a>

    <div class="main-content section__content section__content--p30 container-fluid row">
        <div class="col-lg-12">
            <div class="card">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <td>{{$brand->id}}</td>
                                    <td>{{$brand->name}}</td>
                                    <td>
                                        <img src="{{asset('storage/images/brands/'.$brand->name)}}" alt="">
                                    </td>


                                    <td> <ul>
                                            <li class="actions"><a href="{{url('admin/brands/edit')}}/{{$brand->id}}"> <butotn class="btn btn-default">Edit</butotn></a></li>

                                            <li class="actions"><a href="{{url('admin/brands/delete')}}/{{$brand->id}}"><button class="btn btn-danger">Delete</button></a></li>
                                            <li class="actions"><a href="{{url('admin/brands/view')}}/{{$brand->id}}"><button class="btn btn-default">View</button></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
