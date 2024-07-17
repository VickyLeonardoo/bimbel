@extends('partials.admin.header')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-header text-end">
                        <a href="{{ route('admin.instructor') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                            Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.instructor.store') }}" method="POST" enctype="multipart/form-data">
                            <h5>Personal Information</h5>
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ old('phone') }}">
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Gender</label>
                                        <select class="form-control" name="gender">
                                            <option value="m">Male</option>
                                            <option value="f">Female</option>
                                        </select>
                                        @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <textarea class="form-control" name="address" rows="3">{{ old('address') }}</textarea>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Image</label> <br>
                                <input type="file" class="form-control-file form-control" name="image">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <h5>Education</h5>
                            <hr>
                            <div id="education-forms">
                                <div class="row mb-3 education-row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Level</label>
                                            <select name="level[]" class="form-control">
                                                <option value="" selected disabled>-- Choose Level --</option>
                                                <option value="D3">D3</option>
                                                <option value="D4">D4</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Degree</label>
                                            <input type="text" class="form-control" name="degree[]"
                                                value="">
                                            @error('degree')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="">University</label>
                                            <input type="text" class="form-control" name="university[]"
                                                value="">
                                            @error('university')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <br>
                                            <button type="button" class="btn btn-primary add-education-row"><i
                                                    class="fas fa-plus"></i></button>
                                            <button type="button" class="btn btn-danger remove-education-row d-none"><i
                                                    class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h5>Course</h5>
                            <hr>
                            <div id="course-forms">
                                <div class="row mb-3 course-row">
                                    <div class="col-lg-11">
                                        <div class="form-group">
                                            <label for="">Courses to Teach</label>
                                            <select name="course_instructor[]" class="form-control course-select">
                                                <option value="" disabled selected>-- Choose Course --</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <br>
                                            <button type="button" class="btn btn-primary add-course-row"><i
                                                    class="fas fa-plus"></i></button>
                                            <button type="button" class="btn btn-danger remove-course-row d-none"><i
                                                    class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>



                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $(document).on('click', '.add-education-row', function() {
            var educationRow = $('.education-row:first').clone();
            educationRow.find('input').val(''); // Clear input values
            educationRow.find('.add-education-row').addClass('d-none');
            educationRow.find('.remove-education-row').removeClass('d-none');
            $('#education-forms').append(educationRow);
        });

        $(document).on('click', '.remove-education-row', function() {
            $(this).closest('.education-row').remove();
        });
    });

    $(document).ready(function() {
        function updateCourseOptions() {
            // Get selected course ids
            var selectedCourses = [];
            $('.course-select').each(function() {
                var selectedValue = $(this).val();
                if (selectedValue) {
                    selectedCourses.push(selectedValue);
                }
            });

            // Update options for each course select
            $('.course-select').each(function() {
                var currentSelect = $(this);
                currentSelect.find('option').each(function() {
                    var optionValue = $(this).val();
                    if (selectedCourses.includes(optionValue) && optionValue != currentSelect.val()) {
                        $(this).prop('disabled', true);
                    } else {
                        $(this).prop('disabled', false);
                    }
                });
            });
        }

        $(document).on('change', '.course-select', function() {
            updateCourseOptions();
        });

        $(document).on('click', '.add-course-row', function() {
            var courseRow = $('.course-row:first').clone();
            courseRow.find('select').val(''); // Clear selected value
            courseRow.find('.add-course-row').addClass('d-none');
            courseRow.find('.remove-course-row').removeClass('d-none');
            $('#course-forms').append(courseRow);
            updateCourseOptions();
        });

        $(document).on('click', '.remove-course-row', function() {
            $(this).closest('.course-row').remove();
            updateCourseOptions();
        });

        updateCourseOptions(); // Initial call to update options
    });
</script>
@endsection
