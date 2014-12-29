require(['jquery', 'bootstrap','jquery.md5'], 
	function() {
		/**
		* jquery domready
		*
		*/
		
		$(document).ready(function(){
			$("a#showRegForm").click(function reg_out(){
		    var my_info = document.getElementById("regUser");
		    var my_study = document.getElementById("userlogin");
		    
		    my_info.style.display = "block";
		    my_study.style.display = "none";
			});
		});
		$(document).ready(function(){
			$("a#showLoginForm").click(function login_out(){
		    var my_info = document.getElementById("userlogin");
		    var my_study = document.getElementById("regUser");
		    
		    my_info.style.display = "block";
		    my_study.style.display = "none";
			});
		});
		
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
		$(document).ready(function(){
		$("button#register").click(function(){
			var un = $("input#nickname").val();
			var pw = $("input#password1").val();
			var cf = $("input#confirm").val();
			if(un.length==0){alert("Please Enter Username !");return;}
			if(pw.length==0||cf.length==0||pw!=cf){alert("Wrong Password !");return;}
			
			$.post("/controller/LoginAction.php",
				{action:"register",username:un,password:$.md5(pw)},
				function(data,status){alert(data.return_msg);},
				"json");
		});
		$(document).ready(function(){
			$("input#nickname").blur(function(){
				var un = $("input#nickname").val();
				$.post("/controller/LoginAction.php",
				{action:"check",username:un},
				function(data,status){
					if(data.return_code==0)
					{
						//用户名存在
						$("p#wrongnn").style.display = "block";
					}else
					{
						$("p#wrongnn").style.display = "none";
					}
				},
				"json");
			});
		});
		
	});
		$(function() {
			//alert("success! let's login!");
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
