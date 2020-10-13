@extends('pms.layout.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')


    @if( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->view_project) )
    @php 
    $gantt_parse = '';
    
    if($projects){ //echo '<pre>';print_r($projects);die;
                    foreach($projects as $key=>$project){
                        $project_start_date =  date('d-m-Y', strtotime($project->start_date));
                        $project_end_date =  date('d-m-Y', strtotime($project->end_date));
                        
                        $datetime1 = new DateTime($project_start_date);
                        $datetime2 = new DateTime($project_end_date);
                        $interval = $datetime1->diff($datetime2);
                        $days = $interval->format('%a');//now do whatever you like with $days
                         
                        $gantt_parse .=  "{ id: $project->id, text: '$project->name', start_date: '$project_start_date', duration: $days, progress: 0, open: true, type: gantt.config.types.project },";
                            if($type == 'pro_user'){
                                $project_tasks = $project->tasks;
                            }
                            if($type == 'resource'){
                                $project_tasks = $project->taskscreatedbyresource;
                            }
                            if(isset($project_tasks)){
                            $count = 1;
                                foreach($project_tasks as $k=>$task){
                                    $task_start_date =  date('d-m-Y', $task->start_date);
                                    $task_end_date =  date('d-m-Y', $task->end_date);
                                    $task_deadline =  date('d-m-Y', $task->deadline); 
                                    $overdue = 0;
                                    if(!is_null($task->deadline)){
                                        if(strtotime(date('d-m-Y')) > $task->deadline ){
                                            $overdue = 1;
                                        }else{
                                            $overdue = 0;
                                        }
                                    }
                                    $assignee_to =   $task->assignee_to;
                                    if(!isset($assignee_to)){
                                        $assignee_to =   0;
                                    }
                                    $arr =  explode(',',$assignee_to);
                                    $total = count($arr);
                                    $count = 0;
                                    $nArr = '';
                                    foreach($arr as $k=>$v){
                                        $count++;
                                        if($count == $total){
                                            $nArr .= '"'.$v.'"';
                                        }else{
                                            $nArr .= '"'.$v.'",';
                                        }
                                        
                                    }
                                    $assignee_to =   $nArr;
                                    $priority =   $task->priority;
                                    if($priority =='low'){
                                        $priority = 3;
                                        $color = '#d6f8ff !important';
                                    }
                                    if($priority =='medium'){
                                        $priority = 2;
                                    }
                                    if($priority =='high'){
                                        $priority = 1;
                                    }
                                    $status =   $task->status;
                                    if($status =='Todo'){
                                        $status = 1; 
                                    }
                                    if($status =='Inprogress'){
                                        $status = 2;
                                    }
                                    if($status =='Done'){
                                        $status = 3;
                                    }
                                    $datetime1 = new DateTime($task_start_date);
                                    $datetime2 = new DateTime($task_end_date);
                                    $interval = $datetime1->diff($datetime2);
                                    $days = $interval->format('%a');//now do whatever you like with $days
                                    if($task->parent_id > 0){
                                        $parent_id = $task->parent_id;
                                    }else{
                                        $parent_id = $project->id;
                                    }
                                    if($task->progress > 0){
                                        $progress = $task->progress;
                                    }else{
                                        $progress = 0;
                                    }
                                    if($count == count($project->tasks)){
                                        $gantt_parse .= "{ id: $task->id, text: '$task->task_name', start_date: '$task_start_date',deadline: '$task_deadline', duration: $days, progress: $progress, parent: $parent_id, owner_id: [$assignee_to], priority:$priority, type: gantt.config.types.task , status:$status , overdue:$overdue }\n";
                                    }else{
                                        $gantt_parse .= "{ id: $task->id, text: '$task->task_name', start_date: '$task_start_date',deadline: '$task_deadline', duration: $days, progress: $progress, parent: $parent_id, owner_id: [$assignee_to], priority:$priority, type: gantt.config.types.task , status:$status, overdue:$overdue },\n";
                                    }
                                    
                                    $count++;

                                
                                }
                            }
                    }
                }

                if($links){
                    $count = 1;
                    $gantt_parse_link = '';
                    foreach($links as $key=>$link){
                         
                        if($count == count($links)){
                            $gantt_parse_link .=  "{id:$link->id,source:$link->task_source,target:$link->task_target,type:$link->type}";
                        }else{
                            $gantt_parse_link .=  "{id:$link->id,source:$link->task_source,target:$link->task_target,type:$link->type},";
                        }
                        $count++;
                             
                    }
                }
                @endphp
          
         
                        
                    <div id="gantt_here" style='width:100%; height:100%;'></div>
	
                         
                     
    @endif
