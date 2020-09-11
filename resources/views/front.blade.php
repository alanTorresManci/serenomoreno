@extends('template')
    @section('content')
    {{-- <a onclick="topFunction()" id="myBtn" title="Go to top">Top</button> --}}
    <a href="https://wa.link/vvc3lj" id="myBtn" target="_blank"><span class="icon icon-whatsapp whats"></span></a>
    {{-- Header Inicial --}}
    <div class="hero-wrap js-fullheight" style="background-image: url('front_images/logo_header.png');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
                <div class="col-xl-10 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                    <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">SERENO MORENO<br><span>TESORO DE ORIGEN</span></h1>
                    <p class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Café 100% mexicano y orgánico</p>
                    {{-- <div id="timer" class="d-flex mb-3">
                        <div class="time" id="days"></div>
                        <div class="time pl-4" id="hours"></div>
                        <div class="time pl-4" id="minutes"></div>
                        <div class="time pl-4" id="seconds"></div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- Fin Header Inicial --}}

    {{-- Nosotros --}}
    <section class="ftco-counter img" id="section-counter">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6 pl-md-5 py-5">
                    <div class="row justify-content-start pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            {{-- <span class="subheading">Fun Facts</span> --}}
                            <h2 class="mb-4"><span>{!! $us->title !!}</span></h2>
                            <p>{!! nl2br($us->text) !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="img d-flex align-self-stretch" style="background-image:url({{ Storage::url(config('constants.base_image_path').$us->image) }});"></div>
                </div>
            </div>
        </div>
    </section>
    {{-- Fin Nosotros --}}

    {{-- Café del mes --}}
    <section class="ftco-counter img" id="section-counter">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6 d-flex">
                    <div class="img d-flex align-self-stretch" style="background-image:url({{ Storage::url(config('constants.base_image_path').$month->image) }});"></div>
                </div>
                <div class="col-md-6 pl-md-5 py-5">
                    <div class="row justify-content-start pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            {{-- <span class="subheading">Fun Facts</span> --}}
                            <h2 class="mb-4"><span>{!! $month->title !!}</span></h2>
                            <p>{!! nl2br($month->text) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Fin Café del mes --}}

    {{-- Planes --}}
    <section class="ftco-section bg-light" id="planes">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <h2 class="mb-1">Estos son nuestros <span>Planes</span></h2>
                </div>
            </div>
            <div class="row">
                @foreach ($plans as $key => $plan)
                    <div class="col-md-4 ftco-animate">
                        <div class="block-7">
                            <div class="text-center">
                                <h2 class="heading">{{ $plan->name }}</h2>
                                <span class="price"><sup>$</sup> <span class="number">{{ $plan->price }}</span></span>
                                <span class="excerpt d-block">por Mes + Envío</span>

                                <h3 class="heading-2 my-4">Disfruta de </h3>

                                <ul class="pricing-text mb-5">
                                    @foreach ($plan->attributes as $key => $attribute)
                                        <li>{{ $attribute->attribute }}</li>
                                    @endforeach
                                </ul>

                                <a href="#" class="btn btn-primary d-block px-2 py-3 modal-opener" planId="{{ $plan->id }}">Suscribirse</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Fin Planes --}}

    <div id="myModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Estas por unirte a SERENO MORENO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                    {{-- <form id="joinForm" method="POST" action="{{ route('subscribe') }}"> --}}
                    <form id="joinForm" method="POST" action="{{ route('sendEmail') }}">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nombre:</label>
                            <input required="required" type="text" class="form-control" name="name" placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Apellidos:</label>
                            <input required="required" type="text" class="form-control" name="last_name" placeholder="Apellidos">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Correo electrónico:</label>
                            <input required="required" type="email" class="form-control" name="email" placeholder="Correo electrónico">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Fecha de nacimiento:</label>
                            <input type="date" class="form-control" name="birthday" placeholder="07/07/07">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Teléfono:</label>
                            <input required="required" type="number" class="form-control" name="phone" placeholder="Teléfono">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Modo de preparación:</label>
                            <input required="required" type="text" class="form-control" name="grain_type" placeholder="Modo de preparación">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Dirección:</label>
                            <input required="required" type="text" class="form-control" name="address" placeholder="Av. Siempre Viva 742">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Código Postal:</label>
                            <input required="required" type="text" class="form-control" name="pc" placeholder="Código Postal">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Contraseña:</label>
                            <input required="required" type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Confirmación de Contraseña:</label>
                            <input required="required" equalTo="#password" type="password" class="form-control" name="password_confirmation" placeholder="Confirmación de Contraseña">
                        </div>

                        <input type="hidden" name="plan_id" id="plan_id" value="">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="joinButton">Unirse</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Nuestro Equipo --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2 class="mb-4"><span>Conócenos</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="carousel-testimony owl-carousel">
                        @foreach ($products as $key => $product)
                            <div class="item">
                                <div class="speaker">
                                    <img class="img-fluid" alt="Colorlib HTML5 Template" src="{{ Storage::url(config('constants.base_image_path').$product->image) }}">
                                    <div class="text text-center py-3">
                                        <h3>{{ $product->title }}</h3>
                                        <span class="position">{{ $product->description }}</span>
                                        {{-- <ul class="ftco-social mt-3">
                                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                                    </ul> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Fin Nuestro Equipo --}}

    {{-- Blog --}}
    {{-- <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2><span>Nuestro</span> Blog</h2>
                </div>
            </div>
            <div class="row d-flex">
                <div class="col-md-4 d-flex ftco-animate">
                    <div class="blog-entry justify-content-end">
                        <a href="blog-single.html" class="block-20" style="background-image: url('front_images/image_1.jpg');">
                        </a>
                        <div class="text p-4 float-right d-block">
                            <div class="d-flex align-items-center pt-2 mb-4">
                                <div class="one">
                                    <span class="day">07</span>
                                </div>
                                <div class="two">
                                    <span class="yr">2019</span>
                                    <span class="mos">January</span>
                                </div>
                            </div>
                            <h3 class="heading mt-2"><a href="#">Why Lead Generation is Key for Business Growth</a></h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex ftco-animate">
                    <div class="blog-entry justify-content-end">
                        <a href="blog-single.html" class="block-20" style="background-image: url('front_images/image_2.jpg');">
                        </a>
                        <div class="text p-4 float-right d-block">
                            <div class="d-flex align-items-center pt-2 mb-4">
                                <div class="one">
                                    <span class="day">07</span>
                                </div>
                                <div class="two">
                                    <span class="yr">2019</span>
                                    <span class="mos">January</span>
                                </div>
                            </div>
                            <h3 class="heading mt-2"><a href="#">Why Lead Generation is Key for Business Growth</a></h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex ftco-animate">
                    <div class="blog-entry">
                        <a href="blog-single.html" class="block-20" style="background-image: url('front_images/image_3.jpg');">
                        </a>
                        <div class="text p-4 float-right d-block">
                            <div class="d-flex align-items-center pt-2 mb-4">
                                <div class="one">
                                    <span class="day">06</span>
                                </div>
                                <div class="two">
                                    <span class="yr">2019</span>
                                    <span class="mos">January</span>
                                </div>
                            </div>
                            <h3 class="heading mt-2"><a href="#">Why Lead Generation is Key for Business Growth</a></h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- Fin Blog --}}

    {{-- Testimonios --}}
    <section class="ftco-section testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    {{-- <span class="subheading">Testimonial</span> --}}
                    <h2 class="mb-4"><span>Clientes</span> Felices</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">
                        <div class="item">
                            <div class="testimony-wrap text-center py-4 pb-5">
                                <div class="user-img mb-4" style="background-image: url(front_images/person_1.jpg)">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                </div>
                                <div class="text">
                                    <p class="mb-4">Enamorado del café, una experiencia maravillosa</p>
                                    <p class="name">Pedro Sanchez</p>
                                    <span class="position">Excelente</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap text-center py-4 pb-5">
                                <div class="user-img mb-4" style="background-image: url(front_images/person_3.jpg)">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                </div>
                                <div class="text">
                                    <p class="mb-4">Uno de los mejores servicios que he contratado, 100% recomendado</p>
                                    <p class="name">Mariano Rivera</p>
                                    <span class="position">Una Maravilla</span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="item">
                            <div class="testimony-wrap text-center py-4 pb-5">
                                <div class="user-img mb-4" style="background-image: url(front_images/person_2.jpg)">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                </div>
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Roger Scott</p>
                                    <span class="position">Interface Designer</span>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="item">
                            <div class="testimony-wrap text-center py-4 pb-5">
                                <div class="user-img mb-4" style="background-image: url(front_images/person_1.jpg)">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                </div>
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Roger Scott</p>
                                    <span class="position">Web Developer</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap text-center py-4 pb-5">
                                <div class="user-img mb-4" style="background-image: url(front_images/person_1.jpg)">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                </div>
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Roger Scott</p>
                                    <span class="position">System Analyst</span>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Fin Testimonios --}}

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    {{-- <span class="subheading">Schedule</span> --}}
                    <h2 class="mb-4">PREGUNTAS FRECUENTES</h2>
                </div>
            </div>
            <div class="ftco-search">
                <div class="row">
                    {{-- <div class="col-md-12 nav-link-wrap">
                        <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link ftco-animate active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Day 01 <span>21 Dec. 2019</span></a>

                            <a class="nav-link ftco-animate" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Day 02 <span>22 Dec. 2019</span></a>

                            <a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Day 03 <span>23 Dec. 2019</span></a>

                            <a class="nav-link ftco-animate" id="v-pills-4-tab" data-toggle="pill" href="#v-pills-4" role="tab" aria-controls="v-pills-4" aria-selected="false">Day 04 <span>24 Dec. 2019</span></a>

                        </div>
                    </div> --}}
                    <div class="col-md-12 tab-wrap">

                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">
                                @foreach ($questions as $key => $question)
                                    <div class="speaker-wrap ftco-animate d-flex">
                                        <div class="img speaker-img questions" style="background-color: #28818F">{!! $key + 1 !!}</div>
                                        <div class="text pl-md-5">
                                            {{-- <span class="time">08: - 10:00</span> --}}
                                            <h2>{!! $question->question !!}</h2>
                                            <p>{!! nl2br($question->answer) !!}</p>
                                            {{-- <h3 class="speaker-name">&mdash; <a href="#">Brett Morgan</a> <span class="position">Founder of Wordpress</span></h3> --}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Galeria Insta --}}
    <section class="ftco-gallery">
        <div class="container-wrap">
            <div class="row no-gutters">
                @for ($i=0; $i < 4; $i++)
                    <div class="col-md-3 ftco-animate">
                        <a href="{{ $instaPosts[$i]->node->display_url }}" class="gallery image-popup img d-flex align-items-center" style="background-image: url({{ $instaPosts[$i]->node->display_url }})">
                            <div class="icon mb-4 d-flex align-items-center justify-content-center">
                                <span class="icon-instagram"></span>
                            </div>
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </section>
    {{-- Fin Galeria Insta --}}


    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="https://www.facebook.com/serenomorenocafe" target="_blank"><span class="icon-facebook" style="color: white !important;"></span></a></li>
                            <li class="ftco-animate"><a href="https://www.instagram.com/serenomoreno_cafe" target="_blank"><span class="icon-instagram" style="color: white !important;"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">

                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">

                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">¿Dudas?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><a href="https://wa.link/vvc3lj" target="_blank"><span class="icon icon-whatsapp"></span><span class="text">33 1828 0844</span></a></li>
                                <li><a href="mailto:mailto:sereno.moreno.mex@gmail.com"><span class="icon icon-envelope"></span><span class="text" style="text-transform: lowercase !important;">sereno.moreno.mex@gmail.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg>
    </div>

    @endsection
    @section('js')

    <script type="text/javascript">
        mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            mybutton.style.display = "block";
        }

        $(document).ready(function () {
            $('#joinForm').validate();
            $('#joinButton').click(function(e) {
                $('#joinForm').submit();
            });
            $('.modal-opener').click(function (e) {
                $('#myModal').modal('toggle');
                $('#plan_id').val($(this).attr('planId'));
                e.preventDefault();
            });
        });
    </script>
    @endsection
