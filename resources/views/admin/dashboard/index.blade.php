@extends ('admin.layout.master')

@push('page-specific-css-lib')
<link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
@endpush

@section('content')

<div class="page-content-wrapper-inner">
    <div class="content-viewport">
        <div class="row">
            <div class="col-12 py-5">
                <h4>{{session()->get('user.user_location')['location_name']}} -
                    {{session()->get('user.user_location')['zone_name']}}</h4>
                {{-- <p class="text-gray">Welcome aboard, {{auth('admin')->user()->name}}</p> --}}
            </div>
        </div>

        <div class="row justify-content-end mb-3">
            <div class="col-12 col-sm-4">
                <input type="text" class="form-control date-range-picker">
            </div>
        </div>

        {{-- <div class="row my-5">
      <div class="col-12">
        @include('admin.label-free.partials.summary-partial')
      </div>
    </div> --}}

        {{-- @if (in_array(auth('admin')->user()->user_group, ['super_admin', 'admin']))
    {{-- @include('admin.label-free.partials.devices-users') --}}
        {{-- @endif --}}


    </div>
</div>

@stop

@push('page-specific-js-lib')

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>


{!! Html::script('admin/vendors/apexcharts/apexcharts.min.js') !!}
{!! Html::script('admin/vendors/chartjs/Chart.min.js') !!}
{!! Html::script('admin/js/charts/chartjs.addon.js') !!}
{!! Html::script('admin/js/dashboard.js') !!}
@endpush

@push('page-specific-script')
<script>

</script>
@endpush
