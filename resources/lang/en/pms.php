<?php

return [
    'login'=>[
        'password' => 'Unohtuiko salasana?',
    ],
    'reset'=>[
        'user_not_found' => 'Käyttäjää ei löydy.',
        'set_password_title' => 'NOLLAA SALASANA',
        'password' => 'Salasana',
        'confirm_password' => 'Vahvista salasana',
        'mail' => [
            'dear' => 'Rakas',
            'link_text' => 'Napsauta alla olevaa painiketta palauttaaksesi salasanasi.',
            'confirm_account' => 'Vahvista tilisi',
        ]
    ],
    'mail' => [
        'mail_to' => 'Kirjoita kysely osoitteeseen: :info_mail',
        'follow_us' => 'Seuraa meitä sosiaalisessa mediassa'
    ],
    'validaion'=>[
        'required' => [
            'email' => 'Pakollinen tieto',
            'password' => 'Pakollinen tieto',
            'name' => 'Pakollinen tieto',
            'aggrement' => 'Please select aggrement',
            'permission' => 'You must select at least any one option'
        ],
        'invalid' => [
            'email' => 'Ole hyvä ja syötä toimiva sähköpostiosoite',
            'equalTo'=>'Anna sama arvo uudelleen.',
            'min_length'=>'Anna vähintään :min_len merkkiä.',
            'end_date'=>'End should be greater that Start Date'
        ],
        'failed' => [
            'login' => 'Tiedot eivät vastaa tietojamme.'            
        ]
    ],
    'messages'=>[
        'logout_success'=>'Olet onnistuneesti kirjautunut ulos',
        'reset_mail_sent'=>'Palauta salasanalinkki on lähetetty onnistuneesti !!!',
        'password_changed_success'=>'Salasana vaihdettu onnistuneesti. Ole hyvä ja kirjaudu sisään uudelleen.',
        'invalid_URL'=>'Virheellinen URL',
        'no_record'=>'No Record Found',
        'profile_updated'=>'Profile updated successfully!!',
        'password_updated_error'=>'Old Password did not match!!',
        'password_updated_success'=>'Password updated successfully!!',
        'project_created_success'=>'Password created successfully!!',
        'permission_updated_success'=>'Permission updated successfully!!',
        'project_deleted_success' => 'Project Deleted Successfully!!',
        'project_plan_success' => 'Project plan successfully added !!',
        'project_plan_release_success' => 'Project plan release date updated  successfully !!',
        'project_task_template_success' => 'Project planning template successfully added !!',
        'unauthorized_access' => 'Unauthorized Access.',
    ],
    'dashboard'=>[
        'title'=>'My Business'
    ],
    'my_account'=>[
        'title' => 'My Account',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email',
        'image' => 'Image',
        'submit' => 'Submit'
    ],
    'change_password'=>[
        'title'=>'Change Password',
        'old_password' => 'Old Password',
        'password' => 'Password',
        'password_confirmation' => 'Confirm Password'
    ],
    'project'=>[
        'title'=>'Project',
        'create_project' => 'Create Project',
        'create_from_aggrement' => 'Create from aggrement',
        'create_from_scratch' => 'Create from scratch',
        'project_details' => 'Project Details',
        'project_name' => 'Project Name',
        'keyname' => 'Keyname',
        'lead' => 'Lead',
        'name'=> 'Name',
        'key_name'=> 'Key Name',
        'search' => 'Search',
        'create' => 'Create',
        'select_area' => 'Select Area',
        'create_newtask' => '+ create new task',
        'no_record' => 'No Record Added',
        'add_time' => 'Add Time',
        'view' => 'View',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'text' => [
            'edit_project' => 'Edit Project',
            'add_tasks' => 'Add Tasks',
            'project_task' => 'Project Task',
            'task_list' => 'Task List',
            'please_select' => 'Please select',
            'add_work_phase' => 'Add work phase',
            'add' => 'Add',
            'new_tasks' => 'New tasks',
            'backlog' => 'Backlog',
            'add_task' => 'Add Task',
            'task_details' => 'Task details',
            'time_added' => 'Time Added',
            'no_time_added' => 'No Time Recorded Yet !!!',
            'add_update_proposal' => 'Add/Update to proposal',
            'save_template' => 'Save Template',
            'template_name' => 'Template Name',
            'select_template' => 'Select Template',
            'project_planning' => 'Project planning',
            'delete_template' => 'Delete Template',
            'release_project' => 'Release Project',
            'notify_parties' => 'Notify parties',
            'customer' => 'Customer',
            'my_resources' => 'My Resources',
            'sub_contractors' => 'Sub Contractors',
            'release_text' => 'When you will release projects then above selected parties will be notified and assigned to this project so they can see and activites in project.',
        ],
        'swal' => [
            'delete_title' => 'Are you sure?',
            'delete_text' => 'After Deleting. You won\'t be able to revert this!',
            'cancel_button_text' => 'Cancel',
            'confirm_button_text' => 'Yes, delete it!',
            'save_template' => 'Plan Template',
            'template_save_first' => 'Project Template will be saved first!!!'
        ],
        'labels' => [
            'task' => 'Task',
            'task_name' => 'Task Name',
            'sub_task' => 'Sub Task',
            'description' => 'Description',
            'assignee' => 'Assignee',
            'reporter' => 'Reporter',
            'labels' => 'Labels',
            'status' => 'Status',
            'priority' => 'Priority',
            'deadline' => 'Deadline',
            'checkpoint' => 'Checkpoint',
            'start_date' => 'Start date',
            'end_date' => 'End Date',
            'duration' => 'Duration',
            'cancel' => 'Cancel',
            'submit' => 'Submit',
            'save' => 'Save',
            'hours' => 'Hours',
            'file' => 'File',
            'date' => 'Date',
            'user' => 'User',
            'attachment' => 'Attachment',
            'resource' => 'Resource',
            'signature' => 'Signature',
            'report' => 'Report',
            'image' => 'Image',
            'audits' => 'Audits',
            'parent' => 'Parent',
            'select_aggrement' => 'Select Aggrement',
            'view' => 'View',
            'edit' => 'Edit',
            'delete' => 'Delete',
            'gantt_chart_view' => 'Gantt chart view',
            'project_planning' => 'Project Planning',
            'select' => 'Select',
            'message' => 'Type Message Here...',
            'search' => 'Search Message Here...'
        ],
        'messages' => [
            'success' => 'Success!',
            'success_task_update' => 'Project task updated successfully!',
            'success_task_create' => 'Project task created successfully!',
            'project_updated_success' => 'Project Updated successfully!',
            'success_time_task_added' => 'Project Task time added successfully!'
        ]
    ],
    'permission'=>[
        'title'=>'Permission',
        'no_resource' => 'No Resource found',
        'labels'=>[
            'project'=>'Project',
            'resource' => 'Resource',
            'view_project'=>'View Project',
            'edit_project'=>'Add/Edit/Delete Project',
            'view_subtask'=>'View Sub Task',
            'add_edit_subtask'=>'Add/Edit/Delete Sub Task',
            'add_time'=>'Add Time',
            'planning_project'=>'Planning Project',
            'save'=>'Save',
            'cancel'=>'Cancel',
            'role_name' => 'Role',
            'add_new' => 'Add New'
        ],
        'text' => [
            'role_name' => 'Role'
        ]
    ]
];
