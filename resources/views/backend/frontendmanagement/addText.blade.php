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
.card-body label{
	font-weight: bold;
}
</style>
<div class="card"> 
        <div class="card-body">
            <div class="row" style="border-bottom: 1px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-12"> 
                	@if(session()->has('msg'))
					    <div class="alert alert-success">
					        {{ session()->get('msg') }}
					    </div>
					@endif
				<h2>Add Frontend Text</h2>
				<form action="{{route('admin.frontendmanagement.addtext')}}" method="post">
				{{csrf_field()}}
				  <div class="form-group">
					<label for="exampleInputEmail1">Text</label>
					<input type="text" class="form-control" name="name"  >
				  </div>
				  @foreach($languages as $lang)
				  @if($lang->id != 2)
				  <div class="form-group">
					<label for="exampleInputPassword1">Text in {{$lang->name}}</label>
					<input type="text" class="form-control"  name="lang_text[{{$lang->id}}][]">
				  </div>
				  @endif
				  @endforeach
				  
				  <button type="submit" class="btn btn-success" name="save">Save</button>
				</form>
                </div><!--col-->
                <div class="col-sm-7">
                </div><!--col-->
            </div><!--row-->
        </div>
         <!--card-body-->
    </div>
@endsection