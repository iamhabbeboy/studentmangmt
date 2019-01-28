
<div class="card-header">Payment History</div>
<div class="card-body">

	@if (Session::has('status'))
		<div class="alert alert-info">{{Session('status')}}</div>
	@endif
	@if (count($students) > 0)

		<table class="table table-striped">
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Date</th>
				<th>Option</th>
			</tr>
		@foreach($students as $key => $student)
			<form id="applicantForm" method="post" action="/applicant">@csrf
			<input type="hidden" value="{{$student->id}}" name="student_id">
			<tr>
				<td>{{$key+1}}</td>
				<td>{{ $student->name}}</td>
				<td>{{ $student->email}}</td>
				<td>{{$student->phone}}</td>
				<td>{{$student->created_at->diffForHumans()}}</td>
				<td>
					<select name="option" style="width: 50px">
						<option value="">select</option>
						<option value="1" {{$student->status == '1' ? 'selected': ''}}>approve</option>
						<option value="0" {{$student->status != '1' ? 'selected': ''}}>disapprove</option>
					</select>
					<button id="btnsubmit" data-id="{{$student->id}}">ok</button>
				</td>
			</tr></form>
		@endforeach
	</table>
	@endif
</div>

<script>

</script>