<?php

function getPlans()
{
    return [
        (object)[
            'id' => 'startup_account_beninner',
            'name' => 'Startup Account (Beginner)'
        ],
        (object)[
            'id' => 'advance_account_intermediate',
            'name' => 'Advance Account (intermediate)'
        ],
        (object)[
            'id' => 'advance_account_expert',
            'name' => 'Advance Account (Expert)'
        ],
        (object)[
            'id' => 'expert_account_master',
            'name' => 'Expert Account (Master)'
        ],
        (object)[
            'id' => 'vip_account_vip',
            'name' => 'VIP Account (VIP)'
        ],
        (object)[
            'id' => 'exclusive_account_vvip',
            'name' => 'Exclusive Account (VVIP)'
        ]
    ];
}

function getPlansArray(){
    $array = [];
    foreach (getPlans() as $plan) {
        $array[] = $plan->name;
    }
    return $array;
}