@endsection
@push('after-styles')
    {{ style('codebase/dhtmlxgantt.css') }}
    
    <style>
    html, body {
			height: 100%;
			padding: 0px;
			margin: 0px;
			overflow: hidden;
		}
        .owner-label{
			width: 20px;
			height: 20px;
			line-height: 20px;
			font-size: 12px;
			display: inline-block;
			border: 1px solid #cccccc;
			border-radius: 25px;
			background: #e6e6e6;
			color: #6f6f6f;
			margin: 0 3px;
			font-weight: bold;
		}

		.gantt_cal_larea{
			overflow:visible;
		}
		.gantt_cal_chosen,
		.gantt_cal_chosen select{
			width: 400px;
		}
        
        .important {
			color: red;
		}
        .gantt_task_progress {
			text-align: left;
			padding-left: 10px;
			box-sizing: border-box;
			color: white;
			font-weight: bold;
		}
        /* hide add from task  */
        .nested_task .gantt_add{
            /*display: none !important;*/
        }
        /* hide add from task  */
        /* Weekend  */
        .gantt_task_cell.week_end {
                    background-color: #EFF5FD;
                }
                .gantt_task_cell.deadline{
                    background: #ff0000 !important;
                     
                    position: absolute;
                   
                     
                    -moz-box-sizing: border-box;
                    box-sizing: border-box;
                    width: 5px !important;
                    height: 29px;
                    margin-left: -11px;
                    
                    z-index: 1; 
    }
                .gantt_task_row.gantt_selected .gantt_task_cell.week_end {
                    background-color: #F8EC9C;
                }

                 
    .weekend{
        background: #EFF5FD !important;
    }

 
        /* Weekend  */     
       /* .gantt_link_point{
            display:none!important;
        }   */
     

		.priority_high .gantt_task_progress_wrapper {
			background: #ffc8bf !important;
            border:1px solid #f66157 !important;
		}
        .priority_high .gantt_task_progress{
            background: #f66157 !important;
        }
 
		.priority_medium .gantt_task_progress_wrapper {
			background: #ffbe7d !important;
            border:1px solid #fa933e !important;
		}
        
        .priority_medium .gantt_task_progress{
            background: #fa933e !important;
        }
		 

		.priority_low .gantt_task_progress_wrapper {
			background: #d6f8ff !important;
            border:1px solid  #61cfed !important;
		}
        .priority_low .gantt_task_progress{
            background: #61cfed !important;
        }

        
        .gantt_task_line{
            border:0px solid #2898b0 !important;
        }
        .gantt_bar_project{
            background:  #d7d7df !important;
        }
        
        .gantt_bar_project .gantt_task_progress{
            background: #aeaeba  !important;
        }

        
		.status_todo .gantt_task_progress_wrapper {
			/* background:  #d7d7df !important;
            border:1px solid  #aeaeba !important; */
            background: #d6f8ff !important;
            border:1px solid  #61cfed !important;
		}
        .status_todo .gantt_task_progress{
            /* background:  #aeaeba !important; */
            background:  #61cfed !important;
        }
        
		.status_inprogress .gantt_task_progress_wrapper {
			/* background:  #eabdfc  !important;
            border:1px solid  #ce80ee  !important; */
            background: #ffbe7d !important;
            border:1px solid #fa933e !important;
		}
        .status_inprogress .gantt_task_progress{
            /* background:  #ce80ee  !important; */
            background:  #fa933e  !important;
        }
        .overdue .gantt_task_progress_wrapper {
			background: #ffc8bf !important;
            border:1px solid #f66157 !important;
		}
        .overdue .gantt_task_progress{
            background: #f66157 !important;
        }
		.status_done .gantt_task_progress_wrapper {
			background:  #d3ea98   !important;
            border:1px solid  #acd351   !important;
		}
        .status_done .gantt_task_progress{
            background:  #acd351   !important;
        }
        
        /* Cosmetic changes */
        .gantt_task_cell{
            border:0px;
        }
        .gantt_row, .gantt_task_row{
            border:1px solid #EFF5FD;
        }
        .gantt_grid_data .gantt_row.gantt_selected, .gantt_grid_data .gantt_row.odd.gantt_selected, .gantt_task_row.gantt_selected{
            background: #EFF5FD !important;
        }
        .gantt_grid_data .gantt_row.odd:hover, .gantt_grid_data .gantt_row:hover{
            background: #EFF5FD !important;
        }
        /* Lightbox changes */
        .gantt_cal_light{
            left:unset!important;
            right:0 !important;
            height:100% !important;
            width:35%;
            top:85px !important;
        }
        /* Lightbox Changes */
        .gantt_task .gantt_task_scale .gantt_scale_cell{
            border:0px;
        }
        .gantt_scale_line{
            border:0px;
        }
        /* Cosmetic changes */
    </style>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css?v=7.0.9">    
