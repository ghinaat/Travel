@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
<style>
.carousel {
    width: 50%;
    height: 300px;


}

.carousel-container {
    position: relative;
    margin-top: 20px;
    /* Jarak dari atas */



}
</style>


@stop


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class=carousel-container>
                    <div id="carouselExampleIndicators" class="carousel slide mx-auto " data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100"
                                    src="/img/25 Best Things to Do in Java (Indonesia) - The Crazy Tourist.jpg"
                                    alt="First slide" class='responsive-image'>

                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="/img/sean-oulashin-KMn4VEeEPR8-unsplash.jpg"
                                    alt="Second slide" class='responsive-image'>


                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="/img/Panorama Pantai.jpg" alt="Third slide"
                                    class='responsive-image'>

                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-7 py-5 wrap-about pb-md-1 ftco-animate">
                    <div class="heading-section heading-section-wo-line pt-md-1 pl-md-5 mb-5">
                        <div class="ml-md-0">
                            <span class="subheading">Welcome to Travelucky</span>
                            <h2 class="mb-4">Welcome To Our Travel Agent</h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop