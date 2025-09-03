<form class="form-filter" action="">
	<ul>
		<li class="items js-ganeral">
			<span class="items--title">Điểm đến</span>
			<input class="items--search js-show-address" type="text" name="" placeholder="Thành phố, khách sạn, địa điểm">
			<div class="sub-filter js-sub-custom">
				<div class="row">
					<div class="col-md-4">
						<div class="sub-filter--search">
							<div class="title">
								<h3>Tìm kiếm gần đây</h3>
								<a class="js-del-history" href="javascript:;">Xóa lịch sử tìm kiếm</a>
							</div>
							<div class="js-search-history list">
								<?php for($i=1; $i<5; $i++){ ?>
									<div class="items-sub">
										<div class="images">
											<?php echo svg('address3') ?>
										</div>
										<div class="text">
											<h4>Bà rịa - <span>Vũng Tàu</span></h4>
											<p>Việt nam</p>
										</div>
										<span class="ks">1743 <?php echo svg('ks1') ?></span>
									</div>
								<?php } ?>
								<div class="items-sub">
									<div class="images">
										<img src="assets/images/ks1.jpg" alt="">
									</div>
									<div class="text">
										<h4>Khách sạn Vias - <span>Vũng Tàu</span></h4>
										<p>Thành Phố Vũng Tàu, Bà Rịa - Vũng Tàu, Việt Nam</p>
										<span class="text--ks">Khách sạn</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="sub-filter--content">
							<h4 class="title">Địa điểm nổi bật</h4>
							<div class="row row-custom">
								<?php for($j=1; $j<19; $j++){ ?>
									<div class="col-xl-2 col-lg-3 col-md-4 col-4 col-custom">
										<div class="images">
											<div class="ratio">
												<img class="w-100 d-block" src="assets/images/t1.png">
											</div>
											<span>Hồ chí minh</span>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</li>
		<li class="items js-ganeral js-checkout">
			<div class="items--flex">
				<div class="items--flex--check ">
					<span class="items--title">Nhận phòng</span>
					<p class="items--flex--check__content" id="t-startdate">T7, 25 tháng 11</p>
				</div>
				<div class="jss139">
					<span id="dayCount">1</span>
					<?php echo svg('ngay') ?>
				</div>
				<div class="items--flex--check">
					<span class="items--title">Trả phòng</span>
					<p class="items--flex--check__content" id="t-enddate">CN, 26 tháng 11</p>
				</div>
				<div class="input-select-date">
					<input class="data-picker" type="text" name="startDate" id="startDate" />
					<input class="data-picker" type="text" name="endDate" id="endDate" />
				</div>
			</div>
		</li>
		<li class="items">
			<div class="js-ganeral js-show-bookzoom" id="filter-all">
				<span class="items--title">Số phòng, số khách</span>
				<p class="items--content js-content-bookzoom"><span class="js-zoom">1</span> phòng, <span class="js-peo">1</span> người lớn, <span class="js-tre">0</span> trẻ em</p>
				<div class="js-check-input">
					<input class="input-zoom" type="number" value="1" min="1" name="input-zoom">
					<input class="input-peo" type="number" value="1" min="1" name="input-peo">
					<input class="input-tre" type="number" value="0" min="0" name="input-tre">
				</div>
				<div class="sub-filter--checkn js-sub-custom">
					<div class="sidebar-left">
						<ul>
							<li class="js-check-active js-check-ng active">
								<span>Đi một mình</span>
								<p class="content-ng"><span class="js-number1">1</span> Phòng, <span class="js-number2"> 1</span> người lớn</p>
							</li>
							<li class="js-check-active js-check-ng">
								<span>Đi cặp đôi/2 người</span>
								<p class="content-ng"><span class="js-number1">1</span> Phòng, <span class="js-number2"> 2</span> người lớn</p>
							</li>
							<li class="js-check-active js-check-table">
								<span>Đi theo gia đình</span>
							</li>
							<li class="js-check-active js-check-table js-check-table-2">
								<span>Đi theo nhóm</span>
							</li>
							<li class="js-check-active js-check-table js-check-table-3">
								<span>Đi công tác</span>
							</li>
						</ul>
					</div>
					<div class="sidebar-right js-sidebar-right active-position">
						<div class="form-group">
							<p>Phòng</p>
							<div class="queti js-queti-zoom">
								<span class="icon minus"><?php echo svg('minus') ?></span>
								<span class="js-display-number">1</span>
								<span class="icon plus"><?php echo svg('plus') ?></span>
							</div>
						</div>
						<div class="form-group">
							<p>Người lớn</p>
							<div class="queti js-queti-peo">
								<span class="icon minus"><?php echo svg('minus') ?></span>
								<span class="js-display-number">1</span>
								<span class="icon plus"><?php echo svg('plus') ?></span>
							</div>
						</div>
						<div class="form-group js-none-tr">
							<p>Trẻ em</p>
							<div class="queti js-queti-tre">
								<span class="icon minus"><?php echo svg('minus') ?></span>
								<span class="js-display-number">0</span>
								<span class="icon plus"><?php echo svg('plus') ?></span>
							</div>
						</div>
						<div class="note-check">
							<h4>Bạn cần từ 16 phòng trở lên?</h4>
							<p>Chat ngay với VivaTrip để nhận được giá ưu đãi</p>
							<a class="btn btn-blue" href="#">Chat ngay</a>
						</div>
					</div>
				</div>
			</div>
            <div class="js-ganeral js-show-bookzoom filter-villa" id="filter-villa" style="display:none;">
                <span class="items--title">Số khách</span>
                <p class="items--content js-content-bookzoom"><span class="js-peo">1</span> người lớn, <span class="js-tre">0</span> trẻ em</p>
                <div class="js-check-input">
{{--                    <input class="input-zoom" type="number" value="1" min="1" name="input-zoom">--}}
                    <input class="input-peo" type="number" value="1" min="1" name="input-peo">
                    <input class="input-tre" type="number" value="0" min="0" name="input-tre">
                </div>
                <div class="sub-filter--checkn js-sub-custom">
                    <div class="sidebar-left">
                        <ul>
                            <li class="js-check-active js-check-ng active">
                                <div class="sidebar-right js-sidebar-right active-position">
                                    <div class="form-group">
                                        <p>Phòng</p>
                                        <div class="queti js-queti-zoom">
                                            <span class="icon minus"><?php echo svg('minus') ?></span>
                                            <span class="js-display-number">1</span>
                                            <span class="icon plus"><?php echo svg('plus') ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <p>Người lớn</p>
                                        <div class="queti js-queti-peo">
                                            <span class="icon minus"><?php echo svg('minus') ?></span>
                                            <span class="js-display-number">1</span>
                                            <span class="icon plus"><?php echo svg('plus') ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group js-none-tr">
                                        <p>Trẻ em</p>
                                        <div class="queti js-queti-tre">
                                            <span class="icon minus"><?php echo svg('minus') ?></span>
                                            <span class="js-display-number">0</span>
                                            <span class="icon plus"><?php echo svg('plus') ?></span>
                                        </div>
                                    </div>
                                    <div class="note-check">
                                        <h4>Bạn cần từ 16 phòng trở lên?</h4>
                                        <p>Chat ngay với VivaTrip để nhận được giá ưu đãi</p>
                                        <a class="btn btn-blue" href="#">Chat ngay</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
			<div class="items--flex--select css-mobile">
				<span class="items--title">Tiêu chuẩn</span>
				<div class="items--flex--select--option">
					<span class="js-display-s"><span>4</span> <?php echo svg('start') ?></span>
					<input class="d-none" type="text" name="start" class="val-star">
					<div class="list-start js-sub-custom js-list-start">
						<span class="js-sub-s">1 <?php echo svg('start') ?></span>
						<span class="js-sub-s">2 <?php echo svg('start') ?></span>
						<span class="js-sub-s">3 <?php echo svg('start') ?></span>
						<span class="js-sub-s">4 <?php echo svg('start') ?></span>
						<span class="js-sub-s">5 <?php echo svg('start') ?></span>
					</div>
				</div>
			</div>
		</li>

		<li class="items js-ganeral last">
			<div class="items--flex">
				<div class="items--flex--select">
					<span class="items--title">Tiêu chuẩn</span>
					<div class="items--flex--select--option">
						<span class="js-display-s"><span>4</span> <?php echo svg('start') ?></span>
						<input class="d-none" type="text" name="start" class="val-star">
						<div class="list-start js-sub-custom js-list-start">
							<span class="js-sub-s">1 <?php echo svg('start') ?></span>
							<span class="js-sub-s">2 <?php echo svg('start') ?></span>
							<span class="js-sub-s">3 <?php echo svg('start') ?></span>
							<span class="js-sub-s">4 <?php echo svg('start') ?></span>
							<span class="js-sub-s">5 <?php echo svg('start') ?></span>
						</div>
					</div>
				</div>
				<button class="btn btn-blue" type="submit"><?php echo svg('search') ?></button>
			</div>
		</li>
		<div>
			<div class="line line1"></div>
		<div class="line line2"></div>
		<div class="line line3"></div>
		</div>
	</ul>
</form>
