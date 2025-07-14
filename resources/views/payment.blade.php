
@include('front.inc.mollaHeader')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">হোম</a></li>
                <li class="breadcrumb-item"><a href="{{ route('shipping') }}">শিপিং</a></li>
                <li class="breadcrumb-item active" aria-current="page">পেমেন্ট</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                {{-- আমরা পুরো সেকশনটিকে একটি ফর্মের ভিতরে রাখব --}}
                <form action="{{ route('checkout.initiate') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-body p-4">
                                    <h2 class="card-title h5 mb-3">পেমেন্ট মেথড নির্বাচন করুন</h2>
                                    
                                    <div class="payment-methods-list">
                                        <!-- ক্যাশ অন ডেলিভারি -->
                                        <div class="form-check payment-method-item">
                                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                            <label class="form-check-label" for="cod">
                                                ক্যাশ অন ডেলিভারি
                                            </label>
                                        </div>
                                        
                                        <!-- বিকাশ -->
                                        <div class="form-check payment-method-item">
                                            <input class="form-check-input" type="radio" name="payment_method" id="bkash" value="bkash">
                                            <label class="form-check-label" for="bkash">
                                                বিকাশ
                                            </label>
                                        </div>

                                        <!-- ভিসা/মাস্টার কার্ড -->
                                        <div class="form-check payment-method-item">
                                            <input class="form-check-input" type="radio" name="payment_method" id="stripe" value="stripe">
                                            <label class="form-check-label" for="stripe">
                                                ভিসা / মাস্টারকার্ড
                                            </label>
                                        </div>

                                        <!-- ব্যাংক পেমেন্ট / Payoneer -->
                                        <div class="form-check payment-method-item">
                                            <input class="form-check-input" type="radio" name="payment_method" id="bank" value="bank">
                                            <label class="form-check-label" for="bank">
                                                ব্যাংক ট্রান্সফার / Payoneer
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <aside class="col-lg-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body p-4">
                                    <h3 class="summary-title h5">অর্ডার সারাংশ</h3>
                                    
                                    <table class="table table-summary">
                                        <tbody>
                                            <tr class="summary-subtotal">
                                                <td>সাবটোটাল</td>
                                                {{-- কন্ট্রোলার থেকে এই ভেরিয়েবলগুলো পাস করতে হবে --}}
                                                <td>৳ {{ number_format($sub_total ?? 0, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td>শিপিং</td>
                                                <td>৳ {{ number_format($shipping_cost ?? 0, 2) }}</td>
                                            </tr>
                                            <tr class="summary-total">
                                                <td><strong>মোট</strong></td>
                                                <td><strong>৳ {{ number_format($grand_total ?? 0, 2) }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-order">অর্ডার কনফার্ম করুন</button>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>


@include('front.inc.mollaFooter')