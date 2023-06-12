document.addEventListener('DOMContentLoaded', () => {
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

  // hide menu on mobile desktop
  const showSidebar = document.querySelector('.show-sidebar')
  const sideBar = document.querySelector('.side-bar')
  const collectionLinks = document.querySelectorAll('.collection-item')
  const body = document.querySelector('body')
  //Edit courses variable
  var editCoursesBtn = document.querySelectorAll('.edit-courses-btn')
  var editCourseIdInput = document.querySelector('#editCourseIdInput')
  //asign teachers variables
  var asignTeacherBtn = document.querySelectorAll('.asign-teacher-btn')
  var assignTeacherCourseIdInput = document.querySelector('#assignTeacherCourseIdInput')
  //delete teacher from a course variables
  var deleteTeacherCourseBtn = document.querySelectorAll('.delete-teacher-course-btn')
  var deleteTeacherCourseIdInput = document.querySelector('#deleteTeacherCourseIdInput')
  //delete courses variable
  var deleteCoursesBtn = document.querySelectorAll('.delete-courses-btn')
  var deleteCourseIdInput = document.querySelector('#deleteCourseIdInput')
  //delete students variable
  var deleteStudentsBtn = document.querySelectorAll('.delete-students-btn')
  var deleteStudentIdInput = document.querySelector('#deleteStudentIdInput')
  //delete teachers variable
  var deleteTeachersBtn = document.querySelectorAll('.delete-teachers-btn')
  var deleteTeacherIdInput = document.querySelector('#deleteTeacherIdInput')
  //asign students variables
  var assignStudentBtn = document.querySelectorAll('.asign-student-btn')
  var assignStudentCourseIdInput = document.querySelector('#assignStudentCourseIdInput')
  //delete students from courses variables
  var deleteStudentBtn = document.querySelectorAll('.delete-student-btn')
  var deleteStudentCourseIdInput = document.querySelector('#deleteStudentCourseInput')

  //////////////////////////////////////////////////
  ////////////Admin controller functions////////////

  //Edit courses function
  editCoursesBtn.forEach(function (trigger) {
    trigger.addEventListener('click', function () {
      var courseId = this.getAttribute('data-id')
      editCourseIdInput.value = courseId
    })
  })
  //asign teacher function
  asignTeacherBtn.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var courseId = this.getAttribute('data-id')
      assignTeacherCourseIdInput.value = courseId
    })
  })
  //delete teacher from course function
  deleteTeacherCourseBtn.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var courseId = this.getAttribute('data-id')
      deleteTeacherCourseIdInput.value = courseId
    })
  })
  //delete course function
  deleteCoursesBtn.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var courseId = this.getAttribute('data-id')
      deleteCourseIdInput.value = courseId
    })
  })
  //delete student function
  deleteStudentsBtn.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var studentId = this.getAttribute('data-id')
      deleteStudentIdInput.value = studentId
    })
  })
  //delete teacher function
  deleteTeachersBtn.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var teacherId = this.getAttribute('data-id')
      deleteTeacherIdInput.value = teacherId
      console.log(dele)
    })
  })
  //assign student function
  assignStudentBtn.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var courseId = this.getAttribute('data-id')
      assignStudentCourseIdInput.value = courseId
    })
  })
  //delete student from course function
  deleteStudentBtn.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var courseId = this.getAttribute('data-id')
      deleteStudentCourseIdInput.value = courseId
    })
  })

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
  //hide any collapsible active
  const collapsibles = document.querySelectorAll('.collapsible.popout>li')
  const collapsiblesBody = document.querySelectorAll('.collapsible-body')
  const hideCollapsibles = (collapsibles, collapsiblesBody) => {
    collapsiblesBody.forEach((collapsibleBody) => {
      collapsibleBody.style.display = ''
    })
    collapsibles.forEach((collapsible) => {
      if (collapsible.classList.contains('active')) {
        collapsible.classList.remove('active')
      }
    })
  }

  // verify one by one if the links exits
  if (mainLink) {
    mainLink.addEventListener('click', function () {
      activateLink(mainLink, mainContent)
      hideCollapsibles(collapsibles, collapsiblesBody)
    })
  }

  if (aboutUsLink) {
    aboutUsLink.addEventListener('click', function () {
      activateLink(aboutUsLink, aboutUsContent)
      hideCollapsibles(collapsibles, collapsiblesBody)
    })
  }

  if (studentsLink) {
    studentsLink.addEventListener('click', function () {
      activateLink(studentsLink, studentsContent)
      hideCollapsibles(collapsibles, collapsiblesBody)
    })
  }

  if (coursesLink) {
    coursesLink.addEventListener('click', function () {
      activateLink(coursesLink, coursesContent)
      hideCollapsibles(collapsibles, collapsiblesBody)
    })
  }

  if (professorsLink) {
    professorsLink.addEventListener('click', function () {
      activateLink(professorsLink, professorsContent)
      hideCollapsibles(collapsibles, collapsiblesBody)
    })
  }

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
})

// change password show-hide feature
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
