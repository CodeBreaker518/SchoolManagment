document.addEventListener('DOMContentLoaded', function () {
  // initialize collapsible (materialize)
  const elemsCollapsible = document.querySelectorAll('.collapsible')
  const instancesCollapsible = M.Collapsible.init(elemsCollapsible)

  // initiliaze modal (materialize)
  const elemsModal = document.querySelectorAll('.modal')
  const instancesModal = M.Modal.init(elemsModal)

  // initialize dropdown (materialize)
  var elemsDropdown = document.querySelectorAll('.dropdown-trigger')
  var instancesDropdown = M.Dropdown.init(elemsDropdown)

  //Initialize input select (materialize)
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);

  // Obtener los enlaces de la barra lateral
  const mainLink = document.querySelector('.main-link')
  const studentsLink = document.querySelector('.students-link')
  const coursesLink = document.querySelector('.courses-link')
  const professorsLink = document.querySelector('.professors-link')
  const aboutUsLink = document.querySelector('.about-us-link')

  // Obtener las secciones de contenido
  const mainContent = document.querySelector('.main-content')
  const studentsContent = document.querySelector('.students-content')
  const coursesContent = document.querySelector('.courses-content')
  const professorsContent = document.querySelector('.professors-content')
  const aboutUsContent = document.querySelector('.about-us-content')

  // Función para acticonst un enlace y mostrar su contenido
  const activateLink = (link, content) => {
    // Remover la clase 'active' de todos los enlaces
    const links = document.querySelectorAll('.collection-item')
    links.forEach(function (link) {
      link.classList.remove('active')
    })

    // Agregar la clase 'active' al enlace seleccionado
    link.classList.add('active')

    // Ocultar todos los contenidos
    const contents = document.querySelectorAll('.content-section')
    contents.forEach(function (content) {
      content.style.display = 'none'
    })

    // Mostrar el contenido correspondiente al enlace seleccionado
    content.style.display = 'block'
  }

  // Verificar si existen los enlaces y asignarles eventos de click
  if (mainLink) {
    mainLink.addEventListener('click', function () {
      activateLink(mainLink, mainContent)
    })
  }

  if (aboutUsLink) {
    aboutUsLink.addEventListener('click', function () {
      activateLink(aboutUsLink, aboutUsContent)
    })
  }

  if (studentsLink) {
    studentsLink.addEventListener('click', function () {
      activateLink(studentsLink, studentsContent)
    })
  }

  if (coursesLink) {
    coursesLink.addEventListener('click', function () {
      activateLink(coursesLink, coursesContent)
    })
  }

  if (professorsLink) {
    professorsLink.addEventListener('click', function () {
      activateLink(professorsLink, professorsContent)
    })
  }
})

// Show user menu on dashboard

const showUserMenu = () => {
  const userMenu = document.getElementById('user-menu')
  userMenu.classList.add('show-menu')
}

const hideUserMenu = () => {
  const userMenu = document.getElementById('user-menu')
  userMenu.classList.remove('show-menu')
}

const userInfoContainer = document.querySelector('.user-info-container')
const userMenu = document.querySelector('.user-menu')
const goldUG = '#ffbf00'
const azulUG = '#003a6c'
userInfoContainer.addEventListener('mouseover', () => {
  showUserMenu()
  userInfoContainer.style.backgroundColor = goldUG
})
userInfoContainer.addEventListener('mouseout', () => {
  hideUserMenu()
  userInfoContainer.style.backgroundColor = azulUG
})

userMenu.addEventListener('mouseover', () => {
  showUserMenu()
  userInfoContainer.style.backgroundColor = goldUG
})
userMenu.addEventListener('mouseout', () => {
  hideUserMenu()
  userInfoContainer.style.backgroundColor = azulUG
})
