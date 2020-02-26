@extends('admin.layouts.master')
@section('title', 'User Profile')

@section('content')
    <div class="section-wrapper">
        <div class="row row-sm">
            <div class="col-lg-8">
                <div class="card card-profile">
                    <div class="card-body">
                        <div class="media">
                            @if(\Illuminate\Support\Facades\Auth::user()->avatar)
                                <img
                                    src="{{ asset('storage/app/avatars/' .\Illuminate\Support\Facades\Auth::user()->avatar) }}"
                                    alt="">
                            @else
                                <img src="{{ asset('images/avatars/admins/admins.png') }}"
                                     alt="">
                            @endif

                            <div class="media-body">
                                <h3 class="card-profile-name">{{$user->name}}</h3>
                                <!-- <p class="card-profile-position">Executive Director at <a href="">ThemePixels, Inc.</a></p>
                                <p>San Francisco, California</p>

                                <p class="mg-b-0">A consummate human capital management professional with international training and talent management implementations experience across the entire universe...<a href="">Read more</a></p> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="" class="card-profile-direct"><!-- http://thmpxls.me/profile?id=katherine --></a>
                        <div>
                            <a href="{{ url('/administrator/users/edit-profile') }}">Edit Profile</a>
                            <a href="{{ url('/administrator/users/change-password') }}">Change Password</a>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-activity-profile mg-t-20">
                    <!-- <li class="nav-item"><a href="" class="nav-link"><i class="icon ion-ios-redo tx-purple"></i> Share an update</a></li>
                    <li class="nav-item"><a href="" class="nav-link"><i class="icon ion-image tx-primary"></i> Publish photo</a></li> -->
                    <li class="nav-item"><a href="" class="nav-link"><i class="icon ion-document-text tx-success"></i>
                            Add an article</a></li>
                </ul>

                <div class="card card-latest-activity mg-t-20">
                    <!-- <div class="card-body">
                        <div class="slim-card-title">Latest Activity</div>
                        <div class="media media-author">
                        <img src="../img/img1.jpg" alt="">
                        <div class="media-body">
                            <h6><a href="">Katherine</a></h6>
                            <p>Executive Director</p>
                        </div>
                        <span>2 hours ago</span>
                        </div>

                        <p class="activity-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>

                        <div class="row no-gutters">
                        <div class="col-md-4">
                            <a href=""><img src="../img/img16.jpg" class="img-fit-cover" alt=""></a>
                        </div>
                        <div class="col-md-8">
                            <div class="post-wrapper">
                            <a href="" class="activity-title">Sailing Basics: 10 Nautical &amp; Sailing Terms To Know</a>
                            <p>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>
                            <p class="mg-b-0">
                                <a href="" class="d-block">Charmaine Montuya</a>
                                <span>Writer &amp; Entrepreneur</span>
                            </p>
                            </div>
                        </div>
                        </div>

                    </div> -->
                    <!--  <div class="card-footer">
                         <a href="">Comment</a>
                         <a href="">Likes</a>
                         <a href="">Share</a>
                     </div> -->
                </div>

                <!-- <div class="card card-experience mg-t-20">
                <div class="card-body">
                    <div class="slim-card-title">Work Experience</div>
                    <div class="media">
                    <div class="experience-logo">
                        <i class="icon ion-briefcase"></i>
                    </div>
                    <div class="media-body">
                        <h6 class="position-name">Front-End Engineer / Web Developer</h6>
                        <p class="position-company">Cebu Machine Intelligence, Inc.</p>
                        <p class="position-year">Nov 2012 - Present (5 years +) &nbsp;-&nbsp; <a href="">Edit</a></p>
                    </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="">Show more<span class="d-none d-sm-inline"> experiences (4)</span> <i class="fa fa-angle-down"></i></a>
                    <a href="">Add new</a>
                </div>
                </div>

                <div class="card card-recommendation mg-t-20">
                <div class="card-body pd-25">
                    <div class="slim-card-title">Recommendations</div>
                    <div class="media align-items-center mg-y-25">
                    <img src="../img/img3.jpg" class="wd-40 rounded-circle" alt="">
                    <div class="media-body mg-l-15">
                        <h6 class="tx-14 mg-b-2"><a href="">Rolando Paloso</a></h6>
                        <p class="mg-b-0">Head Architect</p>
                    </div>
                    <span class="tx-12">Nov 20, 2017</span>
                    </div>

                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                    <p class="mg-b-0">Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
                </div>

                <div class="card-footer pd-y-12 pd-x-25 bd-t bd-gray-300">
                    <a href="">More recommendations (2) <i class="fa fa-angle-down"></i></a>
                </div>
                </div> -->
            </div>

            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                <!-- <div class="card card-connection">
                <div class="row row-xs">
                    <div class="col-4 tx-primary">129</div>
                    <div class="col-8">people viewed your profile in the past 90 days</div>
                </div>
                <hr>
                <div class="row row-xs">
                    <div class="col-4 tx-purple">845</div>
                    <div class="col-8">
                    connections <br>
                    <a href="">Grow your network</a>
                    </div>
                </div>
                </div> -->

                <!-- <div class="card card-people-list mg-t-20">
                <div class="slim-card-title">People also viewed</div>
                <div class="media-list">
                    <div class="media">
                    <img src="../img/img2.jpg" alt="">
                    <div class="media-body">
                        <a href="">Adrian Monino</a>
                        <p>Software Engineer</p>
                    </div>
                    </div>
                    <div class="media">
                    <img src="../img/img3.jpg" alt="">
                    <div class="media-body">
                        <a href="">Rolando Paloso</a>
                        <p>Architect</p>
                    </div>
                    </div>
                    <div class="media">
                    <img src="../img/img4.jpg" alt="">
                    <div class="media-body">
                        <a href="">Joyce Chua</a>
                        <p>Sales Representative</p>
                    </div>
                    </div>
                    <div class="media">
                    <img src="../img/img15.jpg" alt="">
                    <div class="media-body">
                        <a href="">Annalyn Mercado</a>
                        <p>Sales Representative</p>
                    </div>
                    </div>
                    <div class="media">
                    <img src="../img/img14.jpg" alt="">
                    <div class="media-body">
                        <a href="">Maricel Pasilbas</a>
                        <p>Sales Representative</p>
                    </div>
                    </div>
                </div>
                </div>

                <div class="card card-people-list mg-t-20">
                <div class="slim-card-title">People you may know</div>
                <div class="media-list">
                    <div class="media">
                    <img src="../img/img5.jpg" alt="">
                    <div class="media-body">
                        <a href="">Amber Heard</a>
                        <p>Software Engineer</p>
                    </div>
                    <a href=""><i class="icon ion-person-add tx-20"></i></a>
                    </div>
                    <div class="media">
                    <img src="../img/img6.jpg" alt="">
                    <div class="media-body">
                        <a href="">Richard Salomon</a>
                        <p>Architect</p>
                    </div>
                    <a href=""><i class="icon ion-person-add tx-20"></i></a>
                    </div>
                    <div class="media">
                    <img src="../img/img13.jpg" alt="">
                    <div class="media-body">
                        <a href="">Warren Vito</a>
                        <p>Sales Representative</p>
                    </div>
                    <a href=""><i class="icon ion-person-add tx-20"></i></a>
                    </div>
                    <div class="media">
                    <img src="../img/img12.jpg" alt="">
                    <div class="media-body">
                        <a href="">Charlene Plateros</a>
                        <p>Sales Representative</p>
                    </div>
                    <a href=""><i class="icon ion-person-add tx-20"></i></a>
                    </div>
                    <div class="media">
                    <img src="../img/img11.jpg" alt="">
                    <div class="media-body">
                        <a href="">Allan Palban</a>
                        <p>Sales Representative</p>
                    </div>
                    <a href=""><i class="icon ion-person-add tx-20"></i></a>
                    </div>
                </div>
                </div> -->

                <div class="card pd-25 mg-t-0">
                    <div class="slim-card-title mg-t-20">Contact &amp; Personal Info</div>

                    <div class="media-list mg-t-25">
                        <!-- <div class="media">
                        <div><i class="icon ion-link tx-24 lh-0"></i></div>
                        <div class="media-body mg-l-15 mg-t-4">
                            <h6 class="tx-14 tx-gray-700">Websites</h6>
                            <a href="" class="d-block">http://themepixels.me</a>
                            <a href="" class="d-block">http://themeforest.net</a>
                        </div>
                        </div> -->
                        <div class="media mg-t-25">

                            <!--<div><i class="icon ion-ios-telephone-outline tx-24 lh-0"></i></div> <div class="media-body mg-l-15 mg-t-4">
                                <h6 class="tx-14 tx-gray-700">Phone Number</h6>
                                <span class="d-block">+1 234 5678 910</span>
                            </div> -->
                        </div>
                        <div class="media mg-t-25">
                            <div><i class="icon ion-ios-email-outline tx-24 lh-0"></i></div>
                            <div class="media-body mg-l-15 mg-t-4">
                                <h6 class="tx-14 tx-gray-700">Email Address</h6>
                                <span class="d-block">{{$user->email}}</span>
                            </div>
                        </div>
                        <!-- <div class="media mg-t-25">
                        <div><i class="icon ion-social-twitter tx-18 lh-0"></i></div>
                        <div class="media-body mg-l-15 mg-t-2">
                            <h6 class="tx-14 tx-gray-700">Twitter</h6>
                            <a href="#" class="d-block">@themepixels</a>
                        </div>
                        </div> -->
                    </div><!-- media-list -->
                </div>
            </div>
        </div>
    </div>
@endsection
