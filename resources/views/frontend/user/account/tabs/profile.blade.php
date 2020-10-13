 <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>Käyttäjä</th>
            <td>{{ (isset($user->userDetail) && $user->userDetail->type)?$user->userDetail->type:'--' }}</td>
        </tr>    
        <tr>
            <th>@lang('labels.frontend.user.profile.name')</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.email')</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Puhelinnumero</th>
            <td>{{ (isset($user->userDetail) && $user->userDetail->phone)?$user->userDetail->phone:'--' }}</td>
        </tr>
        <tr>
            <th>Osoite</th>
            <td>{{ (isset($user->userDetail) && $user->userDetail->address)?$user->userDetail->address:'--' }}</td>
        </tr>
        <tr>
            <th>Kaupunki</th>
            <td>{{ (isset($user->userDetail) && $user->userDetail->city_data)?$user->userDetail->city_data->name:'--' }}</td>
        </tr>
        <tr>
            <th>HETU</th>
            <td>{{ (isset($user->userDetail) && $user->userDetail->personal_id)?$user->userDetail->personal_id:'--' }}</td>
        </tr>
        <tr>
            <th>Kansalaisuus</th>
            <td>{{ (isset($user->userDetail) && $user->userDetail->citizen)?$user->userDetail->citizen:'--' }}</td>
        </tr>
        <!--tr>
            <th>Investment Size</th>
            <td>{{ (isset($user->userDetail) && $user->userDetail->investment_size)?$user->userDetail->investment_size:'--' }}</td>
        </tr-->
        <tr>
            <th>Vahvistustapa</th>
            <td>{{ (isset($user->userDetail) && $user->userDetail->authentication)?$user->userDetail->authentication:'--' }}</td>
        </tr>
        <tr>
            <th>Kortin numero</th>
            <td>{{ (isset($user->userDetail) && $user->userDetail->card_id)?$user->userDetail->card_id:'--' }}</td>
        </tr>
        <tr>
            <th>Myöntöpäivä</th>
            <td>{{ (isset($user->userDetail) && $user->userDetail->nomination_day)?$user->userDetail->nomination_day:'--' }}</td>
        </tr>
        <tr>
            <th>Viranomainen</th>
            <td>{{ (isset($user->userDetail) && $user->userDetail->nomination_authority)?$user->userDetail->nomination_authority:'--' }}</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.created_at')</th>
            <td>{{ \Carbon\Carbon::parse($logged_in_user->created_at)->format('l M d,Y')}}
             <!-- {{ timezone('EET')->convertToLocal($logged_in_user->created_at) }}  -->
             ({{ $logged_in_user->created_at->diffForHumans() }})</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.last_updated')</th>
            <td>{{ \Carbon\Carbon::parse($logged_in_user->updated_at)->format('l M d,Y')}}
            <!-- {{ timezone('EET')->convertToLocal($logged_in_user->updated_at) }} -->
             ({{ $logged_in_user->updated_at->diffForHumans() }})</td>
        </tr>
    </table>
</div>
