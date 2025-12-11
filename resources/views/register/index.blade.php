@extends('layout.login')
@section('content')

<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-md-8 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    {{-- <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol> --}}
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="{{ asset('images\foto-login2.png') }}" alt="First slide">
                            <div class="carousel-caption">
                                <h1 class="display-3 text-white">D'JAGAD LAND GROUP</h1>
                                <h3 class="text-white text-uppercase mb-3">Make Your Living Harmony</h3>
                            </div>
                        </div>
                        {{-- <div class="carousel-item">
                            <img class="d-block img-fluid" src="https://katalog.djagadland.com/wp-content/uploads/2021/12/type-28-0-600x450.jpg" alt="Second slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>This is Heaven</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg" alt="Third slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>This is Heaven</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-4 login-sec">
                <h2 class="text-center">Register</h2>
                <form class="login-form" action="/register" method="post">
                    @csrf
                    @if (session()->has('loginError'))
                        <script>
                            $(document).ready(function(){
                                $("#myModal .modal-title").text("Login Gagal!");
                                $("#myModal .modal-body p").text("{{ session('loginError') }}");
                                $("#myModal").modal('show');
                            });
                        </script>
                    @endif
                        

                    <!-- register.index.blade.php -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <input type="text" id="name" class="form-control @error('name') is-invalid 
                                      @enderror" name="name" placeholder="Name" value="{{ old('name') }}"/>
                          
                                      @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                      @enderror
                    </div>
                    <div class="form-group">                        
                        <input type="phone" id="phone" class="form-control @error('phone') is-invalid                        
                                    @enderror" name="phone"  placeholder="Phone Number" value="{{ old('phone') }}"/>
                                
                                    @error('phone')
                                        <div class="invalid-feedback">
                                          {{ $message }}
                                        </div>
                                    @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" class="form-control @error('email') is-invalid                        
                                    @enderror" name="email"  placeholder="Email" value="{{ old('email') }}"/>
                                
                                    @error('email')
                                        <div class="invalid-feedback">
                                          {{ $message }}
                                        </div>
                                    @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" class="form-control @error('password') is-invalid                        
                                    @enderror" name="password"  placeholder="Password" />
                                
                                    @error('password')
                                        <div class="invalid-feedback">
                                          {{ $message }}
                                        </div>
                                    @enderror
                    </div>
                    
<div class="form-group d-flex justify-content-center">
    <button type="submit" class="btn btn-login mx-auto my-auto">Register</button>
</div>

                                       
                </form>
                <div class="form-group d-flex justify-content-center">
                <a class="forgot text-center" href="/">Have any account?</a>
            </div> 
            </div>            
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade ">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
            </div>
        </div>
    </div>


    {{-- <div id="myModalSuccess" class="modal fade ">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header bg-success">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p></p>

                </div>
            </div>
        </div>
    </div> --}}
</section>

@endsection