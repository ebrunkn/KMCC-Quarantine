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

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Name</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {{ $data_bundle['item']->name }}
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Mobile</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {{ $data_bundle['item']->mobile }}
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Emirate</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {{ $data_bundle['item']->getEmirate['name'] }}
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Nationality</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {{ $data_bundle['item']->nationality }}
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Address</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! $data_bundle['item']->address !!}
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Residence Type</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {{$data_bundle['item']->residence_type}}
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Covid Tested</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {{$data_bundle['item']->covid_tested}}
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Follow up Status</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {{$data_bundle['item']->follow_up_status}}
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Remarks</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! $data_bundle['item']->remarks !!}
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">

                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                <a href="{{url('call-logs/edit', array($data_bundle['item']->id))}}" class="btn btn-success btn-block">
                                                    UPDATE
                                                </a>
                                            </div>
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
        $('.add-more').click(function(e) {
        e.preventDefault();
        console.log('Clicked');
        $('#contact-person-item').children().clone().appendTo('.contacts');
    })
    </script>
    @endpush
    @stop
