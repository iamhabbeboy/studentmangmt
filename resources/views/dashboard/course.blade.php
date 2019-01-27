<script>
	function showHide(event) {
		const addcourse = document.querySelector('#add-course');
		const listcourse = document.querySelector('#show-list');
		const headline = document.querySelector('#headline');

		if (addcourse.style.display == 'block') {
			addcourse.style.display = 'none';
			listcourse.style.display = 'block';
			headline.innerText = "Courses";
			event.srcElement.innerText = "Add Course"
		} else {
			addcourse.style.display = 'block';
			listcourse.style.display = 'none';
			headline.innerText = "Add Course";
			event.srcElement.innerText = "View Courses"
		}
	}
</script>
<div class="card-header">Course Management</div>
<div class="card-body">
	<div>
		<h4 id="headline">Add Course </h4>

		<hr>
	<span class="float-right">
			<a href="#" onclick="showHide(event)">Add Course </a>
		</span>
			@if (Session::has('msg'))
				<div class="alert alert-info">{{Session('msg')}}</div>
			@endif
		<div id="add-course" style="display: none">
		<form method="post" action="/add-course">
			@csrf
			<div class="form-group">
				<label>Level</label>
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
					<option value="first">first</option>
					<option value="second">second</option>
				</select>
			</div>
			<div class="form-group">
				<label>Course Title</label>
				<input class="form-control" type="text" name="title" required>
			</div>
			<div class="form-group">
				<label>Course Code</label>
				<input class="form-control" type="text" name="code" required>
			</div>
			<div class="form-group">
				<label>Course Unit</label>
				<input class="form-control" type="number" name="unit" required>
			</div>
			<div class="form-group">
				<button class="btn-primary btn btn-lg">Submit</button>
			</div>
		</form>
		</div>
		<div id="show-list">
			@if (count($courses) > 0)
			{{-- {{dd($courses)}} --}}
				<table class="table">
					<tr>
						<th>#</th>
						<th>Level</th>
						<th>Semester</th>
						<th>Title</th>
						<th>Code</th>
						<th>Unit</th>
						<th>Date</th>
					</tr>
				@foreach($courses as $key => $course)
					<tr>
						<td>{{$key+1}}</td>
						<td>year {{array_get($course, 'level')}}</td>
						<td>{{array_get($course, 'semester')}}</td>
						<td>{{array_get($course, 'has_course_info.title')}}</td>
						<td>{{array_get($course, 'has_course_info.code')}}</td>
						<td>{{array_get($course, 'has_course_info.unit')}}</td>
						<td>{{array_get($course, 'has_course_info.created_at')}}</td>
					</tr>
				@endforeach
			@endif
		</div>
	</div>
</div>