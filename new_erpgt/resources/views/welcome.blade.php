@extends('layouts.site')

@section('body')
welcome-page
@endsection

@section('content')
<nav id="mainNav" class="navbar navbar-toggleable-sm fixed-top mobile-fixed">
    <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navMenu" aria-controls="nav-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ url('/') }}">{{ Html::image('/images/erpgt50.png', 'logo ERPGT') }}</a>
    <div class="collapse navbar-collapse" id="navMenu" aria-expanded="false" style="">
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item">
                <a class="page-scroll nav-link" href="#section-2">About</a>
            </li>
            {{-- <li class="nav-item">
                <a class="page-scroll nav-link" href="#section-3">Temoignages</a>
            </li>
            <li class="nav-item">
                <a class="page-scroll nav-link" href="#section-4">Tarif</a>
            </li> --}}
            <li class="nav-item">
                <a class="page-scroll nav-link" href="#section-5">Contact</a>
            </li>
        </ul>
    </div>
</nav>
<section id="section-1" class="parallax">
    <div class="container-fluid">
        <div class="row">
            <div id="intro" class="col-lg-6 offset-lg-1 col-xs-12 text-center">
                {{ Html::image('/images/erpgt.png', 'logo ERPGT') }}
                <p class='text-white'>Votre outil de gestion technique pour les établissements recevant du public</p>
                <div class='row justify-content-center'>
                    <div class="col-sm-4 col-md-3 col-xs-12">
                    @if (Auth::guest())
                        <a href="{{ url('/login') }}" class="btn btn-lg btn-light-dark">Connexion</a>
                    @else
                        <a href="{{ url('/home') }}" class="btn btn-lg btn-light-dark">Dashboard</a>
                    @endif
                    </div>
                    <div class="col-sm-4 col-md-3 col-xs-12">
                        <a href="#section-5" class="btn btn-lg btn-blue">Nous contacter</a>
                    </div>
                </div>
            </div>
            <div id="slider" class="col-lg-4 col-xs-12" >
                {{-- <img src="/images/mac_500_2.png" alt="" class="img-fluid animated slide-right"> --}}
                <div class="mac_slider">
                    <div class="mac_inner flexslider">
                        <ul class="slides">
                            <li>
                            	{{ Html::image('/images/mini_slide_1.png', 'mini_slide_1') }}
                            </li>
                            <li>
                            	{{ Html::image('/images/mini_slide_1.png', 'mini_slide_2') }}
                            </li>
                            <li>
                            	{{ Html::image('/images/mini_slide_1.png', 'mini_slide_3') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="section-2" class="bg-white">
    <div class="container-fluid">
        <div class="row justify-content-center heading">
            <div class="col-xs-12 text-center">
                <h2 class="section-heading text-uppercase text-black">ERPGT, l'outil qui simplifie votre quotidien !</h2>
                <hr class="separator">
                <p>Une multitude de fonctionnalités dans le but d'augmenter les performances de la gestion technique des équipements</p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="feature-right animated slide-left">
                    <div class="text">
                        <div class="clearfix feature-heading">
                            <h3><a href="#">Optimiser la communication</a></h3>
                            <a href="#" class="icon">
                                <i class="fa fa-mobile-phone"></i>
                            </a>
                        </div>
                        <p>Permet d’améliorer les échanges entre les techniciens, les planneurs et les facilities managers.</p>
                    </div>
                </div>
                <div class="feature-right animated slide-left">
                    <div class="text">
                        <div class="clearfix feature-heading">
                            <h3 class="" ><a href="#">Suivi des consommations</a></h3>
                            <a href="#" class="icon">
                                <i class="fa fa-line-chart"></i>
                            </a>
                        </div>
                        <p>BlablablbalblablablabalbalbBlablablbalblablablabalbalbBlablablbalblablablabalbalbBlablablbalblablablabalbalbBlablablbalblablablabalbalb</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center pt-lg-5 pb-5">
                {{ Html::image('/images/laptop_500_full.png', 'laptop_500_full', ['class' => "hidden-md-only img-fluid"]) }}
                {{ Html::image('/images/ipad_500.png', 'ipad_500', ['class' => "hidden-lg-up hidden-sm-down img-fluid"]) }}
            </div>
            <div class="col-md-6 hidden-lg-up hidden-sm-down text-center pt-lg-5 pb-5">
                {{ Html::image('/images/ipad_500_2.png', 'ipad_500_2', ['class' => "img-fluid"]) }}
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-left animated slide-right">
                    <div class="text">
                        <div class="clearfix feature-heading">
                            <h3><a href="#">Gestion des équipements par QRcode</a></h3>
                            <a href="#" class="icon">
                                <i class="fa fa-bar-chart"></i>
                            </a>
                        </div>
                        <p>BlablablbalblablablabalbalbBlablablbalblablablabalbalbBlablablbalblablablabalbalbBlablablbalblablablabalbalbBlablablbalblablablabalbalb</p>
                    </div>
                </div>
                 <div class="feature-left animated slide-right">
                    <div class="text">
                        <div class="clearfix feature-heading">
                            <h3><a href="#">Suivi des interventions par site</a></h3>
                            <a href="#" class="icon">
                                <i class="fa fa-medkit"></i>
                            </a>
                        </div>
                        <p>Controlez, Organisez, Planifiez vos interventions de maintenance</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- <section id="section-3" class="parallax">
    <div class="bg-opacity-light"></div>
    <div class="container-fluid">
        <div class="row pt-5 justify-content-center">
        </div>
    </div>
</section> --}}
{{-- <section id="section-4" class="bg-light">
    <div class="container-fluid">
        <div class="row justify-content-center heading">
            <div class="col-xs-12 text-center">
                <h2 class="section-heading text-uppercase text-black">Un prix abordable</h2>
                <hr class="separator">
                <p>Choississez votre abonnement en fonction de vos besoins</p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-around">
            <div class="col-lg-3 col-md-4 prices text-center">
                <h2>Basic</h2>
                <p class="text-grey">Tester l'outil <i>(Offre valable jusqu'au 30 Septembre 2017, passé cette date passage à l'abonnement standard)</i></p>
                <ul class="list-unstyled">
                    <li>Modules basic</li>
                    <li>Offre test</li>
                </ul>
                <p class="p-price"><a href="" class="btn btn-green">0.99€ /Mois</a></p>
            </div>
            <div class="col-lg-3 col-md-4 prices text-center">
                <h2>Standard</h2>
                <p class="text-grey">Tout ce qu'il vous faut pour gérer votre staff et vos athlètes</p>
                <ul class="list-unstyled">
                    <li>Abonnement annuel</li>
                    <li>Modules basic</li>
                    <li>Modules avancés</li>
                    <li>Support technique</li>
                </ul>
                <p class="p-price"><a href="" class="btn btn-green">200€ /An</a></p>
            </div>
            <div class="col-lg-3 col-md-4 prices text-center">
                <h2>Premium</h2>
                <p class="text-grey">Une offre sur mesure</p>
                <p class="text-grey">Nous analyserons votre demande pour répondre au mieux à vos besoins</p>
                <p class="p-price"><a href="" class="btn btn-green">Demander votre Devis</a></p>
            </div>
        </div>
    </div>
</section> --}}
<section id="section-5" class="">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-sm-8 contact">
                <h4 class="text-center mt-4 mb-4 text-green">Contactez-nous</h4>
                {!! Form::open(['url' => 'contact', 'method' => 'post']) !!}
                    @if(session()->has('ok'))
                    <div class="row">
                        <p class="text-center col-12">{!! session('ok') !!}</p>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('company') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                    <input type="text" id="company" name="company" class="form-control" placeholder="Société" value="" required>
                                    @if($errors->has('company'))
                                    <span class="text-danger">{{ $errors->first('company') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('Name') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="Name" name="Name" class="form-control" placeholder="Nom" value="" required>
                                    @if($errors->has('Name'))
                                    <span class="text-danger">{{ $errors->first('Name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="" required>
                                    @if($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('phone') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="0601020304" value="">
                                    @if($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('comment') ? ' has-danger' : '' }}">
                                <textarea rows="4" name="comment" id="comment" class="form-control" placeholder="Votre demande..." required></textarea>
                                @if($errors->has('comment'))
                                <span class="text-danger">{{ $errors->first('comment') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="form-group text-right">
                        <button class="btn btn-green" type="submit">Envoyer</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
<footer class="footer text-center bg-grey-dark">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                {{ Html::image('/images/erpgt50.png', 'logo ERPGT') }}
                {{-- <ul class="list-inline">
                    <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li class="list-inline-item li-last"><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul> --}}
                <span class="text-grey-light">ERPGT © 2017. All Rights Reserved.</span>
            </div>
        </div>
    </div>
</footer>
@endsection

@section('scripts')
<script type="text/javascript">
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            directionNav: false,
        });
    });
</script>
@endsection