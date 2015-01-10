require(['jquery', 'bootstrap'], 
	function() {
		
		/**
		* @author nickzhu
		* sibi
		*/
		var Sibi = 
		{
			init:function(){
				var _self = this;
				_self.initData();
				_self.sibi();
			},
			
			initData:function(){
				$("#ta-showData").val("");
				var nickname = "NickName";//TODO get nickname
				$("#nickname").text(nickname);
				//TODO get history data
			},
			sibi:function(){
				$("#btn-sibi").click(function(){
					var enterInput = $("#ta-enterInput").val();
					enterInput = $.trim(enterInput);
					if(enterInput.length == 0){
						$("#waring-text").slideDown("slow");
					}else{
						$("#waring-text").slideUp("slow");
						//TODO post data
						$.post("",{},function(data, status){
							$("#ta-showData").val($("#ta-showData").val() + "\n" + enterInput);
							$("#ta-enterInput").val("")
						});
					}
				});
			},
		}
		
		$(function(){
			Sibi.init();
		});
		
		/**
		* jquery domready
		*
		*/
		$(function() {
			alert("success! let's sibi !");
		});	

});