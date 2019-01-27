<h3>Receipt</h3>
<a href="#" onclick="window.print()">click to print </a>

@if (count($payments) > 0)

@foreach($payments as $payment)
<table class="table table-bordered">
  <tr>
    <td><small>Date: {{array_get($payment, 'created_at')}}</small></td>
    <td>
      @if (array_get($studentInfo, 'photo'))
          <img src="{{ array_get($studentInfo, 'photo') }}" style="width: 100px;max-width: 100%;">
        @endif
    </td>
  </tr>
  <tr>
    <td colspan="2"> <h2>{{array_get(Session('student_data'), 'name')}}</h2></td>
  </tr>
  <tr>
    <td>Reference No</td>
    <td> {{array_get($payment, 'ref')}}</td>
  </tr>
  <tr>
    <td>Department</td>
    <td>Computer Science</td>
  </tr>
  <tr>
    <td style="height: 200px;">
      <br/><br/>
      <h4>Tuition Fee</h4>
    </td>
    <td>
      <br/><br/>
      <h4>&#8358; {{array_get($payment, 'amount')}}</h4>
    </td>
  </tr>
</table>
@endforeach
@endif