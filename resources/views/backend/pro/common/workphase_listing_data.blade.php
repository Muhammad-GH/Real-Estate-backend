
                        @foreach($workphase as $workphases)
                            <tr>
                            <td>{{ $workphases->aw_lang_aw_name }}</td>
                            <td>{{ $workphases->aw_identifier }}</td>
                            <td>{{ $workphases->lang_code }}</td>
                            
                            <td>@include('backend.pro.common.includes.workphase-actions', ['workphase' => $workphases])</td>
                            </tr>
                        @endforeach
                        <tr>
       <td colspan="4" align="center">
       <div class="row mt-4">
            <div class="col-4">
                <div class="float-left">
                    {!! $workphase->total() !!} {{ trans_choice('total|total', $workphase->total()) }}
                </div>
            </div><!--col-->

            <div class="col-8">
                <div class="float-right">
                {!! $workphase->links() !!}
                </div>
            </div><!--col-->
        </div><!--row--> 
       </td>
      </tr>
