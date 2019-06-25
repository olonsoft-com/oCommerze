<?=form_open(site_url('dashboard/options/save_ads'), 'class="general-settings"'); ?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<?=form_label('Top Ad 468X60', 't-ads-468x60'); ?><br />
			<small>Ad keyword : t-ads-468x60</small>
			<?=form_textarea('t-ads-468x60', getOption('t-ads-468x60'), 'class="form-control" id="t-ads-468x60" placeholder="Your Text Ads (Dimention : Responsive)" style="height:120px;"'); ?>
		</div>
		<div class="form-group">
			<?=form_label('Text Ads (Dimention : Responsive)', 't-ads-responsive'); ?><br />
			<small>Ad keyword : t-ads-responsive</small>
			<?=form_textarea('t-ads-responsive', getOption('t-ads-responsive'), 'class="form-control" id="t-ads-responsive" placeholder="Your Text Ads (Dimention : Responsive)" style="height:120px;"'); ?>
		</div>
		<div class="form-group">
			<?=form_label('Text Ads (Dimention : 336 X 280)', 't-ads-336x280'); ?><br />
			<small>Ad keyword : t-ads-336x280</small>
			<?=form_textarea('t-ads-336x280', getOption('t-ads-336x280'), 'class="form-control" id="t-ads-336x280" placeholder="Your Text Ads (Dimention : 336 X 280)" style="height:120px;"'); ?>
		</div>
		<div class="form-group">
			<?=form_label('Link Ads (Dimention : 790)', 'l-ads-790'); ?><br />
			<small>Ad keyword : l-ads-790</small>
			<?=form_textarea('l-ads-790', getOption('l-ads-790'), 'class="form-control" id="l-ads-790" placeholder="Your Link Ads (Dimention : 790)" style="height:120px;"'); ?>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<?=form_label('Text Ads (Dimention : 300 X 250)', 't-ads-300x250'); ?><br />
			<small>Ad keyword : t-ads-300x250</small>
			<?=form_textarea('t-ads-300x250', getOption('t-ads-300x250'), 'class="form-control" id="t-ads-300x250" placeholder="Your Text Ads (Dimention : 300 X 250)" style="height:120px;"'); ?>
		</div>
		<div class="form-group">
			<?=form_label('Text Ads (Dimention : 320 X 50)', 't-ads-320x50'); ?><br />
			<small>Ad keyword : t-ads-320x50</small>
			<?=form_textarea('t-ads-320x50', getOption('t-ads-320x50'), 'class="form-control" id="t-ads-320x50" placeholder="Your Text Ads (Dimention : 320 X 50)" style="height:120px;"'); ?>
		</div>
		<div class="form-group">
			<?=form_label('Text Ads (Dimention : 160)', 'l-ads-160'); ?><br />
			<small>Ad keyword : l-ads-160</small>
			<?=form_textarea('l-ads-160', getOption('l-ads-160'), 'class="form-control" id="l-ads-160" placeholder="Your Text Ads (Dimention : 160)" style="height:120px;"'); ?>
		</div>
		<div class="form-group">
			<?php echo form_label('Ad Control', 'show_ads'); ?>
			<small>Display ads to your site or not?</small>
			<?php echo form_dropdown('show_ads', array('yes'=>'Yes', 'no'=>'No'), getOption('show_ads'), ''); ?>
		</div>
	</div>
	<div class="clearfix"></div>
		<div class="form-group">
			<?=form_submit('submit', 'Save Changes', 'class="btn btn-primary save-general-settings" style="margin-left:15px;"'); ?>
		</div>
</div>
<?=form_close(); ?>
