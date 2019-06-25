<?=form_open(site_url('dashboard/options/save_social'), 'class="general-settings"'); ?>
	<div class="form-group">
		<?=form_label('Facebook Url', 'facebook_url'); ?>
		<?=form_input('facebook_url', getOption('facebook_url'), 'class="form-control" id="facebook_url" placeholder="Facebook Url"'); ?>
	</div>
	<div class="form-group">
		<?=form_label('GooglePlus Url', 'googleplus_url'); ?>
		<?=form_input('googleplus_url', getOption('googleplus_url'), 'class="form-control" id="googleplus_url" placeholder="GooglePlus Url"'); ?>
	</div>
	<div class="form-group">
	<?=form_label('Twitter url', 'twitter_url'); ?>
	<?=form_input('twitter_url', getOption('twitter_url'), 'class="form-control" id="twitter_url" placeholder="Twitter Url"'); ?>
	</div>
	<div class="form-group">
	<?=form_label('Linkedin Url', 'linkedin_url'); ?>
	<?=form_input('linkedin_url', getOption('linkedin_url'), 'class="form-control" id="linkedin_url" placeholder="Linkedin Url"'); ?>
	</div>
	<div class="form-group">
	<?=form_label('Pinterest Url', 'pinterest_url'); ?>
	<?=form_input('pinterest_url', getOption('pinterest_url'), 'class="form-control" id="pinterest_url" placeholder="Pinterest Url"'); ?>
	</div>
	<div class="form-group">
	<?=form_label(); ?>
	<?=form_submit('submit', 'Save Changes', 'class="btn btn-primary save-general-settings"'); ?>
	</div>
<?=form_close(); ?>
