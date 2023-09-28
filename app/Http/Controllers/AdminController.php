<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Click;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function analytics()
    {
// Retrieve the login timestamps
        $loginActivities = Click::all();

        // Initialize an array to store login counts by hour
        $loginCountsByHour = [];

        // Loop through login activities and group them by hour
        foreach ($loginActivities as $activity) {
            $timestamp = Carbon::parse($activity->created_at);
            $hour = $timestamp->hour;

            if (!isset($loginCountsByHour[$hour])) {
                $loginCountsByHour[$hour] = 0;
            }

            $loginCountsByHour[$hour]++;
        }

        // Sort the login counts by hour in descending order
        arsort($loginCountsByHour);


//        $revenueData = Order::selectRaw('DATE(created_at) as order_date, SUM(total_amount) as revenue')
//            ->groupBy('order_date')
//            ->get();

        $revenueData = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_amount) as revenue')
            ->groupBy('year', 'month')
            ->get();

//        $revenueData = Order::selectRaw('YEAR(created_at) as year, SUM(total_amount) as revenue')
//            ->groupBy('year')
//            ->get();

        // Get the most sold book title by book ID
        $mostSoldBook = Order::select('book_id')
            ->groupBy('book_id')
            ->orderByRaw('COUNT(*) DESC')
            ->first();

        $mostSoldBookTitle = '';
        $mostSoldAuthor = '';

        if ($mostSoldBook) {
            $mostSoldBookTitle = Book::find($mostSoldBook->book_id)->title;

            // Get the author information
            $authorId = Book::find($mostSoldBook->book_id)->author_id;
            $author = Author::find($authorId);

            if ($author) {
                $mostSoldAuthor = $author->first_name . ' ' . $author->last_name;
            }
        }
        //get the most sold author by book ID

        $labels = $revenueData->pluck('order_date')->toArray();
        $revenueValues = $revenueData->pluck('revenue')->toArray();

        return view('admin.dashboard',compact('loginCountsByHour','labels','revenueValues','mostSoldBookTitle','mostSoldAuthor'));
    }
}
