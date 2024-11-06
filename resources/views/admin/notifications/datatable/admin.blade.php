@if (isset($admin))
				<x-link :href="route('admin.admin.edit', $admin['id'])" :title="$admin['fullname']" class="text-decoration-none" />
@endif
