<?php echo $header; ?>
<div class="quickview">
<div class="quickview-container">
  
  
    <div id="content" class="productpage-quickview"><?php echo $content_top; ?>
      <div class="">
        <h2 class="page-title"><?php echo $heading_title; ?></h2>
		        
		<div class="col-sm-6 product-left">
		<div class="product-info">
         <?php if ($thumb || $images) { ?>
	
	
	
    <div class="left product-image thumbnails">
      <?php if ($thumb) { ?>      
	  <!-- Megnor Cloud-Zoom Image Effect Start -->
	  	<div class="image"><a class="thumbnail" title="<?php echo $heading_title; ?>"><img id="tmzoom" src="<?php echo $thumb; ?>" data-zoom-image="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div> 
      <?php } ?>
      <?php if ($images) { ?>
	  	 <?php 
			$sliderFor = 3;
			$imageCount = sizeof($images); 
		 ?>			 
		<?php } ?>		  	  
  

	<!-- Megnor Cloud-Zoom Image Effect End-->
    </div>
    <?php } ?>
		
	</div>
        </div>

        <div class="col-sm-6 product-right">
          <h3 class="product-title"><?php echo $heading_title; ?></h3>

		  
		  <?php if ($review_status) { ?>
          <div class="rating">            
              <?php for ($i = 1; $i <= 5; $i++) { ?>
              <?php if ($rating < $i) { ?>
              <span class="fa fa-stack"><i class="fa fa-star off fa-stack-2x"></i></span>
              <?php } else { ?>
              <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
              <?php } ?>
              <?php } ?> 
		  </div>
          <?php } ?> 
		  
          <ul class="list-unstyled description">
            <?php if ($manufacturer) { ?>
            <li><label class="desc"><?php echo $text_manufacturer; ?></label><a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a></li>
            <?php } ?>
            <li><label class="desc"><?php echo $text_model; ?></label><?php echo $model; ?></li>
            <?php if ($reward) { ?>
            <li><label class="desc"><?php echo $text_reward; ?></label><?php echo $reward; ?></li>
            <?php } ?>
            <li><label class="desc"><?php echo $text_stock; ?></label><?php echo $stock; ?></li>
          </ul>
		  
		  
		  <?php if ($price) { ?>
          <ul class="list-unstyled">
            <?php if (!$special) { ?>
            <li>
              <h4 class="product-price"><?php echo $price; ?></h4>
            </li>
            <?php } else { ?>
            <li>
			<span class="old-price" style="text-decoration: line-through;"><?php echo $price; ?></span> 
            <span class="special-price"><?php echo $special; ?></span>
            </li>
            <?php } ?>
            <?php if ($tax) { ?>
            <li class="price-tax"><?php echo $text_tax; ?><span><?php echo $tax; ?></span></li>
            <?php } ?>
            <?php if ($points) { ?>
            <li class="rewardpoint"><?php echo $text_points; ?> <?php echo $points; ?></li>
            <?php } ?>
            <?php if ($discounts) { ?>
            <li>
            </li>
            <?php foreach ($discounts as $discount) { ?>
            <li class="discount"><?php echo $discount['quantity']; ?><?php echo $text_discount; ?><?php echo $discount['price']; ?></li>
            <?php } ?>
            <?php } ?>
          </ul>
          <?php } ?>
         
          <div id="product2">
            <?php if ($options) { ?>
         
            <h3 class="product-option"><?php echo $text_option; ?></h3>
            <?php foreach ($options as $option) { ?>
            <?php if ($option['type'] == 'select') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                <?php if ($option_value['price']) { ?>
                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                <?php } ?>
                </option>
                <?php } ?>
              </select>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'radio') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php if ($option_value['image']) { ?>
                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> 
                    <?php } ?>
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'checkbox') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php if ($option_value['image']) { ?>
                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> 
                    <?php } ?>
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            
            <?php if ($option['type'] == 'text') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'textarea') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <textarea name="option[<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"><?php echo $option['value']; ?></textarea>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'file') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
              <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'date') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group date">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'datetime') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group datetime">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'time') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group time">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <?php if ($recurrings) { ?>
            <hr>
            <h3><?php echo $text_payment_recurring; ?></h3>
            <div class="form-group required">
              <select name="recurring_id" class="form-control">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($recurrings as $recurring) { ?>
                <option value="<?php echo $recurring['recurring_id']; ?>"><?php echo $recurring['name']; ?></option>
                <?php } ?>
              </select>
              <div class="help-block" id="recurring-description"></div>
            </div>
            <?php } ?>
            
          
		  
		   
		<div class="product-rightinfo">	
		 
		  
			<div class="form-group cart-block">
              <label class="control-label qty" for="input-quantity"><?php echo $entry_qty; ?></label>
              <input type="text" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="form-control" />
              <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
              
              <button type="button" id="button-cart2" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block"><?php echo $button_cart; ?></button>
            </div>
            <?php if ($minimum > 1) { ?>
            <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_minimum; ?></div>
            <?php } ?>
			<?php /*<div class="btn-group wish-comp">
            <button type="button"  class="btn btn-default wishlist" title="<?php echo $button_wishlist; ?>" onclick="parent.wishlist.add('<?php echo $product_id; ?>');"><i class="fa fa-heart"></i><?php echo $button_wishlist; ?></button>
            <button type="button"  class="btn btn-default compare" title="<?php echo $button_compare; ?>" onclick="parent.compare.add('<?php echo $product_id; ?>');"><i class="fa fa-area-chart"></i><?php echo $button_compare; ?></button>
            </div>*/ ?>
		  		
		</div>
		</div>
		<div class="content_product_block"><?php echo $productblock; ?> </div> 	
		</div>
	
		</div>
		</div>
		
          
	
     
    
	<?php echo $content_bottom; ?></div>
	</div>
