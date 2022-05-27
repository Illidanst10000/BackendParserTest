<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'link' => 'required|string',
            'description' => 'required|string',
            'category' => 'string',
            'pubDate' => 'required|date_format:"D, d M Y H:i:s \G\M\T"',
            'guid' => 'required|int',
        ];
    }
}
