<h3>Payment</h3>
				<p></p>

<script src="https://js.paystack.co/v1/inline.js"></script>
<div id="paystackEmbedContainer"></div>
<input type="hidden" value="{{array_get(session('student_data'), 'email')}}" id="modelData">
<input type="hidden" value="{{Session::token()}}" name="_token" id="_token">

<script>
const amount = 10000;
const student_id = document.querySelector('#modelData').value;
const token = document.querySelector('#_token').value;
  PaystackPop.setup({
   key: 'pk_test_921b44437d7f83f8591c9d1908e30899ce813661',
   email: 'abiodun.solomon.a@gmail.com',
   amount: amount,
   container: 'paystackEmbedContainer',
   callback: function(response){
   		const data = {
        amount : amount,
        ref: response.reference,
        student_id: student_id,
        _token: token
      };
      $.ajax({
        url: '/account/payment',
        data: data,
        method: 'POST'
      }).then(function(response) {
        alert('Payment made successfully')
        window.location = '/account/dashboard?p=course';
      }).catch(function(err) {
        alert('Error occured');
      });
    },
  });
</script>