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
                    <a href="#">Warehouse Stock</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
    </div>
    <div class="content-viewport">
        <div class="row">
            <div class="col-lg-12">
                <div class="grid">
                    <p class="grid-header">Stock List</p>
                    <div class="item-wrapper">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>

                                    <tr>
                                        <th>Item Name</th>
                                        <th>Current Stock</th>
                                        <th>Qty Requested</th>
                                        <th>Stock Threshold</th>
                                        <th></th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach($data_bundle['items'] as $item)
                                    <tr>
                                        <td class="">
                                            {{$item->item_name}}
                                        </td>
                                        <td>{{$item->total_stock}}</td>
                                        <td>{{$item->qty_requested}}</td>
                                        <td>{{$item->threshold}}</td>
                                        <td class="actions">
                                            <a href="{{url('stock/edit', array($item->id))}}"
                                                class="btn btn-xs btn-info"><i class="mdi mdi-pencil"></a></i>
                                            <a href="{{url('stock/add-stock', array($item->id))}}"
                                                class="btn btn-xs btn-success" title="Add Stock"><i class="mdi mdi-plus"></i> Add Stock</a>
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
