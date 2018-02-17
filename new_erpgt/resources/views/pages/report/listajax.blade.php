<div class="table-responsive">
    <table class="table" id="ReportTable">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('report.User')}}</th>
                @if($reportmenu)
                    <th>{{trans('report.Site')}}</th>
                @endif
                <th>{{trans('report.ReportDate')}}</th>
                @if(!$in_equipment_show)
                    <th>{{trans('report.Equipment')}}</th>
                @endif
                @if(!$in_intervention_show)
                    <th>{{trans('report.Intervention')}}</th>
                @endif
                <th>{{trans('report.Flaw')}}</th>
                <th>{{trans('report.Cause')}}</th>
                <th>{{trans('report.Solution')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($reports as $report)
                <tr id="report{{ $report->id }}">
                    @if ($report->user_id == Auth::user()->id && !$reportmenu)
                    <td>
                        <a href="" OnClick='EditReport({{ $report->id }});' data-toggle="modal"><span class="glyphicon glyphicon-pencil text-warning"></span></a>
                        <a href="" OnClick="DeleteReport({{ $report->id }})" data-toggle="modal"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                    </td>
                    @else
                    <td></td>
                    @endif
                    <td>{{ $users[$report->user_id] }}</td>
                    @if($reportmenu)
                        <td><a href="{{ Route('site.show', $report->site_id) }}">{{$sites[$report->site_id]}}</a></td>
                    @endif
                    <td><a href="{{ route('report.show', $report->id) }}">{{ format_date_simple($report->date) }}</a></td>
                    @if(!$in_equipment_show)
                        <td>{{ $equipments[$report->equipment_id] }}</td>
                    @endif
                    @if(!$in_intervention_show)
                        <td>{{ $interventions[$report->intervention_id] }}</td>
                    @endif
                    <td>{!! nl2br($report->flaw) !!}</td>
                    <td>{!! nl2br($report->cause) !!}</td>
                    <td>{!! nl2br($report->solution) !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>