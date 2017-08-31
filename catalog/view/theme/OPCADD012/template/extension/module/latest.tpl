<div class="box latest">
   <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
	<?php 
		$sliderFor = 7;
		$productCount = sizeof($products); 
	?>
	<?php if ($productCount >= $sliderFor): ?>
		<div class="customNavigation">
			<a class="prev fa fa-angle-left">&nbsp;</a>
			<a class="next fa fa-angle-right">&nbsp;</a>
		</div>	
	<?php endif; ?>	
	
	<div class="box-product <?php if ($productCount >= $sliderFor){?>product-carousel<?php }else{?>productbox-grid<?php }?>" id="<?php if ($productCount >= $sliderFor){?>latest-carousel<?php }else{?>latest-grid<?php }?>">
  <?php foreach ($products as $product) { ?>
  <div class="<?php if ($productCount >= $sliderFor){?>slider-item<?php }else{?>product-items<?php }?>">
    <div class="product-block product-thumb transition">
	  <div class="product-block-inner ">
	  	
		<div class="image">
			<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
	  <?php if (!$product['special']) { ?>       
			 <?php } else { ?>
			<span class="saleicon sale">Sale</span>         
			 <?php } ?>
			<?php /*<div class="button-group list">
			<div class="quickview"  title="<?php echo $button_quick; ?>" ><a href="<?php echo $product['quick']; ?>"><?php echo $button_quick; ?></a></div>
			</div>*/?>
		</div>
      	
		<div class="caption">
			<?php /*
			<div class="rating">
			  <?php for ($i = 1; $i <= 5; $i++) { ?>
			  <?php if ($product['rating'] < $i) { ?>
			  <span class="fa fa-stack"><i class="fa fa-star off fa-stack-2x"></i></span>
			  <?php } else { ?>
			  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
			  <?php } ?>
			  <?php } ?>
			</div>
		*/ ?>
				 	<h4 class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
					<?php if ($product['price']) { ?>
			<p class="price">
			  <?php if (!$product['special']) { ?>
			  <?php echo $product['price']; ?>
			  <?php } else { ?>
			 <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span> 
			  <?php } ?>
			  <?php if ($product['tax']) { ?>
			  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
			  <?php } ?>
			</p>
			<?php } ?>
					<div class="button-group grid">
		<div class="cart">
        	<button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button>
        </div>
	 </div>

		
			<?php /*?> <p><?php echo $product['description']; ?></p><?php */?>
			
			
			
			
			
			
        </div>
 	   
		  
  	</div>
	</div>
</div>
  
  <?php } ?>
</div>
  </div>
</div>
<span class="latest_default_width" style="display:none; visibility:hidden"></span>
