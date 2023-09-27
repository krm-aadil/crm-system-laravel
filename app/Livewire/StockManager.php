<?php

// app/Http/Livewire/StockManager.php

use Livewire\Component;
use App\Models\Stock;

class StockManager extends Component
{
    public $stocks;
    public $stockId;
    public $bookId;
    public $quantityInStock;

    public function render()
    {
        $this->stocks = Stock::all();
        return view('livewire.stock-manager.index');
    }

    public function create()
    {
        Stock::create([
            'book_id' => $this->bookId,
            'quantity_in_stock' => $this->quantityInStock,
        ]);

        $this->resetFields();
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        $this->stockId = $stock->id;
        $this->bookId = $stock->book_id;
        $this->quantityInStock = $stock->quantity_in_stock;
    }

    public function update()
    {
        $stock = Stock::findOrFail($this->stockId);

        $stock->update([
            'book_id' => $this->bookId,
            'quantity_in_stock' => $this->quantityInStock,
        ]);

        $this->resetFields();
    }

    public function delete($id)
    {
        Stock::destroy($id);
    }

    private function resetFields()
    {
        $this->stockId = null;
        $this->bookId = null;
        $this->quantityInStock = null;
    }
}
