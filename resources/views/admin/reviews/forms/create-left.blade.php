<style>
.review_rating {
  input {
    display: none;
    &:checked {
      & ~ label {
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
                    <label for="">{{ __('Khách hàng') }}</label>
                    <x-select name="user_id"
                    id="user_id"
                    class="select2-bs5-ajax"
                    data-url="{{ route('admin.search.select.user') }}"
                    :required="true">
                    </x-select>
                </div>
                <div class="mb-3">
                    <label for="">{{ __('Sản phẩm') }}</label>
                    <x-select name="product_id"
                    id="product_id"
                    class="select2-bs5-ajax"
                    data-url="{{ route('admin.search.select.product') }}"
                    :required="true">
                    </x-select>
                </div>
                <div class="review_rating">
                    @for ($i = 0; $i <= 5; $i++)
                        <input type="radio" value="{{ $i }}" id="star-{{ $i }}" name="rating"
                            {{ $i == $instance->rating ? 'checked' : '' }} />
                        <label for="star-{{ $i }}">★</label>
                    @endfor
                </div>
                <div class="mb-3">
                    <label for="">{{ __('Bình luận') }}:</label>
                    <textarea name="content" class="form-control">{{ old('content') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
