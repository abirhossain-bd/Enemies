@extends('layouts.dashboardmaster')
@section('title')
    Request
@endsection

@section('content')
<x-breadcum title="Request show page"></x-breadcum>


<div class="row">
    @forelse ($requests as $req)
        <div class="col-md-3">
            <div class="card">
                <div style="margin-top: 20px">
                    @if ($req->oneuser->image == 'default.jpeg')

                    <img style="height: 250px; object-fit:contain" class="card-img-top img-fluid" src="{{ asset('uploads/default') }}/{{ $req->oneuser->image }}">
                    @else

                    <img style="height: 250px; object-fit:contain" class="card-img-top img-fluid" src="{{ asset('uploads/profile') }}/{{ $req->oneuser->image }}">
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title">Feedback from »» <p class="text-primary" style="display:inline"> {{ $req->oneuser->name }}</p></h5>
                    <p class="card-text">{{ $req->feedback }}</p>
                    <p class="card-text">
                        <small class="text-muted">{{ Carbon\Carbon::parse($req->created_at)->diffForHumans() }}</small>
                    </p>
                    <a href="{{ route('request.cancel', $req->id) }}" type="button" class="btn btn-outline-danger rounded-pill waves-effect waves-light">Cancel</a>
                    <a href="{{ route('request.accept', $req->id) }}" type="button" class="btn btn-outline-success rounded-pill waves-effect waves-light">Accept</a>
                </div>
            </div>
            <!-- end card-box-->
        </div>
    @empty
        <h1 class="text-danger text-center">No Request found!</h1>
    @endforelse
</div>

@endsection
