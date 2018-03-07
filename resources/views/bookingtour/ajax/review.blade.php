{{ Html::script('templates/bookingtour/js/script.js') }}

@auth
    {{ Form::hidden('rate-info', '', ['id' => 'rate-info', 'place' => $data['place_rate'], 'food' => $data['food_rate'], 'service' => $data['service_rate'], 'total' => $data['total_rate']]) }}
    {{ Form::open(['class' => 'commentsForm', 'role' => 'form', 'id' => 'review', 'tour' => $data['tour']->id]) }}
        <h3 class="reviewTitle">@lang('lang.leave_review')</h3>
        <p>@lang('lang.want_rate')</p>
        <div value="3" class="rating-show" id="rating-total-show">
            <label class="star-show star-large-show"></label>
            <label class="star-show star-large-show"></label>
            <label class="star-show star-large-show"></label>
            <label class="star-show star-large-show"></label>
            <label class="star-show star-large-show "></label>
        </div>
        <div class="row form-group rate-group">
            <div class="col-md-4 col-xs-12 row form-group" >
                <span class="col-md-3 col-xs-12 rate-show-title">@lang('lang.places'):</span>
                <div class="col-md-9 col-xs-12 rating-select" value="3" id="place-rate">
                    {{ Form::radio('star-place', 5, '', ['class' => 'star-place star-place-5' , 'id' => 'star-place-5']) }}
                    <label class="star-place star-place-5" for="star-place-5"></label>
                    {{ Form::radio('star-place', 4, '', ['class' => 'star-place star-place-4' , 'id' => 'star-place-4']) }}
                    <label class="star-place star-place-4" for="star-place-4"></label>
                    {{ Form::radio('star-place', 3, '', ['class' => 'star-place star-place-3' , 'id' => 'star-place-3']) }}
                    <label class="star-place star-place-3" for="star-place-3"></label>
                    {{ Form::radio('star-place', 2, '', ['class' => 'star-place star-place-2' , 'id' => 'star-place-2']) }}
                    <label class="star-place star-place-2" for="star-place-2"></label>
                    {{ Form::radio('star-place', 1, '', ['class' => 'star-place star-place-1' , 'id' => 'star-place-1']) }}
                    <label class="star-place star-place-1" for="star-place-1"></label>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 row form-group">
                <span class="col-md-3 col-xs-12 rate-show-title">@lang('lang.foods'):</span>
                <div class="col-md-9 col-xs-12 rating-select" value="3" id="food-rate">
                    {{ Form::radio('star-food', 5, '', ['class' => 'star-food star-food-5' , 'id' => 'star-food-5']) }}
                    <label class="star-food star-food-5" for="star-food-5"></label>
                    {{ Form::radio('star-food', 4, '', ['class' => 'star-food star-food-4' , 'id' => 'star-food-4']) }}
                    <label class="star-food star-food-4" for="star-food-4"></label>
                    {{ Form::radio('star-food', 3, '', ['class' => 'star-food star-food-3' , 'id' => 'star-food-3']) }}
                    <label class="star-food star-food-3" for="star-food-3"></label>
                    {{ Form::radio('star-food', 2, '', ['class' => 'star-food star-food-2' , 'id' => 'star-food-2']) }}
                    <label class="star-food star-food-2" for="star-food-2"></label>
                    {{ Form::radio('star-food', 1, '', ['class' => 'star-food star-food-1' , 'id' => 'star-food-1']) }}
                    <label class="star-food star-food-1" for="star-food-1"></label>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 row form-group">
                <span class="col-md-3 col-xs-12 rate-show-title">@lang('lang.services'):</span>
                <div class="col-md-9 col-xs-12 rating-select" value="3" id="service-rate">
                    {{ Form::radio('star-service', 5, '', ['class' => 'star-service star-service-5' , 'id' => 'star-service-5']) }}
                    <label class="star-service star-service-5" for="star-service-5"></label>
                    {{ Form::radio('star-service', 4, '', ['class' => 'star-service star-service-4' , 'id' => 'star-service-4']) }}
                    <label class="star-service star-service-4" for="star-service-4"></label>
                    {{ Form::radio('star-service', 3, '', ['class' => 'star-service star-service-3' , 'id' => 'star-service-3']) }}
                    <label class="star-service star-service-3" for="star-service-3"></label>
                    {{ Form::radio('star-service', 2, '', ['class' => 'star-service star-service-2' , 'id' => 'star-service-2']) }}
                    <label class="star-service star-service-2" for="star-service-2"></label>
                    {{ Form::radio('star-service', 1, '', ['class' => 'star-service star-service-1' , 'id' => 'star-service-1']) }}
                    <label class="star-service star-service-1" for="star-service-1"></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    {{ Form::textarea('comment', '', ['class' => 'form-control', 'rows' => '3', 'placeholder' => trans('lang.comment'), 'id' => 'review-content']) }}
                </div>
            </div>
        </div>
        {{ Form::submit(trans('lang.submit'), ['class' => 'btn buttonCustomPrimary']) }}
    {{ Form::close() }}
@endauth
<h2 class="reviewTitle">@lang('lang.reviews') ({{ count($data['tour']->reviews) }})</h2>
<div class="reviewMedia">
    <ul class="media-list">
        @foreach ($data['reviews'] as $review)
            <li class="media review-list">
                <div class="media-left">
                    {!! html_entity_decode(Html::link('#', Html::image('', 'image-avatar', ['class' => 'media-object']))) !!}
                </div>
                <div class="media-body">
                    <h5 class="media-heading">{{ $review->user->name }}</h5>
                    <div value="{{ $review->total_rate }}" class="rating-show">
                        <label class="star-show"></label>
                        <label class="star-show"></label>
                        <label class="star-show"></label>
                        <label class="star-show"></label>
                        <label class="star-show"></label>
                    </div>
                    <p>{{ $review->content }}</p>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="paginationCenter">
        {{ $data['reviews']->links() }}
    </div>
</div>
