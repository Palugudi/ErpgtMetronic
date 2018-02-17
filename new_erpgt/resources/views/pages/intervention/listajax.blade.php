<div class="portlet-body">
    <div class="table-responsive">
       <table class="table table-striped table-bordered table-advance table-hover">
        <thead style="background-color: #3598BC; color: #fff;" >
            <tr>
                                    
                <th></th>
                <th>Date</th>
                <th>{{trans('gtb.Site')}}</th>
                <th>{{trans('gtb.Assigned')}}</th>
                <th>{{trans('intervention.ReferenceWO')}}</th>
                <th>{{trans('intervention.Interventionstatus')}}</th>
                <th>{{trans('intervention.Interventiontype')}}</th>
                <th>{{trans('intervention.Priority')}}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($interventions as $intervention)
               
                <tr id="intervention{{ $intervention->id }}">
                    <td>

                        <a class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details"
			                    href="javascript:;" onClick='EditIntervention({{ $intervention->id }});' data-toggle="modal">
				               <i class="la la-edit"></i>
			            </a>
			            
                         <a href="javascript:;" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"
                                  OnClick="DeleteIntervention({{ $intervention->id }})" data-toggle="modal" >
				              <i class="la la-trash"></i>
			              </a>
                    </td>
                    <td>{{ format_date_simple_fromTS($intervention->created_at) }}</td>
                    <td><a href="{{ Route('site.show', $intervention->site_id) }}">{{ $sites[$intervention->site_id] }}</a></td>
                    <td>{{ $assigned[$intervention->assigned_id] }}</td>
                    <td><a href="{{ Route('intervention.show', $intervention->id) }}">{{ $intervention->reference_WO}}</a></td>
                    <td>{{ $interventionstatuses[$intervention->status_id] }}</td>
                    <td>{{ $interventiontypes[$intervention->type] }}</td>
                    <th>
                        @if($intervention->priority_id == 1)
                        <font color="#0099CC">
                        @elseif($intervention->priority_id == 2)
                        <font color="#007E33">
                        @elseif($intervention->priority_id == 3)
                        <font color="#FF8800">
                        @elseif($intervention->priority_id == 4)
                        <font color="#CC0000">
                        @endif
                        {{ $priorities[$intervention->priority_id] }}</font>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>