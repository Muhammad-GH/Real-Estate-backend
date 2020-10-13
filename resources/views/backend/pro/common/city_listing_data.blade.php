
                        @foreach($city as $cities)
                            <tr>
                            <td>{{ $cities->city_name }}</td>
                            <td>{{ $cities->city_identifier }}</td>
                            <td>{{ $cities->lang_code }}</td>
                            
                            <td>@include('backend.pro.common.includes.city-actions', ['city' => $cities])</td>
                            </tr>
                        @endforeach
                        <tr>
       <td colspan="4" align="center">
       <div class="row mt-4">
            <div class="col-4">
                <div class="float-left">
                    {!! $city->total() !!} {{ trans_choice('total|total', $city->total()) }}
                </div>
            </div><!--col-->

            <div class="col-8">
                <div class="float-right">
                {!! $city->links() !!}
                </div>
            </div><!--col-->
        </div><!--row--> 
       </td>
      </tr>
