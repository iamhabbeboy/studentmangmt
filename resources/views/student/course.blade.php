
<h3>Course Registration</h3>
	<div class="noprint">
		<form method="post" action="/account/fetch-course">
			@csrf
			<div class="form-group">
				<label>Year</label>
				<select class="form-control" name="level" required>
					<option value="">select</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>
			<div class="form-group">
				<label>Semester</label>
				<select class="form-control" name="semester" required>
					<option value="">select</option>
					<option value="first">First</option>
					<option value="second">Second</option>
				</select>
			</div>
			<div class="form-group">
				<button class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
		<div>
			<form method="post" action="/account/course-register">
				@csrf
			@if(Session::has('data'))
			{{-- {{dd(Session('data'))}} --}}
			@if (count(Session('data')) > 0)
				<table class="table table-striped">
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Course code</th>
					<th>Course Unit</th>
				</tr>
				{{-- {{dd(count(array_get(Session('data'), 'has_course_info')))}} --}}

					@foreach(Session('data') as $key => $course)
						<tr>
							<td>
								<input type="checkbox" name="course[]" value="{{array_get($course, 'has_course_info.code')}}_{{array_get($course, 'has_course_info.id')}}_{{array_get($course, 'level')}}_{{array_get($course, 'semester')}}">
							</td>
							<td>{{array_get($course, 'has_course_info.title')}}</td>
							<td>{{array_get($course, 'has_course_info.code')}}</td>
							<td>{{array_get($course, 'has_course_info.unit')}}</td>
						</tr>
					@endforeach
					<tr>
						<td colspan="3"></td>
						<td >
							<button class="btn btn-success btn-lg">Register</button>
						</td>
					</tr>

			</table>
		</form>
			@else
					<div class="alert alert-info">No Course available for this semester</div>
				@endif
			@endif

			@if(Session::has('msg'))
				<div class="alert-info alert">{{Session('msg')}} <a href="/account/dashboard?p=registered">click to view</a></div>
			@endif
		</div>