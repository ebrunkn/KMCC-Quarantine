@extends ('admin.label-free.master')

@section('content')
  <div class="page-content-wrapper-inner">
          <div class="viewport-header">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb has-arrow">
                <li class="breadcrumb-item">
                  <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="#">Devices</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
              </ol>
            </nav>
          </div>
          <div class="content-viewport">
            <div class="row">
              <div class="col-lg-12">
                <div class="grid">
                  <p class="grid-header">Users List</p>
                  <div class="item-wrapper">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>

                          <tr>
                            <th>Device UID</th>
                            <th>Location</th>
{{--                            <th>Zone</th>--}}
                            <th>Last Connected</th>
                            <th>OTP</th>
                            <th></th>
                          </tr>

                        </thead>
                        <tbody>
                          @foreach($data_bundle['devices'] as $device)
                            <tr>
                              <td class="">
                                {{$device->device_uid}}
                              </td>
                              <td>
                                @if($device->location)
                                  {{$device->location['location_name']}}
                                @else
                                  <a href="{{url('admin/devices/link-to-location', array($device->id))}}" class="btn btn-xs btn-warning">Add Lo Location</a>
                                @endif
                              </td>
                              <td>{{$device->updated_at}}</td>
                              <td>
                                @if($device->otp)
                                  {{$device->otp}} <a href="{{url('admin/devices/otp/trash', array($device->id))}}"> <i class="mdi mdi-trash-can-outline"></i> </a>
                                @else
                                  @if($device->location)
                                    <a href="{{url('admin/devices/otp/generate', array($device->id))}}" class="btn btn-xs btn-warning">
                                      Generate OTP
                                    </a>
                                  @endif
                                @endif
                              </td>
                              <td class="actions">
                                <i class="mdi mdi-dots-vertical"></i>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                {!! $data_bundle['devices']->render() !!}
              </div>
            </div>
          </div>
        </div>
@stop

@push('page-specific-js-lib')
  {!! Html::script('admin/label-free/js/vendor.addons.js') !!}
@endpush