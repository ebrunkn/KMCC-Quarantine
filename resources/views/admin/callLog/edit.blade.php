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
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>
    <div class="content-viewport">
        <div class="row">
            <div class="col-lg-12">
                <div class="grid">
                    <p class="grid-header">Edit Building</p>
                    <div class="grid-body">
                        <div class="item-wrapper">
                            <div class="row mb-3">

                                <div class="col-md-8 mx-auto">
                                    <form id="data-form" class="form"
                                        action="{{url('call-logs/save', array($data_bundle['item']->id))}}"
                                        callback="{{url('call-logs')}}"
                                        method="POST">
                                        {{-- {!! Form::open(['url' => 'buildings/save', 'callback' => url('buildings')]) !!} --}}
                                        @csrf

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Name</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('name', $data_bundle['item']->name,
                                                array('class'=>'form-control','placeholder'=>'Name')) !!}
                                                <span id="form-error-name"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Mobile</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('mobile', $data_bundle['item']->mobile,
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
                                                ], $data_bundle['item']->area,
                                                array('class'=>'form-control','placeholder'=>'Area')) !!}
                                                <span id="form-error-area"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Address</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::textArea('address', $data_bundle['item']->address,
                                                array('class'=>'form-control','placeholder'=>'Address')) !!}
                                                <span id="form-error-address"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Comments</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::textArea('comments', $data_bundle['item']->comments,
                                                array('class'=>'form-control','placeholder'=>'Comments')) !!}
                                                <span id="form-error-comments"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">

                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::submit('Update', array('class'=>'btn btn-success btn-block',
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
