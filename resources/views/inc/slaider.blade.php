<!-- Banner Slider + Side Promo -->
<div class="container mt-5">
  <div class="row">
    <!-- Slider -->
    <div class="col-lg-8 mb-3">
      <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner rounded">
          <div class="carousel-item active">
            <img style="height: 370px;" src="{{asset('frontend/img/banner/banner-1.jpg')}}" class="d-block w-100" alt="Banner 1">
          </div>
          <div class="carousel-item">
            <img style="height: 370px;" src="{{asset('frontend/img/banner/banner-2.jpg')}}" class="d-block w-100" alt="Banner 2">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>

    <!-- Promo Banners -->
    <div class="col-lg-4 d-flex flex-column gap-3">
      <a href="#"><img src="{{asset('frontend/img/proimage3.jpg')}}" class="img-fluid rounded w-100" alt="Promo 2"></a>
    </div>
  </div>
</div>