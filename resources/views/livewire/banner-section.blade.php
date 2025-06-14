<div>
@if ($banners->count())
    <div class="card my-5 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Nuestros Banners</h5>
        </div>

        <div class="card-body p-0">
            <div id="carouselBanners" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner text-center">

                    @foreach($banners as $index => $banner)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="position-relative">
                                <a href="{{ $banner->link ?? '#' }}">
                                    <img 
                                        src="{{ $banner->image_url ?? asset('storage/' . $banner->image_path) }}"
                                        class="mx-auto d-block banner-img w-100"
                                        alt="Banner {{ $index + 1 }}">
                                </a>

                                @if($banner->link)
                                    <div class="carousel-caption d-none d-md-block">
                                        <a href="{{ $banner->link }}" class="btn btn-sm btn-light shadow">
                                            Ver más
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanners" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselBanners" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-info text-center my-4">
        No hay banners activos por el momento.
    </div>
@endif

</div>



