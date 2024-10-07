<x-link class="btn btn-icon btn-primary" :href="route('admin.category.product', $id)">
    <i class="ti ti-eye"></i>
</x-link>

<x-button.modal-delete class="btn-icon" data-route="{{ route('admin.category.delete', $id) }}">
    <i class="ti ti-trash"></i>
</x-button.modal-delete>