/* DOIS CALENDARIOS (DATEPICKER RANGE) */
    $(function() {           
        $('.daterange').daterangepicker({
            "autoApply": true,
            "maxSpan": {
                "days": 20
            },
            "singleDatePicker": false,
            "locale": {
                "format": "MM/DD/YYYY",
                "separator": " - ",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "fromLabel": "Para",
                "toLabel": "De",
                "customRangeLabel": "Customizar",
                "weekLabel": "Sem",
                "daysOfWeek": [
                    "Dom",
                    "Seg",
                    "Ter",
                    "Qua",
                    "Qui",
                    "Sex",
                    "Sab"
                ],
                "monthNames": [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ],
                "firstDay": 1
            },
            "startDate": "06/15/2019",
            "endDate": "06/21/2019"
        }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    });


    /* UM CALENDARIO (DATEPICKER RANGE) */
    $('#demo').daterangepicker({
        "singleDatePicker": true,
        "startDate": "06/21/2019", // dataInicio
        "endDate": "06/26/2019", // data Fim
        "minDate": "06/21/2019", //data Inicio
        "maxDate": "06/26/2019", //data Fim
        "locale": {
            "format": "MM/DD/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Para",
            "toLabel": "De",
            "customRangeLabel": "Customizar",
            "weekLabel": "Sem",
            "daysOfWeek": [
                "Dom",
                "Seg",
                "Ter",
                "Qua",
                "Qui",
                "Sex",
                "Sab"
            ],
            "monthNames": [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ],
            "firstDay": 1
        }
    }, function(start, end, label) {
      console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
