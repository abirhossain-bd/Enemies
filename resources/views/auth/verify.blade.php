@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin: 180px 0">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">

                    @if (session('message'))
                    <p>{{ session('message') }}</p>

                    @endif

                    @if (Auth::user() && Auth::user()->hasVerifiedEmail())
                        <script>
                            window.location.href = "{{ route('dashboard') }}";
                        </script>
                    @endif
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div style="background-color:#16a085; display:inline; padding: 10px 20px; border-radius:5px  ">
                            <button style="color: white; text-decoration: none;" type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Please send your verification e-mail!') }}</button>.
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
