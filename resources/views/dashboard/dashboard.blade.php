@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Welcome {{ auth()->user()->name }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('dashboard.home') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row starter-main">
            <div class="row">
                <div class="col-xl-3 col-hr-6 col-sm-6">
                    <div class="card widget-11 widget-hover">
                        <div class="card-body">
                            <div class="common-align justify-content-start">
                                <div class="analytics-tread bg-light-primary"><svg class="fill-primary">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-client') }}"></use>
                                    </svg>
                                </div>
                                <div>
                                    <span class="c-o-light">Clients</span>
                                    <h4 class="counter">{{ $clientCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@section('scripts')

@endsection
