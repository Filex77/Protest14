$(document).ready(function(e) {
    $('#register').on('submit', function(event) {
        if (validateForm()) {
            event.preventDefault();
        }
    });
    function validateForm() {
        $(".text-error").remove();
        // Проверка селектов
        let v_select1 = false;
        if ($("#sel_oblast :selected").val() == "") {
            v_select1 = true;
            $('#sel_oblast_chosen').after('<span class="text-error">Выберите опцию</span>');
        };
        let v_select2 = false;
        if ($("#sel_city :selected").val() == "") {
            v_select2 = true;
            $('#sel_city_chosen').after('<span class="text-error">Выберите опцию</span>');
        };
        // Проверка ФИО    
        let el_l = $("#username");
        if (el_l.val().length < 4) {
            var v_login = true;
            el_l.after('<span class="text-error">ФИО должен быть больше 3 символов</span>');
        }
        // Проверка e-mail
        let reg = /.+@.+\..+/i;
        let el_e = $("#email");
        let v_email = el_e.val() ? false : true;
        if (v_email) {
            el_e.after('<span class="text-error">Поле e-mail обязательно к заполнению</span>');
        } else if (!reg.test(el_e.val())) {
            v_email = true;
            el_e.after('<span class="text-error">Вы указали недопустимый e-mail</span>');
        }
        return (v_login || v_email || v_select1 || v_select2);
    }
}
);