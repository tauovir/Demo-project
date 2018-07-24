 
@extends('web.layouts.layout')
@section('body')
<div class="centerWrapper">
            <!-- first slider -->
            <section class="partialViewSlider">
                <div class="owl-carousel" id="firstSlider">
                    <div class="item">
                        <div class="gallerySlide">
                            <div class="ovarlay">
                                <img src="{{url('/')}}/public/web/assets/images/gallery/gallery-image-1.jpg" class="mainImage" alt="">
                                <div class="content">
                                    <h2 class="title">Weekend’s new album ‘Starboy’</h2>
                                    <p class="para">LISTEN NOW</p>
                                </div>
                            </div>
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gallery-bg.png" class="transparentBG" alt="">
                        </div>
                    </div>
                    <div class="item">
                        <div class="gallerySlide">
                            <div class="ovarlay">
                                <img src="{{url('/')}}/public/web/assets/images/gallery/gallery-image-3.jpg" class="mainImage" alt="">
                                <div class="content">
                                    <h2 class="title">Foxes record breaking disc </h2>
                                    <p class="para">LISTEN NOW</p>
                                </div>
                            </div>
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gallery-bg.png" class="transparentBG" alt="">
                        </div>
                    </div>
                    <div class="item">
                        <div class="gallerySlide">
                            <div class="ovarlay">
                                <img src="{{url('/')}}/public/web/assets/images/gallery/gallery-image-2.jpg" class="mainImage" alt="">
                                <div class="content">
                                    <h2 class="title">Foxes record breaking disc </h2>
                                    <p class="para">LISTEN NOW</p>
                                </div>
                            </div>
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gallery-bg.png" class="transparentBG" alt="">
                        </div>
                    </div>
                </div>
            </section>
            <!-- first slider end  -->
            <!-- New Releases -->
            <section class="imageGalleryWrap">
                <h2 class="sectionHead">New Releases <a href="home-view.html" class="viewAll pull-right  textHover">See All</a> </h2>
                <div class="imageGallery grid8">
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-1.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Marvin Gaye</h3>
                        <p class="desc">CHARLIE PUTH</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-2.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Honey</h3>
                        <p class="desc">KHELANI</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-3.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Marvin Gaye</h3>
                        <p class="desc">CHARLIE PUTH</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-4.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Good Old Days</h3>
                        <p class="desc">MACKLEMORE</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-5.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Stargazing</h3>
                        <p class="desc">KYGO</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-6.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Useless</h3>
                        <p class="desc">TERROR JR</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-7.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Help Me Out</h3>
                        <p class="desc">MAROON 5</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-8.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Out Of My Here</h3>
                        <p class="desc">LOOTE</p>
                    </a>
                </div>
            </section>
            <!-- New Releases end-->
            <!-- Trending Videos -->
            <section class="imageGalleryWrap">
                <h2 class="sectionHead">Trending Videos <a href="home-view.html" class="viewAll pull-right textHover">See All</a> </h2>
                <div class="imageGallery grid4">
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg2-1.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Work (feat. Drake)</h3>
                        <p class="desc">RIHANNA</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg2-2.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Stiches</h3>
                        <p class="desc">SHAWN MENDES</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg2-3.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">This is What You Came For</h3>
                        <p class="desc">RIHANNA</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg2-4.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Hotline Bling</h3>
                        <p class="desc">DRAKE</p>
                    </a>
                </div>
            </section>
            <!--Trending Videos end-->
            <!-- second slider  -->
            <section class="partialViewSlider topgap">
                <div class="owl-carousel" id="secondSlider">
                    <div class="item">
                        <div class="gallerySlide">
                            <div class="ovarlay">
                                <img src="{{url('/')}}/public/web/assets/images/gallery/gallery-image2-1.jpg" class="mainImage" alt="">
                            </div>
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gallery-bg.png" class="transparentBG" alt="">
                        </div>
                    </div>
                    <div class="item">
                        <div class="gallerySlide">
                            <div class="ovarlay">
                                <img src="{{url('/')}}/public/web/assets/images/gallery/gallery-image2-2.jpg" class="mainImage" alt="">
                            </div>
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gallery-bg.png" class="transparentBG" alt="">
                        </div>
                    </div>
                    <div class="item">
                        <div class="gallerySlide">
                            <div class="ovarlay">
                                <img src="{{url('/')}}/public/web/assets/images/gallery/gallery-image2-3.jpg" class="mainImage" alt="">
                            </div>
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gallery-bg.png" class="transparentBG" alt="">
                        </div>
                    </div>
                </div>
            </section>
            <!-- second slider  end -->
            <!-- International Music -->
            <section class="imageGalleryWrap">
                <h2 class="sectionHead">International Music <a href="home-view.html" class="viewAll pull-right textHover">See All</a> </h2>
                <div class="imageGallery grid8">
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-1.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Marvin Gaye</h3>
                        <p class="desc">CHARLIE PUTH</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-2.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Honey</h3>
                        <p class="desc">KHELANI</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-3.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Marvin Gaye</h3>
                        <p class="desc">CHARLIE PUTH</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-4.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Good Old Days</h3>
                        <p class="desc">MACKLEMORE</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-5.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Stargazing</h3>
                        <p class="desc">KYGO</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-6.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Useless</h3>
                        <p class="desc">TERROR JR</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-7.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Help Me Out</h3>
                        <p class="desc">MAROON 5</p>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-8.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Out Of My Here</h3>
                        <p class="desc">LOOTE</p>
                    </a>
                </div>
            </section>
            <!-- International Music end-->
            <!-- Trending Artists -->
            <section class="imageGalleryWrap">
                <h2 class="sectionHead">Trending Artists <a href="home-view.html" class="viewAll pull-right textHover">See All</a> </h2>
                <div class="imageGallery artists grid8">
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-1.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Marvin Gaye</h3>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-2.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Honey</h3>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-3.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Marvin Gaye</h3>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-4.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Good Old Days</h3>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-5.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Stargazing</h3>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-6.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Useless</h3>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-7.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Help Me Out</h3>
                    </a>
                    <a href="javascript:void(0)" class="itemWrap">
                        <figure class="imageHover">
                            <img src="{{url('/')}}/public/web/assets/images/gallery/gridimg-8.jpg" class="mainImg" alt="">
                        </figure>
                        <h3 class="title">Out Of My Here</h3>
                    </a>
                </div>
            </section>
            <!-- Trending Artists end-->
            <footer class="footerwrap clearfix">
                <div class="playStore">
                    <a href="javascript:void(0)"> <img src="{{url('/')}}/public/web/assets/images/app-store.png" alt=""></a>
                    <a href="javascript:void(0)"> <img src="{{url('/')}}/public/web/assets/images/google-play.png" alt=""></a>
                </div>
                <p class="copyRight">© 2018 Caltex Music LLC. All Rights Reserved.</p>
                <ul class="footerMenu">
                <li>
                        <a href="javascript:void(0)" class="textHover" data-toggle="modal" data-target="#privacyModal">Privacy Policy </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="textHover" data-toggle="modal" data-target="#termsModal">Terms & Conditions</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="textHover">Help</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="textHover"> Music Submission</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="textHover">Contact Us</a>
                    </li>
                </ul>
            </footer>
        </div>
    @endsection