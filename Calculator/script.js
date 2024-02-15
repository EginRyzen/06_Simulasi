function insert(num) {
    var textarea = document.form.textarea;
    var jumlah = textarea.value;
    var operator = ['+', '-', '*', '/', '00', '.', '%'];

    if (jumlah === '0' && operator.includes(num)) {
        if (jumlah === '0' && num === '.') {
            textarea.value = jumlah + num
        } else {
            return;
        }
    }

    if (jumlah === '0' && num === '0') {
        if (jumlah.length === 1 && jumlah === '0') {
            return;
        } else {
            textarea.value = jumlah + num;
        }
    } else {
        if (jumlah.length === 1 && jumlah === '0') {
            textarea.value = num;
        } else {
            textarea.value = jumlah + num;
        }
    }

    if (operator.includes(num)) {
        var las = jumlah.charAt(jumlah.length - 1);
        if (operator.includes(las)) {
            textarea.value = jumlah.slice(0, -1) + num;
        } else {
            textarea.value = jumlah + num;
        }
    }
}

function clean() {
    document.form.textarea.value = '0';
}
function del() {
    var hasil = document.form.textarea.value;

    if (hasil.length === 1) {
        document.form.textarea.value = '0';
    } else {
        document.form.textarea.value = hasil.substring(0, hasil.length - 1);
    }
}

function equal() {
    var hasil = document.form.textarea.value;

    var las = hasil.charAt(hasil.length - 1);
    if (las.includes('%')) {
        var nilai = hasil.substring(0, hasil.length - 1);

        document.form.textarea.value = (nilai / 100);
    } else {
        document.form.textarea.value = eval(hasil);
    }
}