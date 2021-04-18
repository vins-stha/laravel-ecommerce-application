
@extends('frontend.layout-main')
@section('mainContent')
<!-- Start slider -->
<section id="aa-slider">
    <div class="aa-slider-area">
        <div id="sequence" class="seq">
            <div class="seq-screen">
                <ul class="seq-canvas">
                    <!-- single slide item -->
                    <li>
                        <div class="seq-model">
                            <img data-seq src="{{asset('frontend/img/slider/1.jpg')}}" alt="Men slide img" />
                        </div>
                        <div class="seq-title">
                            <span data-seq>Save Up to 75% Off</span>
                            <h2 data-seq>Men Collection</h2>
                            <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
                            <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
                        </div>
                    </li>
                    <!-- single slide item -->
                    <li>
                        <div class="seq-model">
                            <img data-seq src="{{asset('frontend/img/slider/2.jpg')}}" alt="Wristwatch slide img" />
                        </div>
                        <div class="seq-title">
                            <span data-seq>Save Up to 40% Off</span>
                            <h2 data-seq>Wristwatch Collection</h2>
                            <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
                            <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
                        </div>
                    </li>
                    <!-- single slide item -->
                    <li>
                        <div class="seq-model">
                            <img data-seq src="{{asset('frontend/img/slider/3.jpg')}}" alt="Women Jeans slide img" />
                        </div>
                        <div class="seq-title">
                            <span data-seq>Save Up to 75% Off</span>
                            <h2 data-seq>Jeans Collection</h2>
                            <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
                            <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
                        </div>
                    </li>
                    <!-- single slide item -->
                    <li>
                        <div class="seq-model">
                            <img data-seq src="{{asset('frontend/img/slider/4.jpg')}}" alt="Shoes slide img" />
                        </div>
                        <div class="seq-title">
                            <span data-seq>Save Up to 75% Off</span>
                            <h2 data-seq>Exclusive Shoes</h2>
                            <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
                            <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
                        </div>
                    </li>
                    <!-- single slide item -->
                    <li>
                        <div class="seq-model">
                            <img data-seq src="{{asset('frontend/img/slider/5.jpg')}}" alt="Male Female slide img" />
                        </div>
                        <div class="seq-title">
                            <span data-seq>Save Up to 50% Off</span>
                            <h2 data-seq>Best Collection</h2>
                            <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
                            <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- slider navigation btn -->
            <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
                <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
                <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
            </fieldset>
        </div>
    </div>
</section>
<!-- / slider -->


<!-- Category section -->
<section id="aa-promo">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-promo-area">
                    <div class="row">
                        <div class="col-md-12 no-padding">
                            <div class="aa-promo-right float-none ">
                                @foreach($datas['categories'] as  $category)

                                <div class="aa-single-promo-right">
                                    <div class="aa-promo-banner">
                                        <img src="{{asset('storage/images/product_category/'.$category->image)}}" alt="img">
                                        <div class="aa-prom-content">
                                            <h4><a href="{{url('/category/'.$category->id)}}">{{$category->category_name}}</a></h4>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Category section -->


