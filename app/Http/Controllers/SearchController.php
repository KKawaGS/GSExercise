<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SearchController extends Controller
{
    //search for requested book title with age restricted reviews
    public function search(SearchRequest $request) : View
    {
        $validatedData = $request->validated();
        $searchParams = $validatedData['search'];

        $booksCollection = Book::where('name', $searchParams['bookTitle'])->with('reviews')->get();

        $statData = [];
        /** data format
            statData[] =
            ['bookTitle' => ,
            'bookDate', =>
            'avgMaleReviewAge' => ,
            'avgFemaleReviewAge' =>,
            'compatibility' => ]
        */

        //if there are exact matches, populate $statData and return it
        if($booksCollection->isNotEmpty()){
            foreach ($booksCollection as $book) {
                $avgMaleReviewAge = $book->getReviewsByMale($searchParams['condition'], $searchParams['propertyValue'])->avg('age');
                $avgFemaleReviewAge = $book->getReviewsByFemale($searchParams['condition'], $searchParams['propertyValue'])->avg('age');
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

        } else {
            //if no exact title match - return reviews books that have reviews matching age requirement
            $reviews = Review::select('book_id', DB::raw('avg(age) as average'), 'sex')
                ->where('age', $searchParams['condition'], $searchParams['propertyValue'])
                ->with('book')->groupBy('book_id', 'sex')
                ->get();

            $statData = $this->formatReviewsData($reviews, $searchParams['bookTitle']);

        }

        return view('search.index', ['statData'=>$statData]);
    }

    public function index() : View
    {
        return view('search.search');
    }

    //format data from the db query to match $statData format
    private function formatReviewsData($reviews, $requestedBookTitle) : array
    {
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
}
