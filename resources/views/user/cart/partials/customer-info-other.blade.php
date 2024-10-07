<div id="details" style="display: none;">
				<div class="mb-3">
								<label for="name_other" class="form-label">Họ và tên khác</label>
								<x-input type="text" class="form-control" name="name_other" placeholder="Nhập họ và tên khác" />
				</div>
				<div class="mb-3">
								<label for="address_other" class="form-label">Địa chỉ khác</label>
								<x-input type="text" class="form-control" name="address_other" placeholder="Nhập địa chỉ khác" />
				</div>
				<div class="mb-3">
								<label for="phone_other" class="form-label">Số điện thoại khác</label>
								<x-input-phone name="phone_other" :value="old('phone_other')" :required="true" />
				</div>
				<div class="mb-3">
								<label for="note_other" class="form-label">Ghi chú khác</label>
								<textarea class="form-control" name="note_other" rows="3" placeholder="Nhập ghi chú khác"></textarea>
				</div>
</div>
