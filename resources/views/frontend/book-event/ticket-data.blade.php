@extends('frontend.master', ['activePage' => 'ticket'])
@section('title', __('Ticket Details'))
@section('content')

<section class="ticket-area section-area">
    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h2 class="text-default">{{ $ticketData['ticket_title'] }}</h2>
                    <p class="text-muted"><strong>Event Time:</strong> {{ $ticketData['start_time'] }}</p>
                </div>
                <div class="row">
                    <!-- Event Details -->
                    <div class="col-md-6">
                        <h4>Event Details</h4>
                        <p><strong>Location:</strong> {{ $ticketData['event_address_title'] }}</p>
                        <p><strong>Address:</strong> {{ $ticketData['event_address'] }}</p>
                        <p><strong>Latitude:</strong> {{ $ticketData['event_latitude'] }}</p>
                        <p><strong>Longitude:</strong> {{ $ticketData['event_longtitude'] }}</p>
                        <p><strong>Sponsor:</strong> {{ $ticketData['sponsore_title'] }}</p>
                        <img src="https://app.playoffz.in/{{$ticketData['sponsore_img']}}" alt="Sponsor Logo" class="img-fluid mb-3" style="max-width: 150px;">
                    </div>

                    <!-- Ticket and QR Details -->
                    <div class="col-md-6 text-center">
                        <h4>Your Ticket</h4>
                        <img src="{{ $ticketData['qrcode'] }}" alt="QR Code" class="img-fluid mb-3" style="max-width: 200px; border: 1px solid #ddd; padding: 10px;">
                        <p><strong>Unique Code:</strong> {{ $ticketData['unique_code'] }}</p>
                        <p><strong>Ticket Type:</strong> {{ $ticketData['ticket_type'] }}</p>
                        <p>
                            <strong>Status:</strong> 
                            <span class="badge {{ $ticketData['ticket_status'] === 'Paid' ? 'badge-success' : 'badge-danger' }}">
                                {{ ucfirst($ticketData['ticket_status']) }}
                            </span>
                        </p>
                    </div>
                </div>

                <hr>

                <!-- User Details -->
                <div class="row">
                    <div class="col-md-6">
                        <h4>User Details</h4>
                        <p><strong>Name:</strong> {{ $ticketData['ticket_username'] }}</p>
                        <p><strong>Mobile:</strong> {{ $ticketData['ticket_mobile'] }}</p>
                        <p><strong>Email:</strong> {{ $ticketData['ticket_email'] }}</p>
                    </div>

                    <!-- Payment Details -->
                    <div class="col-md-6">
                        <h4>Payment Details</h4>
                        <p><strong>Transaction ID:</strong> {{ $ticketData['ticket_transaction_id'] }}</p>
                        <p><strong>Payment Method:</strong> {{ $ticketData['ticket_p_method'] }}</p>
                        <p><strong>Subtotal:</strong> ₹{{ $ticketData['ticket_subtotal'] }}</p>
                        <p><strong>Tax:</strong> ₹{{ $ticketData['ticket_tax'] }}</p>
                        <p><strong>Total Paid:</strong> ₹{{ $ticketData['ticket_total_amt'] }}</p>
                    </div>
                </div>

                <hr>

                <div class="text-center mt-3">
                    <button id="print_ticket" class="btn btn-primary">
                        <i class="fas fa-print"></i> Print Ticket
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Print functionality for ticket
    $("#print_ticket").click(function () {
        window.print();
    });
</script>
@endpush
