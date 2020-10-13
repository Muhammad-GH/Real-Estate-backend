<div class="main-content">
<div class="sidebar">
            <div class="wraper">
                <div class="scroll"></div>
              
                   <!-- recipient bar kindly add messanger class on nav flex-column  fluid as parent class-->
                   <a class="btn  back-button shadow-lg ml-3 mb-4" href="{{ route('frontend.pms.project') }}" ></a>
                   <ul class="nav flex-column messenger">
                   
                   @php 
                   //echo '<pre>';print_r($chat);print_r($allgroups);
                   foreach($allgroups as $key=>$ggroup){
                       
                         
                       $group_id = $ggroup['group_id'];
                       $group_name = $ggroup['group_name'];
                       $project_id = $ggroup['project_id'];
                    if($project_id == $project){
                        $class = 'active project'.$project_id;
                    }else{
                        $class = 'project'.$project_id;
                    }
                        
                    @endphp      
                    <li class='nav-item @php  echo $class @endphp'>
                         <a data-group_name ='{{$group_name}}' data-group_id ='{{$group_id}}' data-project_id ='{{$project_id}}'  class='nav-link recipient busy groupPanel' href="{{ route('frontend.pms.chat.get_active_group_message',['project_id'=> $project_id,'group_id'=> $group_id ]) }}">
                         <span> <i class='icon-img'></i></span>
                           <span >
                           <h4>@php  echo $group_name @endphp </h4>      
                            <!-- <p class='recipient-status'>Contract name title or status</p> -->
                           <!-- <p>it good how is the design  of </p> -->
                        </span>
                        </a>
                    </li>
                            @php 
                   } 
                     
             
                    @endphp 
                    
                     

                     
                </ul>
                <!--recipient bar end-->
            </div>
        </div>