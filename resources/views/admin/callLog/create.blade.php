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
                <li class="breadcrumb-item active" aria-current="page">Add</li>
            </ol>
        </nav>
    </div>
    <div class="content-viewport">
        <div class="row">
            <div class="col-lg-12">
                <form id="data-form" class="form" action="{{url('call-logs/save')}}" callback="{{url('call-logs')}}"
                    method="POST">
                    <div class="grid">
                        <p class="grid-header">Add Call Log</p>
                        <div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row mb-3">

                                    <div class="col-md-8 mx-auto">
                                        {{-- {!! Form::open(['url' => 'buildings/save', 'callback' => url('buildings')]) !!} --}}
                                        @csrf

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Name</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('name', old('name'),
                                                array('class'=>'form-control','placeholder'=>'Name')) !!}
                                                <span id="form-error-name"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Mobile</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('mobile', old('mobile'),
                                                array('class'=>'form-control','placeholder'=>'Mobile')) !!}
                                                <span id="form-error-mobile"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Area</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::select('area', [
                                                    'Abu Dhabi' => 'Abu Dhabi',
                                                    'Dubai' => 'Dubai',
                                                    'Sharjah' => 'Sharjah',
                                                    'Ajman' => 'Ajman',
                                                    'RAK' => 'RAK',
                                                    'Fujairah' => 'Fujairah',
                                                    'UAQ' => 'UAQ'
                                                ], old('mobile', 0),
                                                array('class'=>'form-control','placeholder'=>'Area')) !!}
                                                <span id="form-error-area"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Address</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::textArea('address', old('address'),
                                                array('class'=>'form-control','placeholder'=>'Address')) !!}
                                                <span id="form-error-address"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Comments</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::textArea('comments', old('comments'),
                                                array('class'=>'form-control','placeholder'=>'Comments')) !!}
                                                <span id="form-error-comments"></span>
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
