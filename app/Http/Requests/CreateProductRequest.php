<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $comment = Comment::find($this->route('comment'));
        // return $comment && $this->user()->can('update', $comment);
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
            'name' => 'required|unique:products',
            'price' => 'required',
            'detales' => 'required',
            'description' => 'required',
            'category' => 'required',
            'image' => ['required', 'image'],
        ];
    }
}
