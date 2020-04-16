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
                  <a href="#">Call Logs</a>
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
                    Call Logs List
                    <a href="{{url('call-logs/add')}}" class="btn btn-sm btn-success float-right">
                      <i class="mdi mdi-plus"></i>
                      Add New
                    </a>
                  </p>
                  <div class="item-wrapper">

                    <div class="row my-4">
                      <div class="col-12">
                        <div class="row justify-content-end">
                          <div class="col-12 col-md-4 col-lg-3">
                            {!! Form::open(array('method'=>'get')) !!}

                              <div class="input-group mb-3">
                              <input type="text" name="mobile" value="{{request()->get('mobile')}}" class="form-control form-control-lg" placeholder="Search Mobile" aria-label="Search Mobile" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                  <button class="btn btn-outline-success btn-sm" type="submit">
                                    <i class="mdi mdi-account-search"></i>
                                  </button>
                                </div>
                              </div>

                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>

                          <tr>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Emirate</th>
                            <th>Address</th>
                            <th></th>
                          </tr>

                        </thead>
                        <tbody>
                          @foreach($data_bundle['items'] as $callLog)
                            <tr>
                              <td class="">
                                {{$callLog->name}}
                              </td>
                              <td>{{$callLog->mobile}}</td>
                              <td>{{$callLog->getEmirate['name']}}</td>
                              <td>{{$callLog->address}}</td>
                              <td class="actions">
                                <a href="{{url('call-logs/edit', array($callLog->id))}}" class="btn btn-xs btn-info"><i class="mdi mdi-pencil"></a></i>
                                <a href="{{url('call-logs/view', array($callLog->id))}}" class="btn btn-xs btn-success"><i class="mdi mdi-eye"></a></i>
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
                {!! $data_bundle['items']->render() !!}
              </div>
            </div>
          </div>
        </div>
@stop

@push('page-specific-js-lib')
  {!! Html::script('admin/label-free/js/vendor.addons.js') !!}
@endpush
