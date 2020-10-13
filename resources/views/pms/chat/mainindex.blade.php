@extends('pms.layout.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')


    @if( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->view_project) )
    @php 
    $gantt_parse = '';
    
    if($chat){ //echo '<pre>';print_r($chat);print_r($project);die;
                    $group_arr = array();
                    $group_id = '';
                    foreach($chat as $key=>$chats){
                      if(isset($project) && $project > 0){
                        if($project == $chats['project_id']){
                              $group_id = $chats['group_id'];
                        }
                          
                      } 
                      $groups[$chats['group_id']] = $chats['group_name']; 
                      $group_name = $chats['group_name']; 
                      $group_arr[$chats['group_id']][$chats['message_id']]['text'] = $chats['message_text'];
                      $group_arr[$chats['group_id']][$chats['message_id']]['type'] = $chats['message_user_type'];
                      $group_arr[$chats['group_id']][$chats['message_id']]['text'] = $chats['message_text'];
                      $group_arr[$chats['group_id']][$chats['message_id']]['time'] = $chats['time'];
                      $group_arr[$chats['group_id']][$chats['message_id']]['message_image'] = $chats['message_image'];
                      
                      
                      $group_arr[$chats['group_id']][$chats['message_id']]['resource_id'] = $chats['resource_id'];

                      if($chats['message_user_type'] == 'Pro User'){
                        $group_arr[$chats['group_id']][$chats['message_id']]['id'] = $chats['pro_user_id'];
                        $group_arr[$chats['group_id']][$chats['message_id']]['username'] = $chats['pro_user_firstname'].' '.$chats['pro_user_lastname'];
                        $group_arr[$chats['group_id']][$chats['message_id']]['logo'] = "<img src='/images/marketplace/company_logo/".$chats['company_logo']."'   alt='Image' title='Image' class='right'>";  
                      }else{
                        $group_arr[$chats['group_id']][$chats['message_id']]['id'] = $chats['resource_id'];
                        $group_arr[$chats['group_id']][$chats['message_id']]['username'] = $chats['resource_first_name'].' '.$chats['resource_last_name'];
                        //$group_arr[$chats['group_id']][$chats['message_id']]['logo'] = $chats['photo'];
                        $group_arr[$chats['group_id']][$chats['message_id']]['logo'] = "<img src='/images/resources/".$chats['resource_id']."/".$chats['photo']."'   alt='Image' title='Image' class='right'>";  
                      }
                      $group_arr[$chats['group_id']][$chats['message_id']]['message_image_ext'] = '';
                      $group_arr[$chats['group_id']][$chats['message_id']]['file_name'] = '';
                      if(isset($chats['message_image']) && $chats['message_image'] != ''){
                        $file = '/images/chat/'.$chats['message_image'];
                        $ext = pathinfo($file, PATHINFO_EXTENSION);
                        $group_arr[$chats['group_id']][$chats['message_id']]['message_image_ext'] = $ext;
                        if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
                          $group_arr[$chats['group_id']][$chats['message_id']]['message_image'] = "<img src='/images/chat/".$chats['message_image']."'   alt='Image' title='Image' class='attachment-image' width='150px;'>";  
                          $group_arr[$chats['group_id']][$chats['message_id']]['file_name'] = $chats['message_image']; 
                        }else{
                          $group_arr[$chats['group_id']][$chats['message_id']]['message_image'] = '/images/chat/'.$chats['message_image'];  
                          $group_arr[$chats['group_id']][$chats['message_id']]['file_name'] = $chats['message_image'];  
                        }
                      }else{
                        $group_arr[$chats['group_id']][$chats['message_id']]['message_image'] = "";  
                      }
                      $group_arr[$chats['group_id']][$chats['message_id']]['class'] = ''; 
                      if($usertype == 'Pro User' && $userid == $chats['pro_user_id']){
                        $group_arr[$chats['group_id']][$chats['message_id']]['class'] = 'user'; 
                      }
                      if($usertype == 'Resource' && $userid == $chats['resource_id']){
                        $group_arr[$chats['group_id']][$chats['message_id']]['class'] = 'user'; 
                      }
                      
                      
                      
                     
                    }
                }
               // echo '<pre>';print_r($group_arr);die;
                @endphp
          
                

