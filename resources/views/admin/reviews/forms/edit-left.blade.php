<style>
    .review_rating {
        input {
            display: none;

            &:checked {
                &~label {
                    color: #aaa;
                }
            }
        }

        label {
            color: orange;
            font-size: 2rem;
        }
    }

    h1 {
        font-family: sans-serif;
        color: #222;
    }
</style>
<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin đánh giá') }}</h2>
        </div>
        <div class="row card-body">
            <div class="col-12">
                <div class="mb-3">
                    <label for=""><i class="ti ti-user"></i> {{ __('Khách hàng') }}</label>
                    <x-select name="user_id" id="user_id" class="select2-bs5-ajax"
                        data-url="{{ route('admin.search.select.user') }}" :required="true">
                        <x-select-option :option="$instance->user_id" :value="$instance->user_id" :title="$instance->user->fullname" />
                    </x-select>
                </div>
                <div class="mb-3">
                    <label for=""><i class="ti ti-building"></i> {{ __('Sản phẩm') }}</label>
                    <x-select name="product_id" id="product_id" class="select2-bs5-ajax"
                        data-url="{{ route('admin.search.select.product') }}" :required="true">
                        <x-select-option :option="$instance->product_id" :value="$instance->product_id" :title="$instance->product->name . ' - ' . $instance->product->price" />
                    </x-select>
                </div>
                <div class="review_rating">
                    <input type=radio value='0' id='star-0' name='rating' />

                    <label for='star-1'>★</label>
                    <input {{ $instance->rating == 1 ? 'checked' : '' }} type=radio value='1' id='star-1'
                        name='rating' />

                    <label for='star-2'>★</label>
                    <input {{ $instance->rating == 2 ? 'checked' : '' }} type=radio value='2' id='star-2'
                        name='rating' />

                    <label for='star-3'>★</label>
                    <input {{ $instance->rating == 3 ? 'checked' : '' }} type=radio value='3' id='star-3'
                        name='rating' />

                    <label for='star-4'>★</label>
                    <input {{ $instance->rating == 4 ? 'checked' : '' }} type=radio value='4' id='star-4'
                        name='rating' />

                    <label for='star-5'>★</label>
                    <input {{ $instance->rating == 5 ? 'checked' : '' }} type=radio value='5' id='star-5'
                        name='rating' />
                </div>
                <div class="mb-3">
                    <label for=""><i class="ti ti-message-2"></i> {{ __('Bình luận') }}:</label>
                    <x-textarea name="content" class="form-control"
                        :required="true">{{ $instance->content }}</x-textarea>
                </div>
                <input type="hidden" name="order_id" id="order_id" value="{{ $instance->order_id }}">
            </div>
        </div>
    </div>
</div>
