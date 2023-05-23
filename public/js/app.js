document.addEventListener('DOMContentLoaded', () => {
  const select = document.getElementById('rol')
  const studentFields = document.getElementById('student-fields')
  const professorFields = document.getElementById('professor-fields')
  M.FormSelect.init(select) // initialize select (materialize)

  select.addEventListener('change', () => {
    if (select.value === 'student') {
      studentFields.style.display = 'block'
      professorFields.style.display = 'none'
    } else if (select.value === 'professor') {
      studentFields.style.display = 'none'
      professorFields.style.display = 'block'
    }
  })
})
const phoneInputField = document.querySelector('#phone')
const phoneInput = window.intlTelInput(phoneInputField, {
  utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js',
})
