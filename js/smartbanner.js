!function (t) {
	function s() {
		var t = document.createElement("smartbanner"),
		s = {
			WebkitTransition: "webkitTransitionEnd",
			MozTransition: "transitionend",
			OTransition: "oTransitionEnd otransitionend",
			transition: "transitionend"
		};
		for (var i in s)
			if (void 0 !== t.style[i])
				return {
					end: s[i]
				};
		return !1
	}
	var i = function (s) {
		this.origHtmlMargin = parseFloat(t("html").css("margin-top")),
		this.options = t.extend({}, t.smartbanner.defaults, s);
		var i = navigator.standalone,
		n = navigator.userAgent;
		if (this.options.force ? this.type = this.options.force : null != n.match(/Windows Phone 8/i) && null !== n.match(/Touch/i) ? this.type = "windows" : null != n.match(/iPhone|iPod/i) || n.match(/iPad/) && this.options.iOSUniversalApp ? null != n.match(/Safari/i) && (null != n.match(/CriOS/i) || window.Number(n.substr(n.indexOf("OS ") + 3, 3).replace("_", ".")) < 6) && (this.type = "ios") : n.match(/\bSilk\/(.*\bMobile Safari\b)?/) || n.match(/\bKF\w/) || n.match("Kindle Fire") ? this.type = "kindle" : null != n.match(/Android/i) && (this.type = "android"), this.type && !i && !this.getCookie("sb-closed") && !this.getCookie("sb-installed")) {
			this.scale = "auto" == this.options.scale ? t(window).width() / window.screen.width : this.options.scale,
			this.scale < 1 && (this.scale = 1);
			var e = t("android" == this.type ? 'meta[name="google-play-app"]' : "ios" == this.type ? 'meta[name="apple-itunes-app"]' : "kindle" == this.type ? 'meta[name="kindle-fire-app"]' : 'meta[name="msApplication-ID"]');
			if (0 != e.length) {
				if ("windows" == this.type)
					this.appId = t('meta[name="msApplication-PackageFamilyName"]').attr("content");
				else {
					var o = /app-id=([^\s,]+)/.exec(e.attr("content"));
					if (!o)
						return;
					this.appId = o[1]
				}
				this.title = this.options.title ? this.options.title : e.data("title") || t("title").text().replace(/\s*[|\-Ã‚Â·].*$/, ""),
				this.author = this.options.author ? this.options.author : e.data("author") || (t('meta[name="author"]').length ? t('meta[name="author"]').attr("content") : window.location.hostname),
				this.iconUrl = e.data("icon-url"),
				this.price = e.data("price"),
				this.create(),
				this.show(),
				this.listen()
			}
		}
	};
	i.prototype = {
		constructor: i,
		create: function () {
			var s,
			i = this.options.url ? this.options.url : ("windows" == this.type ? "ms-windows-store:navigate?appid=" : "android" == this.type ? "market://details?id=" : "kindle" == this.type ? "amzn://apps/android?asin=" : "https://itunes.apple.com/" + this.options.appStoreLanguage + "/app/id") + this.appId,
			n = this.price || this.options.price,
			e = n ? n + " - " + ("android" == this.type ? this.options.inGooglePlay : "kindle" == this.type ? this.options.inAmazonAppStore : "ios" == this.type ? this.options.inAppStore : this.options.inWindowsStore) : "",
			o = null === this.options.iconGloss ? "ios" == this.type : this.options.iconGloss;
			"android" == this.type && this.options.GooglePlayParams && (i = i + "&referrer=" + this.options.GooglePlayParams);
			var a = '<div id="smartbanner" class="' + this.type + '"><div class="sb-container"><a href="#" class="sb-close">&times;</a><span class="sb-icon"></span><div class="sb-info"><strong>' + this.title + "</strong><span>" + this.author + "</span><span>" + e + '</span></div><a href="' + i + '" class="sb-button"><span>' + this.options.button + "</span></a></div></div>";
			this.options.layer ? t(this.options.appendToSelector).append(a) : t(this.options.appendToSelector).prepend(a),
			this.options.icon ? s = this.options.icon : this.iconUrl ? s = this.iconUrl : t('link[rel="apple-touch-icon-precomposed"]').length > 0 ? (s = t('link[rel="apple-touch-icon-precomposed"]').attr("href"), null === this.options.iconGloss && (o = !1)) : t('link[rel="apple-touch-icon"]').length > 0 ? s = t('link[rel="apple-touch-icon"]').attr("href") : t('meta[name="msApplication-TileImage"]').length > 0 ? s = t('meta[name="msApplication-TileImage"]').attr("content") : t('meta[name="msapplication-TileImage"]').length > 0 && (s = t('meta[name="msapplication-TileImage"]').attr("content")),
			s ? (t("#smartbanner .sb-icon").css("background-image", "url(" + s + ")"), o && t("#smartbanner .sb-icon").addClass("gloss")) : t("#smartbanner").addClass("no-icon"),
			this.bannerHeight = t("#smartbanner").outerHeight() + 2,
			this.scale > 1 && (t("#smartbanner").css("top", parseFloat(t("#smartbanner").css("top")) * this.scale).css("height", parseFloat(t("#smartbanner").css("height")) * this.scale).hide(), t("#smartbanner .sb-container").css("-webkit-transform", "scale(" + this.scale + ")").css("-msie-transform", "scale(" + this.scale + ")").css("-moz-transform", "scale(" + this.scale + ")").css("width", t(window).width() / this.scale)),
			t("#smartbanner").css("position", this.options.layer ? "absolute" : "static")
		},
		listen: function () {
			t("#smartbanner .sb-close").on("click", t.proxy(this.close, this)),
			t("#smartbanner .sb-button").on("click", t.proxy(this.install, this))
		},
		show: function (s) {
			var i = t("#smartbanner");
			if (i.stop(), this.options.layer)
				i.animate({
					top: 0,
					display: "block"
				}, this.options.speedIn).addClass("shown").show(), t(this.pushSelector).animate({
					paddingTop: this.origHtmlMargin + this.bannerHeight * this.scale
				}, this.options.speedIn, "swing", s);
			else if (t.support.transition) {
				i.animate({
					top: 0
				}, this.options.speedIn).addClass("shown");
				var n = function () {
					t("html").removeClass("sb-animation"),
					s && s()
				};
				t(this.pushSelector).addClass("sb-animation").one(t.support.transition.end, n).emulateTransitionEnd(this.options.speedIn).css("margin-top", this.origHtmlMargin + this.bannerHeight * this.scale)
			} else
				i.slideDown(this.options.speedIn).addClass("shown")
		},
		hide: function (s) {
			var i = t("#smartbanner");
			if (i.stop(), this.options.layer)
				i.animate({
					top: -1 * this.bannerHeight * this.scale,
					display: "block"
				}, this.options.speedIn).removeClass("shown"), t(this.pushSelector).animate({
					paddingTop: this.origHtmlMargin
				}, this.options.speedIn, "swing", s);
			else if (t.support.transition) {
				"android" !== this.type ? i.css("top", -1 * this.bannerHeight * this.scale).removeClass("shown") : i.css({
					display: "none"
				}).removeClass("shown");
				var n = function () {
					t("html").removeClass("sb-animation"),
					s && s()
				};
				t(this.pushSelector).addClass("sb-animation").one(t.support.transition.end, n).emulateTransitionEnd(this.options.speedOut).css("margin-top", this.origHtmlMargin)
			} else
				i.slideUp(this.options.speedOut).removeClass("shown")
		},
		close: function (t) {
			t.preventDefault(),
			this.hide(),
			this.setCookie("sb-closed", "true", this.options.daysHidden)
		},
		install: function () {
			this.options.hideOnInstall && this.hide(),
			this.setCookie("sb-installed", "true", this.options.daysReminder)
		},
		setCookie: function (t, s, i) {
			var n = new Date;
			n.setDate(n.getDate() + i),
			s = encodeURI(s) + (null == i ? "" : "; expires=" + n.toUTCString()),
			document.cookie = t + "=" + s + "; path=/;"
		},
		getCookie: function (t) {
			var s,
			i,
			n,
			e = document.cookie.split(";");
			for (s = 0; s < e.length; s++)
				if (i = e[s].substr(0, e[s].indexOf("=")), n = e[s].substr(e[s].indexOf("=") + 1), i = i.replace(/^\s+|\s+$/g, ""), i == t)
					return decodeURI(n);
			return null
		},
		switchType: function () {
			var s = this;
			this.hide(function () {
				s.type = "android" == s.type ? "ios" : "android";
				var i = t("android" == s.type ? 'meta[name="google-play-app"]' : 'meta[name="apple-itunes-app"]').attr("content");
				s.appId = /app-id=([^\s,]+)/.exec(i)[1],
				t("#smartbanner").detach(),
				s.create(),
				s.show()
			})
		}
	},
	t.smartbanner = function (s) {
		var n = t(window),
		e = n.data("smartbanner"),
		o = "object" == typeof s && s;
		e || n.data("smartbanner", e = new i(o)),
		"string" == typeof s && e[s]()
	},
	t.smartbanner.defaults = {
		title: null,
		author: null,
		price: "FREE",
		appStoreLanguage: "us",
		inAppStore: "On the App Store",
		inGooglePlay: "In Google Play",
		inAmazonAppStore: "In the Amazon Appstore",
		inWindowsStore: "In the Windows Store",
		GooglePlayParams: null,
		icon: null,
		iconGloss: null,
		button: "VIEW",
		url: null,
		scale: "auto",
		speedIn: 300,
		speedOut: 400,
		daysHidden: 15,
		daysReminder: 90,
		force: null,
		hideOnInstall: !0,
		layer: !1,
		iOSUniversalApp: !0,
		appendToSelector: "body",
		pushSelector: "html"
	},
	t.smartbanner.Constructor = i,
	void 0 === t.support.transition && (t.fn.emulateTransitionEnd = function (s) {
		var i = !1,
		n = this;
		t(this).one(t.support.transition.end, function () {
			i = !0
		});
		var e = function () {
			i || t(n).trigger(t.support.transition.end)
		};
		return setTimeout(e, s),
		this
	}, t(function () {
			t.support.transition = s()
		}))
}
(window.jQuery), $.smartbanner({
	title: "Travelex Money",
	author: "Download the App now.",
	appStoreLanguage: "en",
	icon: "https://lh3.googleusercontent.com/bNWLo6RMVIOm2UrFc82HazL3KYqM_gR0IBeIAk5KbBzFuINB3UBG1NtiY8Af2M-W-A=w300",
	hideOnInstall: !0,
	daysHidden: 1
});