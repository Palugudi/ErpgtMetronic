<!--begin: Datatable -->
<table class="m-datatables" id="SitesTable" width="100%">
        <thead>
            <tr>
                <th title="Field #1">
                      #
                </th>
                <!--<th title="Field #2">
                       Document
                </th> -->
                <th title="Field #3">
                      Site Name
                </th>
                <th title="Field #4">
                       Phone Number
                </th>
                <th title="Field #5">
                      Email
                </th>
                <th title="Field #6">
                         Address
                </th>
                <th itle="Field #9"> 
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sites as $index => $site )
                <tr>
                    <td>
                         <img class="erpgt50" src="images/welcome.jpg" 
                        style="width: 80px; height:80px; border-color: #6acce2; border-width: 2px; border-style: solid; border-radius: 50%;">
                    </td>
                    <!--`<td>
                        <a href="{!! asset('documents/'.$site->id.'/site/'.$site->name) !!}" 
                        data-lightbox="{{$site->name}}">{{$site->name}}</a>
                    </td> -->
                    <td>
                       <a href="{{ Route('site.show', $site->id) }}" style="color:#000;">
                        {{ $site->name}}</a>
                    </td>
                    <td>
                        <a href="tel:{{ $site->phone }}" style="color:#6c6d70;">
                        {{ $site->phone }}</a>
                    </td>
                    <td>
                        <a href="mailto:{{ $site->email }}" style="color:#6c6d70;">
                        {{ $site->email }}</a>
                    </td>
                    <td>
                         {{ $site->address }} {{ $site->postal_code }} {{ $site->city }}
                    </td>
                    <td>
                        
                        <a class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details"
			                    href="" OnClick='EditSite({{ $site->id }})' data-toggle="modal">
				               <i class="la la-edit"></i>
			            </a>
			            
                         <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"
			                    OnClick="DeleteSite({{ $site->id }})" data-toggle="modal" >
				              <i class="la la-trash"></i>
			              </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
<!--end: Datatable -->
