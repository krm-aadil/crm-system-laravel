<!-- resources/views/livewire/stock-manager/index.blade.php -->

<div>
    <h2>Stock List</h2>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Book ID</th>
            <th>Quantity in Stock</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($stocks as $stock)
            <tr>
                <td>{{ $stock->id }}</td>
                <td>{{ $stock->book_id }}</td>
                <td>{{ $stock->quantity_in_stock }}</td>
                <td>
                    <button wire:click="edit({{ $stock->id }})">Edit</button>
                    <button wire:click="delete({{ $stock->id }})">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <button wire:click="$set('showCreateForm', true)">Create Stock</button>

    @if ($showCreateForm)
        @include('livewire.stock-manager.create')
    @endif

    @if ($stockId)
        @include('livewire.stock-manager.edit')
    @endif
</div>
