@extends('voyager::master')

@section('page_title', 'Ver Productos en Ventas')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-bag"></i> Productos en Ventas &nbsp;
        <a href="{{ route('voyager.item-sales.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            Volver a la lista
        </a> 
    </h1>
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Categoría</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item->category->name }} </p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-4">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Productos/ Items</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $item+----------------------------------------------------------------->name }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-4">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Precio</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ date('d', strtotime($inventory->created_at)) }} de {{ $months[intval(date('m', strtotime($inventory->created_at)))] }} de {{ date('Y', strtotime($inventory->created_at)) }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>

                        <div class="col-md-4">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Tipo de Ventas</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{date('h:i:s a', strtotime($inventory->created_at))}} <small>{{\Carbon\Carbon::parse($inventory->created_at)->diffForHumans()}}</small></p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-4">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Observación / Descripción</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{date('h:i:s a', strtotime($inventory->created_at))}} <small>{{\Carbon\Carbon::parse($inventory->created_at)->diffForHumans()}}</small></p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                    </div>                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>
                                    Detalles del Inventario
                                </h4>
                            </div>
                        </div>
                        <div class="row" id="div-results" style="min-height: 120px">
                            <div class="form-group col-md-12">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="4" style="text-align: center">DETALLES</th>
                                                <th colspan="3" style="text-align: center">VALOR ADQUIRIDO</th>
                                                <th colspan="2" style="text-align: center">VALOR VENTA</th> 
                                                <th style="width: 5%"></th>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center; width:3%">N&deg;</th>
                                                <th style="text-align: center; width:20%">Item / Artículo</th>
                                                <th style="text-align: center">Detalle / Descripción</th>
                                                <th style="text-align: center; width:6%">F. Expiración</th>

                                                <th style="text-align: center; width:8%">Cantidad</th>
                                                <th style="text-align: center; width:8%">Precio</th>
                                                <th style="text-align: center; width:6%">Subtotal</th> 

                                                <th style="text-align: center; width:8%">Precio</th>
                                                <th style="text-align: center; width:6%">Subtotal</th> 
                                                <th style="text-align: center; width: 5%">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>    
                                            @php
                                                $cant = 1;
                                                $price = 0;
                                                $priceSale = 0;
                                                $quantity = 0;
                                                $subTotal = 0;
                                                $subTotalsale = 0;
                                                $stock = 0;
                                            @endphp            
                                            @forelse ($inventory->inventoryDetail as $item)
                                            <tr>
                                                <td>{{ $cant }}</td>
                                                <td>
                                                    <table>
                                                        @php
                                                            $image = asset('images/default.jpg');
                                                            if($item->item->image){
                                                                $image = asset('storage/'.str_replace('.', '-cropped.', $item->item->image));
                                                            }
                                                        @endphp
                                                        <tr>
                                                            <td rowspan="3">
                                                                    <img src="{{ $image }}" alt="{{ $item->item->name }}" width="50px" />
                                                            </td>
                                                            <td>
                                                                <small>Item: </small> <span>{{$item->item->name}}</span>
                                                                <input type="hidden" name="item_id[]" value="${type.id}"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <small>Presentación: </small>{{$item->item->unitType->name}} - {{$item->item->unitType->shape}}<span></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <small>Categoría: </small> <span>{{$item->item->itemCategory->name}}</span>
                                                            </td>
                                                        </tr>
                                                    </table>                                                    
                                                </td>
                                                <td style="text-align: center">
                                                    <span>{{ $item->item->description?$item->item->description:'Sin Detalles'}}</span>
                                                </td>
                                                <td style="text-align: center">
                                                    {{$item->expirationDate?date('d/m/Y', strtotime($item->expirationDate)):'Sin Fecha'}}
                                                </td>
                                                <td style="text-align: right">                                                    
                                                    @if ($item->deleted_at)
                                                        <del style="color: red">{{number_format($item->quantity, 2, ',', '.')}}</del>
                                                    @else
                                                        {{number_format($item->quantity, 2, ',', '.')}}
                                                    @endif
                                                </td>
                                                <td style="text-align: right">                                                    
                                                    @if ($item->deleted_at)
                                                        <del style="color: red">{{number_format($item->price, 2, ',', '.')}}</del>
                                                    @else
                                                        {{number_format($item->price, 2, ',', '.')}}
                                                    @endif
                                                </td>
                                                <td style="text-align: right">                                                    
                                                    @if ($item->deleted_at)
                                                        <del style="color: red">{{number_format($item->subTotal, 2, ',', '.')}}</del>
                                                    @else
                                                        {{number_format($item->subTotal, 2, ',', '.')}}
                                                    @endif
                                                </td>

                                                <td style="text-align: right">                                                    
                                                    @if ($item->deleted_at)
                                                        <del style="color: red">{{number_format($item->priceSale, 2, ',', '.')}}</del>
                                                    @else
                                                        {{number_format($item->priceSale, 2, ',', '.')}}
                                                    @endif
                                                </td>
                                                <td style="text-align: right">                                                    
                                                    @if ($item->deleted_at)
                                                        <del style="color: red">{{number_format($item->subTotalSale, 2, ',', '.')}}</del>
                                                    @else
                                                        {{number_format($item->subTotalSale, 2, ',', '.')}}
                                                    @endif
                                                </td>

                                                <td style="text-align: center">                                                   
                                                    @if ($item->deleted_at)
                                                        <span style="color: red">Eliminado</span>
                                                    @else
                                                        {{number_format($item->stock, 2, ',', '.')}}<br>
                                                        @if ($item->quantity > 0)
                                                            <label class="label label-success">Disponible</label><br>
                                                            <a href="#" onclick="deleteItem('{{ route('inventories-detail.destroy', ['detail' => $item->id]) }}')" title="Eliminar" data-toggle="modal" data-target="#modal-delete" class="btn btn-sm btn-danger delete">
                                                                <i class="voyager-trash"></i>
                                                            </a>

                                                        @else
                                                            <label class="label label-danger">Agotado</label>                            
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                $cant ++;
                                                if (!$item->deleted_at) {
                                                    $price +=$item->price;
                                                    $priceSale += $item->priceSale;
                                                    $quantity += $item->quantity;
                                                    $subTotal += $item->subTotal;
                                                    $subTotalsale +=$item->subTotalSale;
                                                    $stock += $item->stock;
                                                }
                                            @endphp
                                            @empty
                                                <tr>
                                                    <td colspan="10">
                                                        <h5 class="text-center" style="margin-top: 50px">
                                                            <img src="{{ asset('images/empty.png') }}" width="120px" alt="" style="opacity: 0.8">
                                                            <br><br>
                                                            No hay resultados
                                                        </h5>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" style="text-align: right">Total</td>
                                                <td style="text-align: right">{{number_format($quantity, 2, ',', '.')}}</td>
                                                <td style="text-align: right">{{number_format($price, 2, ',', '.')}}</td>
                                                <td style="text-align: right">{{number_format($subTotal, 2, ',', '.')}}</td>
                                                <td style="text-align: right">{{number_format($priceSale, 2, ',', '.')}}</td>
                                                <td style="text-align: right">{{number_format($subTotalsale, 2, ',', '.')}}</td>
                                                <td style="text-align: right">{{number_format($stock, 2, ',', '.')}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.modal-delete')
    
@stop

@section('css')
    <style>

    </style>
@stop

@section('javascript')
    <script>
        function deleteItem(url){
            $('#delete_form').attr('action', url);
        }
    </script>
    
@stop