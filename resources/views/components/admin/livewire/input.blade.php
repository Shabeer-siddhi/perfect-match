<div class="form-group {{ $className }}">
    <label for="{{ $name }}">{{ $text }}:
        @if ($isRequired)
            <span class="error error-star">*</span>
        @endif
    </label>
    <input class="form-control" type="{{ $type }}" id="{{ $name }}" wire:model.live.blur="{{ $name }}"
        name="{{ $name }}" {{ $isRequired ? 'required' : '' }} {{ $disabled ? 'disabled' : '' }}>
    @error($name)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
