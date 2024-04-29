/**
 * To handle progress of each section of the registration
 */
function goToSection(sectionNum) {
    var form_Sections = document.getElementsByClassName('form_section');
    var progress_Steps = document.getElementsByClassName('progress_step');

    for (var i = 0; i < form_Sections.length; i++) {
        form_Sections[i].style.display = 'none';
        if (progress_Steps[i]) {
            progress_Steps[i].classList.remove('active');
        }
    }
    var sectionToShowOnForm = document.getElementById('section' + sectionNum);
    if (sectionToShowOnForm) {
        sectionToShowOnForm.style.display = 'block';
        progress_Steps[sectionNum - 1].classList.add('active');
    }
}
