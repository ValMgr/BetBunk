/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';
import { listenForNewQuestion } from './controllers/quizz_controller';
import { answerFunction } from './controllers/answer_controller';

function docReady(fn) {
    if (document.readyState === "complete" || document.readyState === "interactive") {
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

docReady(() => {

    setMinHeight();
    listenForNewQuestion();
    const darkModeToggle = document.querySelector('#dark-toggle');
    darkModeToggle.addEventListener('click', toggleDarkMode.bind(darkModeToggle));

    const timer = document.querySelector('#buttonStart');
    timer.addEventListener('click', answerFunction);

    if (localStorage.theme === 'dark' ||
        (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        darkModeToggle.children[0].classList.remove('hidden');
        darkModeToggle.children[1].classList.add('hidden');
        document.documentElement.classList.add('dark')
    } else {
        darkModeToggle.children[0].classList.add('hidden');
        darkModeToggle.children[1].classList.remove('hidden');
        document.documentElement.classList.remove('dark')
    }

    function toggleDarkMode() {
        const currMode = ('theme' in localStorage) ? localStorage.theme : window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (currMode === 'dark') {
            localStorage.theme = 'light';
            this.children[0].classList.add('hidden');
            this.children[1].classList.remove('hidden');
            document.documentElement.classList.remove('dark');
        }
        else {
            localStorage.theme = 'dark';
            this.children[0].classList.remove('hidden');
            this.children[1].classList.add('hidden');
            document.documentElement.classList.add('dark');
        }
    }

    function setMinHeight() {
        const header = document.querySelector('header');
        const footer = document.querySelector('footer');
        const main = document.querySelector('main');
        const minHeight = window.innerHeight - header.offsetHeight - footer.offsetHeight;
        main.style.minHeight = `${minHeight}px`;
    }



    

});

