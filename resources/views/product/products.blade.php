@extends('.layout/layout-main')
@section('page_title', 'product Home')
@section('product_select', 'active')

@section('container')
    <h1>products Dashboard</h1>

    @if(session()->has('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible ">
            <span class=""> {{session('message')}}</span>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="sufee-alert alert with-close alert-danger alert-dismissible ">
            <span class=""> {{session('error')}}</span>
        </div>
    @endif

    <a href="{{url('admin/product/add')}}">
        <button type="button" class="btn btn-success">
            Add product
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
                                <th>Image</th>
                                <th>Sub-category Id</th>
                                <th>Brand Id</th>
                                <th>Price</th>
                                <th>Color</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>
                                        <img src="{{asset('storage/images/product/cat_'.$product->category_id.'/'.$product->image)}}" alt="">
                                    </td>
                                    <td>{{$product->sub_category_id}}</td>
                                    <td>{{$product->brand_id}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->color}}</td>

                                    <td> <ul>
                                            <li class="actions"><a href="{{url('admin/product/edit')}}/{{$product->id}}"> <butotn class="btn btn-default">Edit</butotn></a></li>

                                            <li class="actions"><a href="{{url('admin/product/delete')}}/{{$product->id}}"><button class="btn btn-danger">Delete</button></a></li>
                                            <li class="actions"><a href="{{url('admin/product/view')}}/{{$product->id}}"><button class="btn btn-default">View</button></a></li>
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

    <div class="row">
        <div >
            <div >
                <div >
                    <div >
                        <table class="table table-hover">
                            <thead>
                            <tr rowspan="2">
                                <th>Id</th>
                                <th>Name</th>
                                <th colspan="4">Ratings</th>
                                <th>Amount Raised</th>
                                <th>Amount %</th>
                                <th>HardCap</th>
                                <th>Softcap</th>
                            </tr>
                            </thead>

                            <tr>
                                <td></td>
                                <td></td>
                                <th>Expert</th><th>Team</th><th>Product</th><th>Icobench</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tbody>
                                <?php $count = 1; ?>
                                <?// var_dump($icos[0]);?>
                                @foreach($icos as $data)

                                    <tr>

                                          <td>{{$count}}</td>
                                          <td>{{$data['ico_name']}}</td>
                                          <td>{{$data['experts_rating']}}</td>
                                          <td>{{$data['team_rating']}}</td>
                                          <td>{{$data['product_rating']}}</td>
                                          <td>{{$data['ico_bench_rating']}}</td>
                                          <td>{{$data['amount_raised']}}</td>
                                          <td>{{$data['social_activity']['assets']['amount raised (in %)']}}</td>
                                          <td>{{$data['social_activity']['assets']['hard_cap']}}</td>
                                          <td>{{$data['social_activity']['assets']['soft_cap']}}</td>
                                          <?php $count++; ?>
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
