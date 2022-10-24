<?php
// require_once('../lib/basic-function.php');
// require_once('../../admin-functn.php');
class Email_Sys extends DBController
{

	protected $sitename = 'Tech Acoustic';
	protected $site_email = 'michaelson@techac.net';

	public function send_download_link($cust_email, $payment_txn_id)
	{
		// cust_email,payment_txn_id, 
		$cart = []; //$this->gen_product_link_for_email($payment_txn_id);
		foreach ($cart as $e_cart) {
			if ($e_cart['error'] == 1) {
				return ['error' => 1, 'msg' => 'System error. Please, if error persists kindly contact your administrator!'];
			}
		}
		$to = $cust_email;
		$cust_detail = $this->selectAllWhere($this->customer_detail_tb, 'email_address', $cust_email);
		$subject = 'Product Download Links';
		$all_settings = $this->selectAllWhere($this->settings_tb, 'id', 1);
		$setting = $all_settings[0];
		$message = '
				<!doctype html>
				<html>
				<head>
					<meta name="viewport" content="width=device-width" />
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<title>Simple Transactional Email</title>
						<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
					<style>
						/* -------------------------------------
							GLOBAL RESETS
						------------------------------------- */
						
						/*All the styling goes here*/
						
						img {
						border: none;
						-ms-interpolation-mode: bicubic;
						max-width: 100%; 
						}
				
						body {
						background-color: #f6f6f6;
						font-family: sans-serif;
						-webkit-font-smoothing: antialiased;
						font-size: 14px;
						line-height: 1.4;
						margin: 0;
						padding: 0;
						-ms-text-size-adjust: 100%;
						-webkit-text-size-adjust: 100%; 
						}
				
						table {
						border-collapse: separate;
						mso-table-lspace: 0pt;
						mso-table-rspace: 0pt;
						width: 100%; }
						table td {
							font-family: sans-serif;
							font-size: 14px;
							vertical-align: top; 
						}
				
						/* -------------------------------------
							BODY & CONTAINER
						------------------------------------- */
				
						.body {
						background-color: #f6f6f6;
						width: 100%; 
						}
				
						/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
						.container {
						display: block;
						margin: 0 auto !important;
						/* makes it centered */
						max-width: 580px;
						padding: 10px;
						width: 580px; 
						}
				
						/* This should also be a block element, so that it will fill 100% of the .container */
						.content {
						box-sizing: border-box;
						display: block;
						margin: 0 auto;
						max-width: 580px;
						padding: 10px; 
						}
				
						/* -------------------------------------
							HEADER, FOOTER, MAIN
						------------------------------------- */
						.main {
						background: #ffffff;
						border-radius: 3px;
						width: 100%; 
						}
				
						.wrapper {
						box-sizing: border-box;
						padding: 20px; 
						}
				
						.content-block {
						padding-bottom: 10px;
						padding-top: 10px;
						}
				
						.footer {
						clear: both;
						margin-top: 10px;
						text-align: center;
						width: 100%; 
						}
						.footer td,
						.footer p,
						.footer span,
						.footer a {
							color: #999999;
							font-size: 12px;
							text-align: center; 
						}
				
						/* -------------------------------------
							TYPOGRAPHY
						------------------------------------- */
						h1,
						h2,
						h3,
						h4 {
						color: #000000;
						font-family: sans-serif;
						font-weight: 400;
						line-height: 1.4;
						margin: 0;
						margin-bottom: 30px; 
						}
				
						h1 {
						font-size: 35px;
						font-weight: 300;
						text-align: center;
						text-transform: capitalize; 
						}
				
						p,
						ul,
						ol {
						font-family: sans-serif;
						font-size: 14px;
						font-weight: normal;
						margin: 0;
						margin-bottom: 15px; 
						}
						p li,
						ul li,
						ol li {
							list-style-position: inside;
							margin-left: 5px; 
						}
				
						a {
						color: #3498db;
						text-decoration: underline; 
						}
				
						/* -------------------------------------
							BUTTONS
						------------------------------------- */
						.btn {
						box-sizing: border-box;
						width: 100%; }
						.btn > tbody > tr > td {
							padding-bottom: 15px; }
						.btn table {
							width: 100%; 
						}
						.btn table td {
							background-color: #ffffff;
							border-radius: 5px;
							text-align: center; 
						}
						.btn a {
							background-color: #ffffff;
							border: solid 1px #3498db;
							border-radius: 5px;
							box-sizing: border-box;
							color: #3498db;
							cursor: pointer;
							display: inline-block;
							font-size: 14px;
							font-weight: bold;
							margin: 0;
							padding: 12px 25px;
							text-decoration: none;
							text-transform: capitalize; 
						}
				
						.btn-primary table td {
						background-color: #3498db; 
						}
				
						.btn-primary a {
						background-color: #3498db;
						border-color: #3498db;
						color: #ffffff; 
						}
				
						/* -------------------------------------
							OTHER STYLES THAT MIGHT BE USEFUL
						------------------------------------- */
						.last {
						margin-bottom: 0; 
						}
				
						.first {
						margin-top: 0; 
						}
				
						.align-center {
						text-align: center; 
						}
				
						.align-right {
						text-align: right; 
						}
				
						.align-left {
						text-align: left; 
						}
				
						.clear {
						clear: both; 
						}
				
						.mt0 {
						margin-top: 0; 
						}
				
						.mb0 {
						margin-bottom: 0; 
						}
				
						.preheader {
						color: transparent;
						display: none;
						height: 0;
						max-height: 0;
						max-width: 0;
						opacity: 0;
						overflow: hidden;
						mso-hide: all;
						visibility: hidden;
						width: 0; 
						}
				
						.powered-by a {
						text-decoration: none; 
						}
				
						hr {
						border: 0;
						border-bottom: 1px solid #f6f6f6;
						margin: 20px 0; 
						}
				
						/* -------------------------------------
							RESPONSIVE AND MOBILE FRIENDLY STYLES
						------------------------------------- */
						@media only screen and (max-width: 620px) {
						table[class=body] h1 {
							font-size: 28px !important;
							margin-bottom: 10px !important; 
						}
						table[class=body] p,
						table[class=body] ul,
						table[class=body] ol,
						table[class=body] td,
						table[class=body] span,
						table[class=body] a {
							font-size: 16px !important; 
						}
						table[class=body] .wrapper,
						table[class=body] .article {
							padding: 10px !important; 
						}
						table[class=body] .content {
							padding: 0 !important; 
						}
						table[class=body] .container {
							padding: 0 !important;
							width: 100% !important; 
						}
						table[class=body] .main {
							border-left-width: 0 !important;
							border-radius: 0 !important;
							border-right-width: 0 !important; 
						}
						table[class=body] .btn table {
							width: 100% !important; 
						}
						table[class=body] .btn a {
							width: 100% !important; 
						}
						table[class=body] .img-responsive {
							height: auto !important;
							max-width: 100% !important;
							width: auto !important; 
						}
						}
				
						/* -------------------------------------
							PRESERVE THESE STYLES IN THE HEAD
						------------------------------------- */
						@media all {
						.ExternalClass {
							width: 100%; 
						}
						.ExternalClass,
						.ExternalClass p,
						.ExternalClass span,
						.ExternalClass font,
						.ExternalClass td,
						.ExternalClass div {
							line-height: 100%; 
						}
						.apple-link a {
							color: inherit !important;
							font-family: inherit !important;
							font-size: inherit !important;
							font-weight: inherit !important;
							line-height: inherit !important;
							text-decoration: none !important; 
						}
						#MessageViewBody a {
							color: inherit;
							text-decoration: none;
							font-size: inherit;
							font-family: inherit;
							font-weight: inherit;
							line-height: inherit;
						}
						.btn-primary table td:hover {
							background-color: transparent !important; 
						}
						.btn-primary a:hover {
							background-color: #34495e !important;
							border-color: #34495e !important; 
						} 
						p{
							font-family: tahoma, /* MS WebFont */ /* Fallback options */ arial, /* Windows, MacOS */ helvetica, /* Unix+X, MacOS */ sans-serif;
						font-size: 15px;
						}
						body{
							font-family: tahoma, /* MS WebFont */ /* Fallback options */ arial, /* Windows, MacOS */ helvetica, /* Unix+X, MacOS */ sans-serif;
						font-size: 15px;
						}
						a{
							font-family: tahoma, /* MS WebFont */ /* Fallback options */ arial, /* Windows, MacOS */ helvetica, /* Unix+X, MacOS */ sans-serif;
						font-size: 15px;
						}
						table td{
							font-family: tahoma, /* MS WebFont */ /* Fallback options */ arial, /* Windows, MacOS */ helvetica, /* Unix+X, MacOS */ sans-serif;
						font-size: 15px;
						}
						.td-gift-img{
						background-color: transparent !important;
						}
						.td-gift-img:hover{
						background-color: transparent !important;
						}
						.font-13{
						font-size: 13px;
						}
				
						body{
						font-family: Arial, Helvetica, sans-serif !important;
						}
				
				
						}
				
