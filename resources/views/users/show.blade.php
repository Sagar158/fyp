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
                                    <a class="btn btn-primary" href="{{URL::previous()}}">{{trans('general.back')}}</a>
                                </div>
                            </div>
                        </div>

                        <div class="card row">
                            <div class="col-12">
                                <table class="table table-bordered mt-2">
                                    <tr>
                                        <th>{{trans('general.name')}}:</th>
                                        <td>{{$user->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{trans('general.type')}}:</th>
                                        <td>{{$user->usertypes->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{trans('general.mobile')}}:</th>
                                        <td>{{$user->mobile}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{trans('general.email')}}:</th>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                </table>

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

    </body>

</html>
