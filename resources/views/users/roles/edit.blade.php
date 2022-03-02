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
                            <h4 class="mb-sm-0 font-size-18">{{$title}}</h4>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('usertypes.roles.update',['userTypeId' => $userTypeId]) }}" method="POST">        
                                            {{ @csrf_field() }}                            
                                            <div class="container">
                                                <div class="row">
                                                    @foreach($result as $datas)
                                                    <div class="col-md-6">
                                                        <hr>
                                                        <h4>{{ trans('general.'.$datas['link_name']) }} </h4>
                                                        <hr>
                                                        @foreach($datas['permissions'] as $data)                                
                                                        <div class="form-group">
                                                            <label class="col-sm-3 col-md-5 control-label" style="">{{ trans('general.'.$data['name']) }}</label>
                                                            <div class="col-sm-10 col-md-4">
                                                                <label class=" control-label">
                                                                <input type="radio" name="{{$data['name']}}" value="1" class="flat-red" @if($data['value']==1) checked @endif > &nbsp;{{ trans('general.Yes') }}
                                                                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <label class=" control-label">
                                                                <input type="radio" name="{{$data['name']}}" value="0" class="flat-red" @if($data['value']==0) checked @endif >  &nbsp;{{ trans('general.No') }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endforeach
                                                    </div>                                                    
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer mb-3">
                                                <button type="submit" class="btn btn-primary">{{ trans('general.submit') }} </button>
                                                <a href="{{ route('users')}}" type="button" class="btn btn-light">{{ trans('general.back') }}</a>
                                            </div>

                                            </form>                                            
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

    </body>

</html>
