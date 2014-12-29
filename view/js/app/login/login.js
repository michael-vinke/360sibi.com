require(['jquery', 'bootstrap','jquery.md5'], 
	function() {
		/**
		* jquery domready
		*
		*/
		function reg_out(){
		    var my_info = document.getElementById("regUser");
		    var my_study = document.getElementById("userlogin");
		    
		    my_info.style.display = "block";
		    my_study.style.display = "none";
		}
		function login_out(){
		    var my_info = document.getElementById("userlogin");
		    var my_study = document.getElementById("regUser");
		    
		    my_info.style.display = "block";
		    my_study.style.display = "none";
		}
		$(document).ready(function(){
		$("button#login").click(
		function(){
			//alert("Login !");
			var user = $("input#username").val();
			var passwd = $("input#password").val();
			if(user.length==0) {alert("Please Enter Username !");return;}
			if(passwd.length==0){alert("Please Enter Password !");return;}

			$.post("/controller/LoginAction.php",{
				action:"login",
				username:user,
				password:$.md5(passwd)},
				function(data,ststus){alert(data.return_msg);},
				"json");
			});
		});
		$(function() {
			alert("success! let's login!");
			/*
			$.post("/controller/LoginAction.php", {
				action: "check",
				username: "martin",
				password: "123456"
			}, function(data, status) {
				alert(data.return_msg);
			}, "json");
			*/
		});	

});
