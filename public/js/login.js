const passwordInput = document.querySelector('#password')
const togglePassword = document.querySelector('.toggle-password')

togglePassword.addEventListener('click', () => {
  if (togglePassword.classList.contains('fa-eye')) {
    togglePassword.classList.remove('fa-eye')
    togglePassword.classList.add('fa-eye-slash')
    passwordInput.setAttribute('type', 'text')
  } else if (togglePassword.classList.contains('fa-eye-slash')) {
    togglePassword.classList.remove('fa-eye-slash')
    togglePassword.classList.add('fa-eye')
    passwordInput.setAttribute('type', 'password')
  }
})