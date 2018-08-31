function checkBrowser() {
    var e = window.navigator.userAgent,
        t = e.indexOf("MSIE ");
    if (t > 0) {
        parseInt(e.substring(t + 5, e.indexOf(".", t)));
        return parseInt(e.substring(t + 5, e.indexOf(".", t)))
    }
    return 0
}

function reset(e) {
    time = 1, idle = 0
}

function start() {
    timer = setInterval("timeout()", interval)
}

function timeout() {
    0 == time && idle * interval > 300000 ? (sesout(), clearInterval(timer)) : (idle++, window.status = "Waktu jeda " + idle * interval / 1e3 + " detik"), time = 0
}

/*function timeout() {
    0 == time && idle * interval > 100 ? (alert('huwow'), clearInterval(timer)) : (idle++, window.status = "Waktu jeda " + idle * interval / 1e3 + " detik"), time = 0
}*/

function getDocHeight(e) {
    e = e || document;
    var t = e.body,
        n = e.documentElement,
        o = Math.max(t.scrollHeight, t.offsetHeight, n.clientHeight, n.scrollHeight, n.offsetHeight);
    return o
}

function setIframeHeight(e) {
    var t = document.getElementById(e),
        n = t.contentDocument ? t.contentDocument : t.contentWindow.document;
    t.style.visibility = "hidden", t.style.height = "10px", 0 == checkBrowser() ? "content" == e ? t.style.height = getDocHeight(n) + 30 + "px" : t.style.height = getDocHeight(n) + 4 + "px" : "content" == e ? getDocHeight(n) < 480 ? t.style.height = "480px" : t.style.height = getDocHeight(n) + 30 + "px" : getDocHeight(n) < 480 ? t.style.height = "480px" : t.style.height = getDocHeight(n) + 4 + "px", t.style.visibility = "visible", window.scrollBy(0, 75)
}

function frameload() {}

function clickedHeaderMenu(e, t, n) {
    waitingDialog.show(), reloadframes(e, t);
    for (var o = document.querySelectorAll(".nav-child"), i = 0; i < o.length; i++) o[i].className = o[i].className.replace("active", "");
    var a = document.getElementById(n);
    return a.className = a.className + " active", $("#sidemenu").collapse("show"), waitingDialog.hide(), !0
}

function reloadframes(e, t) {
    parent.content.location = e, parent.menus.location = t
}

function logout() {
    $("#logout").modal("show")
}

function goto(e) {
    waitingDialog.show(), frames.content.location.href = e, waitingDialog.hide(), window.innerWidth <= 768 && $("#sidemenu").collapse("toggle")
}

function PopupModal(e, t, n) {
    document.getElementById("POPUP_CONTENT_SRC").src = t, POPUP_MODAL_NAME.innerHTML = e, $("#POPUP_MODAL").modal(n)
}

top.location.target = "_top", "_top" != window.location.target && (top.location.href = window.location.href), "Netscape" == navigator.appName && (document.captureEvents(Event.MOUSEUP), document.captureEvents(Event.KEYPRESS), document.captureEvents(Event.MOUSEMOVE), document.captureEvents(Event.CLICK)), document.onmouseup = reset, document.onkeypress = reset, document.onmousemove = reset, document.onclick = reset;
var time = 0,
    idle = 0,
    section = "welcome",
    timer = null,
    interval = 15e3;
var lang;
$.ajaxSetup({
    cache: false
})
$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $.get('Home.jsp/lang', function(data) {
        lang = $.trim(data);
        if (lang == "id") {
            var e = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                t = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
                n = new Date;
        } else {
            var e = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                t = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                n = new Date;
        }
        n.setDate(n.getDate()), $("#Date").html(t[n.getDay()] + " " + n.getDate() + " " + e[n.getMonth()] + " " + n.getFullYear()), setInterval(function() {
            var e = (new Date).getSeconds();
            $("#sec").html((10 > e ? "0" : "") + e)
        }, 1e3), setInterval(function() {
            var e = (new Date).getMinutes();
            $("#min").html((10 > e ? "0" : "") + e)
        }, 1e3), setInterval(function() {
            var e = (new Date).getHours();
            $("#hours").html((10 > e ? "0" : "") + e)
        }, 1e3)
    });

}), $(function() {
    var e = $("#header_menu");
    e.on("click", "a", null, function() {
        e.collapse("hide")
    })
});

