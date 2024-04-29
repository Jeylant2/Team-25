/**
 * Accordion for FAQ questions.
 */
document.addEventListener("DOMContentLoaded", function() {
    var acc = document.getElementsByClassName("accordion_question");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var toggleButton = this.getElementsByClassName("accordion_toggle")[0];
            toggleButton.textContent = (toggleButton.textContent === '+' && '−' || toggleButton.textContent !== '+' && '+');

            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
});
