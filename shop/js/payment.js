function mtn(transaID, total_amount, number) {
    $.ajax({
        url: 'https://pay.npontu.com/api/pay',
        type: 'post',
        dataType: "jsonp",
        data: {
            number: number,
            vendor: 'mtn',
            uid: 'polista',
            pass: 'polistapass',
            tp: transaID,
            cbk: 'http://localhost/polista/shop/pages/onlinepayment.php',
            amt: total_amount,
            msg: 'PaymentForPurchase',
            trans_type: 'debit'
        },
        success: function(data) {
            console.log(data);
        },


    });

}



function tigo(transaID, total_amount, number) {
    $.ajax({
        url: 'https://pay.npontu.com/api/pay?',
        type: 'post',
        data: {
            number: number,
            vendor: 'tigo',
            uid: 'polista',
            pass: 'polistapass',
            tp: transaID,
            cbk: 'er',
            amt: total_amount,
            msg: 'PaymentForPurchase',
            trans_type: 'debit'
        },
        success: function() {

        }
    });

}



function vodafone(transaID, total_amount, number) {
    $.ajax({
        url: 'https://pay.npontu.com/api/pay?',
        type: 'post',
        data: {
            number: number,
            vendor: 'vodafone',
            uid: 'polista',
            pass: 'polistapass',
            tp: transaID,
            cbk: 'er',
            amt: total_amount,
            msg: 'PaymentForPurchase',
            vou: '422572322',
            trans_type: 'debit'
        },
        success: function() {

        }
    });

}