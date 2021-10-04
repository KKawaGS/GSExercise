<?php

namespace App\HelperClass;

class SearchRequestParser
{
    private string $bookTitle;
    private string $propertyName;
    private string $propertyValue;
    private string $condition;

    function __construct(string $input)
    {
        //input format: 'title' 'separator |' 'property' 'condition' 'value'
        //get title from input string
        $inputArr = explode('|', $input);
        $this->bookTitle = $inputArr[0];

        //get condition from input string
        $pattern = "/[><]/";
        $match = [];
        preg_match($pattern, $inputArr[1], $match);
        $this->condition = $match[0];

        //get prop name and value
        $propArr = explode($this->condition, $inputArr[1]);
        $this->propertyName = $propArr[0];
        $this->propertyValue = $propArr[1];
    }

    /**
     * @return mixed|string
     */
    public function getBookTitle()
    {
        return $this->bookTitle;
    }

    /**
     * @return mixed|string
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @return mixed|string
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }

    /**
     * @return mixed|string
     */
    public function getPropertyValue()
    {
        return $this->propertyValue;
    }

    /**
     * @return array
    */
    public function getData()
    {
        return [
            'bookTitle' => $this->bookTitle,
            'propertyName' => $this->propertyName,
            'propertyValue' => $this->propertyValue,
            'condition' => $this->condition
        ];
    }

}