<!-- chat box kindly add messanger class on ncontainer fluid as parent class-->
<div class="container-fluid messenger" id="group_window">
    <div class="d-flex justify-content-between flex-column flex-md-row">
    <div>
        <h3 class="head3" id="chat_group_name">@php  echo $group_name; @endphp</h3>
        <!-- <a class=" btn btn-blue" data-toggle="modal" data-target="#group_users">Project Users</a> -->
        <!-- <p>Contract name title or status</p> -->
    </div>
    <div class="search-box-right">
        <div class="custom-search">
            <div class="form-group">
              <i class="icon-search"></i>
              {{ html()->form( 'POST', route('frontend.pms.project.update_task'))->id('send-message1')->class('send-message')->open() }}
                    {{ html()->hidden('group_id')->value($group_id)->class('form-control')->placeholder(__('pms.project.labels.description')) }}
                    {{ html()->text('search')->class('form-control')->attribute('maxlength', 500)->placeholder(__('pms.project.labels.search')) }} 
 
                        {{ html()->form()->close() }}     
                
            </div>
        </div>
        <!-- <div class="align-self-center mr-3">
            <a href="" class="text-decoration-none">
                <i class="icon-attachment"></i>
            </a>
        </div>
        <div class="dropdown mt-2">
            <a class="btn btn-light dropdown-round shadow-lg" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Save current project</a>
                <a class="dropdown-item" href="#">Open saved template</a>
            </div>
        </div> -->
    </div>

    </div>
    <div class="card">
        <div class="card-body ">
         
            <ul class="nav flex-column" id="chat_window"  >
             <li class="nav-item user">
                    <span class="chat-typing  ">
                       Please select the project.
                    </span>
                </li>  
           
            </ul>
        </div>
    </div>

    <div id="save_form" style="display:none;"> 
 
          
        {{ html()->form( 'POST', route('frontend.pms.chat.save_message'))->id('send-message')->class('send-message d-flex send-message-bar')->open() }}
        {{ html()->hidden('group_id')->id('message_group_id')->value($group_id)->class('form-control')->placeholder(__('pms.project.labels.description')) }}
        {{ html()->hidden('project_id')->id('project_id')->value($project)->class('form-control')->placeholder(__('pms.project.labels.description')) }}
        {{ html()->hidden('user_id')->id('user_id')->value($userid)->class('form-control')->placeholder(__('pms.project.labels.description')) }}
        {{ html()->hidden('user_type')->id('user_type')->value($usertype)->class('form-control')->placeholder(__('pms.project.labels.description')) }}

                          
        <div class="flex-grow-1 mr-3">
        {{ html()->textarea('message_text')->class('form-control')->attribute('maxlength', 500)->placeholder(__('pms.project.labels.message')) }} 
        </div>
        <div class="align-self-center mr-3">
        <div class="box">
                             
                            {{ html()->text('attachment')->id('file-1')->attribute('type','file')->class('attachment inputfile inputfile-1') }}
                            <label for="file-1"><span><i class="icon-attachment"></i></span> </span></label>
                            </div>
          
      
      </div>
      <div>
      <a href="javascript:void(0);" class="sendMessage btn btn-blue">SEND</a>
      </div>
      {{ html()->form()->close() }}     
      </div>

  </div>

      
                     
    @endif


    <div class="modal fade" id="group_users" tabindex="-1" role="dialog" aria-labelledby="group_usersModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="group_usersModalLabel">Edit Business Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                            <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="check3">
                                            <label class="form-check-label" for="check3">Abc</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="check3">
                                            <label class="form-check-label" for="check3">Abcd</label>
                                        </div>
                                 
                                 
                              
                                <button type="submit" class="btn btn-outline-secondary mt-3">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
