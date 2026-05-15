import '../scss/account.scss';

document.addEventListener('DOMContentLoaded', () => {
  const registrationButton = document.querySelector('.btn-registration');
  const accountColumns = document.querySelector('.u-columns.col2-set');
  const loginColumn = accountColumns?.querySelector('.u-column1');
  const registerColumn = accountColumns?.querySelector('.u-column2');

  if (!registrationButton || !accountColumns || !loginColumn || !registerColumn) {
    return;
  }

  registrationButton.addEventListener('click', (event) => {
    event.preventDefault();
    accountColumns.classList.add('show-register');
    loginColumn.classList.add('is-hidden');
    registerColumn.classList.remove('is-hidden');
    registerColumn.querySelector('input, button')?.focus();
  });
});
