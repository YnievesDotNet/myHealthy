/**
 * Text range module for Rangy.
 * Text-based manipulation and searching of ranges and selections.
 *
 * Features
 *
 * - Ability to move range boundaries by character or word offsets
 * - Customizable word tokenizer
 * - Ignores text nodes inside <script> or <style> elements or those hidden by CSS display and visibility properties
 * - Range findText method to search for text or regex within the page or within a range. Flags for whole words and case
 *   sensitivity
 * - Selection and range save/restore as text offsets within a node
 * - Methods to return visible text within a range or selection
 * - innerText method for elements
 *
 * References
 *
 * https://www.w3.org/Bugs/Public/show_bug.cgi?id=13145
 * http://aryeh.name/spec/innertext/innertext.html
 * http://dvcs.w3.org/hg/editing/raw-file/tip/editing.html
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
rangy.createModule("TextRange", ["WrappedSelection"], function (a, b) {
    function u(a, b) {
        function f(b, c, d) {
            var f = a.slice(b, c), g = {
                isWord: d, chars: f, toString: function () {
                    return f.join("")
                }
            };
            for (var h = 0, i = f.length; h < i; ++h)f[h].token = g;
            e.push(g)
        }

        var c = a.join(""), d, e = [], g = 0, h, i;
        while (d = b.wordRegex.exec(c)) {
            h = d.index, i = h + d[0].length, h > g && f(g, h, !1);
            if (b.includeTrailingSpace)while (m.test(a[i]))++i;
            f(h, i, !0), g = i
        }
        return g < a.length && f(g, a.length, !1), e
    }

    function y(a, b) {
        if (!a)return b;
        var c = {};
        return h(c, b), h(c, a), c
    }

    function z(a) {
        var b, c;
        return a ? (b = a.language || o, c = {}, h(c, x[b] || x[o]), h(c, a), c) : x[o]
    }

    function A(a) {
        return y(a, v)
    }

    function B(a) {
        return y(a, w)
    }

    function J(a, b) {
        var c = G(a, "display", b), d = a.tagName.toLowerCase();
        return c == "block" && H && I.hasOwnProperty(d) ? I[d] : c
    }

    function K(a) {
        var b = Q(a);
        for (var c = 0, d = b.length; c < d; ++c)if (b[c].nodeType == 1 && J(b[c]) == "none")return !0;
        return !1
    }

    function L(a) {
        var b;
        return a.nodeType == 3 && (b = a.parentNode) && G(b, "visibility") == "hidden"
    }

    function M(a) {
        return a && (a.nodeType == 1 && !/^(inline(-block|-table)?|none)$/.test(J(a)) || a.nodeType == 9 || a.nodeType == 11)
    }

    function N(a) {
        var b = a.lastChild;
        return b ? N(b) : a
    }

    function O(a) {
        return f.isCharacterDataNode(a) || !/^(area|base|basefont|br|col|frame|hr|img|input|isindex|link|meta|param)$/i.test(a.nodeName)
    }

    function P(a) {
        var b = [];
        while (a.parentNode)b.unshift(a.parentNode), a = a.parentNode;
        return b
    }

    function Q(a) {
        return P(a).concat([a])
    }

    function R(a) {
        while (a && !a.nextSibling)a = a.parentNode;
        return a ? a.nextSibling : null
    }

    function S(a, b) {
        return !b && a.hasChildNodes() ? a.firstChild : R(a)
    }

    function T(a) {
        var b = a.previousSibling;
        if (b) {
            a = b;
            while (a.hasChildNodes())a = a.lastChild;
            return a
        }
        var c = a.parentNode;
        return c && c.nodeType == 1 ? c : null
    }

    function U(a) {
        if (!a || a.nodeType != 3)return !1;
        var b = a.data;
        if (b === "")return !0;
        var c = a.parentNode;
        if (!c || c.nodeType != 1)return !1;
        var d = G(a.parentNode, "whiteSpace");
        return /^[\t\n\r ]+$/.test(b) && /^(normal|nowrap)$/.test(d) || /^[\t\r ]+$/.test(b) && d == "pre-line"
    }

    function V(a) {
        if (a.data === "")return !0;
        if (!U(a))return !1;
        var b = a.parentNode;
        return b ? K(a) ? !0 : !1 : !0
    }

    function W(a) {
        var b = a.nodeType;
        return b == 7 || b == 8 || K(a) || /^(script|style)$/i.test(a.nodeName) || L(a) || V(a)
    }

    function X(a, b) {
        var c = a.nodeType;
        return c == 7 || c == 8 || c == 1 && J(a, b) == "none"
    }

    function Y() {
        this.store = {}
    }

    function _(a, b, c) {
        return function (d) {
            var e = this.cache;
            if (e.hasOwnProperty(a))return Z++, e[a];
            $++;
            var f = b.call(this, c ? this[c] : this, d);
            return e[a] = f, f
        }
    }

    function ab(a, b) {
        this.node = a, this.session = b, this.cache = new Y, this.positions = new Y
    }

    function lb(a, b) {
        this.offset = b, this.nodeWrapper = a, this.node = a.node, this.session = a.session, this.cache = new Y
    }

    function mb() {
        return "[Position(" + f.inspectNode(this.node) + ":" + this.offset + ")]"
    }

    function qb() {
        return sb(), ob = new pb
    }

    function rb() {
        return ob || qb()
    }

    function sb() {
        ob && ob.detach(), ob = null
    }

    function tb(a, c, d, e) {
        function h() {
            var a = null, b = null;
            return c ? (b = f, g || (f = f.previousVisible(), g = !f || d && f.equals(d))) : g || (b = f = f.nextVisible(), g = !f || d && f.equals(d)), g && (f = null), b
        }

        d && (c ? W(d.node) && (d = a.previousVisible()) : W(d.node) && (d = d.nextVisible()));
        var f = a, g = !1, i, j = !1;
        return {
            next: function () {
                if (j)return j = !1, i;
                var a, b;
                while (a = h()) {
                    b = a.getCharacter(e);
                    if (b)return i = a, a
                }
                return null
            }, rewind: function () {
                if (!i)throw b.createError("createCharacterIterator: cannot rewind. Only one position can be rewound.");
                j = !0
            }, dispose: function () {
                a = d = null
            }
        }
    }

    function vb(a, b, c) {
        function g(a) {
            var b, c, f = [], g = a ? d : e, h = !1, i = !1;
            while (b = g.next()) {
                c = b.character;
                if (l.test(c))i && (i = !1, h = !0); else {
                    if (h) {
                        g.rewind();
                        break
                    }
                    i = !0
                }
                f.push(b)
            }
            return f
        }

        function n(a) {
            var b = ["[" + a.length + "]"];
            for (var c = 0; c < a.length; ++c)b.push("(word: " + a[c] + ", is word: " + a[c].isWord + ")");
            return b
        }

        var d = tb(a, !1, null, b), e = tb(a, !0, null, b), f = c.tokenizer, h = g(!0), i = g(!1).reverse(), j = f(i.concat(h), c), k = h.length ? j.slice(ub(j, h[0].token)) : [], m = i.length ? j.slice(0, ub(j, i.pop().token) + 1) : [];
        return {
            nextEndToken: function () {
                var a, b;
                while (k.length == 1 && !(a = k[0]).isWord && (b = g(!0)).length > 0)k = f(a.chars.concat(b), c);
                return k.shift()
            }, previousStartToken: function () {
                var a, b;
                while (m.length == 1 && !(a = m[0]).isWord && (b = g(!1)).length > 0)m = f(b.reverse().concat(a.chars), c);
                return m.pop()
            }, dispose: function () {
                d.dispose(), e.dispose(), k = m = null
            }
        }
    }

    function wb(a, b, c, f, g) {
        var h = 0, i, j = a, k, l, m = Math.abs(c), n;
        if (c !== 0) {
            var o = c < 0;
            switch (b) {
                case d:
                    k = tb(a, o, null, f);
                    while ((i = k.next()) && h < m)++h, j = i;
                    l = i, k.dispose();
                    break;
                case e:
                    var p = vb(a, f, g), q = o ? p.previousStartToken : p.nextEndToken;
                    while ((n = q()) && h < m)n.isWord && (++h, j = o ? n.chars[0] : n.chars[n.chars.length - 1]);
                    break;
                default:
                    throw new Error("movePositionBy: unit '" + b + "' not implemented")
            }
            o ? (j = j.previousVisible(), h = -h) : j && j.isLeadingSpace && (b == e && (k = tb(a, !1, null, f), l = k.next(), k.dispose()), l && (j = l.previousVisible()))
        }
        return {position: j, unitsMoved: h}
    }

    function xb(a, b, c, d) {
        var e = a.getRangeBoundaryPosition(b, !0), f = a.getRangeBoundaryPosition(b, !1), g = d ? f : e, h = d ? e : f;
        return tb(g, !!d, h, c)
    }

    function yb(a, b, c) {
        var d = [], e = xb(a, b, c), f;
        while (f = e.next())d.push(f);
        return e.dispose(), d
    }

    function zb(b, c, d) {
        var e = a.createRange(b.node);
        e.setStartAndEnd(b.node, b.offset, c.node, c.offset);
        var f = !e.expand("word", d);
        return e.detach(), f
    }

    function Ab(a, b, c, d, e) {
        function r(a, b) {
            var c = i[a].previousVisible(), d = i[b - 1], f = !e.wholeWordsOnly || zb(c, d, e.wordOptions);
            return {startPos: c, endPos: d, valid: f}
        }

        var f = p(e.direction), g = tb(a, f, a.session.getRangeBoundaryPosition(d, f), e), h = "", i = [], j, k, l, m, n, o, q = null;
        while (j = g.next()) {
            k = j.character, !c && !e.caseSensitive && (k = k.toLowerCase()), f ? (i.unshift(j), h = k + h) : (i.push(j), h += k);
            if (c) {
                n = b.exec(h);
                if (n)if (o) {
                    l = n.index, m = l + n[0].length;
                    if (!f && m < h.length || f && l > 0) {
                        q = r(l, m);
                        break
                    }
                } else o = !0
            } else if ((l = h.indexOf(b)) != -1) {
                q = r(l, l + b.length);
                break
            }
        }
        return o && (q = r(l, m)), g.dispose(), q
    }

    function Bb(a) {
        return function () {
            var b = !!ob, c = rb(), d = [c].concat(g.toArray(arguments)), e = a.apply(this, d);
            return b || sb(), e
        }
    }

    function Cb(a, b) {
        return Bb(function (c, e, f, g) {
            typeof f == "undefined" && (f = e, e = d), g = y(g, D);
            var h = A(g.characterOptions), i = z(g.wordOptions), j = a;
            b && (j = f >= 0, this.collapse(!j));
            var k = wb(c.getRangeBoundaryPosition(this, j), e, f, h, i), l = k.position;
            return this[j ? "setStart" : "setEnd"](l.node, l.offset), k.unitsMoved
        })
    }

    function Db(a) {
        return Bb(function (b, c) {
            c = A(c);
            var d, e = xb(b, this, c, !a), f = 0;
            while ((d = e.next()) && l.test(d.character))++f;
            e.dispose();
            var g = f > 0;
            return g && this[a ? "moveStart" : "moveEnd"]("character", a ? f : -f, {characterOptions: c}), g
        })
    }

    function Eb(a) {
        return Bb(function (b, c) {
            var d = !1;
            return this.changeEachRange(function (b) {
                d = b[a](c) || d
            }), d
        })
    }

    var c = "undefined", d = "character", e = "word", f = a.dom, g = a.util, h = g.extend, i = f.getBody, j = /^[ \t\f\r\n]+$/, k = /^[ \t\f\r]+$/, l = /^[\t-\r \u0085\u00A0\u1680\u180E\u2000-\u200B\u2028\u2029\u202F\u205F\u3000]+$/, m = /^[\t \u00A0\u1680\u180E\u2000-\u200B\u202F\u205F\u3000]+$/, n = /^[\n-\r\u0085\u2028\u2029]$/, o = "en", p = a.Selection.isDirectionBackward, q = !1, r = !1, s = !1, t = !0;
    (function () {
        var b = document.createElement("div");
        b.contentEditable = "true", b.innerHTML = "<p>1 </p><p></p>";
        var c = i(document), d = b.firstChild, e = a.getSelection();
        c.appendChild(b), e.collapse(d.lastChild, 2), e.setStart(d.firstChild, 0), q = ("" + e).length == 1, b.innerHTML = "1 <br>", e.collapse(b, 2), e.setStart(b.firstChild, 0), r = ("" + e).length == 1, b.innerHTML = "1 <p>1</p>", e.collapse(b, 2), e.setStart(b.firstChild, 0), s = ("" + e).length == 1, c.removeChild(b), e.removeAllRanges()
    })();
    var v = {
        includeBlockContentTrailingSpace: !0,
        includeSpaceBeforeBr: !0,
        includeSpaceBeforeBlock: !0,
        includePreLineTrailingSpace: !0
    }, w = {
        includeBlockContentTrailingSpace: !t,
        includeSpaceBeforeBr: !r,
        includeSpaceBeforeBlock: !s,
        includePreLineTrailingSpace: !0
    }, x = {
        en: {
            wordRegex: /[a-z0-9]+('[a-z0-9]+)*/gi,
            includeTrailingSpace: !1,
            tokenizer: u
        }
    }, C = {
        caseSensitive: !1,
        withinRange: null,
        wholeWordsOnly: !1,
        wrap: !1,
        direction: "forward",
        wordOptions: null,
        characterOptions: null
    }, D = {wordOptions: null, characterOptions: null}, E = {
        wordOptions: null,
        characterOptions: null,
        trim: !1,
        trimStart: !0,
        trimEnd: !0
    }, F = {wordOptions: null, characterOptions: null, direction: "forward"}, G = f.getComputedStyleProperty, H;
    (function () {
        var a = document.createElement("table"), b = i(document);
        b.appendChild(a), H = G(a, "display") == "block", b.removeChild(a)
    })(), a.features.tableCssDisplayBlock = H;
    var I = {
        table: "table",
        caption: "table-caption",
        colgroup: "table-column-group",
        col: "table-column",
        thead: "table-header-group",
        tbody: "table-row-group",
        tfoot: "table-footer-group",
        tr: "table-row",
        td: "table-cell",
        th: "table-cell"
    };
    Y.prototype = {
        get: function (a) {
            return this.store.hasOwnProperty(a) ? this.store[a] : null
        }, set: function (a, b) {
            return this.store[a] = b
        }
    };
    var Z = 0, $ = 0, bb = {
        getPosition: function (a) {
            var b = this.positions;
            return b.get(a) || b.set(a, new lb(this, a))
        }, toString: function () {
            return "[NodeWrapper(" + f.inspectNode(this.node) + ")]"
        }
    };
    ab.prototype = bb;
    var cb = "EMPTY", db = "NON_SPACE", eb = "UNCOLLAPSIBLE_SPACE", fb = "COLLAPSIBLE_SPACE", gb = "TRAILING_SPACE_BEFORE_BLOCK", hb = "TRAILING_SPACE_IN_BLOCK", ib = "TRAILING_SPACE_BEFORE_BR", jb = "PRE_LINE_TRAILING_SPACE_BEFORE_LINE_BREAK", kb = "TRAILING_LINE_BREAK_AFTER_BR";
    h(bb, {
        isCharacterDataNode: _("isCharacterDataNode", f.isCharacterDataNode, "node"),
        getNodeIndex: _("nodeIndex", f.getNodeIndex, "node"),
        getLength: _("nodeLength", f.getNodeLength, "node"),
        containsPositions: _("containsPositions", O, "node"),
        isWhitespace: _("isWhitespace", U, "node"),
        isCollapsedWhitespace: _("isCollapsedWhitespace", V, "node"),
        getComputedDisplay: _("computedDisplay", J, "node"),
        isCollapsed: _("collapsed", W, "node"),
        isIgnored: _("ignored", X, "node"),
        next: _("nextPos", S, "node"),
        previous: _("previous", T, "node"),
        getTextNodeInfo: _("textNodeInfo", function (a) {
            var b = null, c = !1, d = G(a.parentNode, "whiteSpace"), e = d == "pre-line";
            if (e)b = k, c = !0; else if (d == "normal" || d == "nowrap")b = j, c = !0;
            return {node: a, text: a.data, spaceRegex: b, collapseSpaces: c, preLine: e}
        }, "node"),
        hasInnerText: _("hasInnerText", function (a, b) {
            var c = this.session, d = c.getPosition(a.parentNode, this.getNodeIndex() + 1), e = c.getPosition(a, 0), f = b ? d : e, g = b ? e : d;
            while (f !== g) {
                f.prepopulateChar();
                if (f.isDefinitelyNonEmpty())return !0;
                f = b ? f.previousVisible() : f.nextVisible()
            }
            return !1
        }, "node"),
        isRenderedBlock: _("isRenderedBlock", function (a) {
            var b = a.getElementsByTagName("br");
            for (var c = 0, d = b.length; c < d; ++c)if (!W(b[c]))return !0;
            return this.hasInnerText()
        }, "node"),
        getTrailingSpace: _("trailingSpace", function (a) {
            if (a.tagName.toLowerCase() == "br")return "";
            switch (this.getComputedDisplay()) {
                case"inline":
                    var b = a.lastChild;
                    while (b) {
                        if (!X(b))return b.nodeType == 1 ? this.session.getNodeWrapper(b).getTrailingSpace() : "";
                        b = b.previousSibling
                    }
                    break;
                case"inline-block":
                case"inline-table":
                case"none":
                case"table-column":
                case"table-column-group":
                    break;
                case"table-cell":
                    return "	";
                default:
                    return this.isRenderedBlock(!0) ? "\n" : ""
            }
            return ""
        }, "node"),
        getLeadingSpace: _("leadingSpace", function (a) {
            switch (this.getComputedDisplay()) {
                case"inline":
                case"inline-block":
                case"inline-table":
                case"none":
                case"table-column":
                case"table-column-group":
                case"table-cell":
                    break;
                default:
                    return this.isRenderedBlock(!1) ? "\n" : ""
            }
            return ""
        }, "node")
    });
    var nb = {
        character: "", characterType: cb, isBr: !1, prepopulateChar: function () {
            var a = this;
            if (!a.prepopulatedChar) {
                var b = a.node, c = a.offset, d = "", e = cb, f = !1;
                if (c > 0)if (b.nodeType == 3) {
                    var g = b.data, h = g.charAt(c - 1), i = a.nodeWrapper.getTextNodeInfo(), j = i.spaceRegex;
                    i.collapseSpaces ? j.test(h) ? c > 1 && j.test(g.charAt(c - 2)) || (i.preLine && g.charAt(c) === "\n" ? (d = " ", e = jb) : (d = " ", e = fb)) : (d = h, e = db, f = !0) : (d = h, e = eb, f = !0)
                } else {
                    var k = b.childNodes[c - 1];
                    k && k.nodeType == 1 && !W(k) && (k.tagName.toLowerCase() == "br" ? (d = "\n", a.isBr = !0, e = fb, f = !1) : a.checkForTrailingSpace = !0);
                    if (!d) {
                        var l = b.childNodes[c];
                        l && l.nodeType == 1 && !W(l) && (a.checkForLeadingSpace = !0)
                    }
                }
                a.prepopulatedChar = !0, a.character = d, a.characterType = e, a.isCharInvariant = f
            }
        }, isDefinitelyNonEmpty: function () {
            var a = this.characterType;
            return a == db || a == eb
        }, resolveLeadingAndTrailingSpaces: function () {
            this.prepopulatedChar || this.prepopulateChar();
            if (this.checkForTrailingSpace) {
                var a = this.session.getNodeWrapper(this.node.childNodes[this.offset - 1]).getTrailingSpace();
                a && (this.isTrailingSpace = !0, this.character = a, this.characterType = fb), this.checkForTrailingSpace = !1
            }
            if (this.checkForLeadingSpace) {
                var b = this.session.getNodeWrapper(this.node.childNodes[this.offset]).getLeadingSpace();
                b && (this.isLeadingSpace = !0, this.character = b, this.characterType = fb), this.checkForLeadingSpace = !1
            }
        }, getPrecedingUncollapsedPosition: function (a) {
            var b = this, c;
            while (b = b.previousVisible()) {
                c = b.getCharacter(a);
                if (c !== "")return b
            }
            return null
        }, getCharacter: function (a) {
            function j() {
                return h || (g = i.getPrecedingUncollapsedPosition(a), h = !0), g
            }

            this.resolveLeadingAndTrailingSpaces();
            if (this.isCharInvariant)return this.character;
            var b = ["character", a.includeSpaceBeforeBr, a.includeBlockContentTrailingSpace, a.includePreLineTrailingSpace].join("_"), c = this.cache.get(b);
            if (c !== null)return c;
            var d = "", e = this.characterType == fb, f, g, h = !1, i = this;
            if (e) {
                if (this.character != " " || !!j() && !g.isTrailingSpace && g.character != "\n")if (this.character == "\n" && this.isLeadingSpace)j() && g.character != "\n" && (d = "\n"); else {
                    f = this.nextUncollapsed();
                    if (f) {
                        f.isBr ? this.type = ib : f.isTrailingSpace && f.character == "\n" ? this.type = hb : f.isLeadingSpace && f.character == "\n" && (this.type = gb);
                        if (f.character === "\n") {
                            if (this.type != ib || !!a.includeSpaceBeforeBr)if (this.type != gb || !!a.includeSpaceBeforeBlock)if (this.type != hb || !f.isTrailingSpace || !!a.includeBlockContentTrailingSpace)if (this.type != jb || f.type != db || !!a.includePreLineTrailingSpace)this.character === "\n" ? f.isTrailingSpace ? this.isTrailingSpace || this.isBr && (f.type = kb, j() && g.isLeadingSpace && g.character == "\n" && (f.character = "")) : d = "\n" : this.character === " " && (d = " ")
                        } else d = this.character
                    }
                }
            } else this.character !== "\n" || !!(f = this.nextUncollapsed()) && !f.isTrailingSpace;
            return this.cache.set(b, d), d
        }, equals: function (a) {
            return !!a && this.node === a.node && this.offset === a.offset
        }, inspect: mb, toString: function () {
            return this.character
        }
    };
    lb.prototype = nb, h(nb, {
        next: _("nextPos", function (a) {
            var b = a.nodeWrapper, c = a.node, d = a.offset, e = b.session;
            if (!c)return null;
            var f, g, h;
            return d == b.getLength() ? (f = c.parentNode, g = f ? b.getNodeIndex() + 1 : 0) : b.isCharacterDataNode() ? (f = c, g = d + 1) : (h = c.childNodes[d], e.getNodeWrapper(h).containsPositions() ? (f = h, g = 0) : (f = c, g = d + 1)), f ? e.getPosition(f, g) : null
        }), previous: _("previous", function (a) {
            var b = a.nodeWrapper, c = a.node, d = a.offset, e = b.session, g, h, i;
            return d == 0 ? (g = c.parentNode, h = g ? b.getNodeIndex() : 0) : b.isCharacterDataNode() ? (g = c, h = d - 1) : (i = c.childNodes[d - 1], e.getNodeWrapper(i).containsPositions() ? (g = i, h = f.getNodeLength(i)) : (g = c, h = d - 1)), g ? e.getPosition(g, h) : null
        }), nextVisible: _("nextVisible", function (a) {
            var b = a.next();
            if (!b)return null;
            var c = b.nodeWrapper, d = b.node, e = b;
            return c.isCollapsed() && (e = c.session.getPosition(d.parentNode, c.getNodeIndex() + 1)), e
        }), nextUncollapsed: _("nextUncollapsed", function (a) {
            var b = a;
            while (b = b.nextVisible()) {
                b.resolveLeadingAndTrailingSpaces();
                if (b.character !== "")return b
            }
            return null
        }), previousVisible: _("previousVisible", function (a) {
            var b = a.previous();
            if (!b)return null;
            var c = b.nodeWrapper, d = b.node, e = b;
            return c.isCollapsed() && (e = c.session.getPosition(d.parentNode, c.getNodeIndex())), e
        })
    });
    var ob = null, pb = function () {
        function a(a) {
            var b = new Y;
            return {
                get: function (c) {
                    var d = b.get(c[a]);
                    if (d)for (var e = 0, f; f = d[e++];)if (f.node === c)return f;
                    return null
                }, set: function (c) {
                    var d = c.node[a], e = b.get(d) || b.set(d, []);
                    e.push(c)
                }
            }
        }

        function c() {
            this.initCaches()
        }

        var b = g.isHostProperty(document.documentElement, "uniqueID");
        return c.prototype = {
            initCaches: function () {
                this.elementCache = b ? function () {
                    var a = new Y;
                    return {
                        get: function (b) {
                            return a.get(b.uniqueID)
                        }, set: function (b) {
                            a.set(b.node.uniqueID, b)
                        }
                    }
                }() : a("tagName"), this.textNodeCache = a("data"), this.otherNodeCache = a("nodeName")
            }, getNodeWrapper: function (a) {
                var b;
                switch (a.nodeType) {
                    case 1:
                        b = this.elementCache;
                        break;
                    case 3:
                        b = this.textNodeCache;
                        break;
                    default:
                        b = this.otherNodeCache
                }
                var c = b.get(a);
                return c || (c = new ab(a, this), b.set(c)), c
            }, getPosition: function (a, b) {
                return this.getNodeWrapper(a).getPosition(b)
            }, getRangeBoundaryPosition: function (a, b) {
                var c = b ? "start" : "end";
                return this.getPosition(a[c + "Container"], a[c + "Offset"])
            }, detach: function () {
                this.elementCache = this.textNodeCache = this.otherNodeCache = null
            }
        }, c
    }();
    h(f, {nextNode: S, previousNode: T});
    var ub = Array.prototype.indexOf ? function (a, b) {
        return a.indexOf(b)
    } : function (a, b) {
        for (var c = 0, d = a.length; c < d; ++c)if (a[c] === b)return c;
        return -1
    };
    h(a.rangePrototype, {
        moveStart: Cb(!0, !1),
        moveEnd: Cb(!1, !1),
        move: Cb(!0, !0),
        trimStart: Db(!0),
        trimEnd: Db(!1),
        trim: Bb(function (a, b) {
            var c = this.trimStart(b), d = this.trimEnd(b);
            return c || d
        }),
        expand: Bb(function (a, b, c) {
            var f = !1;
            c = y(c, E);
            var g = A(c.characterOptions);
            b || (b = d);
            if (b == e) {
                var h = z(c.wordOptions), i = a.getRangeBoundaryPosition(this, !0), j = a.getRangeBoundaryPosition(this, !1), k = vb(i, g, h), l = k.nextEndToken(), m = l.chars[0].previousVisible(), n, o;
                if (this.collapsed)n = l; else {
                    var p = vb(j, g, h);
                    n = p.previousStartToken()
                }
                return o = n.chars[n.chars.length - 1], m.equals(i) || (this.setStart(m.node, m.offset), f = !0), o && !o.equals(j) && (this.setEnd(o.node, o.offset), f = !0), c.trim && (c.trimStart && (f = this.trimStart(g) || f), c.trimEnd && (f = this.trimEnd(g) || f)), f
            }
            return this.moveEnd(d, 1, c)
        }),
        text: Bb(function (a, b) {
            return this.collapsed ? "" : yb(a, this, A(b)).join("")
        }),
        selectCharacters: Bb(function (a, b, c, d, e) {
            var f = {characterOptions: e};
            b || (b = i(this.getDocument())), this.selectNodeContents(b), this.collapse(!0), this.moveStart("character", c, f), this.collapse(!0), this.moveEnd("character", d - c, f)
        }),
        toCharacterRange: Bb(function (a, b, c) {
            b || (b = i(this.getDocument()));
            var d = b.parentNode, e = f.getNodeIndex(b), g = f.comparePoints(this.startContainer, this.endContainer, d, e) == -1, h = this.cloneRange(), j, k;
            return g ? (h.setStartAndEnd(this.startContainer, this.startOffset, d, e), j = -h.text(c).length) : (h.setStartAndEnd(d, e, this.startContainer, this.startOffset), j = h.text(c).length), k = j + this.text(c).length, {
                start: j,
                end: k
            }
        }),
        findText: Bb(function (b, c, d) {
            d = y(d, C), d.wholeWordsOnly && (d.wordOptions = z(d.wordOptions), d.wordOptions.includeTrailingSpace = !1);
            var e = p(d.direction), f = d.withinRange;
            f || (f = a.createRange(), f.selectNodeContents(this.getDocument()));
            var g = c, h = !1;
            typeof g == "string" ? d.caseSensitive || (g = g.toLowerCase()) : h = !0;
            var i = b.getRangeBoundaryPosition(this, !e), j = f.comparePoint(i.node, i.offset);
            j === -1 ? i = b.getRangeBoundaryPosition(f, !0) : j === 1 && (i = b.getRangeBoundaryPosition(f, !1));
            var k = i, l = !1, m;
            for (; ;) {
                m = Ab(k, g, h, f, d);
                if (m) {
                    if (m.valid)return this.setStartAndEnd(m.startPos.node, m.startPos.offset, m.endPos.node, m.endPos.offset), !0;
                    k = e ? m.startPos : m.endPos
                } else {
                    if (!d.wrap || !!l)return !1;
                    f = f.cloneRange(), k = b.getRangeBoundaryPosition(f, !e), f.setBoundary(i.node, i.offset, e), l = !0
                }
            }
        }),
        pasteHtml: function (a) {
            this.deleteContents();
            if (a) {
                var b = this.createContextualFragment(a), c = b.lastChild;
                this.insertNode(b), this.collapseAfter(c)
            }
        }
    }), h(a.selectionPrototype, {
        expand: Bb(function (a, b, c) {
            this.changeEachRange(function (a) {
                a.expand(b, c)
            })
        }),
        move: Bb(function (a, b, c, d) {
            var e = 0;
            if (this.focusNode) {
                this.collapse(this.focusNode, this.focusOffset);
                var f = this.getRangeAt(0);
                d || (d = {}), d.characterOptions = B(d.characterOptions), e = f.move(b, c, d), this.setSingleRange(f)
            }
            return e
        }),
        trimStart: Eb("trimStart"),
        trimEnd: Eb("trimEnd"),
        trim: Eb("trim"),
        selectCharacters: Bb(function (b, c, d, e, f, g) {
            var h = a.createRange(c);
            h.selectCharacters(c, d, e, g), this.setSingleRange(h, f)
        }),
        saveCharacterRanges: Bb(function (a, b, c) {
            var d = this.getAllRanges(), e = d.length, f = [], g = e == 1 && this.isBackward();
            for (var h = 0, i = d.length; h < i; ++h)f[h] = {
                characterRange: d[h].toCharacterRange(b, c),
                backward: g,
                characterOptions: c
            };
            return f
        }),
        restoreCharacterRanges: Bb(function (b, c, d) {
            this.removeAllRanges();
            for (var e = 0, f = d.length, g, h, i; e < f; ++e)h = d[e], i = h.characterRange, g = a.createRange(c), g.selectCharacters(c, i.start, i.end, h.characterOptions), this.addRange(g, h.backward)
        }),
        text: Bb(function (a, b) {
            var c = [];
            for (var d = 0, e = this.rangeCount; d < e; ++d)c[d] = this.getRangeAt(d).text(b);
            return c.join("")
        })
    }), a.innerText = function (b, c) {
        var d = a.createRange(b);
        d.selectNodeContents(b);
        var e = d.text(c);
        return d.detach(), e
    }, a.createWordIterator = function (a, b, c) {
        var d = rb();
        c = y(c, F);
        var e = A(c.characterOptions), f = z(c.wordOptions), g = d.getPosition(a, b), h = vb(g, e, f), i = p(c.direction);
        return {
            next: function () {
                return i ? h.previousStartToken() : h.nextEndToken()
            }, dispose: function () {
                h.dispose(), this.next = function () {
                }
            }
        }
    }, a.noMutation = function (a) {
        var b = rb();
        a(b), sb()
    }, a.noMutation.createEntryPointFunction = Bb, a.textRange = {
        isBlockNode: M,
        isCollapsedWhitespaceNode: V,
        createPosition: Bb(function (a, b, c) {
            return a.getPosition(b, c)
        })
    }
})