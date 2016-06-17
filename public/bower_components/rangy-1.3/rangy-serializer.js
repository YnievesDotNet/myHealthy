/**
 * Serializer module for Rangy.
 * Serializes Ranges and Selections. An example use would be to store a user's selection on a particular page in a
 * cookie or local storage and restore it on the user's next visit to the same page.
 *
 * Part of Rangy, a cross-browser JavaScript range and selection library
 * http://code.google.com/p/rangy/
 *
 * Depends on Rangy core.
 *
 * Copyright 2013, Tim Down
 * Licensed under the MIT license.
 * Version: 1.3alpha.804
 * Build date: 8 December 2013
 */
rangy.createModule("Serializer", ["WrappedSelection"], function (a, b) {
    function f(a) {
        return a.replace(/</g, "&lt;").replace(/>/g, "&gt;")
    }

    function g(a, b) {
        b = b || [];
        var c = a.nodeType, d = a.childNodes, e = d.length, h = [c, a.nodeName, e].join(":"), i = "", j = "";
        switch (c) {
            case 3:
                i = f(a.nodeValue);
                break;
            case 8:
                i = "<!--" + f(a.nodeValue) + "-->";
                break;
            default:
                i = "<" + h + ">", j = "</>"
        }
        i && b.push(i);
        for (var k = 0; k < e; ++k)g(d[k], b);
        return j && b.push(j), b
    }

    function h(a) {
        var b = g(a).join("");
        return d(b).toString(16)
    }

    function i(a, b, c) {
        var d = [], f = a;
        c = c || e.getDocument(a).documentElement;
        while (f && f != c)d.push(e.getNodeIndex(f, !0)), f = f.parentNode;
        return d.join("/") + ":" + b
    }

    function j(a, c, d) {
        c || (c = (d || document).documentElement);
        var f = a.split(":"), g = c, h = f[0] ? f[0].split("/") : [], i = h.length, j;
        while (i--) {
            j = parseInt(h[i], 10);
            if (!(j < g.childNodes.length))throw b.createError("deserializePosition() failed: node " + e.inspectNode(g) + " has no child with index " + j + ", " + i);
            g = g.childNodes[j]
        }
        return new e.DomPosition(g, parseInt(f[1], 10))
    }

    function k(c, d, f) {
        f = f || a.DomRange.getRangeDocument(c).documentElement;
        if (!e.isOrIsAncestorOf(f, c.commonAncestorContainer))throw b.createError("serializeRange(): range " + c.inspect() + " is not wholly contained within specified root node " + e.inspectNode(f));
        var g = i(c.startContainer, c.startOffset, f) + "," + i(c.endContainer, c.endOffset, f);
        return d || (g += "{" + h(f) + "}"), g
    }

    function m(c, d, f) {
        d ? f = f || e.getDocument(d) : (f = f || document, d = f.documentElement);
        var g = l.exec(c), i = g[4], k = h(d);
        if (i && i !== h(d))throw b.createError("deserializeRange(): checksums of serialized range root node (" + i + ") and target root node (" + k + ") do not match");
        var m = j(g[1], d, f), n = j(g[2], d, f), o = a.createRange(f);
        return o.setStartAndEnd(m.node, m.offset, n.node, n.offset), o
    }

    function n(a, b, c) {
        b || (b = (c || document).documentElement);
        var d = l.exec(a), e = d[3];
        return !e || e === h(b)
    }

    function o(b, c, d) {
        b = a.getSelection(b);
        var e = b.getAllRanges(), f = [];
        for (var g = 0, h = e.length; g < h; ++g)f[g] = k(e[g], c, d);
        return f.join("|")
    }

    function p(b, c, d) {
        c ? d = d || e.getWindow(c) : (d = d || window, c = d.document.documentElement);
        var f = b.split("|"), g = a.getSelection(d), h = [];
        for (var i = 0, j = f.length; i < j; ++i)h[i] = m(f[i], c, d.document);
        return g.setRanges(h), g
    }

    function q(a, b, c) {
        var d;
        b ? d = c ? c.document : e.getDocument(b) : (c = c || window, b = c.document.documentElement);
        var f = a.split("|");
        for (var g = 0, h = f.length; g < h; ++g)if (!n(f[g], b, d))return !1;
        return !0
    }

    function s(a) {
        var b = a.split(/[;,]/);
        for (var c = 0, d = b.length, e, f; c < d; ++c) {
            e = b[c].split("=");
            if (e[0].replace(/^\s+/, "") == r) {
                f = e[1];
                if (f)return decodeURIComponent(f.replace(/\s+$/, ""))
            }
        }
        return null
    }

    function t(a) {
        a = a || window;
        var b = s(a.document.cookie);
        b && p(b, a.doc)
    }

    function u(b, c) {
        b = b || window, c = typeof c == "object" ? c : {};
        var d = c.expires ? ";expires=" + c.expires.toUTCString() : "", e = c.path ? ";path=" + c.path : "", f = c.domain ? ";domain=" + c.domain : "", g = c.secure ? ";secure" : "", h = o(a.getSelection(b));
        b.document.cookie = encodeURIComponent(r) + "=" + encodeURIComponent(h) + d + e + f + g
    }

    var c = "undefined";
    (typeof encodeURIComponent == c || typeof decodeURIComponent == c) && b.fail("Global object is missing encodeURIComponent and/or decodeURIComponent method");
    var d = function () {
        function a(a) {
            var b = [];
            for (var c = 0, d = a.length, e; c < d; ++c)e = a.charCodeAt(c), e < 128 ? b.push(e) : e < 2048 ? b.push(e >> 6 | 192, e & 63 | 128) : b.push(e >> 12 | 224, e >> 6 & 63 | 128, e & 63 | 128);
            return b
        }

        function c() {
            var a = [];
            for (var b = 0, c, d; b < 256; ++b) {
                d = b, c = 8;
                while (c--)(d & 1) == 1 ? d = d >>> 1 ^ 3988292384 : d >>>= 1;
                a[b] = d >>> 0
            }
            return a
        }

        function d() {
            return b || (b = c()), b
        }

        var b = null;
        return function (b) {
            var c = a(b), e = -1, f = d();
            for (var g = 0, h = c.length, i; g < h; ++g)i = (e ^ c[g]) & 255, e = e >>> 8 ^ f[i];
            return (e ^ -1) >>> 0
        }
    }(), e = a.dom, l = /^([^,]+),([^,\{]+)(\{([^}]+)\})?$/, r = "rangySerializedSelection";
    a.serializePosition = i, a.deserializePosition = j, a.serializeRange = k, a.deserializeRange = m, a.canDeserializeRange = n, a.serializeSelection = o, a.deserializeSelection = p, a.canDeserializeSelection = q, a.restoreSelectionFromCookie = t, a.saveSelectionCookie = u, a.getElementChecksum = h, a.nodeToInfoString = g
})