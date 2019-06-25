<?=form_open(site_url('dashboard/options/save_general'), 'class="general-settings"'); ?>
	<div class="form-group">
		<?=form_label('Site Name', 'site_name'); ?>
		<?=form_input('site_name', getOption('site_name'), 'class="form-control" id="site_name" placeholder="Exp. Rajtika IT"'); ?>
	</div>
	<div class="form-group">
		<?=form_label('Site URL', 'site_url'); ?>
		<?=form_input('site_url', getOption('site_url'), 'class="form-control" id="site_url" placeholder="Exp. rajtika.com"'); ?>
	</div>
	<div class="form-group">
		<?=form_label('Site Slogan (Motto)', 'site_slogan'); ?>
		<?=form_input('site_slogan', getOption('site_slogan'), 'class="form-control" id="site_slogan" placeholder="Exp. Service is our first priority."'); ?>
	</div>
	<div class="form-group">
		<?=form_label('Default User Password', 'default_password'); ?>
		<?php echo form_input('default_password', getOption('default_password'), 'class="form-control" id="default_password"'); ?>
	</div>
	<div class="form-group">
	<?=form_submit('submit', 'Save Changes', 'class="btn btn-primary save-general-settings"'); ?>
	</div>
<?=form_close(); ?>
