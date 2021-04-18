
@extends('frontend.layout-main')
@section('mainContent')

<section id="cart-view">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-view-area">
                    <div class="cart-view-table">
                            <form  id="shopping_carts" action="addToCart" method="post" enctype="multipart/form-data">

                            <div class="table-responsive">
                                <table class="table" id="cartTable">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @php $total = 0;
                                        @endphp
                                    @foreach($cart_items as $item)

                                            @php $total += ($item->price * $item->product_quantity);
                                            @endphp
                                    <form  id="shopping_cart" action="addToCart" method="post" enctype="multipart/form-data">
                                        <tr id="product_id_{{$item->product_id}}">
                                            <input type="hidden" name="product_id" value="{{$item->product_id}}"/>
                                            <input type="hidden" name="product_price" value="{{$item->price}}"/>

                                            <td><a class="remove" href="javascript:void(0)" onclick=""><fa class="fa fa-close"> Remove</fa></a></td>
                                            <td><a href="#"><img src="{{asset('storage/images/product/cat_'.$item->category_id.'/'.$item->image)}}" alt="img"></a></td>
                                            <td><a class="aa-cart-title" href="{{url('single-product/')}}/{{$item->product_id}}">{{$item->name}}</a></td>
                                            <td  id="item_price_{{$item->product_id}}">€ {{$item->price}}</td>
                                            <td>
                                                <input
                                                    id="product_quantity_{{$item->product_id}}"  name="product_quantity "class="aa-cart-quantity" type="number"
                                                    value="{{$item->product_quantity}}" min="0" max="100">
                                            </td>
                                            <td class="item_total" id="item_total_{{$item->product_id}}">€ {{$item->price * $item->product_quantity}}</td>

                                        </tr>
                                    </form>
                                    <tr>
{{--                                        <td><a class="remove" href="#"><fa class="fa fa-close"></fa></a></td>--}}
{{--                                        @foreach($cart_item->details as $item)--}}
{{--                                            <td><a href="#"><img src="{{asset('storage/images/product/cat_'.$item->category_id.'/'.$item->image)}}" alt="img"></a></td>--}}
{{--                                            <td><a class="aa-cart-title" href="#">{{$item->name}}</a></td>--}}
{{--                                            <td>€ {{$item->price}}</td>--}}
{{--                                            <td><input class="aa-cart-quantity" type="number" value="{{$cart_item->product_quantity}}"></td>--}}
{{--                                            <td>{{$cart_item->product_quantity * $item->price}}</td>--}}
{{--                                        @endforeach--}}
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" class="aa-cart-view-bottom">
                                            <div class="aa-cart-coupon">
                                                <input class="aa-coupon-code" type="text" placeholder="Coupon">
                                                <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                                            </div>
                                            <input class="aa-cart-view-btn" type="submit" value="Update Cart">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <!-- Cart Total view -->
                        <div class="cart-view-total">
                            <h4>Cart Totals</h4>
                            <table class="aa-totals-table" id="totalTable">
                                <tbody>
                                <tr>
                                    <th>Subtotal</th>
                                    <td class="subtotal">€ {{$total}}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td class="grandtotal">€ {{$total}}</td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



<script>
  function updateCart(id)
  {
   console.log(id);
    addToCart(id);
  }


</script>

