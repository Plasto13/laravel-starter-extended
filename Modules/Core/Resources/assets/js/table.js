
    $(document).ready(() => {

        // fetch('/')
        //     .then(response => response.json())
        //     .then(data => {
        //         $.i18n().load(data);
        //     });

        function getCheckedIds(event){
            let _self = $(event.currentTarget);
            let table = _self.closest('.table-wrapper').find('.table').prop('id');

            let ids = [];
            let $table = $('#' + table);
            $table.find('.checkboxes:checked').each((i, el) => {
                ids[i] = $(el).val();
            });

            if (ids.length !== $table.find('.checkboxes').length) {
                _self.closest('.table-wrapper').find('.table-check-all').prop('checked', false);
            } else {
                _self.closest('.table-wrapper').find('.table-check-all').prop('checked', true);
            }
            return ids;
        
        };

        const tableId = document.getElementsByName("filter_table_id");       
        const ajax_table = $('#'+tableId[0].value).DataTable();

        ajax_table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );

        var headers = {
           "Content-Type": "application/json",                                                                                                
           "Access-Control-Origin": "*",
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
           'Authorization': 'Bearer '+$('meta[name="user-api-token"]').attr('content')
        }

        $('.bulk-change-item').on('click', event =>{
            event.preventDefault()
            let ids = getCheckedIds(event);
            let _self = $(event.currentTarget);
            bootbox.prompt({
                title: 'Uprava polozky '+_self.data('key'), 
                centerVertical: true,
                callback: function(value){ 
                    if (!value) {
                         growl('Ziadna zmena!', 'Info');
                        return;
                    }
                    if (!ids.length){
                         growl('Oh noes!", "Nevybrate poloky!', 'error');
                         return
                  }
                fetch(_self.data('saveUrl'), {
                    method: 'POST',
                    headers: headers,
                    body:  JSON.stringify({
                        key: _self.data('key'),
                        value: value,
                        locale: locale,
                        action: 'change',
                        ids: ids,

                    })
                })
                .then(response => response.json())
                .then(value => {
                    if (value.success) {
                        growl('Done', 'success');
                        ajax_table.draw();
                    }
                    if (!value.success) {
                        growl('Niekde sa stala chyba', 'error');
                        ajax_table.draw();
                    }
                })
                .catch(function(error) {
                    console.log(error);
                    growl('Niekde sa stala chyba', 'error');
                    ajax_table.draw();
                });
                }
            });
        })


        $('.bulk-delete-item').on('click', event =>{
            event.preventDefault()
            let ids = getCheckedIds(event);
            console.log(ids);
            let _self = $(event.currentTarget);
            console.log(_self.data('saveUrl'));
            bootbox.dialog({
                title: $.i18n('delete_selected_items'),
                message: "<p>"+$.i18n('are_you_sure')+"</p>",
                size: 'large',
                buttons: {
                    cancel: {
                        label: $.i18n('cancel'),
                        className: 'btn-info',
                        callback: function(){
                             growl('Vsetko v bezpeci!', 'Info');
                             ajax_table.draw();
                        }
                    },
                    ok: {
                        label: $.i18n('yes'),
                        className: 'btn-danger',
                        callback: function(){
                            if (!ids.length){
                                 growl('Oh noes!", "Nevybrate poloky!', 'error');
                                 return
                            }
                            fetch(_self.data('saveUrl'), {
                                method: 'POST',
                                headers: headers,
                                body:  JSON.stringify({
                                    key: _self.data('key'),
                                    value: _self.data('value'),
                                    action: 'delete',
                                    ids: ids,

                                })
                            })
                            .then(response => response.json())
                            .then(value => {
                                if (value.success) {
                                    growl('Done', 'success');
                                    ajax_table.draw();      
                                }
                                if (!value.success) {
                                    growl('Niekde sa stala chyba', 'error');
                                    ajax_table.draw();      
                                }
                            })
                            .catch(function(error) {
                                console.log(error);
                                growl('Niekde sa stala chyba', 'error');
                                ajax_table.draw();      
                            });
                        }
                    }
                }
            });          
        });


        $(document).on('change', '.table-check-all', event => {

            let _self = $(event.currentTarget);
            let table = _self.closest('.table-wrapper').find('.table').prop('id');

            let ids = [];
            let $table = $('#' + table);
            $table.find('.checkboxes').each((i, el) => {
                console.log();
                if (el.checked == false) {
                     ids[i] = $(el).val();
                }
            });
            console.log(ids);
                if (ids.length !== $table.find('.checkboxes').length) {
                    _self.closest('.table-wrapper').find('.checkboxes').prop('checked', false);
                } else {
                    _self.closest('.table-wrapper').find('.checkboxes').prop('checked', true);
                }
        });

        $(document).on('change', '.checkboxes', event => {
            let _self = $(event.currentTarget);
            let table = _self.closest('.table-wrapper').find('.table').prop('id');

            let ids = [];
            let $table = $('#' + table);
            $table.find('.checkboxes:checked').each((i, el) => {
                ids[i] = $(el).val();
            });
            console.log(ids);
            if (ids.length !== $table.find('.checkboxes').length) {
                _self.closest('.table-wrapper').find('.table-check-all').prop('checked', false);
            } else {
                _self.closest('.table-wrapper').find('.table-check-all').prop('checked', true);
            }
        });

        $(document).on('click', '.action-item', event => {
            event.preventDefault();
            let span = $(event.currentTarget).find('span[data-action]');
            let action = span.data('action');
            let url = span.data('href');
            if (action && url !== '#') {
                bootbox.dialog({
                    title: 'Are you Sure ????',
                    message: "<p>Nejaky text.</p>",
                    size: 'large',
                    buttons: {
                        cancel: {
                            label: "Cancel!",
                            className: 'btn-info',
                            callback: function(){
                                growl('All is safe', 'info');
                            }
                        },
                        ok: {
                            label: "Delelete",
                            className: 'btn-danger',
                            callback: function(){
                                $.ajax({
                                    url: url,
                                    headers: headers,
                                    method: 'DELETE',
                                    data: {
                                        "_method": 'DELETE',
                                    },
                                    success: function ($data)
                                    {
                                        growl('Deleted', 'success');
                                        ajax_table.draw();
                                    }
                                });
                            }
                        }
                    }
                });
            }
        });

        // handleActionsRow() {
        //     let that = this;
        //     $(document).on('click', '.deleteDialog', event => {
        //         event.preventDefault();
        //         let _self = $(event.currentTarget);

        //         $('.delete-crud-entry').data('section', _self.data('section')).data('parent-table', _self.closest('.table').prop('id'));
        //         $('.modal-confirm-delete').modal('show');
        //     });

        //     $('.delete-crud-entry').on('click', event => {
        //         event.preventDefault();
        //         let _self = $(event.currentTarget);

        //         _self.addClass('button-loading');

        //         let deleteURL = _self.data('section');

        //         $.ajax({
        //             url: deleteURL,
        //             type: 'DELETE',
        //             success: data => {
        //                 if (data.error) {
        //                     Botble.showError(data.message);
        //                 } else {
        //                     window.LaravelDataTables[_self.data('parent-table')].row($('a[data-section="' + deleteURL + '"]').closest('tr')).remove().draw();
        //                     Botble.showSuccess(data.message);
        //                 }

        //                 _self.closest('.modal').modal('hide');
        //                 _self.removeClass('button-loading');
        //             },
        //             error: data => {
        //                 Botble.handleError(data);
        //                 _self.removeClass('button-loading');
        //             }
        //         });
        //     });

        //     $(document).on('click', '.delete-many-entry-trigger', event => {
        //         event.preventDefault();
        //         let _self = $(event.currentTarget);

        //         let table = _self.closest('.table-wrapper').find('.table').prop('id');

        //         let ids = [];
        //         $('#' + table).find('.checkboxes:checked').each((i, el) => {
        //             ids[i] = $(el).val();
        //         });

        //         if (ids.length === 0) {
        //             Botble.showError('Please select at least one record to perform this action!');
        //             return false;
        //         }

        //         $('.delete-many-entry-button')
        //             .data('href', _self.prop('href'))
        //             .data('parent-table', table)
        //             .data('class-item', _self.data('class-item'));
        //         $('.delete-many-modal').modal('show');
        //     });

        //     $('.delete-many-entry-button').on('click', event => {
        //         event.preventDefault();

        //         let _self = $(event.currentTarget);

        //         _self.addClass('button-loading');

        //         let $table = $('#' + _self.data('parent-table'));

        //         let ids = [];
        //         $table.find('.checkboxes:checked').each((i, el) => {
        //             ids[i] = $(el).val();
        //         });

        //         $.ajax({
        //             url: _self.data('href'),
        //             type: 'DELETE',
        //             data: {
        //                 ids: ids,
        //                 class: _self.data('class-item')
        //             },
        //             success: data => {
        //                 if (data.error) {
        //                     Botble.showError(data.message);
        //                 } else {
        //                     $table.find('.table-check-all').prop('checked', false);
        //                     window.LaravelDataTables[_self.data('parent-table')].draw();
        //                     Botble.showSuccess(data.message);
        //                 }

        //                 _self.closest('.modal').modal('hide');
        //                 _self.removeClass('button-loading');
        //             },
        //             error: data => {
        //                 Botble.handleError(data);
        //                 _self.removeClass('button-loading');
        //             }
        //         });
        //     });

        //     $(document).on('click', '.bulk-change-item', event => {
        //         event.preventDefault();
        //         let _self = $(event.currentTarget);

        //         let table = _self.closest('.table-wrapper').find('.table').prop('id');

        //         let ids = [];
        //         $('#' + table).find('.checkboxes:checked').each((i, el) => {
        //             ids[i] = $(el).val();
        //         });

        //         if (ids.length === 0) {
        //             Botble.showError('Please select at least one record to perform this action!');
        //             return false;
        //         }

        //         that.loadBulkChangeData(_self);

        //         $('.confirm-bulk-change-button')
        //             .data('parent-table', table)
        //             .data('class-item', _self.data('class-item'))
        //             .data('key', _self.data('key'))
        //             .data('url', _self.data('save-url'));
        //         $('.modal-bulk-change-items').modal('show');
        //     });

        //     $(document).on('click', '.confirm-bulk-change-button', event => {
        //         event.preventDefault();
        //         let _self = $(event.currentTarget);
        //         let value = _self.closest('.modal').find('.input-value').val();
        //         let input_key = _self.data('key');

        //         let $table = $('#' + _self.data('parent-table'));

        //         let ids = [];
        //         $table.find('.checkboxes:checked').each((i, el) => {
        //             ids[i] = $(el).val();
        //         });

        //         _self.addClass('button-loading');

        //         $.ajax({
        //             url: _self.data('url'),
        //             type: 'POST',
        //             data: {
        //                 ids: ids,
        //                 key: input_key,
        //                 value: value,
        //                 class: _self.data('class-item')
        //             },
        //             success: data => {
        //                 if (data.error) {
        //                     Botble.showError(data.message);
        //                 } else {
        //                     $table.find('.table-check-all').prop('checked', false);
        //                     $.each(ids, (index, item) => {
        //                         window.LaravelDataTables[_self.data('parent-table')].row($table.find('.checkboxes[value="' + item + '"]').closest('tr')).remove().draw();
        //                     });
        //                     Botble.showSuccess(data.message);

        //                     _self.closest('.modal').modal('hide');
        //                     _self.removeClass('button-loading');
        //                 }
        //                 _self.text(text);
        //             },
        //             error: data => {
        //                 Botble.handleError(data);
        //                 _self.removeClass('button-loading');
        //             }
        //         });
        //     });
        // }

        // loadBulkChangeData($element) {
        //     let $modal = $('.modal-bulk-change-items');
        //     $.ajax({
        //         type: 'GET',
        //         url: $modal.find('.confirm-bulk-change-button').data('load-url'),
        //         data: {
        //             'class': $element.data('class-item'),
        //             'key': $element.data('key'),
        //         },
        //         success: res => {
        //             let data = $.map(res.data, (value, key) => {
        //                 return {id: key, name: value};
        //             });
        //             let $parent = $('.modal-bulk-change-content');
        //             $parent.html(res.html);

        //             let $input = $modal.find('input[type=text].input-value');
        //             if ($input.length) {
        //                 $input.typeahead({source: data});
        //                 $input.data('typeahead').source = data;
        //             }

        //             Botble.initResources();
        //         },
        //         error: error => {
        //             Botble.handleError(error);
        //         }
        //     });
        // }

        // handleActionsExport() {
        //     $(document).on('click', '.export-data', event => {
        //         let _self = $(event.currentTarget);
        //         let table = _self.closest('.table-wrapper').find('.table').prop('id');

        //         let ids = [];
        //         $('#' + table).find('.checkboxes:checked').each((i, el) => {
        //             ids[i] = $(el).val();
        //         });

        //         event.preventDefault();
        //         $.ajax({
        //             type: 'POST',
        //             url: _self.prop('href'),
        //             data: {
        //                 'ids-checked': ids,
        //             },
        //             success: response => {
        //                 let a = document.createElement('a');
        //                 a.href = response.file;
        //                 a.download = response.name;
        //                 document.body.appendChild(a);
        //                 a.trigger('click');
        //                 a.remove();
        //             },
        //             error: error => {
        //                 Botble.handleError(error);
        //             }
        //         });
        //     });
        // };
    });


