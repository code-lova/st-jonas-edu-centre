@extends('layouts.otherpage')
{{--
include setting for title
site description, site_keywords,
website name --}}


@section('content')
<div class="py-3 bg-green">
    <div class="container text-light">
        <div class="fs-4">{{ $title }}</div>
        <hr />
        <div class="fs-7">
            You can contact us regarding any inquiry or issue and our
            Support Team
            will get right on it
        </div>
    </div>
</div>

<main class="bg-light">
    <div class="container py-5 bg-white">
        <div class="row py-5">
            <div class="col-12 col-md-8">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Dolor non
                    a tempore laborum fuga odio hic mollitia quasi,
                    culpa, sequi
                    assumenda quae pariatur quos doloremque, quia
                    reprehenderit illum
                    error rem unde dolorem iusto veritatis distinctio
                    provident.
                    Dolores, consequatur autem tenetur in impedit
                    officia nemo
                    provident nisi sit deleniti, ab assumenda vitae,
                    iure aliquid
                    corporis ipsum. Dicta recusandae possimus autem non!
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Provident
                    rem fuga, expedita saepe, tempora inventore tenetur
                    doloribus
                    cupiditate itaque impedit alias obcaecati, veniam
                    mollitia minus
                    aspernatur architecto corporis assumenda ratione
                    sapiente libero
                    nulla ducimus reiciendis? Numquam accusantium
                    repellendus, itaque
                    fugit quod atque magni iusto nulla id ipsam tempora
                    error
                    consequuntur repellat ut, maiores animi, est enim
                    autem? Officia
                    rerum commodi, possimus exercitationem suscipit
                    ullam repellat
                    enim dolores accusantium similique consequuntur aut
                    reprehenderit
                    facere dicta molestiae quae? Numquam iusto adipisci
                    voluptatem.
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Hic
                    asperiores tenetur voluptas ad quos repudiandae, rem
                    modi vitae
                    error alias inventore suscipit veritatis natus.
                    Alias sed
                    accusamus illum totam molestiae, minima aliquid,
                    perspiciatis,
                    ipsa consectetur qui voluptates quis odio tempore.
                </p>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing
                    elit. Autem
                    corrupti libero qui consectetur quibusdam tenetur
                    blanditiis
                    maiores optio. Odit, ipsa. Molestiae distinctio
                    assumenda,
                    repellat quas impedit unde laborum magnam, sint
                    mollitia in labore
                    perferendis praesentium accusantium dolore aliquid
                    deserunt,
                    recusandae laboriosam libero consequatur maiores.
                    Necessitatibus
                    exercitationem qui ut possimus hic!
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Illo,
                    ullam qui totam nobis modi dolores ea praesentium
                    enim cumque
                    provident!
                </p>
            </div>
            <div class="col-4 d-none d-md-block">
                <div class="container-fluid">
                    <div class="row bg-green">
                        <div class="d-grid p-0">
                            <a class="link-underline small-menu p-2 text-light link-underline-opacity-0"
                                href="/history/">
                                <div class="d-flex gap-2 align-items-center"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="#004931" class="bi bi-arrow-right-circle-fill"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                    </svg>History</div>
                            </a>
                        </div>
                        <div class="d-grid p-0">
                            <a class="link-underline small-menu p-2 text-light link-underline-opacity-0"
                                href="/vision-mission/">

                                <div class="d-flex gap-2 align-items-center"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="#004931" class="bi bi-arrow-right-circle-fill"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                    </svg>Vision and
                                    Mission </div>
                            </a>
                        </div>
                        <div class="d-grid p-0">
                            <a class="link-underline small-menu p-2 text-light link-underline-opacity-0"
                                href="/Staff-Management/">
                                <div class="d-flex gap-2 align-items-center"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="#004931" class="bi bi-arrow-right-circle-fill"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                    </svg>Staff and Management
                                    </div>
                            </a>
                        </div>
                        <div class="d-grid p-0">
                            <a class="link-underline small-menu-active small-menu p-2 text-light link-underline-opacity-0"
                                href="/school-anthem/">
                                <div class="d-flex gap-2 align-items-center"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="#004931" class="bi bi-arrow-right-circle-fill"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                    </svg> School Anthem</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
