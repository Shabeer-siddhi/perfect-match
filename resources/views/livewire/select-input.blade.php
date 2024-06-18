<div >
    <select wire:model.live="value" name="value" id="country" class="form-control lw-select2">
        <option value="">Choose a {{ $title ?? 'n option' }}</option>
        @foreach ($options ?? [] as $option)
            <option value="{{ $option->id }}">
                {{ $option->name }}
            </option>
        @endforeach
    </select>
</div>
