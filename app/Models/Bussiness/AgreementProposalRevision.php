<?php

namespace App\Models\Bussiness;

use Illuminate\Database\Eloquent\Model;

class AgreementProposalRevision extends Model
{
    protected $table = 'pro_agreement_proposal_revision';


    public function user()
    {
        return $this->hasOne('App\Models\Auth\ProUser'  , 'id', 'user_id');
    }
}