</div>
<script type="text/javascript"><!--
$('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
	$.ajax({
		url: 'index.php?route=product/product/getRecurringDescription',
		type: 'post',
		data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
		dataType: 'json',
		beforeSend: function() {
			$('#recurring-description').html('');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();

			if (json['success']) {
				$('#recurring-description').html(json['success']);
			}
		}
	});
});
//--></script>
<script type="text/javascript"><!--
$('#button-cart2').on('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('#product2 input[type=\'text\'], #product2 input[type=\'hidden\'], #product2 input[type=\'radio\']:checked, #product2 input[type=\'checkbox\']:checked, #product2 select, #product2 textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart2').button('loading');
		},
		complete: function() {
			$('#button-cart2').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));

						if (element.parent().hasClass('input-group')) {
							element.parent().before('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						} else {
							element.before('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						}
					}
				}

				if (json['error']['recurring']) {
					$('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
				}

				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}

		if (json['success']) {
       $('#content').parent().before('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

				parent.$('#cart > button').html('<span id="cart-total"> ' + json['total'] + '</span>');

				$('html, body').animate({ scrollTop: 0 }, 'slow');

				parent.$('#cart > ul').load('index.php?route=common/cart/info ul li');
      }
		}
	});
});
//--></script>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});

$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=tool/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						alert(json['success']);

						$(node).parent().find('input').val(json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script>
<script type="text/javascript"><!--
$('#review').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();

    $('#review').fadeOut('slow');

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
});

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').on('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: $("#form-review").serialize(),
		beforeSend: function() {
			$('#button-review').button('loading');
		},
		complete: function() {
			$('#button-review').button('reset');
		},
		success: function(json) {
			$('.alert-success, .alert-danger').remove();

			if (json['error']) {
				$('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').prop('checked', false);
			}
		}
	});
});

//$(document).ready(function() {
//	$('.thumbnails').magnificPopup({
//		type:'image',
//		delegate: 'a',
//		gallery: {
//			enabled:true
//		}
//	});
//});


$(document).ready(function() {
if ($(window).width() > 767) {
		$("#tmzoom").elevateZoom({
				
				gallery:'additional-carousel',
				//inner zoom				 
								 
				zoomType : "inner", 
				cursor: "crosshair" 
				
				/*//tint
				
				tint:true, 
				tintColour:'#F90', 
				tintOpacity:0.5
				
				//lens zoom
				
				zoomType : "lens", 
				lensShape : "round", 
				lensSize : 200 
				
				//Mousewheel zoom
				
				scrollZoom : true*/
				
				
			});
		var z_index = 0;
     			    		
     			    		$(document).on('click', '.thumbnail', function () {
     			    		  $('.thumbnails').magnificPopup('open', z_index);
     			    		  return false;
     			    		});
			    		
     			    		$('.additional-carousel a').click(function() {
     			    			var smallImage = $(this).attr('data-image');
     			    			var largeImage = $(this).attr('data-zoom-image');
     			    			var ez =   $('#tmzoom').data('elevateZoom');	
     			    			$('.thumbnail').attr('href', largeImage);  
     			    			ez.swaptheimage(smallImage, largeImage); 
     			    			z_index = $(this).index('.additional-carousel a');
     			    			return false;
     			    		});
			
	}else{
		$(document).on('click', '.thumbnail', function () {
		$('.thumbnails').magnificPopup('open', 0);
		return false;
		});
	}
});
$(document).ready(function() {     
	$('.thumbnails').magnificPopup({
		delegate: 'a.elevatezoom-gallery',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-with-zoom',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title');
			}
		}
	});
});

$('#tabs a').tabs();
$('#custom_tab a').tabs();
$('#top').remove();
$('.top_button').remove();


//--></script>
<?php echo $footer; ?>
<style>
nav, header {
    display: none;
}

footer {
    display: none;
}
.content-top-breadcum {
    display: none;
}
#powered {
    display: none;
}
#container {
    width: 850px;
}
.top_button { display:none !important; }

</style>
