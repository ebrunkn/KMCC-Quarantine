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

    {{--Graph Holder--}}
    <div class="row text-center my-3">
        <div class="col-lg-12 col-md-12 equel-grid">
            <div class="grid">
                <div class="grid-body">
                    <p class="card-title text-center">Hourly Occupancy Graph</p>
                    <div class="ct-chart">
                        {{-- @include('admin.label-free.partials.progress-bar-animation') --}}
                        {{--Loading From jQuery-Axios Call--}}
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{--End of Graph Holder--}}

    {{-- <div class="row my-5">
      <div class="col-12">
        @include('admin.label-free.partials.summary-partial')
      </div>
    </div> --}}

    {{-- @if (in_array(auth('admin')->user()->user_group, ['super_admin', 'admin']))
    {{-- @include('admin.label-free.partials.devices-users') --}}
    {{-- @endif --}}

    {{-- @include('admin.label-free.partials.summary-partial-dashboard') --}}

  </div>
</div>

@stop

@push('page-specific-js-lib')

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>


{!! Html::script('admin/label-free/vendors/apexcharts/apexcharts.min.js') !!}
{!! Html::script('admin/label-free/vendors/chartjs/Chart.min.js') !!}
{!! Html::script('admin/label-free/js/charts/chartjs.addon.js') !!}
{!! Html::script('admin/label-free/js/dashboard.js') !!}
@endpush

@push('page-specific-script')
<script>

</script>
@endpush
