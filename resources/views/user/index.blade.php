@extends('layout')

@section('mainContent')

<div style="margin: 20px;">
	<label class="title">User<span class="sub_title" style="float: right;">Dashboard</span></label>
</div>

<div class="modal fade" id="userAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addform" method="POST">
      	<div class="modal-body">
      		{{ csrf_field() }}
		  <div class="form-group">
		    <label>Name</label>
		    <input type="text" name="name" class="form-control">
		  </div>
		  <div class="form-group">
		    <label>Email Address</label>
		    <input type="email" name="email" class="form-control">
		  </div>
		  <div class="form-group">
		    <label>Role</label>
		    <select class="form-control" name="role">
		    	@foreach($roles as $role)
			  		<option value="{{ $role->name }}">{{ $role->name }}</option>
			  	@endforeach
			</select>
		  </div>
		  
      	</div>
	    <div class="modal-footer">
	    	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	    	<button type="submit" class="btn btn-primary">Save</button>
	    </div>
      </form>

    </div>
  </div>
</div>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Role</th>
      <th scope="col">Created at</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($users as $user)
	    <tr>
	      <td>{{ $user->id }}</td>
	      
		      @if($user->role == 'Administrator')
		      	<td>{{ $user->name }}</td>
		      @else
		      	<td><a href="#" class="editBtn">{{ $user->name }}</a></td>
		      @endif
	      
	      <td>{{ $user->email }}</td>
	      <td>{{ $user->role }}</td>
	      <td>{{ $user->created_at }}</td>
	    </tr>
    @endforeach
  </tbody>
</table>

<hr>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userAddModal">
  Add Role
</button>


<!-- EDIT ROLE MODAL -->
<div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editformID">
      	<div class="modal-body">
      		{{ csrf_field() }}
      		{{ method_field('PUT') }}
      		<input type="hidden" name="id" id="id">
		  <div class="form-group">
		    <label>Name</label>
		    <input type="text" name="name" id="name" class="form-control">
		  </div>
		  <div class="form-group">
		    <label>Email</label>
		    <input type="text" name="email" id="email" class="form-control">
		  </div>
		  <div class="form-group">
		    <label>Role</label>
		    <select class="form-control" id="role" name="role">
		    	@foreach($roles as $role)
			  		<option value="{{ $role->name }}">{{ $role->name }}</option>
			  	@endforeach
			</select>
		  </div>
		  <button type="submit" class="btn btn-primary">Update</button>
      	</div>
      </form>
	    <div class="modal-footer">
	    	<form id="form_delete_btn" action="" method="post">
	    		{{ csrf_field() }}
      			{{ method_field('DELETE') }}
      			<input type="hidden" name="id" id="id">
      			<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" >Delete</button>
	    	</form>
	    	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	    	
	    </div>
     

    </div>
  </div>
</div>


<script>
	$(document).ready(function(){

		$('#addform').on('submit',function(e){
			e.preventDefault();

			$.ajax({
				type: "POST",
				url: "/useradd",
				data: $('#addform').serialize(),
				success: function (response){
					console.log(response)
					$('#userAddModal').modal('hide')
					alert("Data Saved");
					location.reload();
				},
				error: function(error){
					console.log(error)
					alert("Data not saved!");
				}
			});
		});


		$('.editBtn').on('click',function(){
			$('#userEditModal').modal('show');

			$tr = $(this).closest('tr');
			var data = $tr.children("td").map(function(){
				return $(this).text();
			}).get();
			console.log(data);

			$('#id').val(data[0]);
			$('#name').val(data[1]);
			$('#email').val(data[2]);
			$('#role').val(data[3]);
			$('#form_delete_btn').attr('action', '/userdelete/'+data[0]);
		});

		$('#editformID').on('submit', function(e){
			e.preventDefault();

			var id = $('#id').val();
			$.ajax({
				type: "PUT",
				url: "/userupdate/"+id,
				data: $('#editformID').serialize(),
				success: function (response){
					console.log(response)
					$('#userEditModal').modal('hide')
					alert("Data Updated");
					location.reload();
				},
				error: function(error){
					console.log(error)
				}
			});
		});
	});
</script>


@endsection