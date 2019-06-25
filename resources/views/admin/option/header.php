<?=form_open_multipart(site_url('dashboard/options/save_header'), 'class="general-settings"'); ?>
	<div class="form-group">
		<?=form_label('Site Logo', 'site_title'); ?>
		<?php echo form_hidden('logo', getOption('logo'), ''); ?>
		<?=form_upload('new_logo', '', 'class="form-control" id="logo" placeholder="Your site title"'); ?>
		<p><img src="<?php echo get_uploaddirectory_uri('logos/'.getOption('logo')); ?>" class="img-responsive" style="max-height:90;"></p>
	</div>
	<div class="form-group">
		<?=form_label('Fabicon', 'favicon'); ?>
		<?php echo form_hidden('favicon', getOption('favicon'), ''); ?>
		<?=form_upload('new_favicon', '', 'class="form-control" id="favicon"'); ?>
		<p><img src="<?php echo get_uploaddirectory_uri('logos/'.getOption('favicon')); ?>" class="img-responsive" style="max-height:50;"></p>
	</div>
	<div class="form-group">
	<?=form_label(); ?>
	<?=form_submit('submit', 'Save Changes', 'class="btn btn-primary save-general-settings"'); ?>
	</div>
<?=form_close(); ?>
