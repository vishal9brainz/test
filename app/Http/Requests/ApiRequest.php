<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class ApiRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        $message = "";
        $count = 0;
        $errors = $validator->errors()->messages();

        if(count($errors) > 0)
        {
            foreach($errors as $key => $error)
            {
                $count++;

                if(isset($error[0]))
                {
                    $message .= $error[0];

                    if (count($errors) != $count)
                    {
                        $message .= " \n";
                    }
                }
            }
        }

        $response = new JsonResponse(['success' => false, 'message' => $message], 200);
        throw (new ValidationException($validator, $response))->status(200);
    }
}
