@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="text-capitalize">Customer</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.customer.index') }}">Customer</a>
                        </li>
                        <li class="breadcrumb-item text-capitalize active" aria-current="page">Add New</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
        </div>

        @php
            // dd($errors);
        @endphp

        <form method="POST" action="{{ route('admin.customer.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-md-12 col-xl-8 col-left">

                    <div class="card mb-4">
                        <div class="card-body">
                            <x-admin.input name="name" text="Name" isRequired />
                            <div class="form-row">
                                <x-admin.input className="col-md-6" name="email" type="email" text="Email"
                                    isRequired />
                                <x-admin.input className="col-md-6" name="phone_number" text="Phone Number" isRequired />
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Gender: *</label>
                                    <select name="gender" class="form-control select2-single" required>
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
                                    <input class="form-control datepickerCus" name="dob" placeholder="dd/mm/yyyy"
                                        autoclose>
                                    @error('dob')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <x-admin.input className="col-md-6" name="height" type="number" text="Height (in cm)"
                                    isRequired />
                                <x-admin.input className="col-md-6" name="blood_group" text="Blood Group" isRequired />
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Education: *</label>
                                    <select name="education" class="form-control select2-single" required>
                                        @foreach ($attributes['education'] as $education)
                                            <option {{ old('education') == $education->attribute_value ? 'selected' : '' }}
                                                value="{{ $education->attribute_value }}">
                                                {{ $education->attribute_value }}</option>
                                        @endforeach
                                    </select>
                                    @error('education')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Profession: *</label>
                                    <select name="profession" class="form-control select2-single" required>
                                        @foreach ($attributes['profession'] as $profession)
                                            <option
                                                {{ old('profession') == $profession->attribute_value ? 'selected' : '' }}
                                                value="{{ $profession->attribute_value }}">
                                                {{ $profession->attribute_value }}</option>
                                        @endforeach
                                    </select>
                                    @error('profession')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            
                            <div class="form-row">
                                <x-admin.input className="col-md-6" name="password" type="password" text="Password"
                                    isRequired />
                                <x-admin.input className="col-md-6" name="password_confirmation" type="password" text="Password Confirmation"
                                    isRequired />
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
                                <select name="status" class="form-control select2-single mb-3">
                                    <option {{ old('status') == '1' ? 'selected' : '' }} value="1">
                                        Active</option>
                                    <option {{ old('status') == '0' ? 'selected' : '' }} value="0">Inactive
                                    </option>
                                </select>
                            </div>
                            <hr>
                            <div class="image-container">
                                <img id="previewImage" alt="detail" src="{{ adminAsset('img/placeholder.png') }}"
                                    class="responsive border-0 w-100 mb-2" />
                            </div>
                            <div class="imgbutton mb-3">
                                <label class="btn btn-outline-primary btn-upload" for="inputImage"
                                    title="Upload image file">
                                    <input type="file" class="sr-only" id="inputImage" name="image"
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
@endsection


@section('header')
    <link rel="stylesheet" href="{{ adminAsset('css/vendor/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ adminAsset('css/vendor/select2-bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ adminAsset('css/vendor/bootstrap-datepicker3.min.css') }}" />
@endsection
@section('footer')
    <script src="{{ adminAsset('js/vendor/select2.full.js') }}"></script>
    <script src="{{ adminAsset('js/vendor/bootstrap-datepicker.js') }}"></script>
    <script>
        // $.fn.datepicker.defaults.format = 'dd/mm/yyyy';
        $('.datepickerCus').datepicker({
            format: 'dd/mm/yyyy',
            endDate: new Date(),
            autoclose: true
        })

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#inputImage").change(function() {
            readURL(this);
        });
    </script>
@endsection
