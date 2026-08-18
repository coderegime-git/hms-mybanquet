<?php 
$sqlRr=mysql_query("select * from property_definition where propdef_id='1'");
$numRr=mysql_fetch_array($sqlRr);
?>
<style>
* html #footer {
   position:absolute;
   top:expression((0-(footer.offsetHeight)+(document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight)+(ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop))+'px');
}
.footr {
   position:fixed;
   left:0px;
   bottom:0px;
  /*  height:30px; */
   width:100%;
 /*   background:#999; */
  margin: 0;
}
</style>
<table class="col-md-12 table footr" cellspacing="0" cellpadding="0" border="0" id="dasBrdD" style="">
<tr>
	<td style="background-color:#0073B5;color:#fff;width:100px;font-size:14px;font-weight:bold;text-align:left;" colspan="">&nbsp;<?php echo $numRr['prop_name'].' - '.$numRr['city'];?></td>
</tr>
</table></td>
</tr>
</table>



