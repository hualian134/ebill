    
<script> 
const handlePaymentPostMessages = ({ data }) => {
	const { paymentResult } = data;
	if (paymentResult) {
		const { respCode, respDesc, respData } = paymentResult;

		//CODE HERE 
		alert(respCode+': '+respDesc+': '+respData);
		if(respCode == '2000'){
			alert("payment completed");
			window.location.replace("./thankyou.html"); 
		}
		if(respCode == '1001'){
			alert("redirect to continue payment");
			window.location.replace(respData); 
		}
	}
};
// Subscribe on post messages
window.addEventListener('message', handlePaymentPostMessages);
</script>

<span>V4 Payment Page on iFrame</span> <br/>  
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<span>V4 URL:</span> <input type="text" name="url" style="width:600px;" value="https://sandbox-pgw-ui.2c2p.com/payment/4.1/#/token/kSAops9Zwhos8hSTSeLTUU0WFFpBjc19mS5csybD4Fx7tSNfeh1ydc1sQYQM7ikDf6QM%2fZ5Puc2LvVt2heZCKvm30bGvJBDvRWUWJnccJV8%3d">
	<input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
	$url = $_POST['url'];
	if (!empty($url)) {  
		echo '<iframe name="output_frame" id="output_frame" src="'.$url.'"  width="800" height="600"></iframe>';
	}
}
?>