@endpush
@push('after-scripts')
{{ script('codebase/dhtmlxgantt.js') }}
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js?v=7.0.9"></script>


    
    
    <script>
    /* Multiselect */
    gantt.form_blocks["multiselect"] = {
		render: function (sns) {
			var height = (sns.height || "23") + "px";
			var html = "<div class='gantt_cal_ltext gantt_cal_chosen gantt_cal_multiselect' style='height:" + height + ";'><select data-placeholder='...' class='chosen-select' multiple>";
			if (sns.options) {
				for (var i = 0; i < sns.options.length; i++) {
					if(sns.unassigned_value !== undefined && sns.options[i].key == sns.unassigned_value){
						continue;
					}
					html += "<option value='" + sns.options[i].key + "'>" + sns.options[i].label + "</option>";
				}
			}
			html += "</select></div>";
			return html;
		},

		set_value: function (node, value, ev, sns) {
			node.style.overflow = "visible";
			node.parentNode.style.overflow = "visible";
			node.style.display = "inline-block";
			var select = $(node.firstChild);

			if (value) {
				value = (value + "").split(",");
				select.val(value);
			}
			else {
				select.val([]);
			}

			select.chosen();
			if(sns.onchange){
				select.change(function(){
					sns.onchange.call(this);
				})
			}
			select.trigger('chosen:updated');
			select.trigger("change");
		},

		get_value: function (node, ev) {
			var value = $(node.firstChild).val();
			return value;
		},

		focus: function (node) {
			$(node.firstChild).focus();
		}
	};
    /* Multiselect */

    /* Code to add Priority */
 
    gantt.config.order_branch = "marker";
	//gantt.config.order_branch_free = true;
	gantt.serverList("staff", [
		@php 
                if($resources){
                    $count = 0;
                    echo "{key: 0, label: 'Not Assigned','open': true},";
                    foreach($resources as $key=>$resource){
                        $count++;
                        $datetime1 = new DateTime($project_start_date);
                        $datetime2 = new DateTime($project_end_date);
                        $interval = $datetime1->diff($datetime2);
                        $days = $interval->format('%a');//now do whatever you like with $days
                        if($count == count($resources)){
                            echo "{key: $resource->id, label: '$resource->first_name $resource->last_name','open': true}";
                        }else{
                            echo "{key: $resource->id, label: '$resource->first_name $resource->last_name','open': true},";
                        }
                        
                           
                            
                    }
                }
                @endphp
                 
	]);

	/*gantt.serverList("priority", [
		{key: 1, label: "High"},
		{key: 2, label: "Medium"},
		{key: 3, label: "Low"}
	]);*/
	gantt.serverList("status", [
		{key: 1, label: "Todo"},
		{key: 2, label: "Inprogress"},
		{key: 3, label: "Done"}
	]);
