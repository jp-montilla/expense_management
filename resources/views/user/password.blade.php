@extends('layout')

@section('mainContent')

		
	<div class="container" style="width: 50%">
		<h1>CHANGE PASSWORD</h1>
		<div>
			<hr>
			<p class="text text-success">{{ $message }}</p>
			<hr>
		</div>
		<form method="POST" action="/update_password/{{Auth::user()->id}}">
			{{ csrf_field() }}
      		{{ method_field('PUT') }}
		  <div class="form-group">
		    <label>Old Password</label>
		    <input type="password" class="form-control" name="old_password" required>
		  </div>
		  <div class="form-group">
		    <label>New Password</label>
		    <input type="password" class="form-control" name="new_password" required>
		  </div>
		  <div class="form-group">
		    <label>Confirm New Password</label>
		    <input type="password" class="form-control" name="confirm_password" required>
		  </div>
		  <button type="submit" class="btn btn-primary">Change Password</button>
		</form>
	</div>



@endsection