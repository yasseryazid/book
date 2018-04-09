<?php

namespace App\Http\Controllers\Api\V1;

use App\Chapter;
use App\Book;
use App\PurchaseChapters;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChaptersController extends Controller
{
    public function index()
    {
        return Chapter::all();
    }

    public function show($id)
    {
        return Chapter::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->update($request->all());

        return $chapter;
    }

    public function store(Request $request)
    {
        $book = Book::findOrFail($request->get('book_id'));
        $params = [
            'title' => $request->get('title'),
            'book_id' => (int) $request->get('book_id'),
            'price' => (int) $request->get('price'),
            'content' => $request->get('content'),
            'sequence' => (int) $request->get('sequence')
        ];
        $chapter = Chapter::create($params);

        if ($book && $chapter) {
            $purchase_chapter = [
                'user_id' => $book->user_id,
                'chapter_id' => $chapter->id
            ];
            PurchaseChapters::create($purchase_chapter);
        }

        return $chapter;
    }

    public function destroy($id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->delete();
        return '';
    }

    public function purchaseChapters()
    {
        $books = Book::with('chapters')->get();

        if ($books) {
            $royalty_per_quarter = [];
            $total_transaction = 10;
            foreach ($books AS &$book) {
                $total_royalty = 0;
                if ($book->chapters) {
                    $quartals = [];
                    foreach ($book->chapters AS &$chapter) {
                        $num_quartals = 4;
                        $months   = 4;
                        for ($i = 1; $i <= $num_quartals; $i++) {
                            $royalty = ($chapter->price * (30/100)) * $total_transaction;

                            //set start date of quartal
                            if ($i == 1) {
                                $start_date = date('Y-m-d', strtotime($chapter->created_at));
                            } else {
                                $next_start = $months*($i-1);
                                $start_date = date('Y-m-d', strtotime("+$next_start months 1 day", strtotime($chapter->created_at)));
                            }
                            //end:set start date of quartal

                            //set end date of quartal
                            if ($i == 1) {
                                $end_date = date('Y-m-d', strtotime("+$months months", strtotime($chapter->created_at)));
                            } else {
                                $next_end = $months*$i;
                                $end_date = date('Y-m-d', strtotime("+$next_end months", strtotime($chapter->created_at)));
                            }
                            //end:set end date of quartal
                            $detail  = [
                                'start_date'        => $start_date,
                                'end_date'          => $end_date,
                                'total_transaction' => $total_transaction,
                                'royalty'           => $royalty
                            ];
                            $quartals[$i] = $detail;
                            $total_royalty += $royalty;
                        }
                        $chapter->quartals = $quartals;
                    }
                }
                $book->total_royalty = $total_royalty;
                $book->total_chapters = count($book->chapters);
                unset($book->chapters);
            }
        }

        return $books;
    }

    public function purchaseChapterByBook($book_id)
    {
        $book = Book::findOrFail($book_id);

        if ($book) {
            $total_transaction = 10;
            $total_royalty = 0;
            if ($book->chapters) {
                $quartals = [];
                foreach ($book->chapters AS &$chapter) {
                    $num_quartals = 4;
                    $months   = 4;
                    $subtotal_royalty = 0;
                    for ($i = 1; $i <= $num_quartals; $i++) {
                        $royalty = ($chapter->price * (30/100)) * $total_transaction;

                        //set start date of quartal
                        if ($i == 1) {
                            $start_date = date('Y-m-d', strtotime($chapter->created_at));
                        } else {
                            $next_start = $months*($i-1);
                            $start_date = date('Y-m-d', strtotime("+$next_start months 1 day", strtotime($chapter->created_at)));
                        }
                        //end:set start date of quartal

                        //set end date of quartal
                        if ($i == 1) {
                            $end_date = date('Y-m-d', strtotime("+$months months", strtotime($chapter->created_at)));
                        } else {
                            $next_end = $months*$i;
                            $end_date = date('Y-m-d', strtotime("+$next_end months", strtotime($chapter->created_at)));
                        }
                        //end:set end date of quartal
                        $detail  = [
                            'start_date'        => $start_date,
                            'end_date'          => $end_date,
                            'total_transaction' => $total_transaction,
                            'royalty'           => $royalty
                        ];
                        $quartals[$i] = $detail;
                        $subtotal_royalty += $royalty;
                        $total_royalty += $royalty;
                    }
                    $chapter->quartals = $quartals;
                    $chapter->subtotal = $subtotal_royalty;
                    $chapter->total_transaction = $total_transaction;
                }
            }
            $book->total_royalty = $total_royalty;
        }

        return $book;
    }
}