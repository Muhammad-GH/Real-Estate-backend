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
				<h2>Add Language</h2>
				<form action="{{route('admin.frontendmanagement.addlanguage')}}" enctype="multipart/form-data" method="post">
				{{csrf_field()}}
				  <div class="form-group">
					<label for="exampleInputEmail1">Name</label>
					<input type="text" class="form-control" name="name"  placeholder="Name">
				  </div>
				  <div class="form-group">
					<label for="exampleInputPassword1">Logo</label>
					<input type="file" class="form-control"  name="logo">
				  </div>
				  <div class="form-group">
					<label for="exampleInputFile">Logo2</label>
					<input type="file" class="form-control" name="logo2">
				  </div> 
				  
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