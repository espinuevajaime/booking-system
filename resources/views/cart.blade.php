@extends('layouts.home')
@section('content')
<div class="container">
    <!--Section: Block Content-->
<section>

    
        @if(session()->has('success-message'))
            <div class="text-center">
            <p class="text-center alert alert-success ">{{ session()->get('success-message') }}</p>
            </div>
        @endif

        @if(session()->has('danger-message'))
            <div class="text-center">
            <p class="text-center alert alert-danger ">{{ session()->get('danger-message') }}</p>
            </div>
        @endif
    <!--Grid row-->
    <div class="row">
    
        <!--Grid column-->
        <div class="col-lg-8 shadow-lg">
    
            <!-- Card -->
            <div class="card wish-list mb-3">
            <div class="card-body">
    
                <h5 class="mb-4">Cart (<span>{{count($items)}}</span> items)</h5>
                {{-- @dd($items) --}}
    
                @foreach ($items as $product)
                    <div class="row mb-4">
                        <div class="col-md-5 col-lg-3 col-xl-3">
                            <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                            <img class="img-fluid w-100"
                                src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12a.jpg" alt="Sample">
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-9 col-xl-9">
                            <div>
                            <div class="d-flex justify-content-between">
                                <div>
                                <h5>{{ $product->name }}</h5>
                                <p class="mb-3 text-muted text-uppercase small">{{  $product->attributes ? $product->attributes->category : '' }}</p>
                                <p class="mb-2 text-muted text-uppercase small">{{ $product->attributes ? $product->attributes->material : ''}}</p>
                                <p class="mb-3 text-muted text-uppercase small">{{ $product->attributes ? $product->attributes->size : '' }}</p>
                                </div>

                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                <a href="{{ route('remove', ['id' => $product->id]) }}"  class="card-link-secondary small product-link-danger  text-uppercase mr-3"><i
                                    class="text-danger fas fa-trash-alt mr-1"></i> Remove item </a>
                                </div>
                                <p class="mb-0"><span><strong>£{{$product->price}}</strong></span></p>
                            </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">      
                @endforeach

            </div>
            </div>
            <!-- Card -->
    
            <!-- Card -->
            <div class="card shadow-lg mb-3">
            <div class="card-body">
    
                <h5 class="mb-4">Expected shipping delivery</h5>
    
                <p class="mb-0"> Thu., 12.03. - Mon., 16.03.</p>
            </div>
            </div>
            <!-- Card -->
    
    
        </div>
        <!--Grid column-->
    
        <!--Grid column-->
        <div class="col-lg-4 shadow-lg">
    
                <!-- Card -->
                <div class="card mb-3">
                    <div class="card-body">
            
                        <h5 class="mb-3">The total amount of</h5>
            
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                            Products Price
                            <span>£{{ $total ? $total : '' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Shipping
                            <span>£{{ $shippingCost ? $shippingCost : '' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                            <div>
                            <strong>The total amount of</strong>
                            <strong>
                                <p class="mb-0">(including VAT)</p>
                            </strong>
                            </div>
                            <span><strong>£{{ $total ? ($total + $shippingCost) : '' }}</strong></span>
                        </li>
                        </ul>
            
                        <button type="button" class="btn btn-dark btn-block waves-effect waves-light">Checkout</button>
            
                    </div>
                </div>
                <!-- Card -->
    
        </div>
        <!--Grid column-->
    
    </div>
    <!--Grid row-->

    </section>
    <!--Section: Block Content-->
</div>
@endsection