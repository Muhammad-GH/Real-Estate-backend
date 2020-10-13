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
<div class="container-fluid messenger">
    <div class="d-flex justify-content-between flex-column flex-md-row">
    <div>
        <h3 class="head3" id="chat_group_name">@php  echo $group_name; @endphp</h3>
        <!-- <p>Contract name title or status</p> -->
    </div>
    <div class="search-box-right">
        <div class="custom-search">
            <div class="form-group">
              <i class="icon-search"></i>
              {{ html()->form( 'POST', route('frontend.pms.project.update_task'))->id('send-message1')->class('send-message')->open() }}
                    {{ html()->hidden('group_id')->value($group_id)->class('form-control')->placeholder(__('pms.project.labels.description')) }}
                    {{ html()->text('search')->class('form-control')->attribute('maxlength', 500)->placeholder(__('pms.project.labels.labels')) }} 
 
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
            @php 
                if(isset($group_arr)){
                  foreach($group_arr as $key=>$message){ 
                    foreach($message as $mkey=> $gchat){
                    
                      if(trim($gchat['username']) != ''){
                        if($gchat['class'] != 'user'){
                        echo "<li class='nav-item ' id='".$mkey."'>";
                            echo "<span class='nav-link recipient active' >";
                              echo "<span> <i class='icon-img'>".$gchat['logo']."</i></span>";
                              echo "<span class='chat-right'>
                                      <h4>".$gchat['username']."   </h4> 
                                      <span class='chat-typing '>
                                      ".$gchat['text']."
                                      </span>
                                      <br> <small class='text-black-50'>".date("D M d Y H:i",strtotime($gchat['time']))."</small>";
                                      if(isset($gchat['message_image_ext']) && $gchat['message_image_ext'] !=''){
                                        if($gchat['message_image_ext'] == 'jpg' || $gchat['message_image_ext'] == 'jpeg' || $gchat['message_image_ext'] == 'png'){
                                          echo "<p>".$gchat['message_image']."</p> ";
                                        }else{
                                            echo "<div aria-live='polite' class='mt-3 position-relative' aria-atomic='true' style='min-height: 150px;'>
                                                <div class='toast custom-toast  text-center position-absolute' style=' top: 0; left: 0; opacity: 1;'>
                                                  <div class='toast-header pt-3 pb-3'>
                                                  
                                                    <strong class='mr-5'>".$gchat['file_name']."</strong>
                                                    <!-- <small>2 MB</small> -->
                                                  
                                                  </div>
                                                  <div class='toast-body text-center pb-0'>
                                                    File download
                                                    <hr>
                                                  </div>
                                                  <a href ='/images/chat/".$gchat['file_name']."' target='_blank' class='btn btn-link pt-0'>Download</a>                   
                                                  <!-- <button type='button' class='btn btn-link pt-0' data-dismiss='toast' aria-label='Close'>
                                                  Download
                                                  </button> -->
                                                </div>
                                            </div>";
                                        }
                                      }
                                    echo "</span>
                                  </span>
                              </li>";
                        }else{
                           


                          echo "<li class='nav-item ".$gchat['class']."' id='".$mkey."'>";
                  
                              echo " <span class='chat-typing '>
                                      ".$gchat['text']."
                                      </span>
                                     <br> <small class='text-black-50'>".date("M d Y H:i",strtotime($gchat['time']))."</small>";
                                     if(isset($gchat['message_image_ext']) && $gchat['message_image_ext'] !=''){
                                        if($gchat['message_image_ext'] == 'jpg' || $gchat['message_image_ext'] == 'jpeg' || $gchat['message_image_ext'] == 'png'){
                                          echo "<p>".$gchat['message_image']."</p> ";
                                        }else{
                                          echo "<div aria-live='polite' class='mt-3 position-relative' aria-atomic='true' style='min-height: 150px;'>
                                            <div class='toast custom-toast  text-center position-absolute' style=' top: 0; right: 0; opacity: 1;'>
                                              <div class='toast-header pt-3 pb-3'>
                                               
                                              <strong class='mr-5'>".$gchat['file_name']."</strong>
                                                <!-- <small>2 MB</small> -->
                                               
                                              </div>
                                              <div class='toast-body text-center pb-0'>
                                                File download
                                                <hr>
                                              </div>   
                                              <a href ='/images/chat/".$gchat['file_name']."' target='_blank' class='btn btn-link pt-0'>Download</a>        
                                              <!-- <button  type='button' class='btn btn-link pt-0' data-dismiss='toast' aria-label='Close'>
                                               Download
                                              </button> -->
                                            </div>
                                        </div>";
                                        }
                                      }
                                      echo " </li>";  
                        }
                        
                       
                        }
                    }
                  }

                }
                @endphp

                 
                <!-- <li class="nav-item user">
                    <span class="chat-typing  ">
                        What is the process how we going to make it complete in time???
                    </span>
                </li> -->
           
            </ul>
        </div>
    </div>

    <div id="save_form"> 
 
          
        {{ html()->form( 'POST', route('frontend.pms.chat.save_message'))->id('send-message')->class('send-message d-flex send-message-bar')->open() }}
        {{ html()->hidden('group_id')->id('message_group_id')->value($group_id)->class('form-control')->placeholder(__('pms.project.labels.description')) }}
        {{ html()->hidden('project_id')->id('project_id')->value($project)->class('form-control')->placeholder(__('pms.project.labels.description')) }}
        {{ html()->hidden('user_id')->id('user_id')->value($userid)->class('form-control')->placeholder(__('pms.project.labels.description')) }}
        {{ html()->hidden('user_type')->id('user_type')->value($usertype)->class('form-control')->placeholder(__('pms.project.labels.description')) }}

                          
        <div class="flex-grow-1 mr-3">
        {{ html()->textarea('message_text')->class('form-control')->attribute('maxlength', 500)->placeholder(__('pms.project.labels.labels')) }} 
        </div>
        <div class="align-self-center mr-3">
        
          {{ html()->text('attachment')->attribute('type','file')->class('attachment custom-attach-input') }}
      
      </div>
      <div>
      <a href="javascript:void(0);" class="sendMessage btn btn-blue">SEND</a>
      </div>
      {{ html()->form()->close() }}     
      </div>

  </div>

      
                     
    @endif
@endsection