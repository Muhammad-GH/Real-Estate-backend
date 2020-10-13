
                        @foreach($state as $states)
                            <tr>
                            <td>{{ $states->state_name }}</td>
                            <td>{{ $states->state_code }}</td>
                            <td>{{ $states->lang_code }}</td>
                            
                            <td>@include('backend.pro.common.includes.state-actions', ['state' => $states])</td>
                            </tr>
                        @endforeach
                        <tr>
       <td colspan="4" align="center">
       <div class="row mt-4">
            <div class="col-4">
                <div class="float-left">
                    {!! $state->total() !!} {{ trans_choice('total|total', $state->total()) }}
                </div>
            </div><!--col-->

            <div class="col-8">
                <div class="float-right">
                {!! $state->links() !!}
                </div>
            </div><!--col-->
        </div><!--row--> 
       </td>
      </tr>
