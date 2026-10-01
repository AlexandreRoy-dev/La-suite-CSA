/**
 * La Suite CSA motion - fintech SaaS entrances.
 * Native scroll preserved. GSAP for transform/opacity only.
 */
document.documentElement.classList.add('js');

(function () {
	var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
	var header = document.querySelector('.site-header');
	var toggle = document.querySelector('.nav-toggle');
	var nav = document.querySelector('.site-nav');
	var gsap = window.gsap;
	var ScrollTrigger = window.ScrollTrigger;

	function closeNav() {
		document.body.classList.remove('nav-open');
		if (toggle) toggle.setAttribute('aria-expanded', 'false');
	}

	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			var open = document.body.classList.toggle('nav-open');
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
		nav.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', closeNav);
		});
		document.addEventListener('keydown', function (event) {
			if (event.key === 'Escape') closeNav();
		});
	}

	var progress = document.querySelector('.progress');
	if (progress) {
		var paintProgress = function () {
			var max = document.documentElement.scrollHeight - window.innerHeight;
			var value = max > 0 ? Math.min(1, Math.max(0, window.scrollY / max)) : 0;
			progress.style.setProperty('--progress', String(value));
		};
		paintProgress();
		window.addEventListener('scroll', paintProgress, { passive: true });
		window.addEventListener('resize', paintProgress);
	}

	document.querySelectorAll('[aria-controls^="founder-bio-"]').forEach(function (button) {
		button.addEventListener('click', function () {
			var dialog = document.getElementById(button.getAttribute('aria-controls'));
			if (dialog && typeof dialog.showModal === 'function' && !dialog.open) {
				dialog.showModal();
			}
		});
	});

	document.querySelectorAll('.bio-dialog').forEach(function (dialog) {
		dialog.addEventListener('click', function (event) {
			if (event.target === dialog) dialog.close();
		});
	});

	var levers = document.querySelectorAll('.lever');
	if (levers.length && finePointer) {
		levers.forEach(function (lever) {
			lever.addEventListener('mouseenter', function () {
				levers.forEach(function (item) {
					item.classList.toggle('is-active', item === lever);
				});
			});
		});
	}

	function initHeroParallax() {
		var hero = document.querySelector('.hero--canvas');
		var stage = document.querySelector('.hero-stage');
		var visual = document.querySelector('.hero-visual');
		var stack = document.querySelector('.glass-stack');
		var orbs = document.querySelectorAll('.hero__orb');
		if (!hero || !stage || reduce || !finePointer) return;

		var targetX = 0;
		var targetY = 0;
		var currentX = 0;
		var currentY = 0;

		function tick() {
			currentX += (targetX - currentX) * 0.07;
			currentY += (targetY - currentY) * 0.07;
			stage.style.transform =
				'translateX(calc(-50% + ' + (currentX * 0.55).toFixed(2) + 'px)) translateY(' + (currentY * 0.45).toFixed(2) + 'px)';
			if (visual) {
				visual.style.transform =
					'translate3d(' + (currentX * 0.15).toFixed(2) + 'px, ' + (currentY * 0.1).toFixed(2) + 'px, 0)';
			}
			if (stack) {
				stack.style.transform =
					'translate3d(' + (-currentX * 0.4).toFixed(2) + 'px, ' + (-currentY * 0.28).toFixed(2) + 'px, 0)';
			}
			orbs.forEach(function (orb, i) {
				var depth = 0.2 + i * 0.12;
				orb.style.transform =
					'translate3d(' + (currentX * depth).toFixed(2) + 'px, ' + (currentY * depth).toFixed(2) + 'px, 0)';
			});
			requestAnimationFrame(tick);
		}

		hero.addEventListener('mousemove', function (event) {
			var box = hero.getBoundingClientRect();
			var px = (event.clientX - box.left) / box.width - 0.5;
			var py = (event.clientY - box.top) / box.height - 0.5;
			targetX = px * 22;
			targetY = py * 14;
		});

		hero.addEventListener('mouseleave', function () {
			targetX = 0;
			targetY = 0;
		});

		requestAnimationFrame(tick);
	}

	if (window.matchMedia('(min-width: 900px)').matches) {
		window.setTimeout(initHeroParallax, 1000);
	}

	function showAll() {
		document.querySelectorAll('.reveal, .line-word span, [data-reveal]').forEach(function (el) {
			el.classList.add('is-in');
			el.style.opacity = '1';
			el.style.transform = 'none';
			el.style.filter = 'none';
			el.style.clipPath = 'none';
		});
	}

	function initReveal(scope) {
		var root = scope || document;
		var reveals = root.querySelectorAll('[data-reveal]');
		if (!reveals.length) return;

		if (reduce || !('IntersectionObserver' in window)) {
			reveals.forEach(function (el) {
				el.classList.add('is-in');
			});
			return;
		}

		var io = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (!entry.isIntersecting) return;
					entry.target.classList.add('is-in');
					io.unobserve(entry.target);
				});
			},
			{ threshold: 0.2, rootMargin: '0px 0px -8% 0px' }
		);

		reveals.forEach(function (el) {
			io.observe(el);
		});
	}

	function animateCountUps(scope) {
		var root = scope || document;
		root.querySelectorAll('[data-count-up]').forEach(function (el) {
			var target = parseFloat(el.getAttribute('data-count-up'));
			if (isNaN(target)) return;
			if (reduce) {
				el.textContent = String(target);
				return;
			}
			var start = 0;
			var duration = 900;
			var startTime = null;
			function tick(now) {
				if (!startTime) startTime = now;
				var p = Math.min(1, (now - startTime) / duration);
				var eased = 1 - Math.pow(1 - p, 3);
				el.textContent = String(Math.round(start + (target - start) * eased));
				if (p < 1) requestAnimationFrame(tick);
			}
			requestAnimationFrame(tick);
		});
	}

	if (reduce) {
		showAll();
		initReveal(document);
		animateCountUps(document);
		return;
	}

	initReveal(document);
	animateCountUps(document);

	var hasGsap = typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined';

	if (!hasGsap) {
		if (!('IntersectionObserver' in window)) {
			showAll();
			return;
		}
		var io = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (!entry.isIntersecting) return;
					entry.target.classList.add('is-in');
					io.unobserve(entry.target);
				});
			},
			{ rootMargin: '0px 0px -12% 0px', threshold: 0.12 }
		);
		document.querySelectorAll('.reveal').forEach(function (el) {
			io.observe(el);
		});
		return;
	}

	gsap.registerPlugin(ScrollTrigger);
	document.documentElement.classList.add('gsap-ready');

	function killAll() {
		ScrollTrigger.getAll().forEach(function (st) {
			st.kill();
		});
	}

	function initMotion(scope) {
		var root = scope || document;
		var compactNow = window.matchMedia('(max-width: 899px)').matches;

		if (header) {
			ScrollTrigger.create({
				start: 0,
				end: 'max',
				onUpdate: function (self) {
					if (document.body.classList.contains('nav-open')) {
						header.classList.remove('is-hidden');
						return;
					}
					header.classList.toggle('is-scrolled', self.scroll() > 16);
					header.classList.toggle('is-hidden', self.direction === 1 && self.scroll() > 140);
				},
			});
		}

		var promise = root.querySelector('.promise-card');
		if (promise) {
			gsap.fromTo(
				promise,
				{ autoAlpha: 0, y: 24, scale: 0.98 },
				{
					autoAlpha: 1,
					y: 0,
					scale: 1,
					duration: 0.75,
					ease: 'power3.out',
					scrollTrigger: {
						trigger: promise,
						start: 'top 88%',
						once: true,
					},
				}
			);
		}

		var timeline = root.querySelector('.timeline');
		if (timeline) {
			ScrollTrigger.create({
				trigger: timeline,
				start: 'top 80%',
				once: true,
				onEnter: function () {
					timeline.classList.add('is-drawn');
				},
			});
		}

		root.querySelectorAll('.friction-list__item').forEach(function (el, i) {
			gsap.fromTo(
				el,
				{ autoAlpha: 0, x: compactNow ? 0 : 36, y: compactNow ? 22 : 0 },
				{
					autoAlpha: 1,
					x: 0,
					y: 0,
					duration: 0.7,
					delay: i * 0.08,
					ease: 'power3.out',
					scrollTrigger: {
						trigger: el,
						start: 'top 90%',
						once: true,
					},
				}
			);
		});

		root.querySelectorAll('.service-band').forEach(function (el, i) {
			var fromX = compactNow ? 0 : i % 2 === 0 ? -48 : 48;
			gsap.fromTo(
				el,
				{ autoAlpha: 0, x: fromX, y: compactNow ? 28 : 0 },
				{
					autoAlpha: 1,
					x: 0,
					y: 0,
					duration: 0.85,
					ease: 'power3.out',
					scrollTrigger: {
						trigger: el,
						start: 'top 88%',
						once: true,
					},
				}
			);
		});

		root.querySelectorAll('.timeline-item').forEach(function (el, i) {
			var odd = i % 2 === 0;
			gsap.fromTo(
				el,
				{
					autoAlpha: 0,
					x: compactNow ? 0 : odd ? -40 : 40,
					y: compactNow ? 24 : 16,
				},
				{
					autoAlpha: 1,
					x: 0,
					y: 0,
					duration: 0.75,
					ease: 'power3.out',
					scrollTrigger: {
						trigger: el,
						start: 'top 88%',
						once: true,
						onEnter: function () {
							el.classList.add('is-in');
						},
					},
				}
			);
		});

		var quote = root.querySelector('.quote--saas');
		if (quote) {
			gsap.fromTo(
				quote,
				{ autoAlpha: 0, y: 40, scale: 0.96 },
				{
					autoAlpha: 1,
					y: 0,
					scale: 1,
					duration: 0.9,
					ease: 'power3.out',
					scrollTrigger: {
						trigger: quote,
						start: 'top 85%',
						once: true,
					},
				}
			);
		}

		if (!compactNow) {
			root.querySelectorAll('.parallax-media').forEach(function (el) {
				gsap.fromTo(
					el,
					{ yPercent: -6, scale: 1.06 },
					{
						yPercent: 6,
						scale: 1.06,
						ease: 'none',
						scrollTrigger: {
							trigger: el.parentElement || el,
							start: 'top bottom',
							end: 'bottom top',
							scrub: true,
						},
					}
				);
			});
		}

		root.querySelectorAll('.reveal').forEach(function (el) {
			if (el.closest('.hero--canvas')) return;
			if (el.classList.contains('friction-list__item')) return;
			if (el.classList.contains('service-band')) return;
			if (el.closest('.timeline-item')) return;
			if (el.closest('.quote-saas')) return;
			gsap.fromTo(
				el,
				{ autoAlpha: 0, y: compactNow ? 24 : 36 },
				{
					autoAlpha: 1,
					y: 0,
					duration: 0.7,
					ease: 'power3.out',
					scrollTrigger: {
						trigger: el,
						start: compactNow ? 'top 92%' : 'top 88%',
						toggleActions: 'play none none none',
					},
				}
			);
		});

		if (finePointer) {
			root.querySelectorAll('.button, .header-cta').forEach(function (btn) {
				if (btn.dataset.mag) return;
				btn.dataset.mag = '1';
				btn.addEventListener('mousemove', function (event) {
					var box = btn.getBoundingClientRect();
					var x = event.clientX - box.left - box.width / 2;
					var y = event.clientY - box.top - box.height / 2;
					gsap.to(btn, { x: x * 0.08, y: y * 0.1, duration: 0.3, ease: 'power2.out' });
				});
				btn.addEventListener('mouseleave', function () {
					gsap.to(btn, { x: 0, y: 0, duration: 0.45, ease: 'power3.out' });
				});
			});
		}

		ScrollTrigger.refresh();
	}

	initMotion(document);

	window.laSuiteCsaMotion = {
		refresh: function (scope) {
			killAll();
			initReveal(scope || document);
			animateCountUps(scope || document);
			initMotion(scope || document);
		},
	};
})();
