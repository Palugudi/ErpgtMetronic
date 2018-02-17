<div class="table-responsive">
    <table class="table" id="EnergyTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('energy.Energy')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($energys as $energy)
                <tr id="energy{{ $energy->id }}">
                    <td>
                        <a href="" OnClick='EditEnergy({{ $energy->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteEnergy({{ $energy->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                    </td>
                    <td>{{ $energy->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>