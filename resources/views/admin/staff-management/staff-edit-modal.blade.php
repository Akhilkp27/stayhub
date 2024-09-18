<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="row mb-3">
            <img src="{{ asset('storage/' . $data->image_url) }}" alt="Staff Image" class="img-fluid" style="max-width: 150px;">
        </div>
        <div class="row mb-3">
            <!-- First Name -->
            <div class="col-md-6">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="{{$data->first_name}}" placeholder="Enter first name" required>
            </div>
            <!-- Last Name -->
            <div class="col-md-6">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName"  value="{{$data->last_name}}" placeholder="Enter last name">
            </div>
        </div>
        <div class="row mb-3">
            <!-- Email -->
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}" placeholder="Enter email" required>
            </div>
            <!-- Phone -->
            <div class="col-md-6">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="{{$data->phone}}"  placeholder="Enter phone number" required>
            </div>
        </div>
        <div class="row mb-3">
            <!-- Role -->
            <div class="col-md-6">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-control">
                    <option value="" disabled selected>Select Role</option>
                    @foreach ($role as $userRole)
                    <option value="{{ $userRole->id }}" {{ $data->role == $userRole->id ? 'selected' : '' }}>
                        {{ $userRole->role_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <!-- Salary -->
            <div class="col-md-6">
                <label for="salary" class="form-label">Salary</label>
                <div class="input-group">
                    <span class="input-group-text">₹</span>
                    <input type="text" class="form-control" id="salary" name="salary" value="{{$data->salary}}"  placeholder="Enter salary amount" oninput="formatCurrency(this)" required>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <!-- Start Date -->
            <div class="col-md-6">
                <label for="startDate" class="form-label">Start Date</label>
                <input type="date" class="form-control" name="startDate" id="startDate" value="{{$data->start_date}}">
            </div>
            <!-- Status -->
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="active" {{ $data->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $data->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="on_leave" {{ $data->status == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <!-- Address -->
            <div class="col-md-12">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" id="address" class="form-control" cols="30" rows="5"  placeholder="Enter address" required>{{$data->address}}</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-success">Update</button>
    </div>

</form>