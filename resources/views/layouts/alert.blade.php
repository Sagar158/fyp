@if(Session::has('flash_message_error'))
    <div class="row">
        <div class="col-xl-12 col-sm-offset-3">
            <div class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                    <span>
                        <?php
                        $error = explode(",", Session::get('flash_message_error'));
                        foreach ($error as $value) echo "<strong>Error!</strong> " . $value . "<br>";
                        ?>
                    </span>
                    <?php Session::forget('flash_message_error');?>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div><!-- col-xl-6 -->
    </div>
@endif

@if(Session::has('flash_message_success'))
    <div class="row">

        <div class="col-xl-12 col-sm-offset-3">
            <div class="alert alert-success" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                    <span>
                        <?php
                        $error = explode(",", Session::get('flash_message_success'));
                        foreach ($error as $value) echo "<strong>Success!</strong> " . $value . "<br>";
                        ?>
                    </span>
                    <?php Session::forget('flash_message_success');?>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div><!-- col-xl-6 -->


    </div>
@endif