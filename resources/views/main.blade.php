@include('layouts.app');


<script>
    $(document).ready(function(){
		$('.navbar-fostrap').click(function(){
			$('.nav-fostrap').toggleClass('visible');
			$('body').toggleClass('cover-bg');
		});
	});
</script>



<div id="main">
    <div class="container">
        <div style="margin-top:150px;margin-bottom:30px;text-align:center;">
            <img src="https://4.bp.blogspot.com/-7OHSFmygfYQ/VtLSb1xe8kI/AAAAAAAABjI/FxaRp5xW2JQ/s320/logo.png"
                 style="width: 100px;margin-bottom:15px">
            <h1>Material Design Responsive Menu</h1>
        </div>
       
        <div class='content'>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
