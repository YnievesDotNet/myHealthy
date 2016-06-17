/**
 * Rangy, a cross-browser JavaScript range and selection library
 * http://code.google.com/p/rangy/
 *
 * Copyright 2013, Tim Down
 * Licensed under the MIT license.
 * Version: 1.3alpha.804
 * Build date: 8 December 2013
 */
(function (a) {
    function j(a, b) {
        var e = typeof a[b];
        return e == d || e == c && !!a[b] || e == "unknown"
    }

    function k(a, b) {
        return typeof a[b] == c && !!a[b]
    }

    function l(a, b) {
        return typeof a[b] != e
    }

    function m(a) {
        return function (b, c) {
            var d = c.length;
            while (d--)if (!a(b, c[d]))return !1;
            return !0
        }
    }

    function q(a) {
        return a && n(a, i) && p(a, h)
    }

    function r(a) {
        return k(a, "body") ? a.body : a.getElementsByTagName("body")[0]
    }

    function u(a) {
        k(window, "console") && j(window.console, "log") && window.console.log(a)
    }

    function v(a, b) {
        b ? window.alert(a) : u(a)
    }

    function w(a) {
        t.initialized = !0, t.supported = !1, v("Rangy is not supported on this page in your browser. Reason: " + a, t.config.alertOnFail)
    }

    function x(a) {
        v("Rangy warning: " + a, t.config.alertOnWarn)
    }

    function A(a) {
        return a.message || a.description || String(a)
    }

    function B() {
        if (t.initialized)return;
        var a, b = !1, c = !1;
        j(document, "createRange") && (a = document.createRange(), n(a, g) && p(a, f) && (b = !0), a.detach());
        var d = r(document);
        if (!d || d.nodeName.toLowerCase() != "body") {
            w("No body element found");
            return
        }
        d && j(d, "createTextRange") && (a = d.createTextRange(), q(a) && (c = !0));
        if (!b && !c) {
            w("Neither Range nor TextRange are available");
            return
        }
        t.initialized = !0, t.features = {implementsDomRange: b, implementsTextRange: c};
        var e, h;
        for (var i in s)(e = s[i]) instanceof E && e.init(e, t);
        for (var k = 0, l = z.length; k < l; ++k)try {
            z[k](t)
        } catch (m) {
            h = "Rangy init listener threw an exception. Continuing. Detail: " + A(m), u(h)
        }
    }

    function D(a) {
        a = a || window, B();
        for (var b = 0, c = C.length; b < c; ++b)C[b](a)
    }

    function E(a, b, c) {
        this.name = a, this.dependencies = b, this.initialized = !1, this.supported = !1, this.initializer = c
    }

    function F(a, b, c, d) {
        var e = new E(b, c, function (a) {
            if (!a.initialized) {
                a.initialized = !0;
                try {
                    d(t, a), a.supported = !0
                } catch (c) {
                    var e = "Module '" + b + "' failed to load: " + A(c);
                    u(e)
                }
            }
        });
        s[b] = e
    }

    function G() {
    }

    function H() {
    }

    var b = typeof a.define == "function" && a.define.amd, c = "object", d = "function", e = "undefined", f = ["startContainer", "startOffset", "endContainer", "endOffset", "collapsed", "commonAncestorContainer"], g = ["setStart", "setStartBefore", "setStartAfter", "setEnd", "setEndBefore", "setEndAfter", "collapse", "selectNode", "selectNodeContents", "compareBoundaryPoints", "deleteContents", "extractContents", "cloneContents", "insertNode", "surroundContents", "cloneRange", "toString", "detach"], h = ["boundingHeight", "boundingLeft", "boundingTop", "boundingWidth", "htmlText", "text"], i = ["collapse", "compareEndPoints", "duplicate", "moveToElementText", "parentElement", "select", "setEndPoint", "getBoundingClientRect"], n = m(j), o = m(k), p = m(l), s = {}, t = {
        version: "1.3alpha.804",
        initialized: !1,
        supported: !0,
        util: {
            isHostMethod: j,
            isHostObject: k,
            isHostProperty: l,
            areHostMethods: n,
            areHostObjects: o,
            areHostProperties: p,
            isTextRange: q,
            getBody: r
        },
        features: {},
        modules: s,
        config: {alertOnFail: !0, alertOnWarn: !1, preferTextRange: !1}
    };
    t.fail = w, t.warn = x, {}.hasOwnProperty ? t.util.extend = function (a, b, c) {
        var d, e;
        for (var f in b)b.hasOwnProperty(f) && (d = a[f], e = b[f], c && d !== null && typeof d == "object" && e !== null && typeof e == "object" && t.util.extend(d, e, !0), a[f] = e);
        return a
    } : w("hasOwnProperty not supported"), function () {
        var a = document.createElement("div");
        a.appendChild(document.createElement("span"));
        var b = [].slice, c;
        try {
            b.call(a.childNodes, 0)[0].nodeType == 1 && (c = function (a) {
                return b.call(a, 0)
            })
        } catch (d) {
        }
        c || (c = function (a) {
            var b = [];
            for (var c = 0, d = a.length; c < d; ++c)b[c] = a[c];
            return b
        }), t.util.toArray = c
    }();
    var y;
    j(document, "addEventListener") ? y = function (a, b, c) {
        a.addEventListener(b, c, !1)
    } : j(document, "attachEvent") ? y = function (a, b, c) {
        a.attachEvent("on" + b, c)
    } : w("Document does not have required addEventListener or attachEvent method"), t.util.addListener = y;
    var z = [];
    t.init = B, t.addInitListener = function (a) {
        t.initialized ? a(t) : z.push(a)
    };
    var C = [];
    t.addCreateMissingNativeApiListener = function (a) {
        C.push(a)
    }, t.createMissingNativeApi = D, E.prototype = {
        init: function (a) {
            var b = this.dependencies || [];
            for (var c = 0, d = b.length, e, f; c < d; ++c) {
                f = b[c], e = s[f];
                if (!e || !(e instanceof E))throw new Error("required module '" + f + "' not found");
                e.init();
                if (!e.supported)throw new Error("required module '" + f + "' not supported")
            }
            this.initializer(this)
        }, fail: function (a) {
            throw this.initialized = !0, this.supported = !1, new Error("Module '" + this.name + "' failed to load: " + a)
        }, warn: function (a) {
            t.warn("Module " + this.name + ": " + a)
        }, deprecationNotice: function (a, b) {
            t.warn("DEPRECATED: " + a + " in module " + this.name + "is deprecated. Please use " + b + " instead")
        }, createError: function (a) {
            return new Error("Error in Rangy " + this.name + " module: " + a)
        }
    }, t.createModule = function (a) {
        var b, c;
        arguments.length == 2 ? (b = arguments[1], c = []) : (b = arguments[2], c = arguments[1]), F(!1, a, c, b)
    }, t.createCoreModule = function (a, b, c) {
        F(!0, a, b, c)
    }, t.RangePrototype = G, t.rangePrototype = new G, t.selectionPrototype = new H;
    var I = !1, J = function (a) {
        I || (I = !0, t.initialized || B())
    };
    if (typeof window == e) {
        w("No window found");
        return
    }
    if (typeof document == e) {
        w("No document found");
        return
    }
    j(document, "addEventListener") && document.addEventListener("DOMContentLoaded", J, !1), y(window, "load", J), b && a.define(function () {
        return t.amd = !0, t
    }), a.rangy = t
})(this), rangy.createCoreModule("DomUtil", [], function (a, b) {
    function h(a) {
        var b;
        return typeof a.namespaceURI == c || (b = a.namespaceURI) === null || b == "http://www.w3.org/1999/xhtml"
    }

    function i(a) {
        var b = a.parentNode;
        return b.nodeType == 1 ? b : null
    }

    function j(a) {
        var b = 0;
        while (a = a.previousSibling)++b;
        return b
    }

    function k(a) {
        switch (a.nodeType) {
            case 7:
            case 10:
                return 0;
            case 3:
            case 8:
                return a.length;
            default:
                return a.childNodes.length
        }
    }

    function l(a, b) {
        var c = [], d;
        for (d = a; d; d = d.parentNode)c.push(d);
        for (d = b; d; d = d.parentNode)if (g(c, d))return d;
        return null
    }

    function m(a, b, c) {
        var d = c ? b : b.parentNode;
        while (d) {
            if (d === a)return !0;
            d = d.parentNode
        }
        return !1
    }

    function n(a, b) {
        return m(a, b, !0)
    }

    function o(a, b, c) {
        var d, e = c ? a : a.parentNode;
        while (e) {
            d = e.parentNode;
            if (d === b)return e;
            e = d
        }
        return null
    }

    function p(a) {
        var b = a.nodeType;
        return b == 3 || b == 4 || b == 8
    }

    function q(a) {
        if (!a)return !1;
        var b = a.nodeType;
        return b == 3 || b == 8
    }

    function r(a, b) {
        var c = b.nextSibling, d = b.parentNode;
        return c ? d.insertBefore(a, c) : d.appendChild(a), a
    }

    function s(a, b, c) {
        var d = a.cloneNode(!1);
        d.deleteData(0, b), a.deleteData(b, a.length - b), r(d, a);
        if (c)for (var e = 0, f; f = c[e++];)f.node == a && f.offset > b ? (f.node = d, f.offset -= b) : f.node == a.parentNode && f.offset > j(a) && ++f.offset;
        return d
    }

    function t(a) {
        if (a.nodeType == 9)return a;
        if (typeof a.ownerDocument != c)return a.ownerDocument;
        if (typeof a.document != c)return a.document;
        if (a.parentNode)return t(a.parentNode);
        throw b.createError("getDocument: no document found for node")
    }

    function u(a) {
        var d = t(a);
        if (typeof d.defaultView != c)return d.defaultView;
        if (typeof d.parentWindow != c)return d.parentWindow;
        throw b.createError("Cannot get a window object for node")
    }

    function v(a) {
        if (typeof a.contentDocument != c)return a.contentDocument;
        if (typeof a.contentWindow != c)return a.contentWindow.document;
        throw b.createError("getIframeDocument: No Document object found for iframe element")
    }

    function w(a) {
        if (typeof a.contentWindow != c)return a.contentWindow;
        if (typeof a.contentDocument != c)return a.contentDocument.defaultView;
        throw b.createError("getIframeWindow: No Window object found for iframe element")
    }

    function x(a) {
        return a && d.isHostMethod(a, "setTimeout") && d.isHostObject(a, "document")
    }

    function y(a, b, c) {
        var e;
        a ? d.isHostProperty(a, "nodeType") ? e = a.nodeType == 1 && a.tagName.toLowerCase() == "iframe" ? v(a) : t(a) : x(a) && (e = a.document) : e = document;
        if (!e)throw b.createError(c + "(): Parameter must be a Window object or DOM node");
        return e
    }

    function z(a) {
        var b;
        while (b = a.parentNode)a = b;
        return a
    }

    function A(a, c, d, e) {
        var f, g, h, i, k;
        if (a == d)return c === e ? 0 : c < e ? -1 : 1;
        if (f = o(d, a, !0))return c <= j(f) ? -1 : 1;
        if (f = o(a, d, !0))return j(f) < e ? -1 : 1;
        g = l(a, d);
        if (!g)throw new Error("comparePoints error: nodes have no common ancestor");
        h = a === g ? g : o(a, g, !0), i = d === g ? g : o(d, g, !0);
        if (h === i)throw b.createError("comparePoints got to case 4 and childA and childB are the same!");
        k = g.firstChild;
        while (k) {
            if (k === h)return -1;
            if (k === i)return 1;
            k = k.nextSibling
        }
    }

    function C(a) {
        try {
            return a.parentNode, !1
        } catch (b) {
            return !0
        }
    }

    function D(a) {
        if (!a)return "[No node]";
        if (B && C(a))return "[Broken node]";
        if (p(a))return '"' + a.data + '"';
        if (a.nodeType == 1) {
            var b = a.id ? ' id="' + a.id + '"' : "";
            return "<" + a.nodeName + b + ">[" + j(a) + "][" + a.childNodes.length + "][" + (a.innerHTML || "[innerHTML not supported]").slice(0, 25) + "]"
        }
        return a.nodeName
    }

    function E(a) {
        var b = t(a).createDocumentFragment(), c;
        while (c = a.firstChild)b.appendChild(c);
        return b
    }

    function G(a) {
        this.root = a, this._next = a
    }

    function H(a) {
        return new G(a)
    }

    function I(a, b) {
        this.node = a, this.offset = b
    }

    function J(a) {
        this.code = this[a], this.codeName = a, this.message = "DOMException: " + this.codeName
    }

    var c = "undefined", d = a.util;
    d.areHostMethods(document, ["createDocumentFragment", "createElement", "createTextNode"]) || b.fail("document missing a Node creation method"), d.isHostMethod(document, "getElementsByTagName") || b.fail("document missing getElementsByTagName method");
    var e = document.createElement("div");
    d.areHostMethods(e, ["insertBefore", "appendChild", "cloneNode"] || !d.areHostObjects(e, ["previousSibling", "nextSibling", "childNodes", "parentNode"])) || b.fail("Incomplete Element implementation"), d.isHostProperty(e, "innerHTML") || b.fail("Element is missing innerHTML property");
    var f = document.createTextNode("test");
    d.areHostMethods(f, ["splitText", "deleteData", "insertData", "appendData", "cloneNode"] || !d.areHostObjects(e, ["previousSibling", "nextSibling", "childNodes", "parentNode"]) || !d.areHostProperties(f, ["data"])) || b.fail("Incomplete Text Node implementation");
    var g = function (a, b) {
        var c = a.length;
        while (c--)if (a[c] === b)return !0;
        return !1
    }, B = !1;
    (function () {
        var b = document.createElement("b");
        b.innerHTML = "1";
        var c = b.firstChild;
        b.innerHTML = "<br>", B = C(c), a.features.crashyTextNodes = B
    })();
    var F;
    typeof window.getComputedStyle != c ? F = function (a, b) {
        return u(a).getComputedStyle(a, null)[b]
    } : typeof document.documentElement.currentStyle != c ? F = function (a, b) {
        return a.currentStyle[b]
    } : b.fail("No means of obtaining computed style properties found"), G.prototype = {
        _current: null,
        hasNext: function () {
            return !!this._next
        },
        next: function () {
            var a = this._current = this._next, b, c;
            if (this._current) {
                b = a.firstChild;
                if (b)this._next = b; else {
                    c = null;
                    while (a !== this.root && !(c = a.nextSibling))a = a.parentNode;
                    this._next = c
                }
            }
            return this._current
        },
        detach: function () {
            this._current = this._next = this.root = null
        }
    }, I.prototype = {
        equals: function (a) {
            return !!a && this.node === a.node && this.offset == a.offset
        }, inspect: function () {
            return "[DomPosition(" + D(this.node) + ":" + this.offset + ")]"
        }, toString: function () {
            return this.inspect()
        }
    }, J.prototype = {
        INDEX_SIZE_ERR: 1,
        HIERARCHY_REQUEST_ERR: 3,
        WRONG_DOCUMENT_ERR: 4,
        NO_MODIFICATION_ALLOWED_ERR: 7,
        NOT_FOUND_ERR: 8,
        NOT_SUPPORTED_ERR: 9,
        INVALID_STATE_ERR: 11
    }, J.prototype.toString = function () {
        return this.message
    }, a.dom = {
        arrayContains: g,
        isHtmlNamespace: h,
        parentElement: i,
        getNodeIndex: j,
        getNodeLength: k,
        getCommonAncestor: l,
        isAncestorOf: m,
        isOrIsAncestorOf: n,
        getClosestAncestorIn: o,
        isCharacterDataNode: p,
        isTextOrCommentNode: q,
        insertAfter: r,
        splitDataNode: s,
        getDocument: t,
        getWindow: u,
        getIframeWindow: w,
        getIframeDocument: v,
        getBody: d.getBody,
        isWindow: x,
        getContentDocument: y,
        getRootContainer: z,
        comparePoints: A,
        isBrokenNode: C,
        inspectNode: D,
        getComputedStyleProperty: F,
        fragmentFromNodeChildren: E,
        createIterator: H,
        DomPosition: I
    }, a.DOMException = J
}), rangy.createCoreModule("DomRange", ["DomUtil"], function (a, b) {
    function r(a, b) {
        return a.nodeType != 3 && (i(a, b.startContainer) || i(a, b.endContainer))
    }

    function s(a) {
        return a.document || j(a.startContainer)
    }

    function t(a) {
        return new e(a.parentNode, h(a))
    }

    function u(a) {
        return new e(a.parentNode, h(a) + 1)
    }

    function v(a, b, d) {
        var e = a.nodeType == 11 ? a.firstChild : a;
        return g(b) ? d == b.length ? c.insertAfter(a, b) : b.parentNode.insertBefore(a, d == 0 ? b : l(b, d)) : d >= b.childNodes.length ? b.appendChild(a) : b.insertBefore(a, b.childNodes[d]), e
    }

    function w(a, b, c) {
        Y(a), Y(b);
        if (s(b) != s(a))throw new f("WRONG_DOCUMENT_ERR");
        var d = k(a.startContainer, a.startOffset, b.endContainer, b.endOffset), e = k(a.endContainer, a.endOffset, b.startContainer, b.startOffset);
        return c ? d <= 0 && e >= 0 : d < 0 && e > 0
    }

    function x(a) {
        var b;
        for (var c, d = s(a.range).createDocumentFragment(), e; c = a.next();) {
            b = a.isPartiallySelectedSubtree(), c = c.cloneNode(!b), b && (e = a.getSubtreeIterator(), c.appendChild(x(e)), e.detach(!0));
            if (c.nodeType == 10)throw new f("HIERARCHY_REQUEST_ERR");
            d.appendChild(c)
        }
        return d
    }

    function y(a, b, d) {
        var e, f;
        d = d || {stop: !1};
        for (var g, h; g = a.next();)if (a.isPartiallySelectedSubtree()) {
            if (b(g) === !1) {
                d.stop = !0;
                return
            }
            h = a.getSubtreeIterator(), y(h, b, d), h.detach(!0);
            if (d.stop)return
        } else {
            e = c.createIterator(g);
            while (f = e.next())if (b(f) === !1) {
                d.stop = !0;
                return
            }
        }
    }

    function z(a) {
        var b;
        while (a.next())a.isPartiallySelectedSubtree() ? (b = a.getSubtreeIterator(), z(b), b.detach(!0)) : a.remove()
    }

    function A(a) {
        for (var b, c = s(a.range).createDocumentFragment(), d; b = a.next();) {
            a.isPartiallySelectedSubtree() ? (b = b.cloneNode(!1), d = a.getSubtreeIterator(), b.appendChild(A(d)), d.detach(!0)) : a.remove();
            if (b.nodeType == 10)throw new f("HIERARCHY_REQUEST_ERR");
            c.appendChild(b)
        }
        return c
    }

    function B(a, b, c) {
        var d = !!b && !!b.length, e, f = !!c;
        d && (e = new RegExp("^(" + b.join("|") + ")$"));
        var h = [];
        return y(new D(a, !1), function (b) {
            if (d && !e.test(b.nodeType))return;
            if (f && !c(b))return;
            var i = a.startContainer;
            if (b == i && g(i) && a.startOffset == i.length)return;
            var j = a.endContainer;
            if (b == j && g(j) && a.endOffset == 0)return;
            h.push(b)
        }), h
    }

    function C(a) {
        var b = typeof a.getName == "undefined" ? "Range" : a.getName();
        return "[" + b + "(" + c.inspectNode(a.startContainer) + ":" + a.startOffset + ", " + c.inspectNode(a.endContainer) + ":" + a.endOffset + ")]"
    }

    function D(a, b) {
        this.range = a, this.clonePartiallySelectedTextNodes = b;
        if (!a.collapsed) {
            this.sc = a.startContainer, this.so = a.startOffset, this.ec = a.endContainer, this.eo = a.endOffset;
            var c = a.commonAncestorContainer;
            this.sc === this.ec && g(this.sc) ? (this.isSingleCharacterDataNode = !0, this._first = this._last = this._next = this.sc) : (this._first = this._next = this.sc === c && !g(this.sc) ? this.sc.childNodes[this.so] : m(this.sc, c, !0), this._last = this.ec === c && !g(this.ec) ? this.ec.childNodes[this.eo - 1] : m(this.ec, c, !0))
        }
    }

    function E(a) {
        this.code = this[a], this.codeName = a, this.message = "RangeException: " + this.codeName
    }

    function K(a) {
        return function (b, c) {
            var d, e = c ? b : b.parentNode;
            while (e) {
                d = e.nodeType;
                if (o(a, d))return e;
                e = e.parentNode
            }
            return null
        }
    }

    function O(a, b) {
        if (N(a, b))throw new E("INVALID_NODE_TYPE_ERR")
    }

    function P(a) {
        if (!a.startContainer)throw new f("INVALID_STATE_ERR")
    }

    function Q(a, b) {
        if (!o(b, a.nodeType))throw new E("INVALID_NODE_TYPE_ERR")
    }

    function R(a, b) {
        if (b < 0 || b > (g(a) ? a.length : a.childNodes.length))throw new f("INDEX_SIZE_ERR")
    }

    function S(a, b) {
        if (L(a, !0) !== L(b, !0))throw new f("WRONG_DOCUMENT_ERR")
    }

    function T(a) {
        if (M(a, !0))throw new f("NO_MODIFICATION_ALLOWED_ERR")
    }

    function U(a, b) {
        if (!a)throw new f(b)
    }

    function V(a) {
        return q && c.isBrokenNode(a) || !o(G, a.nodeType) && !L(a, !0)
    }

    function W(a, b) {
        return b <= (g(a) ? a.length : a.childNodes.length)
    }

    function X(a) {
        return !!a.startContainer && !!a.endContainer && !V(a.startContainer) && !V(a.endContainer) && W(a.startContainer, a.startOffset) && W(a.endContainer, a.endOffset)
    }

    function Y(a) {
        P(a);
        if (!X(a))throw new Error("Range error: Range is no longer valid after DOM mutation (" + a.inspect() + ")")
    }

    function bb(a, b) {
        Y(a);
        var c = a.startContainer, d = a.startOffset, e = a.endContainer, f = a.endOffset, i = c === e;
        g(e) && f > 0 && f < e.length && l(e, f, b), g(c) && d > 0 && d < c.length && (c = l(c, d, b), i ? (f -= d, e = c) : e == c.parentNode && f >= h(c) && f++, d = 0), a.setStartAndEnd(c, d, e, f)
    }

    function lb(a) {
        a.START_TO_START = db, a.START_TO_END = eb, a.END_TO_END = fb, a.END_TO_START = gb, a.NODE_BEFORE = hb, a.NODE_AFTER = ib, a.NODE_BEFORE_AND_AFTER = jb, a.NODE_INSIDE = kb
    }

    function mb(a) {
        lb(a), lb(a.prototype)
    }

    function nb(a, b) {
        return function () {
            Y(this);
            var c = this.startContainer, d = this.startOffset, e = this.commonAncestorContainer, f = new D(this, !0), g, h;
            c !== e && (g = m(c, e, !0), h = u(g), c = h.node, d = h.offset), y(f, T), f.reset();
            var i = a(f);
            return f.detach(), b(this, c, d, c, d), i
        }
    }

    function ob(b, c, e) {
        function f(a, b) {
            return function (c) {
                P(this), Q(c, F), Q(p(c), G);
                var d = (a ? t : u)(c);
                (b ? i : j)(this, d.node, d.offset)
            }
        }

        function i(a, b, d) {
            var e = a.endContainer, f = a.endOffset;
            if (b !== a.startContainer || d !== a.startOffset) {
                if (p(b) != p(e) || k(b, d, e, f) == 1)e = b, f = d;
                c(a, b, d, e, f)
            }
        }

        function j(a, b, d) {
            var e = a.startContainer, f = a.startOffset;
            if (b !== a.endContainer || d !== a.endOffset) {
                if (p(b) != p(e) || k(b, d, e, f) == -1)e = b, f = d;
                c(a, e, f, b, d)
            }
        }

        var l = function () {
        };
        l.prototype = a.rangePrototype, b.prototype = new l, d.extend(b.prototype, {
            setStart: function (a, b) {
                P(this), O(a, !0), R(a, b), i(this, a, b)
            },
            setEnd: function (a, b) {
                P(this), O(a, !0), R(a, b), j(this, a, b)
            },
            setStartAndEnd: function () {
                P(this);
                var a = arguments, b = a[0], d = a[1], e = b, f = d;
                switch (a.length) {
                    case 3:
                        f = a[2];
                        break;
                    case 4:
                        e = a[2], f = a[3]
                }
                c(this, b, d, e, f)
            },
            setBoundary: function (a, b, c) {
                this["set" + (c ? "Start" : "End")](a, b)
            },
            setStartBefore: f(!0, !0),
            setStartAfter: f(!1, !0),
            setEndBefore: f(!0, !1),
            setEndAfter: f(!1, !1),
            collapse: function (a) {
                Y(this), a ? c(this, this.startContainer, this.startOffset, this.startContainer, this.startOffset) : c(this, this.endContainer, this.endOffset, this.endContainer, this.endOffset)
            },
            selectNodeContents: function (a) {
                P(this), O(a, !0), c(this, a, 0, a, n(a))
            },
            selectNode: function (a) {
                P(this), O(a, !1), Q(a, F);
                var b = t(a), d = u(a);
                c(this, b.node, b.offset, d.node, d.offset)
            },
            extractContents: nb(A, c),
            deleteContents: nb(z, c),
            canSurroundContents: function () {
                Y(this), T(this.startContainer), T(this.endContainer);
                var a = new D(this, !0), b = a._first && r(a._first, this) || a._last && r(a._last, this);
                return a.detach(), !b
            },
            detach: function () {
                e(this)
            },
            splitBoundaries: function () {
                bb(this)
            },
            splitBoundariesPreservingPositions: function (a) {
                bb(this, a)
            },
            normalizeBoundaries: function () {
                Y(this);
                var a = this.startContainer, b = this.startOffset, d = this.endContainer, e = this.endOffset, f = function (a) {
                    var b = a.nextSibling;
                    b && b.nodeType == a.nodeType && (d = a, e = a.length, a.appendData(b.data), b.parentNode.removeChild(b))
                }, i = function (c) {
                    var f = c.previousSibling;
                    if (f && f.nodeType == c.nodeType) {
                        a = c;
                        var g = c.length;
                        b = f.length, c.insertData(0, f.data), f.parentNode.removeChild(f);
                        if (a == d)e += b, d = a; else if (d == c.parentNode) {
                            var i = h(c);
                            e == i ? (d = c, e = g) : e > i && e--
                        }
                    }
                }, j = !0;
                if (g(d))d.length == e && f(d); else {
                    if (e > 0) {
                        var k = d.childNodes[e - 1];
                        k && g(k) && f(k)
                    }
                    j = !this.collapsed
                }
                if (j) {
                    if (g(a))b == 0 && i(a); else if (b < a.childNodes.length) {
                        var l = a.childNodes[b];
                        l && g(l) && i(l)
                    }
                } else a = d, b = e;
                c(this, a, b, d, e)
            },
            collapseToPoint: function (a, b) {
                P(this), O(a, !0), R(a, b), this.setStartAndEnd(a, b)
            }
        }), mb(b)
    }

    function pb(a) {
        a.collapsed = a.startContainer === a.endContainer && a.startOffset === a.endOffset, a.commonAncestorContainer = a.collapsed ? a.startContainer : c.getCommonAncestor(a.startContainer, a.endContainer)
    }

    function qb(a, b, d, e, f) {
        a.startContainer = b, a.startOffset = d, a.endContainer = e, a.endOffset = f, a.document = c.getDocument(b), pb(a)
    }

    function rb(a) {
        P(a), a.startContainer = a.startOffset = a.endContainer = a.endOffset = a.document = null, a.collapsed = a.commonAncestorContainer = null
    }

    function sb(a) {
        this.startContainer = a, this.startOffset = 0, this.endContainer = a, this.endOffset = 0, this.document = a, pb(this)
    }

    var c = a.dom, d = a.util, e = c.DomPosition, f = a.DOMException, g = c.isCharacterDataNode, h = c.getNodeIndex, i = c.isOrIsAncestorOf, j = c.getDocument, k = c.comparePoints, l = c.splitDataNode, m = c.getClosestAncestorIn, n = c.getNodeLength, o = c.arrayContains, p = c.getRootContainer, q = a.features.crashyTextNodes;
    D.prototype = {
        _current: null,
        _next: null,
        _first: null,
        _last: null,
        isSingleCharacterDataNode: !1,
        reset: function () {
            this._current = null, this._next = this._first
        },
        hasNext: function () {
            return !!this._next
        },
        next: function () {
            var a = this._current = this._next;
            return a && (this._next = a !== this._last ? a.nextSibling : null, g(a) && this.clonePartiallySelectedTextNodes && (a === this.ec && (a = a.cloneNode(!0)).deleteData(this.eo, a.length - this.eo), this._current === this.sc && (a = a.cloneNode(!0)).deleteData(0, this.so))), a
        },
        remove: function () {
            var a = this._current, b, c;
            !g(a) || a !== this.sc && a !== this.ec ? a.parentNode && a.parentNode.removeChild(a) : (b = a === this.sc ? this.so : 0, c = a === this.ec ? this.eo : a.length, b != c && a.deleteData(b, c - b))
        },
        isPartiallySelectedSubtree: function () {
            var a = this._current;
            return r(a, this.range)
        },
        getSubtreeIterator: function () {
            var a;
            if (this.isSingleCharacterDataNode)a = this.range.cloneRange(), a.collapse(!1); else {
                a = new sb(s(this.range));
                var b = this._current, c = b, d = 0, e = b, f = n(b);
                i(b, this.sc) && (c = this.sc, d = this.so), i(b, this.ec) && (e = this.ec, f = this.eo), qb(a, c, d, e, f)
            }
            return new D(a, this.clonePartiallySelectedTextNodes)
        },
        detach: function (a) {
            a && this.range.detach(), this.range = this._current = this._next = this._first = this._last = this.sc = this.so = this.ec = this.eo = null
        }
    }, E.prototype = {BAD_BOUNDARYPOINTS_ERR: 1, INVALID_NODE_TYPE_ERR: 2}, E.prototype.toString = function () {
        return this.message
    };
    var F = [1, 3, 4, 5, 7, 8, 10], G = [2, 9, 11], H = [5, 6, 10, 12], I = [1, 3, 4, 5, 7, 8, 10, 11], J = [1, 3, 4, 5, 7, 8], L = K([9, 11]), M = K(H), N = K([6, 10, 12]), Z = document.createElement("style"), $ = !1;
    try {
        Z.innerHTML = "<b>x</b>", $ = Z.firstChild.nodeType == 3
    } catch (_) {
    }
    a.features.htmlParsingConforms = $;
    var ab = $ ? function (a) {
        var b = this.startContainer, d = j(b);
        if (!b)throw new f("INVALID_STATE_ERR");
        var e = null;
        return b.nodeType == 1 ? e = b : g(b) && (e = c.parentElement(b)), e === null || e.nodeName == "HTML" && c.isHtmlNamespace(j(e).documentElement) && c.isHtmlNamespace(e) ? e = d.createElement("body") : e = e.cloneNode(!1), e.innerHTML = a, c.fragmentFromNodeChildren(e)
    } : function (a) {
        P(this);
        var b = s(this), d = b.createElement("body");
        return d.innerHTML = a, c.fragmentFromNodeChildren(d)
    }, cb = ["startContainer", "startOffset", "endContainer", "endOffset", "collapsed", "commonAncestorContainer"], db = 0, eb = 1, fb = 2, gb = 3, hb = 0, ib = 1, jb = 2, kb = 3;
    d.extend(a.rangePrototype, {
        compareBoundaryPoints: function (a, b) {
            Y(this), S(this.startContainer, b.startContainer);
            var c, d, e, f, g = a == gb || a == db ? "start" : "end", h = a == eb || a == db ? "start" : "end";
            return c = this[g + "Container"], d = this[g + "Offset"], e = b[h + "Container"], f = b[h + "Offset"], k(c, d, e, f)
        }, insertNode: function (a) {
            Y(this), Q(a, I), T(this.startContainer);
            if (i(a, this.startContainer))throw new f("HIERARCHY_REQUEST_ERR");
            var b = v(a, this.startContainer, this.startOffset);
            this.setStartBefore(b)
        }, cloneContents: function () {
            Y(this);
            var a, b;
            if (this.collapsed)return s(this).createDocumentFragment();
            if (this.startContainer === this.endContainer && g(this.startContainer))return a = this.startContainer.cloneNode(!0), a.data = a.data.slice(this.startOffset, this.endOffset), b = s(this).createDocumentFragment(), b.appendChild(a), b;
            var c = new D(this, !0);
            return a = x(c), c.detach(), a
        }, canSurroundContents: function () {
            Y(this), T(this.startContainer), T(this.endContainer);
            var a = new D(this, !0), b = a._first && r(a._first, this) || a._last && r(a._last, this);
            return a.detach(), !b
        }, surroundContents: function (a) {
            Q(a, J);
            if (!this.canSurroundContents())throw new E("BAD_BOUNDARYPOINTS_ERR");
            var b = this.extractContents();
            if (a.hasChildNodes())while (a.lastChild)a.removeChild(a.lastChild);
            v(a, this.startContainer, this.startOffset), a.appendChild(b), this.selectNode(a)
        }, cloneRange: function () {
            Y(this);
            var a = new sb(s(this)), b = cb.length, c;
            while (b--)c = cb[b], a[c] = this[c];
            return a
        }, toString: function () {
            Y(this);
            var a = this.startContainer;
            if (a === this.endContainer && g(a))return a.nodeType == 3 || a.nodeType == 4 ? a.data.slice(this.startOffset, this.endOffset) : "";
            var b = [], c = new D(this, !0);
            return y(c, function (a) {
                (a.nodeType == 3 || a.nodeType == 4) && b.push(a.data)
            }), c.detach(), b.join("")
        }, compareNode: function (a) {
            Y(this);
            var b = a.parentNode, c = h(a);
            if (!b)throw new f("NOT_FOUND_ERR");
            var d = this.comparePoint(b, c), e = this.comparePoint(b, c + 1);
            return d < 0 ? e > 0 ? jb : hb : e > 0 ? ib : kb
        }, comparePoint: function (a, b) {
            return Y(this), U(a, "HIERARCHY_REQUEST_ERR"), S(a, this.startContainer), k(a, b, this.startContainer, this.startOffset) < 0 ? -1 : k(a, b, this.endContainer, this.endOffset) > 0 ? 1 : 0
        }, createContextualFragment: ab, toHtml: function () {
            Y(this);
            var a = this.commonAncestorContainer.parentNode.cloneNode(!1);
            return a.appendChild(this.cloneContents()), a.innerHTML
        }, intersectsNode: function (a, b) {
            Y(this), U(a, "NOT_FOUND_ERR");
            if (j(a) !== s(this))return !1;
            var c = a.parentNode, d = h(a);
            U(c, "NOT_FOUND_ERR");
            var e = k(c, d, this.endContainer, this.endOffset), f = k(c, d + 1, this.startContainer, this.startOffset);
            return b ? e <= 0 && f >= 0 : e < 0 && f > 0
        }, isPointInRange: function (a, b) {
            return Y(this), U(a, "HIERARCHY_REQUEST_ERR"), S(a, this.startContainer), k(a, b, this.startContainer, this.startOffset) >= 0 && k(a, b, this.endContainer, this.endOffset) <= 0
        }, intersectsRange: function (a) {
            return w(this, a, !1)
        }, intersectsOrTouchesRange: function (a) {
            return w(this, a, !0)
        }, intersection: function (a) {
            if (this.intersectsRange(a)) {
                var b = k(this.startContainer, this.startOffset, a.startContainer, a.startOffset), c = k(this.endContainer, this.endOffset, a.endContainer, a.endOffset), d = this.cloneRange();
                return b == -1 && d.setStart(a.startContainer, a.startOffset), c == 1 && d.setEnd(a.endContainer, a.endOffset), d
            }
            return null
        }, union: function (a) {
            if (this.intersectsOrTouchesRange(a)) {
                var b = this.cloneRange();
                return k(a.startContainer, a.startOffset, this.startContainer, this.startOffset) == -1 && b.setStart(a.startContainer, a.startOffset), k(a.endContainer, a.endOffset, this.endContainer, this.endOffset) == 1 && b.setEnd(a.endContainer, a.endOffset), b
            }
            throw new E("Ranges do not intersect")
        }, containsNode: function (a, b) {
            return b ? this.intersectsNode(a, !1) : this.compareNode(a) == kb
        }, containsNodeContents: function (a) {
            return this.comparePoint(a, 0) >= 0 && this.comparePoint(a, n(a)) <= 0
        }, containsRange: function (a) {
            var b = this.intersection(a);
            return b !== null && a.equals(b)
        }, containsNodeText: function (a) {
            var b = this.cloneRange();
            b.selectNode(a);
            var c = b.getNodes([3]);
            if (c.length > 0) {
                b.setStart(c[0], 0);
                var d = c.pop();
                b.setEnd(d, d.length);
                var e = this.containsRange(b);
                return b.detach(), e
            }
            return this.containsNodeContents(a)
        }, getNodes: function (a, b) {
            return Y(this), B(this, a, b)
        }, getDocument: function () {
            return s(this)
        }, collapseBefore: function (a) {
            P(this), this.setEndBefore(a), this.collapse(!1)
        }, collapseAfter: function (a) {
            P(this), this.setStartAfter(a), this.collapse(!0)
        }, getBookmark: function (b) {
            var d = s(this), e = a.createRange(d);
            b = b || c.getBody(d), e.selectNodeContents(b);
            var f = this.intersection(e), g = 0, h = 0;
            return f && (e.setEnd(f.startContainer, f.startOffset), g = e.toString().length, h = g + f.toString().length, e.detach()), {
                start: g,
                end: h,
                containerNode: b
            }
        }, moveToBookmark: function (a) {
            var b = a.containerNode, c = 0;
            this.setStart(b, 0), this.collapse(!0);
            var d = [b], e, f = !1, g = !1, h, i, j;
            while (!g && (e = d.pop()))if (e.nodeType == 3)h = c + e.length, !f && a.start >= c && a.start <= h && (this.setStart(e, a.start - c), f = !0), f && a.end >= c && a.end <= h && (this.setEnd(e, a.end - c), g = !0), c = h; else {
                j = e.childNodes, i = j.length;
                while (i--)d.push(j[i])
            }
        }, getName: function () {
            return "DomRange"
        }, equals: function (a) {
            return sb.rangesEqual(this, a)
        }, isValid: function () {
            return X(this)
        }, inspect: function () {
            return C(this)
        }
    }), ob(sb, qb, rb), d.extend(sb, {
        rangeProperties: cb,
        RangeIterator: D,
        copyComparisonConstants: mb,
        createPrototypeRange: ob,
        inspect: C,
        getRangeDocument: s,
        rangesEqual: function (a, b) {
            return a.startContainer === b.startContainer && a.startOffset === b.startOffset && a.endContainer === b.endContainer && a.endOffset === b.endOffset
        }
    }), a.DomRange = sb, a.RangeException = E
}), rangy.createCoreModule("WrappedRange", ["DomRange"], function (a, b) {
    var c, d, e = a.dom, f = a.util, g = e.DomPosition, h = a.DomRange, i = e.getBody, j = e.getContentDocument, k = e.isCharacterDataNode;
    a.features.implementsDomRange && function () {
        function k(a) {
            var b = g.length, c;
            while (b--)c = g[b], a[c] = a.nativeRange[c];
            a.collapsed = a.startContainer === a.endContainer && a.startOffset === a.endOffset
        }

        function l(a, b, c, d, e) {
            var f = a.startContainer !== b || a.startOffset != c, g = a.endContainer !== d || a.endOffset != e, h = !a.equals(a.nativeRange);
            if (f || g || h)a.setEnd(d, e), a.setStart(b, c)
        }

        function m(a) {
            a.nativeRange.detach(), a.detached = !0;
            var b = g.length;
            while (b--)a[g[b]] = null
        }

        var d, g = h.rangeProperties, n;
        c = function (a) {
            if (!a)throw b.createError("WrappedRange: Range must be specified");
            this.nativeRange = a, k(this)
        }, h.createPrototypeRange(c, l, m), d = c.prototype, d.selectNode = function (a) {
            this.nativeRange.selectNode(a), k(this)
        }, d.cloneContents = function () {
            return this.nativeRange.cloneContents()
        }, d.surroundContents = function (a) {
            this.nativeRange.surroundContents(a), k(this)
        }, d.collapse = function (a) {
            this.nativeRange.collapse(a), k(this)
        }, d.cloneRange = function () {
            return new c(this.nativeRange.cloneRange())
        }, d.refresh = function () {
            k(this)
        }, d.toString = function () {
            return this.nativeRange.toString()
        };
        var o = document.createTextNode("test");
        i(document).appendChild(o);
        var p = document.createRange();
        p.setStart(o, 0), p.setEnd(o, 0);
        try {
            p.setStart(o, 1), d.setStart = function (a, b) {
                this.nativeRange.setStart(a, b), k(this)
            }, d.setEnd = function (a, b) {
                this.nativeRange.setEnd(a, b), k(this)
            }, n = function (a) {
                return function (b) {
                    this.nativeRange[a](b), k(this)
                }
            }
        } catch (q) {
            d.setStart = function (a, b) {
                try {
                    this.nativeRange.setStart(a, b)
                } catch (c) {
                    this.nativeRange.setEnd(a, b), this.nativeRange.setStart(a, b)
                }
                k(this)
            }, d.setEnd = function (a, b) {
                try {
                    this.nativeRange.setEnd(a, b)
                } catch (c) {
                    this.nativeRange.setStart(a, b), this.nativeRange.setEnd(a, b)
                }
                k(this)
            }, n = function (a, b) {
                return function (c) {
                    try {
                        this.nativeRange[a](c)
                    } catch (d) {
                        this.nativeRange[b](c), this.nativeRange[a](c)
                    }
                    k(this)
                }
            }
        }
        d.setStartBefore = n("setStartBefore", "setEndBefore"), d.setStartAfter = n("setStartAfter", "setEndAfter"), d.setEndBefore = n("setEndBefore", "setStartBefore"), d.setEndAfter = n("setEndAfter", "setStartAfter"), d.selectNodeContents = function (a) {
            this.setStartAndEnd(a, 0, e.getNodeLength(a))
        }, p.selectNodeContents(o), p.setEnd(o, 3);
        var r = document.createRange();
        r.selectNodeContents(o), r.setEnd(o, 4), r.setStart(o, 2), p.compareBoundaryPoints(p.START_TO_END, r) == -1 && p.compareBoundaryPoints(p.END_TO_START, r) == 1 ? d.compareBoundaryPoints = function (a, b) {
            return b = b.nativeRange || b, a == b.START_TO_END ? a = b.END_TO_START : a == b.END_TO_START && (a = b.START_TO_END), this.nativeRange.compareBoundaryPoints(a, b)
        } : d.compareBoundaryPoints = function (a, b) {
            return this.nativeRange.compareBoundaryPoints(a, b.nativeRange || b)
        };
        var s = document.createElement("div");
        s.innerHTML = "123";
        var t = s.firstChild, u = i(document);
        u.appendChild(s), p.setStart(t, 1), p.setEnd(t, 2), p.deleteContents(), t.data == "13" && (d.deleteContents = function () {
            this.nativeRange.deleteContents(), k(this)
        }, d.extractContents = function () {
            var a = this.nativeRange.extractContents();
            return k(this), a
        }), u.removeChild(s), u = null, f.isHostMethod(p, "createContextualFragment") && (d.createContextualFragment = function (a) {
            return this.nativeRange.createContextualFragment(a)
        }), i(document).removeChild(o), p.detach(), r.detach(), d.getName = function () {
            return "WrappedRange"
        }, a.WrappedRange = c, a.createNativeRange = function (a) {
            return a = j(a, b, "createNativeRange"), a.createRange()
        }
    }();
    if (a.features.implementsTextRange) {
        var l = function (a) {
            var b = a.parentElement(), c = a.duplicate();
            c.collapse(!0);
            var d = c.parentElement();
            c = a.duplicate(), c.collapse(!1);
            var f = c.parentElement(), g = d == f ? d : e.getCommonAncestor(d, f);
            return g == b ? g : e.getCommonAncestor(b, g)
        }, m = function (a) {
            return a.compareEndPoints("StartToEnd", a) == 0
        }, n = function (a, b, c, d, f) {
            var h = a.duplicate();
            h.collapse(c);
            var i = h.parentElement();
            e.isOrIsAncestorOf(b, i) || (i = b);
            if (!i.canHaveHTML) {
                var j = new g(i.parentNode, e.getNodeIndex(i));
                return {boundaryPosition: j, nodeInfo: {nodeIndex: j.offset, containerElement: j.node}}
            }
            var l = e.getDocument(i).createElement("span");
            l.parentNode && l.parentNode.removeChild(l);
            var m, n = c ? "StartToStart" : "StartToEnd", o, p, q, r, s = f && f.containerElement == i ? f.nodeIndex : 0, t = i.childNodes.length, u = t, v = u;
            for (; ;) {
                v == t ? i.appendChild(l) : i.insertBefore(l, i.childNodes[v]), h.moveToElementText(l), m = h.compareEndPoints(n, a);
                if (m == 0 || s == u)break;
                if (m == -1) {
                    if (u == s + 1)break;
                    s = v
                } else u = u == s + 1 ? s : v;
                v = Math.floor((s + u) / 2), i.removeChild(l)
            }
            r = l.nextSibling;
            if (m == -1 && r && k(r)) {
                h.setEndPoint(c ? "EndToStart" : "EndToEnd", a);
                var w;
                if (/[\r\n]/.test(r.data)) {
                    var x = h.duplicate(), y = x.text.replace(/\r\n/g, "\r").length;
                    w = x.moveStart("character", y);
                    while ((m = x.compareEndPoints("StartToEnd", x)) == -1)w++, x.moveStart("character", 1)
                } else w = h.text.length;
                q = new g(r, w)
            } else o = (d || !c) && l.previousSibling, p = (d || c) && l.nextSibling, p && k(p) ? q = new g(p, 0) : o && k(o) ? q = new g(o, o.data.length) : q = new g(i, e.getNodeIndex(l));
            return l.parentNode.removeChild(l), {boundaryPosition: q, nodeInfo: {nodeIndex: v, containerElement: i}}
        }, o = function (a, b) {
            var c, d, f = a.offset, g = e.getDocument(a.node), h, j, l = i(g).createTextRange(), m = k(a.node);
            return m ? (c = a.node, d = c.parentNode) : (j = a.node.childNodes, c = f < j.length ? j[f] : null, d = a.node), h = g.createElement("span"), h.innerHTML = "&#feff;", c ? d.insertBefore(h, c) : d.appendChild(h), l.moveToElementText(h), l.collapse(!b), d.removeChild(h), m && l[b ? "moveStart" : "moveEnd"]("character", f), l
        };
        d = function (a) {
            this.textRange = a, this.refresh()
        }, d.prototype = new h(document), d.prototype.refresh = function () {
            var a, b, c, d = l(this.textRange);
            m(this.textRange) ? b = a = n(this.textRange, d, !0, !0).boundaryPosition : (c = n(this.textRange, d, !0, !1), a = c.boundaryPosition, b = n(this.textRange, d, !1, !1, c.nodeInfo).boundaryPosition), this.setStart(a.node, a.offset), this.setEnd(b.node, b.offset)
        }, d.prototype.getName = function () {
            return "WrappedTextRange"
        }, h.copyComparisonConstants(d), d.rangeToTextRange = function (a) {
            if (a.collapsed)return o(new g(a.startContainer, a.startOffset), !0);
            var b = o(new g(a.startContainer, a.startOffset), !0), c = o(new g(a.endContainer, a.endOffset), !1), d = i(h.getRangeDocument(a)).createTextRange();
            return d.setEndPoint("StartToStart", b), d.setEndPoint("EndToEnd", c), d
        }, a.WrappedTextRange = d;
        if (!a.features.implementsDomRange || a.config.preferTextRange) {
            var p = function () {
                return this
            }();
            typeof p.Range == "undefined" && (p.Range = d), a.createNativeRange = function (a) {
                return a = j(a, b, "createNativeRange"), i(a).createTextRange()
            }, a.WrappedRange = d
        }
    }
    a.createRange = function (c) {
        return c = j(c, b, "createRange"), new a.WrappedRange(a.createNativeRange(c))
    }, a.createRangyRange = function (a) {
        return a = j(a, b, "createRangyRange"), new h(a)
    }, a.createIframeRange = function (c) {
        return b.deprecationNotice("createIframeRange()", "createRange(iframeEl)"), a.createRange(c)
    }, a.createIframeRangyRange = function (c) {
        return b.deprecationNotice("createIframeRangyRange()", "createRangyRange(iframeEl)"), a.createRangyRange(c)
    }, a.addCreateMissingNativeApiListener(function (b) {
        var c = b.document;
        typeof c.createRange == "undefined" && (c.createRange = function () {
            return a.createRange(c)
        }), c = b = null
    })
}), rangy.createCoreModule("WrappedSelection", ["DomRange", "WrappedRange"], function (a, b) {
    function s(a) {
        return typeof a == "string" ? /^backward(s)?$/i.test(a) : !!a
    }

    function t(a, c) {
        if (!a)return window;
        if (e.isWindow(a))return a;
        if (a instanceof W)return a.win;
        var d = e.getContentDocument(a, b, c);
        return e.getWindow(d)
    }

    function u(a) {
        return t(a, "getWinSelection").getSelection()
    }

    function v(a) {
        return t(a, "getDocSelection").document.selection
    }

    function w(a) {
        var b = !1;
        return a.anchorNode && (b = e.comparePoints(a.anchorNode, a.anchorOffset, a.focusNode, a.focusOffset) == 1), b
    }

    function L(a, b, c) {
        var d = c ? "end" : "start", e = c ? "start" : "end";
        a.anchorNode = b[d + "Container"], a.anchorOffset = b[d + "Offset"], a.focusNode = b[e + "Container"], a.focusOffset = b[e + "Offset"]
    }

    function M(a) {
        var b = a.nativeSelection;
        a.anchorNode = b.anchorNode, a.anchorOffset = b.anchorOffset, a.focusNode = b.focusNode, a.focusOffset = b.focusOffset
    }

    function N(a) {
        a.anchorNode = a.focusNode = null, a.anchorOffset = a.focusOffset = 0, a.rangeCount = 0, a.isCollapsed = !0, a._ranges.length = 0
    }

    function O(b) {
        var c;
        return b instanceof h ? (c = a.createNativeRange(b.getDocument()), c.setEnd(b.endContainer, b.endOffset), c.setStart(b.startContainer, b.startOffset)) : b instanceof i ? c = b.nativeRange : n.implementsDomRange && b instanceof e.getWindow(b.startContainer).Range && (c = b), c
    }

    function P(a) {
        if (!a.length || a[0].nodeType != 1)return !1;
        for (var b = 1, c = a.length; b < c; ++b)if (!e.isAncestorOf(a[0], a[b]))return !1;
        return !0
    }

    function Q(a) {
        var c = a.getNodes();
        if (!P(c))throw b.createError("getSingleElementFromRange: range " + a.inspect() + " did not consist of a single element");
        return c[0]
    }

    function R(a) {
        return !!a && typeof a.text != "undefined"
    }

    function S(a, b) {
        var c = new i(b);
        a._ranges = [c], L(a, c, !1), a.rangeCount = 1, a.isCollapsed = c.collapsed
    }

    function T(b) {
        b._ranges.length = 0;
        if (b.docSelection.type == "None")N(b); else {
            var c = b.docSelection.createRange();
            if (R(c))S(b, c); else {
                b.rangeCount = c.length;
                var d, e = p(c.item(0));
                for (var f = 0; f < b.rangeCount; ++f)d = a.createRange(e), d.selectNode(c.item(f)), b._ranges.push(d);
                b.isCollapsed = b.rangeCount == 1 && b._ranges[0].collapsed, L(b, b._ranges[b.rangeCount - 1], !1)
            }
        }
    }

    function U(a, c) {
        var d = a.docSelection.createRange(), e = Q(c), f = p(d.item(0)), g = q(f).createControlRange();
        for (var h = 0, i = d.length; h < i; ++h)g.add(d.item(h));
        try {
            g.add(e)
        } catch (j) {
            throw b.createError("addRange(): Element within the specified Range could not be added to control selection (does it have layout?)")
        }
        g.select(), T(a)
    }

    function W(a, b, c) {
        this.nativeSelection = a, this.docSelection = b, this._ranges = [], this.win = c, this.refresh()
    }

    function X(a) {
        a.win = a.anchorNode = a.focusNode = a._ranges = null, a.rangeCount = a.anchorOffset = a.focusOffset = 0, a.detached = !0
    }

    function Z(a, b) {
        var c = Y.length, d, e;
        while (c--) {
            d = Y[c], e = d.selection;
            if (b == "deleteAll")X(e); else if (d.win == a)return b == "delete" ? (Y.splice(c, 1), !0) : e
        }
        return b == "deleteAll" && (Y.length = 0), null
    }

    function ab(a, c) {
        var d = p(c[0].startContainer), e = q(d).createControlRange();
        for (var f = 0, g, h = c.length; f < h; ++f) {
            g = Q(c[f]);
            try {
                e.add(g)
            } catch (i) {
                throw b.createError("setRanges(): Element within one of the specified Ranges could not be added to control selection (does it have layout?)")
            }
        }
        e.select(), T(a)
    }

    function fb(a, b) {
        if (a.win.document != p(b))throw new j("WRONG_DOCUMENT_ERR")
    }

    function gb(b) {
        return function (c, d) {
            var e;
            this.rangeCount ? (e = this.getRangeAt(0), e["set" + (b ? "Start" : "End")](c, d)) : (e = a.createRange(this.win.document), e.setStartAndEnd(c, d)), this.setSingleRange(e, this.isBackward())
        }
    }

    function hb(a) {
        var b = [], c = new k(a.anchorNode, a.anchorOffset), d = new k(a.focusNode, a.focusOffset), e = typeof a.getName == "function" ? a.getName() : "Selection";
        if (typeof a.rangeCount != "undefined")for (var f = 0, g = a.rangeCount; f < g; ++f)b[f] = h.inspect(a.getRangeAt(f));
        return "[" + e + "(Ranges: " + b.join(", ") + ")(anchor: " + c.inspect() + ", focus: " + d.inspect() + "]"
    }

    a.config.checkSelectionRanges = !0;
    var c = "boolean", d = "number", e = a.dom, f = a.util, g = f.isHostMethod, h = a.DomRange, i = a.WrappedRange, j = a.DOMException, k = e.DomPosition, l, m, n = a.features, o = "Control", p = e.getDocument, q = e.getBody, r = h.rangesEqual, x = g(window, "getSelection"), y = f.isHostObject(document, "selection");
    n.implementsWinGetSelection = x, n.implementsDocSelection = y;
    var z = y && (!x || a.config.preferTextRange);
    z ? (l = v, a.isSelectionValid = function (a) {
        var b = t(a, "isSelectionValid").document, c = b.selection;
        return c.type != "None" || p(c.createRange().parentElement()) == b
    }) : x ? (l = u, a.isSelectionValid = function () {
        return !0
    }) : b.fail("Neither document.selection or window.getSelection() detected."), a.getNativeSelection = l;
    var A = l(), B = a.createNativeRange(document), C = q(document), D = f.areHostProperties(A, ["anchorNode", "focusNode", "anchorOffset", "focusOffset"]);
    n.selectionHasAnchorAndFocus = D;
    var E = g(A, "extend");
    n.selectionHasExtend = E;
    var F = typeof A.rangeCount == d;
    n.selectionHasRangeCount = F;
    var G = !1, H = !0, I = E ? function (b, c) {
        var d = h.getRangeDocument(c), e = a.createRange(d);
        e.collapseToPoint(c.endContainer, c.endOffset), b.addRange(O(e)), b.extend(c.startContainer, c.startOffset)
    } : null;
    f.areHostMethods(A, ["addRange", "getRangeAt", "removeAllRanges"]) && typeof A.rangeCount == d && n.implementsDomRange && function () {
        var b = window.getSelection();
        if (b) {
            var c = b.rangeCount, d = c > 1, e = [], f = w(b);
            for (var g = 0; g < c; ++g)e[g] = b.getRangeAt(g);
            var h = q(document), i = h.appendChild(document.createElement("div"));
            i.contentEditable = "false";
            var j = i.appendChild(document.createTextNode("\u00a0\u00a0\u00a0")), k = document.createRange();
            k.setStart(j, 1), k.collapse(!0), b.addRange(k), H = b.rangeCount == 1, b.removeAllRanges();
            if (!d) {
                var l = k.cloneRange();
                k.setStart(j, 0), l.setEnd(j, 3), l.setStart(j, 2), b.addRange(k), b.addRange(l), G = b.rangeCount == 2, l.detach()
            }
            h.removeChild(i), b.removeAllRanges(), k.detach();
            for (g = 0; g < c; ++g)g == 0 && f ? I ? I(b, e[g]) : (a.warn("Rangy initialization: original selection was backwards but selection has been restored forwards because browser does not support Selection.extend"), b.addRange(e[g])) : b.addRange(e[g])
        }
    }(), n.selectionSupportsMultipleRanges = G, n.collapsedNonEditableSelectionsSupported = H;
    var J = !1, K;
    C && g(C, "createControlRange") && (K = C.createControlRange(), f.areHostProperties(K, ["item", "add"]) && (J = !0)), n.implementsControlRange = J, D ? m = function (a) {
        return a.anchorNode === a.focusNode && a.anchorOffset === a.focusOffset
    } : m = function (a) {
        return a.rangeCount ? a.getRangeAt(a.rangeCount - 1).collapsed : !1
    };
    var V;
    g(A, "getRangeAt") ? V = function (a, b) {
        try {
            return a.getRangeAt(b)
        } catch (c) {
            return null
        }
    } : D && (V = function (b) {
        var c = p(b.anchorNode), d = a.createRange(c);
        return d.setStartAndEnd(b.anchorNode, b.anchorOffset, b.focusNode, b.focusOffset), d.collapsed !== this.isCollapsed && d.setStartAndEnd(b.focusNode, b.focusOffset, b.anchorNode, b.anchorOffset), d
    }), W.prototype = a.selectionPrototype;
    var Y = [], $ = function (a) {
        if (a && a instanceof W)return a.refresh(), a;
        a = t(a, "getNativeSelection");
        var b = Z(a), c = l(a), d = y ? v(a) : null;
        return b ? (b.nativeSelection = c, b.docSelection = d, b.refresh()) : (b = new W(c, d, a), Y.push({
            win: a,
            selection: b
        })), b
    };
    a.getSelection = $, a.getIframeSelection = function (c) {
        return b.deprecationNotice("getIframeSelection()", "getSelection(iframeEl)"), a.getSelection(e.getIframeWindow(c))
    };
    var _ = W.prototype;
    if (!z && D && f.areHostMethods(A, ["removeAllRanges", "addRange"])) {
        _.removeAllRanges = function () {
            this.nativeSelection.removeAllRanges(), N(this)
        };
        var bb = function (a, b) {
            I(a.nativeSelection, b), a.refresh()
        };
        F ? _.addRange = function (b, c) {
            if (J && y && this.docSelection.type == o)U(this, b); else if (s(c) && E)bb(this, b); else {
                var d;
                G ? d = this.rangeCount : (this.removeAllRanges(), d = 0), this.nativeSelection.addRange(O(b).cloneRange()), this.rangeCount = this.nativeSelection.rangeCount;
                if (this.rangeCount == d + 1) {
                    if (a.config.checkSelectionRanges) {
                        var e = V(this.nativeSelection, this.rangeCount - 1);
                        e && !r(e, b) && (b = new i(e))
                    }
                    this._ranges[this.rangeCount - 1] = b, L(this, b, eb(this.nativeSelection)), this.isCollapsed = m(this)
                } else this.refresh()
            }
        } : _.addRange = function (a, b) {
            s(b) && E ? bb(this, a) : (this.nativeSelection.addRange(O(a)), this.refresh())
        }, _.setRanges = function (a) {
            if (J && a.length > 1)ab(this, a); else {
                this.removeAllRanges();
                for (var b = 0, c = a.length; b < c; ++b)this.addRange(a[b])
            }
        }
    } else {
        if (!(g(A, "empty") && g(B, "select") && J && z))return b.fail("No means of selecting a Range or TextRange was found"), !1;
        _.removeAllRanges = function () {
            try {
                this.docSelection.empty();
                if (this.docSelection.type != "None") {
                    var a;
                    if (this.anchorNode)a = p(this.anchorNode); else if (this.docSelection.type == o) {
                        var b = this.docSelection.createRange();
                        b.length && (a = p(b.item(0)))
                    }
                    if (a) {
                        var c = q(a).createTextRange();
                        c.select(), this.docSelection.empty()
                    }
                }
            } catch (d) {
            }
            N(this)
        }, _.addRange = function (b) {
            this.docSelection.type == o ? U(this, b) : (a.WrappedTextRange.rangeToTextRange(b).select(), this._ranges[0] = b, this.rangeCount = 1, this.isCollapsed = this._ranges[0].collapsed, L(this, b, !1))
        }, _.setRanges = function (a) {
            this.removeAllRanges();
            var b = a.length;
            b > 1 ? ab(this, a) : b && this.addRange(a[0])
        }
    }
    _.getRangeAt = function (a) {
        if (a < 0 || a >= this.rangeCount)throw new j("INDEX_SIZE_ERR");
        return this._ranges[a].cloneRange()
    };
    var cb;
    if (z)cb = function (b) {
        var c;
        a.isSelectionValid(b.win) ? c = b.docSelection.createRange() : (c = q(b.win.document).createTextRange(), c.collapse(!0)), b.docSelection.type == o ? T(b) : R(c) ? S(b, c) : N(b)
    }; else if (g(A, "getRangeAt") && typeof A.rangeCount == d)cb = function (b) {
        if (J && y && b.docSelection.type == o)T(b); else {
            b._ranges.length = b.rangeCount = b.nativeSelection.rangeCount;
            if (b.rangeCount) {
                for (var c = 0, d = b.rangeCount; c < d; ++c)b._ranges[c] = new a.WrappedRange(b.nativeSelection.getRangeAt(c));
                L(b, b._ranges[b.rangeCount - 1], eb(b.nativeSelection)), b.isCollapsed = m(b)
            } else N(b)
        }
    }; else {
        if (!D || typeof A.isCollapsed != c || typeof B.collapsed != c || !n.implementsDomRange)return b.fail("No means of obtaining a Range or TextRange from the user's selection was found"), !1;
        cb = function (a) {
            var b, c = a.nativeSelection;
            c.anchorNode ? (b = V(c, 0), a._ranges = [b], a.rangeCount = 1, M(a), a.isCollapsed = m(a)) : N(a)
        }
    }
    _.refresh = function (a) {
        var b = a ? this._ranges.slice(0) : null, c = this.anchorNode, d = this.anchorOffset;
        cb(this);
        if (a) {
            var e = b.length;
            if (e != this._ranges.length)return !0;
            if (this.anchorNode != c || this.anchorOffset != d)return !0;
            while (e--)if (!r(b[e], this._ranges[e]))return !0;
            return !1
        }
    };
    var db = function (a, b) {
        var c = a.getAllRanges();
        a.removeAllRanges();
        for (var d = 0, e = c.length; d < e; ++d)r(b, c[d]) || a.addRange(c[d]);
        a.rangeCount || N(a)
    };
    J ? _.removeRange = function (a) {
        if (this.docSelection.type == o) {
            var b = this.docSelection.createRange(), c = Q(a), d = p(b.item(0)), e = q(d).createControlRange(), f, g = !1;
            for (var h = 0, i = b.length; h < i; ++h)f = b.item(h), f !== c || g ? e.add(b.item(h)) : g = !0;
            e.select(), T(this)
        } else db(this, a)
    } : _.removeRange = function (a) {
        db(this, a)
    };
    var eb;
    !z && D && n.implementsDomRange ? (eb = w, _.isBackward = function () {
        return eb(this)
    }) : eb = _.isBackward = function () {
        return !1
    }, _.isBackwards = _.isBackward, _.toString = function () {
        var a = [];
        for (var b = 0, c = this.rangeCount; b < c; ++b)a[b] = "" + this._ranges[b];
        return a.join("")
    }, _.collapse = function (b, c) {
        fb(this, b);
        var d = a.createRange(b);
        d.collapseToPoint(b, c), this.setSingleRange(d), this.isCollapsed = !0
    }, _.collapseToStart = function () {
        if (!this.rangeCount)throw new j("INVALID_STATE_ERR");
        var a = this._ranges[0];
        this.collapse(a.startContainer, a.startOffset)
    }, _.collapseToEnd = function () {
        if (!this.rangeCount)throw new j("INVALID_STATE_ERR");
        var a = this._ranges[this.rangeCount - 1];
        this.collapse(a.endContainer, a.endOffset)
    }, _.selectAllChildren = function (b) {
        fb(this, b);
        var c = a.createRange(b);
        c.selectNodeContents(b), this.setSingleRange(c)
    }, _.deleteFromDocument = function () {
        if (J && y && this.docSelection.type == o) {
            var a = this.docSelection.createRange(), b;
            while (a.length)b = a.item(0), a.remove(b), b.parentNode.removeChild(b);
            this.refresh()
        } else if (this.rangeCount) {
            var c = this.getAllRanges();
            if (c.length) {
                this.removeAllRanges();
                for (var d = 0, e = c.length; d < e; ++d)c[d].deleteContents();
                this.addRange(c[e - 1])
            }
        }
    }, _.eachRange = function (a, b) {
        for (var c = 0, d = this._ranges.length; c < d; ++c)if (a(this.getRangeAt(c)))return b
    }, _.getAllRanges = function () {
        var a = [];
        return this.eachRange(function (b) {
            a.push(b)
        }), a
    }, _.setSingleRange = function (a, b) {
        this.removeAllRanges(), this.addRange(a, b)
    }, _.callMethodOnEachRange = function (a, b) {
        var c = [];
        return this.eachRange(function (d) {
            c.push(d[a].apply(d, b))
        }), c
    }, _.setStart = gb(!0), _.setEnd = gb(!1), a.rangePrototype.select = function (a) {
        $(this.getDocument()).setSingleRange(this, a)
    }, _.changeEachRange = function (a) {
        var b = [], c = this.isBackward();
        this.eachRange(function (c) {
            a(c), b.push(c)
        }), this.removeAllRanges(), c && b.length == 1 ? this.addRange(b[0], "backward") : this.setRanges(b)
    }, _.containsNode = function (a, b) {
        return this.eachRange(function (c) {
            return c.containsNode(a, b)
        }, !0)
    }, _.getBookmark = function (a) {
        return {backward: this.isBackward(), rangeBookmarks: this.callMethodOnEachRange("getBookmark", [a])}
    }, _.moveToBookmark = function (b) {
        var c = [];
        for (var d = 0, e, f; e = b.rangeBookmarks[d++];)f = a.createRange(this.win), f.moveToBookmark(e), c.push(f);
        b.backward ? this.setSingleRange(c[0], "backward") : this.setRanges(c)
    }, _.toHtml = function () {
        return this.callMethodOnEachRange("toHtml").join("")
    }, _.getName = function () {
        return "WrappedSelection"
    }, _.inspect = function () {
        return hb(this)
    }, _.detach = function () {
        Z(this.win, "delete"), X(this)
    }, W.detachAll = function () {
        Z(null, "deleteAll")
    }, W.inspect = hb, W.isDirectionBackward = s, a.Selection = W, a.selectionPrototype = _, a.addCreateMissingNativeApiListener(function (a) {
        typeof a.getSelection == "undefined" && (a.getSelection = function () {
            return $(a)
        }), a = null
    })
})