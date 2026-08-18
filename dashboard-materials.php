<?php
include("header-material.php");
 ?>
<script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap.min.js"></script>
 <script type="text/javascript">
$(document).ready(function(){
  	$("[rel=tooltip]").tooltip();
	$("[rel=popover]").popover({trigger:'click',html:true});
	
	
	$('.wagRw1').live('keyup', function () { /* bind change to input */
        var sum = 0,
            $this = $(this).parents('tr');
        $this.find('input').each(function() { /* find all inputs in the row */
            var value = parseInt(this.value);
            sum += value % 1 == 0 ? value : 0; /* add values together */
		});
        $this.find('td').last().text(sum); /* output sum into last column */
	       return true;
    });
});
	function clickFirstRow(){
		 firstSpn=$("#firstRowSpn").html();
		 if(firstSpn=='Vacant'){
		 
		 }
	}
</script>	
	
<body class="">

<style>
#viewcustomer { /* width:1000px; */ float:left;margin:0px 0 0 0;}
#viewcustomer .table { /* width:1000px; */ float:left; margin:0px 0 0 0; border:solid 1px #f1f1f1;font-size:12px;}
#viewcustomer .table .heading { background:#bfbfbf;}
#viewcustomer .table .heading p { color:#1c1c1c; font-size:12px; padding:8px 15px; font-weight:bold;}
#viewcustomer .table .detail { background:#fff;}
#viewcustomer .table .detail p { color:#373737; font-size:12px; padding:10px 15px; font-weight:normal;}
#viewcustomer .table .detail p b { color:#157cab;}
#viewcustomer .table .detail p a { color:#157cab;}
#viewcustomer .table .detail p span { color:#157cab;}
#viewcustomer .table .borleftdark { border-left:solid 1px #878787;}
#viewcustomer .table .borleftlight { border-left:solid 1px #f1f1f1;}
#viewcustomer .table .borbottomlight { border-bottom:solid 1px #f1f1f1;}

.style-one {
  border: 1px solid #ffffff;
  width: 100%;
}

.DashbrdDiv{width:790px;margin:7px 0 0 -12px;height:465px;border:1px solid #d5d5d5;background-color:#F4F4F4;
}

/*------------------------------------------------------------------
[6. Widget / .widget]
*/

.widget {
	
	position: relative;
	clear: both;
	
	width: auto;
	
	margin-bottom: 2em;
		
	overflow: hidden;
}
	
.widget-header {
	
	position: relative;
	
	height: 40px;
	line-height: 40px;
	
	background: #f9f6f1;
	background:-moz-linear-gradient(top, #f9f6f1 0%, #f2efea 100%); /* FF3.6+ */
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#f9f6f1), color-stop(100%,#f2efea)); /* Chrome,Safari4+ */
	background:-webkit-linear-gradient(top, #f9f6f1 0%,#f2efea 100%); /* Chrome10+,Safari5.1+ */
	background:-o-linear-gradient(top, #f9f6f1 0%,#f2efea 100%); /* Opera11.10+ */
	background:-ms-linear-gradient(top, #f9f6f1 0%,#f2efea 100%); /* IE10+ */
	background:linear-gradient(top, #f9f6f1 0%,#f2efea 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f6f1', endColorstr='#f2efea');
	-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f6f1', endColorstr='#f2efea')";
	
	
	border: 1px solid #d6d6d6;
	
	
	-webkit-background-clip: padding-box;
}	
	
	.widget-header h3 {
		
		position: relative;
		top: 2px;
		left: 10px;
		
		display: inline-block;
		margin-right: 3em;
		
		font-size: 14px;
		font-weight: 800;
		color: #525252;
		line-height: 18px;
		
		text-shadow: 1px 1px 2px rgba(255,255,255,.5);
	}
	
		.widget-header [class^="icon-"], .widget-header [class*=" icon-"] {
			
			display: inline-block;
			margin-left: 13px;
			margin-right: -2px;
			
			font-size: 16px;
			color: #555;
			vertical-align: middle;
			
			
			
		}




.widget-content {
	padding: 20px 15px 15px;
	
	background: #FFF;
	
	
	border: 1px solid #D5D5D5;
	
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
}

.widget-header+.widget-content {
	border-top: none;
	
	-webkit-border-top-left-radius: 0;
	-webkit-border-top-right-radius: 0;
	-moz-border-radius-topleft: 0;
	-moz-border-radius-topright: 0;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}

.widget-nopad .widget-content {
	padding: 0;
}

/* Widget Content Clearfix */	
.widget-content:before,
.widget-content:after {
    content:"";
    display:table;
}

.widget-content:after {
    clear:both;
}

/* For IE 6/7 (trigger hasLayout) */
.widget-content {
    zoom:1;
}

/* Widget Table */

.widget-table .widget-content {
	padding: 0;
}

.widget-table .table {
	margin-bottom: 0;
	
	border: none;
}

.widget-table .table tr td:first-child {
	border-left: none;
}

.widget-table .table tr th:first-child {
	border-left: none;
}


/* Widget Plain */

.widget-plain {
	
	background: transparent;
	
	border: none;
}

.widget-plain .widget-content {
	padding: 0;
	
	background: transparent;
	
	border: none;
}


/* Widget Box */

.widget-box {	
	
}

.widget-box .widget-content {	
	background: #E3E3E3;	
	background: #FFF;
}


#dashBrdTbl {
    margin: 65px 0 0 28px;
}

.dashMasImg {
    height: 70px;
    text-align: center;
    width: 70px;
}

.tbl,td{
	padding:0 22px 0 22px;
	/* background-color:#D4D4CC; */
} 

.bgbox
{
background: url(images/box.jpg) no-repeat; 
background-size:260px 250px;
//background:url(images/box.jpg);
}

.login:before {
  content: '';
  position: absolute;
  /* top: -8px; */
  right: -8px;
  bottom: -8px;
  left: -8px;
 /*  z-index: -1; */
  background: rgba(0, 0, 0, 0.08);
  border-radius: 4px;
}
.login h1 {
  margin: -20px -20px 21px;
  line-height: 40px;
  font-size: 15px;
  font-weight: bold;
  color: #555;
  text-align: center;
  text-shadow: 0 1px white;
  background: #f3f3f3;
  border-bottom: 1px solid #cfcfcf;
  border-radius: 3px 3px 0 0;
  background-image: -webkit-linear-gradient(top, whiteffd, #eef2f5);
  background-image: -moz-linear-gradient(top, whiteffd, #eef2f5);
  background-image: -o-linear-gradient(top, whiteffd, #eef2f5);
  background-image: linear-gradient(to bottom, whiteffd, #eef2f5);
  -webkit-box-shadow: 0 1px whitesmoke;
  box-shadow: 0 1px whitesmoke;
}

.dashMasLbl {
    color: #000;
    font: 12px/1.5em Arial,Helvetica,sans-serif;
    margin: 8px 0 0;
    text-align: center;
    width: 112px;
}

/*------------------------------------------------------------------
.wrapper {
    width: 250px;
}

.btnUndLine {
    text-decoration: underline #00008b;
}
</style>

<form action="">

<div id="viewcustomer" class="" style="margin:3px 0 0 0;float:right;">

</div>

</form>			
</body>
</html>