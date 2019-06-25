<?=form_open(site_url('dashboard/options/save_payment'), 'class="general-settings"'); ?>
	<div class="form-group">
		<?=form_label('Active bKash Payment Method?', 'active_bkash'); ?>
		<?=form_dropdown('active_bkash', array('yes'=>'Yes', 'no'=>'No'), getOption('active_bkash'), 'class="form-control" id="active_bkash"'); ?>
	</div>
	<div class="form-group">
		<?=form_label('bKash Number', 'bkash_number'); ?>
		<?=form_input('bkash_number', getOption('bkash_number'), 'class="form-control" id="bkash_number" placeholder="Your bKash Number"'); ?>
	</div>
	<div class="form-group">
	<?=form_label('Active Cash On Delivery?', 'active_ondelivery'); ?>
	<?=form_dropdown('active_ondelivery', array('yes'=>'Yes', 'no'=>'No'), getOption('active_ondelivery'), 'class="form-control" id="active_ondelivery"'); ?>
	</div>
	<div class="form-group">
	<?=form_label('Active Bank Transfer?', 'active_banktransfer'); ?>
	<?=form_dropdown('active_banktransfer', array('yes'=>'Yes', 'no'=>'No'), getOption('active_banktransfer'), 'class="form-control" id="active_banktransfer"'); ?>
	</div>
	<div class="form-group">
	<?=form_label(); ?>
	<?=form_submit('submit', 'Save Changes', 'class="btn btn-primary save-general-settings"'); ?>
	</div>
<?=form_close(); ?>