<section class="singlePackage">
    <div class="row ">
        <div class="col-sm-12 col-xs-12">
            <div id="package-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#package-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#package-carousel" data-slide-to="1" class=""></li>
                    <li data-target="#package-carousel" data-slide-to="2" class=""></li>
                    <li data-target="#package-carousel" data-slide-to="3" class=""></li>
                    <li data-target="#package-carousel" data-slide-to="4" class=""></li>
                </ol>
                <div class="carousel-inner slide-img">
                    @foreach ($data['new_tours'] as $tour)
                        <div class="item {{ ($loop->iteration == 1) ? 'active' : ''}} slide-main">
                            <a href="{{ route('client.tour.show', $tour->id) }}">
                                {{ Html::image($tour->picture_path , 'slide', ['class' => 'd-block w-100']) }}
                                <div class="carousel-caption d-none d-md-block slide-content animated bounceInDown">
                                    <h1>{{ $tour->name }}</h1>
                                    <p>{{ str_limit($tour->description) }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                {!! html_entity_decode(Html::link('#package-carousel', '<span class="glyphicon glyphicon-menu-left"></span>', ['class' => 'left carousel-control slide-control' ,'data-slide' => 'prev'])) !!}
                {!! html_entity_decode(Html::link('#package-carousel', '<span class="glyphicon glyphicon-menu-right"></span>', ['class' => 'right carousel-control slide-control' ,'data-slide' => 'next'])) !!}
            </div>
        </div>
    </div>
</section>
