<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      <?php if ($products) { ?>
      <div class="category_filter">
        <div class="col-md-4 btn-list-grid">
          <div class="btn-group">
            <button type="button" id="list-view" class="btn btn-default list"  title="<?php echo $button_list; ?>"><i class="fa fa-th-list"></i></button>
            <button type="button" id="grid-view" class="btn btn-default grid"  title="<?php echo $button_grid; ?>"><i class="fa fa-th-large"></i></button>
          </div>
        </div>
		<a  href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a>
		<div class="pagination-right">
		<div class="show_limit pull-right">
        <div class="col-md-1 text-right limit_label">
          <label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
        </div>
        <div class="col-md-2 text-right limit">
          <select id="input-limit" class="form-control" onchange="location = this.value;">
            <?php foreach ($limits as $limits) { ?>
            <?php if ($limits['value'] == $limit) { ?>
            <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
		</div>
		
		<div class="sorting pull-right">
        <div class="col-md-2 text-right sort_label">
          <label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
        </div>
        <div class="col-md-3 text-right sort">
          <select id="input-sort" class="form-control" onchange="location = this.value;">
            <?php foreach ($sorts as $sorts) { ?>
            <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
            <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
		</div>
		</div>
      </div>
  
      <div class="row layout">  
        <?php foreach ($products as $product) { ?>     
        <div class="product-layout product-list col-xs-12">
          <div class="product-thumb">
             <div class="product-block-inner">
  <div class="image">
			<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
			 
			 <?php if (!$product['special']) { ?>       
			 <?php } else { ?>
			<span class="saleicon sale">Sale</span>         
			 <?php } ?>
      <?php /*<div class="button-group list">
			<div class="quickview"  title="<?php echo $button_quick; ?>" ><a href="<?php echo $product['quick']; ?>"><?php echo $button_quick; ?></a></div>
			</div>*/ ?>
			</div>
			
          <div> 
		  
 <div class="caption">

	<h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>

             <p class="description"><?php echo $product['description']; ?></p>
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
             
              
			<div class="button_wishlist_compare">
                <button type="button" class="whishlist"  title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i><span class="hidden-xs hidden-sm hidden-md"><?php echo $button_wishlist; ?></span></button>
                <button type="button" class="compare"  title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i><span class="hidden-xs hidden-sm hidden-md"><?php echo $button_compare; ?></span></button>
            </div>
              
			 

            </div>

           </div>
        </div> 
          </div>
        </div>
        <?php } ?>
      </div>
      <div class="cate-pagination">
        <div class="col-sm-6 text-left"><?php echo $results; ?></div>
        <div class="col-sm-6 text-right"><?php echo $pagination; ?></div>
      </div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>