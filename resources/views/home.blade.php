@extends('adminlte::page')


@section('content_header')
    @include('head')
    <h2 class="m-0 text-dark">Gestión de Carnets Piscícola New York S.A</h2>
@stop
@section('content')   
<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-1"> <!-- Modificado el tamaño del contenedor -->
            <div id="carouselExampleRide" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/IMAGEN_1.jpg') }}" class="d-block w-100 mx-auto h-auto"
                            alt="Imagen 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/IMAGEN_2.jpg') }}" class="d-block w-100 mx-auto h-auto"
                            alt="Imagen 2">
                    </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/IMAGEN_3.jpg') }}" class="d-block w-100 mx-auto img-fluid h-100" alt="Imagen 3">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/IMAGEN_4.jpg') }}" class="d-block w-100 mx-auto img-fluid h-100" alt="Imagen 4">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/IMAGEN_5.jpg') }}" class="d-block w-100 mx-auto img-fluid h-100" alt="Imagen 5">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/IMAGEN_6.jpg') }}" class="d-block w-100 mx-auto img-fluid h-100" alt="Imagen 6">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/IMAGEN_7.jpg') }}" class="d-block w-100 mx-auto img-fluid h-100" alt="Imagen 7">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/IMAGEN_8.jpg') }}" class="d-block w-100 mx-auto img-fluid h-100" alt="Imagen 8">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/IMAGEN_9.jpg') }}" class="d-block w-100 mx-auto img-fluid h-100" alt="Imagen 9">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/IMAGEN_10.jpg') }}" class="d-block w-100 mx-auto img-fluid h-100" alt="Imagen 10">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/IMAGEN_11.jpg') }}" class="d-block w-100 mx-auto img-fluid h-100" alt="Imagen 11">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/IMAGEN_12.jpg') }}" class="d-block w-100 mx-auto img-fluid h-100" alt="Imagen 12">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/IMAGEN_13.jpg') }}" class="d-block w-100 mx-auto img-fluid h-100" alt="Imagen 13">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

    @stop
    @include('foot')
