<!-- @extends('backend.layouts.app') -->



@section('title', app_name() . ' | ' . 'Renovation Calculator')




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
				<h2>Edit Frontend Text</h2> 
				<form action="{{ route('admin.frontendmanagement.edittext', 1) }}" method="post">
				{{csrf_field()}}
				  
				  <input type="hidden" name="id" value="{{ $text[0]->id }}">
				  @foreach($languages as $lang)
				  @if($lang->name == 'English')
				  <div class="form-group">
					<label for="exampleInputPassword1">Text in {{$lang->name}}</label>
					<input type="text" class="form-control"  name="lang_text[{{$lang->id}}][]" value="{{ $text[0]->parentname->message }}">
				  </div>
				  @continue
				  @endif
				  <div class="form-group">
					<label for="exampleInputPassword1">Text in {{$lang->name}}</label>
					<input type="text" class="form-control"  name="lang_text[{{$lang->id}}][]" value="{{ $text[0]->message }}">
				  </div>
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