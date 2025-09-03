<div class="filter__content">
	<ul class="nav-filter nav">
		<?php $title = array('','Khách sạn','Villa','Homestay','Resort','Du thuyền','Tour') ?>
		<?php $svg = array('','ks','villa','homestay','resort','duthuyen','tour') ?>
		<?php for($i=1; $i<7; $i++){ ?>
			<li class="nav-item">
				<a class="nav-link <?php if($i==1) echo 'active' ?>" href="javascript:void(0)" data-bs-toggle="tab" title="<?php echo $title[$i] ?>"><?php echo svg($svg[$i]) ?> <span><?php echo $title[$i] ?></span></a>
			</li>
		<?php } ?>
		<span class="khac d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modal-khac">
			<?php echo svg('dot') ?>
			Khác
		</span>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade active show">
			@include('frontend.ganeral.form-filter')
		</div>
	</div>
</div>
