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
                                    <form id="data-form" action="{{url('buildings/save')}}"
                                        callback="{{url('buildings')}}" method="POST">
                                        {{-- {!! Form::open(['url' => 'buildings/save', 'callback' => url('buildings')]) !!} --}}
                                        @csrf

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Building Name</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('building_name',
                                                $data_bundle['buildings']->building_name,
                                                array('class'=>'form-control','placeholder'=>'Building Name')) !!}
                                                <span id="form-error-building_name"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Total Rooms</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('total_rooms', $data_bundle['buildings']->total_rooms,
                                                array('class'=>'form-control','placeholder'=>'Total Rooms')) !!}
                                                <span id="form-error-total_rooms"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Current Occupancy</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {!! Form::text('occupancy', $data_bundle['buildings']->occupancy,
                                                array('class'=>'form-control','placeholder'=>'Occupancy')) !!}
                                                <span id="form-error-occupancy"></span>
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

                <div class="grid">
                    <p class="grid-header">
                        Contact Persons
                    </p>
                    <div class="grid-body">
                        <div class="item-wrapper">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>

                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th></th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach($data_bundle['buildings']->getContacts as $contact)
                                        <tr>
                                            <td class="">
                                                {{$contact->name}}
                                            </td>
                                            <td>{{$contact->phone}}</td>
                                            <td class="actions">
                                                <a href="{{url('buildings/edit', array($contact->id))}}"
                                                    class="btn btn-xs btn-danger"><i class="mdi mdi-delete"></a></i>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="row mb-3">

                                <div class="col-md-8 mx-auto contacts">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid">
                    <p class="grid-header">
                        Add New Contact Person
                    </p>
                    <div class="grid-body">
                        <div class="item-wrapper">
                            <div class="row mb-3">

                                <div class="col-md-8 mx-auto">
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
