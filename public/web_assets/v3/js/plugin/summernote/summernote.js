!function (a) {
    "function" == typeof define && define.amd ? define(["jquery"], a) : "object" == typeof module && module.exports ? module.exports = a(require("jquery")) : a(window.jQuery)
}(function (a) {
    "use strict";
    var b, c = function () {
            var b = function (a) {
                    return function (b) {
                        return a === b
                    }
                },
                c = function (a, b) {
                    return a === b
                },
                d = function (a) {
                    return function (b, c) {
                        return b[a] === c[a]
                    }
                },
                e = function () {
                    return !0
                },
                f = function () {
                    return !1
                },
                g = function (a) {
                    return function () {
                        return !a.apply(a, arguments)
                    }
                },
                h = function (a, b) {
                    return function (c) {
                        return a(c) && b(c)
                    }
                },
                i = function (a) {
                    return a
                },
                j = function (a, b) {
                    return function () {
                        return a[b].apply(a, arguments)
                    }
                },
                k = 0,
                l = function (a) {
                    var b = ++k + "";
                    return a ? a + b : b
                },
                m = function (b) {
                    var c = a(document);
                    return {
                        "top": b.top + c.scrollTop(),
                        "left": b.left + c.scrollLeft(),
                        "width": b.right - b.left,
                        "height": b.bottom - b.top
                    }
                },
                n = function (a) {
                    var b = {};
                    for (var c in a) a.hasOwnProperty(c) && (b[a[c]] = c);
                    return b
                },
                o = function (a, b) {
                    return b = b || "", b + a.split(".").map(function (a) {
                        return a.substring(0, 1).toUpperCase() + a.substring(1)
                    }).join("")
                };
            return {
                "eq": b,
                "eq2": c,
                "peq2": d,
                "ok": e,
                "fail": f,
                "self": i,
                "not": g,
                "and": h,
                "invoke": j,
                "uniqueId": l,
                "rect2bnd": m,
                "invertObject": n,
                "namespaceToCamel": o
            }
        }(),
        d = function () {
            var b = function (a) {
                    return a[0]
                },
                d = function (a) {
                    return a[a.length - 1]
                },
                e = function (a) {
                    return a.slice(0, a.length - 1)
                },
                f = function (a) {
                    return a.slice(1)
                },
                g = function (a, b) {
                    for (var c = 0, d = a.length; d > c; c++) {
                        var e = a[c];
                        if (b(e)) return e
                    }
                },
                h = function (a, b) {
                    for (var c = 0, d = a.length; d > c; c++)
                        if (!b(a[c])) return !1;
                    return !0
                },
                i = function (b, c) {
                    return a.inArray(c, b)
                },
                j = function (a, b) {
                    return -1 !== i(a, b)
                },
                k = function (a, b) {
                    return b = b || c.self, a.reduce(function (a, c) {
                        return a + b(c)
                    }, 0)
                },
                l = function (a) {
                    for (var b = [], c = -1, d = a.length; ++c < d;) b[c] = a[c];
                    return b
                },
                m = function (a) {
                    return !a || !a.length
                },
                n = function (a, c) {
                    if (!a.length) return [];
                    var e = f(a);
                    return e.reduce(function (a, b) {
                        var e = d(a);
                        return c(d(e), b) ? e[e.length] = b : a[a.length] = [b], a
                    }, [
                        [b(a)]
                    ])
                },
                o = function (a) {
                    for (var b = [], c = 0, d = a.length; d > c; c++) a[c] && b.push(a[c]);
                    return b
                },
                p = function (a) {
                    for (var b = [], c = 0, d = a.length; d > c; c++) j(b, a[c]) || b.push(a[c]);
                    return b
                },
                q = function (a, b) {
                    var c = i(a, b);
                    return -1 === c ? null : a[c + 1]
                },
                r = function (a, b) {
                    var c = i(a, b);
                    return -1 === c ? null : a[c - 1]
                };
            return {
                "head": b,
                "last": d,
                "initial": e,
                "tail": f,
                "prev": r,
                "next": q,
                "find": g,
                "contains": j,
                "all": h,
                "sum": k,
                "from": l,
                "isEmpty": m,
                "clusterBy": n,
                "compact": o,
                "unique": p
            }
        }(),
        e = "function" == typeof define && define.amd,
        f = function (b) {
            var c = "Comic Sans MS" === b ? "Courier New" : "Comic Sans MS",
                d = a("<div>").css({
                    "position": "absolute",
                    "left": "-9999px",
                    "top": "-9999px",
                    "fontSize": "200px"
                }).text("mmmmmmmmmwwwwwww").appendTo(document.body),
                e = d.css("fontFamily", c).width(),
                f = d.css("fontFamily", b + "," + c).width();
            return d.remove(), e !== f
        },
        g = navigator.userAgent,
        h = /MSIE|Trident/i.test(g);
    if (h) {
        var i = /MSIE (\d+[.]\d+)/.exec(g);
        i && (b = parseFloat(i[1])), i = /Trident\/.*rv:([0-9]{1,}[\.0-9]{0,})/.exec(g), i && (b = parseFloat(i[1]))
    }
    var j = /Edge\/\d+/.test(g),
        k = !!window.CodeMirror;
    if (!k && e && require)
        if (require.hasOwnProperty("resolve")) try {
            require.resolve("codemirror"), k = !0
        } catch (l) {
            k = !1
        } else require.hasOwnProperty("specified") && (k = require.specified("codemirror"));
    var m = {
            "isMac": navigator.appVersion.indexOf("Mac") > -1,
            "isMSIE": h,
            "isEdge": j,
            "isFF": !j && /firefox/i.test(g),
            "isPhantom": /PhantomJS/i.test(g),
            "isWebkit": !j && /webkit/i.test(g),
            "isChrome": !j && /chrome/i.test(g),
            "isSafari": !j && /safari/i.test(g),
            "browserVersion": b,
            "jqueryVersion": parseFloat(a.fn.jquery),
            "isSupportAmd": e,
            "hasCodeMirror": k,
            "isFontInstalled": f,
            "isW3CRangeSupport": !!document.createRange
        },
        n = String.fromCharCode(160),
        o = "\ufeff",
        p = function () {
            var b = function (b) {
                    return b && a(b).hasClass("note-editable")
                },
                e = function (b) {
                    return b && a(b).hasClass("note-control-sizing")
                },
                f = function (a) {
                    return a = a.toUpperCase(),
                        function (b) {
                            return b && b.nodeName.toUpperCase() === a
                        }
                },
                g = function (a) {
                    return a && 3 === a.nodeType
                },
                h = function (a) {
                    return a && 1 === a.nodeType
                },
                i = function (a) {
                    return a && /^BR|^IMG|^HR|^IFRAME|^BUTTON/.test(a.nodeName.toUpperCase())
                },
                j = function (a) {
                    return b(a) ? !1 : a && /^DIV|^P|^LI|^H[1-7]/.test(a.nodeName.toUpperCase())
                },
                k = function (a) {
                    return a && /^H[1-7]/.test(a.nodeName.toUpperCase())
                },
                l = f("PRE"),
                q = f("LI"),
                r = function (a) {
                    return j(a) && !q(a)
                },
                s = f("TABLE"),
                t = function (a) {
                    return !(y(a) || u(a) || v(a) || j(a) || s(a) || x(a))
                },
                u = function (a) {
                    return a && /^UL|^OL/.test(a.nodeName.toUpperCase())
                },
                v = f("HR"),
                w = function (a) {
                    return a && /^TD|^TH/.test(a.nodeName.toUpperCase())
                },
                x = f("BLOCKQUOTE"),
                y = function (a) {
                    return w(a) || x(a) || b(a)
                },
                z = f("A"),
                A = function (a) {
                    return t(a) && !!J(a, j)
                },
                B = function (a) {
                    return t(a) && !J(a, j)
                },
                C = f("BODY"),
                D = function (a, b) {
                    return a.nextSibling === b || a.previousSibling === b
                },
                E = function (a, b) {
                    b = b || c.ok;
                    var d = [];
                    return a.previousSibling && b(a.previousSibling) && d.push(a.previousSibling), d.push(a), a.nextSibling && b(a.nextSibling) && d.push(a.nextSibling), d
                },
                F = m.isMSIE && m.browserVersion < 11 ? "&nbsp;" : "<br>",
                G = function (a) {
                    return g(a) ? a.nodeValue.length : a.childNodes.length
                },
                H = function (a) {
                    var b = G(a);
                    return 0 === b ? !0 : g(a) || 1 !== b || a.innerHTML !== F ? d.all(a.childNodes, g) && "" === a.innerHTML ? !0 : !1 : !0
                },
                I = function (a) {
                    i(a) || G(a) || (a.innerHTML = F)
                },
                J = function (a, c) {
                    for (; a;) {
                        if (c(a)) return a;
                        if (b(a)) break;
                        a = a.parentNode
                    }
                    return null
                },
                K = function (a, c) {
                    for (a = a.parentNode; a && 1 === G(a);) {
                        if (c(a)) return a;
                        if (b(a)) break;
                        a = a.parentNode
                    }
                    return null
                },
                L = function (a, d) {
                    d = d || c.fail;
                    var e = [];
                    return J(a, function (a) {
                        return b(a) || e.push(a), d(a)
                    }), e
                },
                M = function (a, b) {
                    var c = L(a);
                    return d.last(c.filter(b))
                },
                N = function (b, c) {
                    for (var d = L(b), e = c; e; e = e.parentNode)
                        if (a.inArray(e, d) > -1) return e;
                    return null
                },
                O = function (a, b) {
                    b = b || c.fail;
                    for (var d = []; a && !b(a);) d.push(a), a = a.previousSibling;
                    return d
                },
                P = function (a, b) {
                    b = b || c.fail;
                    for (var d = []; a && !b(a);) d.push(a), a = a.nextSibling;
                    return d
                },
                Q = function (a, b) {
                    var d = [];
                    return b = b || c.ok,
                        function e(c) {
                            a !== c && b(c) && d.push(c);
                            for (var f = 0, g = c.childNodes.length; g > f; f++) e(c.childNodes[f])
                        }(a), d
                },
                R = function (b, c) {
                    var d = b.parentNode,
                        e = a("<" + c + ">")[0];
                    return d.insertBefore(e, b), e.appendChild(b), e
                },
                S = function (a, b) {
                    var c = b.nextSibling,
                        d = b.parentNode;
                    return c ? d.insertBefore(a, c) : d.appendChild(a), a
                },
                T = function (b, c) {
                    return a.each(c, function (a, c) {
                        b.appendChild(c)
                    }), b
                },
                U = function (a) {
                    return 0 === a.offset
                },
                V = function (a) {
                    return a.offset === G(a.node)
                },
                W = function (a) {
                    return U(a) || V(a)
                },
                X = function (a, b) {
                    for (; a && a !== b;) {
                        if (0 !== _(a)) return !1;
                        a = a.parentNode
                    }
                    return !0
                },
                Y = function (a, b) {
                    for (; a && a !== b;) {
                        if (_(a) !== G(a.parentNode) - 1) return !1;
                        a = a.parentNode
                    }
                    return !0
                },
                Z = function (a, b) {
                    return U(a) && X(a.node, b)
                },
                $ = function (a, b) {
                    return V(a) && Y(a.node, b)
                },
                _ = function (a) {
                    for (var b = 0; a = a.previousSibling;) b += 1;
                    return b
                },
                aa = function (a) {
                    return !!(a && a.childNodes && a.childNodes.length)
                },
                ba = function (a, c) {
                    var d, e;
                    if (0 === a.offset) {
                        if (b(a.node)) return null;
                        d = a.node.parentNode, e = _(a.node)
                    } else aa(a.node) ? (d = a.node.childNodes[a.offset - 1], e = G(d)) : (d = a.node, e = c ? 0 : a.offset - 1);
                    return {
                        "node": d,
                        "offset": e
                    }
                },
                ca = function (a, c) {
                    var d, e;
                    if (G(a.node) === a.offset) {
                        if (b(a.node)) return null;
                        d = a.node.parentNode, e = _(a.node) + 1
                    } else aa(a.node) ? (d = a.node.childNodes[a.offset], e = 0) : (d = a.node, e = c ? G(a.node) : a.offset + 1);
                    return {
                        "node": d,
                        "offset": e
                    }
                },
                da = function (a, b) {
                    return a.node === b.node && a.offset === b.offset
                },
                ea = function (a) {
                    if (g(a.node) || !aa(a.node) || H(a.node)) return !0;
                    var b = a.node.childNodes[a.offset - 1],
                        c = a.node.childNodes[a.offset];
                    return b && !i(b) || c && !i(c) ? !1 : !0
                },
                fa = function (a, b) {
                    for (; a;) {
                        if (b(a)) return a;
                        a = ba(a)
                    }
                    return null
                },
                ga = function (a, b) {
                    for (; a;) {
                        if (b(a)) return a;
                        a = ca(a)
                    }
                    return null
                },
                ha = function (a) {
                    if (!g(a.node)) return !1;
                    var b = a.node.nodeValue.charAt(a.offset - 1);
                    return b && " " !== b && b !== n
                },
                ia = function (a, b, c, d) {
                    for (var e = a; e && (c(e), !da(e, b));) {
                        var f = d && a.node !== e.node && b.node !== e.node;
                        e = ca(e, f)
                    }
                },
                ja = function (a, b) {
                    var d = L(b, c.eq(a));
                    return d.map(_).reverse()
                },
                ka = function (a, b) {
                    for (var c = a, d = 0, e = b.length; e > d; d++) c = c.childNodes.length <= b[d] ? c.childNodes[c.childNodes.length - 1] : c.childNodes[b[d]];
                    return c
                },
                la = function (a, b) {
                    var c = b && b.isSkipPaddingBlankHTML,
                        d = b && b.isNotSplitEdgePoint;
                    if (W(a) && (g(a.node) || d)) {
                        if (U(a)) return a.node;
                        if (V(a)) return a.node.nextSibling
                    }
                    if (g(a.node)) return a.node.splitText(a.offset);
                    var e = a.node.childNodes[a.offset],
                        f = S(a.node.cloneNode(!1), a.node);
                    return T(f, P(e)), c || (I(a.node), I(f)), f
                },
                ma = function (a, b, d) {
                    var e = L(b.node, c.eq(a));
                    return e.length ? 1 === e.length ? la(b, d) : e.reduce(function (a, c) {
                        return a === b.node && (a = la(b, d)), la({
                            "node": c,
                            "offset": a ? p.position(a) : G(c)
                        }, d)
                    }) : null
                },
                na = function (a, b) {
                    var c, e, f = b ? j : y,
                        g = L(a.node, f),
                        h = d.last(g) || a.node;
                    f(h) ? (c = g[g.length - 2], e = h) : (c = h, e = c.parentNode);
                    var i = c && ma(c, a, {
                            "isSkipPaddingBlankHTML": b,
                            "isNotSplitEdgePoint": b
                        });
                    return i || e !== a.node || (i = a.node.childNodes[a.offset]), {
                        "rightNode": i,
                        "container": e
                    }
                },
                oa = function (a) {
                    return document.createElement(a)
                },
                pa = function (a) {
                    return document.createTextNode(a)
                },
                qa = function (a, b) {
                    if (a && a.parentNode) {
                        if (a.removeNode) return a.removeNode(b);
                        var c = a.parentNode;
                        if (!b) {
                            var d, e, f = [];
                            for (d = 0, e = a.childNodes.length; e > d; d++) f.push(a.childNodes[d]);
                            for (d = 0, e = f.length; e > d; d++) c.insertBefore(f[d], a)
                        }
                        c.removeChild(a)
                    }
                },
                ra = function (a, c) {
                    for (; a && !b(a) && c(a);) {
                        var d = a.parentNode;
                        qa(a), a = d
                    }
                },
                sa = function (a, b) {
                    if (a.nodeName.toUpperCase() === b.toUpperCase()) return a;
                    var c = oa(b);
                    return a.style.cssText && (c.style.cssText = a.style.cssText), T(c, d.from(a.childNodes)), S(c, a), qa(a), c
                },
                ta = f("TEXTAREA"),
                ua = function (a, b) {
                    var c = ta(a[0]) ? a.val() : a.html();
                    return b ? c.replace(/[\n\r]/g, "") : c
                },
                va = function (b, c) {
                    var d = ua(b);
                    if (c) {
                        var e = /<(\/?)(\b(?!!)[^>\s]*)(.*?)(\s*\/?>)/g;
                        d = d.replace(e, function (a, b, c) {
                            c = c.toUpperCase();
                            var d = /^DIV|^TD|^TH|^P|^LI|^H[1-7]/.test(c) && !!b,
                                e = /^BLOCKQUOTE|^TABLE|^TBODY|^TR|^HR|^UL|^OL/.test(c);
                            return a + (d || e ? "\n" : "")
                        }), d = a.trim(d)
                    }
                    return d
                },
                wa = function (b) {
                    var c = a(b),
                        d = c.offset(),
                        e = c.outerHeight(!0);
                    return {
                        "left": d.left,
                        "top": d.top + e
                    }
                },
                xa = function (a, b) {
                    Object.keys(b).forEach(function (c) {
                        a.on(c, b[c])
                    })
                },
                ya = function (a, b) {
                    Object.keys(b).forEach(function (c) {
                        a.off(c, b[c])
                    })
                };
            return {
                "NBSP_CHAR": n,
                "ZERO_WIDTH_NBSP_CHAR": o,
                "blank": F,
                "emptyPara": "<p>" + F + "</p>",
                "makePredByNodeName": f,
                "isEditable": b,
                "isControlSizing": e,
                "isText": g,
                "isElement": h,
                "isVoid": i,
                "isPara": j,
                "isPurePara": r,
                "isHeading": k,
                "isInline": t,
                "isBlock": c.not(t),
                "isBodyInline": B,
                "isBody": C,
                "isParaInline": A,
                "isPre": l,
                "isList": u,
                "isTable": s,
                "isCell": w,
                "isBlockquote": x,
                "isBodyContainer": y,
                "isAnchor": z,
                "isDiv": f("DIV"),
                "isLi": q,
                "isBR": f("BR"),
                "isSpan": f("SPAN"),
                "isB": f("B"),
                "isU": f("U"),
                "isS": f("S"),
                "isI": f("I"),
                "isImg": f("IMG"),
                "isTextarea": ta,
                "isEmpty": H,
                "isEmptyAnchor": c.and(z, H),
                "isClosestSibling": D,
                "withClosestSiblings": E,
                "nodeLength": G,
                "isLeftEdgePoint": U,
                "isRightEdgePoint": V,
                "isEdgePoint": W,
                "isLeftEdgeOf": X,
                "isRightEdgeOf": Y,
                "isLeftEdgePointOf": Z,
                "isRightEdgePointOf": $,
                "prevPoint": ba,
                "nextPoint": ca,
                "isSamePoint": da,
                "isVisiblePoint": ea,
                "prevPointUntil": fa,
                "nextPointUntil": ga,
                "isCharPoint": ha,
                "walkPoint": ia,
                "ancestor": J,
                "singleChildAncestor": K,
                "listAncestor": L,
                "lastAncestor": M,
                "listNext": P,
                "listPrev": O,
                "listDescendant": Q,
                "commonAncestor": N,
                "wrap": R,
                "insertAfter": S,
                "appendChildNodes": T,
                "position": _,
                "hasChildren": aa,
                "makeOffsetPath": ja,
                "fromOffsetPath": ka,
                "splitTree": ma,
                "splitPoint": na,
                "create": oa,
                "createText": pa,
                "remove": qa,
                "removeWhile": ra,
                "replace": sa,
                "html": va,
                "value": ua,
                "posFromPlaceholder": wa,
                "attachEvents": xa,
                "detachEvents": ya
            }
        }(),
        q = function (b, e) {
            var f = this,
                g = a.summernote.ui;
            return this.memos = {}, this.modules = {}, this.layoutInfo = {}, this.options = e, this.initialize = function () {
                return this.layoutInfo = g.createLayout(b, e), this._initialize(), b.hide(), this
            }, this.destroy = function () {
                this._destroy(), b.removeData("summernote"), g.removeLayout(b, this.layoutInfo)
            }, this.reset = function () {
                var a = f.isDisabled();
                this.code(p.emptyPara), this._destroy(), this._initialize(), a && f.disable()
            }, this._initialize = function () {
                var b = a.extend({}, this.options.buttons);
                Object.keys(b).forEach(function (a) {
                    f.memo("button." + a, b[a])
                });
                var c = a.extend({}, this.options.modules, a.summernote.plugins || {});
                Object.keys(c).forEach(function (a) {
                    f.module(a, c[a], !0)
                }), Object.keys(this.modules).forEach(function (a) {
                    f.initializeModule(a)
                })
            }, this._destroy = function () {
                Object.keys(this.modules).reverse().forEach(function (a) {
                    f.removeModule(a)
                }), Object.keys(this.memos).forEach(function (a) {
                    f.removeMemo(a)
                })
            }, this.code = function (a) {
                var c = this.invoke("codeview.isActivated");
                return void 0 === a ? (this.invoke("codeview.sync"), c ? this.layoutInfo.codable.val() : this.layoutInfo.editable.html()) : (c ? this.layoutInfo.codable.val(a) : this.layoutInfo.editable.html(a), b.val(a), this.triggerEvent("change", a), void 0)
            }, this.isDisabled = function () {
                return "false" === this.layoutInfo.editable.attr("contenteditable")
            }, this.enable = function () {
                this.layoutInfo.editable.attr("contenteditable", !0), this.invoke("toolbar.activate", !0)
            }, this.disable = function () {
                this.invoke("codeview.isActivated") && this.invoke("codeview.deactivate"), this.layoutInfo.editable.attr("contenteditable", !1), this.invoke("toolbar.deactivate", !0)
            }, this.triggerEvent = function () {
                var a = d.head(arguments),
                    e = d.tail(d.from(arguments)),
                    f = this.options.callbacks[c.namespaceToCamel(a, "on")];
                f && f.apply(b[0], e), b.trigger("summernote." + a, e)
            }, this.initializeModule = function (a) {
                var d = this.modules[a];
                d.shouldInitialize = d.shouldInitialize || c.ok, d.shouldInitialize() && (d.initialize && d.initialize(), d.events && p.attachEvents(b, d.events))
            }, this.module = function (a, b, c) {
                return 1 === arguments.length ? this.modules[a] : (this.modules[a] = new b(this), void(c || this.initializeModule(a)))
            }, this.removeModule = function (a) {
                var c = this.modules[a];
                c.shouldInitialize() && (c.events && p.detachEvents(b, c.events), c.destroy && c.destroy()), delete this.modules[a]
            }, this.memo = function (a, b) {
                return 1 === arguments.length ? this.memos[a] : void(this.memos[a] = b)
            }, this.removeMemo = function (a) {
                this.memos[a] && this.memos[a].destroy && this.memos[a].destroy(), delete this.memos[a]
            }, this.createInvokeHandler = function (b, c) {
                return function (d) {
                    d.preventDefault(), f.invoke(b, c || a(d.target).closest("[data-value]").data("value"))
                }
            }, this.invoke = function () {
                var a = d.head(arguments),
                    b = d.tail(d.from(arguments)),
                    c = a.split("."),
                    e = c.length > 1,
                    f = e && d.head(c),
                    g = e ? d.last(c) : d.head(c),
                    h = this.modules[f || "editor"];
                return !f && this[g] ? this[g].apply(this, b) : h && h[g] && h.shouldInitialize() ? h[g].apply(h, b) : void 0
            }, this.initialize()
        };
    a.fn.extend({
        "summernote": function () {
            var b = a.type(d.head(arguments)),
                c = "string" === b,
                e = "object" === b,
                f = e ? d.head(arguments) : {};
            f = a.extend({}, a.summernote.options, f), f.langInfo = a.extend(!0, {}, a.summernote.lang["en-US"], a.summernote.lang[f.lang]), this.each(function (b, c) {
                var d = a(c);
                if (!d.data("summernote")) {
                    var e = new q(d, f);
                    d.data("summernote", e), d.data("summernote").triggerEvent("init", e.layoutInfo)
                }
            });
            var g = this.first();
            if (g.length) {
                var h = g.data("summernote");
                if (c) return h.invoke.apply(h, d.from(arguments));
                f.focus && h.invoke("editor.focus")
            }
            return this
        }
    });
    var r = function (b, c, d, e) {
            this.render = function (f) {
                var g = a(b);
                if (d && d.contents && g.html(d.contents), d && d.className && g.addClass(d.className), d && d.data && a.each(d.data, function (a, b) {
                        g.attr("data-" + a, b)
                    }), d && d.click && g.on("click", d.click), c) {
                    var h = g.find(".note-children-container");
                    c.forEach(function (a) {
                        a.render(h.length ? h : g)
                    })
                }
                return e && e(g, d), d && d.callback && d.callback(g), f && f.append(g), g
            }
        },
        s = {
            "create": function (b, c) {
                return function () {
                    var d = a.isArray(arguments[0]) ? arguments[0] : [],
                        e = "object" == typeof arguments[1] ? arguments[1] : arguments[0];
                    return e && e.children && (d = e.children), new r(b, d, e, c)
                }
            }
        },
        t = s.create('<div class="note-editor note-frame panel panel-default"/>'),
        u = s.create('<div class="note-toolbar panel-heading"/>'),
        v = s.create('<div class="note-editing-area"/>'),
        w = s.create('<textarea class="note-codable"/>'),
        x = s.create('<div class="note-editable panel-body" contentEditable="true"/>'),
        y = s.create(['<div class="note-statusbar">', '  <div class="note-resizebar">', '    <div class="note-icon-bar"/>', '    <div class="note-icon-bar"/>', '    <div class="note-icon-bar"/>', "  </div>", "</div>"].join("")),
        z = s.create('<div class="note-editor"/>'),
        A = s.create('<div class="note-editable" contentEditable="true"/>'),
        B = s.create('<div class="note-btn-group btn-group">'),
        C = s.create('<button type="button" class="note-btn btn btn-default btn-sm">', function (a, b) {
            b && b.tooltip && a.attr({
                "title": b.tooltip
            }).tooltip({
                "container": "body",
                "trigger": "hover",
                "placement": "bottom"
            })
        }),
        D = s.create('<div class="dropdown-menu">', function (b, c) {
            var d = a.isArray(c.items) ? c.items.map(function (a) {
                var b = "string" == typeof a ? a : a.value || "",
                    d = c.template ? c.template(a) : a;
                return '<li><a href="#" data-value="' + b + '">' + d + "</a></li>"
            }).join("") : c.items;
            b.html(d)
        }),
        E = s.create('<div class="dropdown-menu note-check">', function (b, c) {
            var d = a.isArray(c.items) ? c.items.map(function (a) {
                var b = "string" == typeof a ? a : a.value || "",
                    d = c.template ? c.template(a) : a;
                return '<li><a href="#" data-value="' + b + '">' + I(c.checkClassName) + " " + d + "</a></li>"
            }).join("") : c.items;
            b.html(d)
        }),
        F = s.create('<div class="note-color-palette"/>', function (a, b) {
            for (var c = [], d = 0, e = b.colors.length; e > d; d++) {
                for (var f = b.eventName, g = b.colors[d], h = [], i = 0, j = g.length; j > i; i++) {
                    var k = g[i];
                    h.push(['<button type="button" class="note-color-btn"', 'style="background-color:', k, '" ', 'data-event="', f, '" ', 'data-value="', k, '" ', 'title="', k, '" ', 'data-toggle="button" tabindex="-1"></button>'].join(""))
                }
                c.push('<div class="note-color-row">' + h.join("") + "</div>")
            }
            a.html(c.join("")), a.find(".note-color-btn").tooltip({
                "container": "body",
                "trigger": "hover",
                "placement": "bottom"
            })
        }),
        G = s.create('<div class="modal" aria-hidden="false" tabindex="-1"/>', function (a, b) {
            b.fade && a.addClass("fade"), a.html(['<div class="modal-dialog">', '  <div class="modal-content">', b.title ? '    <div class="modal-header">      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>      <h4 class="modal-title">' + b.title + "</h4>    </div>" : "", '    <div class="modal-body">' + b.body + "</div>", b.footer ? '    <div class="modal-footer">' + b.footer + "</div>" : "", "  </div>", "</div>"].join(""))
        }),
        H = s.create(['<div class="note-popover popover in">', '  <div class="arrow"/>', '  <div class="popover-content note-children-container"/>', "</div>"].join(""), function (a, b) {
            var c = "undefined" != typeof b.direction ? b.direction : "bottom";
            a.addClass(c), b.hideArrow && a.find(".arrow").hide()
        }),
        I = function (a, b) {
            return b = b || "i", "<" + b + ' class="' + a + '"/>'
        },
        J = {
            "editor": t,
            "toolbar": u,
            "editingArea": v,
            "codable": w,
            "editable": x,
            "statusbar": y,
            "airEditor": z,
            "airEditable": A,
            "buttonGroup": B,
            "button": C,
            "dropdown": D,
            "dropdownCheck": E,
            "palette": F,
            "dialog": G,
            "popover": H,
            "icon": I,
            "toggleBtn": function (a, b) {
                a.toggleClass("disabled", !b), a.attr("disabled", !b)
            },
            "toggleBtnActive": function (a, b) {
                a.toggleClass("active", b)
            },
            "onDialogShown": function (a, b) {
                a.one("shown.bs.modal", b)
            },
            "onDialogHidden": function (a, b) {
                a.one("hidden.bs.modal", b)
            },
            "showDialog": function (a) {
                a.modal("show")
            },
            "hideDialog": function (a) {
                a.modal("hide")
            },
            "createLayout": function (a, b) {
                var c = (b.airMode ? J.airEditor([J.editingArea([J.airEditable()])]) : J.editor([J.toolbar(), J.editingArea([J.codable(), J.editable()]), J.statusbar()])).render();
                return c.insertAfter(a), {
                    "note": a,
                    "editor": c,
                    "toolbar": c.find(".note-toolbar"),
                    "editingArea": c.find(".note-editing-area"),
                    "editable": c.find(".note-editable"),
                    "codable": c.find(".note-codable"),
                    "statusbar": c.find(".note-statusbar")
                }
            },
            "removeLayout": function (a, b) {
                a.html(b.editable.html()), b.editor.remove(), a.show()
            }
        };
    a.summernote = a.summernote || {
            "lang": {}
        }, a.extend(a.summernote.lang, {
        "en-US": {
            "font": {
                "bold": "Bold",
                "italic": "Italic",
                "underline": "Underline",
                "clear": "Remove Font Style",
                "height": "Line Height",
                "name": "Font Family",
                "strikethrough": "Strikethrough",
                "subscript": "Subscript",
                "superscript": "Superscript",
                "size": "Font Size"
            },
            "image": {
                "image": "Picture",
                "insert": "Insert Image",
                "resizeFull": "Resize Full",
                "resizeHalf": "Resize Half",
                "resizeQuarter": "Resize Quarter",
                "floatLeft": "Float Left",
                "floatRight": "Float Right",
                "floatNone": "Float None",
                "shapeRounded": "Shape: Rounded",
                "shapeCircle": "Shape: Circle",
                "shapeThumbnail": "Shape: Thumbnail",
                "shapeNone": "Shape: None",
                "dragImageHere": "Drag image or text here",
                "dropImage": "Drop image or Text",
                "selectFromFiles": "Select from files",
                "maximumFileSize": "Maximum file size",
                "maximumFileSizeError": "Maximum file size exceeded.",
                "url": "Image URL",
                "remove": "Remove Image"
            },
            "video": {
                "video": "Video",
                "videoLink": "Video Link",
                "insert": "Insert Video",
                "url": "Video URL?",
                "providers": "(YouTube, Vimeo, Vine, Instagram, DailyMotion or Youku)"
            },
            "link": {
                "link": "Link",
                "insert": "Insert Link",
                "unlink": "Unlink",
                "edit": "Edit",
                "textToDisplay": "Text to display",
                "url": "To what URL should this link go?",
                "openInNewWindow": "Open in new window"
            },
            "table": {
                "table": "Table"
            },
            "hr": {
                "insert": "Insert Horizontal Rule"
            },
            "style": {
                "style": "Style",
                "normal": "Normal",
                "blockquote": "Quote",
                "pre": "Code",
                "h1": "Header 1",
                "h2": "Header 2",
                "h3": "Header 3",
                "h4": "Header 4",
                "h5": "Header 5",
                "h6": "Header 6"
            },
            "lists": {
                "unordered": "Unordered list",
                "ordered": "Ordered list"
            },
            "options": {
                "help": "Help",
                "fullscreen": "Full Screen",
                "codeview": "Code View"
            },
            "paragraph": {
                "paragraph": "Paragraph",
                "outdent": "Outdent",
                "indent": "Indent",
                "left": "Align left",
                "center": "Align center",
                "right": "Align right",
                "justify": "Justify full"
            },
            "color": {
                "recent": "Recent Color",
                "more": "More Color",
                "background": "Background Color",
                "foreground": "Foreground Color",
                "transparent": "Transparent",
                "setTransparent": "Set transparent",
                "reset": "Reset",
                "resetToDefault": "Reset to default"
            },
            "shortcut": {
                "shortcuts": "Keyboard shortcuts",
                "close": "Close",
                "textFormatting": "Text formatting",
                "action": "Action",
                "paragraphFormatting": "Paragraph formatting",
                "documentStyle": "Document Style",
                "extraKeys": "Extra keys"
            },
            "help": {
                "insertParagraph": "Insert Paragraph",
                "undo": "Undoes the last command",
                "redo": "Redoes the last command",
                "tab": "Tab",
                "untab": "Untab",
                "bold": "Set a bold style",
                "italic": "Set a italic style",
                "underline": "Set a underline style",
                "strikethrough": "Set a strikethrough style",
                "removeFormat": "Clean a style",
                "justifyLeft": "Set left align",
                "justifyCenter": "Set center align",
                "justifyRight": "Set right align",
                "justifyFull": "Set full align",
                "insertUnorderedList": "Toggle unordered list",
                "insertOrderedList": "Toggle ordered list",
                "outdent": "Outdent on current paragraph",
                "indent": "Indent on current paragraph",
                "formatPara": "Change current block's format as a paragraph(P tag)",
                "formatH1": "Change current block's format as H1",
                "formatH2": "Change current block's format as H2",
                "formatH3": "Change current block's format as H3",
                "formatH4": "Change current block's format as H4",
                "formatH5": "Change current block's format as H5",
                "formatH6": "Change current block's format as H6",
                "insertHorizontalRule": "Insert horizontal rule",
                "linkDialog.show": "Show Link Dialog"
            },
            "history": {
                "undo": "Undo",
                "redo": "Redo"
            },
            "specialChar": {
                "specialChar": "SPECIAL CHARACTERS",
                "select": "Select Special characters"
            }
        }
    });
    var K, L = function () {
            var a = {
                "BACKSPACE": 8,
                "TAB": 9,
                "ENTER": 13,
                "SPACE": 32,
                "LEFT": 37,
                "UP": 38,
                "RIGHT": 39,
                "DOWN": 40,
                "NUM0": 48,
                "NUM1": 49,
                "NUM2": 50,
                "NUM3": 51,
                "NUM4": 52,
                "NUM5": 53,
                "NUM6": 54,
                "NUM7": 55,
                "NUM8": 56,
                "B": 66,
                "E": 69,
                "I": 73,
                "J": 74,
                "K": 75,
                "L": 76,
                "R": 82,
                "S": 83,
                "U": 85,
                "V": 86,
                "Y": 89,
                "Z": 90,
                "SLASH": 191,
                "LEFTBRACKET": 219,
                "BACKSLASH": 220,
                "RIGHTBRACKET": 221
            };
            return {
                "isEdit": function (b) {
                    return d.contains([a.BACKSPACE, a.TAB, a.ENTER, a.SPACE], b)
                },
                "isMove": function (b) {
                    return d.contains([a.LEFT, a.UP, a.RIGHT, a.DOWN], b)
                },
                "nameFromCode": c.invertObject(a),
                "code": a
            }
        }(),
        M = function () {
            var b = function (a, b) {
                    var c, e, f = a.parentElement(),
                        g = document.body.createTextRange(),
                        h = d.from(f.childNodes);
                    for (c = 0; c < h.length; c++)
                        if (!p.isText(h[c])) {
                            if (g.moveToElementText(h[c]), g.compareEndPoints("StartToStart", a) >= 0) break;
                            e = h[c]
                        }
                    if (0 !== c && p.isText(h[c - 1])) {
                        var i = document.body.createTextRange(),
                            j = null;
                        i.moveToElementText(e || f), i.collapse(!e), j = e ? e.nextSibling : f.firstChild;
                        var k = a.duplicate();
                        k.setEndPoint("StartToStart", i);
                        for (var l = k.text.replace(/[\r\n]/g, "").length; l > j.nodeValue.length && j.nextSibling;) l -= j.nodeValue.length, j = j.nextSibling;
                        j.nodeValue;
                        b && j.nextSibling && p.isText(j.nextSibling) && l === j.nodeValue.length && (l -= j.nodeValue.length, j = j.nextSibling), f = j, c = l
                    }
                    return {
                        "cont": f,
                        "offset": c
                    }
                },
                e = function (a) {
                    var b = function (a, e) {
                            var f, g;
                            if (p.isText(a)) {
                                var h = p.listPrev(a, c.not(p.isText)),
                                    i = d.last(h).previousSibling;
                                f = i || a.parentNode, e += d.sum(d.tail(h), p.nodeLength), g = !i
                            } else {
                                if (f = a.childNodes[e] || a, p.isText(f)) return b(f, 0);
                                e = 0, g = !1
                            }
                            return {
                                "node": f,
                                "collapseToStart": g,
                                "offset": e
                            }
                        },
                        e = document.body.createTextRange(),
                        f = b(a.node, a.offset);
                    return e.moveToElementText(f.node), e.collapse(f.collapseToStart), e.moveStart("character", f.offset), e
                },
                f = function (b, g, h, i) {
                    this.sc = b, this.so = g, this.ec = h, this.eo = i;
                    var j = function () {
                        if (m.isW3CRangeSupport) {
                            var a = document.createRange();
                            return a.setStart(b, g), a.setEnd(h, i), a
                        }
                        var c = e({
                            "node": b,
                            "offset": g
                        });
                        return c.setEndPoint("EndToEnd", e({
                            "node": h,
                            "offset": i
                        })), c
                    };
                    this.getPoints = function () {
                        return {
                            "sc": b,
                            "so": g,
                            "ec": h,
                            "eo": i
                        }
                    }, this.getStartPoint = function () {
                        return {
                            "node": b,
                            "offset": g
                        }
                    }, this.getEndPoint = function () {
                        return {
                            "node": h,
                            "offset": i
                        }
                    }, this.select = function () {
                        var a = j();
                        if (m.isW3CRangeSupport) {
                            var b = document.getSelection();
                            b.rangeCount > 0 && b.removeAllRanges(), b.addRange(a)
                        } else a.select();
                        return this
                    }, this.scrollIntoView = function (b) {
                        var c = a(b).height();
                        return b.scrollTop + c < this.sc.offsetTop && (b.scrollTop += Math.abs(b.scrollTop + c - this.sc.offsetTop)), this
                    }, this.normalize = function () {
                        var a = function (a, b) {
                                if (p.isVisiblePoint(a) && !p.isEdgePoint(a) || p.isVisiblePoint(a) && p.isRightEdgePoint(a) && !b || p.isVisiblePoint(a) && p.isLeftEdgePoint(a) && b || p.isVisiblePoint(a) && p.isBlock(a.node) && p.isEmpty(a.node)) return a;
                                var c = p.ancestor(a.node, p.isBlock);
                                if ((p.isLeftEdgePointOf(a, c) || p.isVoid(p.prevPoint(a).node)) && !b || (p.isRightEdgePointOf(a, c) || p.isVoid(p.nextPoint(a).node)) && b) {
                                    if (p.isVisiblePoint(a)) return a;
                                    b = !b
                                }
                                var d = b ? p.nextPointUntil(p.nextPoint(a), p.isVisiblePoint) : p.prevPointUntil(p.prevPoint(a), p.isVisiblePoint);
                                return d || a
                            },
                            b = a(this.getEndPoint(), !1),
                            c = this.isCollapsed() ? b : a(this.getStartPoint(), !0);
                        return new f(c.node, c.offset, b.node, b.offset)
                    }, this.nodes = function (a, b) {
                        a = a || c.ok;
                        var e = b && b.includeAncestor,
                            f = b && b.fullyContains,
                            g = this.getStartPoint(),
                            h = this.getEndPoint(),
                            i = [],
                            j = [];
                        return p.walkPoint(g, h, function (b) {
                            if (!p.isEditable(b.node)) {
                                var c;
                                f ? (p.isLeftEdgePoint(b) && j.push(b.node), p.isRightEdgePoint(b) && d.contains(j, b.node) && (c = b.node)) : c = e ? p.ancestor(b.node, a) : b.node, c && a(c) && i.push(c)
                            }
                        }, !0), d.unique(i)
                    }, this.commonAncestor = function () {
                        return p.commonAncestor(b, h)
                    }, this.expand = function (a) {
                        var c = p.ancestor(b, a),
                            d = p.ancestor(h, a);
                        if (!c && !d) return new f(b, g, h, i);
                        var e = this.getPoints();
                        return c && (e.sc = c, e.so = 0), d && (e.ec = d, e.eo = p.nodeLength(d)), new f(e.sc, e.so, e.ec, e.eo)
                    }, this.collapse = function (a) {
                        return a ? new f(b, g, b, g) : new f(h, i, h, i)
                    }, this.splitText = function () {
                        var a = b === h,
                            c = this.getPoints();
                        return p.isText(h) && !p.isEdgePoint(this.getEndPoint()) && h.splitText(i), p.isText(b) && !p.isEdgePoint(this.getStartPoint()) && (c.sc = b.splitText(g), c.so = 0, a && (c.ec = c.sc, c.eo = i - g)), new f(c.sc, c.so, c.ec, c.eo)
                    }, this.deleteContents = function () {
                        if (this.isCollapsed()) return this;
                        var b = this.splitText(),
                            c = b.nodes(null, {
                                "fullyContains": !0
                            }),
                            e = p.prevPointUntil(b.getStartPoint(), function (a) {
                                return !d.contains(c, a.node)
                            }),
                            g = [];
                        return a.each(c, function (a, b) {
                            var c = b.parentNode;
                            e.node !== c && 1 === p.nodeLength(c) && g.push(c), p.remove(b, !1)
                        }), a.each(g, function (a, b) {
                            p.remove(b, !1)
                        }), new f(e.node, e.offset, e.node, e.offset).normalize()
                    };
                    var k = function (a) {
                        return function () {
                            var c = p.ancestor(b, a);
                            return !!c && c === p.ancestor(h, a)
                        }
                    };
                    this.isOnEditable = k(p.isEditable), this.isOnList = k(p.isList), this.isOnAnchor = k(p.isAnchor), this.isOnCell = k(p.isCell), this.isLeftEdgeOf = function (a) {
                        if (!p.isLeftEdgePoint(this.getStartPoint())) return !1;
                        var b = p.ancestor(this.sc, a);
                        return b && p.isLeftEdgeOf(this.sc, b)
                    }, this.isCollapsed = function () {
                        return b === h && g === i
                    }, this.wrapBodyInlineWithPara = function () {
                        if (p.isBodyContainer(b) && p.isEmpty(b)) return b.innerHTML = p.emptyPara, new f(b.firstChild, 0, b.firstChild, 0);
                        var a = this.normalize();
                        if (p.isParaInline(b) || p.isPara(b)) return a;
                        var e;
                        if (p.isInline(a.sc)) {
                            var g = p.listAncestor(a.sc, c.not(p.isInline));
                            e = d.last(g), p.isInline(e) || (e = g[g.length - 2] || a.sc.childNodes[a.so])
                        } else e = a.sc.childNodes[a.so > 0 ? a.so - 1 : 0];
                        var h = p.listPrev(e, p.isParaInline).reverse();
                        if (h = h.concat(p.listNext(e.nextSibling, p.isParaInline)), h.length) {
                            var i = p.wrap(d.head(h), "p");
                            p.appendChildNodes(i, d.tail(h))
                        }
                        return this.normalize()
                    }, this.insertNode = function (a) {
                        var b = this.wrapBodyInlineWithPara().deleteContents(),
                            c = p.splitPoint(b.getStartPoint(), p.isInline(a));
                        return c.rightNode ? c.rightNode.parentNode.insertBefore(a, c.rightNode) : c.container.appendChild(a), a
                    }, this.pasteHTML = function (b) {
                        var c = a("<div></div>").html(b)[0],
                            e = d.from(c.childNodes),
                            f = this.wrapBodyInlineWithPara().deleteContents();
                        return e.reverse().map(function (a) {
                            return f.insertNode(a)
                        }).reverse()
                    }, this.toString = function () {
                        var a = j();
                        return m.isW3CRangeSupport ? a.toString() : a.text
                    }, this.getWordRange = function (a) {
                        var b = this.getEndPoint();
                        if (!p.isCharPoint(b)) return this;
                        var c = p.prevPointUntil(b, function (a) {
                            return !p.isCharPoint(a)
                        });
                        return a && (b = p.nextPointUntil(b, function (a) {
                            return !p.isCharPoint(a)
                        })), new f(c.node, c.offset, b.node, b.offset)
                    }, this.bookmark = function (a) {
                        return {
                            "s": {
                                "path": p.makeOffsetPath(a, b),
                                "offset": g
                            },
                            "e": {
                                "path": p.makeOffsetPath(a, h),
                                "offset": i
                            }
                        }
                    }, this.paraBookmark = function (a) {
                        return {
                            "s": {
                                "path": d.tail(p.makeOffsetPath(d.head(a), b)),
                                "offset": g
                            },
                            "e": {
                                "path": d.tail(p.makeOffsetPath(d.last(a), h)),
                                "offset": i
                            }
                        }
                    }, this.getClientRects = function () {
                        var a = j();
                        return a.getClientRects()
                    }
                };
            return {
                "create": function (a, b, c, d) {
                    if (4 === arguments.length) return new f(a, b, c, d);
                    if (2 === arguments.length) return c = a, d = b, new f(a, b, c, d);
                    var e = this.createFromSelection();
                    return e || 1 !== arguments.length ? e : (e = this.createFromNode(arguments[0]), e.collapse(p.emptyPara === arguments[0].innerHTML))
                },
                "createFromSelection": function () {
                    var a, c, d, e;
                    if (m.isW3CRangeSupport) {
                        var g = document.getSelection();
                        if (!g || 0 === g.rangeCount) return null;
                        if (p.isBody(g.anchorNode)) return null;
                        var h = g.getRangeAt(0);
                        a = h.startContainer, c = h.startOffset, d = h.endContainer, e = h.endOffset
                    } else {
                        var i = document.selection.createRange(),
                            j = i.duplicate();
                        j.collapse(!1);
                        var k = i;
                        k.collapse(!0);
                        var l = b(k, !0),
                            n = b(j, !1);
                        p.isText(l.node) && p.isLeftEdgePoint(l) && p.isTextNode(n.node) && p.isRightEdgePoint(n) && n.node.nextSibling === l.node && (l = n), a = l.cont, c = l.offset, d = n.cont, e = n.offset
                    }
                    return new f(a, c, d, e)
                },
                "createFromNode": function (a) {
                    var b = a,
                        c = 0,
                        d = a,
                        e = p.nodeLength(d);
                    return p.isVoid(b) && (c = p.listPrev(b).length - 1, b = b.parentNode), p.isBR(d) ? (e = p.listPrev(d).length - 1, d = d.parentNode) : p.isVoid(d) && (e = p.listPrev(d).length, d = d.parentNode), this.create(b, c, d, e)
                },
                "createFromNodeBefore": function (a) {
                    return this.createFromNode(a).collapse(!0)
                },
                "createFromNodeAfter": function (a) {
                    return this.createFromNode(a).collapse()
                },
                "createFromBookmark": function (a, b) {
                    var c = p.fromOffsetPath(a, b.s.path),
                        d = b.s.offset,
                        e = p.fromOffsetPath(a, b.e.path),
                        g = b.e.offset;
                    return new f(c, d, e, g)
                },
                "createFromParaBookmark": function (a, b) {
                    var c = a.s.offset,
                        e = a.e.offset,
                        g = p.fromOffsetPath(d.head(b), a.s.path),
                        h = p.fromOffsetPath(d.last(b), a.e.path);
                    return new f(g, c, h, e)
                }
            }
        }(),
        N = function () {
            var b = function (b) {
                    return a.Deferred(function (c) {
                        a.extend(new FileReader, {
                            "onload": function (a) {
                                var b = a.target.result;
                                c.resolve(b)
                            },
                            "onerror": function () {
                                c.reject(this)
                            }
                        }).readAsDataURL(b)
                    }).promise()
                },
                c = function (b) {
                    return a.Deferred(function (c) {
                        var d = a("<img>");
                        d.one("load", function () {
                            d.off("error abort"), c.resolve(d)
                        }).one("error abort", function () {
                            d.off("load").detach(), c.reject(d)
                        }).css({
                            "display": "none"
                        }).appendTo(document.body).attr("src", b)
                    }).promise()
                };
            return {
                "readFileAsDataURL": b,
                "createImage": c
            }
        }(),
        O = function (a) {
            var b = [],
                c = -1,
                d = a[0],
                e = function () {
                    var b = M.create(d),
                        c = {
                            "s": {
                                "path": [],
                                "offset": 0
                            },
                            "e": {
                                "path": [],
                                "offset": 0
                            }
                        };
                    return {
                        "contents": a.html(),
                        "bookmark": b ? b.bookmark(d) : c
                    }
                },
                f = function (b) {
                    null !== b.contents && a.html(b.contents), null !== b.bookmark && M.createFromBookmark(d, b.bookmark).select()
                };
            this.rewind = function () {
                a.html() !== b[c].contents && this.recordUndo(), c = 0, f(b[c])
            }, this.reset = function () {
                b = [], c = -1, a.html(""), this.recordUndo()
            }, this.undo = function () {
                a.html() !== b[c].contents && this.recordUndo(), c > 0 && (c--, f(b[c]))
            }, this.redo = function () {
                b.length - 1 > c && (c++, f(b[c]))
            }, this.recordUndo = function () {
                c++, b.length > c && (b = b.slice(0, c)), b.push(e())
            }
        },
        P = function () {
            var b = function (b, c) {
                if (m.jqueryVersion < 1.9) {
                    var d = {};
                    return a.each(c, function (a, c) {
                        d[c] = b.css(c)
                    }), d
                }
                return b.css.call(b, c)
            };
            this.fromNode = function (a) {
                var c = ["font-family", "font-size", "text-align", "list-style-type", "line-height"],
                    d = b(a, c) || {};
                return d["font-size"] = parseInt(d["font-size"], 10), d
            }, this.stylePara = function (b, c) {
                a.each(b.nodes(p.isPara, {
                    "includeAncestor": !0
                }), function (b, d) {
                    a(d).css(c)
                })
            }, this.styleNodes = function (b, e) {
                b = b.splitText();
                var f = e && e.nodeName || "SPAN",
                    g = !(!e || !e.expandClosestSibling),
                    h = !(!e || !e.onlyPartialContains);
                if (b.isCollapsed()) return [b.insertNode(p.create(f))];
                var i = p.makePredByNodeName(f),
                    j = b.nodes(p.isText, {
                        "fullyContains": !0
                    }).map(function (a) {
                        return p.singleChildAncestor(a, i) || p.wrap(a, f)
                    });
                if (g) {
                    if (h) {
                        var k = b.nodes();
                        i = c.and(i, function (a) {
                            return d.contains(k, a)
                        })
                    }
                    return j.map(function (b) {
                        var c = p.withClosestSiblings(b, i),
                            e = d.head(c),
                            f = d.tail(c);
                        return a.each(f, function (a, b) {
                            p.appendChildNodes(e, b.childNodes), p.remove(b)
                        }), d.head(c)
                    })
                }
                return j
            }, this.current = function (b) {
                var c = a(p.isElement(b.sc) ? b.sc : b.sc.parentNode),
                    d = this.fromNode(c);
                try {
                    d = a.extend(d, {
                        "font-bold": document.queryCommandState("bold") ? "bold" : "normal",
                        "font-italic": document.queryCommandState("italic") ? "italic" : "normal",
                        "font-underline": document.queryCommandState("underline") ? "underline" : "normal",
                        "font-subscript": document.queryCommandState("subscript") ? "subscript" : "normal",
                        "font-superscript": document.queryCommandState("superscript") ? "superscript" : "normal",
                        "font-strikethrough": document.queryCommandState("strikethrough") ? "strikethrough" : "normal"
                    })
                } catch (e) {
                }
                if (b.isOnList()) {
                    var f = ["circle", "disc", "disc-leading-zero", "square"],
                        g = a.inArray(d["list-style-type"], f) > -1;
                    d["list-style"] = g ? "unordered" : "ordered"
                } else d["list-style"] = "none";
                var h = p.ancestor(b.sc, p.isPara);
                if (h && h.style["line-height"]) d["line-height"] = h.style.lineHeight;
                else {
                    var i = parseInt(d["line-height"], 10) / parseInt(d["font-size"], 10);
                    d["line-height"] = i.toFixed(1)
                }
                return d.anchor = b.isOnAnchor() && p.ancestor(b.sc, p.isAnchor), d.ancestors = p.listAncestor(b.sc, p.isEditable), d.range = b, d
            }
        },
        Q = function () {
            var b = this;
            this.insertOrderedList = function (a) {
                this.toggleList("OL", a)
            }, this.insertUnorderedList = function (a) {
                this.toggleList("UL", a)
            }, this.indent = function (b) {
                var e = this,
                    f = M.create(b).wrapBodyInlineWithPara(),
                    g = f.nodes(p.isPara, {
                        "includeAncestor": !0
                    }),
                    h = d.clusterBy(g, c.peq2("parentNode"));
                a.each(h, function (b, c) {
                    var f = d.head(c);
                    p.isLi(f) ? e.wrapList(c, f.parentNode.nodeName) : a.each(c, function (b, c) {
                        a(c).css("marginLeft", function (a, b) {
                            return (parseInt(b, 10) || 0) + 25
                        })
                    })
                }), f.select()
            }, this.outdent = function (b) {
                var e = this,
                    f = M.create(b).wrapBodyInlineWithPara(),
                    g = f.nodes(p.isPara, {
                        "includeAncestor": !0
                    }),
                    h = d.clusterBy(g, c.peq2("parentNode"));
                a.each(h, function (b, c) {
                    var f = d.head(c);
                    p.isLi(f) ? e.releaseList([c]) : a.each(c, function (b, c) {
                        a(c).css("marginLeft", function (a, b) {
                            return b = parseInt(b, 10) || 0, b > 25 ? b - 25 : ""
                        })
                    })
                }), f.select()
            }, this.toggleList = function (e, f) {
                var g = M.create(f).wrapBodyInlineWithPara(),
                    h = g.nodes(p.isPara, {
                        "includeAncestor": !0
                    }),
                    i = g.paraBookmark(h),
                    j = d.clusterBy(h, c.peq2("parentNode"));
                if (d.find(h, p.isPurePara)) {
                    var k = [];
                    a.each(j, function (a, c) {
                        k = k.concat(b.wrapList(c, e))
                    }), h = k
                } else {
                    var l = g.nodes(p.isList, {
                        "includeAncestor": !0
                    }).filter(function (b) {
                        return !a.nodeName(b, e)
                    });
                    l.length ? a.each(l, function (a, b) {
                        p.replace(b, e)
                    }) : h = this.releaseList(j, !0)
                }
                M.createFromParaBookmark(i, h).select()
            }, this.wrapList = function (a, b) {
                var c = d.head(a),
                    e = d.last(a),
                    f = p.isList(c.previousSibling) && c.previousSibling,
                    g = p.isList(e.nextSibling) && e.nextSibling,
                    h = f || p.insertAfter(p.create(b || "UL"), e);
                return a = a.map(function (a) {
                    return p.isPurePara(a) ? p.replace(a, "LI") : a
                }), p.appendChildNodes(h, a), g && (p.appendChildNodes(h, d.from(g.childNodes)), p.remove(g)), a
            }, this.releaseList = function (b, c) {
                var e = [];
                return a.each(b, function (b, f) {
                    var g = d.head(f),
                        h = d.last(f),
                        i = c ? p.lastAncestor(g, p.isList) : g.parentNode,
                        j = i.childNodes.length > 1 ? p.splitTree(i, {
                            "node": h.parentNode,
                            "offset": p.position(h) + 1
                        }, {
                            "isSkipPaddingBlankHTML": !0
                        }) : null,
                        k = p.splitTree(i, {
                            "node": g.parentNode,
                            "offset": p.position(g)
                        }, {
                            "isSkipPaddingBlankHTML": !0
                        });
                    f = c ? p.listDescendant(k, p.isLi) : d.from(k.childNodes).filter(p.isLi), (c || !p.isList(i.parentNode)) && (f = f.map(function (a) {
                        return p.replace(a, "P")
                    })), a.each(d.from(f).reverse(), function (a, b) {
                        p.insertAfter(b, i)
                    });
                    var l = d.compact([i, k, j]);
                    a.each(l, function (b, c) {
                        var d = [c].concat(p.listDescendant(c, p.isList));
                        a.each(d.reverse(), function (a, b) {
                            p.nodeLength(b) || p.remove(b, !0)
                        })
                    }), e = e.concat(f)
                }), e
            }
        },
        R = function () {
            var b = new Q;
            this.insertTab = function (a, b) {
                var c = p.createText(new Array(b + 1).join(p.NBSP_CHAR));
                a = a.deleteContents(), a.insertNode(c, !0), a = M.create(c, b), a.select()
            }, this.insertParagraph = function (c) {
                var d = M.create(c);
                d = d.deleteContents(), d = d.wrapBodyInlineWithPara();
                var e, f = p.ancestor(d.sc, p.isPara);
                if (f) {
                    if (p.isEmpty(f) && p.isLi(f)) return void b.toggleList(f.parentNode.nodeName);
                    if (p.isEmpty(f) && p.isPara(f) && p.isBlockquote(f.parentNode)) p.insertAfter(f, f.parentNode), e = f;
                    else {
                        e = p.splitTree(f, d.getStartPoint());
                        var g = p.listDescendant(f, p.isEmptyAnchor);
                        g = g.concat(p.listDescendant(e, p.isEmptyAnchor)), a.each(g, function (a, b) {
                            p.remove(b)
                        }), (p.isHeading(e) || p.isPre(e)) && p.isEmpty(e) && (e = p.replace(e, "p"))
                    }
                } else {
                    var h = d.sc.childNodes[d.so];
                    e = a(p.emptyPara)[0], h ? d.sc.insertBefore(e, h) : d.sc.appendChild(e)
                }
                M.create(e, 0).normalize().select().scrollIntoView(c)
            }
        },
        S = function () {
            this.tab = function (a, b) {
                var c = p.ancestor(a.commonAncestor(), p.isCell),
                    e = p.ancestor(c, p.isTable),
                    f = p.listDescendant(e, p.isCell),
                    g = d[b ? "prev" : "next"](f, c);
                g && M.create(g, 0).select()
            }, this.createTable = function (b, c, d) {
                for (var e, f = [], g = 0; b > g; g++) f.push("<td>" + p.blank + "</td>");
                e = f.join("");
                for (var h, i = [], j = 0; c > j; j++) i.push("<tr>" + e + "</tr>");
                h = i.join("");
                var k = a("<table>" + h + "</table>");
                return d && d.tableClassName && k.addClass(d.tableClassName), k[0]
            }
        },
        T = "bogus",
        U = function (b) {
            var c = this,
                e = b.layoutInfo.note,
                f = b.layoutInfo.editor,
                g = b.layoutInfo.editable,
                h = b.options,
                i = h.langInfo,
                j = g[0],
                k = null,
                l = new P,
                n = new S,
                o = new R,
                q = new Q,
                r = new O(g);
            this.initialize = function () {
                g.on("keydown", function (a) {
                    a.keyCode === L.code.ENTER && b.triggerEvent("enter", a), b.triggerEvent("keydown", a), h.shortcuts && !a.isDefaultPrevented() && c.handleKeyMap(a)
                }).on("keyup", function (a) {
                    b.triggerEvent("keyup", a)
                }).on("focus", function (a) {
                    b.triggerEvent("focus", a)
                }).on("blur", function (a) {
                    b.triggerEvent("blur", a)
                }).on("mousedown", function (a) {
                    b.triggerEvent("mousedown", a)
                }).on("mouseup", function (a) {
                    b.triggerEvent("mouseup", a)
                }).on("scroll", function (a) {
                    b.triggerEvent("scroll", a)
                }).on("paste", function (a) {
                    b.triggerEvent("paste", a)
                }), g.html(p.html(e) || p.emptyPara);
                var a = m.isMSIE ? "DOMCharacterDataModified DOMSubtreeModified DOMNodeInserted" : "input";
                g.on(a, function () {
                    b.triggerEvent("change", g.html())
                }), f.on("focusin", function (a) {
                    b.triggerEvent("focusin", a)
                }).on("focusout", function (a) {
                    b.triggerEvent("focusout", a)
                }), !h.airMode && h.height && this.setHeight(h.height), !h.airMode && h.maxHeight && g.css("max-height", h.maxHeight), !h.airMode && h.minHeight && g.css("min-height", h.minHeight), r.recordUndo()
            }, this.destroy = function () {
                g.off()
            }, this.handleKeyMap = function (a) {
                var c = h.keyMap[m.isMac ? "mac" : "pc"],
                    d = [];
                a.metaKey && d.push("CMD"), a.ctrlKey && !a.altKey && d.push("CTRL"), a.shiftKey && d.push("SHIFT");
                var e = L.nameFromCode[a.keyCode];
                e && d.push(e);
                var f = c[d.join("+")];
                f ? (a.preventDefault(), b.invoke(f)) : L.isEdit(a.keyCode) && this.afterCommand()
            }, this.createRange = function () {
                return this.focus(), M.create(j)
            }, this.saveRange = function (a) {
                k = this.createRange(), a && k.collapse().select()
            }, this.restoreRange = function () {
                k && (k.select(), this.focus())
            }, this.saveTarget = function (a) {
                g.data("target", a)
            }, this.clearTarget = function () {
                g.removeData("target")
            }, this.restoreTarget = function () {
                return g.data("target")
            }, this.currentStyle = function () {
                var a = M.create();
                return a && (a = a.normalize()), a ? l.current(a) : l.fromNode(g)
            }, this.styleFromNode = function (a) {
                return l.fromNode(a)
            }, this.undo = function () {
                b.triggerEvent("before.command", g.html()), r.undo(), b.triggerEvent("change", g.html())
            }, b.memo("help.undo", i.help.undo), this.redo = function () {
                b.triggerEvent("before.command", g.html()), r.redo(), b.triggerEvent("change", g.html())
            }, b.memo("help.redo", i.help.redo);
            for (var s = this.beforeCommand = function () {
                    b.triggerEvent("before.command", g.html()), c.focus()
                }, t = this.afterCommand = function (a) {
                    r.recordUndo(), a || b.triggerEvent("change", g.html())
                },
                     u = ["bold", "italic", "underline", "strikethrough", "superscript", "subscript", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull", "formatBlock", "removeFormat", "backColor", "foreColor", "fontName"],
                     v = 0, w = u.length; w > v; v++) this[u[v]] = function (a) {
                return function (b) {
                    s(), document.execCommand(a, !1, b), t(!0)
                }
            }(u[v]), b.memo("help." + u[v], i.help[u[v]]);
            this.tab = function () {
                var a = this.createRange();
                a.isCollapsed() && a.isOnCell() ? n.tab(a) : (s(), o.insertTab(a, h.tabSize), t())
            }, b.memo("help.tab", i.help.tab), this.untab = function () {
                var a = this.createRange();
                a.isCollapsed() && a.isOnCell() && n.tab(a, !0)
            }, b.memo("help.untab", i.help.untab), this.wrapCommand = function (a) {
                return function () {
                    s(), a.apply(c, arguments), t()
                }
            }, this.insertParagraph = this.wrapCommand(function () {
                o.insertParagraph(j)
            }), b.memo("help.insertParagraph", i.help.insertParagraph), this.insertOrderedList = this.wrapCommand(function () {
                q.insertOrderedList(j)
            }), b.memo("help.insertOrderedList", i.help.insertOrderedList), this.insertUnorderedList = this.wrapCommand(function () {
                q.insertUnorderedList(j)
            }), b.memo("help.insertUnorderedList", i.help.insertUnorderedList), this.indent = this.wrapCommand(function () {
                q.indent(j)
            }), b.memo("help.indent", i.help.indent), this.outdent = this.wrapCommand(function () {
                q.outdent(j)
            }), b.memo("help.outdent", i.help.outdent), this.insertImage = function (a, c) {
                return N.createImage(a, c).then(function (a) {
                    s(), "function" == typeof c ? c(a) : ("string" == typeof c && a.attr("data-filename", c), a.css("width", Math.min(g.width(), a.width()))), a.show(), M.create(j).insertNode(a[0]), M.createFromNodeAfter(a[0]).select(), t()
                }).fail(function (a) {
                    b.triggerEvent("image.upload.error", a)
                })
            }, this.insertImages = function (d) {
                a.each(d, function (a, d) {
                    var e = d.name;
                    h.maximumImageFileSize && h.maximumImageFileSize < d.size ? b.triggerEvent("image.upload.error", i.image.maximumFileSizeError) : N.readFileAsDataURL(d).then(function (a) {
                        return c.insertImage(a, e)
                    }).fail(function () {
                        b.triggerEvent("image.upload.error")
                    })
                })
            }, this.insertImagesOrCallback = function (a) {
                var c = h.callbacks;
                c.onImageUpload ? b.triggerEvent("image.upload", a) : this.insertImages(a)
            }, this.insertNode = this.wrapCommand(function (a) {
                var b = this.createRange();
                b.insertNode(a), M.createFromNodeAfter(a).select()
            }), this.insertText = this.wrapCommand(function (a) {
                var b = this.createRange(),
                    c = b.insertNode(p.createText(a));
                M.create(c, p.nodeLength(c)).select()
            }), this.getSelectedText = function () {
                var a = this.createRange();
                return a.isOnAnchor() && (a = M.createFromNode(p.ancestor(a.sc, p.isAnchor))), a.toString()
            }, this.pasteHTML = this.wrapCommand(function (a) {
                var b = this.createRange().pasteHTML(a);
                M.createFromNodeAfter(d.last(b)).select()
            }), this.formatBlock = this.wrapCommand(function (a) {
                a = m.isMSIE ? "<" + a + ">" : a, document.execCommand("FormatBlock", !1, a)
            }), this.formatPara = function () {
                this.formatBlock("P")
            }, b.memo("help.formatPara", i.help.formatPara);
            for (var v = 1; 6 >= v; v++) this["formatH" + v] = function (a) {
                return function () {
                    this.formatBlock("H" + a)
                }
            }(v), b.memo("help.formatH" + v, i.help["formatH" + v]);
            this.fontSize = function (b) {
                var c = this.createRange();
                if (c && c.isCollapsed()) {
                    var e = l.styleNodes(c),
                        f = d.head(e);
                    a(e).css({
                        "font-size": b + "px"
                    }), f && !p.nodeLength(f) && (f.innerHTML = p.ZERO_WIDTH_NBSP_CHAR, M.createFromNodeAfter(f.firstChild).select(), g.data(T, f))
                } else s(), a(l.styleNodes(c)).css({
                    "font-size": b + "px"
                }), t()
            }, this.insertHorizontalRule = this.wrapCommand(function () {
                var a = this.createRange().insertNode(p.create("HR"));
                a.nextSibling && M.create(a.nextSibling, 0).normalize().select()
            }), b.memo("help.insertHorizontalRule", i.help.insertHorizontalRule), this.removeBogus = function () {
                var a = g.data(T);
                if (a) {
                    var b = d.find(d.from(a.childNodes), p.isText),
                        c = b.nodeValue.indexOf(p.ZERO_WIDTH_NBSP_CHAR);
                    -1 !== c && b.deleteData(c, 1), p.isEmpty(a) && p.remove(a), g.removeData(T)
                }
            }, this.lineHeight = this.wrapCommand(function (a) {
                l.stylePara(this.createRange(), {
                    "lineHeight": a
                })
            }), this.unlink = function () {
                var a = this.createRange();
                if (a.isOnAnchor()) {
                    var b = p.ancestor(a.sc, p.isAnchor);
                    a = M.createFromNode(b), a.select(), s(), document.execCommand("unlink"), t()
                }
            }, this.createLink = this.wrapCommand(function (b) {
                var c = b.url,
                    e = b.text,
                    f = b.isNewWindow,
                    g = b.range || this.createRange(),
                    i = g.toString() !== e;
                h.onCreateLink && (c = h.onCreateLink(c));
                var j = [];
                if (i) {
                    g = g.deleteContents();
                    var k = g.insertNode(a("<A>" + e + "</A>")[0]);
                    j.push(k)
                } else j = l.styleNodes(g, {
                    "nodeName": "A",
                    "expandClosestSibling": !0,
                    "onlyPartialContains": !0
                });
                a.each(j, function (b, d) {
                    a(d).attr("href", c), f ? a(d).attr("target", "_blank") : a(d).removeAttr("target")
                });
                var m = M.createFromNodeBefore(d.head(j)),
                    n = m.getStartPoint(),
                    o = M.createFromNodeAfter(d.last(j)),
                    p = o.getEndPoint();
                M.create(n.node, n.offset, p.node, p.offset).select()
            }), this.getLinkInfo = function () {
                var b = this.createRange().expand(p.isAnchor),
                    c = a(d.head(b.nodes(p.isAnchor)));
                return {
                    "range": b,
                    "text": b.toString(),
                    "isNewWindow": c.length ? "_blank" === c.attr("target") : !1,
                    "url": c.length ? c.attr("href") : ""
                }
            }, this.color = this.wrapCommand(function (a) {
                var b = a.foreColor,
                    c = a.backColor;
                b && document.execCommand("foreColor", !1, b), c && document.execCommand("backColor", !1, c)
            }), this.insertTable = this.wrapCommand(function (a) {
                var b = a.split("x"),
                    c = this.createRange().deleteContents();
                c.insertNode(n.createTable(b[0], b[1], h))
            }), this.floatMe = this.wrapCommand(function (b) {
                var c = a(this.restoreTarget());
                c.css("float", b)
            }), this.resize = this.wrapCommand(function (b) {
                var c = a(this.restoreTarget());
                c.css({
                    "width": 100 * b + "%",
                    "height": ""
                })
            }), this.resizeTo = function (a, b, c) {
                var d;
                if (c) {
                    var e = a.y / a.x,
                        f = b.data("ratio");
                    d = {
                        "width": f > e ? a.x : a.y / f,
                        "height": f > e ? a.x * f : a.y
                    }
                } else d = {
                    "width": a.x,
                    "height": a.y
                };
                b.css(d)
            }, this.removeMedia = this.wrapCommand(function () {
                var c = a(this.restoreTarget()).detach();
                b.triggerEvent("media.delete", c, g)
            }), this.hasFocus = function () {
                return g.is(":focus")
            }, this.focus = function () {
                this.hasFocus() || g.focus()
            }, this.isEmpty = function () {
                return p.isEmpty(g[0]) || p.emptyPara === g.html()
            }, this.empty = function () {
                b.invoke("code", p.emptyPara)
            }, this.setHeight = function (a) {
                g.outerHeight(a)
            }
        },
        V = function (b) {
            var c = this,
                e = b.layoutInfo.editable;
            this.events = {
                "summernote.keydown": function (a, d) {
                    c.needKeydownHook() && (d.ctrlKey || d.metaKey) && d.keyCode === L.code.V && (b.invoke("editor.saveRange"), c.$paste.focus(), setTimeout(function () {
                        c.pasteByHook()
                    }, 0))
                }
            }, this.needKeydownHook = function () {
                return m.isMSIE && m.browserVersion > 10 || m.isFF
            }, this.initialize = function () {
                this.needKeydownHook() ? (this.$paste = a("<div />").attr("contenteditable", !0).css({
                    "position": "absolute",
                    "left": -1e5,
                    "opacity": 0
                }), e.before(this.$paste), this.$paste.on("paste", function (a) {
                    b.triggerEvent("paste", a)
                })) : e.on("paste", this.pasteByEvent)
            }, this.destroy = function () {
                this.needKeydownHook() && (this.$paste.remove(), this.$paste = null)
            }, this.pasteByHook = function () {
                var c = this.$paste[0].firstChild;
                if (p.isImg(c)) {
                    for (var d = c.src, e = atob(d.split(",")[1]), f = new Uint8Array(e.length), g = 0; g < e.length; g++) f[g] = e.charCodeAt(g);
                    var h = new Blob([f], {
                        "type": "image/png"
                    });
                    h.name = "clipboard.png", b.invoke("editor.restoreRange"), b.invoke("editor.focus"), b.invoke("editor.insertImagesOrCallback", [h])
                } else {
                    var i = a("<div />").html(this.$paste.html()).html();
                    b.invoke("editor.restoreRange"), b.invoke("editor.focus"), i && b.invoke("editor.pasteHTML", i)
                }
                this.$paste.empty()
            }, this.pasteByEvent = function (a) {
                var c = a.originalEvent.clipboardData;
                if (c && c.items && c.items.length) {
                    var e = d.head(c.items);
                    "file" === e.kind && -1 !== e.type.indexOf("image/") && b.invoke("editor.insertImagesOrCallback", [e.getAsFile()]), b.invoke("editor.afterCommand")
                }
            }
        },
        W = function (b) {
            var c = a(document),
                d = b.layoutInfo.editor,
                e = b.layoutInfo.editable,
                f = b.options,
                g = f.langInfo,
                h = a(['<div class="note-dropzone">', '  <div class="note-dropzone-message"/>', "</div>"].join("")).prependTo(d);
            this.initialize = function () {
                f.disableDragAndDrop ? c.on("drop", function (a) {
                    a.preventDefault()
                }) : this.attachDragAndDropEvent()
            }, this.attachDragAndDropEvent = function () {
                var f = a(),
                    i = h.find(".note-dropzone-message");
                c.on("dragenter", function (a) {
                    var c = b.invoke("codeview.isActivated"),
                        e = d.width() > 0 && d.height() > 0;
                    c || f.length || !e || (d.addClass("dragover"), h.width(d.width()), h.height(d.height()), i.text(g.image.dragImageHere)), f = f.add(a.target)
                }).on("dragleave", function (a) {
                    f = f.not(a.target), f.length || d.removeClass("dragover")
                }).on("drop", function () {
                    f = a(), d.removeClass("dragover")
                }), h.on("dragenter", function () {
                    h.addClass("hover"), i.text(g.image.dropImage)
                }).on("dragleave", function () {
                    h.removeClass("hover"), i.text(g.image.dragImageHere)
                }), h.on("drop", function (c) {
                    var d = c.originalEvent.dataTransfer;
                    d && d.files && d.files.length ? (c.preventDefault(), e.focus(), b.invoke("editor.insertImagesOrCallback", d.files)) : a.each(d.types, function (c, e) {
                        var f = d.getData(e);
                        e.toLowerCase().indexOf("text") > -1 ? b.invoke("editor.pasteHTML", f) : a(f).each(function () {
                            b.invoke("editor.insertNode", this)
                        })
                    })
                }).on("dragover", !1)
            }
        };
    m.hasCodeMirror && (m.isSupportAmd ? require(["codemirror"], function (a) {
        K = a
    }) : K = window.CodeMirror);
    var X = function (a) {
            var b = a.layoutInfo.editor,
                c = a.layoutInfo.editable,
                d = a.layoutInfo.codable,
                e = a.options;
            this.sync = function () {
                var a = this.isActivated();
                a && m.hasCodeMirror && d.data("cmEditor").save()
            }, this.isActivated = function () {
                return b.hasClass("codeview")
            }, this.toggle = function () {
                this.isActivated() ? this.deactivate() : this.activate(), a.triggerEvent("codeview.toggled")
            }, this.activate = function () {
                if (d.val(p.html(c, e.prettifyHtml)), d.height(c.height()), a.invoke("toolbar.updateCodeview", !0), b.addClass("codeview"), d.focus(), m.hasCodeMirror) {
                    var f = K.fromTextArea(d[0], e.codemirror);
                    if (e.codemirror.tern) {
                        var g = new K.TernServer(e.codemirror.tern);
                        f.ternServer = g, f.on("cursorActivity", function (a) {
                            g.updateArgHints(a)
                        })
                    }
                    f.setSize(null, c.outerHeight()), d.data("cmEditor", f)
                }
            }, this.deactivate = function () {
                if (m.hasCodeMirror) {
                    var f = d.data("cmEditor");
                    d.val(f.getValue()), f.toTextArea()
                }
                var g = p.value(d, e.prettifyHtml) || p.emptyPara,
                    h = c.html() !== g;
                c.html(g), c.height(e.height ? d.height() : "auto"), b.removeClass("codeview"), h && a.triggerEvent("change", c.html(), c), c.focus(), a.invoke("toolbar.updateCodeview", !1)
            }, this.destroy = function () {
                this.isActivated() && this.deactivate()
            }
        },
        Y = 24,
        Z = function (b) {
            var c = a(document),
                d = b.layoutInfo.statusbar,
                e = b.layoutInfo.editable,
                f = b.options;
            this.initialize = function () {
                f.airMode || f.disableResizeEditor || d.on("mousedown", function (a) {
                    a.preventDefault(), a.stopPropagation();
                    var b = e.offset().top - c.scrollTop();
                    c.on("mousemove", function (a) {
                        var c = a.clientY - (b + Y);
                        c = f.minheight > 0 ? Math.max(c, f.minheight) : c, c = f.maxHeight > 0 ? Math.min(c, f.maxHeight) : c, e.height(c)
                    }).one("mouseup", function () {
                        c.off("mousemove")
                    })
                })
            }, this.destroy = function () {
                d.off()
            }
        },
        $ = function (b) {
            var c = b.layoutInfo.editor,
                d = b.layoutInfo.toolbar,
                e = b.layoutInfo.editable,
                f = b.layoutInfo.codable,
                g = a(window),
                h = a("html, body");
            this.toggle = function () {
                var a = function (a) {
                    e.css("height", a.h), f.css("height", a.h), f.data("cmeditor") && f.data("cmeditor").setsize(null, a.h)
                };
                c.toggleClass("fullscreen"), this.isFullscreen() ? (e.data("orgHeight", e.css("height")), g.on("resize", function () {
                    a({
                        "h": g.height() - d.outerHeight()
                    })
                }).trigger("resize"), h.css("overflow", "hidden")) : (g.off("resize"), a({
                    "h": e.data("orgHeight")
                }), h.css("overflow", "visible")), b.invoke("toolbar.updateFullscreen", this.isFullscreen())
            }, this.isFullscreen = function () {
                return c.hasClass("fullscreen")
            }
        },
        _ = function (b) {
            var c = this,
                d = a(document),
                e = b.layoutInfo.editingArea,
                f = b.options;
            this.events = {
                "summernote.mousedown": function (a, b) {
                    c.update(b.target) && b.preventDefault()
                },
                "summernote.keyup summernote.scroll summernote.change summernote.dialog.shown": function () {
                    c.update()
                }
            }, this.initialize = function () {
                this.$handle = a(['<div class="note-handle">', '<div class="note-control-selection">', '<div class="note-control-selection-bg"></div>', '<div class="note-control-holder note-control-nw"></div>', '<div class="note-control-holder note-control-ne"></div>', '<div class="note-control-holder note-control-sw"></div>', '<div class="', f.disableResizeImage ? "note-control-holder" : "note-control-sizing", ' note-control-se"></div>', f.disableResizeImage ? "" : '<div class="note-control-selection-info"></div>', "</div>", "</div>"].join("")).prependTo(e), this.$handle.on("mousedown", function (a) {
                    if (p.isControlSizing(a.target)) {
                        a.preventDefault(), a.stopPropagation();
                        var e = c.$handle.find(".note-control-selection").data("target"),
                            f = e.offset(),
                            g = d.scrollTop();
                        d.on("mousemove", function (a) {
                            b.invoke("editor.resizeTo", {
                                "x": a.clientX - f.left,
                                "y": a.clientY - (f.top - g)
                            }, e, !a.shiftKey), c.update(e[0])
                        }).one("mouseup", function (a) {
                            a.preventDefault(), d.off("mousemove"), b.invoke("editor.afterCommand")
                        }), e.data("ratio") || e.data("ratio", e.height() / e.width())
                    }
                })
            }, this.destroy = function () {
                this.$handle.remove()
            }, this.update = function (c) {
                var d = p.isImg(c),
                    e = this.$handle.find(".note-control-selection");
                if (b.invoke("imagePopover.update", c), d) {
                    var f = a(c),
                        g = f.position(),
                        h = {
                            "w": f.outerWidth(!0),
                            "h": f.outerHeight(!0)
                        };
                    e.css({
                        "display": "block",
                        "left": g.left,
                        "top": g.top,
                        "width": h.w,
                        "height": h.h
                    }).data("target", f);
                    var i = h.w + "x" + h.h;
                    e.find(".note-control-selection-info").text(i), b.invoke("editor.saveTarget", c)
                } else this.hide();
                return d
            }, this.hide = function () {
                b.invoke("editor.clearTarget"), this.$handle.children().hide()
            }
        },
        aa = function (b) {
            var c = this,
                e = "http://",
                f = /^(https?:\/\/|ssh:\/\/|ftp:\/\/|file:\/|mailto:[A-Z0-9._%+-]+@)?(www\.)?(.+)$/i;
            this.events = {
                "summernote.keyup": function (a, b) {
                    b.isDefaultPrevented() || c.handleKeyup(b)
                },
                "summernote.keydown": function (a, b) {
                    c.handleKeydown(b)
                }
            }, this.initialize = function () {
                this.lastWordRange = null
            }, this.destroy = function () {
                this.lastWordRange = null
            }, this.replace = function () {
                if (this.lastWordRange) {
                    var c = this.lastWordRange.toString(),
                        d = c.match(f);
                    if (d && (d[1] || d[2])) {
                        var g = d[1] ? c : e + c,
                            h = a("<a />").html(c).attr("href", g)[0];
                        this.lastWordRange.insertNode(h), this.lastWordRange = null, b.invoke("editor.focus")
                    }
                }
            }, this.handleKeydown = function (a) {
                if (d.contains([L.code.ENTER, L.code.SPACE], a.keyCode)) {
                    var c = b.invoke("editor.createRange").getWordRange();
                    this.lastWordRange = c
                }
            }, this.handleKeyup = function (a) {
                d.contains([L.code.ENTER, L.code.SPACE], a.keyCode) && this.replace()
            }
        },
        ba = function (a) {
            var b = a.layoutInfo.note;
            this.events = {
                "summernote.change": function () {
                    b.val(a.invoke("code"))
                }
            }, this.shouldInitialize = function () {
                return p.isTextarea(b[0])
            }
        },
        ca = function (b) {
            var c = this,
                d = b.layoutInfo.editingArea,
                e = b.options;
            this.events = {
                "summernote.init summernote.change": function () {
                    c.update()
                },
                "summernote.codeview.toggled": function () {
                    c.update()
                }
            }, this.shouldInitialize = function () {
                return !!e.placeholder
            }, this.initialize = function () {
                this.$placeholder = a('<div class="note-placeholder">'), this.$placeholder.on("click", function () {
                    b.invoke("focus")
                }).text(e.placeholder).prependTo(d)
            }, this.destroy = function () {
                this.$placeholder.remove()
            }, this.update = function () {
                var a = !b.invoke("codeview.isActivated") && b.invoke("editor.isEmpty");
                this.$placeholder.toggle(a)
            }
        },
        da = function (b) {
            var e = this,
                f = a.summernote.ui,
                g = b.layoutInfo.toolbar,
                h = b.options,
                i = h.langInfo,
                j = c.invertObject(h.keyMap[m.isMac ? "mac" : "pc"]),
                k = this.representShortcut = function (a) {
                    var b = j[a];
                    return m.isMac && (b = b.replace("CMD", "\u2318").replace("SHIFT", "\u21e7")), b = b.replace("BACKSLASH", "\\").replace("SLASH", "/").replace("LEFTBRACKET", "[").replace("RIGHTBRACKET", "]"), " (" + b + ")"
                };
            this.initialize = function () {
                this.addToolbarButtons(), this.addImagePopoverButtons(), this.addLinkPopoverButtons(), this.fontInstalledMap = {}
            }, this.destroy = function () {
                delete this.fontInstalledMap
            }, this.isFontInstalled = function (a) {
                return e.fontInstalledMap.hasOwnProperty(a) || (e.fontInstalledMap[a] = m.isFontInstalled(a) || d.contains(h.fontNamesIgnoreCheck, a)), e.fontInstalledMap[a]
            }, this.addToolbarButtons = function () {
                b.memo("button.style", function () {
                    return f.buttonGroup([f.button({
                        "className": "dropdown-toggle",
                        "contents": f.icon(h.icons.magic) + " " + f.icon(h.icons.caret, "span"),
                        "tooltip": i.style.style,
                        "data": {
                            "toggle": "dropdown"
                        }
                    }), f.dropdown({
                        "className": "dropdown-style",
                        "items": b.options.styleTags,
                        "template": function (a) {
                            "string" == typeof a && (a = {
                                "tag": a,
                                "title": a
                            });
                            var b = a.tag,
                                c = a.title,
                                d = a.style ? ' style="' + a.style + '" ' : "",
                                e = a.className ? ' className="' + a.className + '"' : "";
                            return "<" + b + d + e + ">" + c + "</" + b + ">"
                        },
                        "click": b.createInvokeHandler("editor.formatBlock")
                    })]).render()
                }), b.memo("button.bold", function () {
                    return f.button({
                        "className": "note-btn-bold",
                        "contents": f.icon(h.icons.bold),
                        "tooltip": i.font.bold + k("bold"),
                        "click": b.createInvokeHandler("editor.bold")
                    }).render()
                }), b.memo("button.italic", function () {
                    return f.button({
                        "className": "note-btn-italic",
                        "contents": f.icon(h.icons.italic),
                        "tooltip": i.font.italic + k("italic"),
                        "click": b.createInvokeHandler("editor.italic")
                    }).render()
                }), b.memo("button.underline", function () {
                    return f.button({
                        "className": "note-btn-underline",
                        "contents": f.icon(h.icons.underline),
                        "tooltip": i.font.underline + k("underline"),
                        "click": b.createInvokeHandler("editor.underline")
                    }).render()
                }), b.memo("button.clear", function () {
                    return f.button({
                        "contents": f.icon(h.icons.eraser),
                        "tooltip": i.font.clear + k("removeFormat"),
                        "click": b.createInvokeHandler("editor.removeFormat")
                    }).render()
                }), b.memo("button.strikethrough", function () {
                    return f.button({
                        "className": "note-btn-strikethrough",
                        "contents": f.icon(h.icons.strikethrough),
                        "tooltip": i.font.strikethrough + k("strikethrough"),
                        "click": b.createInvokeHandler("editor.strikethrough")
                    }).render()
                }), b.memo("button.superscript", function () {
                    return f.button({
                        "className": "note-btn-superscript",
                        "contents": f.icon(h.icons.superscript),
                        "tooltip": i.font.superscript,
                        "click": b.createInvokeHandler("editor.superscript")
                    }).render()
                }), b.memo("button.subscript", function () {
                    return f.button({
                        "className": "note-btn-subscript",
                        "contents": f.icon(h.icons.subscript),
                        "tooltip": i.font.subscript,
                        "click": b.createInvokeHandler("editor.subscript")
                    }).render()
                }), b.memo("button.fontname", function () {
                    return f.buttonGroup([f.button({
                        "className": "dropdown-toggle",
                        "contents": '<span class="note-current-fontname"/> ' + f.icon(h.icons.caret, "span"),
                        "tooltip": i.font.name,
                        "data": {
                            "toggle": "dropdown"
                        }
                    }), f.dropdownCheck({
                        "className": "dropdown-fontname",
                        "checkClassName": h.icons.menuCheck,
                        "items": h.fontNames.filter(e.isFontInstalled),
                        "template": function (a) {
                            return '<span style="font-family:' + a + '">' + a + "</span>"
                        },
                        "click": b.createInvokeHandler("editor.fontName")
                    })]).render()
                }), b.memo("button.fontsize", function () {
                    return f.buttonGroup([f.button({
                        "className": "dropdown-toggle",
                        "contents": '<span class="note-current-fontsize"/>' + f.icon(h.icons.caret, "span"),
                        "tooltip": i.font.size,
                        "data": {
                            "toggle": "dropdown"
                        }
                    }), f.dropdownCheck({
                        "className": "dropdown-fontsize",
                        "checkClassName": h.icons.menuCheck,
                        "items": h.fontSizes,
                        "click": b.createInvokeHandler("editor.fontSize")
                    })]).render()
                }), b.memo("button.color", function () {
                    return f.buttonGroup({
                        "className": "note-color",
                        "children": [f.button({
                            "className": "note-current-color-button",
                            "contents": f.icon(h.icons.font + " note-recent-color"),
                            "tooltip": i.color.recent,
                            "click": function (c) {
                                var d = a(c.currentTarget);
                                b.invoke("editor.color", {
                                    "backColor": d.attr("data-backColor"),
                                    "foreColor": d.attr("data-foreColor")
                                })
                            },
                            "callback": function (a) {
                                var b = a.find(".note-recent-color");
                                b.css("background-color", "#FFFF00"), a.attr("data-backColor", "#FFFF00")
                            }
                        }), f.button({
                            "className": "dropdown-toggle",
                            "contents": f.icon(h.icons.caret, "span"),
                            "tooltip": i.color.more,
                            "data": {
                                "toggle": "dropdown"
                            }
                        }), f.dropdown({
                            "items": ["<li>", '<div class="btn-group">', '  <div class="note-palette-title">' + i.color.background + "</div>", "  <div>", '    <button type="button" class="note-color-reset btn btn-default" data-event="backColor" data-value="inherit">', i.color.transparent, "    </button>", "  </div>", '  <div class="note-holder" data-event="backColor"/>', "</div>", '<div class="btn-group">', '  <div class="note-palette-title">' + i.color.foreground + "</div>", "  <div>", '    <button type="button" class="note-color-reset btn btn-default" data-event="removeFormat" data-value="foreColor">', i.color.resetToDefault, "    </button>", "  </div>", '  <div class="note-holder" data-event="foreColor"/>', "</div>", "</li>"].join(""),
                            "callback": function (b) {
                                b.find(".note-holder").each(function () {
                                    var b = a(this);
                                    b.append(f.palette({
                                        "colors": h.colors,
                                        "eventName": b.data("event")
                                    }).render())
                                })
                            },
                            "click": function (c) {
                                var d = a(c.target),
                                    e = d.data("event"),
                                    f = d.data("value");
                                if (e && f) {
                                    var g = "backColor" === e ? "background-color" : "color",
                                        h = d.closest(".note-color").find(".note-recent-color"),
                                        i = d.closest(".note-color").find(".note-current-color-button");
                                    h.css(g, f), i.attr("data-" + e, f), b.invoke("editor." + e, f)
                                }
                            }
                        })]
                    }).render()
                }), b.memo("button.ul", function () {
                    return f.button({
                        "contents": f.icon(h.icons.unorderedlist),
                        "tooltip": i.lists.unordered + k("insertUnorderedList"),
                        "click": b.createInvokeHandler("editor.insertUnorderedList")
                    }).render()
                }), b.memo("button.ol", function () {
                    return f.button({
                        "contents": f.icon(h.icons.orderedlist),
                        "tooltip": i.lists.ordered + k("insertOrderedList"),
                        "click": b.createInvokeHandler("editor.insertOrderedList")
                    }).render()
                });
                var d = f.button({
                        "contents": f.icon(h.icons.alignLeft),
                        "tooltip": i.paragraph.left + k("justifyLeft"),
                        "click": b.createInvokeHandler("editor.justifyLeft")
                    }),
                    g = f.button({
                        "contents": f.icon(h.icons.alignCenter),
                        "tooltip": i.paragraph.center + k("justifyCenter"),
                        "click": b.createInvokeHandler("editor.justifyCenter")
                    }),
                    j = f.button({
                        "contents": f.icon(h.icons.alignRight),
                        "tooltip": i.paragraph.right + k("justifyRight"),
                        "click": b.createInvokeHandler("editor.justifyRight")
                    }),
                    l = f.button({
                        "contents": f.icon(h.icons.alignJustify),
                        "tooltip": i.paragraph.justify + k("justifyFull"),
                        "click": b.createInvokeHandler("editor.justifyFull")
                    }),
                    m = f.button({
                        "contents": f.icon(h.icons.outdent),
                        "tooltip": i.paragraph.outdent + k("outdent"),
                        "click": b.createInvokeHandler("editor.outdent")
                    }),
                    n = f.button({
                        "contents": f.icon(h.icons.indent),
                        "tooltip": i.paragraph.indent + k("indent"),
                        "click": b.createInvokeHandler("editor.indent")
                    });
                b.memo("button.justifyLeft", c.invoke(d, "render")), b.memo("button.justifyCenter", c.invoke(g, "render")), b.memo("button.justifyRight", c.invoke(j, "render")), b.memo("button.justifyFull", c.invoke(l, "render")), b.memo("button.outdent", c.invoke(m, "render")), b.memo("button.indent", c.invoke(n, "render")), b.memo("button.paragraph", function () {
                    return f.buttonGroup([f.button({
                        "className": "dropdown-toggle",
                        "contents": f.icon(h.icons.alignLeft) + " " + f.icon(h.icons.caret, "span"),
                        "tooltip": i.paragraph.paragraph,
                        "data": {
                            "toggle": "dropdown"
                        }
                    }), f.dropdown([f.buttonGroup({
                        "className": "note-align",
                        "children": [d, g, j, l]
                    }), f.buttonGroup({
                        "className": "note-list",
                        "children": [m, n]
                    })])]).render()
                }), b.memo("button.height", function () {
                    return f.buttonGroup([f.button({
                        "className": "dropdown-toggle",
                        "contents": f.icon(h.icons.textHeight) + " " + f.icon(h.icons.caret, "span"),
                        "tooltip": i.font.height,
                        "data": {
                            "toggle": "dropdown"
                        }
                    }), f.dropdownCheck({
                        "items": h.lineHeights,
                        "checkClassName": h.icons.menuCheck,
                        "className": "dropdown-line-height",
                        "click": b.createInvokeHandler("editor.lineHeight")
                    })]).render()
                }), b.memo("button.table", function () {
                    return f.buttonGroup([f.button({
                        "className": "dropdown-toggle",
                        "contents": f.icon(h.icons.table) + " " + f.icon(h.icons.caret, "span"),
                        "tooltip": i.table.table,
                        "data": {
                            "toggle": "dropdown"
                        }
                    }), f.dropdown({
                        "className": "note-table",
                        "items": ['<div class="note-dimension-picker">', '  <div class="note-dimension-picker-mousecatcher" data-event="insertTable" data-value="1x1"/>', '  <div class="note-dimension-picker-highlighted"/>', '  <div class="note-dimension-picker-unhighlighted"/>', "</div>", '<div class="note-dimension-display">1 x 1</div>'].join("")
                    })], {
                        "callback": function (a) {
                            var c = a.find(".note-dimension-picker-mousecatcher");
                            c.css({
                                "width": h.insertTableMaxSize.col + "em",
                                "height": h.insertTableMaxSize.row + "em"
                            }).mousedown(b.createInvokeHandler("editor.insertTable")).on("mousemove", e.tableMoveHandler)
                        }
                    }).render()
                }), b.memo("button.link", function () {
                    return f.button({
                        "contents": f.icon(h.icons.link),
                        "tooltip": i.link.link,
                        "click": b.createInvokeHandler("linkDialog.show")
                    }).render()
                }), b.memo("button.picture", function () {
                    return f.button({
                        "contents": f.icon(h.icons.picture),
                        "tooltip": i.image.image,
                        "click": b.createInvokeHandler("imageDialog.show")
                    }).render()
                }), b.memo("button.video", function () {
                    return f.button({
                        "contents": f.icon(h.icons.video),
                        "tooltip": i.video.video,
                        "click": b.createInvokeHandler("videoDialog.show")
                    }).render()
                }), b.memo("button.hr", function () {
                    return f.button({
                        "contents": f.icon(h.icons.minus),
                        "tooltip": i.hr.insert + k("insertHorizontalRule"),
                        "click": b.createInvokeHandler("editor.insertHorizontalRule")
                    }).render()
                }), b.memo("button.fullscreen", function () {
                    return f.button({
                        "className": "btn-fullscreen",
                        "contents": f.icon(h.icons.arrowsAlt),
                        "tooltip": i.options.fullscreen,
                        "click": b.createInvokeHandler("fullscreen.toggle")
                    }).render()
                }), b.memo("button.codeview", function () {
                    return f.button({
                        "className": "btn-codeview",
                        "contents": f.icon(h.icons.code),
                        "tooltip": i.options.codeview,
                        "click": b.createInvokeHandler("codeview.toggle")
                    }).render()
                }), b.memo("button.redo", function () {
                    return f.button({
                        "contents": f.icon(h.icons.redo),
                        "tooltip": i.history.redo + k("redo"),
                        "click": b.createInvokeHandler("editor.redo")
                    }).render()
                }), b.memo("button.undo", function () {
                    return f.button({
                        "contents": f.icon(h.icons.undo),
                        "tooltip": i.history.undo + k("undo"),
                        "click": b.createInvokeHandler("editor.undo")
                    }).render()
                }), b.memo("button.help", function () {
                    return f.button({
                        "contents": f.icon(h.icons.question),
                        "tooltip": i.options.help,
                        "click": b.createInvokeHandler("helpDialog.show")
                    }).render()
                })
            }, this.addImagePopoverButtons = function () {
                b.memo("button.imageSize100", function () {
                    return f.button({
                        "contents": '<span class="note-fontsize-10">100%</span>',
                        "tooltip": i.image.resizeFull,
                        "click": b.createInvokeHandler("editor.resize", "1")
                    }).render()
                }), b.memo("button.imageSize50", function () {
                    return f.button({
                        "contents": '<span class="note-fontsize-10">50%</span>',
                        "tooltip": i.image.resizeHalf,
                        "click": b.createInvokeHandler("editor.resize", "0.5")
                    }).render()
                }), b.memo("button.imageSize25", function () {
                    return f.button({
                        "contents": '<span class="note-fontsize-10">25%</span>',
                        "tooltip": i.image.resizeQuarter,
                        "click": b.createInvokeHandler("editor.resize", "0.25")
                    }).render()
                }), b.memo("button.floatLeft", function () {
                    return f.button({
                        "contents": f.icon(h.icons.alignLeft),
                        "tooltip": i.image.floatLeft,
                        "click": b.createInvokeHandler("editor.floatMe", "left")
                    }).render()
                }), b.memo("button.floatRight", function () {
                    return f.button({
                        "contents": f.icon(h.icons.alignRight),
                        "tooltip": i.image.floatRight,
                        "click": b.createInvokeHandler("editor.floatMe", "right")
                    }).render()
                }), b.memo("button.floatNone", function () {
                    return f.button({
                        "contents": f.icon(h.icons.alignJustify),
                        "tooltip": i.image.floatNone,
                        "click": b.createInvokeHandler("editor.floatMe", "none")
                    }).render()
                }), b.memo("button.removeMedia", function () {
                    return f.button({
                        "contents": f.icon(h.icons.trash),
                        "tooltip": i.image.remove,
                        "click": b.createInvokeHandler("editor.removeMedia")
                    }).render()
                })
            }, this.addLinkPopoverButtons = function () {
                b.memo("button.linkDialogShow", function () {
                    return f.button({
                        "contents": f.icon(h.icons.link),
                        "tooltip": i.link.edit,
                        "click": b.createInvokeHandler("linkDialog.show")
                    }).render()
                }), b.memo("button.unlink", function () {
                    return f.button({
                        "contents": f.icon(h.icons.unlink),
                        "tooltip": i.link.unlink,
                        "click": b.createInvokeHandler("editor.unlink")
                    }).render()
                })
            }, this.build = function (a, c) {
                for (var d = 0, e = c.length; e > d; d++) {
                    for (var g = c[d], h = g[0], i = g[1], j = f.buttonGroup({
                        "className": "note-" + h
                    }).render(), k = 0, l = i.length; l > k; k++) {
                        var m = b.memo("button." + i[k]);
                        m && j.append("function" == typeof m ? m(b) : m)
                    }
                    j.appendTo(a)
                }
            }, this.updateCurrentStyle = function () {
                var c = b.invoke("editor.currentStyle");
                if (this.updateBtnStates({
                        ".note-btn-bold": function () {
                            return "bold" === c["font-bold"]
                        },
                        ".note-btn-italic": function () {
                            return "italic" === c["font-italic"]
                        },
                        ".note-btn-underline": function () {
                            return "underline" === c["font-underline"]
                        },
                        ".note-btn-subscript": function () {
                            return "subscript" === c["font-subscript"]
                        },
                        ".note-btn-superscript": function () {
                            return "superscript" === c["font-superscript"]
                        },
                        ".note-btn-strikethrough": function () {
                            return "strikethrough" === c["font-strikethrough"]
                        }
                    }), c["font-family"]) {
                    var f = c["font-family"].split(",").map(function (a) {
                            return a.replace(/[\'\"]/g, "").replace(/\s+$/, "").replace(/^\s+/, "")
                        }),
                        h = d.find(f, e.isFontInstalled);
                    g.find(".dropdown-fontname li a").each(function () {
                        var b = a(this).data("value") + "" == h + "";
                        this.className = b ? "checked" : ""
                    }), g.find(".note-current-fontname").text(h)
                }
                if (c["font-size"]) {
                    var i = c["font-size"];
                    g.find(".dropdown-fontsize li a").each(function () {
                        var b = a(this).data("value") + "" == i + "";
                        this.className = b ? "checked" : ""
                    }), g.find(".note-current-fontsize").text(i)
                }
                if (c["line-height"]) {
                    var j = c["line-height"];
                    g.find(".dropdown-line-height li a").each(function () {
                        var b = a(this).data("value") + "" == j + "";
                        this.className = b ? "checked" : ""
                    })
                }
            }, this.updateBtnStates = function (b) {
                a.each(b, function (a, b) {
                    f.toggleBtnActive(g.find(a), b())
                })
            }, this.tableMoveHandler = function (b) {
                var c, d = 18,
                    e = a(b.target.parentNode),
                    f = e.next(),
                    g = e.find(".note-dimension-picker-mousecatcher"),
                    i = e.find(".note-dimension-picker-highlighted"),
                    j = e.find(".note-dimension-picker-unhighlighted");
                if (void 0 === b.offsetX) {
                    var k = a(b.target).offset();
                    c = {
                        "x": b.pageX - k.left,
                        "y": b.pageY - k.top
                    }
                } else c = {
                    "x": b.offsetX,
                    "y": b.offsetY
                };
                var l = {
                    "c": Math.ceil(c.x / d) || 1,
                    "r": Math.ceil(c.y / d) || 1
                };
                i.css({
                    "width": l.c + "em",
                    "height": l.r + "em"
                }), g.data("value", l.c + "x" + l.r), 3 < l.c && l.c < h.insertTableMaxSize.col && j.css({
                    "width": l.c + 1 + "em"
                }), 3 < l.r && l.r < h.insertTableMaxSize.row && j.css({
                    "height": l.r + 1 + "em"
                }), f.html(l.c + " x " + l.r)
            }
        },
        ea = function (b) {
            var c = a.summernote.ui,
                d = b.layoutInfo.note,
                e = b.layoutInfo.toolbar,
                f = b.options;
            this.shouldInitialize = function () {
                return !f.airMode
            }, this.initialize = function () {
                f.toolbar = f.toolbar || [], f.toolbar.length ? b.invoke("buttons.build", e, f.toolbar) : e.hide(), f.toolbarContainer && e.appendTo(f.toolbarContainer), d.on("summernote.keyup summernote.mouseup summernote.change", function () {
                    b.invoke("buttons.updateCurrentStyle")
                }), b.invoke("buttons.updateCurrentStyle")
            }, this.destroy = function () {
                e.children().remove()
            }, this.updateFullscreen = function (a) {
                c.toggleBtnActive(e.find(".btn-fullscreen"), a)
            }, this.updateCodeview = function (a) {
                c.toggleBtnActive(e.find(".btn-codeview"), a), a ? this.deactivate() : this.activate()
            }, this.activate = function (a) {
                var b = e.find("button");
                a || (b = b.not(".btn-codeview")), c.toggleBtn(b, !0)
            }, this.deactivate = function (a) {
                var b = e.find("button");
                a || (b = b.not(".btn-codeview")), c.toggleBtn(b, !1)
            }
        },
        fa = function (b) {
            var c = this,
                d = a.summernote.ui,
                e = b.layoutInfo.editor,
                f = b.options,
                g = f.langInfo;
            this.initialize = function () {
                var b = f.dialogsInBody ? a(document.body) : e,
                    c = '<div class="form-group"><label>' + g.link.textToDisplay + '</label><input class="note-link-text form-control" type="text" /></div><div class="form-group"><label>' + g.link.url + '</label><input class="note-link-url form-control" type="text" value="http://" /></div>' + (f.disableLinkTarget ? "" : '<div class="checkbox"><label><input type="checkbox" checked> ' + g.link.openInNewWindow + "</label></div>"),
                    h = '<button href="#" class="btn btn-primary note-link-btn disabled" disabled>' + g.link.insert + "</button>";
                this.$dialog = d.dialog({
                    "className": "link-dialog",
                    "title": g.link.insert,
                    "fade": f.dialogsFade,
                    "body": c,
                    "footer": h
                }).render().appendTo(b)
            }, this.destroy = function () {
                d.hideDialog(this.$dialog), this.$dialog.remove()
            }, this.bindEnterKey = function (a, b) {
                a.on("keypress", function (a) {
                    a.keyCode === L.code.ENTER && b.trigger("click")
                })
            }, this.showLinkDialog = function (e) {
                return a.Deferred(function (a) {
                    var f = c.$dialog.find(".note-link-text"),
                        g = c.$dialog.find(".note-link-url"),
                        h = c.$dialog.find(".note-link-btn"),
                        i = c.$dialog.find("input[type=checkbox]");
                    d.onDialogShown(c.$dialog, function () {
                        b.triggerEvent("dialog.shown"), f.val(e.text), f.on("input", function () {
                            d.toggleBtn(h, f.val() && g.val()), e.text = f.val()
                        }), e.url || (e.url = e.text || "http://", d.toggleBtn(h, e.text)), g.on("input", function () {
                            d.toggleBtn(h, f.val() && g.val()), e.text || f.val(g.val())
                        }).val(e.url).trigger("focus"), c.bindEnterKey(g, h), c.bindEnterKey(f, h), i.prop("checked", e.isNewWindow), h.one("click", function (b) {
                            b.preventDefault(), a.resolve({
                                "range": e.range,
                                "url": g.val(),
                                "text": f.val(),
                                "isNewWindow": i.is(":checked")
                            }), c.$dialog.modal("hide")
                        })
                    }), d.onDialogHidden(c.$dialog, function () {
                        f.off("input keypress"), g.off("input keypress"), h.off("click"), "pending" === a.state() && a.reject()
                    }), d.showDialog(c.$dialog)
                }).promise()
            }, this.show = function () {
                var a = b.invoke("editor.getLinkInfo");
                b.invoke("editor.saveRange"), this.showLinkDialog(a).then(function (a) {
                    b.invoke("editor.restoreRange"), b.invoke("editor.createLink", a)
                }).fail(function () {
                    b.invoke("editor.restoreRange")
                })
            }, b.memo("help.linkDialog.show", f.langInfo.help["linkDialog.show"])
        },
        ga = function (b) {
            var c = this,
                e = a.summernote.ui,
                f = b.options;
            this.events = {
                "summernote.keyup summernote.mouseup summernote.change summernote.scroll": function () {
                    c.update()
                },
                "summernote.dialog.shown": function () {
                    c.hide()
                }
            }, this.shouldInitialize = function () {
                return !d.isEmpty(f.popover.link)
            }, this.initialize = function () {
                this.$popover = e.popover({
                    "className": "note-link-popover",
                    "callback": function (a) {
                        var b = a.find(".popover-content");
                        b.prepend('<span><a target="_blank"></a>&nbsp;</span>')
                    }
                }).render().appendTo("body");
                var a = this.$popover.find(".popover-content");
                b.invoke("buttons.build", a, f.popover.link)
            }, this.destroy = function () {
                this.$popover.remove()
            }, this.update = function () {
                if (!b.invoke("editor.hasFocus")) return void this.hide();
                var c = b.invoke("editor.createRange");
                if (c.isCollapsed() && c.isOnAnchor()) {
                    var d = p.ancestor(c.sc, p.isAnchor),
                        e = a(d).attr("href");
                    this.$popover.find("a").attr("href", e).html(e);
                    var f = p.posFromPlaceholder(d);
                    this.$popover.css({
                        "display": "block",
                        "left": f.left,
                        "top": f.top
                    })
                } else this.hide()
            }, this.hide = function () {
                this.$popover.hide()
            }
        },
        ha = function (b) {
            var c = this,
                d = a.summernote.ui,
                e = b.layoutInfo.editor,
                f = b.options,
                g = f.langInfo;
            this.initialize = function () {
                var b = f.dialogsInBody ? a(document.body) : e,
                    c = "";
                if (f.maximumImageFileSize) {
                    var h = Math.floor(Math.log(f.maximumImageFileSize) / Math.log(1024)),
                        i = 1 * (f.maximumImageFileSize / Math.pow(1024, h)).toFixed(2) + " " + " KMGTP" [h] + "B";
                    c = "<small>" + g.image.maximumFileSize + " : " + i + "</small>"
                }
                var j = '<div class="form-group note-group-select-from-files"><label>' + g.image.selectFromFiles + '</label><input class="note-image-input form-control" type="file" name="files" accept="image/*" multiple="multiple" />' + c + '</div><div class="form-group" style="overflow:auto;"><label>' + g.image.url + '</label><input class="note-image-url form-control col-md-12" type="text" /></div>',
                    k = '<button href="#" class="btn btn-primary note-image-btn disabled" disabled>' + g.image.insert + "</button>";
                this.$dialog = d.dialog({
                    "title": g.image.insert,
                    "fade": f.dialogsFade,
                    "body": j,
                    "footer": k
                }).render().appendTo(b)
            }, this.destroy = function () {
                d.hideDialog(this.$dialog), this.$dialog.remove()
            }, this.bindEnterKey = function (a, b) {
                a.on("keypress", function (a) {
                    a.keyCode === L.code.ENTER && b.trigger("click")
                })
            }, this.show = function () {
                b.invoke("editor.saveRange"), this.showImageDialog().then(function (a) {
                    d.hideDialog(c.$dialog), b.invoke("editor.restoreRange"), "string" == typeof a ? b.invoke("editor.insertImage", a) : b.invoke("editor.insertImagesOrCallback", a)
                }).fail(function () {
                    b.invoke("editor.restoreRange")
                })
            }, this.showImageDialog = function () {
                return a.Deferred(function (a) {
                    var e = c.$dialog.find(".note-image-input"),
                        f = c.$dialog.find(".note-image-url"),
                        g = c.$dialog.find(".note-image-btn");
                    d.onDialogShown(c.$dialog, function () {
                        b.triggerEvent("dialog.shown"), e.replaceWith(e.clone().on("change", function () {
                            a.resolve(this.files || this.value)
                        }).val("")), g.click(function (b) {
                            b.preventDefault(), a.resolve(f.val())
                        }), f.on("keyup paste", function () {
                            var a = f.val();
                            d.toggleBtn(g, a)
                        }).val("").trigger("focus"), c.bindEnterKey(f, g)
                    }), d.onDialogHidden(c.$dialog, function () {
                        e.off("change"), f.off("keyup paste keypress"), g.off("click"), "pending" === a.state() && a.reject()
                    }), d.showDialog(c.$dialog)
                })
            }
        },
        ia = function (b) {
            var c = a.summernote.ui,
                e = b.options;
            this.shouldInitialize = function () {
                return !d.isEmpty(e.popover.image)
            }, this.initialize = function () {
                this.$popover = c.popover({
                    "className": "note-image-popover"
                }).render().appendTo("body");
                var a = this.$popover.find(".popover-content");
                b.invoke("buttons.build", a, e.popover.image)
            }, this.destroy = function () {
                this.$popover.remove()
            }, this.update = function (a) {
                if (p.isImg(a)) {
                    var b = p.posFromPlaceholder(a);
                    this.$popover.css({
                        "display": "block",
                        "left": b.left,
                        "top": b.top
                    })
                } else this.hide()
            }, this.hide = function () {
                this.$popover.hide()
            }
        },
        ja = function (b) {
            var c = this,
                d = a.summernote.ui,
                e = b.layoutInfo.editor,
                f = b.options,
                g = f.langInfo;
            this.initialize = function () {
                var b = f.dialogsInBody ? a(document.body) : e,
                    c = '<div class="form-group row-fluid"><label>' + g.video.url + ' <small class="text-muted">' + g.video.providers + '</small></label><input class="note-video-url form-control span12" type="text" /></div>',
                    h = '<button href="#" class="btn btn-primary note-video-btn disabled" disabled>' + g.video.insert + "</button>";
                this.$dialog = d.dialog({
                    "title": g.video.insert,
                    "fade": f.dialogsFade,
                    "body": c,
                    "footer": h
                }).render().appendTo(b)
            }, this.destroy = function () {
                d.hideDialog(this.$dialog), this.$dialog.remove()
            }, this.bindEnterKey = function (a, b) {
                a.on("keypress", function (a) {
                    a.keyCode === L.code.ENTER && b.trigger("click")
                })
            }, this.createVideoNode = function (b) {
                var c, d = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/,
                    e = b.match(d),
                    f = /\/\/instagram.com\/p\/(.[a-zA-Z0-9_-]*)/,
                    g = b.match(f),
                    h = /\/\/vine.co\/v\/(.[a-zA-Z0-9]*)/,
                    i = b.match(h),
                    j = /\/\/(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/,
                    k = b.match(j),
                    l = /.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/,
                    m = b.match(l),
                    n = /\/\/v\.youku\.com\/v_show\/id_(\w+)=*\.html/,
                    o = b.match(n),
                    p = /^.+.(mp4|m4v)$/,
                    q = b.match(p),
                    r = /^.+.(ogg|ogv)$/,
                    s = b.match(r),
                    t = /^.+.(webm)$/,
                    u = b.match(t);
                if (e && 11 === e[1].length) {
                    var v = e[1];
                    c = a("<iframe>").attr("frameborder", 0).attr("src", "//www.youtube.com/embed/" + v).attr("width", "640").attr("height", "360")
                } else if (g && g[0].length) c = a("<iframe>").attr("frameborder", 0).attr("src", g[0] + "/embed/").attr("width", "612").attr("height", "710").attr("scrolling", "no").attr("allowtransparency", "true");
                else if (i && i[0].length) c = a("<iframe>").attr("frameborder", 0).attr("src", i[0] + "/embed/simple").attr("width", "600").attr("height", "600").attr("class", "vine-embed");
                else if (k && k[3].length) c = a("<iframe webkitallowfullscreen mozallowfullscreen allowfullscreen>").attr("frameborder", 0).attr("src", "//player.vimeo.com/video/" + k[3]).attr("width", "640").attr("height", "360");
                else if (m && m[2].length) c = a("<iframe>").attr("frameborder", 0).attr("src", "//www.dailymotion.com/embed/video/" + m[2]).attr("width", "640").attr("height", "360");
                else if (o && o[1].length) c = a("<iframe webkitallowfullscreen mozallowfullscreen allowfullscreen>").attr("frameborder", 0).attr("height", "498").attr("width", "510").attr("src", "//player.youku.com/embed/" + o[1]);
                else {
                    if (!(q || s || u)) return !1;
                    c = a("<video controls>").attr("src", b).attr("width", "640").attr("height", "360")
                }
                return c.addClass("note-video-clip"), c[0]
            }, this.show = function () {
                var a = b.invoke("editor.getSelectedText");
                b.invoke("editor.saveRange"), this.showVideoDialog(a).then(function (a) {
                    d.hideDialog(c.$dialog), b.invoke("editor.restoreRange");
                    var e = c.createVideoNode(a);
                    e && b.invoke("editor.insertNode", e)
                }).fail(function () {
                    b.invoke("editor.restoreRange")
                })
            }, this.showVideoDialog = function (e) {
                return a.Deferred(function (a) {
                    var f = c.$dialog.find(".note-video-url"),
                        g = c.$dialog.find(".note-video-btn");
                    d.onDialogShown(c.$dialog, function () {
                        b.triggerEvent("dialog.shown"), f.val(e).on("input", function () {
                            d.toggleBtn(g, f.val())
                        }).trigger("focus"), g.click(function (b) {
                            b.preventDefault(), a.resolve(f.val())
                        }), c.bindEnterKey(f, g)
                    }), d.onDialogHidden(c.$dialog, function () {
                        f.off("input"), g.off("click"), "pending" === a.state() && a.reject()
                    }), d.showDialog(c.$dialog)
                })
            }
        },
        ka = function (b) {
            var c = this,
                d = a.summernote.ui,
                e = b.layoutInfo.editor,
                f = b.options,
                g = f.langInfo;
            this.createShortCutList = function () {
                var c = f.keyMap[m.isMac ? "mac" : "pc"];
                return Object.keys(c).map(function (d) {
                    var e = c[d],
                        f = a('<div><div class="help-list-item"/></div>');
                    return f.append(a("<label><kbd>" + d + "</kdb></label>").css({
                        "width": 180,
                        "margin-right": 10
                    })).append(a("<span/>").html(b.memo("help." + e) || e)), f.html()
                }).join("")
            }, this.initialize = function () {
                var b = f.dialogsInBody ? a(document.body) : e,
                    c = ['<p class="text-center">', '<a href="//summernote.org/" target="_blank">Summernote 0.8.1</a> \xb7 ', '<a href="//github.com/summernote/summernote" target="_blank">Project</a> \xb7 ', '<a href="//github.com/summernote/summernote/issues" target="_blank">Issues</a>', "</p>"].join("");
                this.$dialog = d.dialog({
                    "title": g.options.help,
                    "fade": f.dialogsFade,
                    "body": this.createShortCutList(),
                    "footer": c,
                    "callback": function (a) {
                        a.find(".modal-body").css({
                            "max-height": 300,
                            "overflow": "scroll"
                        })
                    }
                }).render().appendTo(b)
            }, this.destroy = function () {
                d.hideDialog(this.$dialog), this.$dialog.remove()
            }, this.showHelpDialog = function () {
                return a.Deferred(function (a) {
                    d.onDialogShown(c.$dialog, function () {
                        b.triggerEvent("dialog.shown"), a.resolve()
                    }), d.showDialog(c.$dialog)
                }).promise()
            }, this.show = function () {
                b.invoke("editor.saveRange"), this.showHelpDialog().then(function () {
                    b.invoke("editor.restoreRange")
                })
            }
        },
        la = function (b) {
            var e = this,
                f = a.summernote.ui,
                g = b.options,
                h = 20;
            this.events = {
                "summernote.keyup summernote.mouseup summernote.scroll": function () {
                    e.update()
                },
                "summernote.change summernote.dialog.shown": function () {
                    e.hide()
                },
                "summernote.focusout": function (a, b) {
                    m.isFF || b.relatedTarget && p.ancestor(b.relatedTarget, c.eq(e.$popover[0])) || e.hide()
                }
            }, this.shouldInitialize = function () {
                return g.airMode && !d.isEmpty(g.popover.air)
            }, this.initialize = function () {
                this.$popover = f.popover({
                    "className": "note-air-popover"
                }).render().appendTo("body");
                var a = this.$popover.find(".popover-content");
                b.invoke("buttons.build", a, g.popover.air)
            }, this.destroy = function () {
                this.$popover.remove()
            }, this.update = function () {
                var a = b.invoke("editor.currentStyle");
                if (a.range && !a.range.isCollapsed()) {
                    var e = d.last(a.range.getClientRects());
                    if (e) {
                        var f = c.rect2bnd(e);
                        this.$popover.css({
                            "display": "block",
                            "left": Math.max(f.left + f.width / 2, 0) - h,
                            "top": f.top + f.height
                        })
                    }
                } else this.hide()
            }, this.hide = function () {
                this.$popover.hide()
            }
        },
        ma = function (b) {
            var e = this,
                f = a.summernote.ui,
                g = 5,
                h = b.options.hint || [],
                i = b.options.hintDirection || "bottom",
                j = a.isArray(h) ? h : [h];
            this.events = {
                "summernote.keyup": function (a, b) {
                    b.isDefaultPrevented() || e.handleKeyup(b)
                },
                "summernote.keydown": function (a, b) {
                    e.handleKeydown(b)
                },
                "summernote.dialog.shown": function () {
                    e.hide()
                }
            }, this.shouldInitialize = function () {
                return j.length > 0
            }, this.initialize = function () {
                this.lastWordRange = null, this.$popover = f.popover({
                    "className": "note-hint-popover",
                    "hideArrow": !0,
                    "direction": ""
                }).render().appendTo("body"), this.$popover.hide(), this.$content = this.$popover.find(".popover-content"), this.$content.on("click", ".note-hint-item", function () {
                    e.$content.find(".active").removeClass("active"), a(this).addClass("active"), e.replace()
                })
            }, this.destroy = function () {
                this.$popover.remove()
            }, this.selectItem = function (a) {
                this.$content.find(".active").removeClass("active"), a.addClass("active"), this.$content[0].scrollTop = a[0].offsetTop - this.$content.innerHeight() / 2
            }, this.moveDown = function () {
                var a = this.$content.find(".note-hint-item.active"),
                    b = a.next();
                if (b.length) this.selectItem(b);
                else {
                    var c = a.parent().next();
                    c.length || (c = this.$content.find(".note-hint-group").first()), this.selectItem(c.find(".note-hint-item").first())
                }
            }, this.moveUp = function () {
                var a = this.$content.find(".note-hint-item.active"),
                    b = a.prev();
                if (b.length) this.selectItem(b);
                else {
                    var c = a.parent().prev();
                    c.length || (c = this.$content.find(".note-hint-group").last()), this.selectItem(c.find(".note-hint-item").last())
                }
            }, this.replace = function () {
                var a = this.$content.find(".note-hint-item.active");
                if (a.length) {
                    var c = this.nodeFromItem(a);
                    this.lastWordRange.insertNode(c), M.createFromNode(c).collapse().select(), this.lastWordRange = null, this.hide(), b.invoke("editor.focus")
                }
            }, this.nodeFromItem = function (a) {
                var b = j[a.data("index")],
                    c = a.data("item"),
                    d = b.content ? b.content(c) : c;
                return "string" == typeof d && (d = p.createText(d)), d
            }, this.createItemTemplates = function (b, c) {
                var d = j[b];
                return c.map(function (c, e) {
                    var f = a('<div class="note-hint-item"/>');
                    return f.append(d.template ? d.template(c) : c + ""), f.data({
                        "index": b,
                        "item": c
                    }), 0 === b && 0 === e && f.addClass("active"), f
                })
            }, this.handleKeydown = function (a) {
                this.$popover.is(":visible") && (a.keyCode === L.code.ENTER ? (a.preventDefault(), this.replace()) : a.keyCode === L.code.UP ? (a.preventDefault(), this.moveUp()) : a.keyCode === L.code.DOWN && (a.preventDefault(), this.moveDown()))
            }, this.searchKeyword = function (a, b, c) {
                var d = j[a];
                if (d && d.match.test(b) && d.search) {
                    var e = d.match.exec(b);
                    d.search(e[1], c)
                } else c()
            }, this.createGroup = function (b, c) {
                var d = a('<div class="note-hint-group note-hint-group-' + b + '"/>');
                return this.searchKeyword(b, c, function (a) {
                    a = a || [], a.length && (d.html(e.createItemTemplates(b, a)), e.show())
                }), d
            }, this.handleKeyup = function (a) {
                if (d.contains([L.code.ENTER, L.code.UP, L.code.DOWN], a.keyCode)) {
                    if (a.keyCode === L.code.ENTER && this.$popover.is(":visible")) return
                } else {
                    var f = b.invoke("editor.createRange").getWordRange(),
                        h = f.toString();
                    if (j.length && h) {
                        this.$content.empty();
                        var k = c.rect2bnd(d.last(f.getClientRects()));
                        k && (this.$popover.hide(), this.lastWordRange = f, j.forEach(function (a, b) {
                            a.match.test(h) && e.createGroup(b, h).appendTo(e.$content)
                        }), "top" === i ? this.$popover.css({
                            "left": k.left,
                            "top": k.top - this.$popover.outerHeight() - g
                        }) : this.$popover.css({
                            "left": k.left,
                            "top": k.top + k.height + g
                        }))
                    } else this.hide()
                }
            }, this.show = function () {
                this.$popover.show()
            }, this.hide = function () {
                this.$popover.hide()
            }
        };
    a.summernote = a.extend(a.summernote, {
        "version": "0.8.1",
        "ui": J,
        "plugins": {},
        "options": {
            "modules": {
                "editor": U,
                "clipboard": V,
                "dropzone": W,
                "codeview": X,
                "statusbar": Z,
                "fullscreen": $,
                "handle": _,
                "hintPopover": ma,
                "autoLink": aa,
                "autoSync": ba,
                "placeholder": ca,
                "buttons": da,
                "toolbar": ea,
                "linkDialog": fa,
                "linkPopover": ga,
                "imageDialog": ha,
                "imagePopover": ia,
                "videoDialog": ja,
                "helpDialog": ka,
                "airPopover": la
            },
            "buttons": {},
            "lang": "en-US",
            "toolbar": [
                ["style", ["style","undo", "redo"]],
                ["font", ["bold", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["table", ["table"]],
                ["insert", ["link", "picture", "video"]],
                ["view", ["fullscreen", "codeview", "help"]]
            ],
            "popover": {
                "image": [
                    ["imagesize", ["imageSize100", "imageSize50", "imageSize25"]],
                    ["float", ["floatLeft", "floatRight", "floatNone"]],
                    ["remove", ["removeMedia"]]
                ],
                "link": [
                    ["link", ["linkDialogShow", "unlink"]]
                ],
                "air": [
                    ["color", ["color"]],
                    ["font", ["bold", "underline", "clear"]],
                    ["para", ["ul", "paragraph"]],
                    ["table", ["table"]],
                    ["insert", ["link", "picture"]]
                ]
            },
            "airMode": !1,
            "width": null,
            "height": null,
            "focus": !1,
            "tabSize": 4,
            "styleWithSpan": !0,
            "shortcuts": !0,
            "textareaAutoSync": !0,
            "direction": null,
            "styleTags": ["p", "blockquote", "pre", "h1", "h2", "h3", "h4", "h5", "h6"],
            "fontNames": ["Arial", "Arial Black", "Comic Sans MS", "Courier New", "Helvetica Neue", "Helvetica", "Impact", "Lucida Grande", "Tahoma", "Times New Roman", "Verdana"],
            "fontSizes": ["8", "9", "10", "11", "12", "14", "18", "24", "36"],
            "colors": [
                ["#000000", "#424242", "#636363", "#9C9C94", "#CEC6CE", "#EFEFEF", "#F7F7F7", "#FFFFFF"],
                ["#FF0000", "#FF9C00", "#FFFF00", "#00FF00", "#00FFFF", "#0000FF", "#9C00FF", "#FF00FF"],
                ["#F7C6CE", "#FFE7CE", "#FFEFC6", "#D6EFD6", "#CEDEE7", "#CEE7F7", "#D6D6E7", "#E7D6DE"],
                ["#E79C9C", "#FFC69C", "#FFE79C", "#B5D6A5", "#A5C6CE", "#9CC6EF", "#B5A5D6", "#D6A5BD"],
                ["#E76363", "#F7AD6B", "#FFD663", "#94BD7B", "#73A5AD", "#6BADDE", "#8C7BC6", "#C67BA5"],
                ["#CE0000", "#E79439", "#EFC631", "#6BA54A", "#4A7B8C", "#3984C6", "#634AA5", "#A54A7B"],
                ["#9C0000", "#B56308", "#BD9400", "#397B21", "#104A5A", "#085294", "#311873", "#731842"],
                ["#630000", "#7B3900", "#846300", "#295218", "#083139", "#003163", "#21104A", "#4A1031"]
            ],
            "lineHeights": ["1.0", "1.2", "1.4", "1.5", "1.6", "1.8", "2.0", "3.0"],
            "tableClassName": "table table-bordered",
            "insertTableMaxSize": {
                "col": 10,
                "row": 10
            },
            "dialogsInBody": !1,
            "dialogsFade": !1,
            "maximumImageFileSize": null,
            "callbacks": {
                "onInit": null,
                "onFocus": null,
                "onBlur": null,
                "onEnter": null,
                "onKeyup": null,
                "onKeydown": null,
                "onSubmit": null,
                "onImageUpload": null,
                "onImageUploadError": null
            },
            "codemirror": {
                "mode": "text/html",
                "htmlMode": !0,
                "lineNumbers": !0
            },
            "keyMap": {
                "pc": {
                    "ENTER": "insertParagraph",
                    "CTRL+Z": "undo",
                    "CTRL+Y": "redo",
                    "TAB": "tab",
                    "SHIFT+TAB": "untab",
                    "CTRL+B": "bold",
                    "CTRL+I": "italic",
                    "CTRL+U": "underline",
                    "CTRL+SHIFT+S": "strikethrough",
                    "CTRL+BACKSLASH": "removeFormat",
                    "CTRL+SHIFT+L": "justifyLeft",
                    "CTRL+SHIFT+E": "justifyCenter",
                    "CTRL+SHIFT+R": "justifyRight",
                    "CTRL+SHIFT+J": "justifyFull",
                    "CTRL+SHIFT+NUM7": "insertUnorderedList",
                    "CTRL+SHIFT+NUM8": "insertOrderedList",
                    "CTRL+LEFTBRACKET": "outdent",
                    "CTRL+RIGHTBRACKET": "indent",
                    "CTRL+NUM0": "formatPara",
                    "CTRL+NUM1": "formatH1",
                    "CTRL+NUM2": "formatH2",
                    "CTRL+NUM3": "formatH3",
                    "CTRL+NUM4": "formatH4",
                    "CTRL+NUM5": "formatH5",
                    "CTRL+NUM6": "formatH6",
                    "CTRL+ENTER": "insertHorizontalRule",
                    "CTRL+K": "linkDialog.show"
                },
                "mac": {
                    "ENTER": "insertParagraph",
                    "CMD+Z": "undo",
                    "CMD+SHIFT+Z": "redo",
                    "TAB": "tab",
                    "SHIFT+TAB": "untab",
                    "CMD+B": "bold",
                    "CMD+I": "italic",
                    "CMD+U": "underline",
                    "CMD+SHIFT+S": "strikethrough",
                    "CMD+BACKSLASH": "removeFormat",
                    "CMD+SHIFT+L": "justifyLeft",
                    "CMD+SHIFT+E": "justifyCenter",
                    "CMD+SHIFT+R": "justifyRight",
                    "CMD+SHIFT+J": "justifyFull",
                    "CMD+SHIFT+NUM7": "insertUnorderedList",
                    "CMD+SHIFT+NUM8": "insertOrderedList",
                    "CMD+LEFTBRACKET": "outdent",
                    "CMD+RIGHTBRACKET": "indent",
                    "CMD+NUM0": "formatPara",
                    "CMD+NUM1": "formatH1",
                    "CMD+NUM2": "formatH2",
                    "CMD+NUM3": "formatH3",
                    "CMD+NUM4": "formatH4",
                    "CMD+NUM5": "formatH5",
                    "CMD+NUM6": "formatH6",
                    "CMD+ENTER": "insertHorizontalRule",
                    "CMD+K": "linkDialog.show"
                }
            },
            "icons": {
                "align": "note-icon-align",
                "alignCenter": "note-icon-align-center",
                "alignJustify": "note-icon-align-justify",
                "alignLeft": "note-icon-align-left",
                "alignRight": "note-icon-align-right",
                "indent": "note-icon-align-indent",
                "outdent": "note-icon-align-outdent",
                "arrowsAlt": "note-icon-arrows-alt",
                "bold": "note-icon-bold",
                "caret": "note-icon-caret",
                "circle": "note-icon-circle",
                "close": "note-icon-close",
                "code": "note-icon-code",
                "eraser": "note-icon-eraser",
                "font": "note-icon-font",
                "frame": "note-icon-frame",
                "italic": "note-icon-italic",
                "link": "note-icon-link",
                "unlink": "note-icon-chain-broken",
                "magic": "note-icon-magic",
                "menuCheck": "note-icon-check",
                "minus": "note-icon-minus",
                "orderedlist": "note-icon-orderedlist",
                "pencil": "note-icon-pencil",
                "picture": "note-icon-picture",
                "question": "note-icon-question",
                "redo": "note-icon-redo",
                "square": "note-icon-square",
                "strikethrough": "note-icon-strikethrough",
                "subscript": "note-icon-subscript",
                "superscript": "note-icon-superscript",
                "table": "note-icon-table",
                "textHeight": "note-icon-text-height",
                "trash": "note-icon-trash",
                "underline": "note-icon-underline",
                "undo": "note-icon-undo",
                "unorderedlist": "note-icon-unorderedlist",
                "video": "note-icon-video"
            }
        }
    })
});