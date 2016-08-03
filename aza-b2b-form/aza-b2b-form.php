<?php 
 
if ($_POST['submit']) {

	if ($_POST['firstname']) {
		$firstname = $_POST['firstname'];
	}
	if ($_POST['lastname']) {
		$lastname = $_POST['lastname'];
	}
	if ($_POST['email']) {
		$email = $_POST['email'];
	}
	if ($_POST['message']) {
		$message = $_POST['message'];
	}

	// Azalead Company Visitor data
	if ($_POST['aza-companyName']) {
		$companyName = $_POST['aza-companyName'];
	}
	if ($_POST['aza-naceCode']) {
		$naceCode = $_POST['aza-naceCode'];
	}
	if ($_POST['aza-size']) {
		$size = $_POST['aza-size'];
	}
	if ($_POST['aza-legalForm']) {
		$legalForm = $_POST['aza-legalForm'];
	}
	if ($_POST['aza-industry']) {
		$industry = $_POST['aza-industry'];
	}
	if ($_POST['aza-employee']) {
		$employee = $_POST['aza-employee'];
	}
	if ($_POST['aza-website']) {
		$website = $_POST['aza-website'];
	}
	if ($_POST['aza-city']) {
		$city = $_POST['aza-city'];
	}
	if ($_POST['aza-postCode']) {
		$postCode = $_POST['aza-postCode'];
	}
	if ($_POST['aza-country']) {
		$country = $_POST['aza-country'];
	}
	if ($_POST['aza-countryCode']) {
		$countryCode = $_POST['aza-countryCode'];
	}

	// save your data

	// and redirect to form conversion page
	header('Location: form_confirmation.php');
}

?>
<!DOCTYPE HTML>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
.body {
    display:block;
    margin:0 auto;
    width:576px;
    font-family:Helvetica, Arial, sans-serif;
	font-weight:300;
	font-size: 12px;
}
h1 {
    margin:0 auto;
   /* width:450px;*/
    font-family:Helvetica, Arial, sans-serif;
    text-align: center;
    border:none;
    margin-top:20px;
    padding: 20px;
	background:#323b44;
	color:#FFF;
	font-size: 18px;
	font-weight:300;
}
form {
    margin:0 auto;
    width:470px;
    font-family:Helvetica, Arial, sans-serif;
	font-weight:300;
	font-size: 12px;
}

input, textarea {
	width:450px;
	height:23px;
	background:#efefef;
	border:1px solid #dedede;
	padding:5px;
	margin-top:3px;
	color:#3a3a3a;
}

textarea {
	height:130px;
	background:#efefef;
}
label {
    display:block;
    margin-top:20px;
    letter-spacing:2px;
}
input:focus, textarea:focus {
    border:1px solid #97d6eb;
}
#submit {
	margin:0 auto;
    width:127px;
    height:38px;
    border:none;
    margin-top:20px;
	background:#323b44;
	color:#FFF;
}

#submit:hover {
	background:#71808A;
}

</style>
<title>Contact Form</title>
</head>

<body>
<h1>Contact us</h1>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
        
    <label>Firstname</label>
    <input type="text" name="firstname">

    <label>Lastname</label>
    <input type="text" name="lastname">
            
    <label>Email</label>
    <input type="text" name="email" type="email">

    <!-- Azalead company visitor name -->
    <label>Company</label>
    <input type="text" name="aza-companyName">
            
    <label>Message</label>
    <textarea name="message"></textarea>

    <!-- Azalead company visitor data -->
    <input type="hidden" name="aza-nationalId">
    <input type="hidden" name="aza-naceCode">
	<input type="hidden" name="aza-size">
    <input type="hidden" name="aza-legalForm">
    <input type="hidden" name="aza-industry">
    <input type="hidden" name="aza-employee">
	<input type="hidden" name="aza-website">
    <input type="hidden" name="aza-city">
	<input type="hidden" name="aza-postCode">
    <input type="hidden" name="aza-country">
    <input type="hidden" name="aza-countryCode">

    <input id="submit" name="submit" type="submit" value="Submit">     
</form>

<script type="text/javascript">
document.addEventListener('azaCompanyVisitorLoaded', function (e) {
  // Bind your form with Azalead Company Visitor Data
  if (typeof aza_company_visitor !== "undefined") {
    var yourCompanyVisitor = JSON.parse(aza_company_visitor);
	console.log(yourCompanyVisitor.companyName);
    if (yourCompanyVisitor != null && yourCompanyVisitor.companyName != null) {
		document.getElementsByName("aza-companyName")[0].value = yourCompanyVisitor.companyName;
    }
    if (yourCompanyVisitor != null && yourCompanyVisitor.nationalId != null) {
		document.getElementsByName("aza-nationalId")[0].value = yourCompanyVisitor.nationalId;
    }
    if (yourCompanyVisitor != null && yourCompanyVisitor.naceCode != null) {
		document.getElementsByName("aza-naceCode")[0].value = yourCompanyVisitor.naceCode;
    }
    if (yourCompanyVisitor != null && yourCompanyVisitor.size != null) {
		document.getElementsByName("aza-size")[0].value = yourCompanyVisitor.size;
    }
    if (yourCompanyVisitor != null && yourCompanyVisitor.legalForm != null) {
		document.getElementsByName("aza-legalForm")[0].value = yourCompanyVisitor.legalForm;
    }
    if (yourCompanyVisitor != null && yourCompanyVisitor.industry != null) {
		document.getElementsByName("aza-industry")[0].value = yourCompanyVisitor.industry;
    }
    if (yourCompanyVisitor != null && yourCompanyVisitor.employee != null) {
		document.getElementsByName("aza-employee")[0].value = yourCompanyVisitor.employee;
    }
    if (yourCompanyVisitor != null && yourCompanyVisitor.website != null) {
		document.getElementsByName("aza-website")[0].value = yourCompanyVisitor.website;
    }
    if (yourCompanyVisitor != null && yourCompanyVisitor.city != null) {
		document.getElementsByName("aza-city")[0].value = yourCompanyVisitor.city;
    }
    if (yourCompanyVisitor != null && yourCompanyVisitor.country != null) {
		document.getElementsByName("aza-country")[0].value = yourCompanyVisitor.country;
    }
    if (yourCompanyVisitor != null && yourCompanyVisitor.countryCode != null) {
		document.getElementsByName("aza-countryCode")[0].value = yourCompanyVisitor.countryCode;
    }
    if (yourCompanyVisitor != null && yourCompanyVisitor.postCode != null) {
		document.getElementsByName("aza-postCode")[0].value = yourCompanyVisitor.postCode;
    }
  } 
}, false);

</script>
	<!-- script to remove and to replace with your Azalead Tag -->
	<!-- aza_company_visitor mock object for tests -->
	<script src="http://images.azalead.com/developer/js/aza_website_visitor.js"></script>
	<!-- script to remove and to replace with your Azalead Tag --> 
</body>

</html>