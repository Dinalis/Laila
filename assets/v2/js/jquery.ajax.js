
var ajaxtimeout = 2e4;

function xhrfGetStr(url, o) {
    $.ajax({
        url: url,
        timeout: ajaxtimeout
    })
        .done(function (t) {
            "function" == typeof o && o(t)
        })
}

function xhrfGetData(url, o) {
    $.ajax({
        dataType: "json",
        url: url,
        timeout: ajaxtimeout
    })
        .done(function (t) {
            "function" == typeof o && o(t)
        })
} ! function (t) {
    t(document).ajaxError(function (t, o, n, a) {
        alert("Terjadi kesalahan dalam pengambilan data")
    }),
        t.fn.xhrSetOption = function (o, n, a) {
            var e = xhrfGetURL(o);
            return n || (n = !1),
                t(this).each(function () {
                    var o = t(this);
                    t.ajax({
                        dataType: "json",
                        url: e,
                        timeout: ajaxtimeout
                    })
                        .done(function (t) {
                            !1 === n ? o.empty() : !0 === n ? o.html('<option value=""></option>') : o.html('<option value="">-- Pilih ' + n + " --</option>"),
                                jQuery.each(t.options, function (t, n) {
                                    o.append('<option value="' + n.key + '">' + n.value + "</option>")
                                }), "function" == typeof a && a()
                        })
                })
        }
}(jQuery);