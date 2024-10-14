@extends('partials.client.header')
@section('content')
    <section id="team" class="team section">

        <!-- Section Title -->
        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <h2>Team</h2>
            <p>Our hard working team</p>
        </div><!-- End Section Title -->
        <div class="container mt-5">
            <div class="row gy-4">
                @foreach ($instructors as $item)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="card fixed-size-card">
                            <div class="card-body">
                                <div class="members-img">
                                    <img src="{{ asset('storage/instructor/' . $item->image) }}" alt="Instructor Image">
                                </div>
                                <p class="card-text">
                                    <h4 class="card-title">{{ $item->name }}</h4>

                                    <h6>Mata Pelajaran</h6>
                                    @foreach ($item->courses as $course)
                                        - {{ $course->name }} <br>
                                    @endforeach
                                    <h6>Pendidikan</h6>
                                    @foreach ($item->educationDetails as $univ)
                                        - {{ $univ->level }} {{ $univ->degree }}<br>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
@endsection
