@extends('layouts.app')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')

<div>
    <section id="hero">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel"
            data-bs-pause="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class=" d-flex justify-items-center vh-100 align-items-center">
                        <div src="/assets/carousel/1.JPG" alt="" class="position-absolute img-carousel-1 fluid-img"
                            srcset=""></div>
                        <div class="container ">
                            <div class="row">
                                <div
                                    class="col-12 col-md-6 bg-green-25 fixed text-light rounded-2 blur-10 vh-100 bg-opacity-25 d-flex align-items-center">
                                    <div class="fw-bold p-5 fs-1">
                                        <div class="text-end">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Corrupti ullam perspiciatis hic nesciunt neque!
                                        </div>
                                        <div class="py-5 d-flex gap-2 justify-content-center">
                                            <a href="" class="btn btn-primary btn-lg">lorem</a>
                                            <a href="" class="btn btn-warning btn-lg">lorem</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class=" d-flex justify-items-center vh-100 align-items-center">
                        <div alt="" class="position-absolute img-carousel-2 fluid-img" srcset=""></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 index-2 text-center">
                                    <div class="text-light pb-4 fw-bold fs-1">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                        elit. Neque, dolores?
                                    </div>
                                    <a href="" class="btn btn-primary btn-lg">Learn more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class=" d-flex justify-items-center vh-100 align-items-center">
                        <div alt="" class="position-absolute img-carousel-3 fluid-img" srcset=""></div>
                        <div class="container ">
                            <div class="row">
                                <div
                                    class="col-12 bg-dark fixed text-light rounded-2 blur-10 vh-50 bg-opacity-25 d-flex align-items-center">
                                    <div class="fw-bold p-5 fs-4">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Corrupti ullam perspiciatis hic nesciunt  eque!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev justify-content-start" type="button"
                data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next justify-content-end" type="button"
                data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section id="cta" class="py-5">
        <div class="container">
            <div class="row bg-green border-2 border rounded-2 text-light">
                <div class="col-12 d-none d-md-block p-0 col-md-4">
                    <img src="/assets/images/apply-for-admission2.jpg" alt="Apply for admission"
                        class="rounded-2 img-fluid" srcset="" />
                </div>
                <div class="col-12 col-md-8 align-items-center py-4 d-flex">
                    <div>
                        <div class="py-2 text-uppercase fs-7">
                            Lorem, ipsum.
                        </div>
                        <h3 class="fs-4 fw-semibold">Apply for Admission</h3>
                        <div class="fs-6">
                            Admission into St. Jonas Educational Center for 2024/2025 Academic Session
                            is in progress.
                        </div>
                        <div class="d-flex gap-2 pt-3">
                            <a href="/apply/" class="btn btn-sm fs-7 btn-outline-light">Application Form</a>
                            <a href="/Online-learning/" class="btn btn-sm fs-7 btn-outline-light">Online Learning
                                </a>
                            <a href="/contact/" class="btn btn-sm fs-7 btn-outline-light">Book a visit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="intro" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="fs-4 text-center fw-bold">Welcome Address</div>
                    <hr />
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <img src="/assets/icons/Logo.png" alt="Principals Photo" srcset=""
                                class="img-fluid " />
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="fs-7 text-justify py-3">
                                <p>
                                    ST JONAS EDUCATIONAL CENTER was established in ____
                                    starting with Nursery and Primary
                                    School, Benin , Nigeria.
                                </p>
                                <p>
                                    Our Aim at St. Jonas Educational Center is to be widely
                                    acclaimed locally and internationally as a school that trains
                                    and turns out students who have been adequately prepared for
                                    tertiary education and life.
                                </p>
                                <p>
                                    Our Mission Statement is “To produce the total child through a
                                    holistic education programme that benchmarks best practices
                                    while being socially responsible.”
                                </p>
                            </div>
                            <a href="/why-St-Jonas/"
                                class="fs-7 text-green link-underline link-underline-opacity-0 fw-semibold ">Read
                                more</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5 text-justify">
                    <div><img src="/assets/images/apply-for-admission2.jpg" alt="Image suppose to be here" srcset="" /></div>
                    <div class="fs-7">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas ut
                        sequi veniam, voluptas et accusantium dolorum explicabo fugit,
                        aliquid alias possimus repellat. Ipsam amet labore tempora,
                        quibusdam necessitatibus earum eum asperiores consectetur
                        nostrum. Cupiditate non id maiores vero natus consequatur!
                    </div>
                    <div class="d-grid">
                        <a href="/gallery/"
                            class="btn btn-primary d-flex align-items-center justify-content-center gap-2">Visit Our
                            School
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-forward-fill" viewBox="0 0 16 16">
                                <path
                                    d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557" />
                            </svg></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="statistics" class="bg-green text-light py-5">
        <div class="container-fluid">
            <div class="text-center fw-bold h2">Our School</div>
            <hr>
            <div class="text-center  fs-6 fw-semibold">Here are some statistics about our school</div>
            <div class="d-flex py-5 row">
                <div
                    class="d-flex py-4 gap-2 col-12 col-md-6 col-lg-3 align-items-center justify-content-start justify-content-md-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                        class="bi bi-award" viewBox="0 0 16 16">
                        <path
                            d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702z" />
                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z" />
                    </svg>
                    <div>
                        <div class="display-5 fw-semibold">100</div>
                        <div class="fs-5">Certified Teachers</div>
                    </div>
                </div>
                <div
                    class="d-flex py-4 gap-2  col-12 col-md-6 col-lg-3 align-items-center justify-content-start justify-content-md-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                        class="bi bi-building-check" viewBox="0 0 16 16">
                        <path
                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514" />
                        <path
                            d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6.5a.5.5 0 0 1-1 0V1H3v14h3v-2.5a.5.5 0 0 1 .5-.5H8v4H3a1 1 0 0 1-1-1z" />
                        <path
                            d="M4.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                    </svg>
                    <div>
                        <div class="display-5 fw-semibold">6</div>
                        <div class="fs-5">Schools</div>
                    </div>
                </div>
                <div
                    class="d-flex py-4 gap-2  col-12 col-md-6 col-lg-3 align-items-center justify-content-start justify-content-md-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                        class="bi bi-mortarboard" viewBox="0 0 16 16">
                        <path
                            d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z" />
                        <path
                            d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46z" />
                    </svg>
                    <div>
                        <div class="display-5 fw-semibold">100%</div>
                        <div class="fs-5">Passing to Universities</div>
                    </div>
                </div>
                <div
                    class="d-flex py-4 gap-2  col-12 col-md-6 col-lg-3 align-items-center justify-content-start justify-content-md-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                        class="bi bi-clock-history" viewBox="0 0 16 16">
                        <path
                            d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z" />
                        <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z" />
                        <path
                            d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5" />
                    </svg>
                    <div>
                        <div class="display-5 fw-semibold">26</div>
                        <div class="fs-5">Years Old</div>
                    </div>
                </div>

            </div>
        </div>

    </section>
</div>







@endsection
