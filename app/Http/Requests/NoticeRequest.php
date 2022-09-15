<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
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
            'category_id' => 'required',
            'title' => 'required|min:3|max:200|unique:notices',
            'description' => 'required|min:3|max:2000',
            'image' => 'required'
        ];

        if($this->method() == 'PUT'){
            $rules['category_id'] = 'required';
            $rules['title'] = 'required|min:3|max:200|unique:notices,title,'.$this->notice;
            $rules['description'] = 'required|min:3|max:2000';
            $rules['image'] = 'nullable';
        }
            return $rules;
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Campo Categoria obrigatório!',

            'title.required' => 'Campo Título obrigatório!',
            'title.min' => 'Caracteres minimo de 3!',
            'title.max' => 'Caracteres maximo de 200!',
            'title.unique' => 'Este Post já está em uso',

            'description.required' => 'Campo Descrição obrigatório!',
            'description.min' => 'Caracteres minimo de 3!',
            'description.max' => 'Caracteres maximo de 2000!',

            'image.required' => 'Campo Imagem obrigratório!',
        ];
    }
}