@endsection
@push('after-styles')
 
    
    <style>
      .toast {
    background-color: #fff;
}
.container-chat {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container-chat::after {
  content: "";
  clear: both;
  display: table;
}

.container-chat img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container-chat img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
  width: 40px;
  height: 40px;
}
.container-chat img.attachment-image {
  float: left;
  margin-left: 20px;
  margin-right:0;
  width: 100px;
  height: 100px;
  border-radius: 0;
max-width: 100px;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
    </style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 @endpush
@push('after-scripts')
 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  $( function() {
    function log( id ) {
      $("#chat_window").animate({ scrollTop: $("#"+id).scrollHeight}, 1000);
      
    }
 
    $( "#search" ).autocomplete({
      source: function( request, response ) {
        var group_id = $('#message_group_id').val();
      var project_id = $('#project_id').val();
        $.ajax( {
          type: 'post',
          url: "{{ route('frontend.pms.chat.get_search_message') }}",
        data:"group_id="+group_id+"&project_id="+project_id,
          dataType: "json",
          
          data: {
            _token: CSRF_TOKEN,
            term: request.term,
            project_id: project_id,
            group_id: group_id
          },
          success: function( result ) {
            response( result );
          }
        } );
      },
      minLength: 2,
      select: function( event, ui ) {
        //log(  ui.item.id );
        id = ui.item.value;
        $("#"+id).toggleClass("darker");
        //$("#chat_window").animate({ scrollTop: $("#chat_window")[0].scrollHeight}, 1000);
        
        var elmnt = document.getElementById(id);
        elmnt.scrollIntoView(false);
        // $('#chat_window').animate({
        // scrollTop: $(".darker").offset().top},
        // 1000);
        setTimeout(function(){
            $("#"+id).removeClass('darker');
        },2000);
        return false;
      }
    } );
  } );
  </script>
    <script>
    $(document).on('click', '.sendMessage', function(){
      var data = $(document).find('.send-message').serialize();
 console.log(data);
      var formData = new FormData();
      var addAttachment = $(document).find('.send-message');
      var attachment = addAttachment.find('[name=attachment]')[0].files[0];
      formData.append('attachment',attachment);
      formData.append('data',data);
      
        $.ajax({
            type:'POST',
            url: "{{ route('frontend.pms.chat.save_message') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            contentType: false,
            processData: false,
            success:function(result){
              
              $('#send-message')[0].reset();
              getMessages();
              $("#chat_window").animate({ scrollTop: $("#chat_window")[0].scrollHeight}, 1000);
             
            }
        });
    });

    function getMessages(){
      var group_id = $('#group_id').val();
      var project_id = $('#project_id').val();
    $.ajax({
        type:'GET',
        url: "{{ route('frontend.pms.chat.get_message') }}",
        data:"group_id="+group_id+"&project_id="+project_id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(result){
            $(document).find('#chat_window').html(result);
            
        }
    });
}

$('#chat_window').scroll(function(){  
  //getMessages();
});
$(window).on('load', function() {
  $(".page-content").animate({ scrollTop: $(".page-content")[0].scrollHeight}, 1000);
             
});
	</script>  

<script>
         
		setInterval(function(){
      getMessages();
		}, 3000);
    </script>

<script>
        $(document).ready(function(){
            $(document).on('click','.groupPanel', function(e){
              var url = $(this).attr('href');
              var group_id = $(this).data('group_id');
              $('#message_group_id').val(group_id);
              $('#group_id').val(group_id);

              var project_id = $(this).data('project_id');
              $('#project_id').val(project_id);
              
              var group_name = $(this).data('group_name');
                e.preventDefault();
                var group_id = $('#group_id').val();
                    var project_id = $('#project_id').val();
                    showLoader();
                      $.ajax({
                        type:'GET',
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success:function(result){
                          hideLoader();
                            $('#save_form').show();
                            $(document).find('#chat_window').html(result);
                            $('#chat_group_name').html(group_name);
                            $('.nav-item').removeClass('active');
                            $('.project'+project_id).addClass('active');
                            $(".page-content").animate({ scrollTop: $(".page-content")[0].scrollHeight}, 1000);
                            
                            
                        }
                    });
                
            });
            
        });
    </script>
@endpush


 