/**
 * La Suite CSA motion.
 * Lenis smooth scroll, GSAP + ScrollTrigger, SplitType line masks.
 * Pinning and horizontal scroll run on wide screens only.
 * prefers-reduced-motion and ?static leave content in place.
 */
(function () {
	var root = document.documentElement;
	var params = new URLSearchParams(window.location.search);
	var reduce = root.classList.contains("no-motion") || params.has("static");
	var lite = root.classList.contains("lite") || window.matchMedia("(max-width: 899px), (hover: none), (pointer: coarse)").matches;
	if (lite) root.classList.add("lite");
	var skipLoader = reduce || lite || params.has("noloader") || params.has("static");
	var gsap = window.gsap;
	var ScrollTrigger = window.ScrollTrigger;
	var LenisCtor = window.Lenis;
	var SplitType = window.SplitType;

	function $(sel, ctx) {
		return (ctx || document).querySelector(sel);
	}
	function $all(sel, ctx) {
		return Array.prototype.slice.call((ctx || document).querySelectorAll(sel));
	}

	var hdr = $("[data-hdr]");
	var toggle = $(".nav-toggle");
	var nav = $(".hdr__nav");
	var lastY = 0;

	function closeNav() {
		document.body.classList.remove("nav-open");
		if (toggle) toggle.setAttribute("aria-expanded", "false");
	}

	if (toggle && nav) {
		toggle.addEventListener("click", function () {
			var open = document.body.classList.toggle("nav-open");
			toggle.setAttribute("aria-expanded", open ? "true" : "false");
		});
		nav.querySelectorAll("a").forEach(function (link) {
			link.addEventListener("click", closeNav);
		});
		document.addEventListener("keydown", function (event) {
			if (event.key === "Escape") closeNav();
		});
	}

	$all("[aria-controls^='founder-bio-']").forEach(function (button) {
		button.addEventListener("click", function () {
			var dialog = document.getElementById(button.getAttribute("aria-controls"));
			if (dialog && typeof dialog.showModal === "function" && !dialog.open) {
				dialog.showModal();
			}
		});
	});
	$all(".bio-dialog").forEach(function (dialog) {
		dialog.addEventListener("click", function (event) {
			if (event.target === dialog) dialog.close();
		});
	});

	var levers = $all(".lever");
	if (levers.length && window.matchMedia("(hover: hover) and (pointer: fine)").matches) {
		levers.forEach(function (lever) {
			lever.addEventListener("mouseenter", function () {
				levers.forEach(function (item) {
					item.classList.toggle("is-active", item === lever);
				});
			});
		});
	}

	function updateHeader(y) {
		if (!hdr) return;
		var probe = document.elementFromPoint(window.innerWidth / 2, hdr.offsetHeight + 8);
		var sec = probe && probe.closest("[data-section]");
		var tone = sec ? sec.getAttribute("data-section") : "light";
		if (document.body.classList.contains("nav-open")) tone = "dark";
		var overDarkTop = tone === "dark" && y < window.innerHeight * 0.72;
		hdr.classList.toggle("is-solid", tone === "light" && !overDarkTop);
		hdr.classList.toggle("is-dark", tone === "dark" && !overDarkTop && y > 24);
		if (!reduce && !document.body.classList.contains("nav-open")) {
			hdr.classList.toggle("is-hidden", y > window.innerHeight * 0.8 && y > lastY + 4);
			if (y < lastY - 4) hdr.classList.remove("is-hidden");
		} else {
			hdr.classList.remove("is-hidden");
		}
		lastY = y;
	}

	function splitLines(el) {
		if (!SplitType || el.dataset.splitReady) return null;
		var split = new SplitType(el, { types: "lines", lineClass: "line" });
		el.dataset.splitReady = "1";
		var inners = [];
		(split.lines || []).forEach(function (line) {
			var inner = document.createElement("span");
			inner.className = "line__i";
			while (line.firstChild) inner.appendChild(line.firstChild);
			line.appendChild(inner);
			inners.push(inner);
		});
		return inners;
	}

	if (reduce || !gsap || !ScrollTrigger) {
		window.addEventListener("scroll", function () { updateHeader(window.scrollY); }, { passive: true });
		updateHeader(window.scrollY || 0);
		if (window.__csaStall) window.clearTimeout(window.__csaStall);
		root.classList.add("js-stalled");
		window.__ready = true;
		return;
	}

	gsap.registerPlugin(ScrollTrigger);
	if (window.__csaStall) window.clearTimeout(window.__csaStall);

	var lenis = null;
	if (!lite && LenisCtor) {
		lenis = new LenisCtor({
			duration: 1.15,
			easing: function (t) { return Math.min(1, 1.001 - Math.pow(2, -10 * t)); },
			smoothWheel: true
		});
		window.__lenis = lenis;
		lenis.on("scroll", function (e) {
			ScrollTrigger.update();
			updateHeader(e.scroll);
		});
		gsap.ticker.add(function (time) { lenis.raf(time * 1000); });
		gsap.ticker.lagSmoothing(0);
		$all('a[href^="#"]').forEach(function (a) {
			a.addEventListener("click", function (event) {
				var id = a.getAttribute("href");
				if (!id || id === "#") return;
				var target = id === "#top" ? 0 : $(id);
				if (target === null) return;
				event.preventDefault();
				closeNav();
				lenis.scrollTo(target, { duration: 1.15, offset: -8 });
			});
		});
	} else {
		window.addEventListener("scroll", function () { updateHeader(window.scrollY); }, { passive: true });
	}
	updateHeader(window.scrollY || 0);

	function initLite() {
		var loader = $(".loader");
		if (loader) loader.style.display = "none";
		root.classList.add("hero-in");
		if (window.__csaStall) window.clearTimeout(window.__csaStall);
		var nodes = $all(".fade, .pillar, .hpanel, .vrow, .team__card, .inter__content, .sec-head").filter(function (el) {
			if (el.closest(".hero")) return false;
			if (el.classList.contains("fade") && el.closest(".pillar, .hpanel, .vrow, .team__card, .inter__content")) return false;
			return true;
		});
		function reveal(el) {
			if (!gsap) {
				el.style.opacity = "1";
				el.style.transform = "none";
				return;
			}
			gsap.to(el, { autoAlpha: 1, y: 0, duration: 0.6, ease: "power2.out", overwrite: true });
		}
		var pending = [];
		nodes.forEach(function (el) {
			var rect = el.getBoundingClientRect();
			if (rect.top < window.innerHeight * 0.92 && rect.bottom > 24) return;
			if (gsap) gsap.set(el, { autoAlpha: 0, y: 14 });
			pending.push(el);
		});
		if (pending.length && "IntersectionObserver" in window) {
			var watcher = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (!entry.isIntersecting) return;
					reveal(entry.target);
					watcher.unobserve(entry.target);
				});
			}, { rootMargin: "0px 0px 15% 0px", threshold: 0 });
			pending.forEach(function (el) { watcher.observe(el); });
		} else {
			pending.forEach(reveal);
		}
		window.__ready = true;
	}

	function initMotion() {
		if (lite) {
			initLite();
			return;
		}
		var isHome = document.body.classList.contains("home");

		$all(".split").forEach(function (el) {
			if (el.closest(".hscroll") && window.innerWidth >= 900) return;
			var lines = splitLines(el);
			if (!lines || !lines.length) return;
			gsap.fromTo(lines, { yPercent: 110 }, {
				yPercent: 0,
				duration: 1.15,
				ease: "expo.out",
				stagger: 0.06,
				scrollTrigger: { trigger: el, start: "top 86%", once: true }
			});
		});

		$all(".fade").forEach(function (el) {
			if (el.closest(".hero")) return;
			gsap.fromTo(el, { autoAlpha: 0, y: 28 }, {
				autoAlpha: 1,
				y: 0.5,
				duration: 1.05,
				ease: "expo.out",
				scrollTrigger: { trigger: el, start: "top 90%", once: true }
			});
		});

		$all(".reveal-clip").forEach(function (el) {
			var img = $("img", el);
			var tl = gsap.timeline({ scrollTrigger: { trigger: el, start: "top 86%", once: true } });
			tl.to(el, { clipPath: "inset(0% 0 0 0)", duration: 1.3, ease: "expo.inOut" });
			if (img) tl.from(img, { scale: 1.18, duration: 1.5, ease: "expo.out" }, 0.05);
		});

		$all(".parallax").forEach(function (el) {
			var sp = parseFloat(el.dataset.speed || "0.1");
			gsap.fromTo(el, { yPercent: -sp * 40 }, {
				yPercent: sp * 40,
				ease: "none",
				scrollTrigger: { trigger: el.parentElement, start: "top bottom", end: "bottom top", scrub: true }
			});
		});

		$all(".sec-head .hair").forEach(function (el) {
			gsap.from(el, {
				scaleX: 0,
				duration: 1.2,
				ease: "expo.inOut",
				scrollTrigger: { trigger: el, start: "top 90%", once: true }
			});
		});

		$all("[data-words]").forEach(function (el) {
			if (!SplitType) return;
			var split = new SplitType(el, { types: "words" });
			var words = split.words || [];
			if (!words.length) return;
			gsap.fromTo(words, { color: "#231F20" }, {
				color: "#1C3B6B",
				stagger: 0.035,
				ease: "none",
				scrollTrigger: {
					trigger: el,
					start: "top 72%",
					end: "top 46%",
					scrub: 0.35
				}
			});
		});

		$all(".vrow").forEach(function (row) {
			var title = $(".vrow__t", row);
			if (!title) return;
			gsap.from(title, {
				yPercent: 80,
				duration: 1.05,
				ease: "expo.out",
				scrollTrigger: { trigger: row, start: "top 92%", once: true }
			});
		});

		var inter = $(".inter__media");
		if (inter) {
			gsap.fromTo(inter, { clipPath: "inset(12% 10% 12% 10%)" }, {
				clipPath: "inset(0% 0% 0% 0%)",
				ease: "none",
				scrollTrigger: { trigger: ".inter", start: "top bottom", end: "top 18%", scrub: true }
			});
			var interImg = $("img", inter);
			if (interImg) {
				gsap.fromTo(interImg, { scale: 1.18 }, {
					scale: 1,
					ease: "none",
					scrollTrigger: { trigger: ".inter", start: "top bottom", end: "bottom top", scrub: true }
				});
			}
		}

		if (isHome) {
			runHomeIntro();
			var mm = gsap.matchMedia();
			mm.add("(min-width: 900px) and (hover: hover) and (pointer: fine)", function () {
				var unpinPillars = pinPillars();
				var unpinTrack = pinHorizontal();
				return function () {
					if (unpinPillars) unpinPillars();
					if (unpinTrack) unpinTrack();
				};
			});
			mm.add("(max-width: 899px)", function () {
				$all(".hpanel__fig, .pillars__img").forEach(function (el) {
					gsap.fromTo(el, { clipPath: "inset(12% 0 0 0)" }, {
						clipPath: "inset(0% 0 0 0)",
						duration: 1.1,
						ease: "expo.out",
						scrollTrigger: { trigger: el, start: "top 88%", once: true }
					});
				});
			});
		}

		if (window.matchMedia("(hover: hover) and (pointer: fine)").matches) {
			root.classList.add("has-cursor");
			var c = $(".cursor");
			var dot = $(".cursor__dot");
			var ring = $(".cursor__ring");
			if (c && dot && ring) {
				var dx = gsap.quickTo(dot, "x", { duration: 0.12 });
				var dy = gsap.quickTo(dot, "y", { duration: 0.12 });
				var rx = gsap.quickTo(ring, "x", { duration: 0.45, ease: "power3" });
				var ry = gsap.quickTo(ring, "y", { duration: 0.45, ease: "power3" });
				var shown = false;
				window.addEventListener("pointermove", function (e) {
					if (!shown) { shown = true; c.classList.add("is-on"); }
					dx(e.clientX); dy(e.clientY); rx(e.clientX); ry(e.clientY);
				});
				document.addEventListener("pointerover", function (e) {
					var t = e.target;
					c.classList.toggle("is-link", !!(t.closest && t.closest("a, button")));
					c.classList.toggle("is-media", !!(t.closest && t.closest("[data-cursor]")));
				});
			}
			$all("[data-magnetic]").forEach(function (el) {
				var xT = gsap.quickTo(el, "x", { duration: 0.6, ease: "power3.out" });
				var yT = gsap.quickTo(el, "y", { duration: 0.6, ease: "power3.out" });
				el.addEventListener("pointermove", function (e) {
					var r = el.getBoundingClientRect();
					xT((e.clientX - r.left - r.width / 2) * 0.28);
					yT((e.clientY - r.top - r.height / 2) * 0.28);
				});
				el.addEventListener("pointerleave", function () { xT(0); yT(0); });
			});
		}

		window.addEventListener("load", function () { ScrollTrigger.refresh(); });
		if (document.fonts && document.fonts.ready) {
			document.fonts.ready.then(function () { ScrollTrigger.refresh(); });
		}
		if (!isHome) window.__ready = true;
	}

	function runHomeIntro() {
		var heroLines = $all(".hero__title .ln__i");
		var loader = $(".loader");
		if (lenis) lenis.stop();
		root.classList.add("booting");
		void document.body.offsetHeight;
		gsap.set(heroLines, { clearProps: "transform" });
		gsap.set(heroLines, { yPercent: 110 });
		var intro = gsap.timeline({
			defaults: { ease: "expo.out" },
			onComplete: function () {
				gsap.set(heroLines, { clearProps: "transform" });
				root.classList.add("hero-in");
				if (lenis) lenis.start();
				window.__ready = true;
			}
		});
		if (loader && !skipLoader) {
			gsap.set(".loader__word span", { yPercent: 120 });
			gsap.set(".loader__mark", { clipPath: "inset(0 0 100% 0)" });
			intro
				.to(".loader__mark", { clipPath: "inset(0 0 0% 0)", duration: 0.9, ease: "expo.inOut" }, 0.1)
				.to(".loader__word span", { yPercent: 0, duration: 0.8, stagger: 0.06 }, 0.55)
				.to(".loader__inner", { y: -24, autoAlpha: 0, duration: 0.45, ease: "power3.in" }, 1.35)
				.to(loader, { clipPath: "inset(0 0 100% 0)", duration: 0.85, ease: "expo.inOut" }, 1.55)
				.set(loader, { display: "none" });
		} else if (loader) {
			loader.style.display = "none";
		}
		var s = skipLoader ? 0.05 : 1.7;
		intro
			.fromTo(".hero__img", { scale: 1.16 }, { scale: 1.04, duration: 2.1, ease: "expo.out" }, Math.max(0, s - 0.2))
			.to(".hero__kicker", { autoAlpha: 1, duration: 0.8 }, s)
			.to(heroLines, { yPercent: 0, duration: 1.15, stagger: 0.08 }, s)
			.fromTo(".hero__rule", { scaleX: 0 }, { scaleX: 1, duration: 1.2, ease: "expo.inOut" }, s + 0.1)
			.fromTo(".hero .fade", { autoAlpha: 0, y: 24 }, { autoAlpha: 1, y: 0.5, duration: 0.9, stagger: 0.06 }, s + 0.35)
			.add(function () { root.classList.add("hero-in"); });
		gsap.to(".hero__img", {
			yPercent: 10,
			ease: "none",
			scrollTrigger: { trigger: ".hero", start: "top top", end: "bottom top", scrub: true }
		});
		gsap.to(".hero__title", {
			yPercent: -12,
			autoAlpha: 0.35,
			ease: "none",
			scrollTrigger: { trigger: ".hero", start: "35% top", end: "bottom top", scrub: true }
		});
	}

	function pinPillars() {
		var sec = $(".pillars");
		if (!sec) return;
		sec.classList.add("is-pinned");
		var pillars = $all(".pillar");
		var imgs = $all(".pillars__img");
		var tabs = $all(".pillars__tabs li");
		if (pillars.length < 2) return;
		var parts = pillars.map(function (p) {
			var title = $(".pillar__title", p);
			var words = [];
			if (title && title.dataset.wordSplit) {
				words = $all(".w > span", title);
			} else if (title) {
				title.dataset.wordSplit = "1";
				var bits = title.textContent.split(/(\s+)/);
				title.textContent = "";
				title.setAttribute("aria-label", bits.join("").replace(/\s+/g, " ").trim());
				bits.forEach(function (part) {
					if (!part) return;
					if (/^\s+$/.test(part)) {
						title.appendChild(document.createTextNode(" "));
						return;
					}
					var o = document.createElement("span");
					o.className = "w";
					var i = document.createElement("span");
					i.textContent = part;
					o.appendChild(i);
					title.appendChild(o);
					words.push(i);
				});
			}
			return { words: words, body: $(".pillar__body", p), link: $(".pillar__link", p) };
		});
		pillars.forEach(function (p, i) {
			if (!i) return;
			gsap.set(parts[i].words, { yPercent: 110 });
			gsap.set([parts[i].body, parts[i].link], { autoAlpha: 0, y: 16 });
		});
		gsap.set(imgs, { clipPath: "inset(100% 0 0 0)" });
		if (imgs[0]) gsap.set(imgs[0], { clipPath: "inset(0% 0 0 0)" });
		var tl = gsap.timeline({ defaults: { ease: "power3.inOut" } });
		for (var i = 1; i < pillars.length; i++) {
			var at = i * 1.35;
			tl.to(parts[i - 1].words, { yPercent: -110, duration: 0.55, stagger: 0.025 }, at)
				.to([parts[i - 1].body, parts[i - 1].link], { autoAlpha: 0, y: -12, duration: 0.4 }, at)
				.to(parts[i].words, { yPercent: 0, duration: 0.7, stagger: 0.03, ease: "expo.out" }, at + 0.32)
				.to([parts[i].body, parts[i].link], { autoAlpha: 1, y: 0, duration: 0.55, ease: "expo.out" }, at + 0.42);
			if (imgs[i]) {
				tl.to(imgs[i], { clipPath: "inset(0% 0 0 0)", duration: 0.9, ease: "expo.inOut" }, at);
			}
		}
		tl.to({}, { duration: 0.45 });
		ScrollTrigger.create({
			trigger: sec,
			start: "top top",
			end: "+=180%",
			pin: ".pillars__pin",
			scrub: 0.6,
			animation: tl,
			onUpdate: function (self) {
				var p = self.progress * pillars.length;
				tabs.forEach(function (tab, index) {
					tab.style.setProperty("--p", String(Math.min(1, Math.max(0, p - index))));
					tab.classList.toggle("is-on", p >= index && (p < index + 1 || index === pillars.length - 1));
				});
			}
		});
		return function () { sec.classList.remove("is-pinned"); };
	}

	function pinHorizontal() {
		var svc = $(".hscroll");
		var track = $(".hscroll__track");
		if (!svc || !track) return;
		svc.classList.add("is-hscroll");
		var dist = function () { return Math.max(0, track.scrollWidth - window.innerWidth); };
		gsap.to(track, {
			x: function () { return -dist(); },
			ease: "none",
			scrollTrigger: {
				trigger: svc,
				start: "top top",
				end: function () { return "+=" + dist(); },
				pin: ".hscroll__pin",
				scrub: 0.85,
				invalidateOnRefresh: true,
				onUpdate: function (self) {
					gsap.set(".hscroll__prog i", { scaleX: self.progress });
				}
			}
		});
		var headline = $(".hpanel__title.split");
		if (headline) {
			var lines = splitLines(headline);
			if (lines && lines.length) {
				gsap.fromTo(lines, { yPercent: 110 }, {
					yPercent: 0,
					duration: 1.1,
					ease: "expo.out",
					stagger: 0.05,
					scrollTrigger: { trigger: svc, start: "top 70%", once: true }
				});
			}
		}
		return function () { svc.classList.remove("is-hscroll"); };
	}

	initMotion();
})();
