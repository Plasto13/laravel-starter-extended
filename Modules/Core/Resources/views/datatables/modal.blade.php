@include('core::table.partials.modal-item', [
    'type' => 'danger',
    'name' => 'modal-confirm-delete',
    'title' => trans('core::table.confirm_delete'),
    'content' => trans('core::table.confirm_delete_msg'),
    'action_name' => trans('core::table.delete'),
    'action_button_attributes' => [
        'class' => 'delete-crud-entry',
    ],
])

@include('core::table.partials.modal-item', [
    'type' => 'danger',
    'name' => 'delete-many-modal',
    'title' => trans('core::table.confirm_delete'),
    'content' => trans('core::table.confirm_delete_many_msg'),
    'action_name' => trans('core::table.delete'),
    'action_button_attributes' => [
        'class' => 'delete-many-entry-button',
    ],
])

@include('core::table.partials.modal-item', [
    'type' => 'info',
    'name' => 'modal-bulk-change-items',
    'title' => trans('core::table.bulk_changes'),
    'content' => '<div class="modal-bulk-change-content"></div>',
    'action_name' => trans('core::table.submit'),
    'action_button_attributes' => [
        'class' => 'confirm-bulk-change-button',
        'data-load-url' => '',
    ],
])