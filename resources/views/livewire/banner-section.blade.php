<div class="section-banner">
    @if ($banners->count())
        <div id="carouselBanners" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
            <div class="carousel-inner text-center">
                @foreach($banners as $index => $banner)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="position-relative">
                            <a href="{{ $banner->link ?? '#' }}">
                                <img 
                                    src="{{ $banner->image_url ?? asset('storage/' . $banner->image_path) }}"
                                    class="banner-img"
                                    alt="Banner {{ $index + 1 }}">
                            </a>
                            @if($banner->link)
                                <div class="carousel-caption d-none d-md-block">
                                    <a href="{{ $banner->link }}" class="btn btn-sm btn-light shadow-sm">
                                        Ver más
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanners" data-bs-slide="prev" aria-label="Anterior">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselBanners" data-bs-slide="next" aria-label="Siguiente">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>

            
        </div>
    @else
        <div class="alert alert-info text-center my-4">
            No hay banners activos por el momento.
        </div>
    @endif
</div>