function PushChild(id, formid, value1 = '', value2 = '', value3 = '', value4 = '', value5 = '', value6 = '', value7 = '', value8 = '', value9 = '', value10 = '', value11= '', value12 = '', value13 = '', value14 = '') {
    switch (id) {
        case 'DEBIT_ACCOUNT':
            window.frames['content'].openPanel(1, value1);
            window.frames['content'].document.getElementById(formid).DEBIT_ACCOUNT.value = value1;
            window.frames['content'].document.getElementById(formid).DEBIT_ACCOUNT_NAME.value = value2;
            break;
        case 'BANK':
            window.frames['content'].document.getElementById('Transfer').BANK_NAME.value = value1;
            window.frames['content'].document.getElementById('Transfer').BANK_CODE.value = value2;
            break;
        case 'ACCOUNT':
            window.frames['content'].document.getElementById(formid).ACCOUNT.value = value1;
            break;
        case 'BIC':
            var result = value1 + " [" + value2 + "]";
            var element2 = window.frames['content'].document.getElementById(formid).elements[value3].value = result;
            break;
        case 'KODE_KERJA':
            window.frames['content'].document.getElementById(formid).typeofwork_name.value = value1;
            window.frames['content'].document.getElementById(formid).typeofwork_code.value = value2;
            break;
        case 'KODE_PROVINSI':
            window.frames['content'].document.getElementById(formid).province_name.value = value1;
            window.frames['content'].document.getElementById(formid).province_code.value = value2;
            break;
        case 'KODE_KOTA':
            window.frames['content'].document.getElementById(formid).city.value = value1;
            window.frames['content'].document.getElementById(formid).city_code.value = value2;
            break;
        case 'KODE_WARGANEGARA':
            window.frames['content'].document.getElementById(formid).nationality_name.value = value1;
            window.frames['content'].document.getElementById(formid).nationality_code.value = value2;
            break;
        case 'SHOW_INVESTOR':
            window.frames['content'].document.getElementById(formid).sidtable.value = value1;
            window.frames['content'].document.getElementById(formid).nametable.value = value2;
            window.frames['content'].document.getElementById(formid).statustable.value = value3;
            break;
        case 'FILTER_INVESTOR':
            window.frames['content'].document.getElementById(formid).sid.value = value1;
            window.frames['content'].document.getElementById(formid).fullname.value = value2;
            window.frames['content'].document.getElementById(formid).idcardno.value = value3;
            window.frames['content'].document.getElementById(formid).dateofbirth.value = value4;
            window.frames['content'].document.getElementById(formid).placeofbirth.value = value5;
            window.frames['content'].document.getElementById(formid).gender.value = value6;
            window.frames['content'].document.getElementById(formid).working.value = value7;
            window.frames['content'].document.getElementById(formid).city.value = value8;
            window.frames['content'].document.getElementById(formid).province.value = value9;
            window.frames['content'].document.getElementById(formid).address.value = value10;
            window.frames['content'].document.getElementById(formid).phonenumber.value = value11;
            window.frames['content'].document.getElementById(formid).mobilephonenumber.value = value12;
            window.frames['content'].document.getElementById(formid).email.value = value13;
            window.frames['content'].document.getElementById(formid).status.value = value14;
            break;
        case 'KODE_BANK':
            window.frames['content'].document.getElementById(formid).bankname.value = value1;
            window.frames['content'].document.getElementById(formid).bankid.value = value2;
            break;
        case 'KODE_SUBREG':
            window.frames['content'].document.getElementById(formid).subregname.value = value1;
            window.frames['content'].document.getElementById(formid).subregid.value = value2;
            break;
        case 'FUND_ACCOUNT':
            window.frames['content'].document.getElementById(formid).fundaccountid.value = value1;
            window.frames['content'].document.getElementById(formid).fundaccountno.value = value2;
            break;
        case 'SEC_ACCOUNT':
            window.frames['content'].document.getElementById(formid).secaccountid.value = value1;
            window.frames['content'].document.getElementById(formid).secaccountno.value = value2;
            break;
        case 'ORDER':
            window.frames['content'].document.getElementById(formid).orderno.value = value1;
            //window.frames['content'].document.getElementById(formid).amount.value = value2;
            break;
        case 'STATUS':
            window.frames['content'].document.getElementById(formid).statid.value = value1;
            window.frames['content'].document.getElementById(formid).stats.value = value2;
            //window.frames['content'].document.getElementById(formid).amount.value = value2;
            break;
        case 'KODE_WARGANEGARA_FRONT':
            document.getElementById(formid).nationality_name.value = value1;
            document.getElementById(formid).nationality_code.value = value2;
            break;
        case 'KODE_KERJA_FRONT':
            document.getElementById(formid).typeofwork_name.value = value1;
            document.getElementById(formid).typeofwork_code.value = value2;
            break;
        case 'KODE_PROVINSI_FRONT':
            document.getElementById(formid).province_name.value = value1;
            document.getElementById(formid).province_code.value = value2;
            break;
        case 'KODE_KOTA_FRONT':
            document.getElementById(formid).city.value = value1;
            document.getElementById(formid).city_code.value = value2;
            break;
        case 'SERI_ALL':
        {
            window.frames['content'].document.getElementById(formid).seriname.value = value1;
            window.frames['content'].document.getElementById(formid).seriid.value = value2;
        }    
    }
}

