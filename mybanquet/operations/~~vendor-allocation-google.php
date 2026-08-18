

<style>
.frmSearch {border: 1px solid #F0F0F0;/* background-color:#C8EEFD; */margin: 2px 0px;/* padding:40px; */}
#country-list{float:left;list-style:none;margin:0;padding:0;width:190px;position: absolute;z-index: 1;}
#country-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;}
</style>


$(document).ready(function(){
	
	$("#rfq_no").keyup(function(){
		$.ajax({
		type: "POST",
		url: "../action/selectQuoteDetails1.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			/* alert(data); */
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
	




function selectRFQ(val) {
$("#rfq_no").val(val);
$("#suggesstion-box").hide();
}


<tr>
		<td width="180" >RFQ No:</td>
		<td>
			<input name="rfq_no" id="rfq_no" type="text" onclick="selectQuoteREFQ();" />
			<div id="suggesstion-box"></div>
		</td>
	</tr>