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
        <h2 class="text-center mb-4">Student Information</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Student Name</label>
                <input type="text" class="form-control" name="name" required />

            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" required />

            </div>
            <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="tel" class="form-control" name="mobile" pattern="[0-9]{10}" required />

            </div>
            <div class="mb-3">
                <label class="form-label">Father's Name</label>
                <input type="text" class="form-control" name="father" required />

            </div>
            <div class="mb-3">
                <label class="form-label">Mother's Name</label>
                <input type="text" class="form-control" name="mother" required />

            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="state" class="form-label">State</label>
                    <select class="form-select" id="state_input" name="state" required>

                    </select>


                    <!-- States added via JS -->


                </div>
                <div class="col">
                    <label for="district" class="form-label">District</label>
                    <select class="form-select" name="district" id="district_input" required>

                    </select>

                </div>
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

                    <button type="submit" class="btn btn-light w-50 ">Submit</button>
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
