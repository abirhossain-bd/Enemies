@extends('layouts.dashboardmaster')

@section('title')
Home

@endsection

@section('content')
<x-breadcum title="Home page"></x-breadcum>


<h1>{{ auth()->user()->name }} - {{ auth()->user()->email }}</h1>


<div class="row">

        @if (!$request && auth()->user()->role == 'user' )
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Do you sent request?</h4>
                        @error('feedback')
                            <p class="text-danger text-canter">{{ $message }}</p>
                        @enderror

                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <i class="mdi mdi-help-circle me-1 text-primary"></i>  Do you want to be a blogger?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">

                                                        <form action="{{ route('request.sent' , Auth::user()->id) }}" method="POST" role="form">
                                                            @csrf
                                                            <div class="row mb-3">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Feedback!</label>
                                                                <div class="col-sm-9">
                                                                    <textarea type="text" class="form-control" name="feedback" rows="5"></textarea>

                                                                </div>
                                                            </div>

                                                            <div class="justify-content-end row">
                                                                <div class="col-sm-9">
                                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Send Request</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- end accordion -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        @endif

</div>



@endsection
