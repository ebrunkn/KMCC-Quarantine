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
                            <th>Type</th>
                            <th>Qty Requested</th>
                            <th>Building Name</th>
                            <th></th>
                          </tr>

                        </thead>
                        <tbody>
                          @foreach($data_bundle['items'] as $item)
                            <tr>
                              <td class="">
                                {{$item->getFoodTime->name ?? $item->getWarehouseItem->item_name ?? '-'}}
                              </td>
                              <td>{{$item->getRequestType->type}}</td>
                              <td>{{$item->requested_qty}}</td>
                              <td>{{$item->getBuilding->building_name}}</td>
                              <td class="actions">
                                {{-- <a href="{{url('warehouse/edit', array($item->id))}}" class="btn btn-xs btn-info"><a class="mdi mdi-pencil"></a></a> --}}
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

            <div class="row">
              <div class="col-12">
                {!! $data_bundle['items']->render() !!}
              </div>
            </div>
          </div>
        </div>
@stop

@push('page-specific-js-lib')
  {!! Html::script('admin/label-free/js/vendor.addons.js') !!}
@endpush
