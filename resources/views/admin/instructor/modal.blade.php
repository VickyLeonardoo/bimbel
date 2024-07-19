{{-- Start Modal for Instructor Education --}}
<div class="modal text-left" id="modalEducation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6"
    aria-hidden="true">
    <div class="modal-lg modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel6">Add Education to Instructor</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('admin.instructor.edit.add.education', $instructor->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Level</label>
                        <select class="form-control" name="level">
                            <option value="D3" {{ old('level') == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ old('level') == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ old('level') == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ old('level') == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Degree</label>
                        <input type="text" class="form-control" name="degree" value="{{ old('degree') }}">
                        @error('degree')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">University</label>
                        <input type="text" class="form-control" name="university" value="{{ old('university') }}">
                        @error('university')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Accept</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal For Instructor --}}


{{-- Start Modal for Course --}}
<div class="modal text-left" id="modalCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6"
    aria-hidden="true">
    <div class="modal-lg modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel6">Add Course to Instructor</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('admin.instructor.edit.add.course', $instructor->id) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Course</label>
                        <select class="form-control" name="course_id">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Accept</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal for Course --}}


{{-- Modal for Delete Course --}}

@foreach ($instructor->courses as $course)
<div class="modal fade text-left" id="deleteCourse_{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title white" id="myModalLabel120">Delete Course
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                Do you really want to delete <strong>{{ $course->name }}</strong> course?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <a href="{{route('admin.instructor.delete.course',$course->id)}}')}}" type="button" class="btn btn-danger ms-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Yes, Delete it!.</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($instructor->educationDetails as $education)
<div class="modal fade text-left" id="deleteEducation_{{$education->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title white" id="myModalLabel120">Delete Education
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                Do you really want to delete <strong>{{ $education->name }}</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <a href="{{route('admin.instructor.delete.education',$education->id)}}" class="btn btn-danger ms-1" >
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Yes, Delete it!.</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- End Modal for Delete Course --}}
