@if (isset($user))
				<x-link :href="route('admin.user.edit', $user_id)" :title="$user['fullname']" />
@else
				Khách hàng vãng lai
@endif
