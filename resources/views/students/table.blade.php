<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CRUD->R|List of Student</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show py-2 px-3 small mb-2" role="alert" style="max-width: 400px;">
    {{ session('success') }}
    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
    
    <h2 class="mb-2 mb-md-0">Student Table</h2>
    <a href="{{ URL::to('add') }}"><button class="btn btn-success">+ Add</button></a>
  </div>

  <div class="table-responsive">
    <table id="userTable" class="table table-striped align-middle">
      <thead class="table-dark">
        <tr>
          <th>SN</th>
          <th>Image</th>
          <th>Name</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>Father</th>
          <th>Mother</th>
          <th>State</th>
          <th>District</th>
          <th>
            <input type="text" id="globalSearch" class="form-control form-control-sm" placeholder="Search...">
          </th>
        </tr>
      </thead>
      <tbody>

        @php
            $sn=1;
        @endphp
        @foreach ($students as $student )
        <tr>
          <td>{{$sn++}}</td>
          <td><img src="{{ asset('uploads/' . $student->image) }}" class="rounded" 
     style="width: 80px; height: 80px; object-fit: cover;"></td>
          <td>{{$student->name}}</td>
          <td>{{$student->email}}</td>
          <td>{{$student->mobile}}</td>
          <td>{{$student->father}}</td>
          <td>{{$student->mother}}</td>
          <td>{{$student->state}}</td>
          <td>{{$student->district}}</td>
          <td>
            <a href="{{ 'edit/'.$student->id }}"><button class="btn btn-sm btn-primary me-1">Edit</button></a>
            <a href="{{ 'delete/'.$student->id }}"><button class="btn btn-sm btn-danger">Delete</button></a>
          </td>
        </tr>
            
        @endforeach
        
       
      </tbody>
    </table>
  </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Global Search Script -->
<script>
document.getElementById('globalSearch').addEventListener('input', function () {
  const filter = this.value.toLowerCase();
  const rows = document.querySelectorAll('#userTable tbody tr');

  rows.forEach(row => {
    const rowText = row.textContent.toLowerCase();
    row.style.display = rowText.includes(filter) ? '' : 'none';
  });
});
</script>
</body>
</html>
