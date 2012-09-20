jQuery(document).ready(function($){
$("#shangxia").hide();
$body=(window.opera)?(document.compatMode=="CSS1Compat"?$('html'):$('body')):$('html,body');//修复Opera滑动异常地，加过就不需要重复加了。
$(window).scroll(function(){
	if ($(window).scrollTop()>100){
	$("#shangxia").fadeIn(1500);
	}
	else
	{
	$("#shangxia").fadeOut(1500);
	}
});
$('#shang').mouseover(function(){//鼠标移到id=shang元素上触发事件
		up();
	}).mouseout(function(){//鼠标移出事件
		clearTimeout(fq);
	}).click(function(){//点击事件
		$body.animate({scrollTop:0},400);//400毫秒滑动到顶部
});
}); 
//下面部分放jQuery外围，几个数值不妨自行改变试试
function up(){
   $wd = $(window);
   $wd.scrollTop($wd.scrollTop() - 1);
   fq = setTimeout("up()", 50);
}

	$('h2 a').click(function(){
	myloadoriginal = this.text;
	$(this).text('页面加载中 ...');
	var myload = this;
	setTimeout(function() { $(myload).text(myloadoriginal); }, 2012);
	});

