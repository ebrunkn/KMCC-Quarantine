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
                    <a href="#">Buildings</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Add</li>
            </ol>
        </nav>
    </div>
    <div class="content-viewport">
        <div class="row">
            <div class="col-lg-12">
                <form id="data-form" action="{{url('buildings/save')}}" callback="{{url('buildings')}}" method="POST">
                    <div class="grid">
                        <p class="grid-header">Add Building</p>
                        <div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row mb-3">

                                    <div class="col-md-8 mx-auto">
                                        {{-- {!! Form::open(['url' => 'buildings/save', 'callback' => url('buildings')]) !!} --}}
                                        @csrf

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Building Name</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('building_name', old('building_name'),
                                                array('class'=>'form-control','placeholder'=>'Building Name')) !!}
                                                <span id="form-error-building_name"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Total Rooms</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('total_rooms', old('total_rooms'),
                                                array('class'=>'form-control','placeholder'=>'Total Rooms')) !!}
                                                <span id="form-error-total_rooms"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Current Occupancy</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('occupancy', old('occupancy'),
                                                array('class'=>'form-control','placeholder'=>'Occupancy')) !!}
                                                <span id="form-error-occupancy"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid">
                        <p class="grid-header">
                            Contact Persons
                        </p>
                        <div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row mb-3">

                                    <div class="col-md-8 mx-auto contacts">

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Name</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('name[]', old('name[]'),
                                                array('class'=>'form-control','placeholder'=>'Name')) !!}
                                                <span id="form-error-name"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Phone</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('phone[]', old('phone[]'),
                                                array('class'=>'form-control','placeholder'=>'Phone')) !!}
                                                <span id="form-error-phone"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 mx-auto mt-4 text-right">
                                        <p><a href="" class="btn btn-sm btn-info add-more">Add More</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid">
                        <div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row mb-3">

                                    <div class="col-md-8 mx-auto">

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">

                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::submit('Submit', array('class'=>'btn btn-success btn-block',
                                                'id' => 'form-submit')) !!}
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="d-none" id="contact-person-item">
    <div class="form-group row showcase_row_area border-top pt-3">
        <div class="col-md-3 showcase_text_area">
            <label for="inputType1">Name</label>
        </div>
        <div class="col-md-9 showcase_content_area">
            {!! Form::text('name[]', old('name[]'),
            array('class'=>'form-control','placeholder'=>'Name')) !!}
            <span id="form-error-name"></span>
        </div>
    </div>

    <div class="form-group row showcase_row_area">
        <div class="col-md-3 showcase_text_area">
            <label for="inputType1">Phone</label>
        </div>
        <div class="col-md-9 showcase_content_area">
            {!! Form::text('phone[]', old('phone[]'),
            array('class'=>'form-control','placeholder'=>'Phone')) !!}
            <span id="form-error-phone"></span>
        </div>
    </div>
</div>
{!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js') !!}
{!! Html::script('form-handle/ajax-form.js') !!}
@push('page-specific-script')
<script>
    $('.add-more').click(function(e) {
        e.preventDefault();
        console.log('Clicked');
        $('#contact-person-item').children().clone().appendTo('.contacts');
    })
</script>
@endpush
@stop