// end test data
gantt.config.grid_width = 420;
	gantt.config.grid_resize = true;
	gantt.config.open_tree_initially = true;

	var labels = gantt.locale.labels;
	//labels.column_priority = labels.section_priority = "Priority";
	labels.column_owner = labels.section_owner = "Owner";
	labels.column_status = labels.section_status = "Status";
	labels.column_planned_end = labels.section_planned_end = "Deadline";

	function byId(list, id) {
		for (var i = 0; i < list.length; i++) {
			if (list[i].key == id){
                 
				return list[i].label || "";
            }
		}
		return "";
	}

    function findUser(id){
		var list = gantt.serverList("staff");
		for(var i = 0; i < list.length; i++){
			if(list[i].key == id){
				return list[i];
			}
		}
		return null;
	}


	gantt.config.columns = [
        {name: "text", label: "Task name", tree: true, width: '*', template: function (task) {
			if (task.priority == 1)
				return "<div class='important'>" + task.text + "</div>";
			return task.text;
		}},
        {name: "start_date", align: "center", width: 80, resize: true},
		/*{name: "owner", width: 80, align: "center", template: function (item) {
				return byId(gantt.serverList('staff'), item.owner_id)}},*/
        {name: "owner", align: "center", width: 75, label: "Owner", template: function (task) {
			if (task.type == gantt.config.types.project) {
				return "";
			}

			var result = "";
		
			var owners = task.owner_id;

			if (!owners || !owners.length) {
				return "Unassigned";
			}

			if(owners.length == 1){
				return findUser(owners[0]).label;
			}

			owners.forEach(function(ownerId) {
				var owner = findUser(ownerId);
				if (!owner)
					return;
				result += "<div class='owner-label' title='" + owner.label + "'>" + owner.label.substr(0, 1) + "</div>";

			});

			return result;
			}, resize: true
		},        
		
		/*{name: "priority", width: 80, align: "center", template: function (item) {
				return byId(gantt.serverList('priority'), item.priority)}},*/

        /*{name: "status", width: 80, align: "center", template: function (item) {
				return byId(gantt.serverList('status'), item.status)}},     */   

                
		{name: "add", width: 40}
	];

	gantt.config.lightbox.sections = [
		{name: "description", height: 38, map_to: "text", type: "textarea", focus: true},
		/*{name: "priority", height: 22, map_to: "priority", type: "select", options: gantt.serverList("priority")},*/
		{name: "owner", height: 22, map_to: "owner_id",  type:"multiselect", options: gantt.serverList("staff")},
        {name: "status", height: 22, map_to: "status", type: "select", options: gantt.serverList("status")},
		{name: "time", type: "duration", map_to: "auto"},
        {name: "planned_end",    height: 32, type: "duration",      map_to:{end_date:"planned_end"}} 
	];

	gantt.templates.rightside_text = function(start, end, task){
		$owner_id =  byId(gantt.serverList('staff'), task.owner_id);
        if (task.type == gantt.config.types.project) {
				return "";
			}

			var result = "";
		
			var owners = task.owner_id;

			if (!owners || !owners.length) {
				return "Unassigned";
			}

			if(owners.length == 1){
				return findUser(owners[0]).label;
			}

			owners.forEach(function(ownerId) {
				var owner = findUser(ownerId);
				if (!owner)
					return;
				result += " " +owner.label+", ";

			});

			return result;
        return $owner_id;
	};
    /*gantt.templates.leftside_text = function(start, end, task){
		$owner_id =  byId(gantt.serverList('staff'), task.owner_id);
        $status_id = byId(gantt.serverList('status'), task.status);
        return  $status_id;
	};*/

	gantt.templates.grid_row_class =
		gantt.templates.task_row_class =
			gantt.templates.task_class = function (start, end, task) {
		var css = [];
		if (task.$virtual || task.type == gantt.config.types.project)
			css.push("summary-bar");

		if(task.owner_id){
			css.push("gantt_resource_task gantt_resource_" + task.owner_id);
		}

		return css.join(" ");
	};

    
 

/* Code to add Priority */
/* Code to re-order  */
gantt.attachEvent("onAfterTaskMove", function(id, parent, tindex){
   // console.log(tindex);
    $.ajax({
            url:"{{ route('frontend.pms.gantt.update_task') }}?id="+id+"&parent_id="+parent+"&task_order="+tindex,
            success:function(data)
            {    
                gantt.message( " order updated");
            
            }
        })
});
/* Code to re-order  */

