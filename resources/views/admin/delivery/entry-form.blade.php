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
                    <a href="#">Delivery</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Entry</li>
            </ol>
        </nav>
    </div>
    <div class="content-viewport">
        <div class="row">
            <div class="col-lg-12">
                <form id="data-form" class="form" action="{{url('delivery/entry')}}" callback="{{url('delivery/entry')}}" method="POST">
                    @csrf
                    <div class="grid">
                        <p class="grid-header">Delivery Entry  ({{ $data_bundle['requirements']->first()->getBuilding['building_name'] }})</p>
                        <div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row mb-3">

                                    <div class="col-12 col-sm-8 col-md-5 mx-auto">
                                    
                                        <div class="form-group row showcase_row_area">
                                            <div class="col-12 text-center">
                                                <label for="inputType1">Room No</label>
                                            </div>
                                            <div class="col-12">
                                                {!! Form::text('room_no', old('room_no'),
                                                array('class'=>'form-control text-center','placeholder'=>'Room No', 'autoComplete'=>'off')) !!}
                                                <span id="form-error-room_no"></span>
                                            </div>
                                        </div>

                                        @foreach($data_bundle['requirements'] as $requirement)

                                            <div class="form-group row showcase_row_area">
                                                <div class="col-12 text-center">
                                                    <label for="inputType1">{{ $requirement->item_name }}</label>
                                                </div>
                                                <div class="col-12">
                                                    {!! Form::hidden('requirement_id[]', $requirement->id) !!}
                                                    {!! Form::text('item_count[]', 0,
                                                    array('class'=>'form-control text-center','placeholder'=>'Total Rooms')) !!}
                                                    <span id="form-error-total_rooms"></span>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="badge badge-info">Hand: {{ (($requirement->fulfilled_qty ?? 0) - $requirement->door_delivered_sum) }}</span>
                                                        </div>
                                                        <div class="col-6 text-right">
                                                            <span class="badge badge-success">Delivered: {{ $requirement->door_delivered_sum }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-12 text-center">
                                                <label for="inputType1">Deliveery Note (Optional)</label>
                                            </div>
                                            <div class="col-12">
                                                {!! Form::textarea('note', old('note'), array('class'=>'form-control','placeholder'=>'Note','rows'=>4, 'autoComplete'=>'off')) !!}
                                                <span id="form-error-note"></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid">
                        <div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row mb-3">

                                    <div class="col-12 mx-auto">

                                        <div class="form-group row">
                                            <div class="col-12">
                                                @include('admin.partials.submit-button')
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
