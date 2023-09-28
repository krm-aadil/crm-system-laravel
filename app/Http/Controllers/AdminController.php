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

        // Fetch real revenue data from the database
        $revenueData = Order::selectRaw('DATE(created_at) as order_date, SUM(total_amount) as revenue')
            ->groupBy('order_date')
            ->get();

        // Fetch the most sold book and author from the database
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

        // Prepare data for the revenue chart
        $labels = $revenueData->pluck('order_date')->toArray();
        $revenueValues = $revenueData->pluck('revenue')->toArray();

        // Fetch real data for the "Most Sold Books by Title for Each Month" chart
        $mostSoldBooksData = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, book_id, COUNT(*) as sold_count')
            ->groupBy('year', 'month', 'book_id')
            ->orderByRaw('year DESC, month DESC, sold_count DESC')
            ->limit(5) // Limit the results to the top 5 most sold books per month
            ->get();

        // Initialize arrays for labels and datasets
        $mostSoldBooksLabels = [];
        $mostSoldBooksDatasets = [];

        // Loop through the fetched data to populate the arrays
        foreach ($mostSoldBooksData as $item) {
            $yearMonth = Carbon::create($item->year, $item->month)->format('M Y');
            $bookTitle = Book::find($item->book_id)->title;

            if (!in_array($yearMonth, $mostSoldBooksLabels)) {
                $mostSoldBooksLabels[] = $yearMonth;
            }

            // Check if a dataset for this book title already exists
            $datasetIndex = array_search($bookTitle, array_column($mostSoldBooksDatasets, 'label'));

            if ($datasetIndex === false) {
                // If not, create a new dataset
                $mostSoldBooksDatasets[] = [
                    'label' => $bookTitle,
                    'data' => [$item->sold_count], // Initialize with the count for this month
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)', // Customize the dataset's appearance
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ];
            } else {
                // If it exists, add the count to the existing dataset
                $mostSoldBooksDatasets[$datasetIndex]['data'][] = $item->sold_count;
            }
        }

        return view('admin.dashboard', compact('loginCountsByHour', 'labels', 'revenueValues', 'mostSoldBookTitle', 'mostSoldAuthor', 'mostSoldBooksLabels', 'mostSoldBooksDatasets'));
    }
}
