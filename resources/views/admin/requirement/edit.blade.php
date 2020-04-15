@extends ('admin.layout.master')

@section('content')
<div class="page-content-wrapper-inner">
    <div class="viewport-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb has-arrow">
                <li class="breadcrumb-item">
                  <a href="/">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="/requirement">Requirement </a>
                </li>
                <li class="breadcrumb-item">
                  <a href="/requirement/food">All </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>
    <div class="content-viewport">
        <div class="row">
            <div class="col-lg-12">
                <div class="grid">
                    <p class="grid-header">Edit Requirement</p>
                    <div class="grid-body">
                        <div class="item-wrapper">
                            <div class="row mb-3">

                                <div class="col-md-8 mx-auto">
                                    <form id="data-form" class="form" action="{{url('requirement/save', $data_bundle['item']->id)}}"
                                        callback="{{url('requirement/food')}}" method="POST">
                                        {{-- {!! Form::open(['url' => 'buildings/save', 'callback' => url('buildings')]) !!} --}}
                                        @csrf
                                        {!! Form::hidden('type_id', $data_bundle['item']->type_id) !!}
                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Select Item</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::select('warehouse_item_id', $data_bundle['ware_house_items'], $data_bundle['item']->warehouse_item_id,
                                                array('class'=>'form-control','placeholder'=>'Meal Type')) !!}
                                                <span id="form-error-food_time_id"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Meal Type</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::select('food_time_id', $data_bundle['food_times'], $data_bundle['item']->food_time_id,
                                                array('class'=>'form-control','placeholder'=>'Meal Type')) !!}
                                                <span id="form-error-food_time_id"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Cuisine Type</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::select('food_cuisine_id', $data_bundle['food_cuisines'], $data_bundle['item']->food_cuisine_id,
                                                array('class'=>'form-control','placeholder'=>'Select Cuisine Type')) !!}
                                                <span id="form-error-food_cuisine_id"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Building</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::select('building_id', $data_bundle['buildings'], $data_bundle['item']->building_id,
                                                array('class'=>'form-control','placeholder'=>'Building')) !!}
                                                <span id="form-error-building_id"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Room Number</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('room_no', $data_bundle['item']->room_no,
                                                array('class'=>'form-control','placeholder'=>'Room Number')) !!}
                                                <span id="form-error-room_no"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Quantity</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('requested_qty', $data_bundle['item']->requested_qty,
                                                array('class'=>'form-control','placeholder'=>'Quantity')) !!}
                                                <span id="form-error-requested_qty"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Fulfilled Quantity</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::number('fulfilled_qty', $data_bundle['item']->fulfilled_qty > 0 ? $data_bundle['item']->fulfilled_qty : $data_bundle['item']->requested_qty,
                                                array('class'=>'form-control','placeholder'=>'Fulfilled Quantity',
                                                'min' => 0, 'max' => $data_bundle['item']->requested_qty, 'id' =>
                                                'fulfilled_qty')) !!}
                                                <span id="form-error-fulfilled_qty"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Assign volunteer</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::select('assigned_user', $data_bundle['volunteers'] ,'', array('class'=>'form-control','placeholder'=>'Assign A Volunteer')) !!}
                                                <span id="form-error-fulfilled_qty"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">

                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::submit('Submit', array('class'=>'btn btn-success btn-block',
                                                'id' => 'form-submit')) !!}
                                            </div>
                                        </div>
                                    </form>
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
@push('page-specific-script')
<script>
    $( "#fulfilled_qty" ).change(function() {
        var max = parseInt($(this).attr('max'));
        var min = parseInt($(this).attr('min'));
        if ($(this).val() > max)
        {
            $(this).val(max);
        }
        else if ($(this).val() < min)
        {
            $(this).val(min);
        }
    });
</script>
@endpush
@stop
