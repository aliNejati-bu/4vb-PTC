<?php

namespace PTC\App\Controller\user;

use PTC\Classes\SMS\SMSManager;

class VerifyController
{
    public function getIndex()
    {
        sms()->getSender()->sendCode("1212","09108214909");
        return [
            "status" => true
        ];
    }
}