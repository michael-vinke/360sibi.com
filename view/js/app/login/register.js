require(['jquery','bootstrap','jquery.md5'],
	function(){
	$(document).ready(function(){
		$("button#register").click(function(){
			var un = $("input#username").val();
			var pw = $("input#password").val();
			var cf = $("input#confirm").val();
			if(un.length==0){alert("Please Enter Username !");return;}
			if(pw.length==0||cf.length==0||pw!=cf){alert("Wrong Password !");return;}
			
			$.post("/controller/LoginAction.php",
				{action:"register",username:un,password:$.md5(pw)},
				function(data,status){alert(data.return_msg);},
				"json");
		});
	});

});
