<div class="modal fade" id="modal-zoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header sticky-top">
				<div class="title-left">
					<h5 class="modal-title" id="exampleModalLongTitle">Deluxe Hướng Vườn 2 Giường Đơn</h5>
				</div>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					{!! svg('close') !!}
				</button>
			</div>
			<div class="modal-body mdal-details-room">
				<div class="row">
					<div class="col-lg-7">
						<ul class="nav">
							<li class="nav-items">
								<a class="nav-link active" data-bs-toggle="tab" href="#bancong" title="">Ban Công</a>
							</li>
							<li class="nav-items">
								<a class="nav-link" data-bs-toggle="tab" href="#phongngu" title="">Phòng ngủ</a>
							</li>
							<li class="nav-items">
								<a class="nav-link" data-bs-toggle="tab" href="#tolet" title="">Tolet</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade active show" id="bancong">
								<div class="tab-pane--album">
									<div class="img-top ratio">
										<img class="js-add-url" src="assets/images/z1.png" alt="">
									</div>
									<div class="img-b">
										<?php for($i=1; $i<5; $i++){ ?>
										<div class="img ratio js-img-pp">
											<img src="assets/images/z1.png" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a1.jpg" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a2.jpg" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a3.jpg" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a4.jpg" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a5.jpg" alt="">
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="tab-pane fade " id="phongngu">
								<div class="tab-pane--album">
									<div class="img-top ratio">
										<img class="js-add-url" src="assets/images/z1.png" alt="">
									</div>
									<div class="img-b">
										<?php for($i=1; $i<5; $i++){ ?>
										<div class="img ratio js-img-pp">
											<img src="assets/images/z1.png" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a1.jpg" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a2.jpg" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a3.jpg" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a4.jpg" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a5.jpg" alt="">
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="tab-pane fade " id="tolet">
								<div class="tab-pane--album">
									<div class="img-top ratio">
										<img class="js-add-url" src="assets/images/z1.png" alt="">
									</div>
									<div class="img-b">
										<?php for($i=1; $i<5; $i++){ ?>
										<div class="img ratio js-img-pp">
											<img src="assets/images/z1.png" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a1.jpg" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a2.jpg" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a3.jpg" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a4.jpg" alt="">
										</div>
										<div class="img ratio js-img-pp">
											<img src="assets/images/a5.jpg" alt="">
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="infor-room">
							<div class="infor-room--custom">
								<span>
									<img src="assets/images/user.png" alt="">
									2 người
								</span>
								<span>
									<img src="assets/images/m2.png" alt="">
									55m<up>2</up>
								</span>
								<span>
									<img src="assets/images/giuong2.png" alt="">
									2 giường đơn
								</span>
							</div>
							<div class="infor-room--li">
								<h4>Những lợi ích</h4>
								<div class="lis">
									<a href="#">Bao gồm bữa sáng</a>
									<a href="#">Đưa đón sân bay</a>
									<a href="#">Miễn phí sử dụng phòng gym, bể bơi, jacuzzi tại SixFit</a>
									<a href="#">Miễn phí sử dụng minibar (bia, nước ngọt) một lần cho một chặng ở</a>
									<a href="#">Miễn phí trà và cà phê, nước suối trong phòng</a>
									<a href="#">Tivi màng hình phẳng</a>
									<a href="#">Hệ thống cách âm</a>
								</div>
							</div>
							<div class="infor-room--tnr">
								<h4>Tiện nghi phòng</h4>
								<div class="tnr">
									<?php echo svg('tnp') ?>
									<span>Phòng tắm</span>
								</div>
								<ul>
									<li><?php echo svg('check2') ?> Khăn tắm</li>
									<li><?php echo svg('check2') ?> Tắm bồn hoặc tắm vòi hoa sen</li>
									<li><?php echo svg('check2') ?> Phòng tắm riêng</li>
									<li><?php echo svg('check2') ?> Phòng vệ sinh</li>
									<li><?php echo svg('check2') ?> Đồ dùng nhà tắm miễn phí</li>
								</ul>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
