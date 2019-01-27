<h3>Course Registered</h3>

<form method="post" action="/account/retrieve-registered">
	@csrf
<div class="alert alert-info">
	<label> Level </label> &nbsp;
	<select class="" name="level">
		<option>select</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
	</select>

	&nbsp;
	<label>Semester</label> &nbsp;
	<select name="semester">
		<option value="">select</option>
		<option value="first">first</option>
		<option value="second">second</option>
	</select>
	&nbsp;
	<button class="btn btn-primary btn-sm" type="submit">Preview</button>
</div>
</form>
@if (Session::has('couresesData'))

	<a href="javascript:window.print()">[click to print]</a>
	<h5>Year: {{Session('level')}}</h5>
  <b>Semester: {{Session('semester')}}</b>
  @php $total = 0 @endphp
  <table class="table table-bordered">
  	<tr>
  		<th>#</th>
  		<th>Title</th>
  		<th>Course Code</th>
  		<th>Course Unit</th>
  	</tr>
  	@foreach(Session('couresesData') as $key => $course)
  		@php $total = $total + (int) array_get($course, 'has_course.unit') @endphp
	    <tr>
	    	<td>{{$key+1}}</td>
	      <td>{{array_get($course, 'has_course.title')}}</td>
	      <td>{{array_get($course, 'has_course.code')}}</td>
	      <td>{{array_get($course, 'has_course.unit')}}</td>
	    </tr>
    @endforeach
    	<tr>
    		<th colspan="2"></th>
    		<th>Total Unit</th>
    		<th> {{$total}}</th>
    	</tr>
     </table>
@else
	<div class="alert alert-info">No Course added yet </div>
@endif
{{-- @if (count($courses) > 0) --}}

{{--   @foreach($courses as $course)


@else
 <div class="alert alert-info">No course added</div>
@endif --}}