function doInquiryAccount(id_form, base_url, accountno)
{
    window.frames['content'].document.getElementById(id_form).accountname.value = "";

    $.ajax(
    {
        type: 'post',
        url : base_url + "Investor.jsp/doInquiryAccount",
        data: 
        {
            accountno : accountno
        },
        error: function()
        {
            alert("Error while request data");
        },
        success: function(data)
        {
            var arr_data = JSON.parse(data);

            if(arr_data.statuscode == "0001")
            {
                window.frames['content'].document.getElementById(id_form).accountname.value = arr_data.accountname;
            }
            else
            {
                alert(arr_data.statusdesc);
            }

        }
    });
}

function PushSeriDetail(formid, value1 = '', value2 = '', value3 = '', value4 = '', value5 = '', value6 = '', value7 = '', value8 = '', value9 = '', value10 = '', value11= '', value12 = '', value13 = '', value14 = '') {
    window.frames['content'].document.getElementById(formid).seriname.value = value1;
    window.frames['content'].document.getElementById(formid).seriid.value = value2;
    window.frames['content'].document.getElementById(formid).couponrate.value = value3;
    window.frames['content'].document.getElementById(formid).minorder.value = addCommas(value4);
    window.frames['content'].document.getElementById(formid).maxorder.value = addCommas(value5);
    window.frames['content'].document.getElementById(formid).multorder.value = addCommas(value6);
    window.frames['content'].document.getElementById(formid).val_min.value = value4;
    window.frames['content'].document.getElementById(formid).val_max.value = value5;
}

function countTot(idseri)
{
    var postData = {
        'idseri': idseri,
    };

    $.ajax({
        type: 'POST',
        url: 'Pemesanan.jsp/count_total',
        data: postData,     
        success: function(response)
        {
            window.frames['content'].document.getElementById('Pemesanan').totorder.value  = addCommas(response.trim());
        },
        error: function(xhr) {
        }
    });
};

function getQuotSeri(idseri)
{
     var postData = {
        'idseri': idseri,
    };

    $.ajax({
        type: 'POST',
        url: 'Pemesanan.jsp/get_kuota_seri',
        data: postData,
        dataType: 'JSON',     
        success: function(response)
        {
            window.frames['content'].document.getElementById('Pemesanan').quotorder.value  = addCommas(response["KuotaInvestor"]);
            window.frames['content'].document.getElementById('Pemesanan').quotordernat.value  = addCommas(response["KuotaNasional"]);
        },
        error: function(xhr) {
        }
    });
}

function countMaxRedeem(idseri, amount)
{
    var postData = {
        'seriid' : idseri,
        'amount' : amount,
    }

    $.ajax({
        type: 'POST',
        url: 'Redemption.jsp/count_max_redeem',
        data: postData,  
        dataType: 'JSON',    
        success: function(response)
        {
            window.frames['content'].document.getElementById('Redemption').maxred.value  = addCommas(response["MaxRedeem"]);
            window.frames['content'].document.getElementById('Redemption').multredem.value  = addCommas(response["MultipleRedeem"]);
        },
        error: function(xhr) {
        }
    });
}

function countSisaKepemilikan(kodepemesanan, idseri, amount)
{
    var postData = {
        'kodepemesanan' : kodepemesanan,
        'seriid' : idseri,
        'amount' : amount,
    }

    $.ajax({
        type: 'POST',
        url: 'Redemption.jsp/sisa_kepemilikan',
        data: postData,     
        success: function(response)
        {
            window.frames['content'].document.getElementById('Redemption').sisakepemilikan.value  = addCommas(response.trim());
            window.frames['content'].document.getElementById('Redemption').seriid.value = idseri;
        },
        error: function(xhr) {
        }
    });
}


function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

start();