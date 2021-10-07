<?php

namespace App\Http\Services;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class SearchService
{
    //get books with matching title
    public function getBooks($bookTitle) {
        return Book::where('name', $bookTitle)->with('reviews')->get();
    }

    //get stats from books collection
    public function getBooksStats($books, $condition, $propertyValue){
        $statData = [];
        foreach ($books as $book) {
            $avgMaleReviewAge = $book->getReviewsByMale($condition, $propertyValue)->avg('age');
            $avgFemaleReviewAge = $book->getReviewsByFemale($condition, $propertyValue)->avg('age');
            $bookTitle = $book->name;
            $bookDate = $book->book_date;
            $compatibility = 100;

            $statData[] = compact(
                'bookTitle',
                'bookDate',
                'avgMaleReviewAge',
                'avgFemaleReviewAge',
                'compatibility'
            );
        }

        return $statData;
    }

    //get reviews with age requirement, average age for each book review grouped by gender
    public function getReviewsByAge($condition, $propertyValue){
        return Review::select('book_id', DB::raw('avg(age) as average'), 'sex')
            ->where('age', $condition, $propertyValue)
            ->with('book')->groupBy('book_id', 'sex')
            ->get();
    }

    //get stats from review collection
    public function getReviewsStats($reviews, $requestedBookTitle) {
        $statData = [];
        foreach ($reviews as $review){
            if(!isset($statData[$review->book_id])){
                $bookTitle = $review->book->name;
                $bookDate = $review->book->book_date;
                $compatibility = 0;
                similar_text($requestedBookTitle, $bookTitle, $compatibility);

                $avgFemaleReviewAge = 0;
                $avgMaleReviewAge = 0;

                $review->sex == 'm' ? $avgMaleReviewAge = $review->average :  $avgFemaleReviewAge = $review->average;

                $statData[$review->book_id] = compact(
                    'bookTitle',
                    'bookDate',
                    'avgMaleReviewAge',
                    'avgFemaleReviewAge',
                    'compatibility'
                );

            } else {
                $review->sex == 'm'
                    ? $statData[$review->book_id]['avgMaleReviewAge'] = $review->average
                    :  $statData[$review->book_id]['avgFemaleReviewAge'] = $review->average;
            }
        }

        return $statData;
    }

    public function getStatsData($bookTitle,  $condition, $propertyValue) {

        $bookCollection = $this->getBooks($bookTitle);
        if($bookCollection->isNotEmpty()){
            return $this->getBooksStats($bookCollection, $condition, $propertyValue);

        } else {
            $reviews = $this->getReviewsByAge($condition, $propertyValue);
            return $this->getReviewsStats($reviews, $bookTitle);
        }
    }




}