/* Code to add Delete on lightbox */
gantt.attachEvent("onBeforeTaskDelete", function(id,item){
        
        $.ajax({
            url:"{{ route('frontend.pms.gantt.delete_task') }}?task_id="+id,
            success:function(data)
            {
                gantt.message( data.message  );
            
            }
        })
        return true;
    });
    gantt.attachEvent("onLightboxDelete", function(id){
    var task = gantt.getTask(id);
    if (task.duration > 60){
        alert("The duration is too long. Please, try again");
        return false;
    }
     
    return true;
})
/* Code to add Delete on lightbox */
/* Code to add Save/update on lightbox */
gantt.attachEvent("onLightboxSave", function(id, task, is_new){
    
    //any custom logic here
     console.log(task);
    var project_id = @php echo $project->id @endphp;
    if(is_new){
        id = 0;
        var convert = gantt.date.date_to_str("%H:%i, %F %j");
        var s = convert(task.start_date);
        var e = convert(task.end_date);
        var task_name = task.text;
        var priority = task.priority;
        var owner_id = task.owner_id;
        var status_id = task.status;
        var task_order = task.$index;
    }else{
        //var task = gantt.getTask(id);
        var convert = gantt.date.date_to_str("%H:%i, %F %j");
        var s = convert(task.start_date);
        var e = convert(task.end_date);
        var task_name = task.text;
        var priority = task.priority;
        var owner_id = task.owner_id;
        var status_id = task.status;
        var task_order = task.$index;
     
    }
    var convert = gantt.date.date_to_str("%H:%i, %F %j");
    var task_deadline =   convert(task.planned_end); 
    var parent_id = task.parent;
    $.ajax({
            url:"{{ route('frontend.pms.gantt.update_task') }}?id="+id+"&task_name="+task_name+"&project_id="+project_id+"&start_date="+s+"&end_date="+e+"&priority="+priority+"&assignee_to="+owner_id+"&parent_id="+parent_id+"&status="+status_id+"&task_order="+task_order+"&deadline="+task_deadline,
            success:function(data_project)
            {    
                if(is_new){
                gantt.changeTaskId(task.id, data_project.id);
                }
                gantt.refreshData();
            
            }
        })
    return true;
})


/* Code to add save/update on lightbox */
/* Code to update task on drag n drop  */
gantt.attachEvent("onAfterTaskDrag", function (id, mode,e) {
    var project_id = gantt.getParent(id);
   
    
    var project = gantt.getTask(project_id);
    var convert = gantt.date.date_to_str("%H:%i, %F %j");
    var project_start = convert(project.start_date);
    var project_end = convert(project.end_date);
         



    var task = gantt.getTask(id);
    
    var task_order = task.$index;
    if (mode == gantt.config.drag_mode.progress) {
        var pr = Math.floor(task.progress * 100 * 10) / 10;
        $.ajax({
            url:"{{ route('frontend.pms.gantt.update_task') }}?id="+id+"&progress="+task.progress+"&type=progress",
            success:function(data)
            {    
                gantt.message(task.text + " progress updated");
                //gantt.changeTaskId(task.id, data_project.id);
            
            }
        })

        gantt.message(task.text + " is now " + pr + "% completed!");
    } else {
        var convert = gantt.date.date_to_str("%H:%i, %F %j");
        var s = convert(task.start_date);
        var e = convert(task.end_date);
        $.ajax({
            url:"{{ route('frontend.pms.gantt.update_task') }}?id="+id+"&start_date="+s+"&end_date="+e+"&project_id="+project_id+"&project_start_date="+project_start+"&project_end_date="+project_end+"&type=task&task_order="+task_order,
            success:function(data_project)
            {
               // console.log(data_project); 
            
            }
        })

        gantt.message(task.text + " starts at " + s + " and ends at " + e);
    }
});
/*gantt.attachEvent("onBeforeTaskChanged", function (id, mode, old_event) {
    var task = gantt.getTask(id);
    if (mode == gantt.config.drag_mode.progress) {
        if (task.progress < old_event.progress) {
            gantt.message(task.text + " progress can't be undone!");
            return false;
        }
    }
    return true;
});*/

/*gantt.attachEvent("onBeforeTaskDrag", function (id, mode) {
    var task = gantt.getTask(id);
    var message = task.text + " ";

    if (mode == gantt.config.drag_mode.progress) {
        message += "progress is being updated";
    } else {
        message += "is being ";
        if (mode == gantt.config.drag_mode.move)
            message += "moved";
        else if (mode == gantt.config.drag_mode.resize)
            message += "resized";
    }

    gantt.message(message);
    return true;
});*/
 /* Code to update task on drag n drop  */
     /* Code to hide plus sign */
     gantt.templates.grid_row_class = function( start, end, task ){
        if ( task.$level > 0 ){
            return "nested_task"
        }
        return "";
    };
    /* Code to hide plus sign */

