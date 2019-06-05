            <!-- FOOTER -->
            <footer>
                <div class="footer clearfix">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="footerContent">
                                    {!! html_entity_decode(Html::link(route('home'), Html::image(config('setting.footer_logo'), 'footer-logo'), ['class' => 'footer-logo'])) !!}
                                    <p>@lang('lang.about_text')</p>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="footerContent">
                                    <h5>@lang('lang.contact_us')</h5>
                                    <p>@lang('lang.contact_text')</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-home" aria-hidden="true"></i>@lang('lang.address_contact')</li>
                                        <li><i class="fa fa-phone" aria-hidden="true"></i>@lang('lang.phone_contact')</li>
                                        <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailTo:support@startravel.com">@lang('lang.email_contact')</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="footerContent imgGallery">
                                    <h5>Danh mục</h5>
                                    <div class="row">
                                        @if (isset($menuCategories))
                                            @foreach($menuCategories as $category)
                                                <div class="col-xs-4">
                                                    {{ $category->name }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyRight clearfix">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 col-sm-push-6 col-xs-12">
                                <ul class="list-inline">
                                    <li>
                                        {{ Html::link('', trans('lang.privacy_policy')) }}
                                    </li>
                                    <li>
                                        {{ Html::link('', trans('lang.about_us')) }}
                                    </li>
                                    <li>
                                        {{ Html::link('', trans('lang.support')) }}
                                    </li>
                                    <li>
                                        {{ Html::link('', trans('lang.news')) }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-sm-pull-6 col-xs-12">
                                <div class="copyRightText">
                                    <p>@lang('lang.copyright')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        @include('auth.login')
        @include('auth.register')

        {{ Html::script('templates/bookingtour/js/modernizr.custom.js') }}
        {{ Html::script('templates/bookingtour/js/activity-date.js') }}
        {{ Html::script('templates/plugins/revolution/jquery.themepunch.tools.min.js') }}
        {{ Html::script('templates/plugins/revolution/jquery.themepunch.revolution.min.js') }}
        {{ Html::script('templates/plugins/selectbox/jquery.selectbox-0.1.3.min.js') }}
        {{ Html::script('templates/plugins/datepicker/bootstrap-datepicker.js') }}

        {{ Html::script('templates/bookingtour/js/custom.js') }}
        {{ Html::script('templates/bookingtour/js/script.js') }}
    </body>
</html>
