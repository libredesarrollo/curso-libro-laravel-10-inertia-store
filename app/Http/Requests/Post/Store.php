<?php


namespace App\Http\Requests\Post;


use Illuminate\Foundation\Http\FormRequest;


class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }


    public function prepareForValidation()
    {
        if(str($this->slug)->trim() == "")
        $this->merge([
            'slug' => str($this->title)->slug()
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "title" => "required|min:5|max:255",
            "slug" => "required|min:5|max:255|unique:categories",
            "date" => "required",
            "description" => "required",
            "text" => "required",


            "posted" => "required",
            "type" => "required",
            "category_id" => "required",
        ];
    }
}
