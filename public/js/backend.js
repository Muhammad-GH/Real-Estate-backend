(window.webpackJsonp = window.webpackJsonp || []).push([[2], {
    1: function (t, e, n) {
        n("szVC"), n("9EEk"), t.exports = n("hSCs")
    }, "8oxB": function (t, e) {
        var n, r, i = t.exports = {};

        function o() {
            throw new Error("setTimeout has not been defined")
        }

        function a() {
            throw new Error("clearTimeout has not been defined")
        }

        function s(t) {
            if (n === setTimeout) return setTimeout(t, 0);
            if ((n === o || !n) && setTimeout) return n = setTimeout, setTimeout(t, 0);
            try {
                return n(t, 0)
            } catch (e) {
                try {
                    return n.call(null, t, 0)
                } catch (e) {
                    return n.call(this, t, 0)
                }
            }
        }

        !function () {
            try {
                n = "function" == typeof setTimeout ? setTimeout : o
            } catch (t) {
                n = o
            }
            try {
                r = "function" == typeof clearTimeout ? clearTimeout : a
            } catch (t) {
                r = a
            }
        }();
        var l, c = [], u = !1, f = -1;

        function h() {
            u && l && (u = !1, l.length ? c = l.concat(c) : f = -1, c.length && d())
        }

        function d() {
            if (!u) {
                var t = s(h);
                u = !0;
                for (var e = c.length; e;) {
                    for (l = c, c = []; ++f < e;)l && l[f].run();
                    f = -1, e = c.length
                }
                l = null, u = !1, function (t) {
                    if (r === clearTimeout) return clearTimeout(t);
                    if ((r === a || !r) && clearTimeout) return r = clearTimeout, clearTimeout(t);
                    try {
                        r(t)
                    } catch (e) {
                        try {
                            return r.call(null, t)
                        } catch (e) {
                            return r.call(this, t)
                        }
                    }
                }(t)
            }
        }

        function p(t, e) {
            this.fun = t, this.array = e
        }

        function g() {
        }

        i.nextTick = function (t) {
            var e = new Array(arguments.length - 1);
            if (arguments.length > 1) for (var n = 1; n < arguments.length; n++)e[n - 1] = arguments[n];
            c.push(new p(t, e)), 1 !== c.length || u || s(d)
        }, p.prototype.run = function () {
            this.fun.apply(null, this.array)
        }, i.title = "browser", i.browser = !0, i.env = {}, i.argv = [], i.version = "", i.versions = {}, i.on = g, i.addListener = g, i.once = g, i.off = g, i.removeListener = g, i.removeAllListeners = g, i.emit = g, i.prependListener = g, i.prependOnceListener = g, i.listeners = function (t) {
            return []
        }, i.binding = function (t) {
            throw new Error("process.binding is not supported")
        }, i.cwd = function () {
            return "/"
        }, i.chdir = function (t) {
            throw new Error("process.chdir is not supported")
        }, i.umask = function () {
            return 0
        }
    }, "9EEk": function (t, e, n) {
        "use strict";
        n.r(e);
        n("rXeI")
    }, "9Wh1": function (t, e, n) {
        "use strict";
        var r = n("LvDl"), i = n.n(r), o = (n("vDqi"), n("PSD3")), a = n.n(o), s = n("EVdn"), l = n.n(s);
        n("8L3F"), n("SYky");
        window.$ = window.jQuery = l.a, window.Swal = a.a, window._ = i.a, window.axios = n("vDqi"), window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest"
    }, YuTi: function (t, e) {
        t.exports = function (t) {
            return t.webpackPolyfill || (t.deprecate = function () {
            }, t.paths = [], t.children || (t.children = []), Object.defineProperty(t, "loaded", {
                enumerable: !0,
                get: function () {
                    return t.l
                }
            }), Object.defineProperty(t, "id", {
                enumerable: !0, get: function () {
                    return t.i
                }
            }), t.webpackPolyfill = 1), t
        }
    }, cJnw: function (t, e) {
        $(function () {
            $("[data-method]").append(function () {
                return !$(this).find("form").length > 0 ? "\n<form action='" + $(this).attr("href") + "' method='POST' name='delete_item' style='display:none'>\n<input type='hidden' name='_method' value='" + $(this).attr("data-method") + "'>\n<input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr("content") + "'>\n</form>\n" : ""
            }).attr("href", "#").attr("style", "cursor:pointer;").attr("onclick", '$(this).find("form").submit();'), $("form").submit(function () {
                //return $(this).find('input[type="submit"]').attr("disabled", !0), $(this).find('button[type="submit"]').attr("disabled", !0), !0
            }), $("body").on("submit", "form[name=delete_item]", function (t) {
                t.preventDefault();
                var e = this, n = $('a[data-method="delete"]'),
                    r = n.attr("data-trans-button-cancel") ? n.attr("data-trans-button-cancel") : "Cancel",
                    i = n.attr("data-trans-button-confirm") ? n.attr("data-trans-button-confirm") : "Yes, delete",
                    o = n.attr("data-trans-title") ? n.attr("data-trans-title") : "Are you sure you want to delete this item?";
                Swal.fire({
                    title: o,
                    showCancelButton: !0,
                    confirmButtonText: i,
                    cancelButtonText: r,
                    type: "warning"
                }).then(function (t) {
                    t.value && e.submit()
                })
            }).on("click", "a[name=confirm_item]", function (t) {
                t.preventDefault();
                var e = $(this),
                    n = e.attr("data-trans-title") ? e.attr("data-trans-title") : "Are you sure you want to do this?",
                    r = e.attr("data-trans-button-cancel") ? e.attr("data-trans-button-cancel") : "Cancel",
                    i = e.attr("data-trans-button-confirm") ? e.attr("data-trans-button-confirm") : "Continue";
                Swal.fire({
                    title: n,
                    showCancelButton: !0,
                    confirmButtonText: i,
                    cancelButtonText: r,
                    type: "info"
                }).then(function (t) {
                    t.value && window.location.assign(e.attr("href"))
                })
            }), $('[data-toggle="tooltip"]').tooltip()
        })
    }, e922: function (t, e, n) {
        var r, i;
        (function () {
            var o, a, s, l, c, u, f, h, d, p, g, v, m, b, y, w, S, T, L, E, x, k, R, A, O, _, I, Y, P, C, X, j, W, M, H,
                D, N, q, U, B, $, F, K, G, Q, V, z, J, Z = [].slice, tt = {}.hasOwnProperty, et = function (t, e) {
                    for (var n in e) tt.call(e, n) && (t[n] = e[n]);
                    function r() {
                        this.constructor = t
                    }

                    return r.prototype = e.prototype, t.prototype = new r, t.__super__ = e.prototype, t
                }, nt = [].indexOf || function (t) {
                    for (var e = 0, n = this.length; e < n; e++)if (e in this && this[e] === t) return e;
                    return -1
                };
            for (x = {
                catchupTime: 100,
                initialRate: .03,
                minTime: 250,
                ghostTime: 100,
                maxProgressPerFrame: 20,
                easeFactor: 1.25,
                startOnPageLoad: !0,
                restartOnPushState: !0,
                restartOnRequestAfter: 500,
                target: "body",
                elements: { checkInterval: 100, selectors: ["body"] },
                eventLag: { minSamples: 10, sampleCount: 3, lagThreshold: 3 },
                ajax: { trackMethods: ["GET"], trackWebSockets: !0, ignoreURLs: [] }
            }, P = function () {
                var t;
                return null != (t = "undefined" != typeof performance && null !== performance && "function" == typeof performance.now ? performance.now() : void 0) ? t : +new Date
            }, X = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame, E = window.cancelAnimationFrame || window.mozCancelAnimationFrame, null == X && (X = function (t) {
                return setTimeout(t, 50)
            }, E = function (t) {
                return clearTimeout(t)
            }), W = function (t) {
                var e, n;
                return e = P(), (n = function () {
                    var r;
                    return (r = P() - e) >= 33 ? (e = P(), t(r, function () {
                        return X(n)
                    })) : setTimeout(n, 33 - r)
                })()
            }, j = function () {
                var t, e, n;
                return n = arguments[0], e = arguments[1], t = 3 <= arguments.length ? Z.call(arguments, 2) : [], "function" == typeof n[e] ? n[e].apply(n, t) : n[e]
            }, k = function () {
                var t, e, n, r, i, o, a;
                for (e = arguments[0], o = 0, a = (r = 2 <= arguments.length ? Z.call(arguments, 1) : []).length; o < a; o++)if (n = r[o]) for (t in n) tt.call(n, t) && (i = n[t], null != e[t] && "object" == typeof e[t] && null != i && "object" == typeof i ? k(e[t], i) : e[t] = i);
                return e
            }, S = function (t) {
                var e, n, r, i, o;
                for (n = e = 0, i = 0, o = t.length; i < o; i++)r = t[i], n += Math.abs(r), e++;
                return n / e
            }, A = function (t, e) {
                var n, r, i;
                if (null == t && (t = "options"), null == e && (e = !0), i = document.querySelector("[data-pace-" + t + "]")) {
                    if (n = i.getAttribute("data-pace-" + t), !e) return n;
                    try {
                        return JSON.parse(n)
                    } catch (t) {
                        return r = t, "undefined" != typeof console && null !== console ? console.error("Error parsing inline pace options", r) : void 0
                    }
                }
            }, f = function () {
                function t() {
                }

                return t.prototype.on = function (t, e, n, r) {
                    var i;
                    return null == r && (r = !1), null == this.bindings && (this.bindings = {}), null == (i = this.bindings)[t] && (i[t] = []), this.bindings[t].push({
                        handler: e,
                        ctx: n,
                        once: r
                    })
                }, t.prototype.once = function (t, e, n) {
                    return this.on(t, e, n, !0)
                }, t.prototype.off = function (t, e) {
                    var n, r, i;
                    if (null != (null != (r = this.bindings) ? r[t] : void 0)) {
                        if (null == e) return delete this.bindings[t];
                        for (n = 0, i = []; n < this.bindings[t].length;)this.bindings[t][n].handler === e ? i.push(this.bindings[t].splice(n, 1)) : i.push(n++);
                        return i
                    }
                }, t.prototype.trigger = function () {
                    var t, e, n, r, i, o, a, s, l;
                    if (n = arguments[0], t = 2 <= arguments.length ? Z.call(arguments, 1) : [], null != (a = this.bindings) ? a[n] : void 0) {
                        for (i = 0, l = []; i < this.bindings[n].length;)r = (s = this.bindings[n][i]).handler, e = s.ctx, o = s.once, r.apply(null != e ? e : this, t), o ? l.push(this.bindings[n].splice(i, 1)) : l.push(i++);
                        return l
                    }
                }, t
            }(), p = window.Pace || {}, window.Pace = p, k(p, f.prototype), C = p.options = k({}, x, window.paceOptions, A()), K = 0, Q = (z = ["ajax", "document", "eventLag", "elements"]).length; K < Q; K++)!0 === C[N = z[K]] && (C[N] = x[N]);
            d = function (t) {
                function e() {
                    return e.__super__.constructor.apply(this, arguments)
                }

                return et(e, t), e
            }(Error), a = function () {
                function t() {
                    this.progress = 0
                }

                return t.prototype.getElement = function () {
                    var t;
                    if (null == this.el) {
                        if (!(t = document.querySelector(C.target))) throw new d;
                        this.el = document.createElement("div"), this.el.className = "pace pace-active", document.body.className = document.body.className.replace(/pace-done/g, ""), document.body.className += " pace-running", this.el.innerHTML = '<div class="pace-progress">\n  <div class="pace-progress-inner"></div>\n</div>\n<div class="pace-activity"></div>', null != t.firstChild ? t.insertBefore(this.el, t.firstChild) : t.appendChild(this.el)
                    }
                    return this.el
                }, t.prototype.finish = function () {
                    var t;
                    return (t = this.getElement()).className = t.className.replace("pace-active", ""), t.className += " pace-inactive", document.body.className = document.body.className.replace("pace-running", ""), document.body.className += " pace-done"
                }, t.prototype.update = function (t) {
                    return this.progress = t, this.render()
                }, t.prototype.destroy = function () {
                    try {
                        this.getElement().parentNode.removeChild(this.getElement())
                    } catch (t) {
                        d = t
                    }
                    return this.el = void 0
                }, t.prototype.render = function () {
                    var t, e, n, r, i, o, a;
                    if (null == document.querySelector(C.target)) return !1;
                    for (t = this.getElement(), r = "translate3d(" + this.progress + "%, 0, 0)", i = 0, o = (a = ["webkitTransform", "msTransform", "transform"]).length; i < o; i++)e = a[i], t.children[0].style[e] = r;
                    return (!this.lastRenderedProgress || this.lastRenderedProgress | 0 !== this.progress | 0) && (t.children[0].setAttribute("data-progress-text", (0 | this.progress) + "%"), this.progress >= 100 ? n = "99" : (n = this.progress < 10 ? "0" : "", n += 0 | this.progress), t.children[0].setAttribute("data-progress", "" + n)), this.lastRenderedProgress = this.progress
                }, t.prototype.done = function () {
                    return this.progress >= 100
                }, t
            }(), h = function () {
                function t() {
                    this.bindings = {}
                }

                return t.prototype.trigger = function (t, e) {
                    var n, r, i, o, a;
                    if (null != this.bindings[t]) {
                        for (a = [], r = 0, i = (o = this.bindings[t]).length; r < i; r++)n = o[r], a.push(n.call(this, e));
                        return a
                    }
                }, t.prototype.on = function (t, e) {
                    var n;
                    return null == (n = this.bindings)[t] && (n[t] = []), this.bindings[t].push(e)
                }, t
            }(), F = window.XMLHttpRequest, $ = window.XDomainRequest, B = window.WebSocket, R = function (t, e) {
                var n, r;
                for (n in r = [], e.prototype) try {
                    null == t[n] && "function" != typeof e[n] ? "function" == typeof Object.defineProperty ? r.push(Object.defineProperty(t, n, {
                        get: function () {
                            return e.prototype[n]
                        }, configurable: !0, enumerable: !0
                    })) : r.push(t[n] = e.prototype[n]) : r.push(void 0)
                } catch (t) {
                    t
                }
                return r
            }, I = [], p.ignore = function () {
                var t, e, n;
                return e = arguments[0], t = 2 <= arguments.length ? Z.call(arguments, 1) : [], I.unshift("ignore"), n = e.apply(null, t), I.shift(), n
            }, p.track = function () {
                var t, e, n;
                return e = arguments[0], t = 2 <= arguments.length ? Z.call(arguments, 1) : [], I.unshift("track"), n = e.apply(null, t), I.shift(), n
            }, D = function (t) {
                var e;
                if (null == t && (t = "GET"), "track" === I[0]) return "force";
                if (!I.length && C.ajax) {
                    if ("socket" === t && C.ajax.trackWebSockets) return !0;
                    if (e = t.toUpperCase(), nt.call(C.ajax.trackMethods, e) >= 0) return !0
                }
                return !1
            }, g = function (t) {
                function e() {
                    var t, n = this;
                    e.__super__.constructor.apply(this, arguments), t = function (t) {
                        var e;
                        return e = t.open, t.open = function (r, i, o) {
                            return D(r) && n.trigger("request", { type: r, url: i, request: t }), e.apply(t, arguments)
                        }
                    }, window.XMLHttpRequest = function (e) {
                        var n;
                        return n = new F(e), t(n), n
                    };
                    try {
                        R(window.XMLHttpRequest, F)
                    } catch (t) {
                    }
                    if (null != $) {
                        window.XDomainRequest = function () {
                            var e;
                            return e = new $, t(e), e
                        };
                        try {
                            R(window.XDomainRequest, $)
                        } catch (t) {
                        }
                    }
                    if (null != B && C.ajax.trackWebSockets) {
                        window.WebSocket = function (t, e) {
                            var r;
                            return r = null != e ? new B(t, e) : new B(t), D("socket") && n.trigger("request", {
                                type: "socket",
                                url: t,
                                protocols: e,
                                request: r
                            }), r
                        };
                        try {
                            R(window.WebSocket, B)
                        } catch (t) {
                        }
                    }
                }

                return et(e, h), e
            }(), G = null, H = function (t) {
                var e, n, r, i;
                for (n = 0, r = (i = C.ajax.ignoreURLs).length; n < r; n++)if ("string" == typeof (e = i[n])) {
                    if (-1 !== t.indexOf(e)) return !0
                } else if (e.test(t)) return !0;
                return !1
            }, (O = function () {
                return null == G && (G = new g), G
            })().on("request", function (t) {
                var e, n, r, i, a;
                if (i = t.type, r = t.request, a = t.url, !H(a)) return p.running || !1 === C.restartOnRequestAfter && "force" !== D(i) ? void 0 : (n = arguments, "boolean" == typeof (e = C.restartOnRequestAfter || 0) && (e = 0), setTimeout(function () {
                    var t, e, a, s, l;
                    if ("socket" === i ? r.readyState < 2 : 0 < (a = r.readyState) && a < 4) {
                        for (p.restart(), l = [], t = 0, e = (s = p.sources).length; t < e; t++) {
                            if ((N = s[t]) instanceof o) {
                                N.watch.apply(N, n);
                                break
                            }
                            l.push(void 0)
                        }
                        return l
                    }
                }, e))
            }), o = function () {
                function t() {
                    var t = this;
                    this.elements = [], O().on("request", function () {
                        return t.watch.apply(t, arguments)
                    })
                }

                return t.prototype.watch = function (t) {
                    var e, n, r, i;
                    if (r = t.type, e = t.request, i = t.url, !H(i)) return n = "socket" === r ? new b(e) : new y(e), this.elements.push(n)
                }, t
            }(), y = function (t) {
                var e, n, r, i, o, a = this;
                if (this.progress = 0, null != window.ProgressEvent) for (t.addEventListener("progress", function (t) {
                    return t.lengthComputable ? a.progress = 100 * t.loaded / t.total : a.progress = a.progress + (100 - a.progress) / 2
                }, !1), n = 0, r = (o = ["load", "abort", "timeout", "error"]).length; n < r; n++)e = o[n], t.addEventListener(e, function () {
                    return a.progress = 100
                }, !1); else i = t.onreadystatechange, t.onreadystatechange = function () {
                    var e;
                    return 0 === (e = t.readyState) || 4 === e ? a.progress = 100 : 3 === t.readyState && (a.progress = 50), "function" == typeof i ? i.apply(null, arguments) : void 0
                }
            }, b = function (t) {
                var e, n, r, i, o = this;
                for (this.progress = 0, n = 0, r = (i = ["error", "open"]).length; n < r; n++)e = i[n], t.addEventListener(e, function () {
                    return o.progress = 100
                }, !1)
            }, l = function (t) {
                var e, n, r, i;
                for (null == t && (t = {}), this.elements = [], null == t.selectors && (t.selectors = []), n = 0, r = (i = t.selectors).length; n < r; n++)e = i[n], this.elements.push(new c(e))
            }, c = function () {
                function t(t) {
                    this.selector = t, this.progress = 0, this.check()
                }

                return t.prototype.check = function () {
                    var t = this;
                    return document.querySelector(this.selector) ? this.done() : setTimeout(function () {
                        return t.check()
                    }, C.elements.checkInterval)
                }, t.prototype.done = function () {
                    return this.progress = 100
                }, t
            }(), s = function () {
                function t() {
                    var t, e, n = this;
                    this.progress = null != (e = this.states[document.readyState]) ? e : 100, t = document.onreadystatechange, document.onreadystatechange = function () {
                        return null != n.states[document.readyState] && (n.progress = n.states[document.readyState]), "function" == typeof t ? t.apply(null, arguments) : void 0
                    }
                }

                return t.prototype.states = { loading: 0, interactive: 50, complete: 100 }, t
            }(), u = function () {
                var t, e, n, r, i, o = this;
                this.progress = 0, t = 0, i = [], r = 0, n = P(), e = setInterval(function () {
                    var a;
                    return a = P() - n - 50, n = P(), i.push(a), i.length > C.eventLag.sampleCount && i.shift(), t = S(i), ++r >= C.eventLag.minSamples && t < C.eventLag.lagThreshold ? (o.progress = 100, clearInterval(e)) : o.progress = 3 / (t + 3) * 100
                }, 50)
            }, m = function () {
                function t(t) {
                    this.source = t, this.last = this.sinceLastUpdate = 0, this.rate = C.initialRate, this.catchup = 0, this.progress = this.lastProgress = 0, null != this.source && (this.progress = j(this.source, "progress"))
                }

                return t.prototype.tick = function (t, e) {
                    var n;
                    return null == e && (e = j(this.source, "progress")), e >= 100 && (this.done = !0), e === this.last ? this.sinceLastUpdate += t : (this.sinceLastUpdate && (this.rate = (e - this.last) / this.sinceLastUpdate), this.catchup = (e - this.progress) / C.catchupTime, this.sinceLastUpdate = 0, this.last = e), e > this.progress && (this.progress += this.catchup * t), n = 1 - Math.pow(this.progress / 100, C.easeFactor), this.progress += n * this.rate * t, this.progress = Math.min(this.lastProgress + C.maxProgressPerFrame, this.progress), this.progress = Math.max(0, this.progress), this.progress = Math.min(100, this.progress), this.lastProgress = this.progress, this.progress
                }, t
            }(), q = null, M = null, T = null, U = null, w = null, L = null, p.running = !1, _ = function () {
                if (C.restartOnPushState) return p.restart()
            }, null != window.history.pushState && (V = window.history.pushState, window.history.pushState = function () {
                return _(), V.apply(window.history, arguments)
            }), null != window.history.replaceState && (J = window.history.replaceState, window.history.replaceState = function () {
                return _(), J.apply(window.history, arguments)
            }), v = { ajax: o, elements: l, document: s, eventLag: u }, (Y = function () {
                var t, e, n, r, i, o, s, l;
                for (p.sources = q = [], e = 0, r = (o = ["ajax", "elements", "document", "eventLag"]).length; e < r; e++)!1 !== C[t = o[e]] && q.push(new v[t](C[t]));
                for (n = 0, i = (l = null != (s = C.extraSources) ? s : []).length; n < i; n++)N = l[n], q.push(new N(C));
                return p.bar = T = new a, M = [], U = new m
            })(), p.stop = function () {
                return p.trigger("stop"), p.running = !1, T.destroy(), L = !0, null != w && ("function" == typeof E && E(w), w = null), Y()
            }, p.restart = function () {
                return p.trigger("restart"), p.stop(), p.start()
            }, p.go = function () {
                var t;
                return p.running = !0, T.render(), t = P(), L = !1, w = W(function (e, n) {
                    var r, i, o, a, s, l, c, u, f, h, d, g, v, b, y;
                    for (100 - T.progress, i = h = 0, o = !0, l = d = 0, v = q.length; d < v; l = ++d)for (N = q[l], f = null != M[l] ? M[l] : M[l] = [], c = g = 0, b = (s = null != (y = N.elements) ? y : [N]).length; g < b; c = ++g)a = s[c], o &= (u = null != f[c] ? f[c] : f[c] = new m(a)).done, u.done || (i++, h += u.tick(e));
                    return r = h / i, T.update(U.tick(e, r)), T.done() || o || L ? (T.update(100), p.trigger("done"), setTimeout(function () {
                        return T.finish(), p.running = !1, p.trigger("hide")
                    }, Math.max(C.ghostTime, Math.max(C.minTime - (P() - t), 0)))) : n()
                })
            }, p.start = function (t) {
                k(C, t), p.running = !0;
                try {
                    T.render()
                } catch (t) {
                    d = t
                }
                return document.querySelector(".pace") ? (p.trigger("start"), p.go()) : setTimeout(p.start, 50)
            }, r = [n("e922")], void 0 === (i = function () {
                return p
            }.apply(e, r)) || (t.exports = i)
        }).call(this)
    }, hSCs: function (t, e) {
    }, rXeI: function (t, e, n) {
        (function (t) {
            (function (e, n, r) {
                "use strict";
                n = n && n.hasOwnProperty("default") ? n.default : n, r = r && r.hasOwnProperty("default") ? r.default : r;
                var i = function (t) {
                    try {
                        return !!t()
                    } catch (t) {
                        return !0
                    }
                }, o = !i(function () {
                    return 7 != Object.defineProperty({}, "a", {
                        get: function () {
                            return 7
                        }
                    }).a
                }),
                    a = "undefined" != typeof globalThis ? globalThis : "undefined" != typeof window ? window : void 0 !== t ? t : "undefined" != typeof self ? self : {};

                function s(t, e) {
                    return t(e = { exports: {} }, e.exports), e.exports
                }

                var l, c, u, f = "object", h = function (t) {
                    return t && t.Math == Math && t
                },
                    d = h(typeof globalThis == f && globalThis) || h(typeof window == f && window) || h(typeof self == f && self) || h(typeof a == f && a) || Function("return this")(),
                    p = function (t) {
                        return "object" == typeof t ? null !== t : "function" == typeof t
                    }, g = d.document, v = p(g) && p(g.createElement), m = function (t) {
                        return v ? g.createElement(t) : {}
                    }, b = !o && !i(function () {
                        return 7 != Object.defineProperty(m("div"), "a", {
                            get: function () {
                                return 7
                            }
                        }).a
                    }), y = function (t) {
                        if (!p(t)) throw TypeError(String(t) + " is not an object");
                        return t
                    }, w = function (t, e) {
                        if (!p(t)) return t;
                        var n, r;
                        if (e && "function" == typeof (n = t.toString) && !p(r = n.call(t))) return r;
                        if ("function" == typeof (n = t.valueOf) && !p(r = n.call(t))) return r;
                        if (!e && "function" == typeof (n = t.toString) && !p(r = n.call(t))) return r;
                        throw TypeError("Can't convert object to primitive value")
                    }, S = Object.defineProperty, T = {
                        f: o ? S : function (t, e, n) {
                            if (y(t), e = w(e, !0), y(n), b) try {
                                return S(t, e, n)
                            } catch (t) {
                            }
                            if ("get" in n || "set" in n) throw TypeError("Accessors not supported");
                            return "value" in n && (t[e] = n.value), t
                        }
                    }, L = function (t, e) {
                        return { enumerable: !(1 & t), configurable: !(2 & t), writable: !(4 & t), value: e }
                    }, E = o ? function (t, e, n) {
                        return T.f(t, e, L(1, n))
                    } : function (t, e, n) {
                        return t[e] = n, t
                    }, x = function (t, e) {
                        try {
                            E(d, t, e)
                        } catch (n) {
                            d[t] = e
                        }
                        return e
                    }, k = s(function (t) {
                        var e = d["__core-js_shared__"] || x("__core-js_shared__", {});
                        (t.exports = function (t, n) {
                            return e[t] || (e[t] = void 0 !== n ? n : {})
                        })("versions", []).push({
                            version: "3.1.3",
                            mode: "global",
                            copyright: "© 2019 Denis Pushkarev (zloirock.ru)"
                        })
                    }), R = {}.hasOwnProperty, A = function (t, e) {
                        return R.call(t, e)
                    }, O = k("native-function-to-string", Function.toString), _ = d.WeakMap,
                    I = "function" == typeof _ && /native code/.test(O.call(_)), Y = 0, P = Math.random(),
                    C = function (t) {
                        return "Symbol(".concat(void 0 === t ? "" : t, ")_", (++Y + P).toString(36))
                    }, X = k("keys"), j = function (t) {
                        return X[t] || (X[t] = C(t))
                    }, W = {}, M = d.WeakMap;
                if (I) {
                    var H = new M, D = H.get, N = H.has, q = H.set;
                    l = function (t, e) {
                        return q.call(H, t, e), e
                    }, c = function (t) {
                        return D.call(H, t) || {}
                    }, u = function (t) {
                        return N.call(H, t)
                    }
                } else {
                    var U = j("state");
                    W[U] = !0, l = function (t, e) {
                        return E(t, U, e), e
                    }, c = function (t) {
                        return A(t, U) ? t[U] : {}
                    }, u = function (t) {
                        return A(t, U)
                    }
                }
                var B, $, F = {
                    set: l, get: c, has: u, enforce: function (t) {
                        return u(t) ? c(t) : l(t, {})
                    }, getterFor: function (t) {
                        return function (e) {
                            var n;
                            if (!p(e) || (n = c(e)).type !== t) throw TypeError("Incompatible receiver, " + t + " required");
                            return n
                        }
                    }
                }, K = s(function (t) {
                    var e = F.get, n = F.enforce, r = String(O).split("toString");
                    k("inspectSource", function (t) {
                        return O.call(t)
                    }), (t.exports = function (t, e, i, o) {
                        var a = !!o && !!o.unsafe, s = !!o && !!o.enumerable, l = !!o && !!o.noTargetGet;
                        "function" == typeof i && ("string" != typeof e || A(i, "name") || E(i, "name", e), n(i).source = r.join("string" == typeof e ? e : "")), t !== d ? (a ? !l && t[e] && (s = !0) : delete t[e], s ? t[e] = i : E(t, e, i)) : s ? t[e] = i : x(e, i)
                    })(Function.prototype, "toString", function () {
                        return "function" == typeof this && e(this).source || O.call(this)
                    })
                }), G = !!Object.getOwnPropertySymbols && !i(function () {
                    return !String(Symbol())
                }), Q = d.Symbol, V = k("wks"), z = function (t) {
                    return V[t] || (V[t] = G && Q[t] || (G ? Q : C)("Symbol." + t))
                }, J = function () {
                    var t = y(this), e = "";
                    return t.global && (e += "g"), t.ignoreCase && (e += "i"), t.multiline && (e += "m"), t.unicode && (e += "u"), t.sticky && (e += "y"), e
                }, Z = RegExp.prototype.exec, tt = String.prototype.replace, et = Z,
                    nt = (B = /a/, $ = /b*/g, Z.call(B, "a"), Z.call($, "a"), 0 !== B.lastIndex || 0 !== $.lastIndex),
                    rt = void 0 !== /()??/.exec("")[1];
                (nt || rt) && (et = function (t) {
                    var e, n, r, i, o = this;
                    return rt && (n = new RegExp("^" + o.source + "$(?!\\s)", J.call(o))), nt && (e = o.lastIndex), r = Z.call(o, t), nt && r && (o.lastIndex = o.global ? r.index + r[0].length : e), rt && r && r.length > 1 && tt.call(r[0], n, function () {
                        for (i = 1; i < arguments.length - 2; i++)void 0 === arguments[i] && (r[i] = void 0)
                    }), r
                });
                var it = et, ot = z("species"), at = !i(function () {
                    var t = /./;
                    return t.exec = function () {
                        var t = [];
                        return t.groups = { a: "7" }, t
                    }, "7" !== "".replace(t, "$<a>")
                }), st = !i(function () {
                    var t = /(?:)/, e = t.exec;
                    t.exec = function () {
                        return e.apply(this, arguments)
                    };
                    var n = "ab".split(t);
                    return 2 !== n.length || "a" !== n[0] || "b" !== n[1]
                }), lt = function (t, e, n, r) {
                    var o = z(t), a = !i(function () {
                        var e = {};
                        return e[o] = function () {
                            return 7
                        }, 7 != ""[t](e)
                    }), s = a && !i(function () {
                        var e = !1, n = /a/;
                        return n.exec = function () {
                            return e = !0, null
                        }, "split" === t && (n.constructor = {}, n.constructor[ot] = function () {
                            return n
                        }), n[o](""), !e
                    });
                    if (!a || !s || "replace" === t && !at || "split" === t && !st) {
                        var l = /./[o], c = n(o, ""[t], function (t, e, n, r, i) {
                            return e.exec === it ? a && !i ? { done: !0, value: l.call(e, n, r) } : {
                                done: !0,
                                value: t.call(n, e, r)
                            } : { done: !1 }
                        }), u = c[0], f = c[1];
                        K(String.prototype, t, u), K(RegExp.prototype, o, 2 == e ? function (t, e) {
                            return f.call(t, this, e)
                        } : function (t) {
                            return f.call(t, this)
                        }), r && E(RegExp.prototype[o], "sham", !0)
                    }
                }, ct = {}.toString, ut = function (t) {
                    return ct.call(t).slice(8, -1)
                }, ft = z("match"), ht = function (t) {
                    if (null == t) throw TypeError("Can't call method on " + t);
                    return t
                }, dt = function (t) {
                    if ("function" != typeof t) throw TypeError(String(t) + " is not a function");
                    return t
                }, pt = z("species"), gt = Math.ceil, vt = Math.floor, mt = function (t) {
                    return isNaN(t = +t) ? 0 : (t > 0 ? vt : gt)(t)
                }, bt = function (t, e, n) {
                    var r, i, o = String(ht(t)), a = mt(e), s = o.length;
                    return a < 0 || a >= s ? n ? "" : void 0 : (r = o.charCodeAt(a)) < 55296 || r > 56319 || a + 1 === s || (i = o.charCodeAt(a + 1)) < 56320 || i > 57343 ? n ? o.charAt(a) : r : n ? o.slice(a, a + 2) : i - 56320 + (r - 55296 << 10) + 65536
                }, yt = function (t, e, n) {
                    return e + (n ? bt(t, e, !0).length : 1)
                }, wt = Math.min, St = function (t) {
                    return t > 0 ? wt(mt(t), 9007199254740991) : 0
                }, Tt = function (t, e) {
                    var n = t.exec;
                    if ("function" == typeof n) {
                        var r = n.call(t, e);
                        if ("object" != typeof r) throw TypeError("RegExp exec method returned something other than an Object or null");
                        return r
                    }
                    if ("RegExp" !== ut(t)) throw TypeError("RegExp#exec called on incompatible receiver");
                    return it.call(t, e)
                }, Lt = [].push, Et = Math.min, xt = !i(function () {
                    return !RegExp(4294967295, "y")
                });
                lt("split", 2, function (t, e, n) {
                    var r;
                    return r = "c" == "abbc".split(/(b)*/)[1] || 4 != "test".split(/(?:)/, -1).length || 2 != "ab".split(/(?:ab)*/).length || 4 != ".".split(/(.?)(.?)/).length || ".".split(/()()/).length > 1 || "".split(/.?/).length ? function (t, n) {
                        var r, i, o = String(ht(this)), a = void 0 === n ? 4294967295 : n >>> 0;
                        if (0 === a) return [];
                        if (void 0 === t) return [o];
                        if (!p(r = t) || (void 0 !== (i = r[ft]) ? !i : "RegExp" != ut(r))) return e.call(o, t, a);
                        for (var s, l, c, u = [], f = (t.ignoreCase ? "i" : "") + (t.multiline ? "m" : "") + (t.unicode ? "u" : "") + (t.sticky ? "y" : ""), h = 0, d = new RegExp(t.source, f + "g"); (s = it.call(d, o)) && !((l = d.lastIndex) > h && (u.push(o.slice(h, s.index)), s.length > 1 && s.index < o.length && Lt.apply(u, s.slice(1)), c = s[0].length, h = l, u.length >= a));)d.lastIndex === s.index && d.lastIndex++;
                        return h === o.length ? !c && d.test("") || u.push("") : u.push(o.slice(h)), u.length > a ? u.slice(0, a) : u
                    } : "0".split(void 0, 0).length ? function (t, n) {
                        return void 0 === t && 0 === n ? [] : e.call(this, t, n)
                    } : e, [function (e, n) {
                        var i = ht(this), o = null == e ? void 0 : e[t];
                        return void 0 !== o ? o.call(e, i, n) : r.call(String(i), e, n)
                    }, function (t, i) {
                        var o = n(r, t, this, i, r !== e);
                        if (o.done) return o.value;
                        var a = y(t), s = String(this), l = function (t, e) {
                            var n, r = y(t).constructor;
                            return void 0 === r || null == (n = y(r)[pt]) ? e : dt(n)
                        }(a, RegExp), c = a.unicode,
                            u = (a.ignoreCase ? "i" : "") + (a.multiline ? "m" : "") + (a.unicode ? "u" : "") + (xt ? "y" : "g"),
                            f = new l(xt ? a : "^(?:" + a.source + ")", u), h = void 0 === i ? 4294967295 : i >>> 0;
                        if (0 === h) return [];
                        if (0 === s.length) return null === Tt(f, s) ? [s] : [];
                        for (var d = 0, p = 0, g = []; p < s.length;) {
                            f.lastIndex = xt ? p : 0;
                            var v, m = Tt(f, xt ? s : s.slice(p));
                            if (null === m || (v = Et(St(f.lastIndex + (xt ? 0 : p)), s.length)) === d) p = yt(s, p, c); else {
                                if (g.push(s.slice(d, p)), g.length === h) return g;
                                for (var b = 1; b <= m.length - 1; b++)if (g.push(m[b]), g.length === h) return g;
                                p = d = v
                            }
                        }
                        return g.push(s.slice(d)), g
                    }]
                }, !xt);
                var kt, Rt = {}.propertyIsEnumerable, At = Object.getOwnPropertyDescriptor, Ot = {
                    f: At && !Rt.call({ 1: 2 }, 1) ? function (t) {
                        var e = At(this, t);
                        return !!e && e.enumerable
                    } : Rt
                }, _t = "".split, It = i(function () {
                    return !Object("z").propertyIsEnumerable(0)
                }) ? function (t) {
                    return "String" == ut(t) ? _t.call(t, "") : Object(t)
                } : Object, Yt = function (t) {
                    return It(ht(t))
                }, Pt = Object.getOwnPropertyDescriptor, Ct = {
                    f: o ? Pt : function (t, e) {
                        if (t = Yt(t), e = w(e, !0), b) try {
                            return Pt(t, e)
                        } catch (t) {
                        }
                        if (A(t, e)) return L(!Ot.f.call(t, e), t[e])
                    }
                }, Xt = Math.max, jt = Math.min, Wt = function (t, e) {
                    var n = mt(t);
                    return n < 0 ? Xt(n + e, 0) : jt(n, e)
                }, Mt = (kt = !1, function (t, e, n) {
                    var r, i = Yt(t), o = St(i.length), a = Wt(n, o);
                    if (kt && e != e) {
                        for (; o > a;)if ((r = i[a++]) != r) return !0
                    } else for (; o > a; a++)if ((kt || a in i) && i[a] === e) return kt || a || 0;
                    return !kt && -1
                }), Ht = function (t, e) {
                    var n, r = Yt(t), i = 0, o = [];
                    for (n in r) !A(W, n) && A(r, n) && o.push(n);
                    for (; e.length > i;)A(r, n = e[i++]) && (~Mt(o, n) || o.push(n));
                    return o
                },
                    Dt = ["constructor", "hasOwnProperty", "isPrototypeOf", "propertyIsEnumerable", "toLocaleString", "toString", "valueOf"],
                    Nt = Dt.concat("length", "prototype"), qt = {
                        f: Object.getOwnPropertyNames || function (t) {
                            return Ht(t, Nt)
                        }
                    }, Ut = { f: Object.getOwnPropertySymbols }, Bt = d.Reflect, $t = Bt && Bt.ownKeys || function (t) {
                        var e = qt.f(y(t)), n = Ut.f;
                        return n ? e.concat(n(t)) : e
                    }, Ft = function (t, e) {
                        for (var n = $t(e), r = T.f, i = Ct.f, o = 0; o < n.length; o++) {
                            var a = n[o];
                            A(t, a) || r(t, a, i(e, a))
                        }
                    }, Kt = /#|\.prototype\./, Gt = function (t, e) {
                        var n = Vt[Qt(t)];
                        return n == Jt || n != zt && ("function" == typeof e ? i(e) : !!e)
                    }, Qt = Gt.normalize = function (t) {
                        return String(t).replace(Kt, ".").toLowerCase()
                    }, Vt = Gt.data = {}, zt = Gt.NATIVE = "N", Jt = Gt.POLYFILL = "P", Zt = Gt, te = Ct.f,
                    ee = function (t, e) {
                        var n, r, i, o, a, s = t.target, l = t.global, c = t.stat;
                        if (n = l ? d : c ? d[s] || x(s, {}) : (d[s] || {}).prototype) for (r in e) {
                            if (o = e[r], i = t.noTargetGet ? (a = te(n, r)) && a.value : n[r], !Zt(l ? r : s + (c ? "." : "#") + r, t.forced) && void 0 !== i) {
                                if (typeof o == typeof i) continue;
                                Ft(o, i)
                            }
                            (t.sham || i && i.sham) && E(o, "sham", !0), K(n, r, o, t)
                        }
                    }, ne = function (t, e, n) {
                        if (dt(t), void 0 === e) return t;
                        switch (n) {
                            case 0:
                                return function () {
                                    return t.call(e)
                                };
                            case 1:
                                return function (n) {
                                    return t.call(e, n)
                                };
                            case 2:
                                return function (n, r) {
                                    return t.call(e, n, r)
                                };
                            case 3:
                                return function (n, r, i) {
                                    return t.call(e, n, r, i)
                                }
                        }
                        return function () {
                            return t.apply(e, arguments)
                        }
                    }, re = function (t) {
                        return Object(ht(t))
                    }, ie = function (t, e, n, r) {
                        try {
                            return r ? e(y(n)[0], n[1]) : e(n)
                        } catch (e) {
                            var i = t.return;
                            throw void 0 !== i && y(i.call(t)), e
                        }
                    }, oe = {}, ae = z("iterator"), se = Array.prototype, le = function (t) {
                        return void 0 !== t && (oe.Array === t || se[ae] === t)
                    }, ce = function (t, e, n) {
                        var r = w(e);
                        r in t ? T.f(t, r, L(0, n)) : t[r] = n
                    }, ue = z("toStringTag"), fe = "Arguments" == ut(function () {
                        return arguments
                    }()), he = function (t) {
                        var e, n, r;
                        return void 0 === t ? "Undefined" : null === t ? "Null" : "string" == typeof (n = function (t, e) {
                            try {
                                return t[e]
                            } catch (t) {
                            }
                        }(e = Object(t), ue)) ? n : fe ? ut(e) : "Object" == (r = ut(e)) && "function" == typeof e.callee ? "Arguments" : r
                    }, de = z("iterator"), pe = function (t) {
                        if (null != t) return t[de] || t["@@iterator"] || oe[he(t)]
                    }, ge = z("iterator"), ve = !1;
                try {
                    var me = 0, be = {
                        next: function () {
                            return { done: !!me++ }
                        }, return: function () {
                            ve = !0
                        }
                    };
                    be[ge] = function () {
                        return this
                    }, Array.from(be, function () {
                        throw 2
                    })
                } catch (t) {
                }
                var ye = !function (t, e) {
                    if (!e && !ve) return !1;
                    var n = !1;
                    try {
                        var r = {};
                        r[ge] = function () {
                            return {
                                next: function () {
                                    return { done: n = !0 }
                                }
                            }
                        }, t(r)
                    } catch (t) {
                    }
                    return n
                }(function (t) {
                    Array.from(t)
                });
                ee({ target: "Array", stat: !0, forced: ye }, {
                    from: function (t) {
                        var e, n, r, i, o = re(t), a = "function" == typeof this ? this : Array, s = arguments.length,
                            l = s > 1 ? arguments[1] : void 0, c = void 0 !== l, u = 0, f = pe(o);
                        if (c && (l = ne(l, s > 2 ? arguments[2] : void 0, 2)), null == f || a == Array && le(f)) for (n = new a(e = St(o.length)); e > u; u++)ce(n, u, c ? l(o[u], u) : o[u]); else for (i = f.call(o), n = new a; !(r = i.next()).done; u++)ce(n, u, c ? ie(i, l, [r.value, u], !0) : r.value);
                        return n.length = u, n
                    }
                });
                var we = Array.isArray || function (t) {
                    return "Array" == ut(t)
                }, Se = z("species"), Te = function (t, e) {
                    var n;
                    return we(t) && ("function" != typeof (n = t.constructor) || n !== Array && !we(n.prototype) ? p(n) && null === (n = n[Se]) && (n = void 0) : n = void 0), new (void 0 === n ? Array : n)(0 === e ? 0 : e)
                }, Le = function (t, e) {
                    var n = 1 == t, r = 2 == t, i = 3 == t, o = 4 == t, a = 6 == t, s = 5 == t || a, l = e || Te;
                    return function (e, c, u) {
                        for (var f, h, d = re(e), p = It(d), g = ne(c, u, 3), v = St(p.length), m = 0, b = n ? l(e, v) : r ? l(e, 0) : void 0; v > m; m++)if ((s || m in p) && (h = g(f = p[m], m, d), t)) if (n) b[m] = h; else if (h) switch (t) {
                            case 3:
                                return !0;
                            case 5:
                                return f;
                            case 6:
                                return m;
                            case 2:
                                b.push(f)
                        } else if (o) return !1;
                        return a ? -1 : i || o ? o : b
                    }
                }, Ee = z("species"), xe = function (t) {
                    return !i(function () {
                        var e = [];
                        return (e.constructor = {})[Ee] = function () {
                            return { foo: 1 }
                        }, 1 !== e[t](Boolean).foo
                    })
                }, ke = Le(1), Re = xe("map");
                ee({ target: "Array", proto: !0, forced: !Re }, {
                    map: function (t) {
                        return ke(this, t, arguments[1])
                    }
                });
                var Ae = Object.keys || function (t) {
                    return Ht(t, Dt)
                }, Oe = Object.assign, _e = !Oe || i(function () {
                    var t = {}, e = {}, n = Symbol();
                    return t[n] = 7, "abcdefghijklmnopqrst".split("").forEach(function (t) {
                        e[t] = t
                    }), 7 != Oe({}, t)[n] || "abcdefghijklmnopqrst" != Ae(Oe({}, e)).join("")
                }) ? function (t, e) {
                    for (var n = re(t), r = arguments.length, i = 1, a = Ut.f, s = Ot.f; r > i;)for (var l, c = It(arguments[i++]), u = a ? Ae(c).concat(a(c)) : Ae(c), f = u.length, h = 0; f > h;)l = u[h++], o && !s.call(c, l) || (n[l] = c[l]);
                    return n
                } : Oe;
                ee({ target: "Object", stat: !0, forced: Object.assign !== _e }, { assign: _e });
                var Ie, Ye, Pe, Ce = !i(function () {
                    function t() {
                    }

                    return t.prototype.constructor = null, Object.getPrototypeOf(new t) !== t.prototype
                }), Xe = j("IE_PROTO"), je = Object.prototype, We = Ce ? Object.getPrototypeOf : function (t) {
                    return t = re(t), A(t, Xe) ? t[Xe] : "function" == typeof t.constructor && t instanceof t.constructor ? t.constructor.prototype : t instanceof Object ? je : null
                }, Me = z("iterator"), He = !1;
                [].keys && ("next" in (Pe = [].keys()) ? (Ye = We(We(Pe))) !== Object.prototype && (Ie = Ye) : He = !0), null == Ie && (Ie = {}), A(Ie, Me) || E(Ie, Me, function () {
                    return this
                });
                var De = { IteratorPrototype: Ie, BUGGY_SAFARI_ITERATORS: He },
                    Ne = o ? Object.defineProperties : function (t, e) {
                        y(t);
                        for (var n, r = Ae(e), i = r.length, o = 0; i > o;)T.f(t, n = r[o++], e[n]);
                        return t
                    }, qe = d.document, Ue = qe && qe.documentElement, Be = j("IE_PROTO"), $e = function () {
                    }, Fe = function () {
                        var t, e = m("iframe"), n = Dt.length;
                        for (e.style.display = "none", Ue.appendChild(e), e.src = String("javascript:"), (t = e.contentWindow.document).open(), t.write("<script>document.F=Object<\/script>"), t.close(), Fe = t.F; n--;)delete Fe.prototype[Dt[n]];
                        return Fe()
                    }, Ke = Object.create || function (t, e) {
                        var n;
                        return null !== t ? ($e.prototype = y(t), n = new $e, $e.prototype = null, n[Be] = t) : n = Fe(), void 0 === e ? n : Ne(n, e)
                    };
                W[Be] = !0;
                var Ge = T.f, Qe = z("toStringTag"), Ve = function (t, e, n) {
                    t && !A(t = n ? t : t.prototype, Qe) && Ge(t, Qe, { configurable: !0, value: e })
                }, ze = De.IteratorPrototype, Je = function () {
                    return this
                }, Ze = Object.setPrototypeOf || ("__proto__" in {} ? function () {
                    var t, e = !1, n = {};
                    try {
                        (t = Object.getOwnPropertyDescriptor(Object.prototype, "__proto__").set).call(n, []), e = n instanceof Array
                    } catch (t) {
                    }
                    return function (n, r) {
                        return function (t, e) {
                            if (y(t), !p(e) && null !== e) throw TypeError("Can't set " + String(e) + " as a prototype")
                        }(n, r), e ? t.call(n, r) : n.__proto__ = r, n
                    }
                }() : void 0), tn = De.IteratorPrototype, en = De.BUGGY_SAFARI_ITERATORS, nn = z("iterator"),
                    rn = function () {
                        return this
                    }, on = F.set, an = F.getterFor("String Iterator");
                !function (t, e, n, r, i, o, a) {
                    !function (t, e, n) {
                        var r = e + " Iterator";
                        t.prototype = Ke(ze, { next: L(1, n) }), Ve(t, r, !1), oe[r] = Je
                    }(n, e, r);
                    var s, l, c, u = function (t) {
                        if (t === i && g) return g;
                        if (!en && t in d) return d[t];
                        switch (t) {
                            case "keys":
                            case "values":
                            case "entries":
                                return function () {
                                    return new n(this, t)
                                }
                        }
                        return function () {
                            return new n(this)
                        }
                    }, f = e + " Iterator", h = !1, d = t.prototype, p = d[nn] || d["@@iterator"] || i && d[i],
                        g = !en && p || u(i), v = "Array" == e && d.entries || p;
                    if (v && (s = We(v.call(new t)), tn !== Object.prototype && s.next && (We(s) !== tn && (Ze ? Ze(s, tn) : "function" != typeof s[nn] && E(s, nn, rn)), Ve(s, f, !0))), "values" == i && p && "values" !== p.name && (h = !0, g = function () {
                        return p.call(this)
                    }), d[nn] !== g && E(d, nn, g), oe[e] = g, i) if (l = {
                        values: u("values"),
                        keys: o ? g : u("keys"),
                        entries: u("entries")
                    }, a) for (c in l) !en && !h && c in d || K(d, c, l[c]); else ee({
                        target: e,
                        proto: !0,
                        forced: en || h
                    }, l)
                }(String, "String", function (t) {
                    on(this, { type: "String Iterator", string: String(t), index: 0 })
                }, function () {
                    var t, e = an(this), n = e.string, r = e.index;
                    return r >= n.length ? { value: void 0, done: !0 } : (t = bt(n, r, !0), e.index += t.length, {
                        value: t,
                        done: !1
                    })
                });
                var sn = Math.max, ln = Math.min, cn = Math.floor, un = /\$([$&'`]|\d\d?|<[^>]*>)/g,
                    fn = /\$([$&'`]|\d\d?)/g;
                lt("replace", 2, function (t, e, n) {
                    return [function (n, r) {
                        var i = ht(this), o = null == n ? void 0 : n[t];
                        return void 0 !== o ? o.call(n, i, r) : e.call(String(i), n, r)
                    }, function (t, i) {
                        var o = n(e, t, this, i);
                        if (o.done) return o.value;
                        var a = y(t), s = String(this), l = "function" == typeof i;
                        l || (i = String(i));
                        var c = a.global;
                        if (c) {
                            var u = a.unicode;
                            a.lastIndex = 0
                        }
                        for (var f = []; ;) {
                            var h = Tt(a, s);
                            if (null === h) break;
                            if (f.push(h), !c) break;
                            "" === String(h[0]) && (a.lastIndex = yt(s, St(a.lastIndex), u))
                        }
                        for (var d, p = "", g = 0, v = 0; v < f.length; v++) {
                            h = f[v];
                            for (var m = String(h[0]), b = sn(ln(mt(h.index), s.length), 0), w = [], S = 1; S < h.length; S++)w.push(void 0 === (d = h[S]) ? d : String(d));
                            var T = h.groups;
                            if (l) {
                                var L = [m].concat(w, b, s);
                                void 0 !== T && L.push(T);
                                var E = String(i.apply(void 0, L))
                            } else E = r(m, s, b, w, T, i);
                            b >= g && (p += s.slice(g, b) + E, g = b + m.length)
                        }
                        return p + s.slice(g)
                    }];
                    function r(t, n, r, i, o, a) {
                        var s = r + t.length, l = i.length, c = fn;
                        return void 0 !== o && (o = re(o), c = un), e.call(a, c, function (e, a) {
                            var c;
                            switch (a.charAt(0)) {
                                case "$":
                                    return "$";
                                case "&":
                                    return t;
                                case "`":
                                    return n.slice(0, r);
                                case "'":
                                    return n.slice(s);
                                case "<":
                                    c = o[a.slice(1, -1)];
                                    break;
                                default:
                                    var u = +a;
                                    if (0 === u) return e;
                                    if (u > l) {
                                        var f = cn(u / 10);
                                        return 0 === f ? e : f <= l ? void 0 === i[f - 1] ? a.charAt(1) : i[f - 1] + a.charAt(1) : e
                                    }
                                    c = i[u - 1]
                            }
                            return void 0 === c ? "" : c
                        })
                    }
                });
                var hn, dn, pn = Le(0), gn = (dn = [].forEach) && i(function () {
                    dn.call(null, hn || function () {
                        throw 1
                    }, 1)
                }) ? [].forEach : function (t) {
                    return pn(this, t, arguments[1])
                };
                for (var vn in {
                    CSSRuleList: 0,
                    CSSStyleDeclaration: 0,
                    CSSValueList: 0,
                    ClientRectList: 0,
                    DOMRectList: 0,
                    DOMStringList: 0,
                    DOMTokenList: 1,
                    DataTransferItemList: 0,
                    FileList: 0,
                    HTMLAllCollection: 0,
                    HTMLCollection: 0,
                    HTMLFormElement: 0,
                    HTMLSelectElement: 0,
                    MediaList: 0,
                    MimeTypeArray: 0,
                    NamedNodeMap: 0,
                    NodeList: 1,
                    PaintRequestList: 0,
                    Plugin: 0,
                    PluginArray: 0,
                    SVGLengthList: 0,
                    SVGNumberList: 0,
                    SVGPathSegList: 0,
                    SVGPointList: 0,
                    SVGStringList: 0,
                    SVGTransformList: 0,
                    SourceBufferList: 0,
                    StyleSheetList: 0,
                    TextTrackCueList: 0,
                    TextTrackList: 0,
                    TouchList: 0
                }) {
                    var mn = d[vn], bn = mn && mn.prototype;
                    if (bn && bn.forEach !== gn) try {
                        E(bn, "forEach", gn)
                    } catch (t) {
                        bn.forEach = gn
                    }
                }
                function yn(t, e) {
                    for (var n = 0; n < e.length; n++) {
                        var r = e[n];
                        r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(t, r.key, r)
                    }
                }

                function wn(t, e, n) {
                    return e && yn(t.prototype, e), n && yn(t, n), t
                }

                var Sn = function (t) {
                    var e = "ajaxLoad", n = t.fn[e], r = "active", i = "open", o = "view-script", a = "click",
                        s = ".sidebar-nav .nav-dropdown", l = ".sidebar-nav .nav-link", c = ".sidebar-nav .nav-item",
                        u = ".view-script",
                        f = { defaultPage: "main.html", errorPage: "404.html", subpagesDirectory: "views/" },
                        h = function () {
                            function e(t, e) {
                                this._config = this._getConfig(e), this._element = t;
                                var n = location.hash.replace(/^#/, "");
                                "" !== n ? this.setUpUrl(n) : this.setUpUrl(this._config.defaultPage), this._addEventListeners()
                            }

                            var n = e.prototype;
                            return n.loadPage = function (e) {
                                var n = this._element, r = this._config;
                                t.ajax({
                                    type: "GET",
                                    url: r.subpagesDirectory + e,
                                    dataType: "html",
                                    beforeSend: function () {
                                        t(u).remove()
                                    },
                                    success: function (r) {
                                        var i = document.createElement("div");
                                        i.innerHTML = r;
                                        var a = Array.from(i.querySelectorAll("script")).map(function (t) {
                                            return t.attributes.getNamedItem("src").nodeValue
                                        });
                                        i.querySelectorAll("script").forEach(function (t) {
                                            return t.parentNode.removeChild(t)
                                        }), t("body").animate({ scrollTop: 0 }, 0), t(n).html(i), a.length && function t(e, n) {
                                            void 0 === n && (n = 0);
                                            var r = document.createElement("script");
                                            r.type = "text/javascript", r.src = e[n], r.className = o, r.onload = r.onreadystatechange = function () {
                                                this.readyState && "complete" !== this.readyState || e.length > n + 1 && t(e, n + 1)
                                            }, document.getElementsByTagName("body")[0].appendChild(r)
                                        }(a), window.location.hash = e
                                    },
                                    error: function () {
                                        window.location.href = r.errorPage
                                    }
                                })
                            }, n.setUpUrl = function (e) {
                                t(l).removeClass(r), t(s).removeClass(i), t(s + ':has(a[href="' + e.replace(/^\//, "").split("?")[0] + '"])').addClass(i), t(c + ' a[href="' + e.replace(/^\//, "").split("?")[0] + '"]').addClass(r), this.loadPage(e)
                            }, n.loadBlank = function (t) {
                                window.open(t)
                            }, n.loadTop = function (t) {
                                window.location = t
                            }, n._getConfig = function (t) {
                                return t = Object.assign({}, f, t)
                            }, n._addEventListeners = function () {
                                var e = this;
                                t(document).on(a, l + '[href!="#"]', function (t) {
                                    t.preventDefault(), t.stopPropagation(), "_top" === t.currentTarget.target ? e.loadTop(t.currentTarget.href) : "_blank" === t.currentTarget.target ? e.loadBlank(t.currentTarget.href) : e.setUpUrl(t.currentTarget.getAttribute("href"))
                                })
                            }, e._jQueryInterface = function (n) {
                                return this.each(function () {
                                    var r = t(this).data("coreui.ajaxLoad");
                                    r || (r = new e(this, "object" == typeof n && n), t(this).data("coreui.ajaxLoad", r))
                                })
                            }, wn(e, null, [{
                                key: "VERSION", get: function () {
                                    return "2.1.12"
                                }
                            }, {
                                key: "Default", get: function () {
                                    return f
                                }
                            }]), e
                        }();
                    return t.fn[e] = h._jQueryInterface, t.fn[e].Constructor = h, t.fn[e].noConflict = function () {
                        return t.fn[e] = n, h._jQueryInterface
                    }, h
                }(n), Tn = z("species"), Ln = [].slice, En = Math.max, xn = xe("slice");
                ee({ target: "Array", proto: !0, forced: !xn }, {
                    slice: function (t, e) {
                        var n, r, i, o = Yt(this), a = St(o.length), s = Wt(t, a), l = Wt(void 0 === e ? a : e, a);
                        if (we(o) && ("function" != typeof (n = o.constructor) || n !== Array && !we(n.prototype) ? p(n) && null === (n = n[Tn]) && (n = void 0) : n = void 0, n === Array || void 0 === n)) return Ln.call(o, s, l);
                        for (r = new (void 0 === n ? Array : n)(En(l - s, 0)), i = 0; s < l; s++, i++)s in o && ce(r, i, o[s]);
                        return r.length = i, r
                    }
                });
                var kn = function (t, e) {
                    var n = e.indexOf(t), r = e.slice(0, n + 1);
                    !function (t) {
                        return -1 !== t.map(function (t) {
                            return document.body.classList.contains(t)
                        }).indexOf(!0)
                    }(r) ? document.body.classList.add(t) : r.map(function (t) {
                        return document.body.classList.remove(t)
                    })
                }, Rn = function (t) {
                    var e = "aside-menu", n = "coreui.aside-menu", r = t.fn[e],
                        i = { CLICK: "click", LOAD_DATA_API: "load.coreui.aside-menu.data-api", TOGGLE: "toggle" },
                        o = ".aside-menu", a = ".aside-menu-toggler",
                        s = ["aside-menu-show", "aside-menu-sm-show", "aside-menu-md-show", "aside-menu-lg-show", "aside-menu-xl-show"],
                        l = function () {
                            function e(t) {
                                this._element = t, this._addEventListeners()
                            }

                            return e.prototype._addEventListeners = function () {
                                t(document).on(i.CLICK, a, function (e) {
                                    e.preventDefault(), e.stopPropagation();
                                    var n = e.currentTarget.dataset ? e.currentTarget.dataset.toggle : t(e.currentTarget).data("toggle");
                                    kn(n, s)
                                })
                            }, e._jQueryInterface = function () {
                                return this.each(function () {
                                    var r = t(this), i = r.data(n);
                                    i || (i = new e(this), r.data(n, i))
                                })
                            }, wn(e, null, [{
                                key: "VERSION", get: function () {
                                    return "2.1.12"
                                }
                            }]), e
                        }();
                    return t(window).on(i.LOAD_DATA_API, function () {
                        var e = t(o);
                        l._jQueryInterface.call(e)
                    }), t.fn[e] = l._jQueryInterface, t.fn[e].Constructor = l, t.fn[e].noConflict = function () {
                        return t.fn[e] = r, l._jQueryInterface
                    }, l
                }(n), An = z("unscopables"), On = Array.prototype;
                null == On[An] && E(On, An, Ke(null));
                var _n, In = Le(5), Yn = !0;
                "find" in [] && Array(1).find(function () {
                    Yn = !1
                }), ee({ target: "Array", proto: !0, forced: Yn }, {
                    find: function (t) {
                        return In(this, t, arguments.length > 1 ? arguments[1] : void 0)
                    }
                }), _n = "find", On[An][_n] = !0, lt("match", 1, function (t, e, n) {
                    return [function (e) {
                        var n = ht(this), r = null == e ? void 0 : e[t];
                        return void 0 !== r ? r.call(e, n) : new RegExp(e)[t](String(n))
                    }, function (t) {
                        var r = n(e, t, this);
                        if (r.done) return r.value;
                        var i = y(t), o = String(this);
                        if (!i.global) return Tt(i, o);
                        var a = i.unicode;
                        i.lastIndex = 0;
                        for (var s, l = [], c = 0; null !== (s = Tt(i, o));) {
                            var u = String(s[0]);
                            l[c] = u, "" === u && (i.lastIndex = yt(o, St(i.lastIndex), a)), c++
                        }
                        return 0 === c ? null : l
                    }]
                });
                var Pn = "\t\n\v\f\r                　\u2028\u2029\ufeff", Cn = "[" + Pn + "]",
                    Xn = RegExp("^" + Cn + Cn + "*"), jn = RegExp(Cn + Cn + "*$"), Wn = function (t) {
                        return i(function () {
                            return !!Pn[t]() || "​᠎" != "​᠎"[t]() || Pn[t].name !== t
                        })
                    }("trim");
                ee({ target: "String", proto: !0, forced: Wn }, {
                    trim: function () {
                        return t = this, e = 3, t = String(ht(t)), 1 & e && (t = t.replace(Xn, "")), 2 & e && (t = t.replace(jn, "")), t;
                        var t, e
                    }
                });
                var Mn = function (t, e) {
                    return void 0 === e && (e = document.body), function (t) {
                        return t.match(/^--.*/i)
                    }(t) && Boolean(document.documentMode) && document.documentMode >= 10 ? function () {
                        for (var t = {}, e = document.styleSheets, n = "", r = e.length - 1; r > -1; r--) {
                            for (var i = e[r].cssRules, o = i.length - 1; o > -1; o--)if (".ie-custom-properties" === i[o].selectorText) {
                                n = i[o].cssText;
                                break
                            }
                            if (n) break
                        }
                        return (n = n.substring(n.lastIndexOf("{") + 1, n.lastIndexOf("}"))).split(";").forEach(function (e) {
                            if (e) {
                                var n = e.split(": ")[0], r = e.split(": ")[1];
                                n && r && (t["--" + n.trim()] = r.trim())
                            }
                        }), t
                    }()[t] : window.getComputedStyle(e, null).getPropertyValue(t).replace(/^\s/, "")
                }, Hn = function (t) {
                    var e = "sidebar", n = t.fn[e], i = 400, o = "active", a = "brand-minimized", s = "open",
                        l = "sidebar-minimized", c = {
                            CLICK: "click",
                            DESTROY: "destroy",
                            INIT: "init",
                            LOAD_DATA_API: "load.coreui.sidebar.data-api",
                            TOGGLE: "toggle",
                            UPDATE: "update"
                        }, u = "body", f = ".brand-minimizer", h = ".nav-dropdown-toggle", d = ".nav-dropdown-items",
                        p = ".nav-item", g = ".nav-link", v = ".nav-link-queried", m = ".sidebar-nav",
                        b = ".sidebar-nav > .nav", y = ".sidebar", w = ".sidebar-minimizer", S = ".sidebar-toggler",
                        T = ".sidebar-scroll",
                        L = ["sidebar-show", "sidebar-sm-show", "sidebar-md-show", "sidebar-lg-show", "sidebar-xl-show"],
                        E = function () {
                            function e(t) {
                                this._element = t, this.mobile = !1, this.ps = null, this.perfectScrollbar(c.INIT), this.setActiveLink(), this._breakpointTest = this._breakpointTest.bind(this), this._clickOutListener = this._clickOutListener.bind(this), this._addEventListeners(), this._addMediaQuery()
                            }

                            var n = e.prototype;
                            return n.perfectScrollbar = function (t) {
                                var e = this;
                                if (void 0 !== r) {
                                    var n = document.body.classList;
                                    t !== c.INIT || n.contains(l) || (this.ps = this.makeScrollbar()), t === c.DESTROY && this.destroyScrollbar(), t === c.TOGGLE && (n.contains(l) ? this.destroyScrollbar() : (this.destroyScrollbar(), this.ps = this.makeScrollbar())), t !== c.UPDATE || n.contains(l) || setTimeout(function () {
                                        e.destroyScrollbar(), e.ps = e.makeScrollbar()
                                    }, i)
                                }
                            }, n.makeScrollbar = function () {
                                var t = T;
                                if (null === document.querySelector(t) && (t = m, null === document.querySelector(t))) return null;
                                var e = new r(document.querySelector(t), { suppressScrollX: !0 });
                                return e.isRtl = !1, e
                            }, n.destroyScrollbar = function () {
                                this.ps && (this.ps.destroy(), this.ps = null)
                            }, n.setActiveLink = function () {
                                t(b).find(g).each(function (e, n) {
                                    var r, i = n;
                                    "#" === (r = i.classList.contains(v) ? String(window.location) : String(window.location).split("?")[0]).substr(r.length - 1) && (r = r.slice(0, -1)), t(t(i))[0].href === r && t(i).addClass(o).parents(d).add(i).each(function (e, n) {
                                        t(i = n).parent().addClass(s)
                                    })
                                })
                            }, n._addMediaQuery = function () {
                                var t = Mn("--breakpoint-sm");
                                if (t) {
                                    var e = parseInt(t, 10) - 1, n = window.matchMedia("(max-width: " + e + "px)");
                                    this._breakpointTest(n), n.addListener(this._breakpointTest)
                                }
                            }, n._breakpointTest = function (t) {
                                this.mobile = Boolean(t.matches), this._toggleClickOut()
                            }, n._clickOutListener = function (t) {
                                this._element.contains(t.target) || (t.preventDefault(), t.stopPropagation(), this._removeClickOut(), document.body.classList.remove("sidebar-show"))
                            }, n._addClickOut = function () {
                                document.addEventListener(c.CLICK, this._clickOutListener, !0)
                            }, n._removeClickOut = function () {
                                document.removeEventListener(c.CLICK, this._clickOutListener, !0)
                            }, n._toggleClickOut = function () {
                                this.mobile && document.body.classList.contains("sidebar-show") ? (document.body.classList.remove("aside-menu-show"), this._addClickOut()) : this._removeClickOut()
                            }, n._addEventListeners = function () {
                                var e = this;
                                t(document).on(c.CLICK, f, function (e) {
                                    e.preventDefault(), e.stopPropagation(), t(u).toggleClass(a)
                                }), t(document).on(c.CLICK, h, function (n) {
                                    n.preventDefault(), n.stopPropagation();
                                    var r = n.target;
                                    t(r).parent().toggleClass(s), e.perfectScrollbar(c.UPDATE)
                                }), t(document).on(c.CLICK, w, function (n) {
                                    n.preventDefault(), n.stopPropagation(), t(u).toggleClass(l), e.perfectScrollbar(c.TOGGLE)
                                }), t(document).on(c.CLICK, S, function (n) {
                                    n.preventDefault(), n.stopPropagation();
                                    var r = n.currentTarget.dataset ? n.currentTarget.dataset.toggle : t(n.currentTarget).data("toggle");
                                    kn(r, L), e._toggleClickOut()
                                }), t(b + " > " + p + " " + g + ":not(" + h + ")").on(c.CLICK, function () {
                                    e._removeClickOut(), document.body.classList.remove("sidebar-show")
                                })
                            }, e._jQueryInterface = function () {
                                return this.each(function () {
                                    var n = t(this), r = n.data("coreui.sidebar");
                                    r || (r = new e(this), n.data("coreui.sidebar", r))
                                })
                            }, wn(e, null, [{
                                key: "VERSION", get: function () {
                                    return "2.1.12"
                                }
                            }]), e
                        }();
                    return t(window).on(c.LOAD_DATA_API, function () {
                        var e = t(y);
                        E._jQueryInterface.call(e)
                    }), t.fn[e] = E._jQueryInterface, t.fn[e].Constructor = E, t.fn[e].noConflict = function () {
                        return t.fn[e] = n, E._jQueryInterface
                    }, E
                }(n), Dn = {};
                Dn[z("toStringTag")] = "z";
                var Nn = "[object z]" !== String(Dn) ? function () {
                    return "[object " + he(this) + "]"
                } : Dn.toString, qn = Object.prototype;
                Nn !== qn.toString && K(qn, "toString", Nn, { unsafe: !0 });
                var Un = /./.toString, Bn = RegExp.prototype, $n = i(function () {
                    return "/a/b" != Un.call({ source: "a", flags: "b" })
                }), Fn = "toString" != Un.name;
                ($n || Fn) && K(RegExp.prototype, "toString", function () {
                    var t = y(this), e = String(t.source), n = t.flags;
                    return "/" + e + "/" + String(void 0 === n && t instanceof RegExp && !("flags" in Bn) ? J.call(t) : n)
                }, { unsafe: !0 }), function (t) {
                    if (void 0 === t) throw new TypeError("CoreUI's JavaScript requires jQuery. jQuery must be included before CoreUI's JavaScript.");
                    var e = t.fn.jquery.split(" ")[0].split(".");
                    if (e[0] < 2 && e[1] < 9 || 1 === e[0] && 9 === e[1] && e[2] < 1 || e[0] >= 4) throw new Error("CoreUI's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0")
                }(n), window.getStyle = Mn, window.hexToRgb = function (t) {
                    if (void 0 === t) throw new Error("Hex color is not defined");
                    var e, n, r;
                    if (!t.match(/^#(?:[0-9a-f]{3}){1,2}$/i)) throw new Error(t + " is not a valid hex color");
                    return 7 === t.length ? (e = parseInt(t.substring(1, 3), 16), n = parseInt(t.substring(3, 5), 16), r = parseInt(t.substring(5, 7), 16)) : (e = parseInt(t.substring(1, 2), 16), n = parseInt(t.substring(2, 3), 16), r = parseInt(t.substring(3, 5), 16)), "rgba(" + e + ", " + n + ", " + r + ")"
                }, window.hexToRgba = function (t, e) {
                    if (void 0 === e && (e = 100), void 0 === t) throw new Error("Hex color is not defined");
                    var n, r, i;
                    if (!t.match(/^#(?:[0-9a-f]{3}){1,2}$/i)) throw new Error(t + " is not a valid hex color");
                    return 7 === t.length ? (n = parseInt(t.substring(1, 3), 16), r = parseInt(t.substring(3, 5), 16), i = parseInt(t.substring(5, 7), 16)) : (n = parseInt(t.substring(1, 2), 16), r = parseInt(t.substring(2, 3), 16), i = parseInt(t.substring(3, 5), 16)), "rgba(" + n + ", " + r + ", " + i + ", " + e / 100 + ")"
                }, window.rgbToHex = function (t) {
                    if (void 0 === t) throw new Error("Hex color is not defined");
                    if ("transparent" === t) return "#00000000";
                    var e = t.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
                    if (!e) throw new Error(t + " is not a valid rgb color");
                    var n = "0" + parseInt(e[1], 10).toString(16), r = "0" + parseInt(e[2], 10).toString(16),
                        i = "0" + parseInt(e[3], 10).toString(16);
                    return "#" + n.slice(-2) + r.slice(-2) + i.slice(-2)
                }, e.AjaxLoad = Sn, e.AsideMenu = Rn, e.Sidebar = Hn, Object.defineProperty(e, "__esModule", { value: !0 })
            })(e, n("EVdn"), n("t/UT"))
        }).call(this, n("yLpj"))
    }, szVC: function (t, e, n) {
        "use strict";
        n.r(e);
        n("9Wh1"), n("e922"), n("cJnw")
    }, "t/UT": function (t, e, n) {
        "use strict";
        function r(t) {
            return getComputedStyle(t)
        }

        function i(t, e) {
            for (var n in e) {
                var r = e[n];
                "number" == typeof r && (r += "px"), t.style[n] = r
            }
            return t
        }

        function o(t) {
            var e = document.createElement("div");
            return e.className = t, e
        }

        n.r(e);
        var a = "undefined" != typeof Element && (Element.prototype.matches || Element.prototype.webkitMatchesSelector || Element.prototype.mozMatchesSelector || Element.prototype.msMatchesSelector);

        function s(t, e) {
            if (!a) throw new Error("No element matching method supported");
            return a.call(t, e)
        }

        function l(t) {
            t.remove ? t.remove() : t.parentNode && t.parentNode.removeChild(t)
        }

        function c(t, e) {
            return Array.prototype.filter.call(t.children, function (t) {
                return s(t, e)
            })
        }

        var u = {
            main: "ps", element: {
                thumb: function (t) {
                    return "ps__thumb-" + t
                }, rail: function (t) {
                    return "ps__rail-" + t
                }, consuming: "ps__child--consume"
            }, state: {
                focus: "ps--focus", clicking: "ps--clicking", active: function (t) {
                    return "ps--active-" + t
                }, scrolling: function (t) {
                    return "ps--scrolling-" + t
                }
            }
        }, f = { x: null, y: null };

        function h(t, e) {
            var n = t.element.classList, r = u.state.scrolling(e);
            n.contains(r) ? clearTimeout(f[e]) : n.add(r)
        }

        function d(t, e) {
            f[e] = setTimeout(function () {
                return t.isAlive && t.element.classList.remove(u.state.scrolling(e))
            }, t.settings.scrollingThreshold)
        }

        var p = function (t) {
            this.element = t, this.handlers = {}
        }, g = { isEmpty: { configurable: !0 } };
        p.prototype.bind = function (t, e) {
            void 0 === this.handlers[t] && (this.handlers[t] = []), this.handlers[t].push(e), this.element.addEventListener(t, e, !1)
        }, p.prototype.unbind = function (t, e) {
            var n = this;
            this.handlers[t] = this.handlers[t].filter(function (r) {
                return !(!e || r === e) || (n.element.removeEventListener(t, r, !1), !1)
            })
        }, p.prototype.unbindAll = function () {
            for (var t in this.handlers) this.unbind(t)
        }, g.isEmpty.get = function () {
            var t = this;
            return Object.keys(this.handlers).every(function (e) {
                return 0 === t.handlers[e].length
            })
        }, Object.defineProperties(p.prototype, g);
        var v = function () {
            this.eventElements = []
        };

        function m(t) {
            if ("function" == typeof window.CustomEvent) return new CustomEvent(t);
            var e = document.createEvent("CustomEvent");
            return e.initCustomEvent(t, !1, !1, void 0), e
        }

        v.prototype.eventElement = function (t) {
            var e = this.eventElements.filter(function (e) {
                return e.element === t
            })[0];
            return e || (e = new p(t), this.eventElements.push(e)), e
        }, v.prototype.bind = function (t, e, n) {
            this.eventElement(t).bind(e, n)
        }, v.prototype.unbind = function (t, e, n) {
            var r = this.eventElement(t);
            r.unbind(e, n), r.isEmpty && this.eventElements.splice(this.eventElements.indexOf(r), 1)
        }, v.prototype.unbindAll = function () {
            this.eventElements.forEach(function (t) {
                return t.unbindAll()
            }), this.eventElements = []
        }, v.prototype.once = function (t, e, n) {
            var r = this.eventElement(t), i = function (t) {
                r.unbind(e, i), n(t)
            };
            r.bind(e, i)
        };
        var b = function (t, e, n, r, i) {
            var o;
            if (void 0 === r && (r = !0), void 0 === i && (i = !1), "top" === e) o = ["contentHeight", "containerHeight", "scrollTop", "y", "up", "down"]; else {
                if ("left" !== e) throw new Error("A proper axis should be provided");
                o = ["contentWidth", "containerWidth", "scrollLeft", "x", "left", "right"]
            }
            !function (t, e, n, r, i) {
                var o = n[0], a = n[1], s = n[2], l = n[3], c = n[4], u = n[5];
                void 0 === r && (r = !0);
                void 0 === i && (i = !1);
                var f = t.element;
                t.reach[l] = null, f[s] < 1 && (t.reach[l] = "start");
                f[s] > t[o] - t[a] - 1 && (t.reach[l] = "end");
                e && (f.dispatchEvent(m("ps-scroll-" + l)), e < 0 ? f.dispatchEvent(m("ps-scroll-" + c)) : e > 0 && f.dispatchEvent(m("ps-scroll-" + u)), r && function (t, e) {
                    h(t, e), d(t, e)
                }(t, l));
                t.reach[l] && (e || i) && f.dispatchEvent(m("ps-" + l + "-reach-" + t.reach[l]))
            }(t, n, o, r, i)
        };

        function y(t) {
            return parseInt(t, 10) || 0
        }

        var w = {
            isWebKit: "undefined" != typeof document && "WebkitAppearance" in document.documentElement.style,
            supportsTouch: "undefined" != typeof window && ("ontouchstart" in window || window.DocumentTouch && document instanceof window.DocumentTouch),
            supportsIePointer: "undefined" != typeof navigator && navigator.msMaxTouchPoints,
            isChrome: "undefined" != typeof navigator && /Chrome/i.test(navigator && navigator.userAgent)
        }, S = function (t) {
            var e = t.element, n = Math.floor(e.scrollTop);
            t.containerWidth = e.clientWidth, t.containerHeight = e.clientHeight, t.contentWidth = e.scrollWidth, t.contentHeight = e.scrollHeight, e.contains(t.scrollbarXRail) || (c(e, u.element.rail("x")).forEach(function (t) {
                return l(t)
            }), e.appendChild(t.scrollbarXRail)), e.contains(t.scrollbarYRail) || (c(e, u.element.rail("y")).forEach(function (t) {
                return l(t)
            }), e.appendChild(t.scrollbarYRail)), !t.settings.suppressScrollX && t.containerWidth + t.settings.scrollXMarginOffset < t.contentWidth ? (t.scrollbarXActive = !0, t.railXWidth = t.containerWidth - t.railXMarginWidth, t.railXRatio = t.containerWidth / t.railXWidth, t.scrollbarXWidth = T(t, y(t.railXWidth * t.containerWidth / t.contentWidth)), t.scrollbarXLeft = y((t.negativeScrollAdjustment + e.scrollLeft) * (t.railXWidth - t.scrollbarXWidth) / (t.contentWidth - t.containerWidth))) : t.scrollbarXActive = !1, !t.settings.suppressScrollY && t.containerHeight + t.settings.scrollYMarginOffset < t.contentHeight ? (t.scrollbarYActive = !0, t.railYHeight = t.containerHeight - t.railYMarginHeight, t.railYRatio = t.containerHeight / t.railYHeight, t.scrollbarYHeight = T(t, y(t.railYHeight * t.containerHeight / t.contentHeight)), t.scrollbarYTop = y(n * (t.railYHeight - t.scrollbarYHeight) / (t.contentHeight - t.containerHeight))) : t.scrollbarYActive = !1, t.scrollbarXLeft >= t.railXWidth - t.scrollbarXWidth && (t.scrollbarXLeft = t.railXWidth - t.scrollbarXWidth), t.scrollbarYTop >= t.railYHeight - t.scrollbarYHeight && (t.scrollbarYTop = t.railYHeight - t.scrollbarYHeight), function (t, e) {
                var n = { width: e.railXWidth }, r = Math.floor(t.scrollTop);
                e.isRtl ? n.left = e.negativeScrollAdjustment + t.scrollLeft + e.containerWidth - e.contentWidth : n.left = t.scrollLeft;
                e.isScrollbarXUsingBottom ? n.bottom = e.scrollbarXBottom - r : n.top = e.scrollbarXTop + r;
                i(e.scrollbarXRail, n);
                var o = { top: r, height: e.railYHeight };
                e.isScrollbarYUsingRight ? e.isRtl ? o.right = e.contentWidth - (e.negativeScrollAdjustment + t.scrollLeft) - e.scrollbarYRight - e.scrollbarYOuterWidth : o.right = e.scrollbarYRight - t.scrollLeft : e.isRtl ? o.left = e.negativeScrollAdjustment + t.scrollLeft + 2 * e.containerWidth - e.contentWidth - e.scrollbarYLeft - e.scrollbarYOuterWidth : o.left = e.scrollbarYLeft + t.scrollLeft;
                i(e.scrollbarYRail, o), i(e.scrollbarX, {
                    left: e.scrollbarXLeft,
                    width: e.scrollbarXWidth - e.railBorderXWidth
                }), i(e.scrollbarY, { top: e.scrollbarYTop, height: e.scrollbarYHeight - e.railBorderYWidth })
            }(e, t), t.scrollbarXActive ? e.classList.add(u.state.active("x")) : (e.classList.remove(u.state.active("x")), t.scrollbarXWidth = 0, t.scrollbarXLeft = 0, e.scrollLeft = 0), t.scrollbarYActive ? e.classList.add(u.state.active("y")) : (e.classList.remove(u.state.active("y")), t.scrollbarYHeight = 0, t.scrollbarYTop = 0, e.scrollTop = 0)
        };

        function T(t, e) {
            return t.settings.minScrollbarLength && (e = Math.max(e, t.settings.minScrollbarLength)), t.settings.maxScrollbarLength && (e = Math.min(e, t.settings.maxScrollbarLength)), e
        }

        function L(t, e) {
            var n = e[0], r = e[1], i = e[2], o = e[3], a = e[4], s = e[5], l = e[6], c = e[7], f = e[8], p = t.element,
                g = null, v = null, m = null;

            function b(e) {
                p[l] = g + m * (e[i] - v), h(t, c), S(t), e.stopPropagation(), e.preventDefault()
            }

            function y() {
                d(t, c), t[f].classList.remove(u.state.clicking), t.event.unbind(t.ownerDocument, "mousemove", b)
            }

            t.event.bind(t[a], "mousedown", function (e) {
                g = p[l], v = e[i], m = (t[r] - t[n]) / (t[o] - t[s]), t.event.bind(t.ownerDocument, "mousemove", b), t.event.once(t.ownerDocument, "mouseup", y), t[f].classList.add(u.state.clicking), e.stopPropagation(), e.preventDefault()
            })
        }

        var E = {
            "click-rail": function (t) {
                t.event.bind(t.scrollbarY, "mousedown", function (t) {
                    return t.stopPropagation()
                }), t.event.bind(t.scrollbarYRail, "mousedown", function (e) {
                    var n = e.pageY - window.pageYOffset - t.scrollbarYRail.getBoundingClientRect().top > t.scrollbarYTop ? 1 : -1;
                    t.element.scrollTop += n * t.containerHeight, S(t), e.stopPropagation()
                }), t.event.bind(t.scrollbarX, "mousedown", function (t) {
                    return t.stopPropagation()
                }), t.event.bind(t.scrollbarXRail, "mousedown", function (e) {
                    var n = e.pageX - window.pageXOffset - t.scrollbarXRail.getBoundingClientRect().left > t.scrollbarXLeft ? 1 : -1;
                    t.element.scrollLeft += n * t.containerWidth, S(t), e.stopPropagation()
                })
            }, "drag-thumb": function (t) {
                L(t, ["containerWidth", "contentWidth", "pageX", "railXWidth", "scrollbarX", "scrollbarXWidth", "scrollLeft", "x", "scrollbarXRail"]), L(t, ["containerHeight", "contentHeight", "pageY", "railYHeight", "scrollbarY", "scrollbarYHeight", "scrollTop", "y", "scrollbarYRail"])
            }, keyboard: function (t) {
                var e = t.element;
                t.event.bind(t.ownerDocument, "keydown", function (n) {
                    if (!(n.isDefaultPrevented && n.isDefaultPrevented() || n.defaultPrevented) && (s(e, ":hover") || s(t.scrollbarX, ":focus") || s(t.scrollbarY, ":focus"))) {
                        var r, i = document.activeElement ? document.activeElement : t.ownerDocument.activeElement;
                        if (i) {
                            if ("IFRAME" === i.tagName) i = i.contentDocument.activeElement; else for (; i.shadowRoot;)i = i.shadowRoot.activeElement;
                            if (s(r = i, "input,[contenteditable]") || s(r, "select,[contenteditable]") || s(r, "textarea,[contenteditable]") || s(r, "button,[contenteditable]")) return
                        }
                        var o = 0, a = 0;
                        switch (n.which) {
                            case 37:
                                o = n.metaKey ? -t.contentWidth : n.altKey ? -t.containerWidth : -30;
                                break;
                            case 38:
                                a = n.metaKey ? t.contentHeight : n.altKey ? t.containerHeight : 30;
                                break;
                            case 39:
                                o = n.metaKey ? t.contentWidth : n.altKey ? t.containerWidth : 30;
                                break;
                            case 40:
                                a = n.metaKey ? -t.contentHeight : n.altKey ? -t.containerHeight : -30;
                                break;
                            case 32:
                                a = n.shiftKey ? t.containerHeight : -t.containerHeight;
                                break;
                            case 33:
                                a = t.containerHeight;
                                break;
                            case 34:
                                a = -t.containerHeight;
                                break;
                            case 36:
                                a = t.contentHeight;
                                break;
                            case 35:
                                a = -t.contentHeight;
                                break;
                            default:
                                return
                        }
                        t.settings.suppressScrollX && 0 !== o || t.settings.suppressScrollY && 0 !== a || (e.scrollTop -= a, e.scrollLeft += o, S(t), function (n, r) {
                            var i = Math.floor(e.scrollTop);
                            if (0 === n) {
                                if (!t.scrollbarYActive) return !1;
                                if (0 === i && r > 0 || i >= t.contentHeight - t.containerHeight && r < 0) return !t.settings.wheelPropagation
                            }
                            var o = e.scrollLeft;
                            if (0 === r) {
                                if (!t.scrollbarXActive) return !1;
                                if (0 === o && n < 0 || o >= t.contentWidth - t.containerWidth && n > 0) return !t.settings.wheelPropagation
                            }
                            return !0
                        }(o, a) && n.preventDefault())
                    }
                })
            }, wheel: function (t) {
                var e = t.element;

                function n(n) {
                    var i = function (t) {
                        var e = t.deltaX, n = -1 * t.deltaY;
                        return void 0 !== e && void 0 !== n || (e = -1 * t.wheelDeltaX / 6, n = t.wheelDeltaY / 6), t.deltaMode && 1 === t.deltaMode && (e *= 10, n *= 10), e != e && n != n && (e = 0, n = t.wheelDelta), t.shiftKey ? [-n, -e] : [e, n]
                    }(n), o = i[0], a = i[1];
                    if (!function (t, n, i) {
                        if (!w.isWebKit && e.querySelector("select:focus")) return !0;
                        if (!e.contains(t)) return !1;
                        for (var o = t; o && o !== e;) {
                            if (o.classList.contains(u.element.consuming)) return !0;
                            var a = r(o);
                            if ([a.overflow, a.overflowX, a.overflowY].join("").match(/(scroll|auto)/)) {
                                var s = o.scrollHeight - o.clientHeight;
                                if (s > 0 && !(0 === o.scrollTop && i > 0 || o.scrollTop === s && i < 0)) return !0;
                                var l = o.scrollWidth - o.clientWidth;
                                if (l > 0 && !(0 === o.scrollLeft && n < 0 || o.scrollLeft === l && n > 0)) return !0
                            }
                            o = o.parentNode
                        }
                        return !1
                    }(n.target, o, a)) {
                        var s = !1;
                        t.settings.useBothWheelAxes ? t.scrollbarYActive && !t.scrollbarXActive ? (a ? e.scrollTop -= a * t.settings.wheelSpeed : e.scrollTop += o * t.settings.wheelSpeed, s = !0) : t.scrollbarXActive && !t.scrollbarYActive && (o ? e.scrollLeft += o * t.settings.wheelSpeed : e.scrollLeft -= a * t.settings.wheelSpeed, s = !0) : (e.scrollTop -= a * t.settings.wheelSpeed, e.scrollLeft += o * t.settings.wheelSpeed), S(t), (s = s || function (n, r) {
                            var i = Math.floor(e.scrollTop), o = 0 === e.scrollTop,
                                a = i + e.offsetHeight === e.scrollHeight, s = 0 === e.scrollLeft,
                                l = e.scrollLeft + e.offsetWidth === e.scrollWidth;
                            return !(Math.abs(r) > Math.abs(n) ? o || a : s || l) || !t.settings.wheelPropagation
                        }(o, a)) && !n.ctrlKey && (n.stopPropagation(), n.preventDefault())
                    }
                }

                void 0 !== window.onwheel ? t.event.bind(e, "wheel", n) : void 0 !== window.onmousewheel && t.event.bind(e, "mousewheel", n)
            }, touch: function (t) {
                if (w.supportsTouch || w.supportsIePointer) {
                    var e = t.element, n = {}, i = 0, o = {}, a = null;
                    w.supportsTouch ? (t.event.bind(e, "touchstart", f), t.event.bind(e, "touchmove", h), t.event.bind(e, "touchend", d)) : w.supportsIePointer && (window.PointerEvent ? (t.event.bind(e, "pointerdown", f), t.event.bind(e, "pointermove", h), t.event.bind(e, "pointerup", d)) : window.MSPointerEvent && (t.event.bind(e, "MSPointerDown", f), t.event.bind(e, "MSPointerMove", h), t.event.bind(e, "MSPointerUp", d)))
                }
                function s(n, r) {
                    e.scrollTop -= r, e.scrollLeft -= n, S(t)
                }

                function l(t) {
                    return t.targetTouches ? t.targetTouches[0] : t
                }

                function c(t) {
                    return (!t.pointerType || "pen" !== t.pointerType || 0 !== t.buttons) && (!(!t.targetTouches || 1 !== t.targetTouches.length) || !(!t.pointerType || "mouse" === t.pointerType || t.pointerType === t.MSPOINTER_TYPE_MOUSE))
                }

                function f(t) {
                    if (c(t)) {
                        var e = l(t);
                        n.pageX = e.pageX, n.pageY = e.pageY, i = (new Date).getTime(), null !== a && clearInterval(a)
                    }
                }

                function h(a) {
                    if (c(a)) {
                        var f = l(a), h = { pageX: f.pageX, pageY: f.pageY }, d = h.pageX - n.pageX,
                            p = h.pageY - n.pageY;
                        if (function (t, n, i) {
                            if (!e.contains(t)) return !1;
                            for (var o = t; o && o !== e;) {
                                if (o.classList.contains(u.element.consuming)) return !0;
                                var a = r(o);
                                if ([a.overflow, a.overflowX, a.overflowY].join("").match(/(scroll|auto)/)) {
                                    var s = o.scrollHeight - o.clientHeight;
                                    if (s > 0 && !(0 === o.scrollTop && i > 0 || o.scrollTop === s && i < 0)) return !0;
                                    var l = o.scrollLeft - o.clientWidth;
                                    if (l > 0 && !(0 === o.scrollLeft && n < 0 || o.scrollLeft === l && n > 0)) return !0
                                }
                                o = o.parentNode
                            }
                            return !1
                        }(a.target, d, p)) return;
                        s(d, p), n = h;
                        var g = (new Date).getTime(), v = g - i;
                        v > 0 && (o.x = d / v, o.y = p / v, i = g), function (n, r) {
                            var i = Math.floor(e.scrollTop), o = e.scrollLeft, a = Math.abs(n), s = Math.abs(r);
                            if (s > a) {
                                if (r < 0 && i === t.contentHeight - t.containerHeight || r > 0 && 0 === i) return 0 === window.scrollY && r > 0 && w.isChrome
                            } else if (a > s && (n < 0 && o === t.contentWidth - t.containerWidth || n > 0 && 0 === o)) return !0;
                            return !0
                        }(d, p) && a.preventDefault()
                    }
                }

                function d() {
                    t.settings.swipeEasing && (clearInterval(a), a = setInterval(function () {
                        t.isInitialized ? clearInterval(a) : o.x || o.y ? Math.abs(o.x) < .01 && Math.abs(o.y) < .01 ? clearInterval(a) : (s(30 * o.x, 30 * o.y), o.x *= .8, o.y *= .8) : clearInterval(a)
                    }, 10))
                }
            }
        }, x = function (t, e) {
            var n = this;
            if (void 0 === e && (e = {}), "string" == typeof t && (t = document.querySelector(t)), !t || !t.nodeName) throw new Error("no element is specified to initialize PerfectScrollbar");
            for (var a in this.element = t, t.classList.add(u.main), this.settings = {
                handlers: ["click-rail", "drag-thumb", "keyboard", "wheel", "touch"],
                maxScrollbarLength: null,
                minScrollbarLength: null,
                scrollingThreshold: 1e3,
                scrollXMarginOffset: 0,
                scrollYMarginOffset: 0,
                suppressScrollX: !1,
                suppressScrollY: !1,
                swipeEasing: !0,
                useBothWheelAxes: !1,
                wheelPropagation: !0,
                wheelSpeed: 1
            }, e) n.settings[a] = e[a];
            this.containerWidth = null, this.containerHeight = null, this.contentWidth = null, this.contentHeight = null;
            var s, l, c = function () {
                return t.classList.add(u.state.focus)
            }, f = function () {
                return t.classList.remove(u.state.focus)
            };
            this.isRtl = "rtl" === r(t).direction, this.isNegativeScroll = (l = t.scrollLeft, t.scrollLeft = -1, s = t.scrollLeft < 0, t.scrollLeft = l, s), this.negativeScrollAdjustment = this.isNegativeScroll ? t.scrollWidth - t.clientWidth : 0, this.event = new v, this.ownerDocument = t.ownerDocument || document, this.scrollbarXRail = o(u.element.rail("x")), t.appendChild(this.scrollbarXRail), this.scrollbarX = o(u.element.thumb("x")), this.scrollbarXRail.appendChild(this.scrollbarX), this.scrollbarX.setAttribute("tabindex", 0), this.event.bind(this.scrollbarX, "focus", c), this.event.bind(this.scrollbarX, "blur", f), this.scrollbarXActive = null, this.scrollbarXWidth = null, this.scrollbarXLeft = null;
            var h = r(this.scrollbarXRail);
            this.scrollbarXBottom = parseInt(h.bottom, 10), isNaN(this.scrollbarXBottom) ? (this.isScrollbarXUsingBottom = !1, this.scrollbarXTop = y(h.top)) : this.isScrollbarXUsingBottom = !0, this.railBorderXWidth = y(h.borderLeftWidth) + y(h.borderRightWidth), i(this.scrollbarXRail, { display: "block" }), this.railXMarginWidth = y(h.marginLeft) + y(h.marginRight), i(this.scrollbarXRail, { display: "" }), this.railXWidth = null, this.railXRatio = null, this.scrollbarYRail = o(u.element.rail("y")), t.appendChild(this.scrollbarYRail), this.scrollbarY = o(u.element.thumb("y")), this.scrollbarYRail.appendChild(this.scrollbarY), this.scrollbarY.setAttribute("tabindex", 0), this.event.bind(this.scrollbarY, "focus", c), this.event.bind(this.scrollbarY, "blur", f), this.scrollbarYActive = null, this.scrollbarYHeight = null, this.scrollbarYTop = null;
            var d = r(this.scrollbarYRail);
            this.scrollbarYRight = parseInt(d.right, 10), isNaN(this.scrollbarYRight) ? (this.isScrollbarYUsingRight = !1, this.scrollbarYLeft = y(d.left)) : this.isScrollbarYUsingRight = !0, this.scrollbarYOuterWidth = this.isRtl ? function (t) {
                var e = r(t);
                return y(e.width) + y(e.paddingLeft) + y(e.paddingRight) + y(e.borderLeftWidth) + y(e.borderRightWidth)
            }(this.scrollbarY) : null, this.railBorderYWidth = y(d.borderTopWidth) + y(d.borderBottomWidth), i(this.scrollbarYRail, { display: "block" }), this.railYMarginHeight = y(d.marginTop) + y(d.marginBottom), i(this.scrollbarYRail, { display: "" }), this.railYHeight = null, this.railYRatio = null, this.reach = {
                x: t.scrollLeft <= 0 ? "start" : t.scrollLeft >= this.contentWidth - this.containerWidth ? "end" : null,
                y: t.scrollTop <= 0 ? "start" : t.scrollTop >= this.contentHeight - this.containerHeight ? "end" : null
            }, this.isAlive = !0, this.settings.handlers.forEach(function (t) {
                return E[t](n)
            }), this.lastScrollTop = Math.floor(t.scrollTop), this.lastScrollLeft = t.scrollLeft, this.event.bind(this.element, "scroll", function (t) {
                return n.onScroll(t)
            }), S(this)
        };
        x.prototype.update = function () {
            this.isAlive && (this.negativeScrollAdjustment = this.isNegativeScroll ? this.element.scrollWidth - this.element.clientWidth : 0, i(this.scrollbarXRail, { display: "block" }), i(this.scrollbarYRail, { display: "block" }), this.railXMarginWidth = y(r(this.scrollbarXRail).marginLeft) + y(r(this.scrollbarXRail).marginRight), this.railYMarginHeight = y(r(this.scrollbarYRail).marginTop) + y(r(this.scrollbarYRail).marginBottom), i(this.scrollbarXRail, { display: "none" }), i(this.scrollbarYRail, { display: "none" }), S(this), b(this, "top", 0, !1, !0), b(this, "left", 0, !1, !0), i(this.scrollbarXRail, { display: "" }), i(this.scrollbarYRail, { display: "" }))
        }, x.prototype.onScroll = function (t) {
            this.isAlive && (S(this), b(this, "top", this.element.scrollTop - this.lastScrollTop), b(this, "left", this.element.scrollLeft - this.lastScrollLeft), this.lastScrollTop = Math.floor(this.element.scrollTop), this.lastScrollLeft = this.element.scrollLeft)
        }, x.prototype.destroy = function () {
            this.isAlive && (this.event.unbindAll(), l(this.scrollbarX), l(this.scrollbarY), l(this.scrollbarXRail), l(this.scrollbarYRail), this.removePsClasses(), this.element = null, this.scrollbarX = null, this.scrollbarY = null, this.scrollbarXRail = null, this.scrollbarYRail = null, this.isAlive = !1)
        }, x.prototype.removePsClasses = function () {
            this.element.className = this.element.className.split(" ").filter(function (t) {
                return !t.match(/^ps([-_].+|)$/)
            }).join(" ")
        }, e.default = x
    }, yLpj: function (t, e) {
        var n;
        n = function () {
            return this
        }();
        try {
            n = n || new Function("return this")()
        } catch (t) {
            "object" == typeof window && (n = window)
        }
        t.exports = n
    }
}, [[1, 0, 1]]]);

$(document).ready(function () {
    $(document).on('click', '#edit-appartment', function () {
        var type = $(this).attr('attr-type');
        if (type == 'edit') {
            $(this).parent().find('.cancel-edit').show();
            $(this).text('Save All');
            $(this).attr('attr-type', 'view');
            $(".appartment").attr('readonly', false);
        } else {
            if (confirm("Are you sure wants to save all?")) {
                $("#appartment-form").submit();
                $(this).text('Edit');
                $(this).attr('attr-type', 'edit');
                $(".appartment").attr('readonly', true);
            } else {
                return false;
            }
        }
    });
    $(document).on('click', '#edit-materials', function () {
        var type = $(this).attr('attr-type');
        if (type == 'edit') {
            $(this).parent().find('.cancel-edit').show();
            $(this).text('Save All');
            $(this).attr('attr-type', 'view');
            $(".material").attr('readonly', false);
            $(".material-area").attr('readonly', true);
        } else {
            if (confirm("Are you sure wants to save all?")) {
                $("#materials-form").submit();
                $(this).text('Edit');
                $(this).attr('attr-type', 'edit');
                $(".appartment").attr('readonly', true);
            } else {
                return false;
            }
        }
    });
    $(document).on('click', '#edit-property', function () {
        var type = $(this).attr('attr-type');
        if (type == 'edit') {
            $(this).parent().find('.cancel-edit').show();
            $(this).text('Save All');
            $(this).attr('attr-type', 'view');
            $(".property").attr('readonly', false);
        } else {
            if (confirm("Are you sure wants to save all?")) {
                $("#property-form").submit();
                $(this).text('Edit');
                $(this).attr('attr-type', 'edit');
                $(".property").attr('readonly', true);
            } else {
                return false;
            }
        }
    });
    $(document).on('click', '#edit-other-materials', function () {
        var type = $(this).attr('attr-type');
        if (type == 'edit') {
            $(this).parent().find('.cancel-edit').show();
            $(this).text('Save All');
            $(this).attr('attr-type', 'view');
            $(".other-materials").attr('readonly', false);
        } else {
            if (confirm("Are you sure wants to save all?")) {
                $("#other-materials-form").submit();
                $(this).text('Edit');
                $(this).attr('attr-type', 'edit');
                $(".other-materials").attr('readonly', true);
            } else {
                return false;
            }
        }
    });
    $(document).on('input', '.workrates', function () {
        var cost_per_hour = $(this).parent().parent().find('.workrates-cost-per-hour').val();
        var time_per_m2 = $(this).parent().parent().find('.workrates-time-per-m2').val();
        if ($(this).attr('name').includes('time_per_m2')) {
            //var in_hour = time_per_m2/60;
            //$(this).parent().find('span').html(in_hour.toFixed(2)+' hours');
        }
        /*if(cost_per_hour !='' && time_per_m2 !=''){
            var m2 = 60/time_per_m2;
            var cost_per_m2 = cost_per_hour/m2;
        }*/
        var cost_per_m2 = cost_per_hour * time_per_m2;
        $(this).parent().parent().find('.workrates-cost_per_m2').val(cost_per_m2.toFixed(2));
    });
    $(document).on('click', '#edit-workrates', function () {
        var type = $(this).attr('attr-type');
        if (type == 'edit') {
            $(this).parent().find('.cancel-edit').show();
            $(this).text('Save All');
            $(this).attr('attr-type', 'view');
            $(".workrates").attr('readonly', false);
            $(".workrates-cost_per_m2").attr('readonly', true);
            $(".workrates-area").attr('readonly', true);
        } else {
            if (confirm("Are you sure wants to save all?")) {
                $("#workrates-form").submit();
                $(this).text('Edit');
                $(this).attr('attr-type', 'edit');
                $(".workrates").attr('readonly', true);
            } else {
                return false;
            }
        }
    });

    $(document).on('click', '#edit-area', function () {
        var type = $(this).attr('attr-type');
        if (type == 'edit') {
            $(this).parent().find('.cancel-edit').show();
            $(this).text('Save All');
            $(this).attr('attr-type', 'view');
            $("select.area").prop("disabled", false);
            $("input.area").attr('readonly', false);
        } else {
            if (confirm("Are you sure wants to save all?")) {
                $("#area-form").submit();
                $(this).text('Edit');
                $(this).attr('attr-type', 'edit');
                $("select.area").prop("disabled", true);
                $("input.area").attr('readonly', true);
            } else {
                return false;
            }
        }
    });
    function validateAreaForm() {
        var city = $("#city").val();
        var postal_code = $("#postal_code").val();
        var price = $("#price").val();
        var valreturn = 'true';
        if (city == "") {
            $(".error-city").html('Please select city!');
            valreturn = 'false';
        } else {
            $(".error-city").html('');
        }
        if (postal_code.trim() == '') {
            $(".error-code").html('Please insert postal code!');
            valreturn = 'false';
        } else {
            $(".error-code").html('');
        } if (price.trim() == "") {
            $(".error-price").html('Please insert price!');
            valreturn = 'false';
        } else {
            $(".error-price").html('');
        }
        return valreturn;
    }
    $(document).on('click', '#create-area-btn', function () {
        var status = validateAreaForm();
        if (status != 'true') {
            return false;
        }
    });
    $(document).on('change', '.area-input', function () {
        validateAreaForm();
    });
    $(document).on('click', '#upload-btn', function () {
        var upload_price = $('#upload-price')[0].files[0];
        if (!upload_price || upload_price.name == '') {
            $(".error-upload").html('Please select csv file!');
            return false;
        }
    });
    $(document).on('click', '#upload-workrates-btn', function () {
        var upload_workrate = $('#upload-workrates')[0].files[0];
        if (!upload_workrate || upload_workrate.name == '') {
            $(".error-upload").html('Please select csv file!');
            return false;
        }
    });
    $(document).on('change', '#upload-workrates', function () {
        var upload_price = $('#upload-workrates')[0].files[0];
        if (!upload_price || upload_price.name == '') {
            $(".error-upload").html('Please select csv file!');
        } else {
            $(".error-upload").html('');
        }
    });
    $(document).on('change', '#upload-price', function () {
        var upload_price = $('#upload-price')[0].files[0];
        if (!upload_price || upload_price.name == '') {
            $(".error-upload").html('Please select csv file!');
        } else {
            $(".error-upload").html('');
        }
    });
    $(document).on('click', '#upload-materialsrates-btn', function () {
        var upload_price = $('#upload-materials-rates')[0].files[0];
        if (!upload_price || upload_price.name == '') {
            $(".error-upload-materials").html('Please select csv file!');
            return false;
        }
    });
    $(document).on('change', '#upload-materials-rates', function () {
        var upload_price = $('#upload-materials-rates')[0].files[0];
        if (!upload_price || upload_price.name == '') {
            $(".error-upload-materials").html('Please select csv file!');
        } else {
            $(".error-upload-materials").html('');
        }
    });
    $(document).on('click', '.cancel-edit', function () {
        var type = $(this).attr('attr-class');
        var attr_id = $(this).attr('attr-id');
        if (attr_id == 'edit-area') {
            $("select.area").prop("disabled", true);
        }
        $("." + type).attr('readonly', true);
        $("#" + attr_id).text('Edit');
        $("#" + attr_id).attr('attr-type', 'edit');
        $(this).hide();
    });

    $('.cstm-add-btn').on('click', function () {
        var inputD = ''
        inputD = inputD + '<div class="form-group">';
        inputD = inputD + '<input type="file" required accept="image/*" class="form-control" name="slider_images[]">';
        inputD = inputD + '<span class="cstm-rmv-btn btn btn-danger">Remove</span>';
        inputD = inputD + '</div>';

        $('.sldr-imgs').append(inputD);
    });

    $(document).on('click', '.cstm-rmv-btn', function () {
        $(this).parent().remove();
    });
    $(document).on('click', '.pre', function (event) {
        event.preventDefault();
    });

    $('.cstm-dlt-img').on('click', function (e) {
        e.preventDefault();
        var r = confirm("Are you sure you want to delete this image?");
        if (r == true) {
            $(this).parent().remove();
        }
    });
    $(document).on('click','.del-work',function(){
        if($('.del-work:checked').length >0) {
            $("#delete-workrates").show();
        }else {
            $("#delete-workrates").hide();
        }
    });
    $(document).on('click','.del-met',function(){
        if($('.del-met:checked').length >0) {
            $("#delete-materials").show();
        }else {
            $("#delete-materials").hide();
        }
    });
    $(document).on('click','#delete-materials',function(){
        if(confirm("Are you sure wants to delete?")){
            var del_id = '';
            $('.del-met:checked').each(function(index, value) {
                del_id = del_id+'-'+ $(this).val();
            });
            $.post('destroy',   // url
                { type: 'met',ids : del_id }, // data to be submit
            function(data) {// success callback
                location.reload();
            });
        }


    });
    $(document).on('click','#delete-workrates',function(){
        if(confirm("Are you sure wants to delete?")) {
            var del_id = '';
            $('.del-work:checked').each(function (index, value) {
                del_id = del_id + '-' + $(this).val();
            });
            $.post('destroy',   // url
                {type: 'work', ids: del_id}, // data to be submit
                function (data) {// success callback
                    location.reload();
                });
        }
    });
});
//# sourceMappingURL=backend.js.map