					</style>
				</head>
				<body class="">
					<span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>
					<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
					<tr>
						<td>&nbsp;</td>
						<td class="container">
						<div class="content">
							<div class="footer">
							<table role="presentation" border="0" cellpadding="0" cellspacing="0">
								<tr>
								<td class="content-block">
									<h6>
									<a href="https://vibetemple.com">' . $setting['company_name'] . '</a>.
									</h6> 
								</td>
								</tr>
							</table>
							</div>

							<!-- START CENTERED WHITE CONTAINER -->
							<table role="presentation" class="main">

							<!-- START MAIN CONTENT AREA -->
							<tr>
								<td class="wrapper">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
									<td>
										<p style="margin-bottom: 0;text-transform:capitalize;">Hi ' . $cust_detail[0]['full_name'] . '</p>
										<p>Your download links just arrived. Enjoy!</p>
										<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
										<tbody>
											<tr>
											<td align="left">
												<table role="presentation" border="0" cellpadding="0" cellspacing="0">
												<tbody>
													<tr>
													<td class="td-gift-img"> 
														<img src="vibetemple.com/HQ/lib/mail/img/gift-download.jpg" width="250" height="250" alt="">
													</td>
													</tr>
													<tr>
													</tr>
												</tbody>
												</table>
											</td>
											</tr>
										</tbody>
										</table>';

