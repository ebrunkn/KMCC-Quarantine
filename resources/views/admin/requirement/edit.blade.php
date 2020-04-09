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
                                        action="{{url('warehouse/save', array($data_bundle['item']->id))}}"
                                        callback="{{url('warehouse')}}"
                                        method="POST">
                                        {{-- {!! Form::open(['url' => 'buildings/save', 'callback' => url('buildings')]) !!} --}}
                                        @csrf

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Item Name</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('item_name',
                                                $data_bundle['item']->item_name,
                                                array('class'=>'form-control','placeholder'=>'Item Name')) !!}
                                                <span id="form-error-item_name"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">

                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::submit('Submit', array('class'=>'btn btn-success
                                                btn-block',
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
<div class="d-none" id="contact-person-item">
    <div class="form-group row showcase_row_area border-top pt-3">
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
            <label for="inputType1">Phone</label>
        </div>
        <div class="col-md-9 showcase_content_area">
            {!! Form::text('phone', old('phone'),
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
