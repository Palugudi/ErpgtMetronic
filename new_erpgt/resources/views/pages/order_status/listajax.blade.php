<div class="table-responsive">
    <table class="table" id="OrderStatusTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('order_status.Order_status')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($order_statuss as $order_status)
                <tr id="order_status{{ $order_status->id }}">
                    <td>
                        <a href="" OnClick='EditOrder_status({{ $order_status->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteOrder_status({{ $order_status->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                    </td>
                    <td>{{ $order_status->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>