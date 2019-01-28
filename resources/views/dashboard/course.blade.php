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
		<div class="clearfix"></div>
			@if (Session::has('msg'))
				<div class="alert alert-info">{{Session('msg')}}</div>
			@endif
			@if (Session::has('update_msg'))
				<div class="alert alert-info">{{Session('update_msg')}}</div>
			@endif
		<div id="add-course"
			@if(array_get($_GET, 'edit') == 'true')
				style="display: block"
			@endif
			style="display: none">
		<form method="post" action="/add-course">
			@csrf
			<input type="hidden" value="{{array_get($_GET, 'id')}}" name="course_id">
			<div class="form-group">
				<label>Level</label>
				<select class="form-control" name="level" required>
					<option value="">select</option>
					<option value="1" {{(array_get($_GET, 'level') == '1') ? 'selected' : ''}}>1</option>
					<option value="2" {{(array_get($_GET, 'level') == '2') ? 'selected' : ''}}>2</option>
					<option value="3" {{(array_get($_GET, 'level') == '3') ? 'selected' : ''}}>3</option>
					<option value="4" {{(array_get($_GET, 'level') == '4') ? 'selected' : ''}}>4</option>
					<option value="5" {{(array_get($_GET, 'level') == '5') ? 'selected' : ''}}>5</option>
				</select>
			</div>
			<div class="form-group">
				<label>Semester</label>
				<select class="form-control" name="semester" required>
					<option value="">select</option>
					<option value="first" {{(array_get($_GET, 'semester') == 'first') ? 'selected' : ''}}>first</option>
					<option value="second" {{(array_get($_GET, 'semester') == 'second') ? 'selected' : ''}}>second</option>
				</select>
			</div>
			<div class="form-group">
				<label>Course Title</label>
				<input class="form-control" type="text" name="title" required value="{{array_get($_GET, 'title')}}">
			</div>
			<div class="form-group">
				<label>Course Code</label>
				<input class="form-control" type="text" name="code" required value="{{array_get($_GET, 'code')}}">
			</div>
			<div class="form-group">
				<label>Course Unit</label>
				<input class="form-control" type="number" name="unit" required value="{{array_get($_GET, 'unit')}}">
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
						<th>Option</th>
					</tr>
				@foreach($courses as $key => $course)
					<tr>
						<td>{{$key+1}}</td>
						<td>year {{$course->level}}</td>
						<td>{{$course->semester}}</td>
						<td>{{$course->hasCourseInfo->title}}</td>
						<td>{{$course->hasCourseInfo->code}}</td>
						<td>{{$course->hasCourseInfo->unit}}</td>
						<td>{{$course->hasCourseInfo->created_at->diffForHumans()}}</td>
						<td><a href="?p=course&edit=true&id={{$course->id}}&level={{$course->level}}&semester={{$course->semester}}&title={{$course->hasCourseInfo->title}}&code={{$course->hasCourseInfo->code}}&unit={{$course->hasCourseInfo->unit}}"><small>edit</small></a>&nbsp;
						<a href="/course/{{$course->id}}"><small>delete</small></a></td>
					</tr>
				@endforeach
			</table>
			@endif
		</div>
	</div>
</div>