<link rel="stylesheet" href="{{ asset('user/assets/css/cart/shopping-cart.css') }}">

<div class="cart-container" id="cartContainer">
				<button class="close-button">
								<i class="fas fa-times"></i>
				</button>

				<div class="cart-panel">
								<div data-price="70" class="cart-item">
												<img src="{{ asset('/userfiles/images/phone/samsung-galaxy-s21-plus-256gb-bac-600x600-600x600.jpg') }}"
																alt="Product 1">
												<div class="cart-item-info">
																<h6>Product Name 1Product Name 1Product Name 1</h6>
																<p>70đ/1 product</p>
																<div class="quantity-controls">
																				<button class="minus-btn">-</button>
																				<span class="quantity">1</span>
																				<button class="plus-btn">+</button>
																</div>
																<p class="item-total">Total: 70đ</p>
												</div>
								</div>

								<div data-price="70" class="cart-item">
												<img src="{{ asset('/userfiles/images/phone/samsung-galaxy-s21-plus-256gb-bac-600x600-600x600.jpg') }}"
																alt="Product 2">
												<div class="cart-item-info">
																<h6>Product Name 2</h6>
																<p>$50/1 product</p>
																<div class="quantity-controls">
																				<button class="minus-btn">-</button>
																				<span class="quantity">4</span>
																				<button class="plus-btn">+</button>
																</div>
																<p class="item-total">Total: 70đ</p>
												</div>
								</div>
								<div data-price="70" class="cart-item">
												<img src="{{ asset('/userfiles/images/phone/samsung-galaxy-s21-plus-256gb-bac-600x600-600x600.jpg') }}"
																alt="Product 2">
												<div class="cart-item-info">
																<h6>Product Name 2</h6>
																<p>$50/1 product</p>
																<div class="quantity-controls">
																				<button class="minus-btn">-</button>
																				<span class="quantity">4</span>
																				<button class="plus-btn">+</button>
																</div>
																<p class="item-total">Total: 70đ</p>
												</div>
								</div>

								<div data-price="70" class="cart-item">
												<img src="{{ asset('/userfiles/images/phone/samsung-galaxy-s21-plus-256gb-bac-600x600-600x600.jpg') }}"
																alt="Product 3">
												<div class="cart-item-info">
																<h6>Product Name 3</h6>
																<p>$250/1 product</p>
																<div class="quantity-controls">
																				<button class="minus-btn">-</button>
																				<span class="quantity">1</span>
																				<button class="plus-btn">+</button>
																</div>
																<p class="item-total">Total: 70đ</p>
												</div>
								</div>
								<div data-price="70" class="cart-item">
												<img src="{{ asset('/userfiles/images/phone/samsung-galaxy-s21-plus-256gb-bac-600x600-600x600.jpg') }}"
																alt="Product 3">
												<div class="cart-item-info">
																<h6>Product Name 3</h6>
																<p>$250/1 product</p>
																<div class="quantity-controls">
																				<button class="minus-btn">-</button>
																				<span class="quantity">1</span>
																				<button class="plus-btn">+</button>
																</div>
																<p class="item-total">Total: 70đ</p>
												</div>
								</div>
								<div data-price="70" class="cart-item">
												<img src="{{ asset('/userfiles/images/phone/samsung-galaxy-s21-plus-256gb-bac-600x600-600x600.jpg') }}"
																alt="Product 3">
												<div class="cart-item-info">
																<h6>Product Name 3</h6>
																<p>$250/1 product</p>
																<div class="quantity-controls">
																				<button class="minus-btn">-</button>
																				<span class="quantity">1</span>
																				<button class="plus-btn">+</button>
																</div>
																<p class="item-total">Total: 70đ</p>
												</div>
								</div>
								<div data-price="70" class="cart-item">
												<img src="{{ asset('/userfiles/images/phone/samsung-galaxy-s21-plus-256gb-bac-600x600-600x600.jpg') }}"
																alt="Product 3">
												<div class="cart-item-info">
																<h6>Product Name 3</h6>
																<p>$250/1 product</p>
																<div class="quantity-controls">
																				<button class="minus-btn">-</button>
																				<span class="quantity">1</span>
																				<button class="plus-btn">+</button>
																</div>
																<p class="item-total">Total: 70đ</p>
												</div>
								</div>
				</div>

				<div class="cart-total">
								<p>35.000.000đ</p>
								<div>
												<button onclick="location.href='{{ route('user.cart.index') }}';" class="cart-button">Giỏ hàng</button>
												<button onclick="location.href='{{ route('user.cart.checkout') }}';" class="checkout-button">Thanh
																toán</button>
								</div>
				</div>
</div>

<script>
				// JavaScript Code
				const cartButtons = document.querySelectorAll('#cartButton');
				const cartContainer = document.getElementById('cartContainer');
				const closeButton = document.querySelector('.close-button');
				const checkoutButton = document.querySelector('.checkout-button');
				const minusBtns = document.querySelectorAll('.minus-btn');
				const plusBtns = document.querySelectorAll('.plus-btn');
				const quantitySpans = document.querySelectorAll('.quantity');
				const cartTotalElement = document.querySelector('.cart-total p');

				cartButtons.forEach(cartButton => {
								cartButton.addEventListener('click', () => {
												cartContainer.classList.toggle('open');
								});
				});

				closeButton.addEventListener('click', () => {
								cartContainer.classList.remove('open');
				});

				function updateItemTotal(cartItem, quantity) {
								const price = parseFloat(cartItem.getAttribute('data-price'));
								const itemTotal = price * quantity;
								cartItem.querySelector('.item-total').textContent = `Total: ${itemTotal.toFixed(2)}đ`;
								return itemTotal;
				}

				function updateCartTotal() {
								const cartItems = document.querySelectorAll('.cart-item');
								let cartTotal = 0;

								cartItems.forEach(cartItem => {
												const quantity = parseInt(cartItem.querySelector('.quantity').textContent);
												cartTotal += updateItemTotal(cartItem, quantity);
								});

								cartTotalElement.textContent = `${cartTotal.toFixed(2)}đ`; // Update cart total
				}

				minusBtns.forEach((btn, index) => {
								btn.addEventListener('click', () => {
												const cartItem = btn.closest('.cart-item');
												const quantityElement = cartItem.querySelector('.quantity');
												let quantity = parseInt(quantityElement.textContent);

												if (quantity > 1) {
																quantityElement.textContent = quantity - 1;
																updateCartTotal();
												} else {
																// Remove the item from the cart if quantity is 1 and minus is clicked
																cartItem.remove();
																updateCartTotal();
												}
								});
				});

				plusBtns.forEach((btn, index) => {
								btn.addEventListener('click', () => {
												const cartItem = btn.closest('.cart-item');
												const quantityElement = cartItem.querySelector('.quantity');
												let quantity = parseInt(quantityElement.textContent);

												quantityElement.textContent = quantity + 1;
												updateCartTotal();
								});
				});
</script>
