@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Dashboard</h1>
                <div class="separator mb-5"></div>
            </div>
            <div class="col-lg-12 col-xl-12">
                <div class="icon-cards-row">
                    <div class="glide dashboard-numbers">
                        <div class="glide__track" data-glide-el="track">
                            <ul class="glide__slides row">
                                <li class="glide__slide col-3">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <i class="iconsminds-clock"></i>
                                            <p class="card-text mb-0">Pending Orders</p>
                                            <p class="lead text-center">16</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="glide__slide col-3">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <i class="iconsminds-basket-coins"></i>
                                            <p class="card-text mb-0">Completed Orders</p>
                                            <p class="lead text-center">32</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="glide__slide col-3">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <i class="iconsminds-arrow-refresh"></i>
                                            <p class="card-text mb-0">Refund Requests</p>
                                            <p class="lead text-center">2</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="glide__slide col-3">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <i class="iconsminds-mail-read"></i>
                                            <p class="card-text mb-0">New Comments</p>
                                            <p class="lead text-center">25</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
