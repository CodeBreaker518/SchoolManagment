document.addEventListener('DOMContentLoaded', () => {
  const select = document.getElementById('rol')
  const professorFields = document.getElementById('professor-fields')
  const professionInput = document.getElementById('profession')
  M.FormSelect.init(select)

  select.addEventListener('change', () => {
    if (select.value === 'student') {
      professorFields.style.display = 'none'
      // disable input validation
      professionInput.removeAttribute('required')
    } else {
      professorFields.style.display = 'block'
      professionInput.setAttribute('required', 'required')
    }
  })
})

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
