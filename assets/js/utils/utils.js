class Utils {

    resetForm(form) {
        $(form).find('input, textarea, select').each((index, item) => {
            $(item).val('');
        });
    }
}

export default new Utils();