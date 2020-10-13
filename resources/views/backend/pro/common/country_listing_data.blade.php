
                        @foreach($country as $countries)
                            <tr>
                            <td>{{ $countries->country_name }}</td>
                            <td>{{ $countries->country_code }}</td>
                            <td>{{ $countries->lang_code }}</td>
                            
                            <td>@include('backend.pro.common.includes.country-actions', ['country' => $countries])</td>
                            </tr>
                        @endforeach
                        <tr>
       <td colspan="4" align="center">
       <div class="row mt-4">
            <div class="col-4">
                <div class="float-left">
                    {!! $country->total() !!} {{ trans_choice('total|total', $country->total()) }}
                </div>
            </div><!--col-->

            <div class="col-8">
                <div class="float-right">
                {!! $country->links() !!}
                </div>
            </div><!--col-->
        </div><!--row--> 
       </td>
      </tr>
