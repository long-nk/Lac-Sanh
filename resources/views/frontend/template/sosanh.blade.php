<div class="modal fade" id="modal-sosanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header sticky-top">
				<div class="title-left">
					<h5 class="modal-title" id="exampleModalLongTitle">So sánh các phòng</h5>
				</div>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					{!! svg('close') !!}
				</button>
			</div>
			<div class="modal-body mdal-ss-room">
				<div class="mdal-ss-room--details">
					<div class="row row-custom">
						<?php for($i=1; $i<4; $i++){ ?>
							<div class="col-lg-3 col-md-4 col-custom">
								<div class="items">
									<div class="js-close-ss">×</div>
									<a class="ratio" href="#">
										<img src="{{asset('assets/images/phong' . $i . '.png')}}" alt="">
									</a>
									<h3><a href="#" title="">Phòng Deluxe 3 người (Deluxe Triple Room)</a></h3>
									<ul>
										<li>
											<span>Ngày thường:</span>
											<p>2.285.000 đ</p>
										</li>
										<li>
											<span>Chủ nhật:</span>
											<p>3.285.000 đ</p>
										</li>
									</ul>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="benefit">
					<h4>Những lợi ích nổi bật</h4>
					<div class="row">
						<?php for($i=1; $i<4; $i++){ ?>
						<div class="col-lg-3 col-md-4">
							<div class="benefit--content">
								<ul>
									<li>Bao gồm bữa sáng</li>
									<li>Đưa đón sân bay</li>
									<li>Miễn phí sử dụng phòng gym, bể bơi, jacuzzi tại SixFit</li>
									<li>Miễn phí sử dụng minibar (bia, nước ngọt) một lần cho một chặng ở</li>
									<li>Miễn phí trà và cà phê, nước suối trong phòng</li>
									<li>Tivi màng hình phẳng</li>
								</ul>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
