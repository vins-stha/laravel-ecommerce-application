@extends('.layout/layout-main')
@section('page_title', 'size Home')
@section('size_select', 'active')

@section('container')
    <h1>Sizes Dashboard</h1>

    @if(session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible ">
            <span class=""> {{session('message')}}</span>
        </div>
    @endif

    <a href="{{url('admin/sizes/add')}}">
        <button type="button" class="btn btn-success">
            Add size
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
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sizes as $size)
                                <tr>
                                    <td>{{$size->id}}</td>
                                    <td>{{$size->name}}</td>
                                    <td>{{$size->code}}</td>
                                    <td> <ul>
                                            <li class="actions"><a href="{{url('admin/sizes/edit')}}/{{$size->id}}"> <butotn class="btn btn-default">Edit</butotn></a></li>

                                            <li class="actions"><a href="{{url('admin/sizes/delete')}}/{{$size->id}}"><button class="btn btn-danger">Delete</button></a></li>
                                            <li class="actions"><a href="{{url('admin/sizes/view')}}/{{$size->id}}"><button class="btn btn-default">View</button></a></li>
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