<section id="aa-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-product-area">
                        <div class="aa-product-inner">
                            <!-- start prduct navigation -->
                            <ul class="nav nav-tabs aa-products-tab">
                                @foreach($datas['categories'] as  $category)
                                    <li class="category_tabs" id="{{$category->id}}">
                                        <a href="#category_id_{{$category->id}}" data-toggle="tab"> {{$category->category_name}}</a>
                                    </li>
                                 @endforeach
                           </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- Start category specific products-->
                                @php
                                $count = 1;
                                @endphp
                                @foreach($datas['categories'] as $category)
                                @php
                                $class = $count == 1 ? "in active" : "";
                                $count++;

                                @endphp

                                <div class="tab-pane fade {{$class}}" id="category_id_{{$category->id}}">
                                    <ul class="aa-product-catg">
                                        <!-- start single product item -->
                                        @if(count($category->products) > 0)
                                        @foreach($category->products as $product)
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="{{asset('storage/images/product/cat_'.$product->category_id.'/'.$product->image)}}">
                                                    <img src="{{asset('storage/images/product/cat_'.$product->category_id.'/'.$product->image)}}" alt="">
                                                </a>
                                                <form id ="shopping_cart" action="addToCart" method="post">
                                                    @csrf
                                                    <a class="aa-add-to-cart-btn" href="javascript:void(0)" onclick="addToCart('{{$product->id}}',1)">Add To Cart</a>
                                                        <span class="fa fa-shopping-cart"></span></a>
                                                    <input type="hidden" name="product_id" value="{{$product->id}}"/>
                                                    <input type="hidden" name="product_quantity" value="1"/>
                                                </form>
                                                    <figcaption>
                                                        <h4 class="aa-product-title"><a href="{{url('single-product/')}}/{{$product->id}}"> {{$product->name}}</a></h4>
                                                        <span class="aa-product-price">€ {{$product->price}}</span>
                                                    </figcaption>
                                            </figure>
                                        </li>
                                        <!-- start single product item -->
                                        @endforeach
                                        @else
                                            <span class="aa-product-price">No product available for this category</span>
                                        @endif

                                    </ul>
                                </div>
                                @endforeach
                                <!-- / men product category -->
                            </div>
                            <!-- quick view modal -->
                            {{--<div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="border:2px solid green">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <div class="row">
                                                <!-- Modal view slider -->
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="aa-product-view-slider">
                                                        <div class="simpleLens-gallery-container" id="demo-1">
                                                            <div class="simpleLens-container">
                                                                <div class="simpleLens-big-image-container">
                                                                    <a class="simpleLens-lens-image" data-lens-image="{{asset('frontend/img/view-slider/large/polo-shirt-1.png')}}">
                                                                    <img src="{{asset('frontend/img/view-slider/medium/polo-shirt-1.png')}}" class="simpleLens-big-image">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="simpleLens-thumbnails-container">
                                                                <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                   data-lens-image="{{asset('frontend/img/view-slider/large/polo-shirt-1.png')}}"
                                                                data-big-image="{{asset('frontend/img/view-slider/medium/polo-shirt-1.png')}}">
                                                                <img src="{{asset('frontend/img/view-slider/thumbnail/polo-shirt-1.png')}}">
                                                                </a>
                                                                <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                   data-lens-image="{{asset('frontend/img/view-slider/large/polo-shirt-3.png')}}"
                                                                data-big-image="{{asset('frontend/img/view-slider/medium/polo-shirt-3.png')}}">
                                                                <img src="{{asset('frontend/img/view-slider/thumbnail/polo-shirt-3.png')}}">
                                                                </a>

                                                                <a href="#" class="simpleLens-thumbnail-wrapper"
                                                                   data-lens-image="{{asset('frontend/img/view-slider/large/polo-shirt-4.png')}}"
                                                                data-big-image="{{asset('frontend/img/view-slider/medium/polo-shirt-4.png')}}">
                                                                <img src="{{asset('frontend/img/view-slider/thumbnail/polo-shirt-4.png')}}">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal view content -->
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="aa-product-view-content">
                                                        <h3>T-Shirt</h3>
                                                        <div class="aa-price-block">
                                                            <span class="aa-product-view-price">$34.99</span>
                                                            <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                                                        <h4>Size</h4>
                                                        <div class="aa-prod-view-size">
                                                            <a href="#">S</a>
                                                            <a href="#">M</a>
                                                            <a href="#">L</a>
                                                            <a href="#">XL</a>
                                                        </div>
                                                        <div class="aa-prod-quantity">
                                                            <form action="">
                                                                <select name="" id="">
                                                                    <option value="0" selected="1">1</option>
                                                                    <option value="1">2</option>
                                                                    <option value="2">3</option>
                                                                    <option value="3">4</option>
                                                                    <option value="4">5</option>
                                                                    <option value="5">6</option>
                                                                </select>
                                                            </form>
                                                            <p class="aa-prod-category">
                                                                Category: <a href="#">Polo T-Shirt</a>
                                                            </p>
                                                        </div>
                                                        <div class="aa-prod-view-bottom">
                                                            <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                            <a href="#" class="aa-add-to-cart-btn">View Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Products section -->
<!-- banner section -->

    @endsection
