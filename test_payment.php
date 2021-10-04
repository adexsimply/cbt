<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form >
  <script src="https://js.paystack.co/v1/inline.js"></script>
  <button type="button" onclick="payWithPaystack()"> Pay </button> 
</form>
</body>
</html>
 
<script>
  function payWithPaystack(){
    var handler = PaystackPop.setup({
      key: 'pk_live_684f4b87fde853028c72bf0c018d345a6191cd0a',
      email: 'csmtschools@gmail.com',
      amount: 30000,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                display_name: "CSMT SCHOOLS",
                variable_name: "mobile_number",
                value: "+2348012345678"
            }
         ]
      },
      callback: function(response){
          alert('success. transaction ref is ' + response.reference);
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }

</script>