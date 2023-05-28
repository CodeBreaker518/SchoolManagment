document.addEventListener('DOMContentLoaded', function () {
  // initialize collapsible (materialize)
  const elems = document.querySelectorAll('.collapsible')
  const instances = M.Collapsible.init(elems)

  // initiliaze modal (materialize)
  const elemsModal = document.querySelectorAll('.modal')
  const instancesModal = M.Modal.init(elemsModal)

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