/* Exclude holidays */
gantt.config.work_time = false;
	gantt.config.min_column_width = 60;
	gantt.config.duration_unit = "day";
	gantt.config.scale_height = 20 * 3;
	gantt.config.row_height = 30;

    @php
    $start_year = date('Y', strtotime($project->start_date));
    $end_year = date('Y', strtotime($project->end_date));
    if(($start_year - $end_year) == 0) $end_year = $end_year +1;
    @endphp
	gantt.config.start_date = new Date(@php echo $start_year;@endphp ,0, 1  );
	gantt.config.end_date = new Date(@php echo $end_year;@endphp , 0, 1 );


	var weekScaleTemplate = function (date) {
		var dateToStr = gantt.date.date_to_str("%d %M");
		var weekNum = gantt.date.date_to_str("(week %W)");
		var endDate = gantt.date.add(gantt.date.add(date, 1, "week"), -1, "day");
		return dateToStr(date) + " - " + dateToStr(endDate) + " " + weekNum(date);
	};


    /* weekend color header daysStyle */
    
   
    var daysStyle = function(date){
    var dateToStr = gantt.date.date_to_str("%D");
    if (dateToStr(date) == "Sun"||dateToStr(date) == "Sat")  return "weekend";
        return "";
    };
    /* weekend color header daysStyle */
	gantt.config.scales = [
		//{unit: "month", step: 1, format: "%F, %Y"},
		{unit: "week", step: 1, format: weekScaleTemplate},
		{unit: "day", step: 1, format: "%D, %d", css:daysStyle }
	];

    /* Deadline  */
	gantt.templates.timeline_cell_class = function (task, date) {
       
        
    var today  = new Date (date);
    var dd = today.getDate();

    var mm = today.getMonth()+1; 
    var yyyy = today.getFullYear();
    if(dd<10) 
    {
        dd='0'+dd;
    } 

    if(mm<10) 
    {
        mm='0'+mm;
    } 
    today = dd+'-'+mm+'-'+yyyy;
     //console.log(today);
     //console.log(task.deadline);
    if(task.deadline == today){
            return "deadline";
        }else{
             /* weekend color */
            if(date.getDay()==0||date.getDay()==6){
                return "weekend"
            }
            /* weekend color  */
            if (!gantt.isWorkTime(date))
                return "week_end";
            return "";
        }
 
        
         /* weekend color */
        if(date.getDay()==0||date.getDay()==6){
            return "weekend"
        }
        /* weekend color  */
		if (!gantt.isWorkTime(date))
			return "week_end";
		return "";
	};
    /* Deadline  */
    /* Exculde Holidays */
   // recalculate progress of summary tasks when the progress of subtasks changes
	(function dynamicProgress() {

function calculateSummaryProgress(task) {
    if (task.type != gantt.config.types.project)
        return task.progress;
    var totalToDo = 0;
    var totalDone = 0;
    gantt.eachTask(function (child) {
        if (child.type != gantt.config.types.project) {
            totalToDo += child.duration;
            totalDone += (child.progress || 0) * child.duration;
        }
    }, task.id);
    if (!totalToDo) return 0;
    else return totalDone / totalToDo;
}

function refreshSummaryProgress(id, submit) {
    if (!gantt.isTaskExists(id))
        return;

    var task = gantt.getTask(id);
    task.progress = calculateSummaryProgress(task);

    if (!submit) {
        gantt.refreshTask(id);
    } else {
        gantt.updateTask(id);
    }

    if (!submit && gantt.getParent(id) !== gantt.config.root_id) {
        refreshSummaryProgress(gantt.getParent(id), submit);
    }
}


gantt.attachEvent("onParse", function () {
    gantt.eachTask(function (task) {
        task.progress = calculateSummaryProgress(task);
    });
});

gantt.attachEvent("onAfterTaskUpdate", function (id) {
    refreshSummaryProgress(gantt.getParent(id), true);
});

gantt.attachEvent("onTaskDrag", function (id) {
    refreshSummaryProgress(gantt.getParent(id), false);
});
gantt.attachEvent("onAfterTaskAdd", function (id) {
    refreshSummaryProgress(gantt.getParent(id), true);
});


(function () {
    var idParentBeforeDeleteTask = 0;
    gantt.attachEvent("onBeforeTaskDelete", function (id) {
        idParentBeforeDeleteTask = gantt.getParent(id);
    });
    gantt.attachEvent("onAfterTaskDelete", function () {
        refreshSummaryProgress(idParentBeforeDeleteTask, true);
    });
})();
})();
</script>
<script>
/* Create task linking */
gantt.config.link_attribute = "data-link-id";
gantt.templates.drag_link = function(from, from_start, to, to_start) {
    var taskObj = gantt.getTask(from);
  //  console.log(from_start);
   // console.log(to_start);
    var source = taskObj.$source;
    var target = taskObj.$target; 
    if(from_start == false && to_start == true){
        var type = 0;
    }
    if(from_start == true && to_start == true){
        var type = 1;
    }
    if(from_start == false && to_start == false){
        var type = 2;
    }
    if(from_start == true && to_start == false){
        var type = 3;
    }
    var project_id = @php echo $project->id @endphp;
    var text = "From:<b> " +taskObj.text + "</b> " +(from_start?"Start":"End")+"<br/>";
    if(to){
        if(to != from){
            totaskObj = gantt.getTask(to);
            
            var target = to.$target; 
            text += "To:<b> " + taskObj.text + "</b> "+ (to_start?"Start":"End")+"<br/>";
            $.ajax({
                url:"{{ route('frontend.pms.gantt.create_link') }}?project_id="+project_id+"&task_source="+from+"&task_target="+to+"&type="+type,
                success:function(data_project)
                {
                // console.log(data_project); 
                
                }
            })
        }

    }
    return text;
};
gantt.attachEvent("onAfterLinkDelete", function(id,item){
    $.ajax({
                url:"{{ route('frontend.pms.gantt.delete_link') }}?id="+id,
                success:function(data_project)
                {
                // console.log(data_project); 
                
                }
            })
});

