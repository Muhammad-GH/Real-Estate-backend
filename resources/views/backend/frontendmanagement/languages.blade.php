<!-- @extends('backend.layouts.app') -->



@section('title', app_name() . ' | ' . 'Renovation Calculator')



@section('breadcrumb-links')

    @include('backend.setting.includes.breadcrumb-calculator-link')

@endsection

@section('content')
<style>
a.btn-success.float-right {
    padding: 10px 20px 10px 20px;
}
</style>
<div class="card"> 
        <div class="card-body">
            <div class="row" style="border-bottom: 1px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-12"> 
				<h2>All Languages</h2>
				<a href="{{route('admin.frontendmanagement.addlanguage')}}" class="btn-success float-right">Add</a>
                      <table class="table">
						<thead>
						  <tr>
							<th>Name</th>
							<th>Logo</th>
							<th>Logo2</th>
						  </tr>
						</thead>
						<tbody>
						@if(count($lang) >0)
						  @foreach($lang as $langdata)      
						  <tr class="success">
							<td>{{$langdata->name}}</td>
							<td>{{$langdata->logo}}</td>
							<td>{{$langdata->logo2}}</td>
						  </tr>
						  @endforeach
						  @else
							<tr class="success">
							<td>No Data found!</td>
						  </tr> 
						@endif	  
						   </tbody>
					  </table>
                </div><!--col-->
                <div class="col-sm-7">
                </div><!--col-->
            </div><!--row-->
        </div>
         <!--card-body-->
    </div>
@endsection