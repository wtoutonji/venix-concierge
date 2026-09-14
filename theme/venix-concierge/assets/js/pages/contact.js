document.addEventListener('DOMContentLoaded', function () {
	var form = document.querySelector('[data-contact-form]');
	if (!form) return;
	var step = 1;
	var titles = [['Your contact details', 'How should we reach you?'], ['Service selection', 'What service do you require?'], ['Journey information', 'Where and when?'], ['Additional requirements', 'Anything else to note?']];
	var checks = { 1: [['fullName', function (v) { return v.trim() !== ''; }], ['email', function (v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim()); }]], 2: [['service', function (v) { return v !== ''; }]], 3: [['pickup', function (v) { return v.trim() !== ''; }], ['date', function (v) { return v !== ''; }]], 4: [['consent', function (_, input) { return input.checked; }]] };
	function render() {
		form.querySelectorAll('[data-contact-step]').forEach(function (panel) { panel.hidden = Number(panel.dataset.contactStep) !== step; });
		document.querySelector('[data-contact-title]').textContent = titles[step - 1][0]; document.querySelector('[data-contact-subtitle]').textContent = titles[step - 1][1];
		document.querySelectorAll('[data-contact-progress]').forEach(function (item) { var n = Number(item.dataset.contactProgress); item.classList.toggle('is-active', n === step); item.classList.toggle('is-complete', n < step); item.textContent = n < step ? '✓' : n; });
		document.querySelectorAll('[data-contact-connector]').forEach(function (connector) { connector.classList.toggle('is-complete', Number(connector.dataset.contactConnector) < step); });
		document.querySelector('[data-contact-back]').hidden = step === 1; document.querySelector('[data-contact-next]').hidden = step === 4; document.querySelector('[data-contact-submit]').hidden = step !== 4;
	}
	function clearErrors() { var summary = form.querySelector('[data-contact-errors]'); form.querySelectorAll('.venix-field--invalid, .contact-consent--invalid').forEach(function (el) { el.classList.remove('venix-field--invalid', 'contact-consent--invalid'); }); form.querySelectorAll('[aria-invalid]').forEach(function (control) { control.removeAttribute('aria-invalid'); }); form.querySelectorAll('.contact-field-error').forEach(function (el) { el.hidden = true; }); summary.hidden = true; summary.querySelector('ul').innerHTML = ''; }
	function validate(current) { clearErrors(); var errors = []; checks[current].forEach(function (rule) { var input = form.elements[rule[0]]; if (!rule[1](input.value, input)) { var field = input.closest('.venix-field') || input.closest('.contact-consent'); field.classList.add(field.classList.contains('contact-consent') ? 'contact-consent--invalid' : 'venix-field--invalid'); input.setAttribute('aria-invalid', 'true'); var error = form.querySelector('[data-contact-error="' + rule[0] + '"]'); error.hidden = false; errors.push(error.textContent); } else { input.removeAttribute('aria-invalid'); } }); var summary = form.querySelector('[data-contact-errors]'); summary.hidden = !errors.length; summary.querySelector('ul').innerHTML = errors.map(function (text) { return '<li>' + text + '</li>'; }).join(''); return !errors.length; }
	form.querySelector('[data-contact-next]').addEventListener('click', function () { if (validate(step)) { step += 1; render(); } });
	form.querySelector('[data-contact-back]').addEventListener('click', function () { clearErrors(); step -= 1; render(); });
	form.addEventListener('submit', function (event) { event.preventDefault(); });
	render();
});
