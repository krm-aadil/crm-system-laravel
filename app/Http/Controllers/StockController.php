<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {

        $stocks = Stock::with('book')->get();

        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $books = Book::all();
        return view('stocks.create',compact('books'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'quantity_in_stock' => 'required|integer',
        ]);

        Stock::create($request->all());

        return redirect()->route('stocks.index')
            ->with('success', 'Stock created successfully.');

    }

    public function show(Stock $stock)
    {
        $stock = Stock::find($stock);
        return view('stocks.show', compact('stock'));

    }

    public function edit(Stock $stock)
    {
        $stock = Stock::find($stock)->first();

        return view('stocks.edit', compact('stock'));
    }

    public function update(Request $request,Stock $stock)
    {
        $stock = Stock::find($stock);

        $request->validate([
            'quantity_in_stock' => 'required|integer',
        ]);

        $stock->update($request->all());

        return redirect()->route('stocks.index')
            ->with('success', 'Stock updated successfully.');

    }

    public function destroy(Stock $stock)
    {

        $stock->delete();

        return redirect()->route('stocks.index')
            ->with('success', 'Stock deleted successfully.');

    }
}
