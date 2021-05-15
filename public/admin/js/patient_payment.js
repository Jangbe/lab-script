$('#pasien_test').addClass('active');

function autotab(current,to, max,e){
    if (current[0].value.length>=max) {
        current[0].value = current[0].value.slice(0,max);
        to.focus();
    }
}

var subtotal = parseFloat($('#tagihan').val());
var total = 0;
var discount = 0;
var total_keseluruhan = 0;
function set_total(id_name=''){
    let nilai_admin=formated_price($('#nilai_admin').val().trim()==''?0:$('#nilai_admin').val(), '');
    let nilai_cito=formated_price($('#nilai_cito').val().trim()==''?0:$('#nilai_cito').val(), '');
    let nilai_discount=formated_price($('#nilai_discount').val().trim()==''?0:$('#nilai_discount').val(), '');
    let discount_persen=$('#discount_persen').val().trim()==''?0:parseFloat($('#discount_persen').val());

    // Untuk total
    total=subtotal+parseFloat(nilai_admin)+parseFloat(nilai_cito);

    // Untuk jumlah diskon
    if(id_name=='nilai_discount'){
        discount=parseInt(nilai_discount)/total*100;
        $('#discount_persen').val(discount);
        discount=formated_price($('#nilai_discount').val(),'');
    }else if(id_name!='bayar'){
        discount=parseFloat((discount_persen*total/100).toString().replace('.',','));
        $('#nilai_discount').val(formated_price(discount));
    }

    // Untuk total keseluruhan
    total_keseluruhan=formated_price(total-discount,'.',false);
    $('#total_keseluruhan').text('Rp. '+total_keseluruhan);
    total_keseluruhan=parseFloat(formated_price(total-discount,''));

    // Untuk sisa pembayaran
    let nilai_uangmuka=formated_price($('#nilai_uangmuka').val(),'');
    let sisa=total_keseluruhan-parseFloat(nilai_uangmuka);
    $('#tanggal_lunas').attr('disabled',sisa>0);
    if(sisa<1){
        $('#sisa').text('Kembalian: Rp. '+formated_price(sisa));
        $('#tanggal_lunas').parent().fadeIn();
    }else{
        $('#sisa').text('Sisa Pembayaaran: Rp. '+formated_price(sisa));
        $('#tanggal_lunas').parent().fadeOut();
    }
}
$('#tanggal_lunas').parent().hide();
set_total('nilai_discount');
let angka = "10000";
// Restricts input for the given textbox to the given inputFilter function.
function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
        if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
            this.value = "";
        }
        });
    });
}
$('.number').each(function(i, node){
    if(node.id!='discount_persen'){
        node.value = formated_price(node.value);
        setInputFilter(node,  function(value) {
            return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
        });
    }
})

$('.bayar').on('keyup change',function(e){
    let id_name=$(this)[0].id;
    set_total(id_name);
    if(id_name!='discount_persen'){
        let temp = formated_price($(this).val(),'');
        this.value=formated_price(temp);
    }
})
$('#nilai_uangmuka').on('keyup change',function(){
    set_total('bayar');
    let temp = formated_price($(this).val(),'');
    this.value=formated_price(temp);
})
