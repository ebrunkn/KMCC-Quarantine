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
                    <a href="/requirement/warehouse">Warehouse </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Warehouse Request</li>
            </ol>
        </nav>
    </div>
    <div class="content-viewport">
        <div class="row">
            <div class="col-lg-12">
                <div class="grid">
                    <p class="grid-header">Add Warehouse Request</p>
                    <div class="grid-body">
                        <div class="item-wrapper">
                            <div class="row mb-3">

                                <div class="col-md-8 mx-auto">
                                    <form id="data-form" class="form" action="{{url('requirement/save')}}"
                                        callback="{{url('requirement/warehouse')}}" method="POST">
                                        {{-- {!! Form::open(['url' => 'buildings/save', 'callback' => url('buildings')]) !!} --}}
                                        @csrf
                                        {!! Form::hidden('type_id', $data_bundle['type_id']->id) !!}
                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Select Item</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::select('warehouse_item_id', $data_bundle['ware_house_items'],
                                                null,
                                                array('class'=>'form-control','placeholder'=>'Item')) !!}
                                                <span id="form-error-warehouse_item_id"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Quantity</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('requested_qty', old('requested_qty'),
                                                array('class'=>'form-control','placeholder'=>'Quantity')) !!}
                                                <span id="form-error-requested_qty"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Order For</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <div class="form-check form-check-inline">
                                                    {!! Form::radio('requirement_for', 0, 1,
                                                    array('class'=>'form-check-input requirement_for_change', 'id'=>'requirement_for1')) !!}
                                                    <label class="form-check-label" for="requirement_for1">Building</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    {!! Form::radio('requirement_for', 1, null,
                                                    array('class'=>'form-check-input requirement_for_change', 'id'=>'requirement_for2')) !!}
                                                    <label class="form-check-label" for="requirement_for2">Individual</label>
                                                </div>
                                                <span id="form-error-requirement_for"></span>
                                            </div>
                                        </div>

                                        <div class="requirement_for_option">
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">Building</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    {!! Form::select('building_id', $data_bundle['buildings'], null,
                                                    array('class'=>'form-control','placeholder'=>'Building')) !!}
                                                    <span id="form-error-building_id"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">Room Number</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    {!! Form::text('room_no', old('room_no'),
                                                    array('class'=>'form-control','placeholder'=>'Room Number')) !!}
                                                    <span id="form-error-room_no"></span>
                                                </div>
                                            </div>
                                            <div></div>
                                        </div>

                                        <div class="requirement_for_option d-none">
                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">Name</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    {!! Form::text('individual_name',
                                                    old('individual_name'),
                                                    array('class'=>'form-control','placeholder'=>'Name')) !!}
                                                    <span id="form-error-individual_name"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row showcase_row_area">
                                                <div class="col-md-3 showcase_text_area">
                                                    <label for="inputType1">Mobile</label>
                                                </div>
                                                <div class="col-md-9 showcase_content_area">
                                                    {!! Form::text('individual_mobile',
                                                    old('individual_mobile'),
                                                    array('class'=>'form-control','placeholder'=>'Mobile')) !!}
                                                    <span id="form-error-individual_mobile"></span>
                                                </div>
                                            </div>
                                            <div></div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">

                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                @include('admin.partials.submit-button')
                                                {{-- {!! Form::submit('Submit', array('class'=>'btn btn-success btn-block',
                                                'id' => 'form-submit')) !!} --}}
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
    $('.requirement_for_change').change(function(e) {
        $('.requirement_for_option').toggleClass('d-none');
    });
</script>
@endpush
@stop
