@extends('.layout/layout-main')
@section('page_title', 'color Home')
@section('color_select', 'active')

@section('container')
    <h1>colors Dashboard</h1>

    @if(session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible ">
            <span class=""> {{session('message')}}</span>
        </div>
    @endif

    <a href="{{url('admin/colors/add')}}">
        <button type="button" class="btn btn-success">
            Add color
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
                                <th>Code</th>
                                <th>View</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($colors as $color)
                                <tr>
                                    <td>{{$color->id}}</td>
                                    <td>{{$color->name}}</td>
                                    <td>{{$color->code}}</td>
                                    <td>
                                        <div class="view" style="width: 50px; height:30px; border: 1px solid black; background:{{$color->code}}"></div>
                                    </td>

                                    <td> <ul>
                                            <li class="actions"><a href="{{url('admin/colors/edit')}}/{{$color->id}}"> <butotn class="btn btn-default">Edit</butotn></a></li>

                                            <li class="actions"><a href="{{url('admin/colors/delete')}}/{{$color->id}}"><button class="btn btn-danger">Delete</button></a></li>
                                            <li class="actions"><a href="{{url('admin/colors/view')}}/{{$color->id}}"><button class="btn btn-default">View</button></a></li>
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
