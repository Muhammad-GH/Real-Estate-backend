<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'pro_proposal';
    
    protected $fillable = [
        'proposal_tender_id',
        'proposal_client_type',
        'proposal_client_id',
        'proposal_user_id',
        'proposal_request_id',
        'proposal_pdf',
        'proposal_attachment',
        'emails',
        'date',
        'proposal_material_payment',
        'proposal_other',
        'proposal_work_payment',
        'proposal_work_guarantee',
        'proposal_insurance',
        'proposal_due_date',
        'proposal_start_date',
        'proposal_end_date',
    ];
}
