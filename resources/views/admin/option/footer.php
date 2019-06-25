<?=form_open(site_url('dashboard/options/save_footer'), 'class="general-settings"'); ?>
	<div class="form-group">
	<?=form_label('Google Analytics Code', 'analytics'); ?>
	<?php echo form_textarea('analytics', getOption('analytics'), 'class="form-control" id="analytics" placeholder="Google Analytics Code" style="height:120px;"'); ?>
	</div>
	<div class="form-group">
	<?=form_label('Site Copyright Message', 'copyright'); ?>
	<?=form_input('copyright', getOption('copyright'), 'class="form-control" id="copyright" placeholder="Copyright message"'); ?>
	</div>
	<div class="form-group">
	<?=form_label(); ?>
	<?=form_submit('submit', 'Save Changes', 'class="btn btn-primary save-general-settings"'); ?>
	</div>
<?=form_close(); ?>
