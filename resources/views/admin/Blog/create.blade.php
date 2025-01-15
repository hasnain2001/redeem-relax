@extends('admin.master')
@section('title')
    Create|Blog
@endsection
@section('main-content')
    <div class="content-wrapper">
    <div class="container justify-content">
        <!-- Blog Form -->
        <form method="POST" action="{{ route('admin.blog.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
           @if (session()->has('success'))
    <div class="alert alert-primary d-flex align-items-center" role="alert">

        <div>
            blog created successfully
        </div>
    </div>
@endif
@if(session('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fa fa-ban"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <b>{{ session('success') }}</b>
</div>
@endif


                        <!-- Display validation errors here -->
                        @if ($errors->any())
                        <div  class="alert alert-danger" >
                            <strong>Validation error(s):</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" required />
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug /Url Blog</label>
                            <input type="text" class="form-control" name="slug" id="slug" required />
                            <small id="slug-message"></small> <!-- Added this line -->
                        </div>
                        <div class="form-group">
                            <label for="category_image">Blog Image</label>
                            <input type="file" class="form-control" name="category_image" id="blog_image" required />
                        </div>

                        <!-- Preview container -->
                        <div id="imagePreview" style="margin-top: 10px;"></div>

                        <div class="form-group">
                            <label for="">Main Content</label>


                             <div id="container">
                                 <textarea required id="editor" name="content" >

                                 </textarea>

        </div>
                        </div>

                    </div>

                </div>
                     <div class="form-group">
                                    <label for="name">Meta Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title" >
                                </div>
                                <div class="form-group">
                                    <label for="meta_tag">Meta Tag <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="meta_tag" id="meta_tag">
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keyword <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="meta_keyword" id="meta_keyword">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="5" style="resize: none;"></textarea>
                                </div>
                                <button type="submit" class="btn btn-dark">Submit</button>
                            </div>
                        </div>
            </div>    </div>    </div>
        </form>
    </div>
</div>
<script>
    // JavaScript to preview the selected image
    document.getElementById('blog_image').addEventListener('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                var imgElement = document.createElement('img');
                imgElement.setAttribute('src', event.target.result);
                imgElement.setAttribute('class', 'preview-image'); // Optional: Add CSS class for styling
                imgElement.setAttribute('style', 'max-width: 100%; height: 50px;'); // Optional: Add styling
                document.getElementById('imagePreview').innerHTML = ''; // Clear previous preview, if any
                document.getElementById('imagePreview').appendChild(imgElement);
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('imagePreview').innerHTML = ''; // Clear preview if no file selected
        }
    });

    // Filter non-alphabetic characters in the 'name' input field and auto-fill 'slug'
    const inputOne = document.getElementById('title');
    const textOnlyInput = document.getElementById('slug');

    inputOne.addEventListener('input', () => {
        const value = inputOne.value;
        // Filter out non-alphabetic characters and update slug automatically
        const filteredValue = value.replace(/[^A-Za-z\s]/g, '');
        textOnlyInput.value = filteredValue;
        
        // Automatically check slug existence after auto-filling
        checkSlugExistence(filteredValue);
    });

    $(document).ready(function() {
        // Check slug existence when the user types manually in the slug field
        $('#slug').on('keyup', function() {
            var slug = $(this).val();
            
            // Check if the slug has any value (optional: avoid AJAX if empty)
            if (slug) {
                checkSlugExistence(slug);
            } else {
                $('#slug-message').text('Please enter a slug').css('color', 'black');
            }
        });
    });

    // Function to check if the slug exists
    function checkSlugExistence(slug) {
        $.ajax({
            url:'{{ route('blog.check.slug') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                slug: slug
            },
            success: function(response) {
                if (response.exists) {
                    $('#slug-message').text('Blog already exists').css('color', 'red');
                } else {
                    $('#slug-message').text('Blog is available').css('color', 'green');
                }
            }
        });
    }
</script>
   



        @endsection
