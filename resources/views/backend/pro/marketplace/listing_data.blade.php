
                        @foreach($tender as $tenders)
                            <tr>
                            <td>{{ $tenders->tender_title }}</td>
                            <td>{{ $tenders->tender_category_type  }} |  {{ $tenders->tender_type  }}</td>
                                <td> {{ $tenders->category->category_name }} </td>
                                 
                           
                                @php
                                    $diff = datetimeDiff($tenders->tender_expiry_date );
                                @endphp
                                <td>{{ $diff['day'] }} day, {{$diff['hour']}} hour</td>
                                <td>{{ $tenders->created_at->diffForHumans() }}</td>	
                                <td>@include('backend.pro.marketplace.includes.tender-actions', ['tender' => $tenders])</td>
                            </tr>
                        @endforeach
                        <tr>
       <td colspan="6" align="center">
       <div class="row mt-4">
            <div class="col-4">
                <div class="float-left">
                    {!! $tender->total() !!} {{ trans_choice('total|total', $tender->total()) }}
                </div>
            </div><!--col-->

            <div class="col-8">
                <div class="float-right">
                {!! $tender->links() !!}
                </div>
            </div><!--col-->
        </div><!--row--> 
       </td>
      </tr>
