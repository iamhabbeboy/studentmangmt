
<div class="card-header">Payment History</div>
<div class="card-body">
	@if (count($payments) > 0)
		<table class="table table-striped">
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Amount</th>
				<th>Ref No.</th>
				<th>Date</th>
			</tr>
		@foreach($payments as $key => $payment)
			{{-- {{dd($payment)}} --}}
			<tr>
				<td>{{$key+1}}</td>
				<td>{{array_get($payment, 'has_student.name')}}</td>
				<td>{{array_get($payment, 'has_student.email')}}</td>
				<td>{{array_get($payment, 'has_student.phone')}}</td>
				<td>{{array_get($payment, 'amount')}}</td>
				<td>{{array_get($payment, 'ref')}}</td>
				<td>{{array_get($payment, 'created_at')}}</td>
			</tr>
		@endforeach
	@endif
</div>