<script>
		function subscribe()
		{
			var emailpattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
			var email = $('#txtemail').val();
			if(email != "")
			{
				if(!emailpattern.test(email))
				{
					$('.text-danger').remove();
					var str = '<span class="error">Invalid Email</span>';
					$('#txtemail').after('<div class="text-danger">Invalid Email</div>');

					return false;
				}
				else
				{
					$.ajax({
						url: 'index.php?route=extension/module/newsletters/news',
						type: 'post',
						data: 'email=' + $('#txtemail').val(),
						dataType: 'json',
						
									
						success: function(json) {
						
						$('.text-danger').remove();
						$('#txtemail').after('<div class="text-danger">' + json.message + '</div>');
						
						}
						
					});
					return false;
				}
			}
			else
			{
				$('.text-danger').remove();
				$('#txtemail').after('<div class="text-danger">Email Is Require</div>');
				$(email).focus();

				return false;
			}
			

		}
	</script>
	


<div id="newsletter_block_left" class="block">
<h5><?php echo $heading_title; ?></h5>
<ul class="block_content"><li style="list-style:none;">
	<form method="post">
		<div class="form-group required">
		<div class="news-text">

            
            <div class="col-sm-10">
               <input type="email" name="txtemail" id="txtemail" value="" placeholder="<?php echo $text_placeholder; ?>" class="form-control input-lg"  />  
    	        <button type="submit" class="btn btn-default btn-lg" onclick="return subscribe();">Subscribe</button>  
            </div>
		</div>
		</div>

		
		</form></li>
</ul>
</div>