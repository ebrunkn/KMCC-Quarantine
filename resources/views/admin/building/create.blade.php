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
            <a href="#">Devices</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
      </nav>
    </div>
    <div class="content-viewport">
      <div class="row">
        <div class="col-lg-12">
          <div class="grid">
            <p class="grid-header">Add Device</p>
            <div class="grid-body">
              <div class="item-wrapper">
                <div class="row mb-3">

                    <div class="col-md-8 mx-auto">
                      {{-- {!! Form::open(['url' => 'buildings/save', 'callback' => url('buildings')]) !!} --}}
                      <form id="data-form" action="{{url('buildings/save')}}" callback="{{url('buildings')}}" method="POST">
                        @csrf

                        <div style="width:100%;">
                            <input type="text" placeholder="Total rooms" name="total_rooms">
                            <span id="form-error-total_rooms"></span>
                        </div>

                        <div style="width:100%;">
                            <input type="text" placeholder="Occupancy" name="occupancy">
                            <span id="form-error-occupancy"></span>
                        </div>

                        <div style="width:100%;">
                            <input type="text" placeholder="Contact Person name" name="name">
                            <span id="form-error-name"></span>
                        </div>

                        <div style="width:100%;">
                            <input type="text" placeholder="Phone" name="phone">
                            <span id="form-error-phone"></span>
                        </div>

                      <div class="form-group row showcase_row_area">
                        <div class="col-md-3 showcase_text_area">
                          <label for="inputType1">Building Name</label>
                        </div>
                        <div class="col-md-9 showcase_content_area">
                          {!! Form::text('building_name', old('building_name'), array('class'=>'form-control','placeholder'=>'Building Name')) !!}
                          <span id="form-error-building_name"></span>
                        </div>
                      </div>

                      <div class="form-group row showcase_row_area">
                        <div class="col-md-3 showcase_text_area">
                          <label for="inputType1">Total Rooms</label>
                        </div>
                        <div class="col-md-9 showcase_content_area">
                          {!! Form::text('total_rooms', old('total_rooms'), array('class'=>'form-control','placeholder'=>'Total Rooms')) !!}
                          <span id="form-error-total_rooms"></span>
                        </div>
                      </div>

                      <div class="form-group row showcase_row_area">
                        <div class="col-md-3 showcase_text_area">
                          <label for="inputType1">Current Occupancy</label>
                        </div>
                        <div class="col-md-9 showcase_content_area">
                          {!! Form::text('occupancy', old('occupancy'), array('class'=>'form-control','placeholder'=>'Occupancy')) !!}
                          <span id="form-error-occupancy"></span>
                        </div>
                      </div>

                      <div class="form-group row showcase_row_area">
                        <div class="col-md-3 showcase_text_area">

                        </div>
                        <div class="col-md-9 showcase_content_area">
                          {!! Form::submit('Submit', array('class'=>'btn btn-success btn-block', 'id' => 'form-submit')) !!}
                        </div>
                      </div>
                      {!! Form::close() !!}
                    </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js') !!}
  {!! Html::script('form-handle/ajax-form.js') !!}
@stop
