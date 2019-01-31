@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if (array_get($_GET, 'p') == 'course')
                    @include('dashboard.course')
                @elseif (array_get($_GET, 'p') == 'payment')
                    @include('dashboard.payment')
                @elseif (array_get($_GET, 'p') == 'applicant')
                    @include('dashboard.applicant')
                @else
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!

                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
