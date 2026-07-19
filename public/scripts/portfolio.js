function setActiveButton(clickedButton) {
    const buttons = document.querySelectorAll('.filter_btn');

    buttons.forEach(btn => {
        btn.classList.remove('is-active');
        btn.setAttribute('aria-pressed', 'false');
    });

    clickedButton.classList.add('is-active');
    clickedButton.setAttribute('aria-pressed', 'true');
}