		$i = 1;
		foreach ($cart as $e_cart) {
			$message .= 	'<tr>
						<td>
							<p style="margin-bottom: 0;">' . $i . '. ' . $e_cart['product_title'] . '</p>';
			foreach ($e_cart['url'] as $e_url) {
				$url = explode('::', $e_url);

				$message .= '<span class="font-13">' . $url[0] . ' Link:</span><a class="font-13" href="' . $url[1] . '">
							' . $url[1] . '</a><br>';
			}
			$message .= '<hr>
						</td>
						</tr>';
			$i++;
		}

		$message .= '		
							</td>
							</tr>
						</table>
						</td>
						</tr>
						<!-- END MAIN CONTENT AREA -->
						</table>
						<!-- END CENTERED WHITE CONTAINER -->
						<!-- START FOOTER -->
						<div class="footer">
						<table role="presentation" border="0" cellpadding="0" cellspacing="0">
						<tr>
						<td class="content-block">
							<span class="apple-link">' . $setting['location_address'] . '</span>
							<br> <a href="' . $setting['twitter'] . '">Get in touch?</a>.
						</td>
						</tr>
						<tr>
						<td class="content-block powered-by">
							Powered by <a href="http://techocraft.com">Techocraft</a>.
						</td>
						</tr>
						</table>
						</div>
						<!-- END FOOTER -->

						</div>
						</td>
						<td>&nbsp;</td>
						</tr>
						</table>
						</body>
					</html>
				';

