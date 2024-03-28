@extends('frontend.layout.app')
@section('content')
    <div class="container">
        <div class="header">
            <div class="row">
                <div class="col-md 4">
                    <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 h6" href="{{ url('/login') }}">Login </a>
                            <span class="ms-1">|</span>
                            <a class="text-center ms-3 h6" href="{{ url('/registration') }}">Registration</a>
                        </span>
                    </div>
                </div>

            </div>
        </div>
        <div class="row justify-content-right">
            <div class="col-md-10 animated fadeIn col-lg-10 center-screen">
                <h2>Et qui curae eos? Aute. Illo? Excepturi harum lacus, mi nam impedit nemo eveniet, volutpat lacinia omnis
                    penatibus rutrum magnis feugiat soluta architecto tempus corporis. Adipisci! Ducimus beatae?
                    <hr>
                    <a href="{{ url('/login') }}" class="btn bg-gradient-info">Login</a>
                </h2>



            </div>

        </div>

    </div>
@endsection
