$(document).ready(function() {
    /**
     * Initial Jquery UI datetime picker on items
     */
    let els = $('.datetime-picker');

    els.each(function(index, element) {
        let items = $(element).find('input');

        $(items[0]).datepicker({
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd',
            onSelect: function(selectdate) {
                var dt = new Date(selectdate);
                dt.setDate(dt.getDate() + 1)
                $(items[1]).datepicker("option", "minDate", dt);
            }
        }).attr("autocomplete", "off");


    
        if(items[1]) {
            $(items[1]).datepicker({
                numberOfMonths: 1,
                dateFormat: 'yy-mm-dd',
                onSelect: function(selectdate) {
                    var dt = new Date(selectdate);
                    dt.setDate(dt.getDate())
                    $(items[0]).datepicker("option", "maxDate", dt);
                }
            }).attr("autocomplete", "off");
        }
    })

    $('.datetime-picker input').bind('input', function() {
        var c = this.selectionStart,
            r = /[^0-9-\s@./]/gi,
            v = $(this).val();
        if (r.test(v)) {
            $(this).val(v.replace(r, ''));
            c--;
        }
        this.setSelectionRange(c, c);
    });
});