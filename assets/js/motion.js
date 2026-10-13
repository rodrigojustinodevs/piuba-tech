/**
 * Piuba Tech — camada de movimento.
 * Intersection Observer para entradas e contadores, um laço rAF para o
 * parallax do mar e a cor da barra. Sem dependências.
 */
(function () {
	'use strict';

	var doc = document;
	var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var hasIO = 'IntersectionObserver' in window;

	/* ---------- Entradas: título, depois texto, depois imagem. ---------- */
	var revealSel = [
		'.ch h1', '.ch h2', '.ch h3', '.ch > p', '.ch .wp-block-buttons',
		'.ch p:not(.ui p)', '.ch li:not(.ui li)', '.ch .ui', '.dx__tool', '.lead-form', '.page-intro__index a'
	].join(',');
	var mediaSel = '.ch .wp-block-image:not(.hero__photo)';

	function prepare() {
		doc.querySelectorAll('.ch, .about__panel').forEach(function (section) {
			if (section.classList.contains('hero')) return;
			var i = 0;
			section.querySelectorAll(revealSel).forEach(function (el) {
				if (el.closest('.rv') || el.closest('.hero') || el.closest('.foot__mark') || el.closest('.step')) return;
				el.classList.add('rv');
				el.style.setProperty('--d', Math.min(i++, 6));
			});
			section.querySelectorAll(mediaSel).forEach(function (el) {
				if (el.closest('.rv')) return;
				el.classList.add('rv-media');
				el.style.setProperty('--d', Math.min(i++, 6));
			});
		});
	}

	function reveal() {
		var items = doc.querySelectorAll('.rv, .rv-media, .foot__mark');
		if (!hasIO || reduce) {
			items.forEach(function (el) { el.classList.add('is-in'); });
			return;
		}
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (e) {
				if (!e.isIntersecting) return;
				e.target.classList.add('is-in');
				io.unobserve(e.target);
			});
		}, { rootMargin: '0px 0px -8% 0px', threshold: 0.12 });
		items.forEach(function (el) { io.observe(el); });
	}

	/* ---------- Contadores: o valor final já está no HTML. ---------- */
	function counters() {
		var els = doc.querySelectorAll('[data-count]');
		if (!els.length || !hasIO || reduce) return;
		var run = function (el) {
			var to = parseInt(el.getAttribute('data-count'), 10) || 0;
			var dur = 1400 + Math.min(to, 50) * 12;
			var t0 = null;
			var step = function (t) {
				if (t0 === null) t0 = t;
				var p = Math.min((t - t0) / dur, 1);
				var eased = 1 - Math.pow(1 - p, 4);
				el.textContent = Math.round(to * eased);
				if (p < 1) requestAnimationFrame(step);
			};
			el.textContent = '0';
			requestAnimationFrame(step);
		};
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (e) {
				if (!e.isIntersecting) return;
				run(e.target);
				io.unobserve(e.target);
			});
		}, { threshold: 0.6 });
		els.forEach(function (el) { io.observe(el); });
	}

	/* ---------- Acordeão do processo. ---------- */
	function accordion() {
		doc.querySelectorAll('.steps__row').forEach(function (row) {
			var steps = Array.prototype.slice.call(row.querySelectorAll('.step'));
			if (!steps.length) return;
			row.classList.add('is-enhanced');
			var open = function (target) {
				steps.forEach(function (s) {
					var on = s === target;
					s.classList.toggle('is-open', on);
					s.setAttribute('aria-expanded', on ? 'true' : 'false');
				});
			};
			steps.forEach(function (s) {
				s.setAttribute('role', 'button');
				s.setAttribute('tabindex', '0');
				s.addEventListener('click', function () { open(s); });
				s.addEventListener('keydown', function (e) {
					if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); open(s); }
					if (e.key === 'ArrowRight' || e.key === 'ArrowDown' || e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
						e.preventDefault();
						var dir = (e.key === 'ArrowRight' || e.key === 'ArrowDown') ? 1 : -1;
						var next = steps[(steps.indexOf(s) + dir + steps.length) % steps.length];
						next.focus();
						open(next);
					}
				});
			});
			open(steps[0]);
		});
	}

	/* ---------- Barra: assume a cor do capítulo sob ela. ---------- */
	var bar = doc.querySelector('.bar');
	var currentTone = '';
	function toneAt(y) {
		var stack = doc.elementsFromPoint(window.innerWidth / 2, y);
		for (var i = 0; i < stack.length; i++) {
			if (bar && bar.contains(stack[i])) continue;
			var m = (stack[i].className && typeof stack[i].className === 'string') ? stack[i].className.match(/\bch--([a-z-]+)/) : null;
			if (m) return m[1];
		}
		return '';
	}
	function paintBar() {
		if (!bar) return;
		var tone = toneAt(bar.offsetHeight + 1) || 'graphite';
		if (tone === currentTone) return;
		if (currentTone) bar.classList.remove('ch--' + currentTone);
		bar.classList.add('ch--' + tone);
		currentTone = tone;
	}

	/* ---------- Parallax do mar na abertura. ---------- */
	var heroImg = doc.querySelector('.hero__photo img');
	var parallaxOn = heroImg && !reduce && window.matchMedia('(min-width: 861px)').matches;

	var ticking = false;
	function onScroll() {
		if (ticking) return;
		ticking = true;
		requestAnimationFrame(function () {
			var y = window.scrollY || 0;
			if (parallaxOn && y < window.innerHeight * 1.2) {
				heroImg.style.setProperty('--py', (y * 0.18).toFixed(1) + 'px');
			}
			paintBar();
			ticking = false;
		});
	}

	/* ---------- Menu do celular. ---------- */
	function menu() {
		if (!bar) return;
		var btn = bar.querySelector('.bar__toggle');
		var nav = bar.querySelector('.bar__nav');
		if (!btn || !nav) return;
		var set = function (open) {
			bar.classList.toggle('is-open', open);
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
		};
		btn.addEventListener('click', function () { set(btn.getAttribute('aria-expanded') !== 'true'); });
		nav.addEventListener('click', function (e) { if (e.target.closest('a')) set(false); });
		doc.addEventListener('keydown', function (e) { if (e.key === 'Escape') set(false); });
		var path = location.pathname.replace(/\/+$/, '/');
		nav.querySelectorAll('a').forEach(function (a) {
			if (a.getAttribute('href') === path) a.setAttribute('aria-current', 'page');
		});
	}

	/* ---------- Formulário: pré-preenche a partir do diagnóstico. ---------- */
	function prefill() {
		var form = doc.getElementById('diagnostico-form');
		if (!form) return;
		var ta = form.querySelector('textarea');
		if (ta && ta.value && location.hash === '#diagnostico-form') {
			setTimeout(function () {
				ta.focus({ preventScroll: true });
				ta.setSelectionRange(ta.value.length, ta.value.length);
			}, 600);
		}
	}

	function init() {
		prepare();
		reveal();
		counters();
		accordion();
		menu();
		prefill();
		paintBar();
		window.addEventListener('scroll', onScroll, { passive: true });
		window.addEventListener('resize', onScroll, { passive: true });
	}

	if (doc.readyState === 'loading') doc.addEventListener('DOMContentLoaded', init);
	else init();
})();
