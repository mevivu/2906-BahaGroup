<span>{{ \App\Enums\Order\OrderStatus::getDescription($status) }}</span>
<br>
@if ($status == App\Enums\Order\OrderStatus::Completed->value)
    @if (!$is_reviewed && $created_at >= now()->subDays(14))
        <a id="review" href="{{ route('user.order.review', $id) }}" class="ml-2">Đánh giá đơn hàng</a>
    @elseif($is_reviewed)
        <a id="review-detail" href="{{ route('user.order.review_detail', $id) }}" class="ml-2">Xem đánh giá</a>
    @endif
@endif