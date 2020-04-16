@extends ('admin.layout.master')

@section('content')
  <div class="page-content-wrapper-inner">
          <div class="viewport-header">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb has-arrow">
                <li class="breadcrumb-item">
                  <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="#">Requirements</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
              </ol>
            </nav>
          </div>
          <div class="content-viewport">
            <div class="row">
              <div class="col-lg-12">
                <div class="grid">
                  <p class="grid-header">
                    My Assigned List
                    {{-- <a href="{{url('buildings/add')}}" class="btn btn-sm btn-success float-right">
                      <i class="mdi mdi-plus"></i>
                      Add New
                    </a> --}}
                  </p>
                  <div class="item-wrapper">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>

                          <tr>
                            <th>Order No</th>
                            <th>Buidling / Person</th>
                            <th>Order Type</th>
                            <th>Assigned Time</th>
                            <th>Status</th>
                            <th></th>
                          </tr>

                        </thead>
                        <tbody>
                          @foreach($data_bundle['requirements'] as $requirement)
                            <tr>
                              <td class="">
                                {{ $requirement->id }}
                              </td>
                              <td>{{ $requirement->getBuilding['building_name'] ?? $requirement->individual_name.'('.$requirement->individual_mobile.')' }}</td>
                              <td>{{ $requirement->getRequestType['type'] }}</td>
                              <td>{{ $requirement->assigned_time ?? 'NA' }}</td>
                              <td>{{ $requirement->status_label }}</td>
                              <td class="actions">
                                <a href="{{ url('delivery/requirements', array($requirement->id)) }}" class="btn btn-xs btn-success">
                                  <i class="mdi mdi-eye"></i>
                                </a>
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

            <div class="row justify-content-end">
                <div class="col align-self-end">
                {!! $data_bundle['requirements']->render() !!}
              </div>
            </div>
          </div>
        </div>
@stop

@push('page-specific-js-lib')
  {!! Html::script('admin/label-free/js/vendor.addons.js') !!}
@endpush
