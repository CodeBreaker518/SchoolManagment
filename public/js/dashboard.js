
document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.collapsible')
    var instances = M.Collapsible.init(elems)
})

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
});

// Obtén los elementos de enlace y los contenidos correspondientes
const studentsLink = document.querySelector('.students-link');
const studentsContent = document.querySelector('.students-content');
const coursesLink = document.querySelector('.courses-link');
const coursesContent = document.querySelector('.courses-content');
const professorsLink = document.querySelector('.professors-link');
const professorsContent = document.querySelector('.professors-content');

// Agrega event listeners para mostrar/ocultar el contenido al hacer clic en los enlaces
studentsLink.addEventListener('click', function () {
    studentsLink.classList.add('active');
    professorsLink.classList.remove('active');
    coursesLink.classList.remove('active');
    studentsContent.style.display = 'block';
    coursesContent.style.display = 'none';
    professorsContent.style.display = 'none';
});

coursesLink.addEventListener('click', function () {
    coursesLink.classList.add('active');
    studentsLink.classList.remove('active');
    professorsLink.classList.remove('active');
    studentsContent.style.display = 'none';
    coursesContent.style.display = 'block';
    professorsContent.style.display = 'none';
});

professorsLink.addEventListener('click', function () {
    professorsLink.classList.add('active');
    coursesLink.classList.remove('active');
    studentsLink.classList.remove('active');
    studentsContent.style.display = 'none';
    coursesContent.style.display = 'none';
    professorsContent.style.display = 'block';
});
