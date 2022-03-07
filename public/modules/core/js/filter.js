
class TableFilter {
    loadData($element) {
        const tableId = document.getElementsByName("filter_table_id");
        
        const ajax_table = $('#'+tableId[0].value).DataTable()
        var current_url = false;
        if (!current_url) {
            current_url = window.location.href
        }

        if ($element !== 'reset' && $element !== 'trash') {
            var old_parms = new URLSearchParams(ajax_table.ajax.params())

            var parmsNew = new URLSearchParams($element)
            parmsNew.delete('_method')
            parmsNew.delete('method')
            parmsNew.delete('uri')
            parmsNew.delete('ip')
            if (old_parms.has('trash')) {
                parmsNew.set('trash', 'trash')
            }
            if (old_parms.has('search')) {
                parmsNew.set('search', old_parms.get('search'))
            }
            
            var new_url = current_url+'?'+parmsNew.toString()

            ajax_table.ajax.url(new_url).load();

        } 
        if ($element === 'reset') {
             ajax_table.ajax.url(current_url).load()
        }
        if ($element === 'trash') {
            var parmsNew = new URLSearchParams({'trash': 'trash'});
            var new_url = current_url+'?'+parmsNew.toString()

             ajax_table.ajax.url(new_url).load()
        }

    }

    init() {
        let that = this;
        $.each($('.filter-items-wrap .filter-column-key'), (index, element) => {
            if ($(element).val()) {
                that.loadData($(element));
            }
        });        
       
       $(document).on('click', '.btn-apply', event => {
            event.preventDefault();
            let element = $('form').serialize();
            that.loadData(element);
           
        });
       $(document).on('click', '.btn-info', event => {
            event.preventDefault();
            let element = 'reset';
            that.loadData(element);
           
        });

        $(document).on('click', '.btn-reset-filter-item', event => {
            event.preventDefault();
            let _self = $(event.currentTarget);
            _self.closest('.filter-item').find('.filter-column-key').val('').trigger('change');
            _self.closest('.filter-item').find('.filter-column-operator').val('=');
            _self.closest('.filter-item').find('.filter-column-value').val('');
        });
         $(document).on('change', '.filter-column-key', event => {
            event.preventDefault();
            let _self = $(event.currentTarget);
            let t = event.currentTarget.options[event.currentTarget.selectedIndex].dataset.type;
            let el = _self.closest('.filter-item').find('.filter-column-value');
            el[0].setAttribute('type', t);
        });

        $(document).on('click', '.add-more-filter', () => {
            let $template = $(document).find('.sample-filter-item-wrap');
            let html = $template.html();

            $(document).find('.filter-items-wrap').append(html);

            let element = $(document).find('.filter-items-wrap .filter-item:last-child').find('.filter-column-key');
            // if ($(element).val()) {
            //     that.loadData(element);
            // }
        });

        $(document).on('click', '.btn-remove-filter-item', event => {
            event.preventDefault();
            $(event.currentTarget).closest('.filter-item').remove();
        });
        
        $(document).on("click", ".btn-show-table-options", event => {
             event.preventDefault();
             $(event.currentTarget).closest(".table-wrapper").find(".table-configuration-wrap").slideToggle(700);
        })

       $(document).on('click', '.btn-in-trash-filter', event => {
            event.preventDefault();
            let element = 'trash';
            that.loadData(element);
           
        });
    }
}

$(document).ready(() => {
    new TableFilter().init();
});
