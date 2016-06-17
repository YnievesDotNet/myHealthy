/**
 * Selection save and restore module for Rangy.
 * Saves and restores user selections using marker invisible elements in the DOM.
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
rangy.createModule("SaveRestore", ["WrappedRange"], function (a, b) {
    function e(a, b) {
        return (b || document).getElementById(a)
    }

    function f(a, b) {
        var e = "selectionBoundary_" + +(new Date) + "_" + ("" + Math.random()).slice(2), f, g = c.getDocument(a.startContainer), h = a.cloneRange();
        return h.collapse(b), f = g.createElement("span"), f.id = e, f.style.lineHeight = "0", f.style.display = "none", f.className = "rangySelectionBoundary", f.appendChild(g.createTextNode(d)), h.insertNode(f), h.detach(), f
    }

    function g(a, c, d, f) {
        var g = e(d, a);
        g ? (c[f ? "setStartBefore" : "setEndBefore"](g), g.parentNode.removeChild(g)) : b.warn("Marker element has been removed. Cannot restore selection.")
    }

    function h(a, b) {
        return b.compareBoundaryPoints(a.START_TO_START, a)
    }

    function i(b, c) {
        var d, e, g = a.DomRange.getRangeDocument(b), h = b.toString();
        return b.collapsed ? (e = f(b, !1), {
            document: g,
            markerId: e.id,
            collapsed: !0
        }) : (e = f(b, !1), d = f(b, !0), {
            document: g,
            startMarkerId: d.id,
            endMarkerId: e.id,
            collapsed: !1,
            backward: c,
            toString: function () {
                return "original text: '" + h + "', new text: '" + b.toString() + "'"
            }
        })
    }

    function j(c, d) {
        var f = c.document;
        typeof d == "undefined" && (d = !0);
        var h = a.createRange(f);
        if (c.collapsed) {
            var i = e(c.markerId, f);
            if (i) {
                i.style.display = "inline";
                var j = i.previousSibling;
                j && j.nodeType == 3 ? (i.parentNode.removeChild(i), h.collapseToPoint(j, j.length)) : (h.collapseBefore(i), i.parentNode.removeChild(i))
            } else b.warn("Marker element has been removed. Cannot restore selection.")
        } else g(f, h, c.startMarkerId, !0), g(f, h, c.endMarkerId, !1);
        return d && h.normalizeBoundaries(), h
    }

    function k(b, c) {
        var d = [], f, g;
        b = b.slice(0), b.sort(h);
        for (var j = 0, k = b.length; j < k; ++j)d[j] = i(b[j], c);
        for (j = k - 1; j >= 0; --j)f = b[j], g = a.DomRange.getRangeDocument(f), f.collapsed ? f.collapseAfter(e(d[j].markerId, g)) : (f.setEndBefore(e(d[j].endMarkerId, g)), f.setStartAfter(e(d[j].startMarkerId, g)));
        return d
    }

    function l(c) {
        if (!a.isSelectionValid(c))return b.warn("Cannot save selection. This usually happens when the selection is collapsed and the selection document has lost focus."), null;
        var d = a.getSelection(c), e = d.getAllRanges(), f = e.length == 1 && d.isBackward(), g = k(e, f);
        return f ? d.setSingleRange(e[0], "backward") : d.setRanges(e), {win: c, rangeInfos: g, restored: !1}
    }

    function m(a) {
        var b = [], c = a.length;
        for (var d = c - 1; d >= 0; d--)b[d] = j(a[d], !0);
        return b
    }

    function n(b, c) {
        if (!b.restored) {
            var d = b.rangeInfos, e = a.getSelection(b.win), f = m(d), g = d.length;
            g == 1 && c && a.features.selectionHasExtend && d[0].backward ? (e.removeAllRanges(), e.addRange(f[0], !0)) : e.setRanges(f), b.restored = !0
        }
    }

    function o(a, b) {
        var c = e(b, a);
        c && c.parentNode.removeChild(c)
    }

    function p(a) {
        var b = a.rangeInfos;
        for (var c = 0, d = b.length, e; c < d; ++c)e = b[c], e.collapsed ? o(a.doc, e.markerId) : (o(a.doc, e.startMarkerId), o(a.doc, e.endMarkerId))
    }

    var c = a.dom, d = "\ufeff";
    a.util.extend(a, {
        saveRange: i,
        restoreRange: j,
        saveRanges: k,
        restoreRanges: m,
        saveSelection: l,
        restoreSelection: n,
        removeMarkerElement: o,
        removeMarkers: p
    })
})