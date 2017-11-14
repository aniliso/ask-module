<?php

namespace Modules\Ask\Http\Requests;

use Illuminate\Http\Response;
use Modules\Core\Internationalisation\BaseFormRequest;

class CreateQuestionRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'           => 'required|min:2',
            'last_name'            => 'required:min:2',
            'phone'                => 'required|numeric',
            'email'                => 'required|email',
            'question'             => 'required|min:20|max:500',
            'captcha_ask'          => 'required|captcha',
            'attachment'           => 'mimes:jpeg,jpg,png,gif,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar'
        ];
    }

    public function attributes()
    {
        return trans('ask::questions.form');
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function response(array $errors)
    {
        return response()->json([
            'success' => false,
            'message' => $errors
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function messages()
    {
        return trans('validation');
    }
}
