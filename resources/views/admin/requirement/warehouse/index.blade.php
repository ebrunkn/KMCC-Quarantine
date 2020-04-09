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
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
    </div>
    <div class="content-viewport">
        <div class="row">
            <div class="col-lg-12">
                <div class="grid">
                    <p class="grid-header">Warehouse Request List</p>
                    <div class="item-wrapper">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>

                                    <tr>
                                        <th>Item Name</th>
                                        <th>Qty Requested</th>
                                        <th>Building</th>
                                        <th>Date Requested</th>
                                        <th></th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach($data_bundle['items'] as $item)
                                    <tr>
                                        <td class="">
                                            {{$item->getWarehouseItem->item_name}}
                                        </td>
                                        <td>{{$item->requested_qty}}</td>
                                        <td>{{$item->getBuilding->building_name}}</td>
                                        <td>{{Carbon::parse($item->created_at)->format('d-m-Y h:i a')}}</td>
                                        <td class="actions">
                                            <a href="{{url('requirement/warehouse/edit', array($item->id))}}"
                                                class="btn btn-xs btn-info"><i class="mdi mdi-pencil"></i></a>
                                                @switch($item->status)
                                                    @case(2)
                                                    <a href="#" class="btn btn-xs
                                                    btn-success" title="Change to Processing">Delivered</a>
                                                        @break
                                                    @case(1)
                                                    <a href="{{url('requirement/update', array($item->id, 2))}}" class="btn btn-xs
                                                    btn-primary" title="Change to Processing">Processing</a>
                                                        @break
                                                    @default
                                                    <a href="{{url('requirement/update', array($item->id, 1))}}" class="btn btn-xs
                                                    btn-danger" title="Change to Processing">New</a>
                                                        @break
                                                @endswitch
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col align-self-end">
                {!! $data_bundle['items']->render() !!}
            </div>
        </div>
    </div>
</div>
@stop

@push('page-specific-js-lib')
{!! Html::script('admin/label-free/js/vendor.addons.js') !!}
@endpush
