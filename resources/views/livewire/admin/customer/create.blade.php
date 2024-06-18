<div>
    <form wire:submit.prevent="save" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-md-12 col-xl-8 col-left">
                <div class="card mb-4">
                    <div class="card-body">
                        <x-admin.livewire.input name="name" text="Name" isRequired />
                        <div class="form-row">
                            <x-admin.livewire.input className="col-md-6" name="email" text="Email" isRequired />
                            <x-admin.livewire.input className="col-md-6" name="phone_number" text="Phone Number"
                                isRequired />
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Gender: *</label>
                                <select name="gender" class="form-control select2-single" wire:model.live.blur='gender'
                                    required>
                                    <option {{ old('gender') == 'male' ? 'selected' : '' }} value="male">
                                        Male</option>
                                    <option {{ old('gender') == 'female' ? 'selected' : '' }} value="female">Female
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>DOB: *</label>
                                <input class="form-control datepickerCus" wire:model.live.blur="dob" name="dob"
                                    placeholder="dd/mm/yyyy" autoclose>
                                @error('dob')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <x-admin.livewire.input className="col-md-6" name="height" type="number"
                                text="Height (in cm)" isRequired />

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Blood Group: *</label>
                                <div wire:ignore>
                                    <select name="blood_group" wire:model.live.blur="blood_group"
                                        class="form-control select2-single" required>
                                        @foreach ($attribute_list['blood_group'] as $education)
                                            <option
                                                {{ old('blood_group') == $education->attribute_value ? 'selected' : '' }}
                                                value="{{ $education->attribute_value }}">
                                                {{ $education->attribute_value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('blood_group')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Education: *</label>
                                <div wire:ignore>
                                    <select name="education" wire:model.live.blur="education"
                                        class="form-control select2-single" required>
                                        @foreach ($attribute_list['education'] as $education)
                                            <option
                                                {{ old('education') == $education->attribute_value ? 'selected' : '' }}
                                                value="{{ $education->attribute_value }}">
                                                {{ $education->attribute_value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('education')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Profession: *</label>
                                <div wire:ignore>
                                    <select name="profession" wire:model.live.blur="profession"
                                        class="form-control select2-single" required>
                                        @foreach ($attribute_list['profession'] as $profession)
                                            <option
                                                {{ old('profession') == $profession->attribute_value ? 'selected' : '' }}
                                                value="{{ $profession->attribute_value }}">
                                                {{ $profession->attribute_value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('profession')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Religion: *</label>
                                <div wire:ignore>
                                    <select name="religion" wire:model.live.blur="religion"
                                        class="form-control select2-single" required>
                                        @foreach ($attribute_list['religion'] as $religion)
                                            <option
                                                {{ old('religion') == $religion->attribute_value ? 'selected' : '' }}
                                                value="{{ $religion->attribute_value }}">
                                                {{ $religion->attribute_value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('religion')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Caste: *</label>
                                <div wire:ignore>
                                    <select name="caste" wire:model.live.blur="caste"
                                        class="form-control select2-single" required>
                                        @foreach ($attribute_list['caste'] as $caste)
                                            <option {{ old('caste') == $caste->attribute_value ? 'selected' : '' }}
                                                value="{{ $caste->attribute_value }}">
                                                {{ $caste->attribute_value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('caste')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">State: *</label>
                                <livewire:select_input title="State" :value="$state" :options="$state_list"
                                    emitUpEvent="stateSelected" />
                                @error('state')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">District: *</label>
                                <livewire:select_input key="state-{{ $state ?? 'none' }}-district" title="District"
                                    :value="$district" :options="$district_list" emitUpEvent="districtSelected" />
                                @error('district')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">City: *</label>
                                <livewire:select_input title="City" key="district-{{ $district ?? 'none' }}-city"
                                    :value="$city" :options="$city_list" emitUpEvent="citySelected" />
                                @error('city')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-12 col-xl-4 col-right">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="action-butns">
                            <button type="submit" class="btn btn-primary mb-4 w-100">Create</button>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Status:</label>
                            <div wire:ignore>
                                <select name="status" wire:model.live.blur="status"
                                    class="form-control select2-single mb-3">
                                    <option {{ old('status') == '1' ? 'selected' : '' }} value="1">
                                        Active</option>
                                    <option {{ old('status') == '0' ? 'selected' : '' }} value="0">Inactive
                                    </option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="image-container">
                            <img id="previewImage" alt="detail" src="{{ adminAsset('img/placeholder.png') }}"
                                class="responsive border-0 w-100 mb-2" />
                        </div>
                        <div class="imgbutton mb-3">
                            <label class="btn btn-outline-primary btn-upload" for="inputImage"
                                title="Upload image file">
                                <input type="file" wire:model.live.blur="profile_image" class="sr-only"
                                    id="inputImage" name="profile_image"
                                    accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff,.webp">
                                Select Image
                            </label>
                            <p>
                                Image size: 300x400
                            </p>
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
@push('scripts')
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
    <script>
        $(document).ready(function() {
            // $('.lw-select2').select2({
            //     placeholder: "Select an option",
            //     theme: "bootstrap",
            //     dir: 'ltr',
            //     placeholder: "",
            //     maximumSelectionSize: 6,
            //     containerCssClass: ":all:"
            // });

            // $('.lw-select2').on('change', function(e) {
            //     var data = $(this).select2("val");
            //     @this.set($(this).attr('name'), data);
            // });
        });
    </script>
@endpush
