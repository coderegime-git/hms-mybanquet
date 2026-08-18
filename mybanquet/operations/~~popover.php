

<script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap.min.js"></script>

<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->

<script type="text/javascript">
$(document).ready(function(){
	$("[rel=tooltip]").tooltip();
	$("[rel=popover]").popover({trigger:'hover',html:true});
});
</script>
<td><a rel="popover" data-placement="right" data-original-title="Quote # <?php echo $row['quote_number']; ?>" data-content="<div style='padding:10px 0 0 0'><span style='padding:10px 10px 0 0'>Quote Amount</span><?php echo $row['quote_amt'];?></div></a></td>


<td>
				<!-- EDIT-->
				<div style="display:inline"; id="ed<?php echo $row['quote_id'];?>">
					<a title="Edit Quotation Details" href="update-quotation.php?uid=<?php echo $row['quote_id']?>" style="color:#005580;">Edit</a>
				</div>
			</td>