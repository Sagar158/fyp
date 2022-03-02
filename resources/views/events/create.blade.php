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
        <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('assets/libs/%40chenfengyuan/datepicker/datepicker.min.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
                                    <a href="{{URL::previous()}}" class="btn btn-primary">{{trans('general.back')}}</a>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('event.store')}}" method="POST" enctype="multipart/form-data">
                            {{@csrf_field()}}
                            <div class="card row mt-2">
                                <div class="col-lg-12 col-sm-12 col-md-12 mt-1">
                                    <label for="">{{trans('general.promotion')}}</label>
                                    <select name="promo_id" class="form-control @error('promo_id') is-invalid @enderror">
                                        <option value="">{{trans('general.select_promotion')}}</option>
                                        @if(!empty($promotions))
                                            @foreach($promotions as $promotion)
                                                <option value="{{$promotion->id}}">{{$promotion->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('promo_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-12 col-sm-12 col-md-12 mt-1">
                                    <label for="">{{trans('general.title')}}</label>
                                    <input type="text" autocomplete="off" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" placeholder="{{trans('general.enter_title')}}">
                                    @error('title')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-12 col-sm-12 col-md-12 mt-1">
                                    <label for="">{{trans('general.location')}}</label>
                                    <input type="text" autocomplete="off" name="location" class="form-control @error('location') is-invalid @enderror" value="{{old('location')}}" placeholder="{{trans('general.enter_location')}}">
                                    @error('location')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-12 col-sm-12 col-md-12 mt-1">
                                    <label for="">{{trans('general.from')}}</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control @error('from') is-invalid @enderror" name="from" placeholder="dd M, yyyy"
                                            data-date-format="dd M, yyyy" data-date-autoclose="true" data-date-container='#datepicker1' data-provide="datepicker" autocomplete="off" value="{{old('from')}}">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                    @error('from')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 mt-1">
                                    <label for="">{{trans('general.to')}}</label>
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" class="form-control @error('to') is-invalid @enderror" name="to" placeholder="dd M, yyyy"
                                            data-date-format="dd M, yyyy" data-date-autoclose="true" data-date-container='#datepicker1' data-provide="datepicker" autocomplete="off" value="{{old('to')}}">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                    @error('to')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 mt-1">
                                    <label for="">{{trans('general.event_description')}}</label>
                                    <textarea name="description" class="form-control summernote">{{old('description')}}</textarea>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 mt-3 mb-4">
                                    <button class="btn btn-primary" type="submit">{{trans('general.submit')}}</button>
                                    <a href="{{URL::previous()}}" class="btn btn-light">{{trans('general.back')}}</a>
                                </div>
                            </div>
                        </form>

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
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

        <script src="{{asset('assets/libs/%40chenfengyuan/datepicker/datepicker.min.js')}}"></script>

        <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>

        <script>
            $(document).ready(function() {
                $('.summernote').summernote({
                    placeholder: 'Please Enter Your Event Description Here',
                    tabsize: 2,
                    height: 300
                });
            });
        </script>
    </body>

</html>
