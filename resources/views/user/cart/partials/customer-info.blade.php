@if (auth('web'))
				<div class="mb-3">
								<label for="fullName" class="form-label">Họ và tên</label>
								<x-input readonly :value="$user->fullname" type="text" class="form-control" name="fullName"
												placeholder="Nhập họ và tên" />
				</div>
				<div class="mb-3">
								<label for="address" class="form-label">Địa chỉ</label>
								<x-input readonly :value="$user->address" type="text" class="form-control" name="address"
												placeholder="Nhập địa chỉ" />
				</div>
				<div class="mb-3">
								<label for="phone" class="form-label">Số điện thoại</label>
								<x-input-phone readonly :value="$user->phone" name="phone" :required="true" />
				</div>
				<div class="mb-3">
								<label for="email" class="form-label">Email</label>
								<x-input-email readonly :value="$user->email" name="email" :required="true" />
				</div>
				<div class="mb-3">
								<label for="note" class="form-label">Ghi chú</label>
								<textarea class="form-control" name="note" rows="3" placeholder="Nhập ghi chú"></textarea>
				</div>
				<div class="form-check">
								<input class="form-check-input ms-3" type="checkbox" id="showDetails">
								<label class="form-check-label" for="showDetails">
												Giao đến địa chỉ khác
								</label>
				</div>
@else
				<div class="mb-3">
								<label for="fullName" class="form-label">Họ và tên</label>
								<x-input type="text" class="form-control" name="fullName" placeholder="Nhập họ và tên" />
				</div>
				<div class="mb-3">
								<label for="address" class="form-label">Địa chỉ</label>
								<x-input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ" />
				</div>
				<div class="mb-3">
								<label for="phone" class="form-label">Số điện thoại</label>
								<x-input-phone name="phone" :value="old('phone')" :required="true" />
				</div>
				<div class="mb-3">
								<label for="email" class="form-label">Email</label>
								<x-input-email name="email" :value="old('email')" :required="true" />
				</div>
				<div class="mb-3">
								<label for="note" class="form-label">Ghi chú</label>
								<textarea class="form-control" name="note" rows="3" placeholder="Nhập ghi chú"></textarea>
				</div>
				<div class="form-check">
								<input class="form-check-input ms-3" type="checkbox" id="showDetails">
								<label class="form-check-label" for="showDetails">
												Giao đến địa chỉ khác
								</label>
				</div>
@endif
