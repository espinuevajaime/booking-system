<div>
    <div id="mySidenavRight" class="sidenavRight shadow-lg">

        <div class="booking-left-center-container container-fluid" style="">
            <div class="booking-component-view  bg-white ">
                <div class="booking-component-head ">
        
        
                    <h1 class="text-center booking-component-head-title">View Bookings !</h1>
        
                    {{-- options for upcoming, past and cancelled --}}
                    <div class="bookings-list-filter">
                        <div wire:click="toggleBookingComponents('upcoming')" class="list-filter-item @if($bookingViewOptions['upcoming']) active-filter @endif cursor-pointer">Upcoming</div>
                        <div wire:click="toggleBookingComponents('past')" class="list-filter-item  @if($bookingViewOptions['past']) active-filter @endif  cursor-pointer">Past</div>
                        <div wire:click="toggleBookingComponents('cancelled')" class="list-filter-item  @if($bookingViewOptions['cancelled']) active-filter @endif  cursor-pointer">Cancelled</div>
                    </div>
        
                </div>
        
                <!-- ****************** booking component body starts ************************* -->
                @if($bookingViewOptions['upcoming'])
                    @if (count($upcomingBookings) > 0)
                        <div class="booking-component-body ">
                            <ul class="list-group list-group">
                                @foreach($upcomingBookings as $booking)
                                <li id="{{$loop->index}}"  class="list-group-item cursor-pointer booking-hover {{$booking->appointment_id == $confirmingID ? 'active-booking-item'  : ''}}" wire:click="showSelectedBooking({{$booking->appointment_id}})">
                                    <div class="pull-left">
                                        <span  class="badge" style="float:left;">Date: {{$booking->start_at}}</span>
                                        <span  class="badge" style="float:left;">Customer: {{$booking->getCustomer()->name}} ( {{ $booking->getService()->name }} )</span><br>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>                    
                    @else
                        <span  class="badge" style="float:center;">Nothing found</span>
                    @endif
                @endif

                @if($bookingViewOptions['past'])
                    @if (count($pastBookings) > 0)
                    <div class="booking-component-body ">
                        <ul class="list-group list-group">
                            @foreach($pastBookings as $booking)
                            <li id="{{$loop->index}}" class="list-group-item">
                                <div class="pull-left">
                                    <span  class="badge" style="float:left;">Date: {{$booking->start_at}}</span><br>
                                    <span  class="badge" style="float:left;">Customer: {{$booking->getCustomer()->name}} ( {{ $booking->getService()->name }} )</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>                        
                    @else
                        <span  class="badge" style="float:center;">Nothing found</span>
                    @endif
                @endif

                @if($bookingViewOptions['cancelled'])
                    @if (count($cancelledBookings) > 0)
                    <div class="booking-component-body ">
                        <ul class="list-group list-group">
                            @foreach($cancelledBookings as $booking)
                            <li id="{{$loop->index}}" href="#" class="list-group-item text-danger">Date: {{$booking->start_at}}
                                <div class="pull-right">
                                <span class="badge" style="float:left;">Customer: {{$booking->getCustomer()->name}} ( {{ $booking->getService()->name }} )</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>                        
                    @else
                        <span  class="badge" style="float:center;">Nothing found</span>
                    @endif


                @endif
                    
                    
            </div>
                <!-- ****************** booking component body starts ************************* -->
        
        <div class="booking-component-view-center">

            <h1 class="text-center">
                <div class="d-flex justify-content-center p-4">
                    <a href="{{route('addBooking')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        CREATE BOOKING</a>
                </div> 
            </h1>

            <div class="booking-center-head ">
                
                {{-- <div class="form-group">
                    <a wire:click="toggleComponent('showBookingDetails')" class="login-register-links-sm cursor-pointer @if($formComponents['showBookingDetails']) link-active @endif d-inline-block">Booking Details</a>
                    <a wire:click="toggleComponent('deleteBooking')" class="login-register-links-sm cursor-pointer @if($formComponents['deleteBooking']) link-active @endif  d-inline-block">Delete</a>
                </div> --}}
                {{-- <hr> --}}

                <div class="booking-component-body ">
                        <div class="form-container2">
                            <div id="login-register">
                                <div class="form-group row">
                                        @if($selectedBooking)
                                        <div class="col-10">
                                        <div class="list-group-item" style="font-size: large">
                                            <span class=""> <b>Date:</b> {{date('Y:m:d ',strtotime($selectedBooking->start_at))}} </span><br>
                                            <span class=""> <b>Time:</b> {{date('H:i ',strtotime($selectedBooking->start_at))}}-{{date('H:i ',strtotime($selectedBooking->end_at))}} </span><br>
                                            <span class=""> <b>Service:</b> {{$selectedBooking->getService()->name}}</span><br>
                                            <span class=""> <b>Staff:</b> {{$selectedBooking->getStaff()->name}}</span><br>
                                            <span class=""> <b>Total Price:</b> £{{$selectedBooking->getPrice()}} (£{{$selectedBooking->getServicePrice()}}/hr)</span><br>
                                        </div>
                                        </div>
                                        @endif
                                </div>

                                {{-- <div class="form-group">
                                    <div class="form-check" id="form-slider">
                                        <label class="form-check-label" for="addComment">
                                            Add Comments. 
                                        </label>
                                        <label class="switch">
                                            <input type="checkbox" name="addComment" wire:click="$toggle('showAddComment')">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div> --}}
                                    
                                    @if ($showAddComment)
                                        <div class="form-group row">
                                            <div class="col-10">
                                                <textarea class="form-control  @error('cancellationMessage') is-invalid @enderror" name="cancellationMessage" rows="5" wire:model.lazy="cancellationMessage" placeholder="Add a mesage here "  value="{{ $cancellationMessage ? $cancellationMessage : old('cancellationMessage') }}" id="bookingComment"></textarea>
                                                @error('cancellationMessage')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row d-flex justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                @if($selectedBooking)<button wire:click="$toggle('showAddComment')" class="btn btn-dark rounded-pill btn-block btn-lg">{{__('toggle') }}</button>@endif
                                                @if($showAddComment)<button type="submit" wire:click.prevent="requestCancellation" class="btn btn-danger rounded-pill btn-block btn-lg">{{__('Request Cancellation') }}</button>@endif
                                            </div>
                                        </div>
                                    </div>

                            </div>
                        </div>
                </div>
                
                
            </div>

        </div>
        </div>

    </div>
</div>
