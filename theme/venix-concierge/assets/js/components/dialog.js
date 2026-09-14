document.addEventListener('DOMContentLoaded', () => {
  const supportsModalDialog =
    typeof HTMLDialogElement !== 'undefined' &&
    typeof HTMLDialogElement.prototype.showModal === 'function';

  if (!supportsModalDialog) return;

  const triggers = document.querySelectorAll('button[type="button"][data-tly-dialog-open]');

  triggers.forEach((trigger) => {
    trigger.hidden = true;

    const dialogId = trigger.getAttribute('data-tly-dialog-open');
    const dialog = dialogId ? document.getElementById(dialogId) : null;

    if (!(dialog instanceof HTMLDialogElement) || !dialog.matches('dialog[data-tly-dialog]')) return;

    dialog.classList.add('is-enhanced');
    trigger.hidden = false;

    trigger.addEventListener('click', () => {
      if (!dialog.open) dialog.showModal();
    });
  });
});
