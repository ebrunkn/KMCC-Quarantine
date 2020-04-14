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

                                <div class="col-12 col-md-8 mx-auto">

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">Building</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            {{ $data_bundle['requirement']->getBuilding['building_name'] }}
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">Room No</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            {{ $data_bundle['requirement']->room_no ?? 'NA' }}
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">Requirement Type</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            {{ $data_bundle['requirement']->getRequestType['type'] }}
                                        </div>
                                    </div>

                                    @if($data_bundle['requirement']->tyepe == 1)

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Warehouse Item</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {{ $data_bundle['requirement']->getRequestType['type'] }}
                                            </div>
                                        </div>

                                    @elseif($data_bundle['requirement']->tyepe == 2)

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Food Time</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {{ $data_bundle['requirement']->getRequestType['type'] }}
                                            </div>
                                        </div>

                                        <div class="form-group row showcase_row_area">
                                            <div class="col-md-3 showcase_text_area">
                                                <label for="inputType1">Food Cuisine</label>
                                            </div>
                                            <div class="col-md-9 showcase_content_area">
                                                {{ $data_bundle['requirement']->getRequestType['type'] }}
                                            </div>
                                        </div>

                                    @endif

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">Quantity Requested</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            {{ $data_bundle['requirement']->requested_qty }}
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">Quantity Allotted</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            {{ $data_bundle['requirement']->fulfilled_qty }}
                                        </div>
                                    </div>

                                    <div class="form-group row showcase_row_area">
                                        <div class="col-md-3 showcase_text_area">
                                            <label for="inputType1">Additional Info</label>
                                        </div>
                                        <div class="col-md-9 showcase_content_area">
                                            {{ $data_bundle['requirement']->info ?? 'NA' }}
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 mx-auto text-center">
                                        
                                    @if($data_bundle['requirement']->status == 3)

                                        <a href="#" class="btn btn-danger">
                                            <i class="mdi mdi-truck-delivery mr-2"></i>
                                            Stop Delivery
                                        </a>
                                        <a href="#" class="btn btn-success">
                                            <i class="mdi mdi-truck-delivery mr-2"></i>
                                            Finish Delivery
                                        </a>
                                        <a href="{{ url('delivery/entry') }}" class="btn btn-info">
                                            <i class="mdi mdi-truck-delivery mr-2"></i>
                                            Delivery Entry
                                        </a>

                                    @else

                                        <a href="{{ url('delivery/change-status', array($data_bundle['requirement']->id, 3)) }}" class="btn btn-info">
                                            <i class="mdi mdi-truck-delivery mr-2"></i>
                                            Start Delivery
                                        </a>

                                    @endif


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

@endpush
@stop
