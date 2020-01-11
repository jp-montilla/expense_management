@extends('layout')

@section('mainContent')

<div style="margin: 20px;">
	<label class="title">Roles<span class="sub_title" style="float: right;">Dashboard</span></label>
</div>

<div class="modal fade" id="roleAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addform" method="POST">
      	<div class="modal-body">
      		{{ csrf_field() }}
		  <div class="form-group">
		    <label>Display Name</label>
		    <input type="text" name="name" class="form-control">
		  </div>
		  <div class="form-group">
		    <label>Description</label>
		    <input type="text" name="description" class="form-control">
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
      <th scope="col">Display Name</th>
      <th scope="col">Description</th>
      <th scope="col">Created at</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($roles as $role)
	    <tr>
	      <td>{{ $role->id }}</td>
	      <td><a href="#" class="editBtn">{{ $role->name }}</a></td>
	      <td>{{ $role->description }}</td>
	      <td>{{ $role->created_at }}</td>
	    </tr>
    @endforeach
  </tbody>
</table>

<hr>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#roleAddModal">
  Add Role
</button>


<!-- EDIT ROLE MODAL -->
<div class="modal fade" id="roleEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
		    <label>Display Name</label>
		    <input type="text" name="name" id="name" class="form-control">
		  </div>
		  <div class="form-group">
		    <label>Description</label>
		    <input type="text" name="description" id="description" class="form-control">
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
				url: "/roleadd",
				data: $('#addform').serialize(),
				success: function (response){
					console.log(response)
					$('#roleAddModal').modal('hide')
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
			$('#roleEditModal').modal('show');

			$tr = $(this).closest('tr');
			var data = $tr.children("td").map(function(){
				return $(this).text();
			}).get();
			console.log(data);

			$('#id').val(data[0]);
			$('#name').val(data[1]);
			$('#description').val(data[2]);
			$('#form_delete_btn').attr('action', '/roledelete/'+data[0]);
		});

		$('#editformID').on('submit', function(e){
			e.preventDefault();

			var id = $('#id').val();
			$.ajax({
				type: "PUT",
				url: "/roleupdate/"+id,
				data: $('#editformID').serialize(),
				success: function (response){
					console.log(response)
					$('#roleEditModal').modal('hide')
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