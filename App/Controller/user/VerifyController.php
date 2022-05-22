<?php

namespace PTC\App\Controller\user;

use JetBrains\PhpStorm\ArrayShape;
use PTC\Classes\SMS\SMSManager;

class VerifyController
{

    /**
     * @param string $phoneNumber
     * @return array
     */
    #[ArrayShape(["status" => "bool", "messages" => "array", "data" => "mixed"])] public function editPhoneNumber(string $phoneNumber): array
    {
        auth()->userModel->is_phone_verified = false;
        auth()->userModel->phone = $phoneNumber;
        $result = auth()->userModel->save();
        if (!$result) {
            http_response_code(404);
            return responseJson(false, [], "user not Fonded");
        }
        return responseJson(true, [], "phoneNumberEdited");
    }

    #[ArrayShape(["status" => "false|int"])] public function generateVerifyCode(): array
    {

        return [
            "status" => preg_match('/^(?:98|\+98|0098|0)?9[0-9]{9}$/',"0910821490")
        ];
    }
}