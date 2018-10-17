<div id="wrap">
<?php
include 'header.php';
?>
<?php
	switch ($_GET['mode']) {
		case "step_01" :  
		         include 'step_01.php';
		        break;
		case "step_02" :  
				include 'step_02.php';
			   break;
		case "step_03" :  
		          include 'step_03.php';
				  break; 
		case 'regist' :
				  include 'regist.php';
				  break;
		case 'complete':
				  include 'complete.php';
				  break;
		case 'find_id':
				  include 'find_id.php';
				  break;
		case 'find_pw':
				  include 'find_pw.php';
				  break;
		case 'modify':
				  include 'modify.php';
				  break;		           
		default : include 'container.php';
	}
?>

<script type="text/javascript">
$(document).ready(function(){
	//main_slider_applyclass
	var bnrWrap = $('.slider-applyclass')
	var bnr_slider = bnrWrap.find('.bxslider');

	slider = bnr_slider.bxSlider({
		auto: true,
		mode : 'fade',
		cutLimit: 4,
		speed: 500,
		autoStart:true,
		pagerCustom: '#bx-pager-apply',
		onSliderLoad: function(selector){
			bnrWrap.css("overflow","visible");
		}
	});
	$('.page-applyclass').mouseover(function(){
		slider.startAuto();
	});
});
</script>
<?php
include_once 'footer.php';
?>
</div>
</body>
</html>
