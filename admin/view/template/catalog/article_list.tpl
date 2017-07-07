<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-category').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              </div>
	    </div>
            <div class="col-sm-6">
              <div class="input-group form-group">
                <select name="filter_category" id="input-category" class="form-control">
                  <option value="*"><?php echo $entry_category; ?></option>
                  <?php foreach ($categories as $category) { ?>
                  <?php if ($category['article_id'] == $filter_category) { ?>
                  <option value="<?php echo $category['article_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $category['article_id']; ?>"><?php echo $category['name']; ?></option> 
                  <?php } ?>
                  <?php } ?>
                </select>
		<span class="input-group-btn">
			<button type="button" id="button-edit" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-default"><i class="fa fa-pencil"></i></button>
		</span>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
              <button type="button" id="button-filter" class="btn btn-primary"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
              </div>
	    </div>
              </div>
            </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-category">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="a-image text-center"><?php echo $column_image; ?></td>
                  <td class="text-left"><?php if ($sort == 'name') { ?>
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                    <?php } ?></td>
                  <td class="a-category text-right"><?php echo $column_category; ?></td>
                  <td class="a-sort-order text-right"><?php if ($sort == 'sort_order') { ?>
                    <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort_order; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_sort_order; ?>"><?php echo $column_sort_order; ?></a>
                    <?php } ?></td>
                  <td class="a-date-added text-center"><?php if ($sort == 'date_added') { ?>
                    <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($articles) { ?>
                <?php foreach ($articles as $article) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($article['article_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $article['article_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $article['article_id']; ?>" />
                    <?php } ?></td>
                  <td class="a-image text-center"><?php if ($article['image']) { ?>
                    <img src="<?php echo $article['image']; ?>" alt="<?php echo $article['name']; ?>" class="img-thumbnail" />
                    <?php } else { ?>
                    <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
                    <?php } ?></td>
                  <td class="text-left"><?php echo $article['name']; ?></td>
                  <td class="a-category text-right"><?php echo $article['category']; ?></td>
                  <td class="a-sort-order text-right"><?php echo $article['sort_order']; ?></td>
                  <td class="a-date-added text-center"><?php echo $article['date_added']; ?></td>
                  <td class="text-right"><a href="<?php echo $article['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="7"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
        </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=catalog/article&token=<?php echo $token; ?>';

	var filter_name = $('input[name=\'filter_name\']').val();

	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	var filter_category = $('select[name=\'filter_category\']').val();

	if (filter_category != '*') {
		url += '&filter_category=' + encodeURIComponent(filter_category);
	}
            
	location = url;
});

$('#button-edit').on('click', function() {	
	var edit_category = $('select[name=\'filter_category\']').val();
	if (edit_category != '*') {
		var url = 'index.php?route=catalog/article/edit&token=<?php echo $token; ?>&article_id=' + edit_category;  
	location = url;
	} else {
		alert('<?php echo $error_selected; ?>');
	}
});
//--></script>
<?php echo $footer; ?>