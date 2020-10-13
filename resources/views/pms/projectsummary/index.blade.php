@extends('pms.layout.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
@push('after-styles')
     
    
    <style>
         /* The actual timeline (the vertical ruler) */
.timelines {
  position: relative;
  max-width: 1200px;
  margin: 0 auto;
  background:#eeeeff;
}

/* The actual timeline (the vertical ruler) */
.timelines::after {
  content: '';
  position: absolute;
  width: 6px;
  background-color: white;
  top: 0;
  bottom: 0;
  left: 50%;
  margin-left: -3px;
}

/* Container around content */
.containers {
  padding: 10px 40px;
  position: relative;
  background-color: inherit;
  width: 50%;
}

/* The circles on the timeline */
.containers::after {
  content: '';
  position: absolute;
  width: 25px;
  height: 25px;
  right: -17px;
  background-color: white;
  border: 4px solid #FF9F55;
  top: 15px;
  border-radius: 50%;
  z-index: 1;
}

.progress-bar {
    border: 1px solid #ccc !important;
}
.status_todo {
    /* background:  #d7d7df !important;
    border:1px solid  #aeaeba !important; */
    background: #d6f8ff !important;
    border:1px solid  #61cfed !important;
}
.progress_todo{
    /* background:  #aeaeba !important; */
    background:  #61cfed !important;
}

.status_inprogress {
    /* background:  #eabdfc  !important;
    border:1px solid  #ce80ee  !important; */
    background: #ffbe7d !important;
    border:1px solid #fa933e !important;
}
.progress_inprogress{
    /* background:  #ce80ee  !important; */
    background:  #fa933e  !important;
}
.status_overdue {
    background: #ffc8bf !important;
    border:1px solid #f66157 !important;
}
.progress_overdue{
    background: #f66157 !important;
}
.status_done {
    background:  #d3ea98   !important;
    border:1px solid  #acd351   !important;
}
.progress_done{
    background:  #acd351   !important;
}
 


/* Place the container to the left */
.left {
  left: 0;
}

/* Place the container to the right */
.right {
  left: 50%;
}

/* Add arrows to the left container (pointing right) */
.left::before {
  content: " ";
  height: 0;
  position: absolute;
  top: 22px;
  width: 0;
  z-index: 1;
  right: 30px;
  border: medium solid white;
  border-width: 10px 0 10px 10px;
  border-color: transparent transparent transparent white;
}

/* Add arrows to the right container (pointing left) */
.right::before {
  content: " ";
  height: 0;
  position: absolute;
  top: 22px;
  width: 0;
  z-index: 1;
  left: 30px;
  border: medium solid white;
  border-width: 10px 10px 10px 0;
  border-color: transparent white transparent transparent;
}

/* Fix the circle for containers on the right side */
.right::after {
  left: -16px;
}

/* The actual content */
.content {
  padding: 20px 30px;
  background-color: white;
  position: relative;
  border-radius: 6px;
}

/* Media queries - Responsive timeline on screens less than 600px wide */
@media screen and (max-width: 600px) {
  /* Place the timelime to the left */
  .timelines::after {
  left: 31px;
  }
  
  /* Full-width containers */
  .containers {
  width: 100%;
  padding-left: 70px;
  padding-right: 25px;
  }
  
  /* Make sure that all arrows are pointing leftwards */
  .containers::before {
  left: 60px;
  border: medium solid white;
  border-width: 10px 10px 10px 0;
  border-color: transparent white transparent transparent;
  }

  /* Make sure all circles are at the same spot */
  .left::after, .right::after {
  left: 15px;
  }
  
  /* Make all right containers behave like the left ones */
  .right {
  left: 0%;
  }
}
    </style>

    
@endpush

    @if( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->view_project) )
    @php 
     //echo '<pre>';  print_r($taskarray);die;
  //echo '<pre>';print_r($projectsummary[0]->taskresource);die;
  $proposal_attachment = array();
  $agreement_attachment = array();
    if($projectsummary){
                    foreach($projectsummary as $key=>$project){
                      
                        $project_name = $project->name;
                        $project_start_date =  date('d-m-Y', strtotime($project->start_date));
                        $project_end_date =  date('d-m-Y', strtotime($project->end_date));
                        
                        $datetime1 = new DateTime($project_start_date);
                        $datetime2 = new DateTime($project_end_date);
                        $interval = $datetime1->diff($datetime2);
                        $days = $interval->format('%a');//now do whatever you like with $days
                        
                        $proposal_attachment['pdf'] = $projectsummary[0]->proposal['proposal_pdf'];
                        $proposal_attachment['attachment'] = $projectsummary[0]->proposal['proposal_attachment'];
                        
                        $agreement_attachment['pdf'] = $projectsummary[0]->agreement['agreement_pdf'];
                        $agreement_attachment['attachment'] = $projectsummary[0]->agreement['agreement_attachment'];
                           
                             
                    }
                }
                $task_array = $taskarray;
               
    // echo '<pre>';  print_r($task_array);die;

  
                @endphp
          
         
                        
                
            <div class="container-fluid">
                <div class="d-md-flex justify-content-between" style="max-width:1120px">
                    <h3 class="head3">Project summary</h3>
                    <div class="mt-md-n3 mt-sm-4 mb-sm-4 mb-md-0">
                        <button class="btn btn-sm btn-primary mb-3 mb-sm-0"><i class="icon-download" style="margin-right: 7px; transform: scale(1.4); display: inline-block;"></i> Download</button>
                    </div>
                </div>
                <div class="card" style="max-width:1120px">
                    <div class="card-body">
                        <div class="summary">
                            <ul class="nav nav-tabs" id="summary" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="timeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="timeline" aria-selected="true">Timeline</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="proposal-tab" data-toggle="tab" href="#proposal" role="tab" aria-controls="proposal" aria-selected="false">Proposal</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="agreement-tab" data-toggle="tab" href="#agreement" role="tab" aria-controls="agreement" aria-selected="false">Agreement</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="project-tab" data-toggle="tab" href="#project" role="tab" aria-controls="project" aria-selected="false">Project</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="false">Invoice</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="message1-tab" data-toggle="tab" href="#message1" role="tab" aria-controls="message1" aria-selected="false">Message</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="summaryContent">
                                <div class="tab-pane fade show active" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                                    <div class="p-4 p-sm-5 mb-5">
                                        <h4 class="head4 mb-2">@php echo $project_name;  @endphp</h4>
                                        <span class="date"><b>Start</b>: @php echo date("d-M-Y",strtotime($project_start_date));  @endphp</span>
                                        <span class="date"><b>End</b>: @php echo date("d-M-Y",strtotime($project_end_date));  @endphp </span>
                                    </div>
                                    <div class="timeline">
                                        <div class="row no-gutters">
                                            <!-- <div class="col-md flex-grow-0">
                                                <div class="item">
                                                    <span class="date">23 Apr</span>
                                                </div>
                                            </div> -->
                                            <div class="col">
                                                <div class="item gray1">
                                                <ul class="info">
                                                    @php 
                                                    if(isset($proposalrevision)){
                                                        foreach($proposalrevision as $key=>$proposal_val){
                                                            if($proposal_val['status'] == 2){
                                                                $status = 'accepted';  	
                                                            }
                                                            if($proposal_val['status'] == 3){
                                                                $status = 'declined'; 	
                                                            }
                                                            if($proposal_val['status'] == 4){
                                                                $status = 'revised'; 	
                                                            }
                                                             $client_name = $proposal_val->user['first_name'].' '.$proposal_val->user['last_name'];
                                                            echo "<li>
                                                                    <span class='time flex-grow-0'>". date("d-M H:i",strtotime($proposal_val['created_at'])). "</span>
                                                                    <div>
                                                                        <p>Proposal ". $status. " and send to <a href='#profile_page'>". $client_name ."</a></p>
                                                                        <p><b>Message:</b>". $proposal_val['message']. "</p>
                                                                    </div>
                                                                </li>";
                                                        }
                                                    }  
                                                    @endphp
                                                         
                                                    </ul>
                                                    <br><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-3">
                                                <div class="item gray2">
                                                    <div class="attachment">
                                                        <div class="row">
                                                        @php 
                                                        if(isset($proposal_attachment)){
                                                            foreach($proposal_attachment as $key=>$val){
                                                                if($key == 'pdf'){
                                                                    $link = '/images/marketplace/proposal/pdf/'.$val;
                                                                }
                                                                if($key == 'attachment'){
                                                                    $link = '/images/marketplace/proposal/'.$val;
                                                                }
                                                                echo "<div class='col-lg-6'>
                                                                <div class='file'>
                                                                    <i class='icon-pdf'></i>
                                                                    <span>.pdf</span>
                                                                </div>
                                                                <p><a href='".$link."' target='_blank'>". $val."</a></p>
                                                            </div>";
                                                            }
                                                        }
                                                        @endphp
                                                             
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row no-gutters">
                                            <!-- <div class="col-md flex-grow-0">
                                                <div class="item">
                                                    <span class="date">23 Apr</span>
                                                </div>
                                            </div> -->
                                            <div class="col">
                                                <div class="item gray1">
                                                <ul class="info">
                                                    @php 
                                                    if(isset($agreementrevision)){
                                                        foreach($agreementrevision as $key=>$agreement_val){
                                                            if($agreement_val['status'] == 2){
                                                                $status = 'accepted';  	
                                                            }
                                                            if($agreement_val['status'] == 3){
                                                                $status = 'declined'; 	
                                                            }
                                                            if($agreement_val['status'] == 4){
                                                                $status = 'revised'; 	
                                                            }
                                                             $client_name = $agreement_val->user['first_name'].' '.$agreement_val->user['last_name'];
                                                            echo "<li>
                                                                    <span class='time flex-grow-0'>". date("d-M H:i",strtotime($agreement_val['created_at'])). "</span>
                                                                    <div>
                                                                        <p>Agreement ". $status. " and send to <a href='#profile_page'>". $client_name ."</a></p>
                                                                        <p><b>Message:</b>". $agreement_val['message']. "</p>
                                                                    </div>
                                                                </li>";
                                                        }
                                                    }  
                                                    @endphp
                                                         
                                                    </ul>
                                                    <br><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-3">
                                                <div class="item gray2">
                                                    <div class="attachment">
                                                        <div class="row">
                                                        @php 
                                                        if(isset($agreement_attachment)){
                                                            foreach($agreement_attachment as $key=>$val){
                                                                
                                                                if($key == 'pdf'){
                                                                    $link = '/images/marketplace/agreement/pdf/'.$val;
                                                                }
                                                                if($key == 'attachment'){
                                                                    $link = '/images/marketplace/agreement/'.$val;
                                                                }
                                                                $ext = pathinfo($link,PATHINFO_EXTENSION);
                                                               
                                                                echo "<div class='col-lg-6'>";
                                                                if($ext =='jpeg' || $ext =='jpg' || $ext =='png'){
                                                                    echo "<div class='img'>
                                                                        <img src='". $link ."'>
                                                                    </div>";
                                                                }else{
                                                                echo "<div class='file'>
                                                                    <i class='icon-pdf'></i>
                                                                    <span>.pdf </span>
                                                                </div>";
                                                                }
                                                                echo "<p><a href='".$link."' target='_blank'>Agreement Attchment</a></p>
                                                            </div>";
                                                            }
                                                        }
                                                        @endphp
                                                             
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         
                                         
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="proposal" role="tabpanel" aria-labelledby="proposal-tab">
                                    <div class="p-5 mb-5">
                                        <h4 class="head4 mb-2">Project detail</h4>
                                        <h4 class="head4 mb-2">@php echo $project_name;  @endphp</h4>
                                        <span class="date"><b>Start</b>: @php echo date("d-M-Y",strtotime($project_start_date));  @endphp</span>
                                        <span class="date"><b>End</b>: @php echo date("d-M-Y",strtotime($project_end_date));  @endphp </span>
                                    </div>
                                    <div class="timeline">
                                        <div class="row no-gutters">
                                            <!-- <div class="col-md flex-grow-0">
                                                <div class="item">
                                                    <span class="date">23 Apr</span>
                                                </div>
                                            </div> -->
                                            <div class="col">
                                                <div class="item gray1">
                                                <ul class="info">
                                                    @php 
                                                    if(isset($proposalrevision)){
                                                        foreach($proposalrevision as $key=>$proposal_val){
                                                            if($proposal_val['status'] == 2){
                                                                $status = 'accepted';  	
                                                            }
                                                            if($proposal_val['status'] == 3){
                                                                $status = 'declined'; 	
                                                            }
                                                            if($proposal_val['status'] == 4){
                                                                $status = 'revised'; 	
                                                            }
                                                             $client_name = $proposal_val->user['first_name'].' '.$proposal_val->user['last_name'];
                                                            echo "<li>
                                                                    <span class='time flex-grow-0'>". date("d-M H:i",strtotime($proposal_val['created_at'])). "</span>
                                                                    <div>
                                                                        <p>Proposal ". $status. " and send to <a href='#profile_page'>". $client_name ."</a></p>
                                                                        <p><b>Message:</b>". $proposal_val['message']. "</p>
                                                                    </div>
                                                                </li>";
                                                        }
                                                    }  
                                                    @endphp
                                                         
                                                    </ul>
                                                    <br><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-3">
                                                <div class="item gray2">
                                                    <div class="attachment">
                                                        <div class="row">
                                                        @php 
                                                        if(isset($proposal_attachment)){
                                                            foreach($proposal_attachment as $key=>$val){
                                                                
                                                                if($key == 'pdf'){
                                                                    $link = '/images/marketplace/proposal/pdf/'.$val;
                                                                }
                                                                if($key == 'attachment'){
                                                                    $link = '/images/marketplace/proposal/'.$val;
                                                                }
                                                                $ext = pathinfo($link,PATHINFO_EXTENSION);
                                                               
                                                                echo "<div class='col-lg-6'>";
                                                                if($ext =='jpeg' || $ext =='jpg' || $ext =='png'){
                                                                    echo "<div class='img'>
                                                                        <img src='". $link ."'>
                                                                    </div>";
                                                                }else{
                                                                echo "<div class='file'>
                                                                    <i class='icon-pdf'></i>
                                                                    <span>.pdf </span>
                                                                </div>";
                                                                }
                                                                echo "<p><a href='".$link."' target='_blank'>Proposal Attchment</a></p>
                                                            </div>";
                                                            }
                                                        }
                                                        @endphp
                                                             
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="agreement" role="tabpanel" aria-labelledby="agreement-tab">
                                    <div class="p-5 mb-5">
                                        <h4 class="head4 mb-2">Project detail</h4>
                                        <h4 class="head4 mb-2">@php echo $project_name;  @endphp</h4>
                                        <span class="date"><b>Start</b>: @php echo date("d-M-Y",strtotime($project_start_date));  @endphp</span>
                                        <span class="date"><b>End</b>: @php echo date("d-M-Y",strtotime($project_end_date));  @endphp </span>
                                    </div>
                                    <div class="timeline">
                                        <div class="row no-gutters">
                                            <!-- <div class="col-md flex-grow-0">
                                                <div class="item">
                                                    <span class="date">23 Apr</span>
                                                </div>
                                            </div> -->
                                            <div class="col">
                                                <div class="item gray1">
                                                <ul class="info">
                                                    @php 
                                                    if(isset($agreementrevision)){
                                                        foreach($agreementrevision as $key=>$agreement_val){
                                                            if($agreement_val['status'] == 2){
                                                                $status = 'accepted';  	
                                                            }
                                                            if($agreement_val['status'] == 3){
                                                                $status = 'declined'; 	
                                                            }
                                                            if($agreement_val['status'] == 4){
                                                                $status = 'revised'; 	
                                                            }
                                                             $client_name = $agreement_val->user['first_name'].' '.$agreement_val->user['last_name'];
                                                            echo "<li>
                                                                    <span class='time flex-grow-0'>". date("d-M H:i",strtotime($agreement_val['created_at'])). "</span>
                                                                    <div>
                                                                        <p>Agreement ". $status. " and send to <a href='#profile_page'>". $client_name ."</a></p>
                                                                        <p><b>Message:</b>". $agreement_val['message']. "</p>
                                                                    </div>
                                                                </li>";
                                                        }
                                                    }  
                                                    @endphp
                                                         
                                                    </ul>
                                                    <br><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-3">
                                                <div class="item gray2">
                                                    <div class="attachment">
                                                        <div class="row">
                                                        @php 
                                                        if(isset($agreement_attachment)){
                                                            foreach($agreement_attachment as $key=>$val){
                                                                
                                                                if($key == 'pdf'){
                                                                    $link = '/images/marketplace/agreement/pdf/'.$val;
                                                                }
                                                                if($key == 'attachment'){
                                                                    $link = '/images/marketplace/agreement/'.$val;
                                                                }
                                                                $ext = pathinfo($link,PATHINFO_EXTENSION);
                                                               
                                                                echo "<div class='col-lg-6'>";
                                                                if($ext =='jpeg' || $ext =='jpg' || $ext =='png'){
                                                                    echo "<div class='img'>
                                                                        <img src='". $link ."'>
                                                                    </div>";
                                                                }else{
                                                                echo "<div class='file'>
                                                                    <i class='icon-pdf'></i>
                                                                    <span>.pdf </span>
                                                                </div>";
                                                                }
                                                                echo "<p><a href='".$link."' target='_blank'>Agreement Attchment</a></p>
                                                            </div>";
                                                            }
                                                        }
                                                        @endphp
                                                             
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                                <div class="tab-pane fade" id="project" role="tabpanel" aria-labelledby="project-tab">
                                    <div class="p-5 mb-5">
                                        <h4 class="head4 mb-2">Project detail</h4>
                                        <h4 class="head4 mb-2">@php echo $project_name;  @endphp</h4>
                                        <span class="date"><b>Start</b>: @php echo date("d-M-Y",strtotime($project_start_date));  @endphp</span>
                                        <span class="date"><b>End</b>: @php echo date("d-M-Y",strtotime($project_end_date));  @endphp </span>
                                    </div>
                                    <div class="timeline">
                                        <div class="row1 no-gutters">





                                        <div class="timelines">
                                            @php 
                                                if(isset($task_array)){
                                                    $count = 0;
                                                    foreach($task_array as $key=>$task_val){
                                                        $count++;
                                                        if($count%2 == 1){
                                                            $direction = 'left';
                                                        }else{
                                                            $direction = 'right';
                                                        }
                                                        
                                                        $status = strtolower($task_val['status']);
                                                        $progress = round($task_val['progress']*100);
                                                        echo "<div class='containers ". $direction ." '>
                                                                    <div class='content status_$status'>
                                                                        <h2>". date("d-M H:i",$task_val['start_date']). "</h2>
                                                                        <p> ". $task_val['task_name']. "</p>
                                                                        <p> Assign to: ". $task_val['assignee_to']. "</p>
                                                                        <p> Start Date: ". date("d-M-Y",$task_val['start_date']). "</p>
                                                                        <p> End Date: ". date("d-M-Y",$task_val['end_date']). "</p>
                                                                        <p> Deadline: ".  date("d-M-Y",$task_val['deadline']). "</p>
                                                                        <p> Checkpoint: ".   $task_val['checkpoint']. "</p>
                                                                        <p> Hours: ".   $task_val['duration']. "</p>
                                                                        <p> Status: ". $task_val['status']. "</p>
                                                                     

                                                                        ";
                                                                       
                                                                        echo "<br>";
                                                                        echo "<p>Time  A->Audits I->Image R->Reports S->Signature</p>";
                                                                        echo "<table class='table table-bordered table-sm taskListTable' >";
                                                                        echo "<tr><th>Date</th><th>Description</th>";
                                                                        echo "<th>Hours</th>";
                                                                        echo "<th>File</th>";
                                                                        echo "</tr>"; 
                                                                        if(isset($task_val['time']) && is_array($task_val['time'])){
                                                                            $total_hours = 0;
                                                                            foreach($task_val['time'] as $time_val){
                                                                                $total_hours += $time_val['hours'];
                                                                                echo "<tr>"; 
                                                                                echo "<td> ".date("d-M-Y",$time_val['date'])."</td>";
                                                                                echo "<td> ".$time_val['description']."</td>";
                                                                                echo "<td> ".$time_val['hours']."</td>";
                                                                                echo "<td> ";
                                                                                if(isset($time_val['audits']) && $time_val['audits']!=''){
                                                                                    echo "<a href='/project_task/audits/".$time_val['audits']."' alt='Audit' title='Audit' target='_blank'>A</a>";
                                                                                }
                                                                                if(isset($time_val['image']) && $time_val['image']!=''){
                                                                                    echo "&nbsp;<a href='/project_task/image/".$time_val['image']."' alt='Image' title='Image' target='_blank'>I</a>";
                                                                                }
                                                                                if(isset($time_val['report']) && $time_val['report']!=''){
                                                                                    echo " &nbsp;<a href='/project_task/report/".$time_val['report']."' alt='Report' title='Report' target='_blank'>R</a>";
                                                                                }
                                                                                if(isset($time_val['signature']) && $time_val['signature']!=''){
                                                                                    echo " &nbsp;<a href='/project_task/signature/".$time_val['signature']."' alt='Signature' title='Signature' target='_blank'>S</a>";
                                                                                }
                                                                                echo $time_val['file'];
                                                                                echo "</td>";
                                                                                
                                                                               //echo "<td> audits".$time_val['audits']."</td>";
                                                                               // echo "<td> report".$time_val['report']."</td>";
                                                                              //  echo "<td> image".$time_val['image']."</td>";
                                                                               // echo "<td> signature".$time_val['signature']."</td>";
                                                                                echo "</tr>"; 
                                                                            }
                                                                            if($total_hours > 0){
                                                                                if($total_hours > $task_val['duration']){ $status = 'overdue';}
                                                                                echo "<tr><th> </th><th>Total </th>";
                                                                        echo "<th>".$total_hours."</th>";
                                                                        echo "<th> </th>";
                                                                        echo "</tr>"; 
                                                                            }
                                                                        }  
                                                                        echo "</table>";
                                                                        
                                                                        echo "<div class='progress-bar status_$status'>
                                                                            <div id='myBar' class='progress_$status' style='width:".$progress."%;'>
                                                                                    <div class='w3-center' id='demo'>".$progress."%</div>
                                                                            </div>
                                                                        </div>";

                                                                    echo "</div>
                                                                </div> ";
                                                    }
                                                }  
                                            @endphp


                                         
                                          
                                      
                                         
                                            <!-- <div class="containers right">
                                                <div class="content">
                                                <h2>2007</h2>
                                                <p>Lorem ipsum dolor sit amet, quo ei simul congue exerci, ad nec admodum perfecto mnesarchum, vim ea mazim fierent detracto. Ea quis iuvaret expetendis his, te elit voluptua dignissim per, habeo iusto primis ea eam.</p>
                                                </div>
                                            </div> -->
                                        </div>


                                            <!-- <div class="col-md flex-grow-0">
                                                <div class="item">
                                                    <span class="date">23 Apr</span>
                                                </div>
                                            </div> -->
                                             
                                           
                                        </div>
                                     </div>
                                </div>
                                <div class="tab-pane fade" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                                    <div class="p-5 mb-5">
                                        <h4 class="head4 mb-2">Project detail</h4>
                                        <h4 class="head4 mb-2">@php echo $project_name;  @endphp</h4>
                                        <span class="date"><b>Start</b>: @php echo date("d-M-Y",strtotime($project_start_date));  @endphp</span>
                                        <span class="date"><b>End</b>: @php echo date("d-M-Y",strtotime($project_end_date));  @endphp </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="message1" role="tabpanel" aria-labelledby="message1-tab">
                                    <div class="p-5 mb-5">
                                        <h4 class="head4 mb-2">Project detail</h4>
                                        <h4 class="head4 mb-2">@php echo $project_name;  @endphp</h4>
                                        <span class="date"><b>Start</b>: @php echo date("d-M-Y",strtotime($project_start_date));  @endphp</span>
                                        <span class="date"><b>End</b>: @php echo date("d-M-Y",strtotime($project_end_date));  @endphp </span>
                                    </div>
                                    <div class="timeline">
                                        <div class="row1 no-gutters">





                                        <div class="timelines1">
                                        @php 
                    $gantt_parse = '';
                    
                    if($messages){  
                    $group_arr = array();
                    $group_id = '';
                    foreach($messages as $key=>$chats){
                   
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
    <div class="container-fluid messenger" id="group_window">
 
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
                                                echo "<p><a href ='/images/chat/".$gchat['file_name']."' target='_blank'>".$gchat['message_image']."</a></p> ";
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
                                                echo "<p href ='/images/chat/".$gchat['file_name']."' target='_blank'>".$gchat['message_image']."</p> ";
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
 
                    </ul>
                 
        </div>
                                            


                                         
                                          
                                      
                                    
                                        </div>


                                            
                                             
                                           
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           
	
                         
                     
    @endif
@endsection
 
@push('after-scripts')
<script> 
// File#: _1_vertical-timeline
// Usage: codyhouse.co/license
(function() {
  var VTimeline = function(element) {
    this.element = element;
    this.sections = this.element.getElementsByClassName('js-v-timeline__section');
    this.animate = this.element.getAttribute('data-animation') && this.element.getAttribute('data-animation') == 'on' ? true : false;
    this.animationClass = 'v-timeline__section--animate';
    this.animationDelta = '-150px';
    initVTimeline(this);
  };

  function initVTimeline(element) {
    if(!element.animate) return;
    for(var i = 0; i < element.sections.length; i++) {
      var observer = new IntersectionObserver(vTimelineCallback.bind(element, i),
      {rootMargin: "0px 0px "+element.animationDelta+" 0px"});
      observer.observe(element.sections[i]);
    }
  };

  function vTimelineCallback(index, entries, observer) {
    if(entries[0].isIntersecting) {
      Util.addClass(this.sections[index], this.animationClass);
      observer.unobserve(this.sections[index]);
    } 
  };

  //initialize the VTimeline objects
  var timelines = document.querySelectorAll('.js-v-timeline'),
    intersectionObserverSupported = ('IntersectionObserver' in window && 'IntersectionObserverEntry' in window && 'intersectionRatio' in window.IntersectionObserverEntry.prototype),
    reducedMotion = Util.osHasReducedMotion();
  if( timelines.length > 0) {
    for( var i = 0; i < timelines.length; i++) {
      if(intersectionObserverSupported && !reducedMotion) (function(i){new VTimeline(timelines[i]);})(i);
      else timelines[i].removeAttribute('data-animation');
    }
  }
}());
</script>  
@endpush
@push('after-styles')
 
    
    <style>
      .toast {
    background-color: #fff;
}
</style>
 
 @endpush
 