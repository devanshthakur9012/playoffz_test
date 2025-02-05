@extends('frontend.master', ['activePage' => 'home'])
@php $catName = ucwords(str_replace('-', ' ', $category)); @endphp
@if (isset($meta_data['meta_title']))
    @php $catName = $meta_data['meta_title']; @endphp
@endif
@section('title', __($catName))
@section('og_data')
    <meta name="description" content="@isset($meta_data['meta_description']){{$meta_data['meta_description']}}@endisset" />
@endsection
@section('content')
<style>
    .btn-white{
        background-color: #fff;
        border-radius: 4px;
        color: #000;
    }
    .type_cat{
        padding: 4px 10px !important;
        background: #ffd700;
        color: #000;
        font-size: 14px !important;
        font-weight: 500;
    }
    .location{
        background: #004aad;
        color: #fff;
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11px !important;
        position: absolute;
        top: -12px;
        right: 10px;
    }
    .category{
        background: #ffd700;
        color: #000000;
        border-radius: 20px;
        padding: 4px 10px !important;
        font-size: 14px !important;
        position: absolute;
        top: 10px;
        left: 7px;
    }
    .default2-btn{
        background-color: #ff2f31 !important;
        border-color: #ff2f31 !important;
        padding: 7px 10px;
        color:#fff !important;
    }
</style>
<div class="container my-5">
    <div class="hawan_section">
        <div class="mt-5 mb-3">
            <h1 class="h4 mb-2">{{$catName}} Tournament</h1>
        </div>
        <div class="row list-bp">
            @foreach ($category_tournament as $tour)
                <div class="col-xl-4 col-md-4 col-sm-6 mb-3">
                    <div class="card m-card shadow-sm border-0 listcard">
                        <div>
                            <div class="m-card-cover  position-relative">
                                <img src="{{env('BACKEND_BASE_URL')}}/{{$tour['event_img']}}" class="card-img-top" alt="{{$tour['event_title']}}">
                                @isset($tour['cid'])
                                    <a href="{{route('tournament',['category'=>Str::slug($tour['category'])])}}" class="my-2"><small class="category">{{$tour['category']}}</small></a>
                                @endisset
                            </div>
                            <div class="card-body position-relative">
                                <h5 class="card-title mb-2"><u>{{$tour['event_title']}}</u></h5>
                                <small>{{$tour['event_sdate']}}</small>
                                <p class="my-2"><small class="location"><i class="fas fa-map-marker-alt pr-1"></i>{{$tour['event_place_name']}}</small></p>
                                <p class="card-text mb-0">
                                    <small class="text-dark" title="{{$tour['event_place_address']}}"><i class="fas fa-map pr-2"></i>
                                    {{ strlen($tour['event_place_address']) > 50 ? substr($tour['event_place_address'], 0, 50) . '...' : $tour['event_place_address'] }}
                                    </small>
                                </p>
                                @php
                                    // Ensure ticket_types exists and is an array
                                    if (isset($tour['ticket_types']) && is_array($tour['ticket_types'])) {
                                        // Sort the array by extracting numeric and alphabetic parts
                                        uksort($tour['ticket_types'], function ($a, $b) {
                                            // Extract the numeric part of the keys
                                            $numA = (int) preg_replace('/\D/', '', $a); // Get numbers only
                                            $numB = (int) preg_replace('/\D/', '', $b); // Get numbers only
                                
                                            // Compare numeric parts first
                                            if ($numA !== $numB) {
                                                return $numA <=> $numB;
                                            }
                                
                                            // If numeric parts are the same, compare alphabetically (B vs G)
                                            return strcmp($a, $b);
                                        });
                                    }
                                @endphp
                                @isset($tour['ticket_types'])
                                    @foreach ($tour['ticket_types'] as $key => $item)
                                        <span class="badge badge-primary m-1 type_cat" data-toggle="tooltip" data-placement="top" title="{{ $key }}">{{ $item }}</span>
                                    @endforeach
                                @endisset
                                {{-- <div class="mt-2 d-flex justify-content-between align-items-center">
                                    <a href="{{route('tournament-detail', [$tour['event_id'], Str::slug($tour['event_title'])])}}" class="mt-1 btn btn-success btn-sm mb-1">Book Now</a>
                                    
                                    <button class="mt-1 btn btn-white btn-sm mb-1">{{$tour['event_ticket_price']}}</button>
                                </div> --}}
                                <div class="mt-2">
                                    <button class="mt-1 btn btn-outline-white btn-sm mb-1">Ticket Price : {{$tour['event_ticket_price']}}</button>
                                    @if(strtotime($tour['event_sdate']) < strtotime(date('Y-m-d')))
                                        <a href="javascript:void(0);" class="mt-1 btn default2-btn btn-sm mb-1 w-100">Completed</a>
                                    @else
                                        <a href="{{route('tournament-detail', [Str::slug($tour['event_title']),$tour['event_id']])}}" class="mt-1 btn btn-success btn-sm mb-1 w-100">Book Ticket</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @isset($category_desciption)
            <p>{{$category_desciption}}</p>
        @endisset
    </div>
</div>
@push('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endpush
@endsection
