"use strict"; var KTModalUserSearch = function () {
    var e, t, n, s, a, r = function (e) {
        setTimeout((function () {
            var a = KTUtil.getRandomInt(1, 6);
            t.classList.add("d-none"), 3 === a ? (n.classList.add("d-none"),
                s.classList.remove("d-none")) : (n.classList.remove("d-none"),
                    s.classList.add("d-none")), e.complete()
        }), 1500)
    }, o = function (e) { t.classList.remove("d-none"), n.classList.add("d-none"), s.classList.add("d-none") }; return {
        init: function () {
            (e = document.querySelector("#kt_busca_usuarios")) && (e.querySelector('[data-kt-search-element="wrapper"]'),
                t = e.querySelector('[data-kt-search-element="suggestions"]'),
                n = e.querySelector('[data-kt-search-element="results"]'),
                s = e.querySelector('[data-kt-search-element="empty"]'),
                (a = new KTSearch(e)).on("kt.search.process", r),
                a.on("kt.search.clear", o))
        }
    }
}(); KTUtil.onDOMContentLoaded((function () { KTModalUserSearch.init() }));