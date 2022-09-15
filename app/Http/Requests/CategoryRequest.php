<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [
            'title' => 'required|max:200|min:3|unique:categories',
        ];

        if($this->method() == 'PUT'){
            $rules['title'] = 'required|max:200|min:3|unique:categories,title,'.$this->category;
        }
            return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'Campo Categoria Obrigatório!',
            'title.unique' => 'Este Título já está em uso!',
        ];
    }
}
