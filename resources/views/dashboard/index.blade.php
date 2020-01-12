@extends('layout')

@section('mainContent')

	<div class="row">
		<div class="col-6">
			<div class="row">
				<div class="col-6 text-right">
					<h5>Expense Categories</h5><hr>
					@foreach($category_list as $category)
						<p>{{ $category }}</p>
					@endforeach
				</div>
				<div class="col-6">
					<h5>Total</h5><hr>
					@foreach($expenses_list as $expense)
						<p>$ {{ $expense }}</p>
					@endforeach
				</div>
			</div>
		</div>
		<div class="col-6">
			{!! $chart->container() !!}
		</div>
	</div>
	
	{!! $chart->script() !!}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

@endsection