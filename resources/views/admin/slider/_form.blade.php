@extends('admin.files.layouts')

@section('title', $module_name)

@section('main')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mt-5">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="h5">
                                            {{ $module_name }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <form id="update" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label for="title">Title </label>
                                            <input type="text" id="title" name="title" class="form-control"
                                                placeholder="Enter title" value="{{ $data->title }}">
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label for="description">Description </label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Enter description">{{ $data->description }}</textarea>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="image">Upload Image <span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image"
                                                    name="image">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <div class="mt-2 form-group clearfix">
                                                <div class="icheck-success d-inline ml-5">
                                                    <input type="radio" id="active" name="status" value="1"
                                                        @if ($data->status == 1) checked @endif>
                                                    <label for="active">Active
                                                    </label>
                                                </div>
                                                <div class="icheck-danger d-inline ml-5">
                                                    <input type="radio" name="status" id="inactive" value="0"
                                                        @if ($data->status == 0) checked @endif>
                                                    <label for="inactive">Inactive
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="{{ asset('public/storage/slider/' . $data->image) }}"
                                                style="width: 200px;height: 200px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer rounded-bottom border-top bg-white">
                                    <center>
                                        <button class="btn btn-success mr-1"><i class="fa-solid fa-floppy-disk"></i>
                                            Save</button>
                                        <a href="{{ route('slider') }}" class="btn btn-primary"><i
                                                class="fa-solid fa-xmark"></i> Cancel</a>
                                    </center>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $("#update").validate({
                rules: {
                    image: {
                        extension: "jpeg|jpg|png",
                    },
                    description: {
                        maxlength: 180
                    }
                },
                messages: {
                    image: {
                        extension: "Select valid file with extension like .Jpeg,.png,.jpg for slider field."
                    },
                    description: {
                        maxlength: "Please enter description no more than 180 characters."
                    },
                },
                errorPlacement: function(error, element) {
                    error.css('color', 'red').appendTo(element.parent("div"));
                },
                submitHandler: function(form) {
                    $(':button[type="submit"]').prop('disabled', true);
                    form.submit();
                }
            });
        });
    </script>
@endsection