/* Create task linking */
gantt.templates.progress_text = function (start, end, task) {
		return "<span style='text-align:left;'>" + Math.round(task.progress * 100) + "% </span>";
	};

	gantt.templates.task_class = function (start, end, task) {
		if (task.type == gantt.config.types.project)
			return "hide_project_progress_drag";
	};
    gantt.templates.grid_row_class =
		gantt.templates.task_row_class =
			gantt.templates.task_class = function (start, end, task) {
               
		var css = [];
		if (task.$virtual || task.type == gantt.config.types.project)
			css.push("summary-bar");

		if(task.owner_id){
			css.push("gantt_resource_task gantt_resource_" + task.owner_id);
		}
        if(task.priority == 1){
            css.push("priority_high");
        }
        if(task.priority == 2){
            css.push("priority_medium");
        }
        if(task.priority == 3){
            css.push("priority_low");
        }

        
        if(task.status == 1){
            css.push("status_todo");
        }
        if(task.status == 2){
            css.push("status_inprogress");
        }
        if(task.status == 3){
            css.push("status_done");
        }
        if(task.overdue == 1){
            css.push("overdue");
        }


		return css.join(" ");
	};
    
    gantt.i18n.setLocale("en");
		gantt.init("gantt_here");
       
		gantt.parse({
			data: [
				
                @php 
                echo $gantt_parse;
                @endphp
               // { id: 1, text: "Project #2", start_date: "01-04-2018", duration: 18, progress: 0.4, open: true },
				//{ id: 2, text: "Task #1", start_date: "02-04-2018", duration: 8, progress: 0.6, parent: 1 },
				//{ id: 3, text: "Task #2", start_date: "11-04-2018", duration: 8, progress: 0.6, parent: 1 }
			],
            links:[
                @php 
                echo $gantt_parse_link;
                @endphp
             
            ]
		});
         
        // function refresh_gantt(){
            
        //     var project_id = @php echo $project->id @endphp;
        //     $.ajax({
        //             url:"{{ route('frontend.pms.gantt.get_gantt') }}?project_id="+project_id,
        //             success:function(gantt_parse)
        //             {
        //                 gantt.init("gantt_here");
        //                 gantt.parse({
        //                     data:  gantt_parse
        //                        // { id: 7, text: 'Renovation', start_date: '01-09-2020', duration: 0, progress: 0, open: true, type: gantt.config.types.project },
        //                        // { id: 64, text: 'sdsdsdsd', start_date: '01-09-2020', duration: 1, progress: 0, parent: 7, owner_id: 1, priority:1, type: gantt.config.types.task },
        //                        // { id: 65, text: 'sadasdasdasd', start_date: '01-09-2020', duration: 1, progress: 0, parent: 7, owner_id: 1, priority:1, type: gantt.config.types.task }
                                
        //                 });
        //                 gantt.config.show_unscheduled = false;
                    
        //             }
        //         })
        // }   
	</script>  
@endpush


 