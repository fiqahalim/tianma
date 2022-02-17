@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            {{ trans('cruds.order.title') }}
        </li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Order">
                <thead>
                    <tr class="table-info">
                        <th>
                            {{ trans('cruds.order.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.ref_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.order_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.customer') }}
                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.mode') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($myOrders as $key => $order)
                        <tr data-entry-id="{{ $order->id }}">
                            <td>
                                {{ ++$key }}
                            </td>
                            <td>
                                #{{ $order->ref_no ?? '' }}
                            </td>
                            <td>
                                {{ Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i:s') }}
                            </td>
                            <td>
                                {{ $order->customer->full_name ?? '' }}
                            </td>
                            <td>
                                {{ $order->customer->mode ?? '' }}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('user.my-orders.show', $order->id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- @can('order_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('user.my-orders.edit', $order->id) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                @endcan --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
@endsection
