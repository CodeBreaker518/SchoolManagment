document.addEventListener('DOMContentLoaded', () => {
  // hide menu on mobile desktop
  const showSidebar = document.querySelector('.show-sidebar')
  const sideBar = document.querySelector('.side-bar')
  const collectionLinks = document.querySelectorAll('.collection-item')
  const body = document.querySelector('body')
  //Edit courses variable
  var editCoursesBtn = document.querySelectorAll('.edit-courses-btn');
  var courseIdInput = document.getElementById('courseIdInput');
  //asign teachers variables
  var asignTeacherBtn = document.querySelector('.asign-teacher-btn');
  //var courseIdInput = document.getElementById('courseIdInput');
  
  //////////////////////////////////////////////////
  ////////////Admin controller functions////////////

  //Edit courses function
  editCoursesBtn.forEach(function(trigger) {
    trigger.addEventListener('click', function() {
      var courseId = this.getAttribute('data-id');
      courseIdInput.value = courseId;
    });
  });
  // asign teacher function
  asignTeacherBtn.addEventListener('click', function() {
    var courseId = this.getAttribute('data-id');
    courseIdInput.value = courseId;
  });

  function checkWidth() {
    if (window.innerWidth <= 700) {
      sideBar.classList.add('hide-sidebar')
    } else {
      sideBar.classList.remove('hide-sidebar')
    }
  }
  checkWidth()

  showSidebar.addEventListener('click', function () {
    sideBar.classList.toggle('hide-sidebar')

    if (sideBar.classList.contains('hide-sidebar')) {
      body.style.overflow = 'auto'
    } else {
      body.style.overflow = 'hidden'
    }
  })

  window.addEventListener('resize', function () {
    checkWidth()
  })
  collectionLinks.forEach(function (link) {
    link.addEventListener('click', function () {
      if (window.innerWidth <= 700) {
        sideBar.classList.add('hide-sidebar')
        body.style.overflow = 'auto'
      }
      if (window.innerWidth > 700) {
        body.style.overflow = 'auto'
      }
    })
  })
  ////////////////////////////////////////////////////////////////
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
  var elems = document.querySelectorAll('select')
  var instances = M.FormSelect.init(elems)

  // Obtain links from sidebar collection
  const mainLink = document.querySelector('.main-link')
  const studentsLink = document.querySelector('.students-link')
  const coursesLink = document.querySelector('.courses-link')
  const professorsLink = document.querySelector('.professors-link')
  const aboutUsLink = document.querySelector('.about-us-link')

  // Obtain content from right-container dashboard
  const mainContent = document.querySelector('.main-content')
  const studentsContent = document.querySelector('.students-content')
  const coursesContent = document.querySelector('.courses-content')
  const professorsContent = document.querySelector('.professors-content')
  const aboutUsContent = document.querySelector('.about-us-content')

  // activate a link & show its content
  const activateLink = (link, content) => {
    // remove class active from every link
    const links = document.querySelectorAll('.collection-item')
    links.forEach(function (link) {
      link.classList.remove('active')
    })

    // Add class active to selected link
    link.classList.add('active')

    // hide all contents
    const contents = document.querySelectorAll('.content-section')
    contents.forEach(function (content) {
      content.style.display = 'none'
    })

    // show content on selected content
    content.style.display = 'block'
  }

  // verify one by one if the links exits
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
