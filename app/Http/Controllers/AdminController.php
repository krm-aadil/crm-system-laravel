<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Click;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function getUsersCount()
    {
        $totalUsersCount = DB::table('users')->count();
        return $totalUsersCount;
    }

    public function getUsersAgeGroupsCount()
    {
        $now = now();
        $userCounts = [
            '1-15' => DB::table('users')->whereRaw("TIMESTAMPDIFF(YEAR, birthdate, '{$now}') BETWEEN 1 AND 15")->count(),
            '15-20' => DB::table('users')->whereRaw("TIMESTAMPDIFF(YEAR, birthdate, '{$now}') BETWEEN 15 AND 20")->count(),
            '20-40' => DB::table('users')->whereRaw("TIMESTAMPDIFF(YEAR, birthdate, '{$now}') BETWEEN 20 AND 40")->count(),
            '40-100' => DB::table('users')->whereRaw("TIMESTAMPDIFF(YEAR, birthdate, '{$now}') BETWEEN 40 AND 100")->count(),
        ];

        return $userCounts;
    }

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

        // Fetch the most sold book and author from the database, including the cover image path
        $mostSoldBook = Order::select('book_id')
            ->with(['book' => function ($query) {
                $query->select('id', 'title', 'author_id', 'CoverImage'); // Include the cover_image field
            }])
            ->groupBy('book_id')
            ->orderByRaw('COUNT(*) DESC')
            ->first();

        $mostSoldBookTitle = '';
        $mostSoldAuthor = '';
        $mostSoldBookCover = ''; // Initialize the cover image path

        if ($mostSoldBook) {
            $mostSoldBookTitle = $mostSoldBook->book->title;

            // Get the author information
            $authorId = $mostSoldBook->book->author_id;
            $author = Author::find($authorId);

            if ($author) {
                $mostSoldAuthor = $author->first_name . ' ' . $author->last_name;
            }

            // Get the cover image path
            $mostSoldBookCover = $mostSoldBook->book->CoverImage;
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

        $genreData = Order::select('genres.genre_name', DB::raw('COUNT(orders.id) as book_count'))
            ->join('books', 'orders.book_id', '=', 'books.id')
            ->join('genres', 'books.genre_id', '=', 'genres.id')
            ->groupBy('genres.genre_name')
            ->get();

// Initialize arrays for labels and data
        $genreLabels = $genreData->pluck('genre_name')->toArray();
        $genreCounts = $genreData->pluck('book_count')->toArray();

        $totalUsersCount = $this->getUsersCount();

        $userCountsByAgeGroup = $this->getUsersAgeGroupsCount();

        return view('admin.dashboard', compact('loginCountsByHour', 'labels', 'revenueValues',
            'mostSoldBookTitle', 'mostSoldAuthor', 'mostSoldBooksLabels',
            'mostSoldBooksDatasets','genreLabels','genreCounts','totalUsersCount',
            'userCountsByAgeGroup','mostSoldBookCover'));
    }


    public function maps()
    {
        $users = User::join('cities', 'users.city_id', '=', 'cities.id')
            ->select('users.*', 'cities.latitude', 'cities.longitude')
            ->get();

        return view('admin.maps', ['users' => $users]);
    }


}
