<style>
    .review_rating.disabled {
        pointer-events: none; /* Vô hiệu hóa sự kiện chuột */
    }
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
            font-size: 1.2rem;
          }
        }

        h1 {
          font-family: sans-serif;
          color: #222;
        }
</style>
<div disable class="review_rating disabled">
    @for ($i = 0; $i < 5; $i++)
        <input type="radio" value="{{ $i }}" id="star-{{ $i }}" name="rating"
            {{ $i == $rating ? 'checked' : '' }} />
        <label for="star-{{ $i }}">★</label>
    @endfor
</div>
