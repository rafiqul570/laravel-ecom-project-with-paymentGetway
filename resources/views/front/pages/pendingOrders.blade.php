@include('front.inc.udHeader')
    <!-- Content Area -->
    <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card shadow p-4">
              <h3>All Orders</h3>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="wd-30p text-center">Product</th>
                <th class="wd-15p text-center">Price</th>
                <th class="wd-10p text-center">Quantity</th>
                <th class="wd-10p text-center">Payment Status</th>
                <th class="wd-10p text-center">Delivery Status</th>
              </tr>
            </thead>
            
             @foreach($pendingOrders as $item)

            <tbody>
              <tr>
                <td class="product-col">
                <div class="product">
                 <figure class="product-media">
                  <img src="{{asset('/uploads/image/'.$item->product_img)}}" width="40" />
                 </figure>
                <h3 class="product-title">
                {{$item -> product_name}}
                </h3><!-- End .product-title -->
               </div><!-- End .product -->
                </td>
                <td class="text-center">&#2547 {{number_format($item -> product_price, 2)}}</td>
                <td class="text-center">{{$item -> product_quantity}}</td>
                <td class="text-center">{{$item -> payment_status}}</td>
                <td class="text-center">{{$item -> delivery_status}}</td>
                
              </tr>
            </tbody>
            @endforeach
          </table>
        </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow p-4">
            
         <table class="table table-summary">
            <tbody>
              @php
              $totalQuantity = \App\Models\Order::where('user_id', Auth::id())->sum('product_quantity');
              @endphp
              <tr class="summary-subtotal">
                <td style="font-size:12px">Subtotal({{$totalQuantity}} items and shipping fee included)</td>
                <td id="cart-total">&#2547 {{ number_format($grand_total, 2) }}</td>
              </tr><!-- End .summary-subtotal -->
               
               <tr class="summary-total">
                <td>Total</td>
                <td id="cart-total">&#2547 {{ number_format($grand_total, 2) }}</td>
              </tr><!-- End .summary-total -->
            </tbody>
          </table><!-- End .table table-summary -->
          </div>
        </div>
      </div>
    </div> 
  </div>
@include('front.inc.udFooter')