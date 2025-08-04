@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                            <button class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Ir al Dashboard</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
