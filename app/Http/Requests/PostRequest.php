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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|min:3|max:200|unique:posts',
            'resume' => 'required|min:3|max:200',
            'image' => 'required'
        ];

        if($this->method() == 'PUT'){
            $rules['title'] = 'required|min:3|max:200|unique:posts,title,'.$this->post;
            $rules['resume'] = 'required|min:3|max:200';
            $rules['image'] = 'nullable';
        }
            return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'Campo Título obrigatório!',
            'title.min' => 'Caracteres minimo de 3!',
            'title.max' => 'Caracteres maximo de 200!',
            'title.unique' => 'Este Post já está em uso',

            'resume.required' => 'Campo Resumo obrigatório!',
            'resume.min' => 'Caracteres minimo de 3!',
            'resume.max' => 'Caracteres maximo de 200!',

            'image.required' => 'Campo Imagem obrigratório!',
        ];
    }
}
