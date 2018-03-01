            <!-- FOOTER -->
            <footer>
                <div class="footer clearfix">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12">
                                <div class="footerContent">
                                    <a href="index.html" class="footer-logo"><img src="templates/bookingtour/img/logo-color-sm.png" alt="footer-logo"></a>
                                    <p>@lang('lang.about_text')</p>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
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
                            <div class="col-sm-3 col-xs-12">
                                <div class="footerContent imgGallery">
                                    <h5>Gallery</h5>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <a class="fancybox-pop" href=""><img src="templates/bookingtour/img/tour_img_default.jpg" alt="image"></a>
                                        </div>
                                        <div class="col-xs-4">
                                            <a class="fancybox-pop" href=""><img src="templates/bookingtour/img/tour_img_default.jpg" alt="image"></a>
                                        </div>
                                        <div class="col-xs-4">
                                            <a class="fancybox-pop" href=""><img src="templates/bookingtour/img/tour_img_default.jpg" alt="image"></a>
                                        </div>
                                        <div class="col-xs-4">
                                            <a class="fancybox-pop" href=""><img src="templates/bookingtour/img/tour_img_default.jpg" alt="image"></a>
                                        </div>
                                        <div class="col-xs-4">
                                            <a class="fancybox-pop" href=""><img src="templates/bookingtour/img/tour_img_default.jpg" alt="image"></a>
                                        </div>
                                        <div class="col-xs-4">
                                            <a class="fancybox-pop" href=""><img src="templates/bookingtour/img/tour_img_default.jpg" alt="image"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="footerContent">
                                    <h5>@lang('lang.newsletter')</h5>
                                    <p>@lang('lang.newsletter_text')</p>
                                    <div class="input-group">
                                        {{ Form::text('mail-input', '', ['class' => 'form-control', 'placeholder' => trans('lang.enter_mail'), 'aria-describedby' => 'basic-addon21']) }}
                                        <span class="input-group-addon" id="basic-addon21"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
                                    </div>
                                    <ul class="list-inline">
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                                    </ul>
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
                                    <li><a href="#">@lang('lang.privacy_policy')</a></li>
                                    <li><a href="#">@lang('lang.about_us')</a></li>
                                    <li><a href="#">@lang('lang.support')</a></li>
                                    <li><a href="#">@lang('lang.news')</a></li>
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

        {{ Html::script('js/app.js') }}
        {{ Html::script('templates/bookingtour/js/custom.js') }}
    </body>
</html>
