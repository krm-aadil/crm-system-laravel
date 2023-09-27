<!-- resources/views/livewire/stock-manager/edit.blade.php -->

<div>
    <h2>Edit Stock</h2>

    <form wire:submit.prevent="update">
        <input type="hidden" wire:model="stockId">
        <div>
            <label for="bookId">Book ID</label>
            <input wire:model="bookId" type="text" id="bookId" name="bookId">
        </div>
        <div>
            <label for="quantityInStock">Quantity in Stock</label>
            <input wire:model="quantityInStock" type="text" id="quantityInStock" name="quantityInStock">
        </div>
        <div>
            <button type="submit">Update</button>
            <button wire:click="resetFields">Cancel</button>
        </div>
    </form>
</div>
