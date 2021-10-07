<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'search' => ['required', 'max:255', 'regex:/^[\w ]{3,}[|][\w ]+[<>]\s*\d+\s*$/']
        ];
    }

    public function messages()
    {
        return [
            'search.regex' => "query format: 'book title' | age < or > 'value'",
            'search.required' => "Input search query"
        ];
    }

    public function validated()
    {
        //merge $input->search parsed by passedValidation() with validated->search
        return array_merge(parent::validated(), ['search' => $this->input('search')]);
    }

    /*
        search request string that passed validation is parsed to get search params:
        bookTitle, condition, property name(const 'age' atm) property value
    */
    function passedValidation() {
        //input format: 'title' 'separator |' 'property' 'condition' 'value'
        //get title from input string
        $searchData = [];
        $inputArr = explode('|', $this->search);
        $searchData['bookTitle']  = $inputArr[0];

        //get condition from input string
        $pattern = "/[><]/";
        $match = [];
        preg_match($pattern, $inputArr[1], $match);
        $searchData['condition'] = $match[0];

        //get prop name and value
        $propArr = explode($searchData['condition'], $inputArr[1]);
        $searchData['propertyName'] = $propArr[0];
        $searchData['propertyValue'] = $propArr[1];

        //merge with $request->search
        $this->merge(['search' => $searchData]);
    }
}
