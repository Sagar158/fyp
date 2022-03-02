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
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">

    </head>

    <body data-sidebar="dark">

        <div id="layout-wrapper">


            @include('layouts.header')

            @include('layouts.sidebar')


            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        @include('layouts.alert')
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex">
                                    <h4 class="mb-sm-0 font-size-18">{{$title}}</h4>
                                </div>
                                <a href="{{route('event.create')}}" class="btn btn-primary mb-2" title="{{trans('general.create')}}">{{trans('general.create')}}</a>
                                <a href="{{route('calendar')}}" class="btn btn-success mb-2" title="{{trans('general.view_all_events')}}">{{trans('general.view_all_events')}}</a>

                                <div class="card overflow-auto">
                                    <div class="card-body">
                                        <table id="event-table" class="table table-bordered dt-responsive nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>{{trans('general.title')}}</th>
                                                <th>{{ trans('general.promo') }}</th>
                                                <th>{{trans('general.from')}}</th>
                                                <th>{{trans('general.to')}}</th>
                                                <th>{{trans('general.action')}}</th>
                                            </tr>
                                            </thead>
                                        </table>
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
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>
        <script src="{{asset('js/delete.js')}}"></script>
        <script src="{{asset('js/sweetalert.js')}}"></script>

        <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
        <script>
            $(function() {
                $('#event-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route("event.showEvents") !!}',
                    columns: [
                        { data: 'title', name: 'title' },
                        { data:'promo', name: 'promo' },
                        { data: 'from', name: 'from' },
                        { data: 'to', name: 'to' },
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                });
            });
        </script>

    </body>

</html>
