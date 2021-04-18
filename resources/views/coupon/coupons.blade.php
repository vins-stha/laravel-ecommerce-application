@extends('.layout/layout-main')
@section('page_title', 'Coupon Home')
@section('coupon_select', 'active')

@section('container')
    <h1>Coupons Dashboard</h1>

    @if(session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible ">
            <span class=""> {{session('message')}}</span>
        </div>
    @endif

    <a href="{{url('admin/coupon/add')}}">
        <button type="button" class="btn btn-success">
            Add Coupon
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
                                <th>Value</th>
                                <th>Start-date</th>
                                <th>Valid till</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{$coupon->id}}</td>
                                    <td>{{$coupon->coupon_name}}</td>
                                    <td>{{$coupon->coupon_code}}</td>
                                    <td>{{$coupon->coupon_value}}</td>
                                    <td>{{$coupon->valid_from}}</td>
                                    <td>{{$coupon->valid_till}}</td>
                                    <td> <ul>
                                            <li class="actions"><a href="{{url('admin/coupon/edit')}}/{{$coupon->id}}"> <butotn class="btn btn-default">Edit</butotn></a></li>

                                            <li class="actions"><a href="{{url('admin/coupon/delete')}}/{{$coupon->id}}"><button class="btn btn-danger">Delete</button></a></li>
                                            <li class="actions"><a href="{{url('admin/coupon/view')}}/{{$coupon->id}}"><button class="btn btn-default">View</button></a></li>
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
