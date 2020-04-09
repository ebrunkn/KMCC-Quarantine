<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>KMCC - Covid-19 - Quarantine Application</title>
  <!-- plugins:css -->
  {!! Html::style('admin/vendors/iconfonts/mdi/css/materialdesignicons.css') !!}
  {!! Html::style('admin/vendors/css/vendor.addons.css') !!}
  <!-- endinject -->
  <!-- vendor css for this page -->
  <!-- End vendor css for this page -->
  <!-- inject:css -->
  {!! Html::style('admin/css/shared/style.css') !!}
  <!-- endinject -->
  <!-- Layout style -->
  {!! Html::style('admin/css/demo_1/style.css') !!}
  <!-- Layout style -->
  <link rel="shortcut icon" href="../../../assets/images/favicon.ico" />
</head>

<body>
  <div class="authentication-theme auth-style_1">
    <div class="row">
      <div class="col-12 logo-section">
        <a href="../../index.html" class="logo">
          {!! Html::image('admin/images/logo.svg') !!}
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5 col-md-7 col-sm-9 col-11 mx-auto">
        @if($errors->any())
        <div class="row">
          @foreach($errors->all() as $error)
          <div class="col alert alert-danger" role="alert">
            {{ $error }}
          </div>
          @endforeach
        </div>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5 col-md-7 col-sm-9 col-11 mx-auto">
        <div class="grid">
          <div class="grid-body">
            <div class="row">
              <div class="col-lg-7 col-md-8 col-sm-9 col-12 mx-auto form-wrapper">
                {!! Form::open() !!}
                <div class="form-group input-rounded">
                  {!! Form::text('email',old('email'),array('class'=>'form-control', 'placeholder'=>'Username')) !!}
                </div>
                <div class="form-group input-rounded">
                  {!! Form::password('password',array('class'=>'form-control', 'placeholder'=>'Password')) !!}
                </div>
                <div class="form-inline">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" class="form-check-input" />Remember me <i class="input-frame"></i>
                    </label>
                  </div>
                </div>
                {!! Form::submit('Login', array('class'=>'btn btn-primary btn-block')) !!}
                {!! Form::close() !!}
                {{-- <div class="signup-link">
                  <p>Don't have an account yet?</p>
                  <a href="#">Sign Up</a>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="auth_footer">
      <p class="text-muted text-center">© KMCC {{date('Y')}}</p>
    </div>
  </div>
  <!--page body ends -->
  <!-- SCRIPT LOADING START FORM HERE /////////////-->
  <!-- plugins:js -->
  {!! Html::script('admin/vendors/js/core.js') !!}
  {!! Html::script('admin/vendors/js/vendor.addons.js') !!}
  <!-- endinject -->
  <!-- Vendor Js For This Page Ends-->
  <!-- Vendor Js For This Page Ends-->
  <!-- build:js -->
  {!! Html::script('admin/js/template.js') !!}
  <!-- endbuild -->
</body>

</html>
