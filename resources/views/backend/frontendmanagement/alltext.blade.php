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
            	@if(session()->has('msg'))
					    <div class="alert alert-success">
					        {{ session()->get('msg') }}
					    </div>
				@endif
                <div class="col-sm-12"> 
				<h2>All Text</h2>
				<a href="{{route('admin.frontendmanagement.addtext')}}" class="btn-success float-right">Add</a>
                      <table class="table">
						<thead>
						  <tr>
							<th>Text in English</th>
							<th>Text in Other Language</th>
							<th>Secondary Language</th>
							<th>Action</th>
						  </tr>
						</thead>
						<tbody>
						@if(count($text) >0)
						  @foreach($text as $textdata)      
						  <tr class="success">
							<td>{{$textdata->parentname->message}}</td> 
							<td>{{$textdata->message}}</td>
							<td>{{$textdata->langname->name}}</td>
							<td><a href="{{ route('admin.frontendmanagement.edittext', ['id' => $textdata->id]) }}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-primary" data-original-title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
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