		$header = "MIME-Version: 1.0" . "\r\n";
		$header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$header .= 'From: Vibe Temple <marketing@vibetemple.com>' . "\r\n";
		$retval = @mail($to, $subject, $message, $header);
		if ($retval == true) {
			return  'Mail sent successfully to ' . $cust_email . ' ';
		} else {
			return  'Internal error. Mail fail to send';
		}
		return $this;
	}

	public function welcomeEmail($email, $username)
	{
		$to  = $email;
		$d = date('Y');
		$subject = "Welcome To Winkir";
		$message = '
		<!doctype html>
		<html>
		<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato|Roboto+Condensed|Roboto">

		</head>
		<body style="padding: 0px ;margin:0px;">

		<div style="
				float:left;
				background-color:/*#DFDFDF*/ #F0F0F0 ;
				width:80%;
				padding-left: 10% ;
				padding-right: 10% ;
				padding-bottom:140px;" class="wrapper">
			<div style="
						float:left;
						margin-top:50px;" class="logo">
				<img src="www.winkir.com/images/nw-logo.png" alt="Winkir"/>
			</div>
			<div style="float:left;
						width:100%;
						background-color:white;
						border-radius:3px 3px 0px 0px;
						border-left:1px solid #C7C7C7;
						border-right:1px solid #C7C7C7;
						border-top:1px solid #C7C7C7;" class="main-body">
				<div style="
							font-family: \'Roboto Condensed\', sans-serif;
							padding-top:50px;padding-bottom:50px;
							padding-left:10%;padding-right:10%;" class="text-box">
					<h3 style="font-size:25px;
								font-weight:bold;
								text-align:center;
								color:#332E2E;
					
					">HI, ' . $username . '</h3>
					<p style="font-size:18px;
								color:black;"> <br>
								Welcome and congratulations on joining Winkir; Your account has been confirmed. You can now log in to your account using your registered password.<br>
								Get ready to participate in profitable investment!.</p>
					<p style="
								">Thanks!</p>
					<p style="
								color:#332E2E">-Winkir Customer Care</p>
				</div>
				
			</div>
			<div style="background-color:rgb(253, 150, 26);
						float:left;
						width:80%;
						border:1px solid rgb(253, 150, 26);
						border-radius:0px 0px 3px 3px;
						padding-left:10% ;
						padding-right:10% ;
						padding-top:30px ;
						padding-bottom:30px ;
						font-family: \'Roboto\', sans-serif;" class="footer">
				Winkir Finance Company.<br>
				P.O. BOX 3567.<br>
				PORTLAND, QR 97228.<br>
			</div>
			<p style="float:left;
			width:100%;
			text-align:center;
			font-family: \'Roboto Condensed\', sans-serif;
			">&copy;Winkir <?php print date("Y") ?>. All Rights Reserved.</p>
		</div>

		</body>
		</html>
				';
		$header = "MIME-Version: 1.0" . "\r\n";
		$header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$header .= "From: " . $this->sitename . "<" . $this->site_email . ">" . "\r\n";
		$retval = @mail($to, $subject, $message, $header);
		if ($retval == true) {
			return  'Mail sent successfully. Check ' . $email . ' email account for `Email Activation Link`!';
		} else {
			return  'Internal error. Mail fail to send';
		}
		return $this;
	}

	public function contact_us_reply($client_email)
	{
		$to = $client_email;
		$cust_detail = $this->selectAllWhere($this->customer_detail_tb, 'email_address', $client_email);
		$subject = 'Contact Us Response';
		$all_settings = $this->selectAllWhere($this->settings_tb, 'id', 1);
		$setting = $all_settings[0];

		$message = '
			<!doctype html>
			<html>
			<head>
				<meta name="viewport" content="width=device-width" />
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<title>Contact Us Response</title>
					<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" /> -->
				<style>
				/* -------------------------------------
					GLOBAL RESETS
				------------------------------------- */
				
				/*All the styling goes here*/
				
				img {
					border: none;
					-ms-interpolation-mode: bicubic;
					max-width: 100%; 
				}

				body {
					background-color: #f6f6f6;
					font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
					-webkit-font-smoothing: antialiased;
					font-size: 14px;
					line-height: 1.4;
					margin: 0;
					padding: 0;
					-ms-text-size-adjust: 100%;
					-webkit-text-size-adjust: 100%; 
				}

				table {
					border-collapse: separate;
					mso-table-lspace: 0pt;
					mso-table-rspace: 0pt;
					width: 100%; }
					table td {
					font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
					font-size: 14px;
					vertical-align: top; 
				}

				/* -------------------------------------
					BODY & CONTAINER
				------------------------------------- */

				.body {
					background-color: #f6f6f6;
					width: 100%; 
				}

				/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
				.container {
					display: block;
					margin: 0 auto !important;
					/* makes it centered */
					max-width: 580px;
					padding: 10px;
					width: 580px; 
				}

				/* This should also be a block element, so that it will fill 100% of the .container */
				.content {
					box-sizing: border-box;
					display: block;
					margin: 0 auto;
					max-width: 580px;
					padding: 10px; 
				}

				/* -------------------------------------
					HEADER, FOOTER, MAIN
				------------------------------------- */
				.main {
					background: #ffffff;
					border-radius: 3px;
					width: 100%; 
				}

				.wrapper {
					box-sizing: border-box;
					padding: 20px; 
				}

				.content-block {
					padding-bottom: 10px;
					padding-top: 10px;
				}

				.footer {
					clear: both;
					margin-top: 10px;
					text-align: center;
					width: 100%; 
				}
					.footer td,
					.footer p,
					.footer span,
					.footer a {
					color: #999999;
					font-size: 12px;
					text-align: center; 
				}

				/* -------------------------------------
					TYPOGRAPHY
				------------------------------------- */
				h1,
				h2,
				h3,
				h4 {
					color: #000000;
					font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
					font-weight: 400;
					line-height: 1.4;
					margin: 0;
					margin-bottom: 30px; 
				}

				h1 {
					font-size: 35px;
					font-weight: 300;
					text-align: center;
					text-transform: capitalize; 
				}

				p,
				ul,
				ol {
					font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
					font-size: 14px;
					font-weight: normal;
					margin: 0;
					margin-bottom: 15px; 
				}
					p li,
					ul li,
					ol li {
					list-style-position: inside;
					margin-left: 5px; 
				}

				a {
					color: #3498db;
					text-decoration: underline; 
				}

				/* -------------------------------------
					BUTTONS
				------------------------------------- */
				.btn {
					box-sizing: border-box;
					width: 100%; }
					.btn > tbody > tr > td {
					padding-bottom: 15px; }
					.btn table {
					width: 100%; 
				}
					.btn table td {
					background-color: #ffffff;
					border-radius: 5px;
					text-align: center; 
				}
					.btn a {
					background-color: #ffffff;
					border: solid 1px #3498db;
					border-radius: 5px;
					box-sizing: border-box;
					color: #3498db;
					cursor: pointer;
					display: inline-block;
					font-size: 14px;
					font-weight: bold;
					margin: 0;
					padding: 12px 25px;
					text-decoration: none;
					text-transform: capitalize; 
				}

				.btn-primary table td {
					background-color: #3498db; 
				}

				.btn-primary a {
					background-color: #3498db;
					border-color: #3498db;
					color: #ffffff; 
				}

				/* -------------------------------------
					OTHER STYLES THAT MIGHT BE USEFUL
				------------------------------------- */
				.last {
					margin-bottom: 0; 
				}

				.first {
					margin-top: 0; 
				}

				.align-center {
					text-align: center; 
				}

				.align-right {
					text-align: right; 
				}

				.align-left {
					text-align: left; 
				}

				.clear {
					clear: both; 
				}

				.mt0 {
					margin-top: 0; 
				}

				.mb0 {
					margin-bottom: 0; 
				}

				.preheader {
					color: transparent;
					display: none;
					height: 0;
					max-height: 0;
					max-width: 0;
					opacity: 0;
					overflow: hidden;
					mso-hide: all;
					visibility: hidden;
					width: 0; 
				}

				.powered-by a {
					text-decoration: none; 
				}

				hr {
					border: 0;
					border-bottom: 1px solid #f6f6f6;
					margin: 20px 0; 
				}

				/* -------------------------------------
					RESPONSIVE AND MOBILE FRIENDLY STYLES
				------------------------------------- */
				@media only screen and (max-width: 620px) {
					table[class=body] h1 {
					font-size: 28px !important;
					margin-bottom: 10px !important; 
					}
					table[class=body] p,
					table[class=body] ul,
					table[class=body] ol,
					table[class=body] td,
					table[class=body] span,
					table[class=body] a {
					font-size: 16px !important; 
					}
					table[class=body] .wrapper,
					table[class=body] .article {
					padding: 10px !important; 
					}
					table[class=body] .content {
					padding: 0 !important; 
					}
					table[class=body] .container {
					padding: 0 !important;
					width: 100% !important; 
					}
					table[class=body] .main {
					border-left-width: 0 !important;
					border-radius: 0 !important;
					border-right-width: 0 !important; 
					}
					table[class=body] .btn table {
					width: 100% !important; 
					}
					table[class=body] .btn a {
					width: 100% !important; 
					}
					table[class=body] .img-responsive {
					height: auto !important;
					max-width: 100% !important;
					width: auto !important; 
					}
				}

				/* -------------------------------------
					PRESERVE THESE STYLES IN THE HEAD
				------------------------------------- */
				@media all {
					.ExternalClass {
					width: 100%; 
					}
					.ExternalClass,
					.ExternalClass p,
					.ExternalClass span,
					.ExternalClass font,
					.ExternalClass td,
					.ExternalClass div {
					line-height: 100%; 
					}
					.apple-link a {
					color: inherit !important;
					font-family: inherit !important;
					font-size: inherit !important;
					font-weight: inherit !important;
					line-height: inherit !important;
					text-decoration: none !important; 
					}
					#MessageViewBody a {
					color: inherit;
					text-decoration: none;
					font-size: inherit;
					font-family: inherit;
					font-weight: inherit;
					line-height: inherit;
					}
					.btn-primary table td:hover {
					background-color: transparent !important; 
					}
					.btn-primary a:hover {
					background-color: #34495e !important;
					border-color: #34495e !important; 
					} 
				p{
						//font-family: tahoma, /* MS WebFont */ /* Fallback options */ arial, /* Windows, MacOS */ helvetica, /* Unix+X, MacOS */ sans-serif;
						font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
					font-size: 15px;
				}
				body{
						//font-family: tahoma, /* MS WebFont */ /* Fallback options */ arial, /* Windows, MacOS */ helvetica, /* Unix+X, MacOS */ sans-serif;
						font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
					font-size: 15px;
				}
				a{
						//font-family: tahoma, /* MS WebFont */ /* Fallback options */ arial, /* Windows, MacOS */ helvetica, /* Unix+X, MacOS */ sans-serif;
						font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
					font-size: 15px;
				}
				table td{
						//font-family: tahoma, /* MS WebFont */ /* Fallback options */ arial, /* Windows, MacOS */ helvetica, /* Unix+X, MacOS */ sans-serif;
						font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
					font-size: 15px;
				}
				.td-gift-img{
					background-color: transparent !important;
				}
				.td-gift-img:hover{
					background-color: transparent !important;
				}
				.font-13{
					font-size: 13px;
				}

				body{
					font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
				}
				.contact-head{
					font-size: 24px;
				font-weight: 600;
				}


				}

				</style>
			</head>
			<body class="">
				<span class="preheader">Contact Us Response</span>
				<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
				<tr>
					<td>&nbsp;</td>
					<td class="container">
					<div class="content">
						<div class="footer">
						<table role="presentation" border="0" cellpadding="0" cellspacing="0">
							<tr>
							<td class="content-block">
								<h6>
								<a href="https://vibetemple.com">' .  $setting['company_name'] . '</a>.
								</h6> 
							</td>
							</tr>
						</table>
						</div>

						<!-- START CENTERED WHITE CONTAINER -->
						<table role="presentation" class="main">

						<!-- START MAIN CONTENT AREA -->
						<tr>
							<td class="wrapper">
							<table role="presentation" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										<h1 class="contact-head">
											Contact Us
											</h1>
									</td>
								</tr>
								<tr>
								<td>
									<p style="margin-bottom: 0;text-transform:capitalize;">Hi ' . $cust_detail[0]['full_name'] . ',</p>
									<p>Thank you for contacting us.</p>
									<p>You are getting this email to confirm that your request to contact us was successfull.</p>
									<p>We are currently processing your request, a response will be sent soonest.</p>
									<p>Thanks</p>
									
								</td>
								</tr>
							</table>
							</td>
						</tr>

						<!-- END MAIN CONTENT AREA -->
						</table>
						<!-- END CENTERED WHITE CONTAINER -->

						<!-- START FOOTER -->
						<div class="footer">
						<table role="presentation" border="0" cellpadding="0" cellspacing="0">
							<tr>
							<td class="content-block">
								<span class="apple-link">' . $setting['location_address'] . '</span>
								<br> <a href="' . $setting['twitter'] . '">Get in touch?</a>.
							</td>
							</tr>
							<tr>
							<td class="content-block powered-by">
								Powered by <a href="http://techocraft.com">Techocraft</a>.
							</td>
							</tr>
						</table>
						</div>
						<!-- END FOOTER -->

					</div>
					</td>
					<td>&nbsp;</td>
				</tr>
				</table>
			</body>
			</html>
			';


		$header = "MIME-Version: 1.0" . "\r\n";
		$header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$header .= "From: " . $this->sitename . "<" . $this->site_email . ">" . "\r\n";
		$retval = @mail($to, $subject, $message, $header);
		if ($retval == true) {
			return ['error' => 0, 'msg' => 'Mail sent successfully. You will recieve a response soon  at this email address!'];
		} else {
			return ['error' => 1, 'msg' => 'Internal error. Mail fail to send'];
		}
		return $this;
	}

	public function passRecovery($email)
	{
		$to  = $email;
		$d = date('Y');
		$subject = "Winkir Password Recovery Centre";
		$message = '
				<!doctype html>
				<html>
				<head>
				<meta charset="utf-8">
				<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato|Roboto+Condensed|Roboto">

				</head>
				<body style="padding: 0px ;margin:0px;">

				<div style="
						float:left;
						background-color: #F0F0F0 ;
						width:80%;
						padding-left: 10% ;
						padding-right: 10% ;
						padding-bottom:140px;" class="wrapper">
					<div style="
								float:left;
								margin-top:50px;" class="logo">
						<img src="www.winkir.com/images/nw-logo.png" alt="Winkir"/>
					</div>
					<div style="float:left;
								width:100%;
								background-color:white;
								border-radius:3px 3px 0px 0px;
								border-left:1px solid #C7C7C7;
								border-right:1px solid #C7C7C7;
								border-top:1px solid #C7C7C7;" class="main-body">
						<div style="
									font-family: \'Roboto Condensed\', sans-serif;
									padding-top:50px;padding-bottom:50px;
									padding-left:10%;padding-right:10%;" class="text-box">
							
							<p style="font-size:18px;
										color:black;"> <br>
										Please follow this link to reset your password. 
										<a href="www.winkir.com/mail/recover.php?em=' . $email . '&ip=fd62b6b32557a22a8682d674ec478407">Recover Password</a><br>
										Sorry for any previous inconveniences.<br>
										Get ready to continue with profitable investment!.</p>
							<p style="
										">Thanks!</p>
							<p style="
										color:#332E2E">-Winkir Customer Care</p>
						</div>
						
					</div>
					<div style="background-color:rgb(253, 150, 26);
								float:left;
								width:80%;
								border:1px solid rgb(253, 150, 26);
								border-radius:0px 0px 3px 3px;
								padding-left:10% ;
								padding-right:10% ;
								padding-top:30px ;
								padding-bottom:30px ;
								font-family: \'Roboto\', sans-serif;" class="footer">
						Winkir Finance Company.<br>
						P.O. BOX 3567.<br>
						PORTLAND, QR 97228.<br>
					</div>
					<p style="float:left;
					width:100%;
					text-align:center;
					font-family: \'Roboto Condensed\', sans-serif;
					">&copy;Winkir <?php print date("Y") ?>. All Rights Reserved.</p>
				</div>

				</body>
				</html>
			';
		$header = "MIME-Version: 1.0" . "\r\n";
		$header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$header .= 'From: Winkir <info@winkir.com>' . "\r\n";
		$retval = @mail($to, $subject, $message, $header);
		if ($retval == true) {
			return  'Mail sent successfully. Check ' . $email . ' email account for `Email Activation Link`!';
		} else {
			return  'Internal error. Mail fail to send';
		}
		return $this;
	}
}
$Email_Sys = new Email_Sys();
