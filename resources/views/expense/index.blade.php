@extends('layout')

@section('mainContent')

<div style="margin: 20px;">
	<label class="title">Expenses<span class="sub_title" style="float: right;">Dashboard</span></label>
</div>

<div class="modal fade" id="expenseAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Expenses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addform" method="POST">
      	<div class="modal-body">
      		{{ csrf_field() }}

      	  <div class="form-group">
		    <label>Expense Category</label>
		    <select class="form-control" name="expense_category">
		    	@foreach($category as $category)
			  		<option value="{{ $category->name }}">{{ $category->name }}</option>
			  	@endforeach
			</select>
		  </div>

		  <div class="form-group">
		    <label>Amount</label>
		    <input type="number" min="1" name="amount" class="form-control">
		  </div>
		  <div class="form-group">
		    <label>Entry date</label>
		    <input type="date" name="entry_date" class="form-control">
		  </div>
		  <input type="hidden" name="user_id" value="{{ Auth::id() }}" class="form-control">
		  
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
      <th scope="col">Expense Category</th>
      <th scope="col">Amount</th>
      <th scope="col">Entry Date</th>
      <th scope="col">Created at</th>
    </tr>
  </thead>
  <tbody>
    @foreach($expenses as $expense)
	    <tr>
	      <td>{{ $expense->id }}</td>
	      <td><a href="#" class="editBtn">{{ $expense->expense_category }}</a></td>
	      <td>{{ $expense->amount }}</td>
	      <td>{{ $expense->entry_date }}</td>
	      <td>{{ $expense->created_at }}</td>
	    </tr>
    @endforeach
  </tbody>
</table>

<hr>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#expenseAddModal">
  Add Expenses
</button>


<!-- EDIT ROLE MODAL -->
<div class="modal fade" id="expenseEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Expenses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editformID">
      	<div class="modal-body">
      		{{ csrf_field() }}
      		{{ method_field('PUT') }}

      		<div class="form-group">
			    <label>Expense Category</label>
			    <select class="form-control" id="expense_category" name="expense_category">
			    	@foreach($category_edit as $category)
				  		<option value="{{ $category->name }}">{{ $category->name }}</option>
				  	@endforeach
				</select>
			</div>

      		
		  <div class="form-group">
		    <label>Amount</label>
		    <input type="number" min="1" id="amount" name="amount" class="form-control">
		  </div>
		  <div class="form-group">
		    <label>Entry date</label>
		    <input type="date" id="entry_date" name="entry_date" class="form-control">
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
				url: "/expenseadd",
				data: $('#addform').serialize(),
				success: function (response){
					console.log(response)
					$('#expenseAddModal').modal('hide')
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
			$('#expenseEditModal').modal('show');

			$tr = $(this).closest('tr');
			var data = $tr.children("td").map(function(){
				return $(this).text();
			}).get();
			console.log(data);

			$('#id').val(data[0]);
			$('#expense_category').val(data[1]);
			$('#amount').val(data[2]);
			$('#entry_date').val(data[3]);
			$('#form_delete_btn').attr('action', '/expensedelete/'+data[0]);
		});

		$('#editformID').on('submit', function(e){
			e.preventDefault();

			var id = $('#id').val();
			$.ajax({
				type: "PUT",
				url: "/expenseupdate/"+id,
				data: $('#editformID').serialize(),
				success: function (response){
					console.log(response)
					$('#expenseEditModal').modal('hide')
					alert("Data Updated");
					location.reload();
				},
				error: function(error){
					console.log(error)
					alert("Data not saved!");
				}
			});
		});
	});
</script>


@endsection