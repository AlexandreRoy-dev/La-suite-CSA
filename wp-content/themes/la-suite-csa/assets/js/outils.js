/**
 * Interactive calculators for the Outils page.
 * Pure math, fr-CA formatting. No network calls.
 */
(function () {
	var money = new Intl.NumberFormat('fr-CA', {
		style: 'currency',
		currency: 'CAD',
		maximumFractionDigits: 2,
	});
	var number = new Intl.NumberFormat('fr-CA', {
		maximumFractionDigits: 2,
	});
	var percent = new Intl.NumberFormat('fr-CA', {
		style: 'percent',
		maximumFractionDigits: 1,
	});

	function num(form, name) {
		var el = form.querySelector('[name="' + name + '"]');
		if (!el) return 0;
		var v = parseFloat(String(el.value).replace(',', '.'));
		return Number.isFinite(v) ? v : 0;
	}

	function str(form, name) {
		var el = form.querySelector('[name="' + name + '"]');
		return el ? el.value : '';
	}

	/** Canadian-style mortgage monthly rate from nominal annual compounded semi-annually. */
	function monthlyRate(annualPercent) {
		var nominal = annualPercent / 100;
		return Math.pow(1 + nominal / 2, 1 / 6) - 1;
	}

	function paymentFromPrincipal(principal, annualPercent, amortYears) {
		var i = monthlyRate(annualPercent);
		var n = Math.round(amortYears * 12);
		if (n <= 0) return 0;
		if (i === 0) return principal / n;
		var f = Math.pow(1 + i, n);
		return (principal * i * f) / (f - 1);
	}

	function principalFromPayment(payment, annualPercent, amortYears) {
		var i = monthlyRate(annualPercent);
		var n = Math.round(amortYears * 12);
		if (n <= 0 || payment <= 0) return 0;
		if (i === 0) return payment * n;
		var f = Math.pow(1 + i, n);
		return (payment * (f - 1)) / (i * f);
	}

	function scheduleInterest(principal, annualPercent, amortYears, termYears) {
		var i = monthlyRate(annualPercent);
		var nAmort = Math.round(amortYears * 12);
		var nTerm = Math.min(Math.round(termYears * 12), nAmort);
		var pmt = paymentFromPrincipal(principal, annualPercent, amortYears);
		var balance = principal;
		var interestPaid = 0;
		var principalPaid = 0;
		for (var m = 0; m < nTerm; m++) {
			var interest = balance * i;
			var principalPart = Math.min(pmt - interest, balance);
			interestPaid += interest;
			principalPaid += principalPart;
			balance = Math.max(0, balance - principalPart);
			if (balance <= 0) break;
		}
		return {
			payment: pmt,
			interestPaid: interestPaid,
			principalPaid: principalPaid,
			balance: balance,
			totalPaid: interestPaid + principalPaid,
		};
	}

	function row(label, value) {
		return (
			'<div class="tool-results__row">' +
			'<span class="tool-results__label">' +
			label +
			'</span>' +
			'<span class="tool-results__value">' +
			value +
			'</span>' +
			'</div>'
		);
	}

	var calculators = {
		hypotheque: function (form) {
			var principal = num(form, 'principal');
			var rate = num(form, 'rate');
			var amort = num(form, 'amortYears');
			var term = num(form, 'termYears');
			var pmt = paymentFromPrincipal(principal, rate, amort);
			var stats = scheduleInterest(principal, rate, amort, term);
			return (
				row('Paiement mensuel', money.format(pmt)) +
				row('Paiements sur le terme', money.format(pmt * Math.round(term * 12))) +
				row('Intérêts sur le terme', money.format(stats.interestPaid)) +
				row('Capital remboursé (terme)', money.format(stats.principalPaid)) +
				row('Solde estimé en fin de terme', money.format(stats.balance))
			);
		},
		capacite: function (form) {
			var payment = num(form, 'payment');
			var rate = num(form, 'rate');
			var amort = num(form, 'amortYears');
			var maxLoan = principalFromPayment(payment, rate, amort);
			return (
				row('Capacité d’emprunt estimée', money.format(maxLoan)) +
				row('Mensualité retenue', money.format(payment)) +
				row('Amortissement', number.format(amort) + ' ans')
			);
		},
		interet: function (form) {
			var principal = num(form, 'principal');
			var rate = num(form, 'rate');
			var amort = num(form, 'amortYears');
			var term = num(form, 'termYears');
			var stats = scheduleInterest(principal, rate, amort, term);
			return (
				row('Paiement mensuel', money.format(stats.payment)) +
				row('Intérêts sur la période', money.format(stats.interestPaid)) +
				row('Capital remboursé', money.format(stats.principalPaid)) +
				row('Total versé', money.format(stats.totalPaid)) +
				row('Solde restant', money.format(stats.balance))
			);
		},
		tvq: function (form) {
			var amount = num(form, 'amount');
			var mode = str(form, 'mode');
			var gst = 0.05;
			var qst = 0.09975;
			var combo = 1 + gst + qst;
			var ht;
			var tps;
			var tvq;
			var ttc;
			if (mode === 'ttc') {
				ttc = amount;
				ht = amount / combo;
				tps = ht * gst;
				tvq = ht * qst;
			} else {
				ht = amount;
				tps = ht * gst;
				tvq = ht * qst;
				ttc = ht + tps + tvq;
			}
			return (
				row('Montant hors taxes', money.format(ht)) +
				row('TPS (5 %)', money.format(tps)) +
				row('TVQ (9,975 %)', money.format(tvq)) +
				row('Total TTC', money.format(ttc))
			);
		},
		subvention: function (form) {
			var cost = num(form, 'cost');
			var rate = num(form, 'rate') / 100;
			var ceiling = num(form, 'ceiling');
			var raw = cost * rate;
			var aid = Math.min(raw, ceiling);
			var rest = Math.max(0, cost - aid);
			return (
				row('Aide estimée', money.format(aid)) +
				row('Reste à financer', money.format(rest)) +
				row('Taux effectif', percent.format(cost > 0 ? aid / cost : 0)) +
				(raw > ceiling ? row('Plafond atteint', 'Oui') : row('Plafond atteint', 'Non'))
			);
		},
		credit: function (form) {
			var spend = num(form, 'spend');
			var rate = num(form, 'rate') / 100;
			var credit = spend * rate;
			return (
				row('Crédit d’impôt estimé', money.format(credit)) +
				row('Dépenses retenues', money.format(spend)) +
				row('Taux appliqué', percent.format(rate))
			);
		},
		seuil: function (form) {
			var fixed = num(form, 'fixed');
			var price = num(form, 'price');
			var variable = num(form, 'variable');
			var contrib = price - variable;
			if (contrib <= 0) {
				return row('Résultat', 'La marge unitaire doit être positive.');
			}
			var units = fixed / contrib;
			return (
				row('Contribution unitaire', money.format(contrib)) +
				row('Unités au seuil', number.format(units)) +
				row('Chiffre d’affaires au seuil', money.format(units * price))
			);
		},
		marge: function (form) {
			var cost = num(form, 'cost');
			var price = num(form, 'price');
			if (price <= 0) {
				return row('Résultat', 'Indiquez un prix de vente.');
			}
			var margin = (price - cost) / price;
			var markup = cost > 0 ? (price - cost) / cost : 0;
			return (
				row('Profit unitaire', money.format(price - cost)) +
				row('Marge brute', percent.format(margin)) +
				row('Coefficient (markup)', percent.format(markup))
			);
		},
		roi: function (form) {
			var invest = num(form, 'invest');
			var gain = num(form, 'gain');
			if (invest <= 0) {
				return row('Résultat', 'Indiquez un investissement.');
			}
			var roi = gain / invest;
			var years = gain > 0 ? invest / gain : Infinity;
			return (
				row('ROI annuel', percent.format(roi)) +
				row(
					'Délai de récupération',
					gain > 0 ? number.format(years) + ' ans' : 'Non récupérable avec ce gain'
				)
			);
		},
		endettement: function (form) {
			var income = num(form, 'income');
			var housing = num(form, 'housing');
			var debts = num(form, 'debts');
			if (income <= 0) {
				return row('Résultat', 'Indiquez un revenu mensuel.');
			}
			var abd = housing / income;
			var atd = (housing + debts) / income;
			return (
				row('Ratio logement (ABD)', percent.format(abd)) +
				row('Ratio total (ATD)', percent.format(atd)) +
				row('Charges totales / mois', money.format(housing + debts)) +
				row('Revenu disponible estimé', money.format(income - housing - debts))
			);
		},
	};

	function render(form) {
		var id = form.getAttribute('data-calculator');
		var box = form.querySelector('[data-results]');
		var fn = calculators[id];
		if (!box || !fn) return;
		box.innerHTML = '<div class="tool-results__inner">' + fn(form) + '</div>';
	}

	function bindTabs(root) {
		if (root.getAttribute('data-tools-bound') === '1') {
			return;
		}
		root.setAttribute('data-tools-bound', '1');
		var tabs = root.querySelectorAll('[data-tool-tab]');
		var panels = root.querySelectorAll('[data-tool-panel]');
		tabs.forEach(function (tab) {
			tab.addEventListener('click', function () {
				var id = tab.getAttribute('data-tool-tab');
				tabs.forEach(function (t) {
					var on = t === tab;
					t.classList.toggle('is-active', on);
					t.setAttribute('aria-selected', on ? 'true' : 'false');
				});
				panels.forEach(function (panel) {
					var on = panel.getAttribute('data-tool-panel') === id;
					panel.classList.toggle('is-active', on);
					if (on) {
						panel.removeAttribute('hidden');
						var form = panel.querySelector('[data-calculator]');
						if (form) render(form);
					} else {
						panel.setAttribute('hidden', '');
					}
				});
			});
		});
	}

	function init(scope) {
		var rootScope = scope || document;
		rootScope.querySelectorAll('[data-tools-root]').forEach(function (root) {
			bindTabs(root);
		});
		rootScope.querySelectorAll('[data-calculator]').forEach(function (form) {
			render(form);
			if (form.getAttribute('data-calc-bound') === '1') {
				return;
			}
			form.setAttribute('data-calc-bound', '1');
			form.addEventListener('input', function () {
				render(form);
			});
			form.addEventListener('change', function () {
				render(form);
			});
			form.addEventListener('submit', function (e) {
				e.preventDefault();
				render(form);
			});
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', function () {
			init();
		});
	} else {
		init();
	}

	window.laSuiteCsaOutils = { init: init };
})();
