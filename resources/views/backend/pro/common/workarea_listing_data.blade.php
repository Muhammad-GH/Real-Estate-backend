
                        @foreach($workarea as $workareas)
                            <tr>
                            <td>{{ $workareas->area_name }}</td>
                            <td>{{ $workareas->area_identifier }}</td>
                            <td>{{ $workareas->lang_code }}</td>
                            
                            <td>@include('backend.pro.common.includes.workarea-actions', ['workarea' => $workareas])</td>
                            </tr>
                        @endforeach
                        <tr>
       <td colspan="4" align="center">
       <div class="row mt-4">
            <div class="col-4">
                <div class="float-left">
                    {!! $workarea->total() !!} {{ trans_choice('total|total', $workarea->total()) }}
                </div>
            </div><!--col-->

            <div class="col-8">
                <div class="float-right">
                {!! $workarea->links() !!}
                </div>
            </div><!--col-->
        </div><!--row--> 
       </td>
      </tr>
