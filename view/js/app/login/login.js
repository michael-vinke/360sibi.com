require(['jquery', 'bootstrap', 'jquery.md5', 'cookie'], 
	function() {

		/**
		* page gobal variable
		*
		*/
		G_DATA = {};	

		/**
		* @author fygreen
		* function switch div
		*/
		var SwitchLogAndReg = function (divId1, divId2) {
			var $div1 = $('#' + divId1);
			var $div2 = $('#' + divId2);

			//$div2.css('display', 'none');
			$div2.fadeOut(500, function() {
                $div1.fadeIn(800);
            });
			//$div1.css('display', 'none');
			//$div1.fadeIn(2000);
		}

		/**
		* @author fygreen
		* Login font-end action
		*
		*/

		var Login = {

			init: function() {
				var _self = this;
				_self.switchDiv();
				_self.login();
			},

			switchDiv: function() {

				$("#showLoginForm").click(function() {

					SwitchLogAndReg("user_login", "user_register");
				});
			},

			login: function() {

				$("#login").click(function(event) {

					var username = $("#username").val();	
					var password = $("#password_login").val();

					if (username.length == 0) { 
						alert("Please Enter Username !");
						return;
					}
					if (password.length == 0) {
						alert("Please Enter Password !");
						return;
					}

				    $.post("/controller/LoginAction.php",{

							action:  "login",
							username: username,
							password: $.md5(password)

					}, function(data, ststus){

                        if (data.return_code == '0') {
                            
                            var username = "username=" + data.data.name;
                           $.COOKIE.setCookie("username", data.data.name, 24);
                        }
						alert(data.return_msg);

					}, "json");

				});	
			},

		}

		/**
		* @author nickzhu
		* Register font-end action
		*
		*/

		var Register = {

			init: function() {
				var _self = this;
				_self.switchDiv();
				_self.register();
				_self.check_user_exists();
			},

			switchDiv: function() {

				$("#showRegForm").click(function() {

					SwitchLogAndReg("user_register", "user_login");
				});
			},	

			register: function() {

				$("#register").click(function(event) {

					var username = $("#nickname").val();
					var password_register = $("#password_register").val();
					var password_confirm  = $("#password_confirm").val();

					if (username.length == 0) {
						alert("请输入用户名 !");
						return;
					}

					if (password_register.length == 0 || password_confirm.length == 0 || password_register !== password_confirm) {
						alert("密码不对！");
						return;
					}

					$.post("/controller/LoginAction.php", {
						action:   "register",
						username: username,
						password: $.md5(password_register)

					}, function(data, status) {

						alert(data.return_msg);

					}, "json");

				});	
			},

			check_user_exists: function() {

				$("#nickname").blur(function(event) {

					var username = $("#nickname").val();	
					$.post("/controller/LoginAction.php", {

						action:"check",
						username:username

					}, function(data,status) {

						if(data.return_code==0) {
							//用户名存在
							$("#wrongnn").css("display", "block");
						} else {
							$("#wrongnn").css("display", "none");
						}

					}, "json");

				});
			},

		}


		/**
		* @author fenicesun
		* domready setting
		*
		*/
		$(function(){
			
			Login.init();
			Register.init();
		});
		
});
