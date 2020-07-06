<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:128|unique:articles,title,' . $this->article,
            'slug' => 'required|min:5|max:128|unique:articles,slug,' . $this->article,
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'body' => 'required|min:10',
            'excerpt' => 'required|min:10|max:250',
            'image' => 'mimes:jpg,jpeg,png|dimensions:min_width=900,min_height=400',
        ];
    }
}
