<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        // return [
        //     'body' => 'required|string|max:2000',
        //     'charenge_id' => 'required|exists:charenges,id',
        //     'image' => 'required|file|image|mimes:jpeg,png',
        //     'post_day' => 'required|after:yesterday',
        // ];

        $route = $this->route()->getName();

        $rule = [
            'body' => 'required|string|max:2000',
            'charenge_id' => 'required|exists:charenges,id',
            'post_day' => 'required|after:yesterday',
        ];

        if (
            $route === 'posts.store' ||
            ($route === 'posts.update' && $this->file('image'))
        ) {
            $rule['image'] = 'required|file|image|mimes:jpeg,png';
        }

        return $rule;
    }
}
