<!-- resources/views/livewire/stock-manager/create.blade.php -->

<div>
    <h2>Create Stock</h2>

    <form wire:submit.prevent="create">
        <div>
            <label for="bookId">Book ID</label>
            <input wire:model="bookId" type="text" id="bookId" name="bookId">
        </div>
        <div>
            <label for="quantityInStock">Quantity in Stock</label>
            <input wire:model="quantityInStock" type="text" id="quantityInStock" name="quantityInStock">
        </div>
        <div>
            <button type="submit">Save</button>
            <button wire:click="$set('showCreateForm', false)">Cancel</button>
        </div>
    </form>
</div>
