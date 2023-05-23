document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.collapsible');
  var instances = M.Collapsible.init(elems);
});

document.addEventListener('DOMContentLoaded', () => {
  const select = document.getElementById('rol')
  const professorFields = document.getElementById('professor-fields')
  M.FormSelect.init(select)
  select.addEventListener('change', () => {
    if (select.value === 'professor') {
      professorFields.style.display = 'block'
    } else {
      professorFields.style.display = 'none'
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

