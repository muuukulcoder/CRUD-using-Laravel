<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0/dist/css/bootstrap-select.min.css" />
    <style>
        body {
            min-height: 100vh;
            /* background: linear-gradient(135deg, black,rgb(215, 114, 14), white); */
            color: white;
        }

        .form-container {
            max-width: 600px;
            margin: 2rem auto;
            background: rgba(34, 10, 245, 1);
            padding: 2rem;
            border-radius: 8px;
        }

        img#preview {
            max-width: 150px;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="container form-container">
        <h2 class="text-center mb-4"> Update Student Information</h2>
        <form action="/update-student/{{ $data->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Student Name</label>
                <input type="text" class="form-control" value="{{ $data->name }}" name="name" />
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" value="{{ $data->email }}" name="email" />
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="tel" class="form-control" name="mobile" value="{{ $data->mobile }}"
                    pattern="[0-9]{10}" maxlength="10" />
                @error('mobile')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Father's Name</label>
                <input type="text" class="form-control" value="{{ $data->father }}" name="father" />

            </div>
            <div class="mb-3">
                <label class="form-label">Mother's Name</label>
                <input type="text" class="form-control" name="mother" value="{{ $data->mother }}" />

            </div>
            <div class="row mb-3">

                <div class="mb-3">
                    <label class="form-label">Profile Photo</label>
                    <input class="form-control" type="file" accept="image/*" id="photoUpload" name="image" />
                    <div class="invalid-feedback">Upload a profile image.</div>
                    <img id="preview" src="#" alt="Preview" hidden />
                    {{-- Display validation error --}}
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-center">

                    <button type="submit" class="btn btn-light w-50 ">Update</button>
                </div>
                <div class="d-flex justify-content-center"><a href="{{ URL::to('/list') }}" class="text-white">back</a>
                </div>
        </form>
    </div>

    <!-- JS: Bootstrap, selectpicker, jQuery, validation, state/district data -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('js/statedist.js') }}"></script>
    <script language="javascript">
        populateStates("state_input", "district_input");
    </script>

</body>

</html>
