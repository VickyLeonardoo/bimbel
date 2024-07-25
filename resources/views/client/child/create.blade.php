@extends('partials.client.header')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="box mb-5">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ route('client.profile') }}"
                                class=" btn form-control btn-outline-primary mb-3 {{ Route::is('client.*') ? 'active' : '' }}">Profile</a>
                            <a href="{{ route('client.transaction') }}" class=" btn form-control btn-outline-primary">Transaction</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                {{-- <form action="" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    value="{{ old('name') }}" placeholder="">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">School Name</label>
                                <input type="text" name="school"
                                    class="form-control {{ $errors->has('school') ? 'is-invalid' : '' }}"
                                    value="{{ old('name') }}" placeholder="">
                                @error('school')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Birthday</label>
                                <input type="date" name="birthday"
                                    class="form-control {{ $errors->has('birthday') ? 'is-invalid' : '' }}"
                                    value="{{ old('name') }}" placeholder="">
                                @error('birthday')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Class</label>
                                <input type="text" name="class"
                                    class="form-control {{ $errors->has('class') ? 'is-invalid' : '' }}"
                                    value="{{ old('name') }}" placeholder="">
                                @error('class')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>

                    <button class="mt-2 btn btn-primary"><i class="fas fa-plus"></i> Add More</button>
                </form> --}}

                <form action="{{ route('client.store_children') }}" method="POST">
                    @csrf
                    <div id="card-container">
                        <!-- Loop through old input values to recreate the cards -->
                        @if(old('name'))
                            @foreach(old('name') as $index => $name)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" name="name[]" class="form-control {{ $errors->has('name.' . $index) ? 'is-invalid' : '' }}" value="{{ old('name.' . $index) }}" placeholder="">
                                            @if($errors->has('name.' . $index))
                                                <small class="text-danger">{{ $errors->first('name.' . $index) }}</small>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="school">School Name</label>
                                            <input type="text" name="school[]" class="form-control {{ $errors->has('school.' . $index) ? 'is-invalid' : '' }}" value="{{ old('school.' . $index) }}" placeholder="">
                                            @if($errors->has('school.' . $index))
                                                <small class="text-danger">{{ $errors->first('school.' . $index) }}</small>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="bod">Birth of Date</label>
                                            <input type="date" name="bod[]" class="form-control {{ $errors->has('bod.' . $index) ? 'is-invalid' : '' }}" value="{{ old('bod.' . $index) }}" placeholder="">
                                            @if($errors->has('bod.' . $index))
                                                <small class="text-danger">{{ $errors->first('bod.' . $index) }}</small>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="class">Class</label>
                                            <input type="text" name="class[]" class="form-control {{ $errors->has('class.' . $index) ? 'is-invalid' : '' }}" value="{{ old('class.' . $index) }}" placeholder="">
                                            @if($errors->has('class.' . $index))
                                                <small class="text-danger">{{ $errors->first('class.' . $index) }}</small>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-danger remove-card"><i class="fas fa-minus"></i> Remove</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Initial card -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name[]" class="form-control" value="{{ old('name') }}" placeholder="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="school">School Name</label>
                                        <input type="text" name="school[]" class="form-control" value="{{ old('school') }}" placeholder="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="bod">Birth of Date</label>
                                        <input type="date" name="bod[]" class="form-control" value="{{ old('bod') }}" placeholder="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="class">Class</label>
                                        <input type="text" name="class[]" class="form-control" value="{{ old('class') }}" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger remove-card"><i class="fas fa-minus"></i> Remove</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                
                    <button type="submit" class="mt-2 btn btn-primary">Submit</button>
                    <button type="button" class="mt-2 btn btn-success add-card"><i class="fas fa-plus"></i> Add More</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        function updateRemoveButtons() {
            var cardCount = $("#card-container .card").length;
            if (cardCount > 1) {
                $(".remove-card").show();
            } else {
                $(".remove-card").hide();
            }
        }

        // Initial check
        updateRemoveButtons();

        // Add Card Functionality
        $(".add-card").click(function() {
            var newCard = $("#card-container .card:first").clone();
            newCard.find('input').val(''); // Clear input values
            $("#card-container").append(newCard);
            updateRemoveButtons();
        });

        // Remove Card Functionality
        $(document).on("click", ".remove-card", function() {
            if ($("#card-container .card").length > 1) {
                $(this).closest(".card").remove();
                updateRemoveButtons();
            }
        });
    });
</script>
@endsection