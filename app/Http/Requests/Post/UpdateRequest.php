<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'string',
            'link' => 'string',
            'description' => 'string',
            'category' => 'string',
            'pubDate' => 'date_format:' . env('FORMAT_DATE'),
            'guid' => 'int',
        ];
    }
}
