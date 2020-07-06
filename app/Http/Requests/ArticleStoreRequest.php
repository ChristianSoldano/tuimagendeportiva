<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
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
            'title' => 'required|unique:articles,title|min:5|max:128',
            'slug' => 'required|unique:articles,slug|min:5|max:128',
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'body' => 'required|min:10',
            'excerpt' => 'required|min:10|max:250',
            'image' => 'required|mimes:jpg,jpeg,png|dimensions:min_width=900,min_height=400',
        ];
    }
}
