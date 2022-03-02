<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>{{$title}}</title>
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="{{asset('css/fullcalendar.css')}}">
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />


    </head>

    <body data-sidebar="dark">

        <div id="layout-wrapper">


            @include('layouts.header')

            @include('layouts.sidebar')


            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">{{$title}}</h4>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">

                                        <div class="d-flex flex-wrap">
                                            <div class="me-3">
                                                <p class="text-muted mb-2">{{ trans('general.total_users') }}</p>
                                                <h5 class="mb-0">{{ $totalUsers }}</h5>
                                            </div>

                                            <div class="avatar-sm ms-auto">
                                                <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                    <i class="bx bx-user-circle"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">

                                        <div class="d-flex flex-wrap">
                                            <div class="me-3">
                                                <p class="text-muted mb-2">{{ trans('general.total_end_users') }}</p>
                                                <h5 class="mb-0">{{ $totalEndUsers }}</h5>
                                            </div>

                                            <div class="avatar-sm ms-auto">
                                                <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                    <i class="bx bxs-user-detail"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">

                                        <div class="d-flex flex-wrap">
                                            <div class="me-3">
                                                <p class="text-muted mb-2">{{ trans('general.total_events') }}</p>
                                                <h5 class="mb-0">{{ $totalEvents }}</h5>
                                            </div>

                                            <div class="avatar-sm ms-auto">
                                                <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                    <i class="bx bx bx-calendar-event"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                @include('layouts.footer')
            </div>

        </div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('js/moment.js')}}"></script>

        <script src="{{asset('js/fullcalendar.js')}}"></script>
        <script src="{{asset('js/main.min.js')}}"></script>
        <script src="{{asset('assets/js/app.js')}}"></script>

        <script>
            $(document).ready(function(){

                var data = @json($events);


                // console.log(event);
                var calendar = $('#calendar').fullCalendar({
                // put your options and callbacks here
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'year,month,basicWeek,basicDay'

                },
                timezone: 'local',
                height: "auto",
                selectable: true,
                dragabble: true,
                defaultView: 'month',
                yearColumns: 3,

                durationEditable: true,
                bootstrap: false,

                events: data,
                select: function(start, end, allDay) {

                },
                });
            });
        </script>
    </body>

</html>
