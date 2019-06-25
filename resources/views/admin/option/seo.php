<?=form_open(site_url('dashboard/options/save_seo'), 'class="general-settings"'); ?>
	<div class="form-group">
		<?=form_label('Site Title', 'site_title'); ?>
		<?=form_input('site_title', getOption('site_title'), 'class="form-control" id="site_title" placeholder="Your site title"'); ?>
	</div>
	<div class="form-group">
	<?=form_label('Site Description', 'site_description'); ?>
	<?=form_textarea('site_description', getOption('site_description'), 'class="form-control" id="site_description" placeholder="Your site description" style="height:120px;"'); ?>
	</div>
	<div class="form-group">
	<?=form_label('Site Keywords', 'site_keywords'); ?>
	<?=form_input('site_keywords', getOption('site_keywords'), 'class="form-control" id="site_keywords" placeholder="Your site keywords"'); ?>
	</div>
	<div class="form-group">
		<?=form_label('Site Index?', 'index_page'); ?>
		<?php echo form_dropdown('index_page', array('yes'=>'Yes', 'no'=>'No'), getOption('index_page'), ''); ?>
	</div>
	<div class="form-group">
	<?=form_label(); ?>
	<?=form_submit('submit', 'Save Changes', 'class="btn btn-primary save-general-settings"'); ?>
	</div>
<?=form_close(); ?>
