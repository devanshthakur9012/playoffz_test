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
@push('scripts')
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [{
        "@type": "Question",
        "name": "What is Playoffz?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Playoffz is a premier platform where users can discover and book tickets for live sports tournaments such as badminton, cricket, football, and more happening across cities like Delhi, Bengaluru, Mumbai, Hyderabad, and Chennai."
        }
      },{
        "@type": "Question",
        "name": "Which cities host tournaments listed on Playoffz?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Playoffz covers a wide range of tournaments in cities like Delhi, Bengaluru, Mumbai, Chennai, Hyderabad, Kochi, and Pune, along with many other locations across India."
        }
      },{
        "@type": "Question",
        "name": "How do I find badminton tournaments on Playoffz?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Go to the Badminton Tournament category page on Playoffz.in to explore upcoming badminton tournaments in cities like Chennai, Kochi, Bengaluru, and Hyderabad."
        }
      },{
        "@type": "Question",
        "name": "Can I book tickets for football tournaments on Playoffz?",
        "acceptedAnswer": {	
          "@type": "Answer",
          "text": "Absolutely! Visit the Football Tournament page on Playoffz.in to view and book tickets for football matches in Kolkata, Mumbai, Goa, Bengaluru, and more."
        }
      },{
        "@type": "Question",
        "name": "What types of tournaments are listed on Playoffz?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Playoffz lists a variety of sports tournaments, including badminton, cricket, skating, chess, swimming, tennis, volleyball, running, and pickleball, in multiple cities across India."
        }
      },{
        "@type": "Question",
        "name": "Does Playoffz cover international sports tournaments?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Currently, Playoffz focuses on sports tournaments organized across major cities in India, such as Delhi, Bengaluru, Chennai, and Mumbai, but it may expand to international events in the future."
        }
      },{
        "@type": "Question",
        "name": "Can I find local sports tournaments in small cities on Playoffz?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Yes, in addition to major cities like Hyderabad and Chennai, Playoffz features tournaments held in smaller cities like Coimbatore, Thanjavur, and Pondicherry."
        }
      },{
        "@type": "Question",
        "name": "Is it safe to book tickets on Playoffz?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Yes, Playoffz ensures a secure and seamless booking process, allowing users to book tickets confidently for their favorite live tournaments."
        }
      },{
        "@type": "Question",
        "name": "Can I filter tournaments by sport or location on Playoffz?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Absolutely! Use the filtering options on Playoffz.in to find tournaments by specific sports, such as skating or tennis, or locations like Hyderabad and Mumbai."
        }
      },{
        "@type": "Question",
        "name": "What should I do if a tournament is canceled?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "If a tournament is canceled, Playoffz will notify ticket holders promptly, and refunds will be processed based on the event\u2019s cancellation policy."
        }
      },{
        "@type": "Question",
        "name": "Does Playoffz offer discounts on ticket bookings?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Playoffz occasionally provides discounts and promotional offers. Keep an eye on the website for special deals on live sports tournament tickets."
        }
      },{
        "@type": "Question",
        "name": "How can I stay updated about upcoming tournaments on Playoffz?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Subscribe to the Playoffz newsletter to get notified about new tournaments, events, and exclusive offers across cities like Mumbai, Delhi, and Chennai."
        }
      },{
        "@type": "Question",
        "name": "Can I suggest a sports tournament to be listed on Playoffz?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Yes, Playoffz welcomes suggestions! Contact the support team to share information about sports tournaments you would like to see listed on the platform."
        }
      }]
    }
    </script>    
@endpush