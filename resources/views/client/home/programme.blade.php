@extends('partials.client.header')
@section('content')
<section id="services" class="services section">

    <!-- Section Title -->
    <div class="container section-title aos-init aos-animate" data-aos="fade-up">
        <h2>Programme</h2>
        <p>Check Our Services<br></p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="row gy-4">
            @foreach ($courses as $course)
                <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item item-cyan position-relative">
                        <div class="text-end" style="margin-top: -1cm">
                            <span class="badge bg-primary">@currency($course->price)/Anak</span>
                        </div>
                        <i class="bi bi-activity icon"></i>
                        <h3>{{ $course->name }}</h3>
                        <p>{{ $course->description }}.</p>
                        {{-- <a href="#" class="read-more stretched-link"><span>Read More</span> <i class="bi bi-arrow-right"></i></a> --}}
                    </div>
                </div>
            @endforeach
        </div>

    </div>

</section>
@endsection