@extends('frontend.master', ['activePage' => null])
@section('title', __('Frequently Asked Questions'))
@section('content')
    <section class="FAQ mt-5">
        <div class="container">
            <h2 class="text-center">Playoffz FAQ: Discover, Book, Enjoy Tournaments</h2>
            <div class="row mt-3">
                <div class="col-sm-12">
                    @foreach ($faq as $item)
                        <div class="card shadow-none">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <h5 class="mb-0"> Q{{$loop->index+1}}.  {{ $item['question'] }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row card-body">
                                <div class="col-md-12 ">
                                    <p class="mb-0">{{ $item['answer'] }}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
