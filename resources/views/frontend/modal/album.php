<div class="modal modal-album fade" id="modal-album" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header align-items-center sticky-top">
				<div class="title-left">
					<h5 class="modal-title" id="exampleModalLongTitle">Khách sạn Mường Thanh Luxury Sông Hàn Đà Nẵng</h5>
					<div class="star">
						<?php echo svg('start') ?>
						<?php echo svg('start') ?>
						<?php echo svg('start') ?>
						<?php echo svg('start') ?>
						<?php echo svg('start') ?>
					</div>

				</div>
				<div class="button d-flex flex-column">
					<button type="button" style="margin-left:auto;margin-bottom: 10px;" class="close" data-bs-dismiss="modal" aria-label="Close">
						{!! svg('close') !!}
					</button>
					<button class="btn btn-blue" type="submit">Chọn phòng</button>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-9 col-md-8">
						<div class="album-table">
							<ul class="nav">
								<li class="nav-items">
									<a class="nav-link active" data-bs-toggle="tab" href="#tab1">
										<span class="ratio">
											<img src="assets/images/a1.jpg" alt="">
										</span>
										<span>Tất cả ảnh</span>
									</a>
								</li>
								<li class="nav-items">
									<a class="nav-link" data-bs-toggle="tab" href="#tab2">
										<span class="ratio">
											<img src="assets/images/a2.jpg" alt="">
										</span>
										<span>Ảnh ngoại cảnh</span>
									</a>
								</li>
								<li class="nav-items">
									<a class="nav-link" data-bs-toggle="tab" href="#tab3">
										<span class="ratio">
											<img src="assets/images/a3.jpg" alt="">
										</span>
										<span>Ảnh khác</span>
									</a>
								</li>
								<li class="nav-items">
									<a class="nav-link" data-bs-toggle="tab" href="#tab4">
										<span class="ratio">
											<img src="assets/images/a4.jpg" alt="">
										</span>
										<span>Ảnh nổi bật</span>
									</a>
								</li>
								<li class="nav-items">
									<a class="nav-link" data-bs-toggle="tab" href="#tab5">
										<span class="ratio">
											<img src="assets/images/a5.jpg" alt="">
										</span>
										<span>Ảnh người dùng đánh giá</span>
									</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade active show" id="tab1">
									<div class="row row-custom">
										<?php for($i=1; $i<16; $i++){ ?>
										<div class="col-lg-3 col-md-4 col-6 col-custom">
											<div class="images ratio">
												<img src="assets/images/b1.jpg" alt="">
											</div>
										</div>
									    <?php } ?>
									</div>
								</div>
								<div class="tab-pane fade" id="tab2">
									<div class="row row-custom">
										<?php for($i=1; $i<10; $i++){ ?>
										<div class="col-lg-3 col-md-4 col-6 col-custom">
											<div class="images ratio">
												<img src="assets/images/b2.jpg" alt="">
											</div>
										</div>
									    <?php } ?>
									</div>
								</div>
								<div class="tab-pane fade" id="tab3">
									<div class="row row-custom">
										<?php for($i=1; $i<6; $i++){ ?>
										<div class="col-lg-3 col-md-4 col-6 col-custom">
											<div class="images ratio">
												<img src="assets/images/b3.jpg" alt="">
											</div>
										</div>
									    <?php } ?>
									</div>
								</div>
								<div class="tab-pane fade" id="tab4">
									<div class="row row-custom">
										<?php for($i=1; $i<9; $i++){ ?>
										<div class="col-lg-3 col-md-4 col-6 col-custom">
											<div class="images ratio">
												<img src="assets/images/b4.png" alt="">
											</div>
										</div>
									    <?php } ?>
									</div>
								</div>
								<div class="tab-pane fade" id="tab5">
									<div class="row row-custom">
										<?php for($i=1; $i<7; $i++){ ?>
										<div class="col-lg-3 col-md-4 col-6 col-custom">
											<div class="images ratio">
												<img src="assets/images/b5.jpg" alt="">
											</div>
										</div>
									    <?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4">
						<div class="sidebar-modal">
							<div class="dg">
								<span class="dg-f">8.6</span>
								<div class="dg-content">
									<p>Rất tốt</p>
									<span>(52 đánh giá)</span>
								</div>
							</div>
							<div class="sidebar-modal--content">
								<span class="tl">Điều khách thích nhất:</span>
								<div class="list">
									<?php for($i=1; $i<20; $i++){ ?>
										<div class="items">
											<div class="img">TN</div>
											<div class="name">
												<p>Thanh Nguyễn</p>
												<span>Sạch sẽ thoáng mát, đồ ăn ngon</span>
											</div>
										</div>
									<?php } ?>
								</div>
								<div class="page-raiting">
									<h5>Đánh giá chi tiết</h5>
									<div class="raiting--infor raiting--infor2">
										<div class="raiting--infor--items">
											<p>Vị trí</p>
											<div class="width-if">

											</div>
											<p>1</p>
										</div>
										<div class="raiting--infor--items">
											<p>Giá cả</p>
											<div class="width-if">

											</div>
											<p>0</p>
										</div>
										<div class="raiting--infor--items">
											<p>Phục vụ</p>
											<div class="width-if">

											</div>
											<p>0</p>
										</div>
										<div class="raiting--infor--items">
											<p>Vệ sinh</p>
											<div class="width-if">

											</div>
											<p>0</p>
										</div>
										<div class="raiting--infor--items">
											<p>Tiện nghi</p>
											<div class="width-if">

											</div>
											<p>16</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
