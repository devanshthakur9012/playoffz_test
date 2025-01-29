@extends('frontend.master', ['activePage' => null])

@section('title', __('My Social Play'))

@section('content')
<style>
    .btn-delete{
        background: #ff0000;
        border: 1px solid #ff0000;
        color: #fff;
    }
</style>
<section class="active-tickets mt-5">
    <div class="container">
        <h2 class="text-center mb-4">My Social Play</h2>
        <div class="row">
            @isset($mySocialPlay)
                <table class="table bg-white rounded-sm p-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Play Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Timing</th>
                            <th scope="col">Venue</th>
                            <th scope="col">Slots</th>
                            <th scope="col">Price</th>
                            <th scope="col">Type</th>
                            <th scope="col">Status</th>
                            <th scope="col">Pay Join</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mySocialPlay as $index => $item)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ $item['catgeory'] }}</td>
                                <td>{{ $item['timing'] }}</td>
                                <td>{{ $item['venue'] }}</td>
                                <td>{{ $item['slots'] }}</td>
                                <td>{{ $item['price'] }}</td>
                                <td>{{ $item['type'] }}</td>
                                <td>{{ $item['status'] }}</td>
                                <td>{{ $item['payjoin'] }}</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm"><i class="fas fa-users fa-sm"></i></button>
                                    <button class="btn btn-primary btn-sm"><i class="fas fa-pen fa-sm"></i></button>
                                    <button class="btn btn-delete btn-sm"><i class="fas fa-trash fa-sm"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">No Social Play events available.</p>
            @endisset
        </div>
    </div>
</section>
@endsection